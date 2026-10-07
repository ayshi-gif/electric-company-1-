<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;
use CodeIgniter\Controller;
use CodeIgniter\Database\Exceptions\DatabaseException;
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends Controller
{
    protected $helpers = ['form', 'url'];
    protected $customerModel;

    public function __construct()
    {
        $this->customerModel = new CustomerAccountModel();
    }

    /** Display the existing dashboard, with all selected filters combined. */
    public function index()
    {
        $keyword = $this->scalarText($this->request->getGet('search'));
        $status = $this->scalarText($this->request->getGet('status'));
        $type = $this->scalarText($this->request->getGet('type'));
        $status = in_array($status, ['active', 'inactive', 'suspended'], true) ? $status : '';
        $type = in_array($type, ['residential', 'commercial', 'industrial'], true) ? $type : '';
        $page = filter_var($this->scalarText($this->request->getGet('page')), FILTER_VALIDATE_INT,
            ['options' => ['min_range' => 1]]) ?: 1;
        $perPage = 10;

        $accounts = $this->customerModel->getFilteredAccounts($keyword, $status, $type, $perPage, $page);
        $pager = $this->customerModel->pager;

        return view('home/index', [
            'accounts' => $accounts,
            'pager' => $pager,
            'filtered_total' => $pager->getTotal(),
            'current_page' => $pager->getCurrentPage(),
            'per_page' => $perPage,
            'total_accounts' => $this->customerModel->getTotalAccounts(),
            'active_accounts' => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'search_keyword' => $keyword,
            'filter_status' => $status,
            'filter_type' => $type,
        ]);
    }

    public function viewAccount($id)
    {
        return view('home/view_account', ['account' => $this->findAccount($id)]);
    }

    public function create()
    {
        return $this->accountForm();
    }

    public function store()
    {
        return $this->saveAccount();
    }

    public function edit($id)
    {
        return $this->accountForm($this->findAccount($id), [], true);
    }

    public function update($id)
    {
        // Only the ID in the route identifies the account being changed.
        return $this->saveAccount($this->findAccount($id));
    }

    public function confirmDelete($id)
    {
        return view('home/delete', ['account' => $this->findAccount($id)]);
    }

    public function delete($id)
    {
        $account = $this->findAccount($id);

        try {
            if ($this->customerModel->delete($account['id']) !== false) {
                return redirect()->to(site_url('dashboard'))->with('success', 'Customer account deleted successfully.');
            }
        } catch (DatabaseException $exception) {
            log_message('error', 'Customer account deletion failed: {message}', ['message' => $exception->getMessage()]);
        }

        return redirect()->to(site_url('account/' . $account['id'] . '/delete'))
            ->with('error', 'The account could not be deleted. It may be used by another record. Please try again.');
    }

    /** Validate and save only the eight editable account fields. */
    private function saveAccount(array $existing = [])
    {
        $isEdit = isset($existing['id']);
        $id = $isEdit ? (int) $existing['id'] : null;
        $values = [];

        foreach (['account_number', 'customer_name', 'address', 'phone', 'email', 'meter_number', 'connection_type', 'status'] as $field) {
            $values[$field] = $this->scalarText($this->request->getPost($field));
        }

        // Keep the original route ID when redisplaying an invalid edit form.
        $formAccount = $isEdit ? array_merge($values, ['id' => $id]) : $values;

        try {
            if (!$this->validateData($values, $this->accountRules($id))) {
                $this->response->setStatusCode(422);
                return $this->accountForm($formAccount, $this->validator->getErrors(), $isEdit);
            }

            if ($isEdit) {
                $saved = $this->customerModel->update($id, $values);
            } else {
                $saved = $this->customerModel->insert($values);
                $id = $saved !== false ? (int) $saved : null;
            }

            if ($saved !== false && $id !== null) {
                return redirect()->to(site_url('account/' . $id))
                    ->with('success', $isEdit ? 'Customer account updated successfully.' : 'Customer account created successfully.');
            }
        } catch (DatabaseException $exception) {
            log_message('error', 'Customer account save failed: {message}', ['message' => $exception->getMessage()]);
        }

        $this->response->setStatusCode(422);
        return $this->accountForm($formAccount, [
            'save' => 'The account could not be saved. Check that the account and meter numbers are unique, then try again.',
        ], $isEdit);
    }

    private function accountRules(?int $id): array
    {
        // The uniqueness exclusion is built from a verified database ID, never a POST value.
        $ignore = $id !== null ? ',id,' . $id : '';

        return [
            'account_number' => [
                'label' => 'Account number',
                'rules' => 'required|max_length[20]|is_unique[customer_accounts.account_number' . $ignore . ']',
                'errors' => ['is_unique' => 'This account number is already in use.'],
            ],
            'customer_name' => ['label' => 'Customer name', 'rules' => 'required|max_length[100]'],
            'address' => ['label' => 'Address', 'rules' => 'required|max_length[1000]'],
            'phone' => ['label' => 'Phone number', 'rules' => 'required|max_length[20]'],
            'email' => ['label' => 'Email address', 'rules' => 'required|valid_email|max_length[100]'],
            'meter_number' => [
                'label' => 'Meter number',
                'rules' => 'required|max_length[20]|is_unique[customer_accounts.meter_number' . $ignore . ']',
                'errors' => ['is_unique' => 'This meter number is already in use.'],
            ],
            'connection_type' => ['label' => 'Connection type', 'rules' => 'required|in_list[residential,commercial,industrial]'],
            'status' => ['label' => 'Status', 'rules' => 'required|in_list[active,inactive,suspended]'],
        ];
    }

    private function accountForm(array $account = [], array $errors = [], bool $isEdit = false)
    {
        return view('home/form', ['account' => $account, 'errors' => $errors, 'is_edit' => $isEdit]);
    }

    private function findAccount($id): array
    {
        $id = filter_var($id, FILTER_VALIDATE_INT, ['options' => ['min_range' => 1]]);
        $account = $id !== false ? $this->customerModel->find($id) : null;

        if (!$account) {
            throw PageNotFoundException::forPageNotFound('Customer account not found.');
        }

        return $account;
    }

    private function scalarText($value): string
    {
        return is_scalar($value) ? trim((string) $value) : '';
    }
}

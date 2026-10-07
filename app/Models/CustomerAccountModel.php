<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerAccountModel extends Model
{
    protected $table = 'customer_accounts';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'account_number',
        'customer_name',
        'address',
        'phone',
        'email',
        'meter_number',
        'connection_type',
        'status',
    ];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    /** Group the OR search terms so status and type still restrict every match. */
    public function getFilteredAccounts($keyword = '', $status = '', $type = '', $perPage = 10, $page = 1)
    {
        if ($keyword !== '') {
            $this->groupStart()
                ->like('account_number', $keyword)
                ->orLike('customer_name', $keyword)
                ->orLike('email', $keyword)
                ->orLike('phone', $keyword)
                ->groupEnd();
        }

        if ($status !== '') {
            $this->where('status', $status);
        }

        if ($type !== '') {
            $this->where('connection_type', $type);
        }

        return $this->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')
            ->paginate($perPage, 'default', $page);
    }

    // Keep the professor's original convenience methods available.
    public function getAccountsPaginated($perPage = 10)
    {
        return $this->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')->paginate($perPage);
    }

    public function searchAccounts($keyword, $perPage = 10)
    {
        return $this->groupStart()
            ->like('account_number', $keyword)
            ->orLike('customer_name', $keyword)
            ->orLike('email', $keyword)
            ->orLike('phone', $keyword)
            ->groupEnd()
            ->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function getAccountsByStatus($status, $perPage = 10)
    {
        return $this->where('status', $status)
            ->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function getAccountsByType($type, $perPage = 10)
    {
        return $this->where('connection_type', $type)
            ->orderBy('created_at', 'DESC')->orderBy('id', 'DESC')
            ->paginate($perPage);
    }

    public function getTotalAccounts()
    {
        return $this->countAllResults();
    }

    public function getCountByStatus($status)
    {
        return $this->where('status', $status)->countAllResults();
    }
}

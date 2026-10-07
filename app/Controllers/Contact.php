<?php

namespace App\Controllers;

class Contact extends BaseController
{
    public function index()
    {
        $data = [
            'title'      => 'Contact Us - PowerFlow Electric',
            'page'       => 'contact',
            'success'    => session()->getFlashdata('success'),
            'error'      => session()->getFlashdata('error'),
            'validation' => session()->getFlashdata('validation')
        ];

        // Handle form submission
        if ($this->request->getMethod() === 'POST') {
            return $this->submitForm();
        }

        return view('contact', $data);
    }

    private function submitForm()
    {
        $validation = \Config\Services::validation();

        // Validation rules
        $validation->setRules([
            'name' => 'required|min_length[2]|max_length[100]',
            'email' => 'required|valid_email',
            'phone' => 'required|min_length[10]|max_length[20]',
            'service_type' => 'required',
            'message' => 'required|min_length[10]|max_length[1000]'
        ]);

        // Validate form
        if (!$validation->withRequest($this->request)->run()) {

            session()->setFlashdata(
                'validation',
                $validation->getErrors()
            );

            return redirect()->back()->withInput();
        }

        // Get form data
        $contactData = [
            'name'         => $this->request->getPost('name'),
            'email'        => $this->request->getPost('email'),
            'phone'        => $this->request->getPost('phone'),
            'service_type' => $this->request->getPost('service_type'),
            'message'      => $this->request->getPost('message'),
            'created_at'   => date('Y-m-d H:i:s')
        ];

        /*
         * In a real application:
         *
         * 1. Save $contactData to the database
         * 2. Send an email notification
         * 3. Send an auto-reply to the customer
         *
         * For now, we just show a success message.
         */

        session()->setFlashdata(
            'success',
            'Thank you for your message! We will contact you within 24 hours.'
        );

        return redirect()->to('/contact');
    }
}

<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    protected $helpers = ['form', 'url'];

    public function login()
    {
        if (session()->get('isLoggedIn') === true) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/login');
    }

    public function attempt()
    {
        $rules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Enter a valid email address and password.');
        }

        $email = trim((string) $this->request->getPost('email'));
        $password = (string) $this->request->getPost('password');

        $user = (new User())
            ->where('email', $email)
            ->where('user_type', 'admin')
            ->where('is_active', 1)
            ->first();

        if ($user === null || !password_verify($password, $user['password'])) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid email or password.');
        }

        session()->regenerate();

        session()->set([
            'isLoggedIn' => true,
            'user_id' => $user['id'],
            'user_name' => $user['first_name'] . ' ' . $user['last_name'],
        ]);

        return redirect()->to(site_url('dashboard'));
    }

    public function logout()
    {
        session()->destroy();

        return redirect()->to(site_url('login'))
            ->with('success', 'You have been logged out.');
    }
}
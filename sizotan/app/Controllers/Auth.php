<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Ambil input dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validasi login
        if ($username === 'admin' && $password === 'admin123') {
            // Login berhasil
            session()->set('isLoggedIn', true);
            session()->set('role', 'admin');
            return redirect()->to(base_url('backend'));
        } else {
            // Login gagal, tampilkan pesan error
            $data['error'] = 'Username atau Password salah';
            return view('login', $data);
        }
    }

    public function logout()
    {
        // Proses logout
        // ...
        session()->destroy(); // Hapus semua session setelah logout
        return redirect()->to(base_url('auth/login'));
    }

    public function checkPermission($role, $permission)
    {
        $permissions = config('Permissions')::$roles;

        if (array_key_exists($role, $permissions) && in_array($permission, $permissions[$role])) {
            return true;
        }

        return false;
    }
}

<?php

namespace App\Controllers;

use App\Models\D_login;

class Login extends BaseController
{
    public function index()
    {
        return view('login');
    }

    public function processLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new D_login();
        $user = $model->getByUsername($username);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Jika password benar, set session dan redirect ke halaman selanjutnya
                session()->set('isLoggedIn', true);
                session()->set('username', $user['username']);
                return redirect()->to('/dashboard');
            } else {
                // Jika password salah, tampilkan pesan kesalahan
                session()->setFlashdata('error', 'Password yang Anda masukkan salah.');
                return redirect()->back()->withInput();
            }
        } else {
            // Jika username tidak ditemukan, tampilkan pesan kesalahan
            session()->setFlashdata('error', 'Username yang Anda masukkan tidak ditemukan.');
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        // Hapus session dan redirect ke halaman login
        session()->remove('isLoggedIn');
        session()->remove('username');
        return redirect()->to('/login');
    }
}

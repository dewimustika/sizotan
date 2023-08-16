<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    // Definisikan metode untuk memeriksa kredensial pengguna
    public function checkCredentials($username, $password)
    {
        // Implementasikan logika verifikasi kredensial pengguna
        // ...
        return ($username === 'admin' && $password === 'admin123');
    }
}

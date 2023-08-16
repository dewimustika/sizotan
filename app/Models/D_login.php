<?php

namespace App\Models;

use CodeIgniter\Model;

class D_login extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'password'];

    public function getByUsername($username)
    {
        return $this->where('username', $username)->first();
    }
}

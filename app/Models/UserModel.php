<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'password'];

    // Bug #29: No validation rules
    protected $validationRules = [];

    // Bug #30: No date handling
    protected $useTimestamps = false;

    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            // Bug #31: Weak password hashing
            $data['data']['password'] = md5($data['data']['password']);
        }
        return $data;
    }
}

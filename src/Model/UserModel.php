<?php

namespace Nazdrave\Model;

use Slim\Container;

class UserModel extends BaseModel {

    protected $tableName = 'user';

    private function getPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public function login($email, $password) {
        $table = $this->db->table($this->tableName);
        $table->select('id', 'email', 'password', 'level');
        $table->where('email', $email);
        $user = $table->first();
        if ($user && password_verify($password, $user->password)) {
            unset($user->password);
            return $user;
        }
        return false;
    }

    public function register($email, $password) {
        $table = $this->db->table($this->tableName);
        return $table->insertGetId([
            'email' => $email,
            'password' => $this->getPassword($password)
        ]);
    }
}

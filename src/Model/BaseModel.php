<?php

namespace Nazdrave\Model;

use Slim\Container;

class BaseModel {

    protected $ci;
    protected $db;

    //Constructor
    public function __construct(Container $ci) {
        $this->ci = $ci;
        $this->db = $ci->get('db');
    }

    public function get($table, $id, $column = 'id') {
        return $this->db->table($table)->where($column, $id)->first();
    }

    public function getList($table) {
        return $this->db->table($table)->get();
    }
}

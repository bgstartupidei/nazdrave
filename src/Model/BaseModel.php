<?php

namespace Nazdrave\Model;

use Slim\Container;

class BaseModel {

    protected $ci;
    protected $db;
    protected $tableName;

    //Constructor
    public function __construct(Container $ci) {
        $this->ci = $ci;
        $this->db = $ci->get('db');
    }

    public function getTableName() {
        return $this->tableName;
    }

    public function get($table, $id, $column = 'id') {
        return $this->db->table($table)->where($column, $id)->first();
    }

    public function getList($table, $orderBy='id', $orderDirection='desc') {
        return $this->db->table($table)->orderBy($orderBy, $orderDirection)->get();
    }
}

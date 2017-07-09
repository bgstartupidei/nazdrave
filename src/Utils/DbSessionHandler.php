<?php

namespace Nazdrave\Utils;

class DbSessionHandler implements \SessionHandlerInterface
{

    const TABLE_NAME = 'php_session';

    public function __construct($container) {
        $this->db = $container->get('db');
    }

    public function close() {
        if (!empty($this->row)) {
            // perform garbage collection
            return $this->gc(ini_get('session.gc_maxlifetime'));
        }
        return false;
    }

    public function destroy ($session_id) {
        $this->db->table(self::TABLE_NAME)->where('session_id', $session_id)->delete();
        return true;
    }

    public function gc($maxlifetime) {
        $time = time() - $maxlifetime;
        $this->db->table(self::TABLE_NAME)->where('updated', '<', $time)->delete();
        return true;
    }

    public function open($save_path, $session_name) {
        return true;
    }

    public function read($session_id) {
        $this->row = (array)$this->db->table(self::TABLE_NAME)
            ->where('session_id', $session_id)->first();

        if ($this->row) {
            return $this->row['session_data'];
        } else {
            return '';
        }
    }

    public function write($session_id, $session_data) {
        if (!empty($this->row)) {
            if ($this->row['session_id'] != $session_id) {
                $this->row = array();
            }
        }

        $data = array(
            'updated' => time(),
            'session_data' => $session_data,
        );

        if (empty($this->row)) {
            // create new record
            $data['session_id'] = $session_id;
            $data['created'] = time();
            $this->db->table(self::TABLE_NAME)->insert($data);
            return true;
        }
        $this->db->table(self::TABLE_NAME)
            ->where('session_id', $session_id)
            ->update($data);
        return true;
    }
}

<?php

namespace App\Services;

class ExecSql {
    private \mysqli $db;
    public function __construct(\mysqli $db) {
         $this->db = $db;
    }
    public function query(string $sql) {
        return $this->db->query($sql);
    }
}
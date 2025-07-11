<?php

class Cabang_models
{

    private $table = 'tb_cabang';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCabang()
    {
        $this->db->query("SELECT * FROM {$this->table}");
        return $this->db->resultSet();
    }
}

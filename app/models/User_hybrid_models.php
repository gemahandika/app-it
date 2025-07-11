<?php

class User_hybrid_models
{

    private $table = 'user_hybrid';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllUserHybrid()
    {
        $sql = "SELECT * FROM " . $this->table . " ORDER BY id_hybrid DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_hybrid = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function addUser($data)
    {
        $query = "INSERT INTO {$this->table} (
        user_id,
        password,
        username,
        nik,
        cust_id,
        nama_counter,
        status
    ) VALUES (
        :user_id,
        :password,
        :username,
        :nik,
        :cust_id,
        :nama_counter,
        :status
    )";
        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind($key, $val);
        }
        try {
            $result = $this->db->execute();
            if (!$result) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Query gagal, tapi tidak ada error dari PDO.'
                ]);
                exit;
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan.'
            ]);
            exit;
        } catch (PDOException $e) {
            echo json_encode([
                'status' => 'error',
                'message' => 'PDO Error: ' . $e->getMessage()
            ]);
            exit;
        }
    }
    public function updateUserHybrid($data)
    {
        $query = "UPDATE {$this->table} SET 
            nama_counter = :nama_counter,
            user_id = :user_id,
            password = :password,
            username = :username,
            nik = :nik,
            cust_id = :cust_id,
            status = :status
          WHERE id_hybrid = :id_hybrid";
        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }
        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }
}

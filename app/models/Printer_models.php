<?php

class Printer_models
{
    private $table = 'tb_printer';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllPrinter()
    {
        $sql = "SELECT * FROM $this->table ORDER BY id_printer DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function addPrinter($data)
    {
        $query = "INSERT INTO {$this->table} (
        nama_counter,
        cust_id,
        type,
        serial_number,
        status,
        keterangan,
        date_distribusi,
        remaks
    ) VALUES (
        :nama_counter,
        :cust_id,
        :type,
        :serial_number,
        :status,
        :keterangan,
        :date_distribusi,
        :remaks
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
    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_printer = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function updatePrinter($data)
    {
        $query = "UPDATE $this->table SET 
            type = :type,
            serial_number = :serial_number,
            nama_counter = :nama_counter,
            cust_id = :cust_id,
            status = :status,
            keterangan = :keterangan,
            date_distribusi = :date_distribusi,
            remaks = :remaks
          WHERE id_printer = :id_printer";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }
}

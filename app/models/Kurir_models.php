<?php

class Kurir_models
{
    private $table = 'tb_sca';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllIdKurir()
    {
        $sql = "SELECT * FROM $this->table  ORDER BY id_sca DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function addKurir($data)
    {
        $query = "INSERT INTO {$this->table} (
        kurir_id,
        password_sca,
        fullname_sca,
        nik_sca,
        phone_sca,
        zona_sca,
        cabang_sca,
        status_sca,
        jobtask_sca
    ) VALUES (
        :kurir_id,
        :password_sca,
        :fullname_sca,
        :nik_sca,
        :phone_sca,
        :zona_sca,
        :cabang_sca,
        :status_sca,
        :jobtask_sca
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
        $this->db->query("SELECT * FROM $this->table WHERE id_sca = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function updateKurir($data)
    {
        $query = "UPDATE {$this->table} SET 
            kurir_id = :kurir_id,
            password_sca = :password_sca,
            fullname_sca = :fullname_sca,
            nik_sca = :nik_sca,
            phone_sca = :phone_sca,
            zona_sca = :zona_sca,
            cabang_sca = :cabang_sca,
            status_sca = :status_sca,
            jobtask_sca = :jobtask_sca
          WHERE id_sca = :id_sca";

        $this->db->query($query);
        foreach ($data as $key => $val) {
            $this->db->bind($key, $val);
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }









    public function getAllPrinterService()
    {
        $sql = "SELECT * FROM $this->table WHERE keterangan = 'di Service' ORDER BY date_service ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function getAllPrintKembali()
    {
        $sql = "SELECT * FROM $this->table WHERE keterangan = 'di Kembalikan' ORDER BY date_terima ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function getBySerialNumber($serial_number)
    {
        $this->db->query("SELECT * FROM $this->table WHERE serial_number = :serial_number");
        $this->db->bind('serial_number', $serial_number);
        return $this->db->single();
    }
    public function distribusiPrinter($data)
    {
        $query = "UPDATE {$this->table} SET 
            nama_counter = :nama_counter,
            cust_id = :cust_id,
            keterangan = :keterangan,
            date_distribusi = :date_distribusi,
            remaks = :remaks
          WHERE serial_number = :serial_number";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }
    public function addPrinterService($data)
    {
        $query = "UPDATE $this->table SET 
            keterangan = :keterangan,
            date_service = :date_service,
            remaks = :remaks
          WHERE serial_number = :serial_number";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }


    public function updatePrinterService($data)
    {
        $query = "UPDATE {$this->table} SET 
            type = :type,
            serial_number = :serial_number,
            nama_counter = :nama_counter,
            cust_id = :cust_id,
            status = :status,
            keterangan = :keterangan,
            date_service = :date_service,
            date_terima = :date_terima,
            remaks = :remaks
          WHERE id_printer = :id_printer";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }

    public function getAllPrinterStok()
    {
        $sql = "SELECT * FROM $this->table WHERE keterangan = 'Stok' ORDER BY id_printer DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}

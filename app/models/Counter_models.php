<?php

class Counter_models
{
    private $table = 'tb_counter';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }
    public function getAllCounter()
    {
        $sql = "SELECT * FROM $this->table WHERE status !='TUTUP' ORDER BY id_counter DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function getByNamaCounter($nama)
    {
        $this->db->query("SELECT * FROM $this->table WHERE nama_counter = :nama_counter");
        $this->db->bind('nama_counter', $nama);
        return $this->db->single();
    }


    public function countSystemHybrid()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM $this->table WHERE sistem = :sistem");
        $this->db->bind(':sistem', 'HYBRID');
        return $this->db->single(); // Ambil hasil COUNT-nya langsung
    }
    public function countSystemMec()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM $this->table WHERE sistem = :sistem");
        $this->db->bind(':sistem', 'MEC');
        return $this->db->single(); // Ambil hasil COUNT-nya langsung
    }
    public function countSystemOffline()
    {
        $this->db->query("SELECT COUNT(*) AS total FROM $this->table WHERE sistem = :sistem");
        $this->db->bind(':sistem', 'OFFLINE');
        return $this->db->single(); // Ambil hasil COUNT-nya langsung
    }
    public function getDistinctKategori()
    {
        $sql = "SELECT DISTINCT kategori FROM " . $this->table . " WHERE kategori IS NOT NULL ORDER BY kategori ASC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
    public function insert($data)
    {
        $query = "INSERT INTO tb_counter (
        kategori, cabang_counter, nama_counter, cust_id, pic, phone,
        sistem, printer, datekey, status
    ) VALUES (
        :kategori, :cabang_counter, :nama_counter, :cust_id, :pic, :phone,
        :sistem, :printer, :datekey, :status
    )";

        $this->db->query($query);

        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }
        return $this->db->execute();
    }
    public function addCounter($data)
    {
        $query = "INSERT INTO {$this->table} (
        kategori,
        cabang_counter,
        nama_counter,
        cust_id,
        pic,
        phone,
        sistem,
        printer,
        datekey,
        status
    ) VALUES (
        :kategori,
        :cabang_counter,
        :nama_counter,
        :cust_id,
        :pic,
        :phone,
        :sistem,
        :printer,
        :datekey,
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
    public function getById($id)
    {
        $this->db->query("SELECT * FROM $this->table WHERE id_counter = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
    public function updateCounter($data)
    {
        $query = "UPDATE {$this->table} SET 
            kategori = :kategori,
            cabang_counter = :cabang_counter,
            nama_counter = :nama_counter,
            cust_id = :cust_id,
            pic = :pic,
            phone = :phone,
            sistem = :sistem,
            printer = :printer,
            datekey = :datekey,
            status = :status
          WHERE id_counter = :id_counter";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }
    public function updateCounterTutup($data)
    {
        $query = "UPDATE {$this->table} SET 
            tgl_tutup = :tgltutup,
            ket_tutup = :kettutup,
            status = :status
          WHERE id_counter = :id_counter";

        $this->db->query($query);

        foreach ($data as $key => $val) {
            $this->db->bind($key, $val); // ✅ benar: tanpa titik dua
        }

        return $this->db->execute(); // pastikan ini ada untuk menjalankan query
    }
    public function getAllCounterTutup()
    {
        $sql = "SELECT * FROM $this->table WHERE status = 'TUTUP' ORDER BY id_counter DESC";
        $this->db->query($sql);
        return $this->db->resultSet();
    }
}

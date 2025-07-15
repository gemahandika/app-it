<?php

class Counter extends Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }
    }
    public function index()
    {
        $data['judul'] = 'Counter';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['counter'] = $this->model('Counter_models')->getAllCounter();
        $data['cabang'] = $this->model('Cabang_models')->getAllCabang();
        // Load view
        $this->view('templates/header', $data);
        $this->view('counter/index', $data);
        $this->view('templates/footer');
    }
    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'kategori' => $_POST['kategori'],
                'cabang_counter' => $_POST['cabang_counter'],
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
                'pic' => $_POST['pic'],
                'phone' => $_POST['phone'],
                'sistem' => $_POST['sistem'],
                'printer' => $_POST['printer'],
                'datekey' => $_POST['datekey'],
                'status' => $_POST['status']
            ];

            if ($this->model('Counter_models')->addCounter($data) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            }

            header('Location: ' . BASE_URL . '/counter');
            exit;
        }
    }
    public function getCounterById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_counter'];
            $data = $this->model('Counter_models')->getById($id);

            // Pastikan datanya bisa di-encode
            if (!$data) {
                http_response_code(404);
                echo json_encode(['error' => 'Data tidak ditemukan']);
                exit;
            }

            header('Content-Type: application/json');
            echo json_encode($data, JSON_INVALID_UTF8_IGNORE);
            exit;
        }
    }
    public function edit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_counter' => $_POST['id_counter'],
                'kategori' => $_POST['kategori'],
                'cabang_counter' => $_POST['cabang_counter'],
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
                'pic' => $_POST['pic'],
                'phone' => $_POST['phone'],
                'sistem' => $_POST['sistem'],
                'printer' => $_POST['printer'],
                'datekey' => $_POST['datekey'],
                'status' => $_POST['status']
            ];

            if ($this->model('Counter_models')->updateCounter($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }

            header('Location: ' . BASE_URL . '/counter');
            exit;
        }
    }
    public function import()
    {
        if (isset($_FILES['file_excel']) && $_FILES['file_excel']['error'] === 0) {
            $tmpFile = $_FILES['file_excel']['tmp_name'];

            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($tmpFile);
            $spreadsheet = $reader->load($tmpFile);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            $sukses = 0;
            $gagal = 0;

            foreach (array_slice($rows, 1) as $index => $row) {
                $barisExcel = $index + 2;

                $data = [
                    'kategori' => $row[0] ?? '',
                    'cabang_counter' => $row[1] ?? '',
                    'nama_counter' => $row[2] ?? '',
                    'cust_id' => $row[3] ?? '',
                    'pic' => $row[4] ?? '',
                    'phone' => $row[5] ?? '',
                    'sistem' => $row[6] ?? '',
                    'printer' => $row[7] ?? '',
                    'datekey' => $row[8] ?? '',
                    'status' => $row[9] ?? ''
                ];


                // 🚀 Simpan ke database
                if ($this->model('Counter_models')->insert($data)) {
                    $sukses++;
                } else {
                    $gagal++;
                    error_log("❌ Gagal insert data ke-{$barisExcel}: " . json_encode($data));
                }
            }

            Flasher::setFlash("Upload selesai: {$sukses} baris berhasil", "{$gagal} baris gagal diproses", 'success');
        } else {
            Flasher::setFlash('Gagal', 'Upload file Excel bermasalah.', 'danger');
        }

        error_log('✅ Import selesai dijalankan');
        header('Location: ' . BASE_URL . '/counter');
        exit;
    }
    public function export()
    {
        $counter = $this->model('Counter_models')->getAllCounter();

        header("Content-type: application/vnd-ms-excel");
        header("Content-Disposition: attachment; filename=Data_Agen_Kp_" . date('Ymd_His') . ".xls");

        echo '<table border="1">';
        echo '<thead><tr>
        <th>No</th>
        <th>Kategori</th>
        <th>Cabang</th>
        <th>Nama Agen / KP</th>
        <th>CustID</th>
        <th>Pic</th>
        <th>Phone</th>
        <th>Sistem</th>
        <th>Printer</th>
        <th>Datekey ID</th>
        <th>Status</th>
    </tr></thead><tbody>';

        $no = 1;
        foreach ($counter as $row) {
            echo '<tr>
            <td>' . ($no++) . '</td>
            <td>' . $row['kategori'] . '</td>
            <td>' . $row['cabang_counter'] . '</td>
            <td>' . $row['nama_counter'] . '</td>
            <td>' . $row['cust_id'] . '</td>
            <td>' . $row['pic'] . '</td>
            <td>' . $row['phone'] . '</td>
            <td>' . $row['sistem'] . '</td>
            <td>' . $row['printer'] . '</td>
            <td>' . $row['datekey'] . '</td>
            <td>' . $row['status'] . '</td>
        </tr>';
        }
        echo '</table>';
        exit;
    }
    public function tutup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_counter' => $_POST['id_counter'],
                'tgltutup' => $_POST['tgltutup'],
                'kettutup' => $_POST['kettutup'],
                'status' => 'TUTUP'
            ];
            if ($this->model('Counter_models')->updateCounterTutup($data) > 0) {
                Flasher::setFlash('berhasil', 'ditutup', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditutup', 'danger');
            }

            header('Location: ' . BASE_URL . '/counter');
            exit;
        }
    }
}

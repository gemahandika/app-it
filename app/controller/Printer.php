<?php
class Printer extends Controller
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
        $data['judul'] = 'Printer';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['printer'] = $this->model('Printer_models')->getAllPrinter();
        $data['counter'] = $this->model('Counter_models')->getAllCounter();
        $data['cabang'] = $this->model('Cabang_models')->getAllCabang();
        // Load view
        $this->view('templates/header', $data);
        $this->view('printer/index', $data);
        $this->view('templates/footer');
    }
    public function getCounterByNama()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nama = $_POST['nama_counter'];
            $data = $this->model('Counter_models')->getByNamaCounter($nama);

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
    public function getPrinterById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_printer'];
            $data = $this->model('Printer_models')->getById($id);

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
    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'type' => $_POST['type'],
                'serial_number' => $_POST['serial_number'],
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
                'status' => $_POST['status'],
                'keterangan' => $_POST['keterangan'],
                'date_distribusi' => $_POST['date_distribusi'],
                'remaks' => $_POST['remaks']
            ];

            if ($this->model('Printer_models')->addPrinter($data) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            }

            header('Location: ' . BASE_URL . '/printer');
            exit;
        }
    }
    public function edit()
    {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_printer ' => $_POST['id_printer '],
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
                'type' => $_POST['type'],
                'serial_number' => $_POST['serial_number'],
                'status' => $_POST['status'],
                'keterangan' => $_POST['keterangan'],
                'date_distribusi' => $_POST['date_distribusi'],
                'remaks' => $_POST['remaks']
            ];

            if ($this->model('Printer_models')->updatePrinter($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }

            header('Location: ' . BASE_URL . '/printer');
            exit;
        }
    }
}

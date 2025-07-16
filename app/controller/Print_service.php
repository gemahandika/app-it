<?php
class Print_service extends Controller
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
        $data['sn'] = $this->model('Printer_models')->getAllPrinter();
        $data['printer'] = $this->model('Printer_models')->getAllPrinterService();
        $data['cabang'] = $this->model('Cabang_models')->getAllCabang();
        // Load view
        $this->view('templates/header', $data);
        $this->view('print_service/index', $data);
        $this->view('templates/footer');
    }
    public function getPrinterBysn()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $serial_number = $_POST['serial_number'];
            $data = $this->model('Printer_models')->getBySerialNumber($serial_number);

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
                'keterangan' => 'di Service',
                'serial_number' => $_POST['serial_number'],
                'date_service' => $_POST['date_service'],
                'remaks' => $_POST['remaks']
            ];

            if ($this->model('Printer_models')->addPrinterService($data) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            }

            header('Location: ' . BASE_URL . '/print_service');
            exit;
        }
    }











    // public function getCounterById()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id_counter'];
    //         $data = $this->model('Counter_models')->getById($id);

    //         // Pastikan datanya bisa di-encode
    //         if (!$data) {
    //             http_response_code(404);
    //             echo json_encode(['error' => 'Data tidak ditemukan']);
    //             exit;
    //         }

    //         header('Content-Type: application/json');
    //         echo json_encode($data, JSON_INVALID_UTF8_IGNORE);
    //         exit;
    //     }
    // }
    // public function getPrinterById()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id_printer'];
    //         $data = $this->model('Printer_models')->getById($id);

    //         // Pastikan datanya bisa di-encode
    //         if (!$data) {
    //             http_response_code(404);
    //             echo json_encode(['error' => 'Data tidak ditemukan']);
    //             exit;
    //         }

    //         header('Content-Type: application/json');
    //         echo json_encode($data, JSON_INVALID_UTF8_IGNORE);
    //         exit;
    //     }
    // }

    // public function editPrinter()
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $data = [
    //             'id_printer' => $_POST['id_printer'],
    //             'type' => $_POST['type'],
    //             'serial_number' => $_POST['serial_number'],
    //             'nama_counter' => $_POST['nama_counter'],
    //             'cust_id' => $_POST['cust_id'],
    //             'status' => $_POST['status'],
    //             'keterangan' => $_POST['keterangan'],
    //             'date_distribusi' => $_POST['date_distribusi'],
    //             'remaks' => $_POST['remaks']
    //         ];

    //         if ($this->model('Printer_models')->updatePrinter($data) > 0) {
    //             Flasher::setFlash('berhasil', 'diupdate', 'success');
    //         } else {
    //             Flasher::setFlash('gagal', 'diupdate', 'danger');
    //         }

    //         header('Location: ' . BASE_URL . '/printer');
    //         exit;
    //     }
    // }
}

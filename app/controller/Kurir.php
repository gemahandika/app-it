<?php
class kurir extends Controller
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
        $data['judul'] = 'Id Kurir';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['id_kurir'] = $this->model('Kurir_models')->getAllIdKurir();
        $data['counter'] = $this->model('Counter_models')->getAllCounter();
        $data['cabang'] = $this->model('Cabang_models')->getAllCabang();
        // Load view
        $this->view('templates/header', $data);
        $this->view('kurir/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'kurir_id' => $_POST['kurir_id'],
                'password_sca' => $_POST['password_sca'],
                'fullname_sca' => $_POST['fullname_sca'],
                'nik_sca' => $_POST['nik_sca'],
                'phone_sca' => $_POST['phone_sca'],
                'zona_sca' => $_POST['zona_sca'],
                'cabang_sca' => $_POST['cabang_sca'],
                'status_sca' => $_POST['status_sca'],
                'jobtask_sca' => $_POST['jobtask_sca']
            ];

            if ($this->model('Kurir_models')->addKurir($data) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            }

            header('Location: ' . BASE_URL . '/kurir');
            exit;
        }
    }
    public function getKurirById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_sca'];
            $data = $this->model('Kurir_models')->getById($id);

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
                'id_sca' => $_POST['id_sca'],
                'kurir_id' => $_POST['kurir_id'],
                'password_sca' => $_POST['password_sca'],
                'fullname_sca' => $_POST['fullname_sca'],
                'nik_sca' => $_POST['nik_sca'],
                'phone_sca' => $_POST['phone_sca'],
                'zona_sca' => $_POST['zona_sca'],
                'cabang_sca' => $_POST['cabang_sca'],
                'status_sca' => $_POST['status_sca'],
                'jobtask_sca' => $_POST['jobtask_sca']
            ];

            if ($this->model('Kurir_models')->updateKurir($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }

            header('Location: ' . BASE_URL . '/printer');
            exit;
        }
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

    public function editPrinter()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_printer' => $_POST['id_printer'],
                'type' => $_POST['type'],
                'serial_number' => $_POST['serial_number'],
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
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

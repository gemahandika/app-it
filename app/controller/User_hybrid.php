<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;


class User_hybrid extends Controller
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
        $data['judul'] = 'User Hybrid';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['user_hybrid'] = $this->model('User_hybrid_models')->getAllUserHybrid();
        $data['counter'] = $this->model('Counter_models')->getAllCounter();
        // $data['list_usia'] = $this->model('Karyawan_resign_models')->getDistinctUsiaResign();
        // $data['list_gen'] = $this->model('Karyawan_resign_models')->getDistinctGenResign();
        // $data['list_section'] = $this->model('Karyawan_resign_models')->getDistinctSectionResign();
        // view
        $this->view('templates/header', $data);
        $this->view('user_hybrid/index', $data);
        $this->view('templates/footer');
    }
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'nama_counter' => $_POST['nama_counter'],
                'cust_id' => $_POST['cust_id'],
                'username' => $_POST['username'],
                'user_id' => $_POST['user_id'],
                'password' => $_POST['password'],
                'nik' => $_POST['nik'],
                'status' => $_POST['status']
            ];

            if ($this->model('User_hybrid_models')->addUser($data) > 0) {
                Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            } else {
                Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            }

            header('Location: ' . BASE_URL . '/counter');
            exit;
        }
    }
    public function getUserHybridById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_hybrid'];
            $data = $this->model('User_hybrid_models')->getById($id);

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
    public function editUserHybrid()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_hybrid' => $_POST['id_hybrid'],
                'nama_counter' => $_POST['nama_counter'],
                'user_id' => $_POST['user_id'],
                'password' => $_POST['password'],
                'username' => $_POST['username'],
                'nik' => $_POST['nik'],
                'cust_id' => $_POST['cust_id'],
                'status' => $_POST['status']
            ];
            if ($this->model('User_hybrid_models')->updateUserHybrid($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }
            header('Location: ' . BASE_URL . '/user_hybrid');
            exit;
        }
    }
}

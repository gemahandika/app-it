<?php

class Counter_tutup extends Controller
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
        $data['judul'] = 'Counter Tutup';
        // Ambil data session user
        $data['name'] = $_SESSION['name'] ?? '';
        $data['username'] = $_SESSION['username'] ?? '';
        $data['userRole'] = $_SESSION['role'] ?? '';
        // Data Filter
        $data['counter_tutup'] = $this->model('Counter_models')->getAllCounterTutup();
        // view
        $this->view('templates/header', $data);
        $this->view('counter_tutup/index', $data);
        $this->view('templates/footer');
    }

    public function getCounterTutupById()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id_counter'];

            // Panggil dari model
            $data = $this->model('Counter_models')->getById($id);

            // Kirim data sebagai JSON
            echo json_encode($data);
        }
    }

    public function editCounterTutup()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'id_counter' => $_POST['id_counter'],
                'tgltutup' => $_POST['tgl_tutup'],
                'kettutup' => $_POST['ket_tutup'],
                'status' => $_POST['status']
            ];
            if ($this->model('Counter_models')->updateCounterTutup($data) > 0) {
                Flasher::setFlash('berhasil', 'diupdate', 'success');
            } else {
                Flasher::setFlash('gagal', 'diupdate', 'danger');
            }
            header('Location: ' . BASE_URL . '/counter_tutup');
            exit;
        }
    }
}

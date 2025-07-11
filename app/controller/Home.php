<?php
require_once '../app/core/Flasher.php';
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);

class Home extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['login'])) {
            header('Location: ' . BASE_URL . '/auth');
            exit;
        }

        $data['judul'] = 'Home';
        $data['userRole'] = $_SESSION['role'];
        $data['username'] = $_SESSION['username'];
        $data['name'] = $_SESSION['name'];

        // load data
        $data['counter'] = $this->model('Counter_models')->getAllCounter();
        $data['totalHybrid'] = $this->model('Counter_models')->countSystemHybrid()['total'];
        $data['totalMec'] = $this->model('Counter_models')->countSystemMec()['total'];
        $data['totalOffline'] = $this->model('Counter_models')->countSystemOffline()['total'];
        $data['kategori'] = $this->model('Counter_models')->getDistinctKategori();

        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}

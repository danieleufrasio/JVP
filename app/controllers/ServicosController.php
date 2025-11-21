<?php

require_once __DIR__ . '/../models/Servico.php';

class ServicoController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function index() {
        $this->checkAuth();
        $servicos = Servico::all();
        require_once __DIR__ . '/../views/dashboard/servicos.php';
    }

    public function create() {
        $this->checkAuth();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'imagem' => ''
            ];
            if (!empty($_FILES['imagem']['tmp_name'])) {
                $dados['imagem'] = $_FILES['imagem']['name'];
                move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../../public/img/' . $dados['imagem']);
            }
            Servico::create($dados);
            header('Location: ' . BASE_URL . 'dashboard/servicos');
            exit;
        }
        require_once __DIR__ . '/../views/dashboard/servicos_form.php';
    }

    public function edit($id) {
        $this->checkAuth();
        $servico = Servico::find($id);
        if (!$servico) {
            header('Location: ' . BASE_URL . 'dashboard/servicos');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'imagem' => $servico['imagem']
            ];
            if (!empty($_FILES['imagem']['tmp_name'])) {
                $dados['imagem'] = $_FILES['imagem']['name'];
                move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../../public/img/' . $dados['imagem']);
            }
            Servico::update($id, $dados);
            header('Location: ' . BASE_URL . 'dashboard/servicos');
            exit;
        }
        require_once __DIR__ . '/../views/dashboard/servicos_form.php';
    }

    public function delete($id) {
        $this->checkAuth();
        Servico::delete($id);
        header('Location: ' . BASE_URL . 'dashboard/servicos');
        exit;
    }

    private function checkAuth() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION['colaborador']) || empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }
}

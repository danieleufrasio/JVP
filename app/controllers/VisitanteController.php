<?php
if (session_status() === PHP_SESSION_NONE) session_start();

require_once __DIR__ . '/../config/db.php';
require_once __DIR__ . '/../models/VisitanteModel.php';

class VisitanteController
{
    protected $model;

    public function __construct($pdo)
    {
        $this->model = new VisitanteModel($pdo);
    }

    public function home()
    {
        $recentes = $this->model->listarComentariosRecentes();
        require_once __DIR__ . '/../views/home.php';
    }

    public function enviarComentario()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comentario = filter_input(INPUT_POST, 'comentario', FILTER_SANITIZE_SPECIAL_CHARS);
            $nota       = isset($_POST['nota']) ? intval($_POST['nota']) : null;

            if (isset($_SESSION['colaborador'])) {
                $nome  = $_SESSION['colaborador']['nome'] ?? '';
                $email = $_SESSION['colaborador']['email'] ?? '';
                $foto  = $_SESSION['colaborador']['photo'] ?? null;
            } else {
                $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $foto  = null;
            }

            if (!$nome || !$email || !$comentario || !$nota || $nota < 1 || $nota > 5) {
                http_response_code(400);
                echo 'Dados inválidos.';
                exit;
            }

            if (!isset($_POST['token']) || $_POST['token'] !== ($_SESSION['token_comentario'] ?? '')) {
                http_response_code(403);
                echo 'Token inválido.';
                exit;
            }
            unset($_SESSION['token_comentario']);

            if ($this->model->add($nome, $email, $comentario, $nota, $foto)) {
                header('Location: ' . BASE_URL . 'home');
                exit;
            }
            http_response_code(500);
            echo 'Erro ao salvar comentário.';
            exit;
        }
    }
}

<?php
require_once __DIR__ . '/../models/Obra.php';
require_once __DIR__ . '/../models/Cliente.php';

class ObrasController
{
    public function index() {
        $obras = Obra::all();
        require_once __DIR__ . '/../views/dashboard/obras/index.php';
    }

    public function novo() {
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo' => htmlspecialchars($_POST['codigo'] ?? ''),
                    'nome' => htmlspecialchars($_POST['nome'] ?? ''),
                    'clienteid' => (int)($_POST['clienteid'] ?? 0),
                    'endereco' => htmlspecialchars($_POST['endereco'] ?? ''),
                    'status' => htmlspecialchars($_POST['status'] ?? ''),
                    'dataconclusao' => $_POST['dataconclusao'] ?? null
                ];
                if (Obra::create($dados)) {
                    $_SESSION['success'] = "Obra cadastrada com sucesso!";
                    header('Location: ' . BASE_URL . 'obras');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar obra!";
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/novo.php';
    }

    public function editar($id) {
        $obra = Obra::find($id);
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/editar.php';
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'codigo' => htmlspecialchars($_POST['codigo'] ?? ''),
                    'nome' => htmlspecialchars($_POST['nome'] ?? ''),
                    'clienteid' => (int)($_POST['clienteid'] ?? 0),
                    'endereco' => htmlspecialchars($_POST['endereco'] ?? ''),
                    'status' => htmlspecialchars($_POST['status'] ?? ''),
                    'dataconclusao' => $_POST['dataconclusao'] ?? null
                ];
                if (Obra::update($id, $dados)) {
                    $_SESSION['success'] = "Obra atualizada com sucesso!";
                    header('Location: ' . BASE_URL . 'obras');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar obra!";
                }
            }
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
        }
        $obra = Obra::find($id);
        $clientes = Cliente::all();
        require_once __DIR__ . '/../views/dashboard/obras/editar.php';
    }

    public function excluir($id) {
        if (Obra::delete($id)) {
            $_SESSION['success'] = "Obra excluída com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir obra!";
        }
        header('Location: ' . BASE_URL . 'obras');
        exit;
    }

    public function pesquisarAjax() {
        header('Content-Type: application/json; charset=utf-8');
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        $obras = (empty($termo)) ? Obra::all() : Obra::search($termo);
        echo json_encode($obras);
        exit;
    }
}

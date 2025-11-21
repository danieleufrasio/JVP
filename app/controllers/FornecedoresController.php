<?php
require_once __DIR__ . '/../models/Fornecedor.php';

class FornecedoresController
{
    public function index()
    {
        $fornecedores = Fornecedor::all();
        require_once __DIR__ . '/../views/dashboard/fornecedores/index.php';
    }

    public function novo()
    {
        require_once __DIR__ . '/../views/dashboard/fornecedores/novo.php';
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'codigo'     => htmlspecialchars(trim($_POST['codigo'] ?? '')),
                'fornecedor' => htmlspecialchars(trim($_POST['fornecedor'] ?? '')),
                'status'     => htmlspecialchars(trim($_POST['status'] ?? '')),
                'descricao'  => htmlspecialchars(trim($_POST['descricao'] ?? '')),
            ];

            if (Fornecedor::create($dados)) {
                $_SESSION['success'] = "Fornecedor criado com sucesso!";
                header('Location: ' . BASE_URL . 'fornecedores');
                exit();
            } else {
                $_SESSION['error'] = "Erro ao criar fornecedor!";
            }
        }

        require_once __DIR__ . '/../views/dashboard/fornecedores/novo.php';
    }

    public function editar(int $id)
    {
        $fornecedor = Fornecedor::find($id);
        if (!$fornecedor) {
            $_SESSION['error'] = "Fornecedor não encontrado!";
            header('Location: ' . BASE_URL . 'fornecedores');
            exit();
        }
        require_once __DIR__ . '/../views/dashboard/fornecedores/editar.php';
    }

    public function atualizar(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'codigo'     => htmlspecialchars(trim($_POST['codigo'] ?? '')),
                'fornecedor' => htmlspecialchars(trim($_POST['fornecedor'] ?? '')),
                'status'     => htmlspecialchars(trim($_POST['status'] ?? '')),
                'descricao'  => htmlspecialchars(trim($_POST['descricao'] ?? '')),
            ];

            if (Fornecedor::update($id, $dados)) {
                $_SESSION['success'] = "Fornecedor atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'fornecedores');
                exit();
            } else {
                $_SESSION['error'] = "Erro ao atualizar fornecedor!";
            }
        }

        $fornecedor = Fornecedor::find($id);
        if (!$fornecedor) {
            $_SESSION['error'] = "Fornecedor não encontrado!";
            header('Location: ' . BASE_URL . 'fornecedores');
            exit();
        }
        require_once __DIR__ . '/../views/dashboard/fornecedores/editar.php';
    }

    public function excluir(int $id)
    {
        if (Fornecedor::delete($id)) {
            $_SESSION['success'] = "Fornecedor excluído com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir fornecedor!";
        }
        header('Location: ' . BASE_URL . 'fornecedores');
        exit();
    }

    public function pesquisar()
    {
        $fornecedores = [];
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
        if ($termo) {
            $fornecedores = Fornecedor::search($termo);
        } else {
            $fornecedores = Fornecedor::all();
        }
        require_once __DIR__ . '/../views/dashboard/fornecedores/index.php';
    }
}

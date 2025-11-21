<?php
require_once __DIR__ . '/../models/Cargo.php';

class CargosController
{
    public function __construct()
    {
        // Iniciar sessão se ainda não começou
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->checkAuth();
    }

    // Método para proteger as rotas, garantindo que usuário esteja logado
    private function checkAuth()
    {
        if (empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }

    // Listar todos os cargos
    public function index()
    {
        $cargos = Cargo::all();
        require_once __DIR__ . '/../views/dashboard/cargos/index.php';
    }

    // Formulário para criar novo cargo
    public function novo()
    {
        require_once __DIR__ . '/../views/dashboard/cargos/novo.php';
    }

    // Salvar o novo cargo (POST)
    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');

            if (empty($nome)) {
                $_SESSION['error'] = "O nome do cargo é obrigatório.";
                require_once __DIR__ . '/../views/dashboard/cargos/novo.php';
                return;
            }

            if (Cargo::create(['nome' => $nome])) {
                $_SESSION['success'] = "Cargo criado com sucesso!";
                header('Location: ' . BASE_URL . 'cargos');
                exit;
            } else {
                $_SESSION['error'] = "Erro ao criar o cargo.";
                require_once __DIR__ . '/../views/dashboard/cargos/novo.php';
            }
        } else {
            // Se não for POST, redireciona para index
            header('Location: ' . BASE_URL . 'cargos');
            exit;
        }
    }

    // Formulário para editar um cargo existente
    public function editar(int $id)
    {
        $cargo = Cargo::find($id);

        if (!$cargo) {
            $_SESSION['error'] = "Cargo não encontrado.";
            header('Location: ' . BASE_URL . 'cargos');
            exit;
        }

        require_once __DIR__ . '/../views/dashboard/cargos/editar.php';
    }

    // Atualizar cargo (POST)
    public function atualizar(int $id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = trim($_POST['nome'] ?? '');

            if (empty($nome)) {
                $_SESSION['error'] = "O nome do cargo é obrigatório.";
                $cargo = Cargo::find($id);
                require_once __DIR__ . '/../views/dashboard/cargos/editar.php';
                return;
            }

            if (Cargo::update($id, ['nome' => $nome])) {
                $_SESSION['success'] = "Cargo atualizado com sucesso!";
                header('Location: ' . BASE_URL . 'cargos');
                exit;
            } else {
                $_SESSION['error'] = "Erro ao atualizar o cargo.";
                $cargo = Cargo::find($id);
                require_once __DIR__ . '/../views/dashboard/cargos/editar.php';
            }
        } else {
            // Se não for POST, redireciona
            header('Location: ' . BASE_URL . 'cargos');
            exit;
        }
    }

    // Excluir cargo
    public function excluir(int $id)
    {
        if (Cargo::delete($id)) {
            $_SESSION['success'] = "Cargo removido com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao remover o cargo.";
        }
        header('Location: ' . BASE_URL . 'cargos');
        exit;
    }
}

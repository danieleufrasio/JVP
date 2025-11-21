<?php
require_once __DIR__ . '/../models/Prancha.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Obra.php';
require_once __DIR__ . '/../models/TipoProjeto.php';
require_once __DIR__ . '/../models/Elemento.php';
require_once __DIR__ . '/../models/Pavimento.php';
require_once __DIR__ . '/../models/TipoPapel.php';
require_once __DIR__ . '/../models/Colaborador.php';

class PranchasController
{
    public function index()
    {
        $pranchas = Prancha::all();
        require __DIR__ . '/../views/dashboard/pranchas/index.php';
    }

    public function novo()
    {
        $clientes = Cliente::all();
        $obras = Obra::all();
        $tiposProjeto = TipoProjeto::all();
        $elementos = Elemento::all();
        $pavimentos = Pavimento::all();
        $tiposPapel = TipoPapel::all();
        $colaboradores = Colaborador::all();

        require __DIR__ . '/../views/dashboard/pranchas/novo.php';
    }

    public function editar($id)
    {
        $prancha = Prancha::find($id);
        $clientes = Cliente::all();
        $obras = Obra::all();
        $tiposProjeto = TipoProjeto::all();
        $elementos = Elemento::all();
        $pavimentos = Pavimento::all();
        $tiposPapel = TipoPapel::all();
        $colaboradores = Colaborador::all();

        require __DIR__ . '/../views/dashboard/pranchas/editar.php';
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = $_POST;
            $sucesso = Prancha::create($dados);

            if ($sucesso) {
                $_SESSION['success'] = "Prancha criada com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao salvar prancha.";
            }
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        }
    }

    public function atualizar($id = null)
    {
        if (!$id && isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dados = $_POST;
            $sucesso = Prancha::update($id, $dados);

            if ($sucesso) {
                $_SESSION['success'] = "Prancha atualizada com sucesso!";
            } else {
                $_SESSION['error'] = "Erro ao atualizar prancha.";
            }
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        } else {
            $_SESSION['error'] = "ID inválido ou método inválido.";
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        }
    }

    public function excluir($id = null)
    {
        if (!$id && isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        if (!$id && isset($_POST['id'])) {
            $id = $_POST['id'];
        }
        if ($id) {
            $sucesso = Prancha::delete($id);
            if ($sucesso) {
                $_SESSION['success'] = "Prancha excluída com sucesso.";
            } else {
                $_SESSION['error'] = "Erro ao excluir prancha.";
            }
        } else {
            $_SESSION['error'] = "ID inválido para exclusão.";
        }
        header('Location: ' . BASE_URL . 'pranchas');
        exit;
    }

    public function alterarStatus($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $novoStatus = $_POST['status'] ?? 'pendente';
            $sucesso = Prancha::updateStatus($id, $novoStatus);

            if ($sucesso) {
                $_SESSION['success'] = "Status da prancha alterado com sucesso.";
            } else {
                $_SESSION['error'] = "Erro ao alterar status da prancha.";
            }
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        } else {
            $_SESSION['error'] = "Método inválido.";
            header('Location: ' . BASE_URL . 'pranchas');
            exit;
        }
    }

    public function pesquisar()
    {
        // Pode adaptar para GET ou POST conforme seu form (GET = action do exemplo do index.php).
        $termo = $_GET['q'] ?? ($_POST['termo'] ?? '');
        if ($termo !== '') {
            $pranchas = Prancha::search($termo);
            require __DIR__ . '/../views/dashboard/pranchas/index.php';
        } else {
            $this->index();
        }
    }
}

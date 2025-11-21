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

            $_SESSION[$sucesso ? 'success' : 'error'] = $sucesso ?
                "Prancha criada com sucesso!" :
                "Erro ao salvar prancha.";
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

            $_SESSION[$sucesso ? 'success' : 'error'] = $sucesso ?
                "Prancha atualizada com sucesso!" :
                "Erro ao atualizar prancha.";
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
            $_SESSION[$sucesso ? 'success' : 'error'] = $sucesso ?
                "Prancha excluída com sucesso." :
                "Erro ao excluir prancha.";
        } else {
            $_SESSION['error'] = "ID inválido para exclusão.";
        }
        header('Location: ' . BASE_URL . 'pranchas');
        exit;
    }

    public function pesquisar()
    {
        $termo = $_GET['q'] ?? ($_POST['termo'] ?? '');
        if ($termo !== '') {
            $pranchas = Prancha::search($termo);
            require __DIR__ . '/../views/dashboard/pranchas/index.php';
        } else {
            $this->index();
        }
    }
}

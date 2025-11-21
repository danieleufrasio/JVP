<?php
require_once __DIR__ . '/../models/TipoPapel.php';

class TiposPapelController {

    public function index() {
        $tipos = TipoPapel::all();
        require_once __DIR__ . '/../views/dashboard/tipos_papel/index.php';
    }

    public function novo() {
        require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
    }

    public function salvar() {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao']),
                    'equivalencia' => htmlspecialchars($_POST['equivalencia']),
                    'valor_equivalencia' => htmlspecialchars($_POST['valor_equivalencia'])
                ];
                if (TipoPapel::create($dados)) {
                    $_SESSION['success'] = "Tipo de papel cadastrado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposPapel');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao cadastrar tipo de papel!";
                }
            }
            require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            require_once __DIR__ . '/../views/dashboard/tipos_papel/novo.php';
        }
    }

    public function editar($id) {
        $tipo = TipoPapel::find($id);
        require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
    }

    public function atualizar($id) {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $dados = [
                    'sigla' => htmlspecialchars($_POST['sigla']),
                    'descricao' => htmlspecialchars($_POST['descricao']),
                    'equivalencia' => htmlspecialchars($_POST['equivalencia']),
                    'valor_equivalencia' => htmlspecialchars($_POST['valor_equivalencia'])
                ];
                if (TipoPapel::update($id, $dados)) {
                    $_SESSION['success'] = "Tipo de papel atualizado com sucesso!";
                    header('Location: ' . BASE_URL . 'tiposPapel');
                    exit;
                } else {
                    $_SESSION['error'] = "Erro ao atualizar tipo de papel!";
                }
            }
            $tipo = TipoPapel::find($id);
            require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
        } catch (Exception $e) {
            $_SESSION['error'] = $e->getMessage();
            $tipo = TipoPapel::find($id);
            require_once __DIR__ . '/../views/dashboard/tipos_papel/editar.php';
        }
    }

    public function excluir($id) {
        if (TipoPapel::delete($id)) {
            $_SESSION['success'] = "Tipo de papel excluído com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao excluir tipo de papel!";
        }
        header('Location: ' . BASE_URL . 'tiposPapel');
        exit;
    }
}

<?php
require_once __DIR__ . '/../models/TipoProjeto.php';

class TiposProjetoController
{
    public function index()
    {
        $tipos = TipoProjeto::all();
        require __DIR__ . '/../views/dashboard/tipos_projeto/index.php';
    }

    public function novo()
    {
        require __DIR__ . '/../views/dashboard/tipos_projeto/novo.php';
    }

    public function salvar()
    {
        $dados = [
            'sigla' => $_POST['sigla'],
            'descricao' => $_POST['descricao']
        ];
        TipoProjeto::create($dados);
        header('Location: /tiposProjeto');
        exit;
    }

    public function editar($id)
    {
        $tipo = TipoProjeto::find($id);
        require __DIR__ . '/../views/dashboard/tipos_projeto/editar.php';
    }

    public function atualizar($id)
    {
        $dados = [
            'sigla' => $_POST['sigla'],
            'descricao' => $_POST['descricao']
        ];
        TipoProjeto::update($id, $dados);
        header('Location: /tiposProjeto');
        exit;
    }

    public function excluir($id)
    {
        TipoProjeto::delete($id);
        header('Location: /tiposProjeto');
        exit;
    }

    public function pesquisar()
    {
        $termo = $_GET['termo'];
        $tipos = TipoProjeto::search($termo);
        require __DIR__ . '/../views/dashboard/tipos_projeto/index.php';
    }
}
?>

<?php
require_once __DIR__ . '/../models/Banco.php';

class BancosController {
    public function index() {
        $bancos = Banco::all();
        require __DIR__ . '/../views/dashboard/bancos/index.php';
    }
    public function novo() {
        require __DIR__ . '/../views/dashboard/bancos/novo.php';
    }
    public function salvar() {
        $dados = $_POST;
        if ($dados) {
            Banco::create($dados);
        }
        header('Location: ' . BASE_URL . 'bancos');
        exit;
    }
    public function editar($id) {
        $banco = Banco::find($id);
        require __DIR__ . '/../views/dashboard/bancos/editar.php';
    }
    public function atualizar($id) {
        $dados = $_POST;
        if ($dados) {
            Banco::update($id, $dados);
        }
        header('Location: ' . BASE_URL . 'bancos');
        exit;
    }
    public function excluir($id) {
        Banco::delete($id);
        header('Location: ' . BASE_URL . 'bancos');
        exit;
    }
    // Seleção de banco (exemplo de uso em forms)
    public function selecionar() {
        $bancos = Banco::all();
        require __DIR__ . '/../views/dashboard/bancos/selecionar.php';
    }
}

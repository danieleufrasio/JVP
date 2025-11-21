<?php
require_once __DIR__ . '/../models/MeioPagamento.php';

class MeiosPagamentoController {
    public function index() {
        $meios = MeioPagamento::all();
        require __DIR__ . '/../views/dashboard/meios_pagamento/index.php';
    }
    public function novo() {
        require __DIR__ . '/../views/dashboard/meios_pagamento/novo.php';
    }
    public function salvar() {
        $descricao = $_POST['descricao'] ?? '';
        if ($descricao) {
            MeioPagamento::create($descricao);
        }
        header('Location: ' . BASE_URL . 'meiospagamento');
        exit;
    }
    public function editar($id) {
        $meio = MeioPagamento::find($id);
        require __DIR__ . '/../views/dashboard/meios_pagamento/editar.php';
    }
    public function atualizar($id) {
        $descricao = $_POST['descricao'] ?? '';
        if ($descricao) {
            MeioPagamento::update($id, $descricao);
        }
        header('Location: ' . BASE_URL . 'meiospagamento');
        exit;
    }
    public function pesquisar() {
        $termo = $_GET['q'] ?? '';
        $meios = MeioPagamento::search($termo);
        require __DIR__ . '/../views/dashboard/meios_pagamento/index.php';
    }

    public function excluir($id) {
    MeioPagamento::delete($id);
    header('Location: ' . BASE_URL . 'meiospagamento');
    exit;
}

}

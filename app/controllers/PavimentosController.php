<?php
require_once __DIR__ . '/../models/Pavimento.php';

class PavimentosController {
    public function index() {
        $pavimentos = Pavimento::all();

        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT id, nome FROM obras");
        $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $obraMap = [];
        foreach ($obras as $obra) {
            $obraMap[$obra['id']] = $obra['nome'];
        }

        require __DIR__ . '/../views/dashboard/pavimentos/index.php';
    }

    public function novo() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT id, nome FROM obras ORDER BY nome");
        $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/dashboard/pavimentos/novo.php';
    }

    public function salvar() {
        $dados = [
            'obraid' => $_POST['obraid'],
            'sigla' => $_POST['sigla'],
            'descricao' => $_POST['descricao']
        ];
        Pavimento::create($dados);
        header('Location: ' . BASE_URL . 'pavimentos');
        exit;
    }

    public function editar($id) {
        $pavimento = Pavimento::find($id);

        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT id, nome FROM obras ORDER BY nome");
        $obras = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require __DIR__ . '/../views/dashboard/pavimentos/editar.php';
    }

    public function atualizar($id) {
        $dados = [
            'obraid' => $_POST['obraid'],
            'sigla' => $_POST['sigla'],
            'descricao' => $_POST['descricao']
        ];
        Pavimento::update($id, $dados);
        header('Location: ' . BASE_URL . 'pavimentos');
        exit;
    }

    public function excluir($id) {
        Pavimento::delete($id);
        header('Location: ' . BASE_URL . 'pavimentos');
        exit;
    }
}

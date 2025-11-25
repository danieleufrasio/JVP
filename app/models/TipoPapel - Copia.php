<?php
class TipoPapel {
    public static function equivalencias() {
        return [
            'A4' => 0.125,
            'A3' => 0.250,
            'A2' => 0.500,
            'A1' => 1.000,
            'A0' => 2.000
        ];
    }

    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query('SELECT * FROM tipos_papel ORDER BY valor_equivalencia');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('SELECT * FROM tipos_papel WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('INSERT INTO tipos_papel (sigla, descricao, equivalencia, valor_equivalencia) VALUES (?, ?, ?, ?)');
        return $stmt->execute([
            $dados['sigla'],
            $dados['descricao'],
            $dados['equivalencia'],
            $dados['valor_equivalencia']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('UPDATE tipos_papel SET sigla=?, descricao=?, equivalencia=?, valor_equivalencia=? WHERE id=?');
        return $stmt->execute([
            $dados['sigla'],
            $dados['descricao'],
            $dados['equivalencia'],
            $dados['valor_equivalencia'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare('DELETE FROM tipos_papel WHERE id=?');
        return $stmt->execute([$id]);
    }
}

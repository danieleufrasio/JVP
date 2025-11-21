<?php
class Pavimento {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT * FROM pavimentos ORDER BY id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM pavimentos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO pavimentos (obraid, sigla, descricao) VALUES (?, ?, ?)");
        return $stmt->execute([
            $dados['obraid'],
            $dados['sigla'],
            $dados['descricao']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE pavimentos SET obraid=?, sigla=?, descricao=? WHERE id=?");
        return $stmt->execute([
            $dados['obraid'],
            $dados['sigla'],
            $dados['descricao'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM pavimentos WHERE id=?");
        return $stmt->execute([$id]);
    }
}

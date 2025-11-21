<?php
class Banco {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        return $pdo->query("SELECT * FROM bancos ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM bancos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function create($dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO bancos (codigo, banco_nome, agencia, conta_corrente, local, saldo_inicial) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $dados['codigo'], $dados['banco_nome'], $dados['agencia'],
            $dados['conta_corrente'], $dados['local'], $dados['saldo_inicial']
        ]);
    }
    public static function update($id, $dados) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE bancos SET codigo=?, banco_nome=?, agencia=?, conta_corrente=?, local=?, saldo_inicial=? WHERE id=?");
        return $stmt->execute([
            $dados['codigo'], $dados['banco_nome'], $dados['agencia'],
            $dados['conta_corrente'], $dados['local'], $dados['saldo_inicial'], $id
        ]);
    }
    public static function delete($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM bancos WHERE id=?");
        return $stmt->execute([$id]);
    }
}

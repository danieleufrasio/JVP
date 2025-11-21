<?php
require_once __DIR__ . '/../models/Database.php';

class Obra {
    public static function all() {
        $db = Database::connect();
        $sql = "SELECT obras.*, clientes.nome as cliente_nome
                FROM obras
                LEFT JOIN clientes ON obras.clienteid = clientes.id
                ORDER BY obras.nome";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $db = Database::connect();
        $sql = "INSERT INTO obras (codigo, nome, clienteid, endereco, status, dataconclusao)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $dados['codigo'],
            $dados['nome'],
            $dados['clienteid'],
            $dados['endereco'],
            $dados['status'],
            $dados['dataconclusao']
        ]);
    }

    public static function find($id) {
        $db = Database::connect();
        $sql = "SELECT * FROM obras WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($id, $dados) {
        $db = Database::connect();
        $sql = "UPDATE obras SET codigo=?, nome=?, clienteid=?, endereco=?, status=?, dataconclusao=? WHERE id=?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([
            $dados['codigo'],
            $dados['nome'],
            $dados['clienteid'],
            $dados['endereco'],
            $dados['status'],
            $dados['dataconclusao'],
            $id
        ]);
    }

    public static function delete($id) {
        $db = Database::connect();
        $sql = "DELETE FROM obras WHERE id = ?";
        $stmt = $db->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public static function search($termo) {
        $db = Database::connect();
        $sql = "SELECT obras.*, clientes.nome as cliente_nome
                FROM obras
                LEFT JOIN clientes ON obras.clienteid = clientes.id
                WHERE obras.nome LIKE ?
                ORDER BY obras.nome";
        $stmt = $db->prepare($sql);
        $stmt->execute(['%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

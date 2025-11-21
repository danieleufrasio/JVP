<?php
require_once 'Database.php';

class Fornecedor
{
    public static function all(): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM fornecedores ORDER BY fornecedor");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find(int $id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM fornecedores WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create(array $dados): bool
    {
        $pdo = Database::connect();
        $sql = "INSERT INTO fornecedores
                (codigo, fornecedor, status, descricao)
                VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $dados['codigo'],
            $dados['fornecedor'],
            $dados['status'],
            $dados['descricao'],
        ]);
    }

    public static function update(int $id, array $dados): bool
    {
        $pdo = Database::connect();
        $sql = "UPDATE fornecedores SET
                codigo = ?, fornecedor = ?, status = ?, descricao = ?
                WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $dados['codigo'],
            $dados['fornecedor'],
            $dados['status'],
            $dados['descricao'],
            $id,
        ]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM fornecedores WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function search(string $termo): array
    {
        $pdo = Database::connect();
        $sql = "SELECT * FROM fornecedores
                WHERE fornecedor LIKE ? OR codigo LIKE ? OR descricao LIKE ?
                ORDER BY fornecedor";
        $like = "%$termo%";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

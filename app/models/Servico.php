<?php
class Servico {
    private static function getConnection() {
        $pdo = require __DIR__ . '/../config/db.php'; // use esse caminho relative até sua pasta config
        if (!$pdo instanceof PDO) {
            throw new Exception('Falha na conexão PDO');
        }
        return $pdo;
    }

    public static function all() {
        $pdo = self::getConnection();
        $stmt = $pdo->query("SELECT * FROM servicos ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("SELECT * FROM servicos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("INSERT INTO servicos (titulo, descricao, imagem) VALUES (?, ?, ?)");
        return $stmt->execute([$dados['titulo'], $dados['descricao'], $dados['imagem']]);
    }

    public static function update($id, $dados) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("UPDATE servicos SET titulo = ?, descricao = ?, imagem = ? WHERE id = ?");
        return $stmt->execute([$dados['titulo'], $dados['descricao'], $dados['imagem'], $id]);
    }

    public static function delete($id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare("DELETE FROM servicos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>

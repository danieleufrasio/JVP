<?php
class Elemento {
    private static function getConnection() {
        // Importa e retorna o objeto PDO do arquivo de configuração
        $pdo = require __DIR__ . '/../config/db.php';
        if (!$pdo instanceof PDO) {
            throw new Exception("Conexão PDO inválida.");
        }
        return $pdo;
    }

    public static function all() {
        $pdo = self::getConnection();
        $stmt = $pdo->query('SELECT elementos.*, tipos_projeto.sigla AS tipo_sigla, tipos_projeto.descricao AS tipo_descricao FROM elementos LEFT JOIN tipos_projeto ON elementos.tipo_projeto_id = tipos_projeto.id ORDER BY elementos.sigla');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('SELECT * FROM elementos WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('INSERT INTO elementos (tipo_projeto_id, sigla, descricao) VALUES (?, ?, ?)');
        return $stmt->execute([
            $dados['tipo_projeto_id'],
            $dados['sigla'],
            $dados['descricao']
        ]);
    }

    public static function update($id, $dados) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('UPDATE elementos SET tipo_projeto_id=?, sigla=?, descricao=? WHERE id=?');
        return $stmt->execute([
            $dados['tipo_projeto_id'],
            $dados['sigla'],
            $dados['descricao'],
            $id
        ]);
    }

    public static function delete($id) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('DELETE FROM elementos WHERE id=?');
        return $stmt->execute([$id]);
    }

    public static function search($termo) {
        $pdo = self::getConnection();
        $stmt = $pdo->prepare('SELECT elementos.*, tipos_projeto.sigla AS tipo_sigla, tipos_projeto.descricao AS tipo_descricao FROM elementos LEFT JOIN tipos_projeto ON elementos.tipo_projeto_id = tipos_projeto.id WHERE elementos.sigla LIKE ? OR elementos.descricao LIKE ? OR tipos_projeto.sigla LIKE ? OR tipos_projeto.descricao LIKE ? ORDER BY elementos.sigla');
        $like = "%$termo%";
        $stmt->execute([$like, $like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

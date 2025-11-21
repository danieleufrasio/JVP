<?php

class Colaborador
{
    protected static $table = 'colaboradores';

    public static function all()
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT * FROM " . self::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM " . self::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';

        $sql = "INSERT INTO " . self::$table . " (codigo, nome, email, nivelacesso, status, usuario, senha)
                VALUES (:codigo, :nome, :email, :nivelacesso, :status, :usuario, :senha)";
        $stmt = $pdo->prepare($sql);

        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        return $stmt->execute($dados);
    }

    public static function update($id, $dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "UPDATE " . self::$table . " SET codigo = :codigo, nome = :nome, email = :email, nivelacesso = :nivelacesso,
                status = :status, usuario = :usuario" .
                (!empty($dados['senha']) ? ", senha = :senha" : "") .
                " WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        if (!empty($dados['senha'])) {
            $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        } else {
            unset($dados['senha']);
        }
        $dados['id'] = $id;

        return $stmt->execute($dados);
    }

    public static function delete($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function search($termo)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM " . self::$table . " WHERE nome LIKE :termo OR email LIKE :termo");
        $stmt->execute(['termo' => "%$termo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function autenticarPorEmail($email, $senha)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "SELECT * FROM " . self::$table . " WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $colaborador = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($colaborador && password_verify($senha, $colaborador['senha'])) {
            return $colaborador;
        }
        return false;
    }

    public static function niveis()
    {
        return ['administrador', 'projetista', 'calculista', 'verificador', 'freelancer', 'outro'];
    }
}

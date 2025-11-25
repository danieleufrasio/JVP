<?php
class Colaborador
{
    protected static $table = 'colaboradores';

    // Lista todos os colaboradores
    public static function all()
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT * FROM " . self::$table);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca colaborador por ID
    public static function find($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM " . self::$table . " WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cria colaborador com senha criptografada
    public static function create($dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "INSERT INTO " . self::$table . " (codigo, nome, email, nivelacesso, status, usuario, senha)
                VALUES (:codigo, :nome, :email, :nivelacesso, :status, :usuario, :senha)";
        $stmt = $pdo->prepare($sql);

        // Criptografa a senha ao cadastrar
        $dados['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        return $stmt->execute($dados);
    }

    // Atualiza colaborador (criptografa nova senha se fornecida)
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

    // Remove colaborador por ID
    public static function delete($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM " . self::$table . " WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Pesquisa colaborador por nome ou email (like)
    public static function search($termo)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM " . self::$table . " WHERE nome LIKE :termo OR email LIKE :termo");
        $stmt->execute(['termo' => "%$termo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Autentica colaborador pelo email e senha usando password_verify
    public static function autenticarPorEmail($email, $senha)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "SELECT * FROM " . self::$table . " WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        $colaborador = $stmt->fetch(PDO::FETCH_ASSOC);

        // Autentica apenas se usuário estiver ativo e senha correta
        if ($colaborador && $colaborador['status'] === 'ativo' && password_verify($senha, $colaborador['senha'])) {
            return $colaborador;
        }
        return false;
    }

    // Busca colaborador por email (usado no Google OAuth e rotinas internas)
    public static function buscarPorEmail($email, $pdo)
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lista possíveis níveis de acesso do colaborador
    public static function niveis()
    {
        return ['administrador', 'projetista', 'calculista', 'verificador', 'freelancer', 'outro'];
    }
}

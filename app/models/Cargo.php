<?php
require_once __DIR__ . '/Database.php';

class Cargo
{
    /**
     * Retorna todos os cargos da base de dados.
     *
     * @return array
     */
    public static function all(): array
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM cargos ORDER BY nome ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Busca um cargo pelo ID.
     *
     * @param int $id
     * @return array|false
     */
    public static function find(int $id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM cargos WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um novo cargo.
     *
     * @param array $dados ['nome' => string]
     * @return bool
     */
    public static function create(array $dados): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO cargos (nome) VALUES (?)");
        return $stmt->execute([$dados['nome']]);
    }

    /**
     * Atualiza um cargo existente.
     *
     * @param int $id
     * @param array $dados ['nome' => string]
     * @return bool
     */
    public static function update(int $id, array $dados): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE cargos SET nome = ? WHERE id = ?");
        return $stmt->execute([$dados['nome'], $id]);
    }

    /**
     * Exclui um cargo.
     *
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM cargos WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

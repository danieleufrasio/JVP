<?php
require_once __DIR__ . '/Database.php';

class ErroPrancha {

    // Retorna todos os erros com nome do colaborador
    public static function all(): array {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT e.*, c.nome AS colaborador_nome 
                             FROM erros_pranchas e 
                             LEFT JOIN colaboradores c ON e.colaborador_id = c.id 
                             ORDER BY e.data DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Busca todos os erros relacionados a um colaborador específico
    public static function porColaborador(int $colaboradorId): array {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT e.*, c.nome AS colaborador_nome 
                               FROM erros_pranchas e 
                               LEFT JOIN colaboradores c ON e.colaborador_id = c.id 
                               WHERE e.colaborador_id = ? 
                               ORDER BY e.data DESC");
        $stmt->execute([$colaboradorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Cria um novo registro de erro
    public static function criar(array $dados): bool {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO erros_pranchas (colaborador_id, data, descricao, quantidade) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $dados['colaborador_id'],
            $dados['data'],
            $dados['descricao'],
            $dados['quantidade']
        ]);
    }

    // Busca um erro específico pelo ID
    public static function find(int $id) {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT e.*, c.nome AS colaborador_nome 
                               FROM erros_pranchas e 
                               LEFT JOIN colaboradores c ON e.colaborador_id = c.id 
                               WHERE e.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Atualiza um registro existente
    public static function update(int $id, array $dados): bool {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE erros_pranchas SET colaborador_id = ?, data = ?, descricao = ?, quantidade = ? WHERE id = ?");
        return $stmt->execute([
            $dados['colaborador_id'],
            $dados['data'],
            $dados['descricao'],
            $dados['quantidade'],
            $id
        ]);
    }

    // Deleta um erro pelo ID
    public static function delete(int $id): bool {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM erros_pranchas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Conta a quantidade total de erros de um colaborador em um mês/ano específicos
    public static function contarPorColaborador(int $colaboradorId, int $mes, int $ano): int {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT SUM(quantidade) as total_erros 
                               FROM erros_pranchas 
                               WHERE colaborador_id = ? AND MONTH(data) = ? AND YEAR(data) = ?");
        $stmt->execute([$colaboradorId, $mes, $ano]);
        $total = $stmt->fetchColumn();
        return (int)$total;
    }

    // Busca erros em um intervalo de datas específicos (opcional)
    public static function buscarPorIntervalo(array $filtros): array {
        $pdo = Database::connect();

        $sql = "SELECT e.*, c.nome AS colaborador_nome 
                FROM erros_pranchas e 
                LEFT JOIN colaboradores c ON e.colaborador_id = c.id 
                WHERE 1=1";

        $params = [];

        if (!empty($filtros['colaborador_id'])) {
            $sql .= " AND e.colaborador_id = ?";
            $params[] = $filtros['colaborador_id'];
        }
        if (!empty($filtros['data_inicio'])) {
            $sql .= " AND e.data >= ?";
            $params[] = $filtros['data_inicio'];
        }
        if (!empty($filtros['data_fim'])) {
            $sql .= " AND e.data <= ?";
            $params[] = $filtros['data_fim'];
        }

        $sql .= " ORDER BY e.data DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

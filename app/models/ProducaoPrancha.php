<?php
require_once 'Database.php';

class RelatorioComissao
{
    public static function pranchasSemErro($filtros = []): array
    {
        $pdo = Database::connect();

        $sql = "SELECT 
                    p.*,
                    COALESCE(e.total_erros, 0) as total_erros
                FROM producao_pranchas p
                LEFT JOIN (
                   SELECT producao_prancha_id, SUM(quantidade) as total_erros 
                   FROM erros_pranchas GROUP BY producao_prancha_id
                ) e ON p.id = e.producao_prancha_id
                WHERE p.aprovado = 1 AND (e.total_erros IS NULL OR e.total_erros = 0)";

        $params = [];
        if (!empty($filtros['colaborador_id'])) {
            $sql .= " AND p.colaborador_id = ?";
            $params[] = $filtros['colaborador_id'];
        }
        if (!empty($filtros['mes'])) {
            $sql .= " AND MONTH(p.data) = ?";
            $params[] = $filtros['mes'];
        }
        if (!empty($filtros['ano'])) {
            $sql .= " AND YEAR(p.data) = ?";
            $params[] = $filtros['ano'];
        }
        $sql .= " ORDER BY p.data";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

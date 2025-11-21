<?php
require_once __DIR__ . '/Database.php';

class ComissaoMensal
{
    /**
     * Retorna todas as comissões registradas, com dados do colaborador.
     * 
     * @return array
     */
    public static function all(): array
    {
        $pdo = Database::connect();

        $sql = "SELECT cm.*, c.nome AS colaborador_nome
                FROM comissoes_mensais cm
                LEFT JOIN colaboradores c ON cm.colaborador_id = c.id
                ORDER BY cm.ano DESC, cm.mes DESC, c.nome ASC";

        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Retorna as comissões de um colaborador específico, ordenadas por mês e ano.
     * 
     * @param int $colaboradorId
     * @return array
     */
    public static function porColaborador(int $colaboradorId): array
    {
        $pdo = Database::connect();

        $sql = "SELECT cm.*, c.nome AS colaborador_nome
                FROM comissoes_mensais cm
                LEFT JOIN colaboradores c ON cm.colaborador_id = c.id
                WHERE cm.colaborador_id = ?
                ORDER BY cm.ano DESC, cm.mes DESC";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$colaboradorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Cria um registro de comissão mensal.
     * 
     * Espera um array $dados com os índices:
     * - colaborador_id (int)
     * - mes (int)
     * - ano (int)
     * - pranchas_produzidas (float)
     * - erros_count (int)
     * - pranchas_descontadas (float)
     * - pranchas_comissionadas (float)
     * - valor_comissao (float)
     * - pago (bool) - opcional, padrão false
     * 
     * @param array $dados
     * @return bool
     */
    public static function criar(array $dados): bool
    {
        $pdo = Database::connect();

        $sql = "INSERT INTO comissoes_mensais
                (colaborador_id, mes, ano, pranchas_produzidas, erros_count, pranchas_descontadas, pranchas_comissionadas, valor_comissao, pago)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $dados['colaborador_id'],
            $dados['mes'],
            $dados['ano'],
            $dados['pranchas_produzidas'],
            $dados['erros_count'],
            $dados['pranchas_descontadas'],
            $dados['pranchas_comissionadas'],
            $dados['valor_comissao'],
            $dados['pago'] ?? 0
        ]);
    }

    /**
     * Atualiza o status de pagamento de uma comissão.
     * 
     * @param int $id Comissão mensal id
     * @param bool $pago
     * @return bool
     */
    public static function atualizarPagamento(int $id, bool $pago): bool
    {
        $pdo = Database::connect();

        $sql = "UPDATE comissoes_mensais SET pago = ? WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        return $stmt->execute([$pago ? 1 : 0, $id]);
    }

    /**
     * Busca um registro de comissão por id.
     * 
     * @param int $id
     * @return array|false
     */
    public static function find(int $id)
    {
        $pdo = Database::connect();

        $sql = "SELECT cm.*, c.nome AS colaborador_nome
                FROM comissoes_mensais cm
                LEFT JOIN colaboradores c ON cm.colaborador_id = c.id
                WHERE cm.id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Exclui um registro de comissão mensal pelo ID.
     * 
     * @param int $id
     * @return bool
     */
    public static function delete(int $id): bool
    {
        $pdo = Database::connect();

        $stmt = $pdo->prepare("DELETE FROM comissoes_mensais WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /**
     * Verifica se existe uma comissão mensal para um colaborador, mês e ano.
     * 
     * @param int $colaboradorId
     * @param int $mes
     * @param int $ano
     * @return array|false
     */
    public static function findPorPeriodo(int $colaboradorId, int $mes, int $ano)
    {
        $pdo = Database::connect();

        $sql = "SELECT * FROM comissoes_mensais WHERE colaborador_id = ? AND mes = ? AND ano = ? LIMIT 1";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$colaboradorId, $mes, $ano]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Atualiza um registro de comissão mensal existente.
     * 
     * @param int $id
     * @param array $dados
     * @return bool
     */
    public static function update(int $id, array $dados): bool
    {
        $pdo = Database::connect();

        $sql = "UPDATE comissoes_mensais SET mes = ?, ano = ?, pranchas_produzidas = ?, erros_count = ?, pranchas_descontadas = ?, pranchas_comissionadas = ?, valor_comissao = ?, pago = ? WHERE id = ?";

        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $dados['mes'],
            $dados['ano'],
            $dados['pranchas_produzidas'],
            $dados['erros_count'],
            $dados['pranchas_descontadas'],
            $dados['pranchas_comissionadas'],
            $dados['valor_comissao'],
            $dados['pago'],
            $id
        ]);
    }
}

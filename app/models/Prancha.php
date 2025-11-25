<?php
class Prancha
{
    protected static $table = 'pranchas';

    public static function all()
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "
        SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla, tp.descricao AS tipo_projeto_descricao,
            el.sigla AS elemento_sigla, el.descricao AS elemento_descricao,
            pav.sigla AS pavimento_sigla, pav.descricao AS pavimento_descricao,
            tpap.sigla AS tipo_papel_sigla, tpap.descricao AS tipo_papel_descricao,
            proj.nome AS projetista_nome,
            veri.nome AS verificador_nome,
            calc.nome AS calculista_nome
        FROM pranchas p
        LEFT JOIN clientes      c    ON p.clienteid        = c.id
        LEFT JOIN obras         o    ON p.obraid           = o.id
        LEFT JOIN tipos_projeto tp   ON p.tipo_projeto_id  = tp.id
        LEFT JOIN elementos     el   ON p.elemento_id      = el.id
        LEFT JOIN pavimentos    pav  ON p.pavimento_id     = pav.id
        LEFT JOIN tipos_papel   tpap ON p.tipo_papel_id    = tpap.id
        LEFT JOIN colaboradores proj ON p.projetado_id     = proj.id
        LEFT JOIN colaboradores veri ON p.verificado_id    = veri.id
        LEFT JOIN colaboradores calc ON p.calculado_id     = calc.id
        ORDER BY p.id DESC
        ";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "
        SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla, tp.descricao AS tipo_projeto_descricao,
            el.sigla AS elemento_sigla, el.descricao AS elemento_descricao,
            pav.sigla AS pavimento_sigla, pav.descricao AS pavimento_descricao,
            tpap.sigla AS tipo_papel_sigla, tpap.descricao AS tipo_papel_descricao,
            proj.nome AS projetista_nome,
            veri.nome AS verificador_nome,
            calc.nome AS calculista_nome
        FROM pranchas p
        LEFT JOIN clientes      c    ON p.clienteid        = c.id
        LEFT JOIN obras         o    ON p.obraid           = o.id
        LEFT JOIN tipos_projeto tp   ON p.tipo_projeto_id  = tp.id
        LEFT JOIN elementos     el   ON p.elemento_id      = el.id
        LEFT JOIN pavimentos    pav  ON p.pavimento_id     = pav.id
        LEFT JOIN tipos_papel   tpap ON p.tipo_papel_id    = tpap.id
        LEFT JOIN colaboradores proj ON p.projetado_id     = proj.id
        LEFT JOIN colaboradores veri ON p.verificado_id    = veri.id
        LEFT JOIN colaboradores calc ON p.calculado_id     = calc.id
        WHERE p.id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';

        // Remova após o debug
        var_dump($dados);

        $camposObr = [
            'clienteid', 'obraid', 'tipo_projeto_id', 'elemento_id',
            'pavimento_id', 'tipo_papel_id',
            'projetado_id', 'verificado_id', 'calculado_id',
            'codigo'
        ];
        foreach ($camposObr as $c) {
            if (!isset($dados[$c]) || $dados[$c] === '' || !is_numeric($dados[$c])) {
                throw new Exception("O campo $c é obrigatório e deve ser um ID válido.");
            }
        }

        $sql = "INSERT INTO pranchas 
            (clienteid, obraid, tipo_projeto_id, elemento_id, pavimento_id, tipo_papel_id,
             projetado_id, verificado_id, calculado_id, codigo, descricao, arquivo, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $dados['clienteid'],
            $dados['obraid'],
            $dados['tipo_projeto_id'],
            $dados['elemento_id'],
            $dados['pavimento_id'],
            $dados['tipo_papel_id'],
            $dados['projetado_id'],
            $dados['verificado_id'],
            $dados['calculado_id'],
            $dados['codigo'],
            $dados['descricao'] ?? '',
            $dados['arquivo'] ?? '',
            $dados['status'] ?? 'ativo'
        ]);
    }

    public static function update($id, $dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';

        $camposObr = [
            'clienteid', 'obraid', 'tipo_projeto_id', 'elemento_id',
            'pavimento_id', 'tipo_papel_id',
            'projetado_id', 'verificado_id', 'calculado_id',
            'codigo'
        ];
        foreach ($camposObr as $c) {
            if (!isset($dados[$c]) || $dados[$c] === '' || !is_numeric($dados[$c])) {
                throw new Exception("O campo $c é obrigatório e deve ser um ID válido.");
            }
        }

        $sql = "UPDATE pranchas SET 
            clienteid = ?, obraid = ?, tipo_projeto_id = ?, elemento_id = ?, pavimento_id = ?, tipo_papel_id = ?,
            projetado_id = ?, verificado_id = ?, calculado_id = ?, codigo = ?, descricao = ?, arquivo = ?, status = ?
            WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            $dados['clienteid'],
            $dados['obraid'],
            $dados['tipo_projeto_id'],
            $dados['elemento_id'],
            $dados['pavimento_id'],
            $dados['tipo_papel_id'],
            $dados['projetado_id'],
            $dados['verificado_id'],
            $dados['calculado_id'],
            $dados['codigo'],
            $dados['descricao'] ?? '',
            $dados['arquivo'] ?? '',
            $dados['status'] ?? 'ativo',
            $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM pranchas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function search($termo)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "
        SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla, tp.descricao AS tipo_projeto_descricao,
            el.sigla AS elemento_sigla, el.descricao AS elemento_descricao,
            pav.sigla AS pavimento_sigla, pav.descricao AS pavimento_descricao,
            tpap.sigla AS tipo_papel_sigla, tpap.descricao AS tipo_papel_descricao,
            proj.nome AS projetista_nome,
            veri.nome AS verificador_nome,
            calc.nome AS calculista_nome
        FROM pranchas p
        LEFT JOIN clientes      c    ON p.clienteid        = c.id
        LEFT JOIN obras         o    ON p.obraid           = o.id
        LEFT JOIN tipos_projeto tp   ON p.tipo_projeto_id  = tp.id
        LEFT JOIN elementos     el   ON p.elemento_id      = el.id
        LEFT JOIN pavimentos    pav  ON p.pavimento_id     = pav.id
        LEFT JOIN tipos_papel   tpap ON p.tipo_papel_id    = tpap.id
        LEFT JOIN colaboradores proj ON p.projetado_id     = proj.id
        LEFT JOIN colaboradores veri ON p.verificado_id    = veri.id
        LEFT JOIN colaboradores calc ON p.calculado_id     = calc.id
        WHERE p.codigo LIKE ? OR p.descricao LIKE ? OR o.nome LIKE ? OR c.nome LIKE ?
        ORDER BY p.id DESC
        ";
        $like = "%$termo%";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$like, $like, $like, $like]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

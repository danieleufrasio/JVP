<?php

class Prancha
{
    protected static $table = 'pranchas';

    public static function all()
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla,
            el.sigla AS elemento_sigla,
            pav.sigla AS pavimento_sigla,
            tpap.descricao AS tipo_papel_equivalencia,
            colproj.nome AS projetado_nome,
            colver.nome AS verificado_nome,
            colcalc.nome AS calculado_nome
        FROM pranchas p
            LEFT JOIN clientes c ON p.clienteid = c.id
            LEFT JOIN obras o ON p.obraid = o.id
            LEFT JOIN tipos_projeto tp ON p.tipoprojetoid = tp.id
            LEFT JOIN elementos el ON p.elementoid = el.id
            LEFT JOIN pavimentos pav ON p.pavimentoid = pav.id
            LEFT JOIN tipos_papel tpap ON p.tipopapelid = tpap.id
            LEFT JOIN colaboradores colproj ON p.projetadoid = colproj.id
            LEFT JOIN colaboradores colver ON p.verificadoid = colver.id
            LEFT JOIN colaboradores colcalc ON p.calculadoid = colcalc.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla,
            el.sigla AS elemento_sigla,
            pav.sigla AS pavimento_sigla,
            tpap.descricao AS tipo_papel_equivalencia,
            colproj.nome AS projetado_nome,
            colver.nome AS verificado_nome,
            colcalc.nome AS calculado_nome
        FROM pranchas p
            LEFT JOIN clientes c ON p.clienteid = c.id
            LEFT JOIN obras o ON p.obraid = o.id
            LEFT JOIN tipos_projeto tp ON p.tipoprojetoid = tp.id
            LEFT JOIN elementos el ON p.elementoid = el.id
            LEFT JOIN pavimentos pav ON p.pavimentoid = pav.id
            LEFT JOIN tipos_papel tpap ON p.tipopapelid = tpap.id
            LEFT JOIN colaboradores colproj ON p.projetadoid = colproj.id
            LEFT JOIN colaboradores colver ON p.verificadoid = colver.id
            LEFT JOIN colaboradores colcalc ON p.calculadoid = colcalc.id
        WHERE p.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "INSERT INTO pranchas (clienteid, obraid, conclusao, tipoprojetoid, numeroprancha, elementoid, pavimentoid, revisao, tipopapelid, observacao, aprovacao_prancha, projetadoid, verificadoid, calculadoid) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        // Força status pendente ao criar
        $dados['aprovacao_prancha'] = 'pendente';

        return $stmt->execute([
            $dados['clienteid'],
            $dados['obraid'],
            $dados['conclusao'],
            $dados['tipoprojetoid'],
            $dados['numeroprancha'],
            $dados['elementoid'],
            $dados['pavimentoid'],
            $dados['revisao'],
            $dados['tipopapelid'],
            $dados['observacao'],
            $dados['aprovacao_prancha'],
            $dados['projetadoid'],
            $dados['verificadoid'],
            $dados['calculadoid']
        ]);
    }

    public static function update($id, $dados)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $sql = "UPDATE pranchas SET clienteid = ?, obraid = ?, conclusao = ?, tipoprojetoid = ?, numeroprancha = ?, elementoid = ?, pavimentoid = ?, revisao = ?, tipopapelid = ?, observacao = ?, aprovacao_prancha = ?, projetadoid = ?, verificadoid = ?, calculadoid = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            $dados['clienteid'],
            $dados['obraid'],
            $dados['conclusao'],
            $dados['tipoprojetoid'],
            $dados['numeroprancha'],
            $dados['elementoid'],
            $dados['pavimentoid'],
            $dados['revisao'],
            $dados['tipopapelid'],
            $dados['observacao'],
            $dados['aprovacao_prancha'] ?? 'pendente',
            $dados['projetadoid'],
            $dados['verificadoid'],
            $dados['calculadoid'],
            $id
        ]);
    }

    public static function delete($id)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("DELETE FROM pranchas WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public static function updateStatus($id, $status)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE pranchas SET aprovacao_prancha = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public static function search($termo)
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT p.*, 
            c.nome AS cliente_nome, 
            o.nome AS obra_nome, 
            tp.sigla AS tipo_projeto_sigla,
            el.sigla AS elemento_sigla,
            pav.sigla AS pavimento_sigla,
            tpap.descricao AS tipo_papel_equivalencia,
            colproj.nome AS projetado_nome,
            colver.nome AS verificado_nome,
            colcalc.nome AS calculado_nome
        FROM pranchas p
            LEFT JOIN clientes c ON p.clienteid = c.id
            LEFT JOIN obras o ON p.obraid = o.id
            LEFT JOIN tipos_projeto tp ON p.tipoprojetoid = tp.id
            LEFT JOIN elementos el ON p.elementoid = el.id
            LEFT JOIN pavimentos pav ON p.pavimentoid = pav.id
            LEFT JOIN tipos_papel tpap ON p.tipopapelid = tpap.id
            LEFT JOIN colaboradores colproj ON p.projetadoid = colproj.id
            LEFT JOIN colaboradores colver ON p.verificadoid = colver.id
            LEFT JOIN colaboradores colcalc ON p.calculadoid = colcalc.id
        WHERE numeroprancha LIKE ?");
        $stmt->execute(["%$termo%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

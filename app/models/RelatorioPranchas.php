<?php
class RelatorioPranchas
{
    public static function listaClientes()
    {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->query("SELECT id, nome FROM clientes ORDER BY nome");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function gerar(array $filtros = [])
    {
        $pdo = require __DIR__ . '/../config/db.php';

      $sql = "
SELECT 
    p.id,
    p.numeroprancha,
    p.observacao AS descricao,
    p.conclusao AS data_entrega,
    c.nome AS cliente_nome,
    o.nome AS obra_nome,
    tp.sigla AS projeto_nome,
    e.sigla AS elemento,
    pav.sigla AS pavimento,
    tpapel.sigla AS papel,
    tpapel.equivalencia AS equivalencia, -- ADICIONE ESTA LINHA
    col_proj.nome AS projetista,
    col_ver.nome AS verificador,
    col_calc.nome AS calculista,
    p.status
FROM pranchas p
LEFT JOIN clientes c ON p.clienteid = c.id
LEFT JOIN obras o ON p.obraid = o.id
LEFT JOIN tipos_projeto tp ON p.tipoprojetoid = tp.id
LEFT JOIN elementos e ON p.elementoid = e.id
LEFT JOIN pavimentos pav ON p.pavimentoid = pav.id
LEFT JOIN tipos_papel tpapel ON p.tipopapelid = tpapel.id
LEFT JOIN colaboradores col_proj ON p.projetadoid = col_proj.id
LEFT JOIN colaboradores col_ver ON p.verificadoid = col_ver.id
LEFT JOIN colaboradores col_calc ON p.calculadoid = col_calc.id
WHERE 1=1
";


        $params = [];
        if (!empty($filtros['cliente_id'])) {
            $sql .= " AND c.id = ? ";
            $params[] = $filtros['cliente_id'];
        }
        if (!empty($filtros['data_inicio'])) {
            $sql .= " AND p.conclusao >= ? ";
            $params[] = $filtros['data_inicio'];
        }
        if (!empty($filtros['data_fim'])) {
            $sql .= " AND p.conclusao <= ? ";
            $params[] = $filtros['data_fim'];
        }
        $sql .= " ORDER BY c.nome, p.conclusao";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function exportaPdf(array $pranchas)
    {
        $pdf = new \TCPDF();
        $pdf->AddPage();

        $currentClient = '';
        $html = '<h1>Relatório de produção das Pranchas</h1>';

        foreach ($pranchas as $prancha) {
            if ($prancha['cliente_nome'] !== $currentClient) {
                if ($currentClient !== '') {
                    $html .= '</tbody></table>';
                    $pdf->writeHTML($html);
                    $pdf->AddPage();
                }
                $currentClient = $prancha['cliente_nome'];
                $html = "<h2>Cliente: " . htmlspecialchars($currentClient) . "</h2>";
                $html .= '<table border="1" cellpadding="4" cellspacing="0">';
                $html .= "<thead><tr>
                    <th>ID</th><th>Nr Prancha</th><th>Descrição</th><th>Data Entrega</th><th>Obra</th><th>Projeto</th><th>Elemento</th><th>Pavimento</th><th>Papel</th><th>Projetista</th><th>Verificador</th><th>Calculista</th><th>Status</th>
                    </tr></thead><tbody>";
            }
            $html .= "<tr>";
            $html .= "<td>" . htmlspecialchars($prancha['id']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['numeroprancha']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['descricao']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['data_entrega']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['obra_nome']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['projeto_nome']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['elemento']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['pavimento']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['papel']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['projetista']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['verificador']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['calculista']) . "</td>";
            $html .= "<td>" . htmlspecialchars($prancha['status']) . "</td>";
            $html .= "</tr>";
        }

        $html .= '</tbody></table>';
        $pdf->writeHTML($html);
        $pdf->Output('Relatorio_Producao_Prancha.pdf', 'I');
    }
}

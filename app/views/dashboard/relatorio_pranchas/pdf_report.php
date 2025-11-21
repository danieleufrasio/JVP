<?php
require_once __DIR__ . '/../../../../lib/TCPDF/tcpdf.php';

ob_start();
?>

<h1>Relatório das Pranchas</h1>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; border-collapse:collapse;">
<thead>
<tr>
    <th>ID</th>
    <th>Número</th>
    <th>Descrição</th>
    <th>Data de Conclusão</th>
    <th>Cliente</th>
    <th>Obra</th>
    <th>Projeto</th>
    <th>Elemento</th>
    <th>Pavimento</th>
    <th>Papel</th>
    <th>Projetista</th>
    <th>Verificador</th>
    <th>Calculista</th>
    <th>Status</th>
</tr>
</thead>
<tbody>
<?php foreach ($pranchas as $prancha): ?>
<tr>
    <td><?= htmlspecialchars($prancha['id'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['numeroprancha'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['descricao'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['data_entrega'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['cliente_nome'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['obra_nome'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['projeto_nome'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['elemento'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['pavimento'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['equivalencia'] ?? '') ?></td> <!-- NOVO: valor de equivalência -->
    <td><?= htmlspecialchars($prancha['projetista'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['verificador'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['calculista'] ?? '') ?></td>
    <td><?= htmlspecialchars($prancha['status'] ?? '') ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<?php
$html = ob_get_clean();

$pdf = new \TCPDF();
$pdf->AddPage();
$pdf->writeHTML($html);
$pdf->Output('Relatorio_Prancha.pdf', 'I');
exit;
?>

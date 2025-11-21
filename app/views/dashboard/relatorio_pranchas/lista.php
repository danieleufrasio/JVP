<?php require_once __DIR__ . '/../../layouts/header.php'; ?>
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 4px 8px;
        text-align: left;
    }
    th {
        background-color: #eee;
    }
</style>
</head>
<body>
<h1>Relatório: Listagem de Pranchas</h1>
<?php if (!empty($pranchas)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Número da Prancha</th>
                <th>Descrição</th>
                <th>Data Entrega</th>
                <th>Cliente</th>
                <th>Obra</th>
                <th>Projeto</th>
                <th>Elemento</th>
                <th>Pavimento</th>
                <th>Tipo Papel</th>
                <th>Projetista</th>
                <th>Verificador</th>
                <th>Calculista</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pranchas as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['numeroprancha'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['descricao'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['data_entrega'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['cliente_nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['obra_nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['projeto_nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['elemento'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['pavimento'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['papel'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['projetista'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['verificador'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['calculista'] ?? '') ?></td>
                <td><?= htmlspecialchars($p['status'] ?? '') ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Nenhuma prancha encontrada com os filtros selecionados.</p>
<?php endif; ?>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>

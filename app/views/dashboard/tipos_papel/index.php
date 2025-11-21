<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Tipos de Papel</h2>
    <div class="mb-3">
        <a href="<?= BASE_URL ?>tiposPapel/novo" class="btn btn-primary">Novo</a>
        <a href="<?= BASE_URL ?>tiposPapel" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-striped">
        <thead>
    <tr>    
        <th>Sigla</th>
        <th>Descrição</th>
        <th>Equivalência</th>
        <th>Ações</th>
    </tr>
</thead>
<tbody>
<?php foreach ($tipos as $tipo): ?>
    <tr>
        <td><?= htmlspecialchars($tipo['sigla']) ?></td>
        <td><?= htmlspecialchars($tipo['descricao']) ?></td>
        <td title="Equivalente ao tamanho A1: 1 = 1 folha A1">
            <?= number_format($tipo['valor_equivalencia'], 3, ',', '') ?>
        </td>
        <td>
            <a href="<?= BASE_URL ?>tiposPapel/editar/<?= $tipo['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
            <a href="<?= BASE_URL ?>tiposPapel/excluir/<?= $tipo['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este tipo de papel?')">Excluir</a>
        </td>
    </tr>
<?php endforeach; ?>
</tbody>

    </table>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

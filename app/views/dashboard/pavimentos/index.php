<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:800px;margin:0 auto;">
        <h2 class="mb-3 mt-0">Pavimentos</h2>
        <a href="<?= BASE_URL ?>pavimentos/novo" class="btn btn-primary mb-2">Novo</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Obra</th>
                    <th>Sigla</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pavimentos as $p): ?>
                    <tr>
                        <td><?= htmlspecialchars($obraMap[$p['obraid']] ?? $p['obraid']) ?></td>
                        <td><?= htmlspecialchars($p['sigla']) ?></td>
                        <td><?= htmlspecialchars($p['descricao']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>pavimentos/editar/<?= $p['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= BASE_URL ?>pavimentos/excluir/<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

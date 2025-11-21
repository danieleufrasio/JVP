<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <div class="main-inner" style="max-width:1200px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Fornecedores</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <a href="<?= BASE_URL ?>fornecedores/novo" class="btn btn-primary">Novo</a>
            <form class="d-flex" method="get" action="<?= BASE_URL ?>fornecedores/pesquisar">
                <input type="text" name="q" placeholder="Pesquisar..." class="form-control me-2" style="width:200px;">
                <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
            </form>
            <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary">Fechar</a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Fornecedor</th>
                        <th>Status</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($fornecedores as $fornecedor): ?>
                    <tr>
                        <td><?= htmlspecialchars($fornecedor['codigo']) ?></td>
                        <td><?= htmlspecialchars($fornecedor['fornecedor']) ?></td>
                        <td><?= htmlspecialchars($fornecedor['status']) ?></td>
                        <td><?= htmlspecialchars($fornecedor['descricao']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>fornecedores/editar/<?= $fornecedor['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                            <a href="<?= BASE_URL ?>fornecedores/excluir/<?= $fornecedor['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este fornecedor?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <div class="main-inner w-100" style="max-width: 900px; padding-top: 0;">
        <h2 class="mb-3 mt-0 text-center">Clientes</h2>
        <div class="mb-3 d-flex justify-content-between align-items-center gap-2 flex-wrap">
            <a href="<?= BASE_URL ?>clientes/novo" class="btn btn-primary">Novo</a>
            <input type="text" id="buscaCliente" placeholder="Pesquisar..." class="form-control" style="width:200px;max-width:100%;">
        </div>
        <div class="table-responsive">
            <table class="table table-striped align-middle" id="tabelaClientes">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Código Interno</th>
                        <th>Nome</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($clientes as $cliente): ?>
                    <tr>
                        <td><?= htmlspecialchars($cliente['id']) ?></td>
                        <td><?= htmlspecialchars($cliente['codigo']) ?></td>
                        <td><?= htmlspecialchars($cliente['codigo_interno'] ?? '') ?></td>
                        <td><?= htmlspecialchars($cliente['nome']) ?></td>
                        <td><?= htmlspecialchars($cliente['status']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>clientes/editar/<?= $cliente['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= BASE_URL ?>clientes/excluir/<?= $cliente['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este cliente?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

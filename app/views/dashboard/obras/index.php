<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<?php include_once __DIR__ . '/../../layouts/sidebar.php'; ?>
<main class="main-content">
    <h2>Obras</h2>
    <div class="mb-3 d-flex align-items-center">
        <a href="<?= BASE_URL ?>obras/novo" class="btn btn-primary me-2">Novo</a>
        <input type="text" id="buscaObra" placeholder="Pesquisar..." class="form-control me-2" style="width:200px;">
        <a href="<?= BASE_URL ?>obras" class="btn btn-secondary">Fechar</a>
    </div>
    <table class="table table-hover" id="tabelaObras">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Cliente</th>
                <th>Endereço</th>
                <th>Status</th>
                <th>Data de Conclusão</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php if (!empty($obras)): ?>
            <?php foreach ($obras as $obra): ?>
            <tr>
                <td><?= htmlspecialchars($obra['codigo'] ?? '') ?></td>
                <td><?= htmlspecialchars($obra['nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($obra['cliente_nome'] ?? '') ?></td>
                <td><?= htmlspecialchars($obra['endereco'] ?? '') ?></td>
                <td><?= htmlspecialchars($obra['status'] ?? '') ?></td>
                <td><?= htmlspecialchars($obra['dataconclusao'] ?? '') ?></td>
                <td>
                    <a href="<?= BASE_URL ?>obras/editar/<?= $obra['id'] ?>" class="btn btn-sm btn-warning">Alterar</a>
                    <a href="<?= BASE_URL ?>obras/excluir/<?= $obra['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir esta obra?')">Excluir</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" class="text-center">Nenhuma obra cadastrada</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <div class="main-inner" style="max-width:600px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Editar Fornecedor</h2>
        <form method="post" action="<?= BASE_URL ?>fornecedores/atualizar/<?= $fornecedor['id'] ?>">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" value="<?= htmlspecialchars($fornecedor['codigo']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="fornecedor" class="form-label">Fornecedor</label>
                <input type="text" name="fornecedor" id="fornecedor" class="form-control" value="<?= htmlspecialchars($fornecedor['fornecedor']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" name="status" id="status" class="form-control" value="<?= htmlspecialchars($fornecedor['status']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3"><?= htmlspecialchars($fornecedor['descricao']) ?></textarea>
            </div>
            <button class="btn btn-primary" type="submit">Salvar</button>
            <a href="<?= BASE_URL ?>fornecedores" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

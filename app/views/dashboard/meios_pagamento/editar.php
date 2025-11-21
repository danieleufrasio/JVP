<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<div class="container mt-4">
    <h2>Alterar Meio de Pagamento</h2>
    <form method="post" action="<?= BASE_URL ?>meiospagamento/atualizar/<?= $meio['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Descrição</label>
            <input type="text" name="descricao" class="form-control" value="<?= htmlspecialchars($meio['descricao']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Salvar Alterações</button>
        <a href="<?= BASE_URL ?>meiospagamento" class="btn btn-secondary">Fechar</a>
    </form>
</div>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

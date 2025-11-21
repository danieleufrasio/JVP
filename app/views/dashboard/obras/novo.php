<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<?php include_once __DIR__ . '/../../layouts/sidebar.php'; ?>
<main class="main-content">
    <h2>Nova Obra</h2>
    <form method="post" action="<?= BASE_URL ?>obras/salvar">
        <div class="mb-3">
            <label for="codigo" class="form-label">Código</label>
            <input type="text" name="codigo" id="codigo" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Obra</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="clienteid" class="form-label">Cliente</label>
            <select class="form-control" name="clienteid" id="clienteid" required>
                <option value="">Selecione o cliente</option>
                <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nome']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" name="endereco" id="endereco" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <input type="text" name="status" id="status" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="dataconclusao" class="form-label">Data de Conclusão</label>
            <input type="date" name="dataconclusao" id="dataconclusao" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= BASE_URL ?>obras" class="btn btn-secondary">Cancelar</a>
    </form>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

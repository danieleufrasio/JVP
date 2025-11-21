<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:500px;margin:0 auto;">
        <h2>Novo Pavimento</h2>
        <form method="post" action="<?= BASE_URL ?>pavimentos/salvar">
            <div class="mb-3">
                <label for="obraid" class="form-label">Obra</label>
                <select name="obraid" id="obraid" class="form-control" required>
                    <?php foreach ($obras as $obra): ?>
                        <option value="<?= $obra['id'] ?>"><?= htmlspecialchars($obra['nome']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="sigla" class="form-label">Sigla</label>
                <input type="text" name="sigla" id="sigla" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea name="descricao" id="descricao" class="form-control" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= BASE_URL ?>pavimentos" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

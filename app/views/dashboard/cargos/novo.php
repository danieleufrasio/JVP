<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content" style="max-width: 600px; margin: auto;">
    <h2>Novo Cargo</h2>

    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form method="post" action="<?= BASE_URL ?>cargos/salvar" autocomplete="off">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome do Cargo</label>
            <input type="text" id="nome" name="nome" class="form-control" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
        <a href="<?= BASE_URL ?>cargos" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

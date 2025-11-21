<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <div class="container mt-5">
        <h2>Novo Cliente</h2>
        <form method="post" action="<?= BASE_URL ?>clientes/salvar">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="codigo_interno" class="form-label">Código Interno</label>
                <input type="text" name="codigointerno" id="codigo_interno" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Cliente</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="Ativo">Ativo</option>
                    <option value="Inativo">Inativo</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Salvar</button>
            <a href="<?= BASE_URL ?>clientes" class="btn btn-secondary">Voltar</a>
        </form>
    </div>
</main>


<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
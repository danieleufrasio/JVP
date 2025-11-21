<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4" style="max-width: 600px;">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-university me-2"></i>Novo Banco</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="<?= BASE_URL ?>bancos/salvar" autocomplete="off">
                        <div class="mb-3">
                            <label class="form-label">Código</label>
                            <input type="text" name="codigo" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Banco</label>
                            <input type="text" name="banco_nome" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Agência</label>
                            <input type="text" name="agencia" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Conta Corrente</label>
                            <input type="text" name="conta_corrente" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Local</label>
                            <input type="text" name="local" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Saldo Inicial</label>
                            <input type="number" step="0.01" name="saldo_inicial" class="form-control" required>
                        </div>
                        <div class="d-flex gap-2 justify-content-end">
                            <button type="submit" class="btn btn-success">Salvar</button>
                            <a href="<?= BASE_URL ?>bancos" class="btn btn-secondary">Fechar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
</div>

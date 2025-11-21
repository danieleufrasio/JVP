<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <div class="container" style="max-width: 600px;">
        <div class="card shadow-sm mt-5">
            <div class="card-header bg-primary text-white d-flex align-items-center">
                <i class="fas fa-layer-group me-2"></i>
                <h5 class="mb-0">Editar Tipo de Projeto</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?= BASE_URL ?>tiposProjeto/atualizar/<?= $tipo['id'] ?>" autocomplete="off">
                    <div class="mb-3">
                        <label for="sigla" class="form-label">Sigla <span class="text-danger">*</span></label>
                        <input type="text" name="sigla" id="sigla" class="form-control" maxlength="10"
                               required value="<?= htmlspecialchars($tipo['sigla'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição <span class="text-danger">*</span></label>
                        <input type="text" name="descricao" id="descricao" class="form-control"
                               required value="<?= htmlspecialchars($tipo['descricao'] ?? '') ?>">
                    </div>
                    <div class="d-flex gap-2 justify-content-end mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Salvar Alterações
                        </button>
                        <a href="<?= BASE_URL ?>tiposProjeto" class="btn btn-secondary">
                            <i class="fas fa-times me-1"></i> Fechar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:900px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Editar Prancha</h2>

        <form method="post" action="<?= BASE_URL ?>pranchas/atualizar/<?= htmlspecialchars($prancha['id']) ?>">
            <input type="hidden" name="id" value="<?= htmlspecialchars($prancha['id']) ?>">
            <div class="row">
                <!-- Cliente -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="clienteid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= htmlspecialchars($c['id']) ?>"
                                <?= ((string)$prancha['clienteid'] === (string)$c['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($c['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- ... repita para obra, tipo projeto, elemento, pavimento, tipo papel etc, igual acima ... -->
                <!-- Conclusão -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Conclusão</label>
                    <input type="date" name="conclusao" class="form-control"
                        value="<?= htmlspecialchars($prancha['conclusao'] ?? '') ?>">
                </div>
                <!-- Status dinâmico via submit -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <div class="d-flex gap-2 mb-2">
                        <button type="submit" name="aprovacao_prancha" value="pendente"
                            class="btn <?= $prancha['aprovacao_prancha']=='pendente' ? 'btn-warning' : 'btn-outline-warning' ?>">
                            Pendente
                        </button>
                        <button type="submit" name="aprovacao_prancha" value="aprovada"
                            class="btn <?= $prancha['aprovacao_prancha']=='aprovada' ? 'btn-success' : 'btn-outline-success' ?>">
                            Aprovar
                        </button>
                        <button type="submit" name="aprovacao_prancha" value="reprovada"
                            class="btn <?= $prancha['aprovacao_prancha']=='reprovada' ? 'btn-danger' : 'btn-outline-danger' ?>">
                            Reprovar
                        </button>
                    </div>
                    <span class="badge mt-2
                        <?= $prancha['aprovacao_prancha']=='aprovada' ? 'bg-success' : (
                            $prancha['aprovacao_prancha']=='reprovada' ? 'bg-danger' : 'bg-warning text-dark'
                        ) ?>">
                        <?= ucfirst($prancha['aprovacao_prancha']) ?>
                    </span>
                </div>
                <!-- Observação -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Observação</label>
                    <textarea name="observacao" class="form-control"><?= htmlspecialchars($prancha['observacao'] ?? '') ?></textarea>
                </div>
                <!-- Projetista, Verificador, Calculista -->
                <div class="col-md-4">
                    <label class="form-label">Projetista</label>
                    <select name="projetadoid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= htmlspecialchars($col['id']) ?>"
                                <?= ((string)$prancha['projetadoid'] === (string)$col['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($col['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Verificador</label>
                    <select name="verificadoid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= htmlspecialchars($col['id']) ?>"
                                <?= ((string)$prancha['verificadoid'] === (string)$col['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($col['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Calculista</label>
                    <select name="calculadoid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= htmlspecialchars($col['id']) ?>"
                                <?= ((string)$prancha['calculadoid'] === (string)$col['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($col['nome']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="d-flex justify-content-between mt-4">
                <a href="<?= BASE_URL ?>pranchas" class="btn btn-secondary">Cancelar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

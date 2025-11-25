<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:900px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Nova Prancha</h2>
        <form method="post" action="<?= BASE_URL ?>pranchas/salvar">
            <div class="row">
                <!-- Cliente -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Cliente</label>
                    <select name="clienteid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($clientes as $c): ?>
                            <option value="<?= $c['id'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Código da Prancha</label>
                    <input type="text" name="codigo" class="form-control" required>
                </div>

                <!-- Obra -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Obra</label>
                    <select name="obraid" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($obras as $o): ?>
                            <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Conclusão -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Conclusão</label>
                    <input type="date" name="conclusao" class="form-control">
                </div>
                <!-- Tipo de Projeto -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tipo de Projeto</label>
                    <select name="tipo_projeto_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($tiposProjeto as $tp): ?>
                            <option value="<?= $tp['id'] ?>"><?= htmlspecialchars($tp['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Número da Prancha -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Número da Prancha</label>
                    <input type="text" name="numeroprancha" class="form-control">
                </div>
                <!-- Elemento -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Elemento</label>
                    <select name="elemento_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($elementos as $el): ?>
                            <option value="<?= $el['id'] ?>"><?= htmlspecialchars($el['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Pavimento -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Pavimento</label>
                    <select name="pavimento_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($pavimentos as $pav): ?>
                            <option value="<?= $pav['id'] ?>"><?= htmlspecialchars($pav['sigla']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Revisão -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Revisão</label>
                    <input type="text" name="revisao" class="form-control" value="0">
                </div>
                <!-- Tipo de Papel -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Tipo de Papel</label>
                    <select name="tipo_papel_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($tiposPapel as $tpap): ?>
                            <option value="<?= $tpap['id'] ?>"><?= htmlspecialchars($tpap['descricao']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Status visual apenas -->
                <div class="col-md-4 mb-3">
                    <label class="form-label">Status</label>
                    <input type="text" class="form-control" disabled value="Pendente">
                </div>
                
                <!-- Observação -->
                <div class="col-md-12 mb-3">
                    <label class="form-label">Observação</label>
                    <textarea name="observacao" class="form-control"></textarea>
                </div>
                <!-- Projetista -->
                <div class="col-md-4">
                    <label class="form-label">Projetista</label>
                    <select name="projetado_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Verificador -->
                <div class="col-md-4">
                    <label class="form-label">Verificador</label>
                    <select name="verificado_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['nome']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <!-- Calculista -->
                <div class="col-md-4">
                    <label class="form-label">Calculista</label>
                    <select name="calculado_id" class="form-select" required>
                        <option value="">Selecione</option>
                        <?php foreach ($colaboradores as $col): ?>
                            <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['nome']) ?></option>
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

<?php require_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height:70vh;">
    <div class="w-100" style="max-width:540px;">
        <h1 class="mb-4 text-center">Filtro - Relatório de Pranchas</h1>
        <form action="/jvp/relatoriopranchas/gerarPdf" method="get">
            <div class="mb-3 text-center">
                <label for="cliente" class="form-label">Cliente</label>
                <select id="cliente" name="cliente_id" class="form-select text-center" style="max-width:340px;margin:0 auto;">
                    <option value="">-- Todos --</option>
                    <?php foreach($clientes as $cliente): ?>
                        <option value="<?= htmlspecialchars($cliente['id']) ?>">
                            <?= htmlspecialchars($cliente['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="mb-3 text-center">
                <label for="data_inicio" class="form-label">Data Início</label>
                <input type="date" id="data_inicio" name="data_inicio" class="form-control text-center" style="max-width:210px;margin:0 auto;" />
            </div>
            <div class="mb-3 text-center">
                <label for="data_fim" class="form-label">Data Fim</label>
                <input type="date" id="data_fim" name="data_fim" class="form-control text-center" style="max-width:210px;margin:0 auto;" />
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Gerar Relatório</button>
            </div>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>

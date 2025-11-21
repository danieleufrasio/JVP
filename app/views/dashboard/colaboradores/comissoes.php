<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content" style="max-width:700px; margin:auto;">

  <h2>Comissões Mensais</h2>

  <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']) ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']) ?>
  <?php endif; ?>

  <form method="get" class="mb-4 d-flex gap-2 align-items-center">
    <label for="colaborador_id" class="form-label mb-0">Colaborador:</label>
    <select id="colaborador_id" name="colaborador_id" class="form-select" style="max-width:300px;">
      <option value="">Todos</option>
      <?php foreach ($colaboradores as $col): ?>
        <option value="<?= $col['id'] ?>" <?= (isset($_GET['colaborador_id']) && $_GET['colaborador_id'] == $col['id']) ? 'selected' : '' ?>>
          <?= htmlspecialchars($col['nome']) ?>
        </option>
      <?php endforeach; ?>
    </select>
    
    <label for="mes" class="form-label mb-0">Mês:</label>
    <input type="number" id="mes" name="mes" class="form-control" min="1" max="12" style="width:70px;"
      value="<?= htmlspecialchars($_GET['mes'] ?? date('m')) ?>" />
    
    <label for="ano" class="form-label mb-0">Ano:</label>
    <input type="number" id="ano" name="ano" class="form-control" min="2000" max="2100" style="width:90px;"
      value="<?= htmlspecialchars($_GET['ano'] ?? date('Y')) ?>" />

    <button type="submit" class="btn btn-primary">Filtrar</button>
  </form>

  <?php if(isset($comissao)): ?>
    <div class="card mb-3">
      <div class="card-body">
        <h5>Resumo da Comissão para <?= htmlspecialchars($colaboradorSel['nome']) ?> - <?= sprintf("%02d", $mes) ?>/<?= $ano ?></h5>
        <p><strong>Total de Pranchas Produzidas:</strong> <?= $comissao['total_produzida'] ?></p>
        <p><strong>Total de Erros:</strong> <?= $comissao['total_erros'] ?></p>
        <p><strong>Pranchas Descontadas:</strong> <?= $comissao['desconto'] ?></p>
        <p><strong>Pranchas para Comissão:</strong> <?= $comissao['pranchas_comissionadas'] ?></p>
        <p><strong>Valor da Comissão:</strong> R$ <?= number_format($comissao['comissao_valor'], 2, ',', '.') ?></p>
      </div>
    </div>
  <?php else: ?>
    <p>Selecione um colaborador para ver a comissão.</p>
  <?php endif; ?>

</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

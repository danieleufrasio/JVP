<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content" style="max-width: 600px; margin: auto;">
  <h2>Parâmetros de Comissão - <?= htmlspecialchars($colaborador['nome']) ?></h2>

  <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']) ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']) ?>
  <?php endif; ?>

  <form method="post" action="" autocomplete="off">
    <div class="mb-3">
      <label for="meta_mensal" class="form-label">Meta Mensal (pranchas A1)</label>
      <input type="number" id="meta_mensal" name="meta_mensal" class="form-control" required
        value="<?= htmlspecialchars($parametros['meta_mensal'] ?? 15) ?>" />
    </div>
    <div class="mb-3">
      <label for="valor_16_30" class="form-label">Valor por prancha entre 16 e 30 (R$)</label>
      <input type="number" step="0.01" id="valor_16_30" name="valor_16_30" class="form-control" required
        value="<?= htmlspecialchars($parametros['valor_16_30'] ?? $parametros['valor_faixa_30'] ?? 18.70) ?>" />
    </div>
    <div class="mb-3">
      <label for="valor_acima_30" class="form-label">Valor por prancha acima de 30 (R$)</label>
      <input type="number" step="0.01" id="valor_acima_30" name="valor_acima_30" class="form-control" required
        value="<?= htmlspecialchars($parametros['valor_acima_30'] ?? 25.90) ?>" />
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary ms-2">Voltar</a>
  </form>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

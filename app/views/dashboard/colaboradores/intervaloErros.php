<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">

  <h2>Registro e Consulta de Erros Projetuais</h2>

  <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']) ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']) ?>
  <?php endif; ?>

  <form method="post" action="" class="mb-4" autocomplete="off">
    <div class="row g-3">
      <div class="col-md-4">
        <label for="colaborador_id" class="form-label">Colaborador</label>
        <select name="colaborador_id" id="colaborador_id" class="form-select" required>
          <option value="">Selecione</option>
          <?php foreach ($colaboradores as $col): ?>
            <option value="<?= $col['id'] ?>"><?= htmlspecialchars($col['nome']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-4">
        <label for="data" class="form-label">Data</label>
        <input type="date" id="data" name="data" class="form-control" required value="<?= date('Y-m-d') ?>" />
      </div>
      <div class="col-md-4">
        <label for="quantidade" class="form-label">Quantidade de Erros</label>
        <input type="number" id="quantidade" name="quantidade" class="form-control" required min="1" step="1" />
      </div>
    </div>
    <div class="mb-3 mt-2">
      <label for="descricao" class="form-label">Descrição / Observações</label>
      <textarea id="descricao" name="descricao" class="form-control"></textarea>
    </div>
    <button type="submit" class="btn btn-success">Registrar Erro</button>
    <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary ms-2">Voltar</a>
  </form>

  <h3>Últimos Erros Registrados</h3>

  <table class="table table-striped">
    <thead>
      <tr>
        <th>Data</th>
        <th>Colaborador</th>
        <th>Quantidade</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($erros)): ?>
        <tr><td colspan="5" class="text-center text-muted">Nenhum erro cadastrado.</td></tr>
      <?php else: ?>
        <?php foreach ($erros as $erro): ?>
          <tr>
            <td><?= htmlspecialchars($erro['data']) ?></td>
            <td><?= htmlspecialchars($erro['colaborador_nome']) ?></td>
            <td><?= htmlspecialchars($erro['quantidade']) ?></td>
            <td><?= htmlspecialchars($erro['descricao']) ?></td>
            <td>
              <a href="<?= BASE_URL ?>colaboradores/intervaloErrosExcluir/<?= $erro['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Excluir este erro?')">Excluir</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>

</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

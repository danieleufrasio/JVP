<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
  <h2>Colaboradores</h2>

  <?php if (!empty($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
    <?php unset($_SESSION['success']); ?>
  <?php endif; ?>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']); ?>
  <?php endif; ?>

  <div class="mb-3 d-flex flex-wrap gap-2 align-items-center">
    <a href="<?= BASE_URL ?>colaboradores/novo" class="btn btn-primary">Novo</a>
    <input id="buscaColaborador" type="text" placeholder="Pesquisar..." class="form-control" style="max-width: 250px;" aria-label="Pesquisar colaboradores" />
    <a href="<?= BASE_URL ?>colaboradores/cargos" class="btn btn-secondary">Cargos</a>
    <a href="<?= BASE_URL ?>colaboradores/comissoes" class="btn btn-secondary">Comissões</a>
    <a href="<?= BASE_URL ?>colaboradores/intervaloErros" class="btn btn-secondary">Erros</a>
    <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary">Fechar</a>
  </div>

  <table class="table table-striped" id="tabelaColaboradores" aria-describedby="tabelaColaboradores">
    <thead>
      <tr>
        <th scope="col">Código</th>
        <th scope="col">Nome</th>
        <th scope="col">Nível de Acesso</th>
        <th scope="col">Status</th>
        <th scope="col">E-mail</th>
        <th scope="col">Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if (empty($colaboradores)): ?>
        <tr><td colspan="7" class="text-center text-muted">Nenhum colaborador encontrado.</td></tr>
      <?php else: ?>
        <?php foreach ($colaboradores as $col): ?>
          <tr>
            <td><?= htmlspecialchars($col['codigo']) ?></td>
            <td><?= htmlspecialchars($col['nome']) ?></td>
            <td><?= htmlspecialchars(ucfirst($col['nivelacesso'])) ?></td>
            <td><?= htmlspecialchars(ucfirst($col['status'])) ?></td>
            <td><?= htmlspecialchars($col['email']) ?></td>
            <td>
              <a href="<?= BASE_URL ?>colaboradores/editar/<?= $col['id'] ?>" class="btn btn-sm btn-warning" title="Editar colaborador <?= htmlspecialchars($col['nome']) ?>">Editar</a>
              <a href="<?= BASE_URL ?>colaboradores/excluir/<?= $col['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Confirma excluir o colaborador <?= htmlspecialchars(addslashes($col['nome'])) ?>?')" title="Excluir colaborador <?= htmlspecialchars($col['nome']) ?>">Excluir</a>
              <a href="<?= BASE_URL ?>colaboradores/parametros/<?= $col['id'] ?>" class="btn btn-sm btn-info" title="Parâmetros de comissão do colaborador <?= htmlspecialchars($col['nome']) ?>">Parâmetros</a>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php endif; ?>
    </tbody>
  </table>
</main>

<script>
  document.getElementById('buscaColaborador').addEventListener('input', function(){
    const termo = this.value.trim();

    fetch(`<?= BASE_URL ?>colaboradores/pesquisarAjax?q=${encodeURIComponent(termo)}`)
      .then(res => res.json())
      .then(data => {
        let tbodyHTML = '';
        if(data.length === 0){
          tbodyHTML = '<tr><td colspan="7" class="text-center text-muted">Nenhum colaborador encontrado.</td></tr>';
        } else {
          data.forEach(col => {
            tbodyHTML += `
              <tr>
                <td>${col.codigo}</td>
                <td>${col.nome}</td>
                <td>${col.nivel_acesso.charAt(0).toUpperCase() + col.nivel_acesso.slice(1)}</td>
                <td>${col.status.charAt(0).toUpperCase() + col.status.slice(1)}</td>
                <td>${col.cargo || ''}</td>
                <td>${col.email}</td>
                <td>
                  <a href="<?= BASE_URL ?>colaboradores/editar/${col.id}" class="btn btn-sm btn-warning" title="Editar colaborador ${col.nome}">Editar</a>
                  <a href="<?= BASE_URL ?>colaboradores/excluir/${col.id}" class="btn btn-sm btn-danger" onclick="return confirm('Confirma excluir o colaborador ${col.nome}?')" title="Excluir colaborador ${col.nome}">Excluir</a>
                  <a href="<?= BASE_URL ?>colaboradores/parametros/${col.id}" class="btn btn-sm btn-info" title="Parâmetros do colaborador ${col.nome}">Parâmetros</a>
                </td>
              </tr>`;
          });
        }
        document.querySelector('#tabelaColaboradores tbody').innerHTML = tbodyHTML;
      });
  });
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

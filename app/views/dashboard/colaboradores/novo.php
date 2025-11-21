<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content" style="max-width:600px; margin:auto;">
  <h2>Novo Colaborador</h2>

  <?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
    <?php unset($_SESSION['error']) ?>
  <?php endif; ?>

  <form action="<?= BASE_URL ?>colaboradores/salvar" method="post" autocomplete="off">
    <div class="mb-3">
      <label for="codigo" class="form-label">Código</label>
      <input type="text" id="codigo" name="codigo" class="form-control" required value="<?= htmlspecialchars($_POST['codigo'] ?? '') ?>" />
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input type="text" id="nome" name="nome" class="form-control" required value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>" />
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">E-mail</label>
      <input type="email" id="email" name="email" class="form-control" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" />
    </div>
    <div class="mb-3">
      <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
      <select id="nivel_acesso" name="nivel_acesso" class="form-select" required>
        <option value="">Escolha...</option>
        <?php foreach ($niveis as $key => $label): ?>
          <option value="<?= $key ?>" <?= (isset($_POST['nivel_acesso']) && $_POST['nivel_acesso'] === $key) ? 'selected' : '' ?>><?= $label ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="status" class="form-label">Status</label>
      <select id="status" name="status" class="form-select" required>
        <option value="ativo" <?= (isset($_POST['status']) && $_POST['status'] === 'ativo') ? 'selected' : '' ?>>Ativo</option>
        <option value="inativo" <?= (isset($_POST['status']) && $_POST['status'] === 'inativo') ? 'selected' : '' ?>>Inativo</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="cargo" class="form-label">Cargo</label>
      <select id="cargo" name="cargo" class="form-select" required>
        <option value="">Escolha...</option>
        <option value="freelancer" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'freelancer') ? 'selected' : '' ?>>Freelancer</option>
        <option value="projetista" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'projetista') ? 'selected' : '' ?>>Projetista</option>
        <option value="calculista" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'calculista') ? 'selected' : '' ?>>Calculista</option>
        <option value="verificador" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'verificador') ? 'selected' : '' ?>>Verificador</option>
        <option value="adm" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'adm') ? 'selected' : '' ?>>Administrador</option>
        <option value="estagiario" <?= (isset($_POST['cargo']) && $_POST['cargo'] === 'estagiario') ? 'selected' : '' ?>>Estagiário</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="usuario" class="form-label">Usuário</label>
      <input type="text" id="usuario" name="usuario" class="form-control" required value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>" />
    </div>
    <div class="mb-3">
      <label for="senha" class="form-label">Senha</label>
      <input type="password" id="senha" name="senha" class="form-control" required autocomplete="new-password" />
    </div>

    <button type="submit" class="btn btn-success">Salvar</button>
    <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary ms-2">Cancelar</a>
  </form>

</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

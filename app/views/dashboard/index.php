<?php
$pdo = require __DIR__ . '/../../config/db.php';

// Depoimentos recentes
$stmtFb = $pdo->query("SELECT * FROM visitantesfeedback ORDER BY criadoem DESC");
$feedbacks = $stmtFb->fetchAll(PDO::FETCH_ASSOC);

// Título e descrição padrão
if (!isset($tituloServicos)) $tituloServicos = "Gerenciador de Serviços";
if (!isset($textoServicos)) $textoServicos = "Edite seus serviços e suas imagens aqui.";
?>

<main class="main-content container mt-4" style="max-width:1100px; min-width:700px;">
  <h1 class="mb-4">Painel do Dashboard</h1>
  <p>Bem-vindo ao painel!</p>

  <?php if(!empty($_SESSION['msg'])): ?>
    <div class="alert alert-info"><?= $_SESSION['msg']; unset($_SESSION['msg']); ?></div>
  <?php endif; ?>

  <!-- ================= GALERIA DE IMAGENS (mantida igual) ================= -->
  <!-- Upload de imagens -->
  <form action="<?= BASE_URL ?>dashboard/upload" method="POST" enctype="multipart/form-data" class="mb-4 text-center border p-4" style="border-style:dashed;max-width:600px;margin:auto;">
    <label for="images" class="form-label fs-6">Selecione ou arraste imagens aqui:</label>
    <input type="file" name="images[]" id="images" multiple required class="form-control mb-2" style="max-width:320px;display:inline-block;">
    <button type="submit" name="upload" class="btn btn-success">Adicionar Imagens</button>
  </form>

  <!-- Galeria de imagens -->
  <div class="row justify-content-center">
    <?php if (!empty($carouselImages)): ?>
      <?php foreach ($carouselImages as $img): ?>
        <div class="col-md-3 col-6 mb-4 position-relative text-center">
          <form action="<?= BASE_URL ?>dashboard/delete/<?= urlencode($img['filename']) ?>" method="post"
                style="position:absolute; right:8px; top:8px;z-index:2;"
                onsubmit="return confirm('Excluir esta imagem?')">
            <button type="submit" class="btn-close" aria-label="Excluir"></button>
          </form>
          <a href="<?= BASE_URL ?>uploads/<?= htmlspecialchars($img['filename']) ?>" target="_blank" style="display:block;">
            <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($img['filename']) ?>"
                alt="Imagem" class="img-fluid img-thumbnail rounded mb-2"
                style="max-width:180px; height:140px; object-fit:cover;">
          </a>
          <div class="d-grid gap-2">
            <button type="button" class="btn btn-sm btn-primary"
                    onclick="definirComoFundo('<?= htmlspecialchars($img['filename']) ?>')">
              Definir como Fundo
            </button>
            <a href="<?= BASE_URL ?>uploads/<?= htmlspecialchars($img['filename']) ?>"
               download class="btn btn-sm btn-secondary" title="Download da imagem">
              <i class="fas fa-download"></i> Baixar
            </a>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="col-12 text-center p-5 text-muted">
        <p>Nenhuma imagem cadastrada.</p>
      </div>
    <?php endif; ?>
  </div>

  <!-- ================= GERENCIADOR DE SERVIÇOS ================= -->
  <section class="my-5">
    <h2 class="text-center mb-4"><?= htmlspecialchars($tituloServicos) ?></h2>
    <p class="text-center text-muted mb-4"><?= htmlspecialchars($textoServicos) ?></p>

    <!-- Formulário de novo serviço -->
    <form action="<?= BASE_URL ?>dashboard/servicos_create" method="post" enctype="multipart/form-data"
          class="border p-4 rounded mb-4 shadow-sm" style="max-width:650px;margin:auto;">
      <h5 class="mb-3 text-center text-primary">Adicionar novo serviço</h5>
      <input type="text" name="titulo" class="form-control mb-2" placeholder="Título do serviço" required>
      <textarea name="descricao" class="form-control mb-2" rows="3" placeholder="Descrição" required></textarea>
      <input type="file" name="imagem" class="form-control mb-3" accept="image/*" required>
      <div class="text-end">
        <button type="submit" class="btn btn-success">Cadastrar Serviço</button>
      </div>
    </form>

    <!-- Cards listando serviços -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 pb-5">
      <?php if (!empty($servicos)): ?>
        <?php foreach ($servicos as $servico): ?>
          <div class="col">
            <div class="card h-100 text-center shadow border-0">
              <?php if (!empty($servico['imagem'])): ?>
                <img src="<?= BASE_URL ?>public/img/<?= htmlspecialchars($servico['imagem']) ?>"
                     alt="Imagem do serviço"
                     class="img-thumbnail mt-3 mb-2"
                     style="height:90px;max-width:130px;object-fit:cover; margin:auto;">
              <?php else: ?>
                <div style="font-size:3em; color:#1abc9c; margin:28px 0 10px 0;">
                  <i class="fas fa-cogs"></i>
                </div>
              <?php endif; ?>
              <div class="card-body">
                <h5 class="card-title mb-2"><?= htmlspecialchars($servico['titulo']) ?></h5>
                <p class="card-text text-muted"><?= htmlspecialchars($servico['descricao']) ?></p>
              </div>
              <div class="card-footer bg-white border-0 d-flex justify-content-center gap-2 py-2">
                <a href="<?= BASE_URL ?>dashboard/servicos_edit/<?= $servico['id'] ?>" class="btn btn-sm btn-warning">
                  <i class="fas fa-edit"></i></a>
                <a href="<?= BASE_URL ?>dashboard/servicos_delete/<?= $servico['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Excluir este serviço?');"><i class="fas fa-trash"></i></a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center mt-5 mb-5 text-muted">
          Nenhum serviço cadastrado.
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ================= DEPOIMENTOS ================= -->
  <section class="my-5">
    <h3 class="mb-4 text-center">Depoimentos Recentes</h3>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <?php foreach (array_slice($feedbacks, 0, 6) as $fb): ?>
        <div class="col">
          <div class="card h-100 shadow bg-light">
            <div class="card-body text-center">
              <img src="<?= htmlspecialchars($fb['photo'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($fb['nome'] ?? 'Visitante') . '&background=007bff&color=fff&size=72') ?>"
                   alt="<?= htmlspecialchars($fb['nome'] ?? 'Visitante') ?>"
                   class="rounded-circle mb-2" width="54" height="54"
                   style="object-fit:cover;border:2px solid #007bff;">
              <h5 class="card-title mb-1"><?= htmlspecialchars($fb['nome'] ?: 'Anônimo') ?></h5>
              <p class="mb-2 text-muted small"><?= htmlspecialchars($fb['email']) ?></p>
              <div class="mb-2" style="color:#FFD700; font-size:1.16em;">
                <?= str_repeat('★', (int)$fb['nota']) . str_repeat('☆', 5 - (int)$fb['nota']) ?>
              </div>
              <p class="card-text"><?= nl2br(htmlspecialchars($fb['comentario'])) ?></p>
            </div>
            <div class="card-footer text-muted text-end small">
              <?= date('d/m/Y H:i', strtotime($fb['criadoem'])) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ================= TABELA DE DEPOIMENTOS ================= -->
  <div class="mt-5 p-4 border bg-white rounded shadow-sm" style="max-width: 900px; margin:auto;">
    <h3 class="mb-4">Depoimentos e E-mails dos Clientes</h3>
    <?php if (!empty($feedbacks)): ?>
      <table class="table table-sm table-bordered">
        <thead>
          <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Nota</th>
            <th>Comentário</th>
            <th>Data</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($feedbacks as $fb): ?>
            <tr>
              <td><?= htmlspecialchars($fb['nome'] ?: 'Anônimo') ?></td>
              <td><?= htmlspecialchars($fb['email']) ?></td>
              <td><?= htmlspecialchars($fb['nota']) ?></td>
              <td><?= nl2br(htmlspecialchars($fb['comentario'])) ?></td>
              <td><?= date('d/m/Y H:i', strtotime($fb['criadoem'])) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    <?php else: ?>
      <p class="text-muted text-center">Nenhum depoimento encontrado.</p>
    <?php endif; ?>
  </div>
</main>

<!-- FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<script>
function definirComoFundo(filename) {
  if(confirm('Definir esta imagem como background do site?')) {
    fetch('<?= BASE_URL ?>dashboard/setBackground/' + encodeURIComponent(filename), {method: "POST"})
      .then(res => {
        if(res.ok) {
          alert('Background atualizado!');
          location.reload();
        } else {
          alert('Erro ao definir background.');
        }
      });
  }
}
</script>

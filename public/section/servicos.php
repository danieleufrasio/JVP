<?php
$host = 'localhost';
$dbname = 'jvp-1';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM servicos ORDER BY criadoem DESC");
    $servicos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<section class="container my-5">
  <h2 class="text-center mb-4">Nossos Serviços</h2>
  <?php if (!empty($servicos)): ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
      <?php foreach ($servicos as $servico): ?>
        <div class="col">
          <div class="card h-100 text-center shadow-sm border-0">
            <?php if (!empty($servico['imagem'])): ?>
              <img src="<?= BASE_URL ?>public/img/<?= htmlspecialchars($servico['imagem']) ?>"
                   alt="<?= htmlspecialchars($servico['titulo']) ?>"
                   class="card-img-top"
                   style="height:160px;object-fit:cover;">
            <?php else: ?>
              <div style="font-size:4em; color:#1abc9c; margin:40px 0;">
                <i class="fas fa-cogs"></i>
              </div>
            <?php endif; ?>
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($servico['titulo']) ?></h5>
              <p class="card-text text-muted"><?= htmlspecialchars($servico['descricao']) ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <p class="text-center text-muted mt-5 mb-5">Nenhum serviço disponível no momento.</p>
  <?php endif; ?>
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

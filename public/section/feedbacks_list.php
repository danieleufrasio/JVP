<?php
$host = 'localhost';
$dbname = 'jvp-1';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM visitantesfeedback ORDER BY criadoem DESC");
    $comentarios = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8" />
<title>Depoimentos dos Visitantes</title>
<style>
  body {
      font-family: Arial, sans-serif;
      background: #f4f9fc;
      margin: 0;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
  }
  .depoimentos-swiper {
      max-width: 800px;
      margin: 40px auto;
      padding: 30px 20px 32px 20px;
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.12);
      position: relative;
      border: 1px solid #e9ebed;
  }
  .depoimentos-wrapper {}
  .depoimentos-slide {
      background: #f7f9fc;
      border: none;
      border-radius: 16px;
      padding: 24px 18px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.07);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      min-height: 250px;
      transition: box-shadow 0.3s;
  }
  .depoimentos-slide:hover {
      box-shadow: 0 4px 16px rgba(0,0,0,0.13);
      background: #e7eef6;
  }
  .depoimentos-avatar {
      border-radius: 50%;
      width: 72px;
      height: 72px;
      object-fit: cover;
      margin-bottom: 14px;
      border: 3px solid #007bff;
      background: #fff;
      box-shadow: 0 1px 8px rgba(0,0,0,0.06);
  }
  .depoimentos-header {
      font-weight: 700;
      font-size: 1.18em;
      color: #007bff;
      margin-bottom: 4px;
  }
  .depoimentos-email {
      font-size: 0.96em;
      color: #444;
      margin-bottom: 10px;
      font-style: italic;
      letter-spacing: 0.01em;
  }
  .depoimentos-stars {
      color: #FFD700;
      font-size: 1.25em;
      margin-bottom: 11px;
  }
  .depoimentos-text {
      font-size: 1em;
      color: #334;
      flex-grow: 1;
      overflow-wrap: break-word;
      line-height: 1.6;
      margin-bottom: 12px;
  }
  .depoimentos-date {
      font-size: 0.84em;
      color: #888;
      margin-top: 6px;
  }
  .depoimentos-next, .depoimentos-prev {
      color: #007bff;
      position: absolute;
      top: 53%;
      width: 40px;
      height: 40px;
      margin-top: -20px;
      z-index: 10;
      cursor: pointer;
      background: rgba(255,255,255,0.96);
      border-radius: 20px;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
      border: 1px solid #e9ebed;
      transition: background 0.2s;
  }
  .depoimentos-prev {
      left: -54px;
  }
  .depoimentos-next {
      right: -54px;
  }
  .depoimentos-next:hover, .depoimentos-prev:hover {
      background: #edf6ff;
  }
  .depoimentos-pagination {
      margin-top: 18px;
      text-align: center;
  }
  .depoimentos-pagination .swiper-pagination-bullet {
      background: #007bff;
      opacity: 0.45;
  }
  .depoimentos-pagination .swiper-pagination-bullet-active {
      opacity: 1;
  }
  @media (max-width: 950px) {
      .depoimentos-swiper {
          max-width: 98vw;
          padding-left: 4vw;
          padding-right: 4vw;
      }
      .depoimentos-prev { left: 5px;}
      .depoimentos-next { right: 5px;}
  }
  @media (max-width: 767px) {
      .depoimentos-swiper {
          max-width: 100vw;
          padding: 14px 3vw 20px 3vw;
      }
      .depoimentos-slide {
          min-height: unset;
          padding: 15px 10px;
      }
      .depoimentos-avatar { width: 52px; height: 52px;}
      .depoimentos-prev,
      .depoimentos-next { top: 53%; left: 4px; right: 4px;}
  }
</style>
</head>
<body>

<div class="depoimentos-swiper swiper" aria-label="Depoimentos dos Visitantes">
  <div class="depoimentos-wrapper swiper-wrapper">
    <?php foreach ($comentarios as $c): ?>
    <div class="depoimentos-slide swiper-slide" role="group" aria-label="Comentário de <?= htmlspecialchars($c['nome'] ?? 'Visitante') ?>">
      <img src="<?= htmlspecialchars($c['photo'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($c['nome'] ?? 'Visitante') . '&background=007bff&color=fff&size=72') ?>"
           alt="Foto de <?= htmlspecialchars($c['nome'] ?? 'Visitante') ?>"
           class="depoimentos-avatar">
      <div class="depoimentos-header"><?= htmlspecialchars($c['nome'] ?? 'Visitante') ?></div>
      <div class="depoimentos-email"><?= htmlspecialchars($c['email'] ?? 'Desconhecido') ?></div>
      <div class="depoimentos-stars">
        <?= isset($c['nota']) ? str_repeat('★', (int)$c['nota']) . str_repeat('☆', 5 - (int)$c['nota']) : '☆ ☆ ☆ ☆ ☆' ?>
      </div>
      <div class="depoimentos-text"><?= nl2br(htmlspecialchars($c['comentario'] ?? 'Sem comentário')) ?></div>
      <div class="depoimentos-date"><?= isset($c['criadoem']) ? date('d/m/Y H:i', strtotime($c['criadoem'])) : '' ?></div>
    </div>
    <?php endforeach; ?>
  </div>
  <div class="depoimentos-next swiper-button-next" aria-label="Próximo comentário"></div>
  <div class="depoimentos-prev swiper-button-prev" aria-label="Comentário anterior"></div>
  <div class="depoimentos-pagination swiper-pagination" aria-label="Paginação dos comentários"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  var swiperDepoimentos = new Swiper('.depoimentos-swiper', {
      slidesPerView: 2,
      spaceBetween: 28,
      navigation: {
        nextEl: '.depoimentos-next',
        prevEl: '.depoimentos-prev',
      },
      pagination: {
        el: '.depoimentos-pagination',
        clickable: true,
      },
      loop: true,
      centeredSlides: true,
      autoHeight: true,
      keyboard: {
          enabled: true,
          onlyInViewport: false,
      },
      breakpoints: {
        767: { slidesPerView: 1 }
      }
  });
});
</script>


</body>
</html>

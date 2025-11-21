<section class="hero position-relative w-100" id="Home" style="height:100vh; min-height:580px; width:100vw; left:0;">
  <!-- Overlay visual -->
  <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay"
       style="background:rgba(30,42,56,0.48); pointer-events:none; z-index:1;"></div>

  <!-- Carrossel Bootstrap -->
  <div id="heroCarousel" class="carousel slide w-100 h-100 position-relative" data-bs-ride="carousel" style="z-index:2; min-height:100vh; width:100vw;">
    <div class="carousel-inner h-100">
      <?php foreach ($carouselImages as $index => $img): ?>
        <div class="carousel-item h-100 <?php if ($index === 0) echo 'active'; ?>">
          <img src="<?= BASE_URL ?>uploads/<?= htmlspecialchars($img['filename']) ?>"
               class="d-block w-100 h-100 object-fit-cover"
               alt="Slide"
               style="object-fit:cover; max-width:100vw; max-height:100vh; min-width:100vw;">
        </div>
      <?php endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev" style="z-index:3;">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next" style="z-index:3;">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Próximo</span>
    </button>
    <div class="carousel-indicators" style="z-index:4;">
      <?php foreach ($carouselImages as $index => $img): ?>
        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?= $index ?>"
                class="<?php if ($index === 0) echo 'active'; ?>"
                aria-current="true" aria-label="Slide <?= $index + 1 ?>"></button>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- Conteúdo central hero -->
  <div class="hero-content position-absolute top-50 start-50 translate-middle text-white text-center px-3"
       style="max-width:680px; z-index:5; pointer-events:auto;">
    <h1 class="display-4 fw-bold mb-3" style="line-height:1.1;">
      Construa com Confiança,<br />
      <span class="text-success d-block">Engenharia que Transforma</span>
    </h1>
    <p class="lead mb-4" style="font-size:1.28em;">
      Projetamos estruturas seguras,<br class="d-md-none" />
      modernas e eficientes. Da ideia ao concreto, somos seu parceiro técnico completo.
    </p>
    <a href="#Contatos" class="btn btn-success btn-lg shadow-sm">Fale com a gente</a>
  </div>
</section>

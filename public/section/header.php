<?php
$logado = !empty($_SESSION['colaborador']);
$adminBarHeight = 48;
?>

<?php if ($logado): ?>
  <div style="width:100%; background:#222; color:#fff; font-size:14px; padding:8px 0; position:fixed; top:0; left:0; z-index:1200;">
    <div class="container-fluid d-flex justify-content-between align-items-center">
      <div>
        <i class="fas fa-user-lock me-2"></i>
        Logado como <strong><?= htmlspecialchars($_SESSION['colaborador']['nome']) ?></strong>
        (<span class="text-secondary"><?= htmlspecialchars($_SESSION['colaborador']['email']) ?></span>)
      </div>
      <div>
        <a href="<?= BASE_URL ?>dashboard" class="text-light me-3"><i class="fas fa-tachometer-alt me-1"></i>Dashboard</a>
        <a href="<?= BASE_URL ?>auth/logout" class="btn btn-outline-light btn-sm">Sair</a>
      </div>
    </div>
  </div>
  <!-- Espaço para aba admin bar -->
  <div style="height:<?= $adminBarHeight ?>px;"></div>
<?php endif; ?>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top"
  <?php if ($logado): ?> style="top:<?= $adminBarHeight ?>px;"<?php endif; ?>>
  <div class="container">
    <a class="navbar-brand" href="#Home">
      <img src="/JVP/public/img/logo.jpg" alt="JVP Engenharia" height="50" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="#Home">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="#Sobre">Sobre nós</a></li>
        <li class="nav-item"><a class="nav-link" href="#Servicos">Serviços</a></li>
        <li class="nav-item"><a class="nav-link" href="#Contatos">Contatos</a></li>
      </ul>
      <div class="d-none d-lg-flex gap-3 align-items-center">
        <a href="#"><img src="/JVP/public/img/instagram-brands.svg" alt="Instagram" height="26" /></a>
        <a href="#"><img src="/JVP/public/img/facebook-brands (1).svg" alt="Facebook" height="26" /></a>
        <a href="#"><img src="/JVP/public/img/whatsapp-brands.svg" alt="WhatsApp" height="26" /></a>
        <a href="#"><img src="/JVP/public/img/linkedin-brands.svg" alt="LinkedIn" height="26" /></a>
      </div>
    </div>
  </div>
</nav>

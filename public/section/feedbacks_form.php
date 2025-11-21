<div id="comment-form-container" class="mt-5" style="max-width:600px; margin:auto;">
  <h3 class="mb-4">Deixe seu comentário</h3>

  <?php
  if (session_status() === PHP_SESSION_NONE) session_start();
  if (empty($_SESSION['token_comentario'])) {
    $_SESSION['token_comentario'] = bin2hex(random_bytes(32));
  }
  $nome = $email = "";
  $readonlyNome = $readonlyEmail = "";
  if (isset($_SESSION['colaborador'])) {
    $nome = htmlspecialchars($_SESSION['colaborador']['nome']);
    $email = htmlspecialchars($_SESSION['colaborador']['email']);
    $readonlyNome = "readonly";
    $readonlyEmail = "readonly";
  }
  ?>

  <form id="comment-form" method="POST" action="<?= BASE_URL ?>visitante/enviarComentario" novalidate autocomplete="off">
    <input type="hidden" name="token" value="<?= $_SESSION['token_comentario'] ?>">

    <div class="d-flex align-items-start mb-3">
      <img src="https://ui-avatars.com/api/?name=<?= urlencode($nome ?: 'Visitante') ?>&background=eee&color=555&size=80" 
           alt="avatar" class="rounded-circle me-3" width="60" height="60">
      <div style="flex:1">
        <textarea id="comment" name="comentario" class="form-control mb-2" rows="3" placeholder="Escreva seu comentário aqui..." required></textarea>
        <div class="row g-2">
          <div class="col-md-6 mb-2 mb-md-0">
            <input type="text" id="nome" name="nome" class="form-control" value="<?= $nome ?>" <?= $readonlyNome ?> placeholder="Seu nome" required>
          </div>
          <div class="col-md-6">
            <input type="email" id="email" name="email" class="form-control" value="<?= $email ?>" <?= $readonlyEmail ?> placeholder="Seu e-mail" required>
          </div>
        </div>
      </div>
    </div>

    <div class="mb-3">
      <label for="star-rating" class="form-label">Avaliação</label>
      <div id="star-rating" style="font-size:2rem; color:#FFD700; cursor:pointer;">
        <i class="fa-regular fa-star" data-value="1"></i>
        <i class="fa-regular fa-star" data-value="2"></i>
        <i class="fa-regular fa-star" data-value="3"></i>
        <i class="fa-regular fa-star" data-value="4"></i>
        <i class="fa-regular fa-star" data-value="5"></i>
      </div>
      <input type="hidden" id="nota" name="nota" value="" required>
    </div>

    <button type="submit" class="btn btn-primary px-4">Publicar Comentário</button>
  </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Interatividade estrela
  const estrelas = document.querySelectorAll('#star-rating i');
  const notaInput = document.getElementById('nota');
  let rating = 0;
  function highlightStars(n) {
    estrelas.forEach((star, i) => {
      if (i < n) {
        star.classList.add('fa-solid');
        star.classList.remove('fa-regular');
      } else {
        star.classList.remove('fa-solid');
        star.classList.add('fa-regular');
      }
    });
  }
  estrelas.forEach((star, idx) => {
    star.addEventListener('mouseenter', () => highlightStars(idx + 1));
    star.addEventListener('mouseleave', () => highlightStars(rating));
    star.addEventListener('click', () => {
      rating = idx + 1;
      notaInput.value = rating;
      highlightStars(rating);
    });
  });

  // Validar nota obrigatória ao enviar
  const commentForm = document.getElementById('comment-form');
  if (commentForm) {
    commentForm.addEventListener('submit', function (event) {
      if (!notaInput.value || isNaN(notaInput.value) || notaInput.value < 1 || notaInput.value > 5) {
        event.preventDefault();
        alert('Por favor, dê sua nota antes de enviar o comentário!');
      }
    });
  }
});
</script>

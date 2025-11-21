// ===================== MENU MOBILE =====================
const menu = document.getElementById('op-menu');
function show() { menu.style.display = "flex"; }
function close1() { menu.style.display = "none"; }

// ===================== ANIMAÇÃO DE REVELAÇÃO =====================
const observer = new IntersectionObserver((entries, obs) => {
  entries.forEach((entry, index) => {
    if (entry.isIntersecting) {
      if (entry.target.classList.contains('text-section')) {
        entry.target.classList.add('reveal');
      } else if (entry.target.tagName === 'IMG') {
        setTimeout(() => {
          entry.target.classList.add('reveal');
        }, index * 200);
      }
      obs.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });
document.querySelectorAll('.image-grid img, .text-section').forEach(el => observer.observe(el));

// ===================== LINHA DO TEMPO (ELEVADOR) =====================
const elevator = document.getElementById('elevator');
const doors = document.getElementById('doors');
function goToFloor(floor) {
  doors.classList.remove('open');
  setTimeout(() => {
    elevator.style.transform = `translateY(-${floor * 100}vh)`;
  }, 300);
  setTimeout(() => {
    doors.classList.add('open');
  }, 2300);
}
window.addEventListener('DOMContentLoaded', () => {
  setTimeout(() => doors.classList.add('open'), 800);
});

// ===================== SWIPER HERO =====================
document.addEventListener("DOMContentLoaded", function() {
  new Swiper('.hero-swiper', {
    loop: true,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    autoplay: { delay: 3200, disableOnInteraction: false }
  });
});

// ===================== ESTRELAS INTERATIVAS FORMULÁRIO =====================
document.addEventListener('DOMContentLoaded', function() {
  const estrelas = document.querySelectorAll('#star-rating i');
  const notaInput = document.getElementById('nota');
  let rating = 0;
  estrelas.forEach((star, idx) => {
    star.addEventListener('mouseenter', () => highlightStars(idx + 1));
    star.addEventListener('mouseleave', () => highlightStars(rating));
    star.addEventListener('click', () => {
      rating = idx + 1;
      notaInput.value = rating;
      highlightStars(rating);
    });
  });
  function highlightStars(n) {
    estrelas.forEach((star, i) => {
      if (i < n) {
        star.classList.remove('fa-regular');
        star.classList.add('fa-solid');
      } else {
        star.classList.remove('fa-solid');
        star.classList.add('fa-regular');
      }
    });
  }
});

// ===================== FEEDBACK AJAX (COMENTÁRIOS) =====================
function carregarComentarios() {
  fetch('index.php?url=feedback/listAjax')
    .then(res => res.text())
    .then(html => {
      const comentariosLista = document.getElementById('comentarios-lista');
      if (comentariosLista) comentariosLista.innerHTML = html;
    })
    .catch(err => console.error('Erro ao carregar comentários:', err));
}

if (form) {
  form.addEventListener('submit', e => {
    e.preventDefault();
    const data = {
      email: form.email.value,
      nota: parseInt(form.nota.value),
      comentario: form.comment.value.trim()
    };
    if (!data.nota || data.nota < 1 || data.nota > 5) {
      alert('Selecione sua avaliação pelas estrelas.');
      return;
    }
    fetch('index.php?url=feedback/addAjax', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    })
      .then(res => res.text().then(txt => {
        if (res.ok) {
          form.reset();
          rating = 0;
          highlightStars(0);
          carregarComentarios();
          alert('Depoimento enviado com sucesso!');
        } else {
          alert('Erro ao enviar depoimento: ' + txt);
        }
      }))
      .catch(err => {
        alert('Erro ao enviar, tente novamente.');
        console.error(err);
      });
  });
}

carregarComentarios();


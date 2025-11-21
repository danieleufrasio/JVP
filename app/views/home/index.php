<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>JVP Engenharia</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
</head>
<body style="background: #f9f9f9;">
  <?php include __DIR__ . '/../../../public/section/header.php'; ?>
  <?php include __DIR__ . '/../../../public/section/hero.php'; ?>
  <?php include __DIR__ . '/../../../public/section/sobre.php'; ?>
  <?php include __DIR__ . '/../../../public/section/servicos.php'; ?>
  <?php include __DIR__ . '/../../../public/section/feedbacks_form.php'; ?>
  <?php
    // $recentes já definido e passado pelo controller
    require_once __DIR__ . '/../../../public/section/feedbacks_list.php';
  ?>
  <?php include __DIR__ . '/../../../public/section/linha_do_tempo.php'; ?>
  <?php include __DIR__ . '/../../../public/section/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= BASE_URL ?>public/js/home.js"></script>
</body>
</html>

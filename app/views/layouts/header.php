<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        .profile-img, .avatar-circle {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            font-weight: bold;
        }
        .dropdown-menu {
            min-width: 200px;
            border: none;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .dropdown-item {
            padding: 8px 16px;
            transition: all 0.2s;
        }
        .dropdown-item:hover {
            background-color: #f8f9fa;
            padding-left: 20px;
        }
        .dropdown-divider {
            margin: 5px 0;
        }
        .nav-link {
            font-weight: 500;
        }
        .header-shadow {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        header {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    z-index: 1050;
}
            .sidebar {
                position: fixed;
                top: 80px; /* altura do header */
                left: 0;
                width: 250px;
                height: calc(100vh - 80px);
                background: #f8f9fa;
                border-right: 1px solid #dee2e6;
                z-index: 1030;
                overflow-y: auto;
                transition: left 0.3s;
                padding-top: 80px; /* espaço para o perfil */
}

        .main-content {
            margin-left: 250px;
            padding: 24px 32px 0 32px;
            padding-top: 200px; /* altura do header + espaçamento extra */
            min-height: 100vh;
            background: #fff;
        }
        @media (max-width: 991.98px) {
            .sidebar {
                left: -250px;
            }
            .sidebar.active {
                left: 0;
            }
            .main-content {
                margin-left: 0 !important;
            }
            #sidebarToggle {
                display: block !important;
            }
        }
        #sidebarToggle {
            display: none;
            position: fixed;
            top: 90px;
            left: 10px;
            z-index: 2001;
        }

    </style>
</head>
<body>
    <!-- Header/Navbar -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white header-shadow py-3">
            <div class="container">
                <a class="navbar-brand text-primary" href="<?= BASE_URL ?>">
                    <i class="fas fa-rocket me-2"></i>Sistema de Gestão
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item"><a class="nav-link active" href="<?= BASE_URL ?>dashboard">Início</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>clientes">Clientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>obras">Obras</a></li>
                        <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>relatorios">Relatórios</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
    <?php if (!empty($_SESSION['colaborador'])): 
        $colab = $_SESSION['colaborador'];
    ?>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
            <?php if (!empty($colab['foto'])): ?>
                <img src="<?= htmlspecialchars($colab['foto']) ?>" alt="Profile" class="profile-img me-2">
            <?php else: ?>
                <span class="avatar-circle me-2">
                    <?= strtoupper(mb_substr($colab['nome'], 0, 1, 'UTF-8')) ?>
                </span>
            <?php endif; ?>
            <span class="d-none d-sm-inline"><?= htmlspecialchars($colab['nome']) ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
            <li class="dropdown-header px-3 py-2">
                <h6 class="mb-0"><?= htmlspecialchars($colab['nome']) ?></h6>
                <small class="text-muted"><?= htmlspecialchars($colab['email']) ?></small>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>profile">
                    <i class="fas fa-user me-2"></i> Meu Perfil
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>configuracoes">
                    <i class="fas fa-cog me-2"></i> Configurações
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>notificacoes">
                    <i class="fas fa-bell me-2"></i> Notificações
                </a>
            </li>
            <li>
                <a class="dropdown-item" href="<?= BASE_URL ?>ajuda">
                    <i class="fas fa-question-circle me-2"></i> Ajuda
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
            <li>
                <a class="dropdown-item text-danger" href="<?= BASE_URL ?>auth/logout">
                    <i class="fas fa-sign-out-alt me-2"></i> Sair
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
</div>

                </div>
            </div>
        </nav>
    </header>
<?php require_once 'sidebar.php' ?>
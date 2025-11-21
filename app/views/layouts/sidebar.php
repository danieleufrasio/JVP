<nav class="sidebar" style="width:250px; min-height:100vh; background:#f8f9fa; border-right:1px solid #dee2e6; position:fixed; top:0; left:0; z-index:1030;">
    <div class="position-sticky pt-3">
        <?php if (!empty($_SESSION['colaborador'])): ?>
            <div class="d-flex align-items-center p-3 mb-3 border-bottom bg-white rounded shadow-sm">
                <div class="flex-shrink-0">
                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                        style="width:44px; height:44px; font-size:1.5rem; user-select:none;">
                        <?= strtoupper(substr($_SESSION['colaborador']['nome'], 0, 1)) ?>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <strong><?= htmlspecialchars($_SESSION['colaborador']['nome']) ?></strong>
                   <div class="text-muted small">
    <?= htmlspecialchars(isset($_SESSION['colaborador']['nivel_acesso']) && $_SESSION['colaborador']['nivel_acesso'] !== null ? ucfirst($_SESSION['colaborador']['nivel_acesso']) : '') ?></div>

                    <div class="dropdown mt-1">
                        <a class="btn btn-sm btn-link p-0 text-decoration-none dropdown-toggle" href="#" role="button"
                            id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                            Perfil
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownProfile">
                            <li><a class="dropdown-item" href="<?= BASE_URL ?>profile">Meu Perfil</a></li>
                            <li><a class="dropdown-item text-danger" href="<?= BASE_URL ?>logout">Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <ul class="nav flex-column">
            <?php
            $menuItems = [
                ['url' => 'dashboard', 'icon' => 'fas fa-home', 'label' => 'Dashboard'],
                ['url' => 'clientes', 'icon' => 'fas fa-users', 'label' => 'Clientes'],
                ['url' => 'obras', 'icon' => 'fas fa-briefcase', 'label' => 'Obras'],
                ['url' => 'tiposProjeto', 'icon' => 'fas fa-layer-group', 'label' => 'Tipos de Projeto'],
                ['url' => 'elementos', 'icon' => 'fas fa-th', 'label' => 'Elementos'],
                ['url' => 'tiposPapel', 'icon' => 'fas fa-file-alt', 'label' => 'Tipos de Papel'],
                ['url' => 'colaboradores', 'icon' => 'fas fa-user-check', 'label' => 'Colaboradores'],
                ['url' => 'fornecedores', 'icon' => 'fas fa-truck', 'label' => 'Fornecedores'],
                ['url' => 'pavimentos', 'icon' => 'fas fa-building', 'label' => 'Pavimentos'],
                ['url' => 'pranchas', 'icon' => 'fas fa-clone', 'label' => 'Pranchas'],
                ['url' => 'meiospagamento', 'icon' => 'fas fa-credit-card', 'label' => 'Meios de Pagamento'],
                ['url' => 'RelatorioPranchas', 'icon' => 'fas fa-file-pdf', 'label' => 'Relatorio Pranchas', 'highlight' => true],
                ['url' => 'configuracoes', 'icon' => 'fas fa-cogs', 'label' => 'Configurações'],
                ['url' => 'ajuda', 'icon' => 'fas fa-question-circle', 'label' => 'Ajuda'],
                ['url' => 'logout', 'icon' => 'fas fa-sign-out-alt', 'label' => 'Sair'],
            ];

            foreach ($menuItems as $item):
                $activeClass = !empty($item['highlight']) ? ' fw-bold text-primary' : '';
            ?>
                <li class="nav-item">
                    <a href="<?= BASE_URL . $item['url'] ?>" class="nav-link<?= $activeClass ?>">
                        <i class="<?= $item['icon'] ?> me-2"></i> <?= htmlspecialchars($item['label']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

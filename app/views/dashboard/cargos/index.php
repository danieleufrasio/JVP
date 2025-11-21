<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content" style="max-width: 900px; margin: auto;">
    <h2>Cargos</h2>

    <?php if (!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (!empty($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <div class="mb-3">
        <a href="<?= BASE_URL ?>cargos/novo" class="btn btn-primary">Novo Cargo</a>
        <a href="<?= BASE_URL ?>colaboradores" class="btn btn-secondary">Voltar para Colaboradores</a>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Cargo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($cargos)): ?>
                <tr><td colspan="3" class="text-center text-muted">Nenhum cargo cadastrado.</td></tr>
            <?php else: ?>
                <?php foreach ($cargos as $cargo): ?>
                    <tr>
                        <td><?= htmlspecialchars($cargo['id']) ?></td>
                        <td><?= htmlspecialchars($cargo['nome']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>cargos/editar/<?= $cargo['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= BASE_URL ?>cargos/excluir/<?= $cargo['id'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Tem certeza que deseja excluir este cargo?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

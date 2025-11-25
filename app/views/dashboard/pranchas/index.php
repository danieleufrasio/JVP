<?php include_once __DIR__ . '/../../layouts/header.php'; ?>
<main class="main-content">
    <div class="main-inner" style="max-width:1050px;margin:0 auto;">
        <h2 class="mb-3 mt-0 text-center">Lista de Pranchas</h2>

        <?php if (!empty($_SESSION['success'])): ?>
            <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></div>
        <?php endif; ?>
        <?php if (!empty($_SESSION['error'])): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <div class="mb-3 d-flex justify-content-between align-items-center flex-wrap">
            <form class="d-flex gap-2" action="<?= BASE_URL ?>pranchas/pesquisar" method="get">
                <input type="text" name="q" class="form-control" style="max-width:220px" placeholder="Filtrar por código, nome ou obra...">
                <button class="btn btn-outline-primary">Pesquisar</button>
            </form>
            <a href="<?= BASE_URL ?>pranchas/novo" class="btn btn-success">Nova Prancha</a>
        </div>

        <div class="table-responsive rounded shadow-sm">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>ID</th>
                        <th>Código</th>
                        <th>Cliente</th>
                        <th>Obra</th>
                        <th>Tipo Projeto</th>
                        <th>Elemento</th>
                        <th>Pavimento</th>
                        <th>Papel</th>
                        <th>Colaboradores</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($pranchas as $prancha): ?>
                    <tr>
                        <td><?= htmlspecialchars($prancha['id'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['codigo'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['cliente_nome'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['obra_nome'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['tipo_projeto_sigla'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['elemento_sigla'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['pavimento_sigla'] ?? '') ?></td>
                        <td><?= htmlspecialchars($prancha['tipo_papel_sigla'] ?? '') ?></td>
                        <td>
                            <strong>Projetista:</strong> <?= htmlspecialchars($prancha['projetista_nome'] ?? '-') ?><br>
                            <strong>Verificador:</strong> <?= htmlspecialchars($prancha['verificador_nome'] ?? '-') ?><br>
                            <strong>Calculista:</strong> <?= htmlspecialchars($prancha['calculista_nome'] ?? '-') ?>
                        </td>
                        <td>
                            <span class="badge
                                <?= $prancha['status'] == 'ativo' ? 'bg-success' : (
                                    $prancha['status'] == 'pendente' ? 'bg-warning text-dark' : 'bg-secondary'
                                ) ?>">
                                <?= ucfirst($prancha['status'] ?? '') ?>
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>pranchas/editar/<?= $prancha['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                            <a href="<?= BASE_URL ?>pranchas/excluir/<?= $prancha['id'] ?>" class="btn btn-sm btn-danger"
                               onclick="return confirm('Confirma excluir esta prancha?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>
<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

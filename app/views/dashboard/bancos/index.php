<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h2 class="mb-0">Bancos</h2>
                <div>
                    <a href="<?= BASE_URL ?>bancos/novo" class="btn btn-success">Novo</a>
                    <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary">Fechar</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Banco</th>
                            <th>Agência</th>
                            <th>Conta Corrente</th>
                            <th>Local</th>
                            <th>Saldo Inicial</th>
                            <th style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($bancos as $banco): ?>
                        <tr>
                            <td><?= htmlspecialchars($banco['codigo']) ?></td>
                            <td><?= htmlspecialchars($banco['banco_nome']) ?></td>
                            <td><?= htmlspecialchars($banco['agencia']) ?></td>
                            <td><?= htmlspecialchars($banco['conta_corrente']) ?></td>
                            <td><?= htmlspecialchars($banco['local']) ?></td>
                            <td><?= htmlspecialchars(number_format($banco['saldo_inicial'], 2, ',', '.')) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>bancos/editar/<?= $banco['id'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <a href="<?= BASE_URL ?>bancos/excluir/<?= $banco['id'] ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Tem certeza que deseja excluir este banco?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($bancos)): ?>
                        <tr><td colspan="7" class="text-center text-muted">Nenhum banco cadastrado.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <?php include_once __DIR__ . '/../../layouts/footer.php'; ?>
</div>

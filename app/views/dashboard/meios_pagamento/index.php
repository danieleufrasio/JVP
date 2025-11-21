<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<div class="d-flex flex-column min-vh-100">
    <main class="flex-fill">
        <div class="container mt-4">
            <h2>Meios de Pagamento</h2>
            <form class="d-flex mb-3" method="get" action="<?= BASE_URL ?>meiospagamento/pesquisar">
                <input type="text" name="q" class="form-control me-2" placeholder="Pesquisar...">
                <button class="btn btn-primary" type="submit">Pesquisar</button>
                <a href="<?= BASE_URL ?>meiospagamento/novo" class="btn btn-success ms-2">Novo</a>
                <a href="<?= BASE_URL ?>dashboard" class="btn btn-secondary ms-2">Fechar</a>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                      
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($meios as $meio): ?>
                    <tr>
                        <td><?= htmlspecialchars($meio['descricao']) ?></td>
                        <td>
                          <td>
                                <a href="<?= BASE_URL ?>meiospagamento/editar/<?= $meio['id'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                                <a href="<?= BASE_URL ?>meiospagamento/excluir/<?= $meio['id'] ?>" 
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Tem certeza que deseja excluir este meio de pagamento?');">
                                    Excluir
                                </a>
                            </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>


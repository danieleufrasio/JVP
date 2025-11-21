<?php include_once __DIR__ . '/../../layouts/header.php'; ?>

<main class="main-content">
    <h2>Tipos de Papel</h2>

    <a href="<?= BASE_URL ?>tiposPapel/novo" class="btn btn-primary">Novo</a>
    <a href="<?= BASE_URL ?>tiposPapel" class="btn btn-secondary">Fechar</a>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>Sigla</th>
                <th>Descrição</th>
                <th>Equivalência</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tipos as $tipo): ?>
            <tr>
                <td><?= htmlspecialchars($tipo['sigla']) ?></td>
                <td><?= htmlspecialchars($tipo['descricao']) ?></td>
                <td>
                    Folha <?= htmlspecialchars($tipo['equivalencia']) ?> 
                    equivalência 
                    <?= number_format($tipo['valor_equivalencia'], 3, ',', '.') ?>
                </td>
                <td>
                    <a href="<?= BASE_URL ?>tiposPapel/editar/<?= $tipo['id'] ?>" class="btn btn-warning btn-sm">Alterar</a>
                    <a href="<?= BASE_URL ?>tiposPapel/excluir/<?= $tipo['id'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('Deseja realmente excluir?')">Excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <hr>

    <h4>Demonstração do Select dinâmico</h4>
    <div>
        <label>Escolha uma folha/papel:</label>
        <select id="folhaSelect" class="form-select" style="max-width:400px"></select>
        <div id="infoFolha" style="margin-top:10px;"></div>
    </div>
</main>

<script>
const folhas = {
    'A4': 0.125,
    'A3': 0.250,
    'A2': 0.500,
    'A1': 1.000,
    'A0': 2.000
};
// Preencher o select
const select = document.getElementById('folhaSelect');
select.innerHTML = '<option value="">Selecione...</option>';
for (const [sigla, val] of Object.entries(folhas)) {
    select.innerHTML += `<option value="${sigla}" data-valor="${val}">folha ${sigla} equivalência ${val}</option>`;
}
// Exibir o valor ao selecionar
select.addEventListener('change', function(){
    const valor = this.options[this.selectedIndex].getAttribute('data-valor');
    if (this.value) {
        document.getElementById('infoFolha').textContent =
          `folha ${this.value}: equivalência ${valor}`;
    } else {
        document.getElementById('infoFolha').textContent = '';
    }
});
</script>

<?php include_once __DIR__ . '/../../layouts/footer.php'; ?>

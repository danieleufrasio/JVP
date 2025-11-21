<?php
require_once __DIR__ . '/../models/RelatorioPranchas.php';

class RelatorioPranchasController {

    public function index() {
        $clientes = RelatorioPranchas::listaClientes();
        require __DIR__ . '/../views/dashboard/relatorio_pranchas/filtro.php';
    }

    public function listar() {
        $filtros = [
            'cliente_id' => $_GET['cliente_id'] ?? '',
            'data_inicio' => $_GET['data_inicio'] ?? '',
            'data_fim' => $_GET['data_fim'] ?? '',
        ];

        $pranchas = RelatorioPranchas::gerar($filtros);
        require __DIR__ . '/../views/dashboard/relatorio_pranchas/lista.php';
    }

  public function gerarPdf()
    {
        $filtros = [
            'cliente_id' => $_GET['cliente_id'] ?? '',
            'data_inicio' => $_GET['data_inicio'] ?? '',
            'data_fim'    => $_GET['data_fim'] ?? '',
        ];

        $pranchas = RelatorioPranchas::gerar($filtros);

        if (empty($pranchas)) {
            echo "Nenhum dado para gerar PDF";
            exit;
        }

        require __DIR__ . '/../views/dashboard/relatorio_pranchas/pdf_report.php';
    }



    public function gerar() {
    $filtros = [
        'cliente_id' => $_GET['cliente_id'] ?? '',
        'data_inicio' => $_GET['data_inicio'] ?? '',
        'data_fim' => $_GET['data_fim'] ?? ''
    ];

    $pranchas = RelatorioPranchas::gerar($filtros);

    if (!$pranchas) {
        echo "Nenhum dado para gerar pdf.";
        exit;
    }
require_once __DIR__ . '/../models/RelatorioPranchas.php';

}

}

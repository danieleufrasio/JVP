<?php
class DashboardController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Mostra o painel do dashboard principal
     */
    public function index() {
        $this->checkAuth();

        // Imagens do carrossel (tabela 'imagens')
        $stmt = $this->pdo->query("SELECT filename FROM imagens ORDER BY id DESC");
        $carouselImages = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Imagem de destaque
        $stmtHero = $this->pdo->query("SELECT filename FROM imagens ORDER BY id DESC LIMIT 1");
        $heroImage = $stmtHero->fetchColumn() ?: 'default-image.jpg';

        // Depoimentos recentes
        $stmtFb = $this->pdo->query("SELECT * FROM visitantesfeedback ORDER BY criadoem DESC");
        $feedbacks = $stmtFb->fetchAll(PDO::FETCH_ASSOC);

        // Serviços
        require_once __DIR__ . '/../models/Servico.php';
        $servicos = Servico::all();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    /**
     * Gerenciar Serviços (com título e descrição customizáveis)
     */
    public function servicos() {
        $this->checkAuth();
        $pdo = $this->pdo;

        // Atualiza título e descrição do gerenciador
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['titulo_servicos'], $_POST['descricao_servicos'])) {
            $stmt = $pdo->prepare("REPLACE INTO configuracoes (chave, valor) VALUES ('titulo_servicos', ?), ('descricao_servicos', ?)");
            $stmt->execute([$_POST['titulo_servicos'], $_POST['descricao_servicos']]);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Busca o conteúdo de título/texto
        $stmt = $pdo->query("SELECT chave, valor FROM configuracoes WHERE chave IN ('titulo_servicos', 'descricao_servicos')");
        $configs = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        $tituloServicos = $configs['titulo_servicos'] ?? 'Título do Gerenciador de Serviços';
        $textoServicos = $configs['descricao_servicos'] ?? 'Descrição breve sobre o que é e como usar o gerenciador de serviços. Você pode customizar esse texto!';

        // Chama model de serviços
        require_once __DIR__ . '/../models/Servico.php';
        $servicos = Servico::all();

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    /**
     * Criação de Novo Serviço (salva imagens na tabela servicos)
     */
    public function servicos_create() {
        $this->checkAuth();
        require_once __DIR__ . '/../models/Servico.php';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'imagem' => '',
            ];

            // Upload vai para /public/img e pertence à tabela SERVICOS
            if (!empty($_FILES['imagem']['tmp_name'])) {
                $nomeFinal = basename($_FILES['imagem']['name']);
                move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../../public/img/' . $nomeFinal);
                $dados['imagem'] = $nomeFinal;
            }

            Servico::create($dados);

            $_SESSION['msg'] = "Serviço criado com sucesso!";
            header('Location: ' . BASE_URL . 'dashboard/');
exit;

        }

        $servicos = Servico::all();
        $tituloServicos = "Gerenciador de Serviços";
        $textoServicos = "Edite seus serviços e suas imagens aqui.";

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    /**
     * Editar Serviço
     */
    public function servicos_edit($id) {
        $this->checkAuth();
        require_once __DIR__ . '/../models/Servico.php';

        $servico = Servico::find($id);
        if (!$servico) header('Location: ' . BASE_URL . 'dashboard');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'titulo' => $_POST['titulo'],
                'descricao' => $_POST['descricao'],
                'imagem' => !empty($_FILES['imagem']['tmp_name'])
                    ? $_FILES['imagem']['name']
                    : $servico['imagem']
            ];

            if (!empty($_FILES['imagem']['tmp_name'])) {
                move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../../public/img/' . $dados['imagem']);
            }

            Servico::update($id, $dados);
            header('Location: ' . BASE_URL . 'dashboard/');
exit;
        }

        require __DIR__ . '/../views/dashboard/index.php';
    }

    /**
     * Deletar Serviço
     */
    public function servicos_delete($id) {
        $this->checkAuth();
        require_once __DIR__ . '/../models/Servico.php';
        Servico::delete($id);
        header('Location: ' . BASE_URL . 'dashboard/');
        exit;
    }

    /**
     * Upload das imagens gerais (carrossel -> tabela IMAGENS)
     */
    public function upload() {
        $this->checkAuth();

        if (isset($_POST['upload']) && isset($_FILES['images'])) {
            $targetDir = __DIR__ . '/../../uploads/';
            if (!is_dir($targetDir)) mkdir($targetDir, 0755, true);

            $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
            $files = $_FILES['images'];

            for ($i = 0; $i < count($files['name']); $i++) {
                $filename = basename($files["name"][$i]);
                $targetFilePath = $targetDir . $filename;
                $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

                if (in_array($fileType, $allowedTypes)) {
                    if (move_uploaded_file($files["tmp_name"][$i], $targetFilePath)) {
                        $stmt = $this->pdo->prepare("INSERT INTO imagens (filename) VALUES (:filename)");
                        $stmt->execute(['filename' => $filename]);
                    }
                }
            }
        }

        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

    /**
     * Excluir imagem (carrossel)
     */
    public function delete($filename) {
        $this->checkAuth();

        $stmt = $this->pdo->prepare("DELETE FROM imagens WHERE filename = :filename");
        $stmt->execute(['filename' => $filename]);

        $filepath = __DIR__ . '/../../uploads/' . $filename;
        if (is_file($filepath)) unlink($filepath);

        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

    /**
     * Define imagem como fundo
     */
    public function setBackground($filename) {
        $this->checkAuth();
        file_put_contents(__DIR__ . '/../../uploads/bg.txt', $filename);
        http_response_code(200);
        exit;
    }

    private function checkAuth() {
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        if (!isset($_SESSION['colaborador']) || empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }
}

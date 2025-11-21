<?php
class HomeController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Página inicial pública (exibe imagem de background ativa e imagens da seção Sobre)
    public function index() {
        // Busca a imagem de background ativa
        $stmtBg = $this->pdo->query("SELECT filename FROM imagens WHERE is_background = 1 LIMIT 1");
        $backgroundImage = $stmtBg->fetchColumn();
        if (!$backgroundImage) {
            $backgroundImage = 'default-image.jpg'; // placeholder padrão
        }

        // Busca imagens para o carrossel (id + filename)
        $stmtCarousel = $this->pdo->query("SELECT id, filename FROM imagens ORDER BY id DESC");
        $carouselImages = $stmtCarousel->fetchAll(PDO::FETCH_ASSOC);

        // Busca imagens para seção Sobre (limite 4)
        $stmtAbout = $this->pdo->query("SELECT filename FROM imagens ORDER BY id DESC LIMIT 4");
        $aboutImages = $stmtAbout->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/home/index.php';
    }

    // Mostra painel do dashboard (requer autenticação)
    public function dashboard() {
        $this->checkAuth();

        $stmt = $this->pdo->query("SELECT filename, is_background FROM imagens ORDER BY id DESC");
        $carouselImages = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];

        require_once __DIR__ . '/../views/layouts/header.php';
        require_once __DIR__ . '/../views/dashboard/index.php';
        require_once __DIR__ . '/../views/layouts/footer.php';
    }

    // Upload de múltiplas imagens (POST)
    public function upload() {
        $this->checkAuth();

        if (isset($_POST['upload']) && isset($_FILES['images'])) {
            $targetDir = __DIR__ . '/../../uploads/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

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

    // Deleta uma imagem pelo filename (POST)
    public function delete($filename) {
        $this->checkAuth();

        $stmt = $this->pdo->prepare("DELETE FROM imagens WHERE filename = :filename");
        $stmt->execute(['filename' => $filename]);

        $filepath = __DIR__ . '/../../uploads/' . $filename;
        if (is_file($filepath)) {
            unlink($filepath);
        }

        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

    // Define uma imagem como background ativo (POST)
    public function setBackground($filename) {
        $this->checkAuth();

        // Limpa marcação anterior
        $this->pdo->exec("UPDATE imagens SET is_background = 0");

        // Define nova imagem como background
        $stmt = $this->pdo->prepare("UPDATE imagens SET is_background = 1 WHERE filename = :filename");
        $stmt->execute(['filename' => $filename]);

        header('Location: ' . BASE_URL . 'dashboard');
        exit;
    }

    private function checkAuth() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (!isset($_SESSION['colaborador']) || empty($_SESSION['colaborador']['id'])) {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }
    }
}

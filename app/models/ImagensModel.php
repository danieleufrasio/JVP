<?php
class ImagensModel {
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Insere imagem (apenas filename, demais campos usam defaults do banco)
    public function insertImage($filename) {
        $sql = "INSERT INTO imagens (filename) VALUES (:filename)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([':filename' => $filename]);
    }

    // Recupera todas imagens ordenando pelo mais recente (campo correto: uploaded_at)
    public function getImages() {
        $stmt = $this->pdo->query("SELECT * FROM imagens ORDER BY uploaded_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

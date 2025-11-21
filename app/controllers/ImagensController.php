<?php
require_once 'ImagensModel.php';

class ImagensController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ImagensModel($pdo);
    }

    public function upload() {
        if (isset($_POST['upload'])) {
            $targetDir = "uploads/";
            $filename = basename($_FILES["image"]["name"]);
            $targetFilePath = $targetDir . $filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Permitir apenas arquivos de imagem
            $allowedTypes = ['jpg', 'png', 'jpeg', 'gif'];
            if (in_array(strtolower($fileType), $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                    $this->model->insertImage($filename);
                    $_SESSION['msg'] = "Imagem enviada com sucesso!";
                } else {
                    $_SESSION['msg'] = "Erro ao enviar a imagem.";
                }
            } else {
                $_SESSION['msg'] = "Formato de arquivo não permitido.";
            }
            header("Location: /");
            exit;
        }
    }

    public function index() {
        $images = $this->model->getImages();
        require 'view/ImagensView.php';
    }
}

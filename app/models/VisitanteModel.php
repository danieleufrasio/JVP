<?php
class VisitanteModel
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function listarComentariosRecentes()
    {
        $stmt = $this->pdo->query("SELECT * FROM visitantesfeedback ORDER BY criadoem DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($nome, $email, $comentario, $nota, $foto = null)
    {
        $sql = "INSERT INTO visitantesfeedback (nome, email, comentario, nota, photo, criadoem) VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $comentario, $nota, $foto]);
    }
}

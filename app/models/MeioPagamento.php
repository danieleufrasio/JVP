<?php
class MeioPagamento {
    public static function all() {
        $pdo = require __DIR__ . '/../config/db.php';
        return $pdo->query("SELECT * FROM meios_pagamento ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function find($id) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM meios_pagamento WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function create($descricao) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("INSERT INTO meios_pagamento (descricao) VALUES (?)");
        return $stmt->execute([$descricao]);
    }
    public static function update($id, $descricao) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("UPDATE meios_pagamento SET descricao=? WHERE id=?");
        return $stmt->execute([$descricao, $id]);
    }
    public static function search($termo) {
        $pdo = require __DIR__ . '/../config/db.php';
        $stmt = $pdo->prepare("SELECT * FROM meios_pagamento WHERE descricao LIKE ?");
        $stmt->execute(['%' . $termo . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function delete($id) {
    $pdo = require __DIR__ . '/../config/db.php';
    $stmt = $pdo->prepare("DELETE FROM meios_pagamento WHERE id=?");
    return $stmt->execute([$id]);
}

}

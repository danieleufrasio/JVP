<?php
require_once __DIR__ . '/app/config/db.php';


$sql = $pdo->query("SELECT * FROM visitantesfeedback ORDER BY criadoem DESC LIMIT 12");
print_r($sql->fetchAll(PDO::FETCH_ASSOC));

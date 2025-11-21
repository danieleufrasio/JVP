<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/config/constants.php'; // ajuste o caminho conforme sua pasta

session_start();

// Inicializa cliente Google
$client = new Google\Client();
$client->setClientId(GOOGLE_CLIENT_ID);
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri(GOOGLE_REDIRECT_URI); // deve ser 'http://localhost/jvp/app/oauth2callback.php'
$client->addScope(['email', 'profile']);

// Verifica se veio com o código OAuth
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (isset($token['error'])) {
        die('Erro ao autenticar: ' . htmlspecialchars($token['error']));
    }

    $client->setAccessToken($token);
    $oauth2 = new Google\Service\Oauth2($client);
    $userInfo = $oauth2->userinfo->get();

 $_SESSION['colaborador'] = [
    'nome' => $userInfo->name,
    'email' => $userInfo->email,
    'id'   => $userInfo->id,
    'photo' => $userInfo->picture, // este campo vem do perfil Google!
];


    // Redireciona para a home
    header('Location: ' . BASE_URL . 'home');
    exit();
} else {
    // Se chegar aqui sem código é erro de OAuth
    echo "<h2>Erro: Nenhum código recebido do Google.</h2>";
    exit();
}

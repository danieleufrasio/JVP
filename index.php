<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/vendor/autoload.php'; // Autoload Composer para Google Client

require_once __DIR__ . '/app/config/constants.php';
require_once __DIR__ . '/app/config/db.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$url = isset($_GET['url']) ? trim($_GET['url'], '/') : '';
$urlParts = explode('/', $url);

$publicControllers = ['AuthController', 'HomeController', 'FeedbackController'];

$controllerName = !empty($urlParts[0]) ? preg_replace('/[^a-zA-Z0-9]/', '', ucfirst($urlParts[0])) . 'Controller' : 'HomeController';
$method = $urlParts[1] ?? 'index';
$params = array_slice($urlParts, 2);
$controllerPath = __DIR__ . '/app/controllers/' . $controllerName . '.php';

// Configurar Cliente OAuth Google
$client = new Google\Client();
$client->setClientId(GOOGLE_CLIENT_ID); // Defina no constants.php
$client->setClientSecret(GOOGLE_CLIENT_SECRET);
$client->setRedirectUri(GOOGLE_REDIRECT_URI);
$client->addScope(['email', 'profile']);

if (!isset($_SESSION['colaborador']) && !in_array($controllerName, $publicControllers)) {
    if (!isset($_GET['code'])) {
        // Redireciona para o Google OAuth
        $authUrl = $client->createAuthUrl();
        header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
        exit();
    } else {
        // Autentica com o código do Google
        $client->authenticate($_GET['code']);
        $_SESSION['access_token'] = $client->getAccessToken();
        $oauth = new Google\Service\Oauth2($client);
        $userInfo = $oauth->userinfo->get();
        $_SESSION['colaborador'] = [
            'nome' => $userInfo->name,
            'email' => $userInfo->email,
            'id' => $userInfo->id,
        ];
        // Redireciona para a home após autenticação bem-sucedida
        header('Location: ' . BASE_URL . 'home');
        exit();
    }
}

// Roteamento AJAX
if ($_SERVER['REQUEST_METHOD'] === 'POST' && substr($method, -4) === 'Ajax' && file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerName)) {
        $controller = new $controllerName($pdo);
        if (method_exists($controller, $method)) {
            call_user_func_array([$controller, $method], $params);
            exit();
        }
    }
    http_response_code(404);
    echo "Endpoint AJAX não encontrado: <b>$method</b> em <b>$controllerName</b>";
    exit();
}

// Página principal / home
if (empty($url) || strtolower($url) === 'home') {
    require_once __DIR__ . '/app/controllers/HomeController.php';
    $controller = new HomeController($pdo);
    if (method_exists($controller, 'index')) {
        $controller->index();
        exit();
    } else {
        http_response_code(404);
        echo "Método <b>index</b> não encontrado em <b>HomeController</b>.";
        exit();
    }
}

// Roteamento normal baseado na URL
if (file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerName)) {
        $controller = new $controllerName($pdo);
        if (method_exists($controller, $method) && is_callable([$controller, $method])) {
            call_user_func_array([$controller, $method], $params);
            exit();
        } else {
            http_response_code(404);
            echo "Método <b>$method</b> não encontrado em <b>$controllerName</b>.";
            exit();
        }
    } else {
        http_response_code(404);
        echo "Classe <b>$controllerName</b> não encontrada no arquivo <b>$controllerPath</b>.";
        exit();
    }
}

http_response_code(404);
echo "Controlador <b>$controllerName</b> não encontrado. Arquivo esperado: <b>$controllerPath</b>.";
exit();

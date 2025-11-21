<?php
// Controle de sessão seguro
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../models/Colaborador.php';

class AuthController
{
    public function login()
    {
        $permissoesDashboard = [
            'projetista',
            'calculista',
            'verificador',
            'administrador',
            'freelancer'
        ];

        if (isset($_SESSION['colaborador'])) {
            if (in_array($_SESSION['colaborador']['nivel_acesso'], $permissoesDashboard)) {
                header('Location: ' . BASE_URL . 'dashboard');
            } else {
                header('Location: ' . BASE_URL . 'home');
            }
            exit;
        }

        if (isset($_SESSION['visitante'])) {
            header('Location: ' . BASE_URL . 'home');
            exit;
        }

        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $senha = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $senha) {
                $colaborador = Colaborador::autenticarPorEmail($email, $senha);

                if ($colaborador) {
                    session_regenerate_id(true);
                    $_SESSION['colaborador'] = [
                        'id' => $colaborador['id'],
                        'nome' => $colaborador['nome'],
                        'email' => $colaborador['email'],
                        'nivel_acesso' => $colaborador['nivel_acesso'],
                        'status' => $colaborador['status'],
                    ];
                    $_SESSION['user_role'] = $colaborador['nivel_acesso'];
                    $_SESSION['user_email'] = $colaborador['email'];

                    if (in_array($colaborador['nivel_acesso'], $permissoesDashboard)) {
                        header('Location: ' . BASE_URL . 'dashboard');
                    } else {
                        header('Location: ' . BASE_URL . 'home');
                    }
                    exit;
                } else {
                    $error = "Credenciais inválidas";
                }
            } else {
                $error = "Dados do formulário inválidos";
            }
        }

        require_once __DIR__ . '/../views/auth/login.php';
    }

    // Método extra para login via Google OAuth, para chamar no callback
    public function loginGoogle($userInfo, $pdo)
    {
        // Tenta buscar colaborador no banco via email
        $colaborador = Colaborador::buscarPorEmail($userInfo->email, $pdo);

        if ($colaborador) {
            // Se for colaborador, cria sessão colaborador
            session_regenerate_id(true);
            $_SESSION['colaborador'] = [
                'id' => $colaborador['id'],
                'nome' => $colaborador['nome'],
                'email' => $colaborador['email'],
                'nivel_acesso' => $colaborador['nivel_acesso'],
                'status' => $colaborador['status'],
                'photo' => $userInfo->picture,
            ];
            header('Location: ' . BASE_URL . 'dashboard');
            exit();
        } else {
            // Caso contrário, cria sessão visitante
            $_SESSION['visitante'] = [
                'nome' => $userInfo->name,
                'email' => $userInfo->email,
                'photo' => $userInfo->picture,
            ];
            header('Location: ' . BASE_URL . 'home');
            exit();
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . 'home');
        exit;
    }
}

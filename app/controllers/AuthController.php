<?php

if (session_status() === PHP_SESSION_NONE) session_start();
require_once __DIR__ . '/../models/Colaborador.php';

class AuthController
{
    public function login()
    {
        $permissoesDashboard = [
            'administrador', 'projetista', 'calculista', 'verificador', 'freelancer'
        ];

        if (isset($_SESSION['colaborador'])) {
            if (in_array($_SESSION['colaborador']['nivelacesso'], $permissoesDashboard)) {
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
            $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);

            if ($email && $senha) {
                $colaborador = Colaborador::autenticarPorEmail($email, $senha);
                if ($colaborador) {
                    session_regenerate_id(true);
                    $_SESSION['colaborador'] = [
                        'id'          => $colaborador['id'],
                        'nome'        => $colaborador['nome'],
                        'email'       => $colaborador['email'],
                        'nivelacesso' => $colaborador['nivelacesso'],
                        'status'      => $colaborador['status'],
                    ];
                    $_SESSION['user_role'] = $colaborador['nivelacesso'];
                    $_SESSION['user_email'] = $colaborador['email'];

                    if (in_array($colaborador['nivelacesso'], $permissoesDashboard)) {
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

    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: ' . BASE_URL . 'home');
        exit;
    }
}

<?php

require_once __DIR__ . '/../models/Colaborador.php';

class ColaboradoresController
{
    // Exibe lista de colaboradores
    public static function index()
    {
        $colaboradores = Colaborador::all();
        require __DIR__ . '/../views/dashboard/colaboradores/index.php';
    }

    // Exibe o formulário para novo colaborador
    public static function novo()
    {
        $niveis = Colaborador::niveis();
        require __DIR__ . '/../views/dashboard/colaboradores/novo.php';
    }

    // Salva novo colaborador
    public static function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'codigo'     => $_POST['codigo'] ?? '',
                'nome'       => $_POST['nome'] ?? '',
                'email'      => $_POST['email'] ?? '',
                'nivelacesso'=> $_POST['nivelacesso'] ?? 'outro',
                'status'     => $_POST['status'] ?? 'ativo',
                'usuario'    => $_POST['usuario'] ?? '',
                'senha'      => $_POST['senha'] ?? '',
            ];

            if (empty($dados['senha']) || empty($dados['email']) || empty($dados['nome'])) {
                $_SESSION['error'] = "Preencha os campos obrigatórios.";
                self::novo();
                return;
            }

            $created = Colaborador::create($dados);
            if ($created) {
                $_SESSION['success'] = "Colaborador criado com sucesso.";
                header('Location: ' . BASE_URL . 'colaboradores');
                exit;
            } else {
                $_SESSION['error'] = "Erro ao criar colaborador.";
                self::novo();
            }
        }
    }

    // Exibe o formulário para editar colaborador
    public static function editar($id)
    {
        $colaborador = Colaborador::find($id);
        $niveis = Colaborador::niveis();
        if (!$colaborador) {
            $_SESSION['error'] = "Colaborador não encontrado.";
            header('Location: ' . BASE_URL . 'colaboradores');
            exit;
        }
        require __DIR__ . '/../views/dashboard/colaboradores/editar.php';
    }

    // Atualiza colaborador
    public static function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if (!$id) {
                $_SESSION['error'] = "ID do colaborador não informado.";
                header('Location: ' . BASE_URL . 'colaboradores');
                exit;
            }

            $dados = [
                'codigo'     => $_POST['codigo'] ?? '',
                'nome'       => $_POST['nome'] ?? '',
                'email'      => $_POST['email'] ?? '',
                'nivelacesso'=> $_POST['nivelacesso'] ?? 'outro',
                'status'     => $_POST['status'] ?? 'ativo',
                'usuario'    => $_POST['usuario'] ?? '',
                'senha'      => $_POST['senha'] ?? '',
            ];

            $updated = Colaborador::update($id, $dados);
            if ($updated) {
                $_SESSION['success'] = "Colaborador atualizado com sucesso.";
            } else {
                $_SESSION['error'] = "Erro ao atualizar colaborador.";
            }
            header('Location: ' . BASE_URL . 'colaboradores');
            exit;
        }
    }

    // Deleta colaborador
    public static function excluir($id)
    {
        $deleted = Colaborador::delete($id);
        if ($deleted) {
            $_SESSION['success'] = "Colaborador excluído com sucesso.";
        } else {
            $_SESSION['error'] = "Erro ao excluir colaborador.";
        }
        header('Location: ' . BASE_URL . 'colaboradores');
        exit;
    }

    // Pesquisa colaboradores pelo nome ou email
    public static function pesquisar()
    {
        $termo = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_SPECIAL_CHARS);
        if ($termo) {
            $colaboradores = Colaborador::search($termo);
        } else {
            $colaboradores = Colaborador::all();
        }
        require __DIR__ . '/../views/dashboard/colaboradores/index.php';
    }
}

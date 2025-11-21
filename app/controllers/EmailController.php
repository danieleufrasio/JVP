<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class EmailController {
    public function sendConfirmation() {
        $data = json_decode(file_get_contents('php://input'), true);

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            http_response_code(400);
            echo json_encode(['error' => 'E-mail inválido']);
            exit;
        }

        // Gere aqui um token único para validação do comentário
        $token = bin2hex(random_bytes(20));
        $link = BASE_URL . "feedback/confirmarEmail?email=" . urlencode($data['email']) . "&token=" . $token;

        // Exemplo de salvar token temporário para confirmação futura (faça isso no DB real)
        // ..... Aqui salvaria $data['email'], $token e comentário pendente

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.sualocal.com';        // SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'seuemail@dominio.com';
            $mail->Password   = 'senha-segura';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('seuemail@dominio.com', 'Seu Nome ou Empresa');
            $mail->addAddress($data['email']);
            $mail->Subject = 'Confirme seu comentário';
            $mail->Body    = "Clique no link para confirmar seu comentário: $link";

            $mail->send();
            http_response_code(200);
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => "Erro ao enviar e-mail: {$mail->ErrorInfo}"]);
        }
    }
}

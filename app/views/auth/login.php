<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login Engenharia</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle, #82e2ae 62%, #156b1f 110%) fixed;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: #156b1f;
            box-shadow: 0 8px 44px 0 rgba(21,107,31,0.20);
            padding: 44px 35px 34px 35px;
            border-radius: 18px;
            width: 350px;
            color: #e1ffe7;
        }
        .login-title {
            font-size: 1.9em;
            text-align: center;
            margin-bottom: 22px;
            font-weight: 600;
            color: #c8ffe0;
        }
        .login-form input {
            background: rgba(255,255,255,0.15);
            color: #156b1f;
        }
        .login-btn {
            background: #82e2ae;
            color: #156b1f;
            font-weight: 600;
            width: 100%;
        }
        .alert {
            margin-bottom: 20px;
            font-size: 1.02em;
        }
    </style>
</head>
<body>
    <div class="login-box mx-auto">
        <div class="login-title">Bem-vindo à Engenharia</div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" class="login-form">
            <div class="mb-3">
                <input type="email" name="email" class="form-control text-center" placeholder="EMAIL" required autofocus>
            </div>
            <div class="mb-3">
                <input type="password" name="senha" class="form-control text-center" placeholder="SENHA" required>
            </div>
            <button type="submit" class="login-btn btn">LOGAR</button>
            <div class="text-center mt-3">
                <a href="#" style="color:#e1ffe7;">Esqueceu a senha?</a>
            </div>
        </form>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Login Engenharia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: radial-gradient(circle, #82e2ae 62%, #156b1f 110%) fixed;
        }
        .outer-login {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: linear-gradient(145deg,rgba(15,60,24,.96) 60%,rgba(21,107,31,.98) 100%);
            box-shadow: 0 8px 44px 0 rgba(21,107,31,0.30), 0 2px 12px 0 rgba(21,107,31,0.08);
            padding: 56px 54px 36px 54px;
            border-radius: 22px;
            width: 395px;
            max-width: 96vw;
            color: #e1ffe7;
            position: relative;
        }
        .login-box .login-icon {
            width:86px; height:86px;
            border-radius: 50%;
            background: rgba(130,226,174,0.14);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 27px auto;
        }
        .login-box .login-title {
            font-size:30px;
            text-align:center;
            font-weight: 600;
            color:#c8ffe0;
            letter-spacing:3px;
            margin-bottom:26px;
        }
        .login-form input {
            background:rgba(255,255,255,0.17);
            border:none;
            color:#cff9dc;
            font-size:1.18em;
            margin-bottom:18px;
            border-radius:0;
            border-bottom:1.5px solid #82e2ae;
            padding-left:40px;
            height:44px;
        }
        .login-form input:focus {
            background:rgba(255,255,255,0.31);
            outline:none;
            color:#156b1f;
        }
        .input-icon {
            position:absolute;
            left:11px; top:50%; transform:translateY(-50%);
            color:#82e2ae;
        }
        .login-form label, .login-form a {
            color: #b5ffd0;
            font-size: .97em;
        }
        .login-form a {
            float:right;
            text-decoration: underline;
            font-size: .97em;
        }
        .login-btn {
            background: #82e2ae;
            color: #156b1f;
            font-size:1.1em;
            letter-spacing:2px;
            padding:13px 0;
            border-radius:2px;
            width:100%;
            border:none;
            font-weight:600;
            margin-top:22px;
        }
        .form-check-input:checked {
            background-color: #156b1f;
            border-color: #82e2ae;
        }
        .form-check-label {
            color: #b5ffd0;
        }

    </style>
</head>
<body>
<div class="login-icon" style="
    width:94px;
    height:94px;
    border-radius:50%;
    background:rgba(130,226,174,0.14);
    display:flex;
    align-items:center;
    justify-content:center;
    margin:0 auto 27px auto;">
    <img src="/jvp/public/img/Logo-JVP-branca.webp" alt="Logo"
         style="width:68px; height:68px; object-fit:contain; border-radius:50%; background:transparent;" />
</div>


        <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>
        <form method="POST" class="login-form position-relative">
            <div class="mb-3 position-relative">
                <input type="email" name="email" class="form-control text-center" placeholder="EMAIL" required autofocus>
                <span class="input-icon">
                    <svg width="21" height="21" fill="#82e2ae" viewBox="0 0 16 16">
                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383l-4.708 2.825L15 11.383V5.383zm-.034 6.292l-4.652-2.769-2.314 1.39a.5.5 0 0 1-.5 0l-2.314-1.39L1.034 11.675a1.988 1.988 0 0 0 .966.256H14a1.988 1.988 0 0 0 .966-.256zM8 8.5L1 4.136V11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4.136L8 8.5z"/>
                    </svg>
                </span>
            </div>
            <div class="mb-3 position-relative">
                <input type="password" name="password" class="form-control text-center" placeholder="SENHA" required>
                <span class="input-icon">
                    <svg width="21" height="21" fill="#82e2ae" viewBox="0 0 16 16">
                        <path d="M3.5 8a.5.5 0 0 1 .5.5V10a2 2 0 0 0 2 2h4a2 2 0 0 0 2-2V8.5a.5.5 0 0 1 1 0V10a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V8.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M8 1a2 2 0 0 1 2 2v1h1.5A1.5 1.5 0 0 1 13 5.5v.5a1.5 1.5 0 0 1-1.5 1.5h-7A1.5 1.5 0 0 1 3 6V5.5A1.5 1.5 0 0 1 4.5 4H6V3a2 2 0 0 1 2-2zm-2 2a2 2 0 1 1 4 0v1H6V3z"/>
                    </svg>
                </span>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
                <a href="#" class="text-decoration-none" style="color: #156b1f;">Esqueceu a senha?</a>
            </div>
            <button type="submit" class="login-btn">LOGAR</button>
            <div class="d-flex justify-content-center mb-3">
                    <a href="/jvp" class="btn btn-link text-success fw-bold" style="font-size:1.05em;letter-spacing:1px;">
                        &#8592; Voltar para o início
                    </a>
                </div>
        </form>
    </div>
</div>
</body>
</html>

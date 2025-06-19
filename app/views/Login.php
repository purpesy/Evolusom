<?php require_once("templates/head.php") ?>
<body>
    <?php if(isset($_SERVER['HTTP_USER_AGENT']) && !strstr($_SERVER['HTTP_USER_AGENT'],'Mobile')): ?>
    <div class="login-container">
        <div class="login-box">
            <div class="redirect-message">
                <p>Redirecionando para a página inicial...</p>
            </div>
        </div>
    </div>
    <script>
        window.location.href = '<?= URL_BASE ?>';
    </script>
    <?php else: ?>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Evolusom</h1>
                <p>Faça login para continuar</p>
            </div>

            <?php if(isset($_SESSION['erro-login'])): ?>
                <div class="alert alert-danger">
                    <?= $_SESSION['erro-login'] ?>
                    <?php unset($_SESSION['erro-login']); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="<?= URL_BASE ?>login/entrar" class="login-form">
                <div class="form-group">
                    <label for="email">E-mail ou Usuário</label>
                    <input type="text" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>

                <button type="submit" class="login-button">Entrar</button>
            </form>

            <a href="<?= URL_BASE ?>" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Voltar para a página inicial
            </a>
        </div>
    </div>
    <?php endif; ?>
</body>
</html>

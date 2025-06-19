<?php require_once("templates/head.php") ?>
<?php require_once("templates/header.php") ?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar Perfil</h4>
                </div>
                <div class="card-body">
                    <form action="<?php echo URL_BASE ?>cliente/atualizarPerfil" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nome Completo</label>
                                    <input type="text" name="cliente_nome" class="form-control" value="<?php echo $usuario['cliente_nome'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>CPF</label>
                                    <input type="text" name="cliente_cpf" class="form-control" value="<?php echo $usuario['cliente_cpf'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="cliente_email" class="form-control" value="<?php echo $usuario['cliente_email'] ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" name="cliente_telefone" class="form-control" value="<?php echo $usuario['cliente_telefone'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nova Senha</label>
                                    <input type="password" name="cliente_senha" class="form-control" placeholder="Deixe em branco para manter a senha atual">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Confirmar Nova Senha</label>
                                    <input type="password" name="confirmar_senha" class="form-control" placeholder="Confirme a nova senha">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" style="background-color: #eb0589; border-color: #eb0589;">
                                    <i class="fas fa-save"></i> Salvar Alterações
                                </button>
                                <a href="<?php echo URL_BASE ?>usuario" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Voltar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card {
        border: none;
        box-shadow: 0 0 15px rgba(0,0,0,0.1);
        border-radius: 10px;
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid #eee;
        padding: 20px;
    }

    .card-header h4 {
        margin: 0;
        color: #333;
    }

    .card-body {
        padding: 30px;
    }

    .form-group label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #eb0589;
        box-shadow: 0 0 0 0.2rem rgba(235, 5, 137, 0.25);
    }

    .btn {
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: 500;
        margin-right: 10px;
    }

    .btn-primary {
        background-color: #eb0589;
        border-color: #eb0589;
    }

    .btn-primary:hover {
        background-color: #c00470;
        border-color: #c00470;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        border-color: #545b62;
    }
</style>

<?php require_once("templates/footer.php") ?> 
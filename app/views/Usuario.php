<?php require_once("templates/head.php") ?>

<body>
    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>

    <!-- Banner do Usuário -->
    <section class="banner-usuario">
        <div class="overlay"></div>
        <div class="container">
            <div class="conteudo-banner">
                <h2>Bem-vindo à sua área</h2>
                <p>Gerencie seus pedidos, favoritos e configurações</p>
            </div>
        </div>
    </section>

    <!-- Conteúdo Principal -->
    <section class="area-usuario">
        <div class="container">
            <div class="row">
                <!-- Sidebar do Usuário -->

                <div class="col-md-4">
                    <div class="card-perfil">
                        <?php if (isset($usuario) && !empty($usuario)): ?>
                            <h3><?php echo $usuario['cliente_nome'] ?></h3>
                            <p class="email-usuario"><?php echo $usuario['cliente_email'] ?></p>
                            <div class="info-contato">
                                <p><i class="fas fa-id-card"></i> CPF: <?php echo $usuario['cliente_cpf'] ?></p>
                                <p><i class="fas fa-phone"></i> <?php echo $usuario['cliente_telefone'] ?></p>
                            </div>
                            
                            <a href="<?php echo URL_BASE ?>cliente/editarPerfil" class="btn-editar-perfil">
                                <i class="fas fa-edit"></i> Editar Perfil
                            </a>

                            <a href="<?php echo URL_BASE ?>login/logout" class="btn-sair-conta" onclick="return confirm('Tem certeza que deseja sair da sua conta?')">
                                <i class="fas fa-sign-out-alt"></i> Sair da Conta
                            </a>

                            <!-- Seção de Serviços Agendados -->
                            <div class="servicos-agendados mt-5">
                                <div class="section-header">
                                    <h4><i class="fas fa-calendar-check"></i> Meus Agendamentos</h4>
                                </div>
                                
                                <?php if (isset($agendamentos) && !empty($agendamentos)): ?>
                                    <div class="agendamentos-grid">
                                        <?php foreach($agendamentos as $agendamento): ?>
                                            <div class="agendamento-card">
                                                <div class="agendamento-header">
                                                    <span class="data-agendamento">
                                                        <i class="far fa-clock"></i>
                                                        <?php echo date('d/m/Y H:i', strtotime($agendamento['agendamento_data'])) ?>
                                                    </span>
                                                    <span class="badge <?php 
                                                        if ($agendamento['status_agendamento'] == 'Ativa') {
                                                            echo 'bg-success';
                                                        } elseif ($agendamento['status_agendamento'] == 'Pendente') {
                                                            echo 'bg-warning';
                                                        } elseif ($agendamento['status_agendamento'] == 'Finalizada') {
                                                            echo 'bg-primary';
                                                        } else {
                                                            echo 'bg-secondary';
                                                        }
                                                    ?>">
                                                        <?php echo $agendamento['status_agendamento'] ?>
                                                    </span>
                                                </div>
                                                <div class="agendamento-body">
                                                    <h5 class="servico-nome">
                                                        <i class="fas fa-wrench"></i>
                                                        <?php echo substr($agendamento['agendamento_observacoes'], 0, 50) . (strlen($agendamento['agendamento_observacoes']) > 50 ? '...' : '') ?>
                                                    </h5>
                                                    <div class="servico-descricao">
                                                        <i class="fas fa-info-circle"></i>
                                                        <?php echo $agendamento['agendamento_observacoes'] ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="sem-agendamentos">
                                        <i class="far fa-calendar-times"></i>
                                        <p>Nenhum serviço agendado no momento.</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <h3>Usuário não encontrado</h3>
                            <p class="email-usuario">N/A</p>
                            <div class="info-contato">
                                <p><i class="fas fa-id-card"></i> CPF: N/A</p>
                                <p><i class="fas fa-phone"></i> N/A</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>



                <!-- Conteúdo Principal -->
                
                </div>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <?php require_once("templates/footer.php") ?>

    <style>
        .card-perfil {
            background: #fff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 30px;
        }

        .card-perfil h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 24px;
        }

        .email-usuario {
            color: #666;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .info-contato {
            margin: 20px 0;
            text-align: left;
        }

        .info-contato p {
            margin: 10px 0;
            color: #555;
            font-size: 15px;
        }

        .info-contato i {
            width: 25px;
            color: #eb0589;
        }

        .estatisticas-usuario {
            display: flex;
            justify-content: center;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .estatistica-item {
            text-align: center;
        }

        .estatistica-item i {
            font-size: 24px;
            color: #eb0589;
            margin-bottom: 5px;
        }

        .estatistica-item span {
            display: block;
            color: #666;
            font-size: 14px;
        }

        .btn-editar-perfil {
            background: #eb0589;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 15px;
        }

        .btn-editar-perfil:hover {
            background: #c00470;
        }

        .btn-sair-conta {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn-sair-conta:hover {
            background: #c82333;
            color: white;
            text-decoration: none;
        }

        .btn-detalhes {
            background: #eb0589;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-detalhes:hover {
            background: #c00470;
        }

        .btn-salvar {
            background: #eb0589;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            width: 100%;
            margin-top: 20px;
        }

        .btn-salvar:hover {
            background: #c00470;
        }

        .nav-tabs-usuario li.active a {
            color: #eb0589;
            border-bottom: 2px solid #eb0589;
        }

        .nav-tabs-usuario li a:hover {
            color: #eb0589;
        }

        .servicos-agendados {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }

        .section-header {
            margin-bottom: 25px;
            border-bottom: 2px solid #f0f0f0;
            padding-bottom: 15px;
        }

        .section-header h4 {
            color: #333;
            font-size: 1.4rem;
            margin: 0;
        }

        .section-header h4 i {
            color: #eb0589;
            margin-right: 10px;
        }

        .agendamentos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .agendamento-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
            transition: transform 0.2s ease;
            border: 1px solid #eee;
        }

        .agendamento-card:hover {
            transform: translateY(-5px);
        }

        .agendamento-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .data-agendamento {
            color: #666;
            font-size: 0.9rem;
        }

        .data-agendamento i {
            color: #eb0589;
            margin-right: 5px;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 500;
        }

        .agendamento-body {
            padding-top: 10px;
        }

        .servico-nome {
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .servico-nome i {
            color: #eb0589;
            margin-right: 8px;
        }

        .servico-descricao {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.4;
            margin-top: 10px;
        }

        .servico-descricao i {
            color: #eb0589;
            margin-right: 8px;
        }

        .sem-agendamentos {
            text-align: center;
            padding: 40px 20px;
            color: #666;
        }

        .sem-agendamentos i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 15px;
        }

        .sem-agendamentos p {
            font-size: 1.1rem;
            margin: 0;
        }

        @media (max-width: 768px) {
            .agendamentos-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

</body>

</html>
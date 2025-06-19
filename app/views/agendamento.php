<?php require_once("templates/head.php") ?>
<body>
    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>
    
    <!-- Banner de Agendamento -->
    <section class="banner-agendamento">
        <div class="container">
            <div class="conteudo-banner">
                <h2>Agende seu Horário</h2>
                <p>Escolha o melhor dia e horário para transformar seu som automotivo</p>
            </div>
        </div>
    </section>

    <!-- Formulário de Agendamento -->
    <section class="agendamento-principal">
        <div class="container">
            <div class="formulario-agendamento">
                <h2 class="titulo-secao">Faça seu Agendamento</h2>
                <p class="subtitulo-secao">Preencha os dados abaixo para agendar seu horário</p>
                
                <form action="#" method="post" class="form-agendamento">
                    <div class="form-grupo">
                        <label for="nome">Nome Completo *</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    
                    <div class="form-grupo">
                        <label for="email">E-mail *</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-grupo">
                        <label for="telefone">Telefone *</label>
                        <input type="tel" id="telefone" name="telefone" required>
                    </div>

                    <div class="form-grupo">
                        <label for="veiculo">Modelo do Veículo *</label>
                        <input type="text" id="veiculo" name="veiculo" required>
                    </div>

                    <div class="form-grupo">
                        <label for="servico">Tipo de Serviço *</label>
                        <select id="servico" name="servico" required>
                            <option value="">Selecione um serviço</option>
                            <option value="instalacao">Instalação de Som</option>
                            <option value="manutencao">Manutenção</option>
                            <option value="personalizacao">Personalização</option>
                            <option value="diagnostico">Diagnóstico</option>
                        </select>
                    </div>

                    <div class="form-grupo">
                        <label for="data">Data Preferencial *</label>
                        <input type="date" id="data" name="data" required>
                    </div>

                    <div class="form-grupo">
                        <label for="horario">Horário Preferencial *</label>
                        <select id="horario" name="horario" required>
                            <option value="">Selecione um horário</option>
                            <option value="09:00">09:00</option>
                            <option value="10:00">10:00</option>
                            <option value="11:00">11:00</option>
                            <option value="14:00">14:00</option>
                            <option value="15:00">15:00</option>
                            <option value="16:00">16:00</option>
                        </select>
                    </div>

                    <div class="form-grupo">
                        <label for="observacoes">Observações</label>
                        <textarea id="observacoes" name="observacoes" rows="4"></textarea>
                    </div>

                    <button type="submit" class="botao-enviar">Agendar Horário</button>
                </form>
            </div>

            <div class="info-agendamento">
                <h3>Informações Importantes</h3>
                <ul>
                    <li><i class="fas fa-clock"></i> Horário de Funcionamento: Segunda a Sexta, das 9h às 18h</li>
                    <li><i class="fas fa-calendar-check"></i> Agendamentos com no mínimo 24h de antecedência</li>
                    <li><i class="fas fa-tools"></i> Diagnóstico inicial gratuito</li>
                    <li><i class="fas fa-car"></i> Estacionamento gratuito</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Rodapé -->
    <footer class="rodape">
        <div class="container">
            <p>&copy; 2023 Evolusom - Todos os direitos reservados</p>
        </div>
    </footer>
</body>
</html>


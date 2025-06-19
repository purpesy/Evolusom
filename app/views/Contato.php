<?php require_once("templates/head.php") ?>
<body class="contato">
    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>
    
    <!-- Banner de Contato -->
    <section class="banner-contato">
        <div class="container">
            <div class="conteudo-banner">
                <h2>Entre em Contato Conosco</h2>
                <p>Estamos prontos para atender você e transformar seu veículo</p>
                <a href="agendamento.html" class="botao-agendar">Agendar Horário</a>
            </div>
        </div>
    </section>

    <!-- Conteúdo Principal -->
    <section class="contato-principal">
        <div class="container">
            <div class="grid-contato">
                <!-- Formulário de Contato -->
                <div class="formulario-contato">
                    <h2 class="titulo-secao">Envie sua Mensagem</h2>
                    <p class="subtitulo-secao">Preencha o formulário abaixo e entraremos em contato o mais breve possível</p>
                    
                    <?php if (isset($_SESSION['sucesso'])): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_SESSION['sucesso'] ?>
                            <?php unset($_SESSION['sucesso']); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['erro'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $_SESSION['erro'] ?>
                            <?php unset($_SESSION['erro']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?= URL_BASE ?>contato/enviarEmail" method="post" class="form-contato">
                        <div class="form-row">
                            <div class="form-grupo">
                                <label for="nome">
                                    <i class="fas fa-user"></i>
                                    Nome Completo *
                                </label>
                                <input type="text" id="nome" name="nome" placeholder="Digite seu nome completo" required>
                            </div>
                            
                            <div class="form-grupo">
                                <label for="email">
                                    <i class="fas fa-envelope"></i>
                                    E-mail *
                                </label>
                                <input type="email" id="email" name="email" placeholder="seu@email.com" required>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-grupo">
                                <label for="fone">
                                    <i class="fas fa-phone"></i>
                                    Telefone *
                                </label>
                                <input type="tel" id="fone" name="fone" placeholder="(11) 99999-9999" required pattern="^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$" maxlength="15">
                            </div>
                            
                            <div class="form-grupo">
                                <label for="assunto">
                                    <i class="fas fa-tag"></i>
                                    Assunto *
                                </label>
                                <select id="assunto" name="assunto" required>
                                    <option value="">Selecione um assunto</option>
                                    <option value="orcamento">Solicitar Orçamento</option>
                                    <option value="agendamento">Agendar Serviço</option>
                                    <option value="duvida">Dúvidas sobre Produtos/Serviços</option>
                                    <option value="suporte">Suporte Técnico</option>
                                    <option value="outro">Outro Assunto</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-grupo">
                                <label for="veiculo">
                                    <i class="fas fa-car"></i>
                                    Modelo do Veículo
                                </label>
                                <input type="text" id="veiculo" name="veiculo" placeholder="Ex: Honda Civic 2020">
                            </div>
                            
                            <div class="form-grupo">
                                <label for="servico">
                                    <i class="fas fa-tools"></i>
                                    Serviço de Interesse
                                </label>
                                <select id="servico" name="servico">
                                    <option value="">Selecione um serviço (opcional)</option>
                                    <option value="peliculas">Películas Automotivas</option>
                                    <option value="vidros">Vidros Elétricos e Travas</option>
                                    <option value="som">Som Automotivo</option>
                                    <option value="iluminacao">Iluminação Automotiva</option>
                                    <option value="chaves">Chaves e Controles</option>
                                    <option value="multimidia">Multimídia e GPS</option>
                                    <option value="outro">Outro Serviço</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-grupo form-grupo-full">
                            <label for="msg">
                                <i class="fas fa-comment-alt"></i>
                                Mensagem *
                            </label>
                            <textarea id="msg" name="msg" rows="5" placeholder="Descreva detalhadamente sua necessidade, dúvida ou solicitação..." required></textarea>
                        </div>
                        
                        <div class="form-grupo form-grupo-full">
                            <div class="checkbox-grupo">
                                <input type="checkbox" id="aceito-termos" name="aceito_termos" required>
                                <label for="aceito-termos" class="checkbox-label">
                                    Aceito receber contato por e-mail e WhatsApp sobre minha solicitação *
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-grupo form-grupo-full">
                            <button type="submit" class="botao-enviar">
                                <i class="fas fa-paper-plane"></i>
                                Enviar Mensagem
                            </button>
                        </div>
                        
                    </form>

                    <script>
                        // Máscara para o campo de telefone
                        const foneInput = document.getElementById('fone');
                        foneInput.addEventListener('input', function (e) {
                            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
                            e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
                        });

                        // Validação de telefone brasileiro
                        function validarTelefoneBR(telefone) {
                            const regex = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
                            return regex.test(telefone);
                        }

                        // Validação do formulário
                        document.querySelector('.form-contato').addEventListener('submit', function(e) {
                            const tel = foneInput.value.trim();
                            const aceitoTermos = document.getElementById('aceito-termos').checked;
                            
                            if (!validarTelefoneBR(tel)) {
                                alert('Por favor, insira um telefone válido no formato (11) 99999-9999 ou (11) 9999-9999.');
                                foneInput.focus();
                                e.preventDefault();
                                return;
                            }
                            
                            if (!aceitoTermos) {
                                alert('Por favor, aceite os termos para prosseguir.');
                                document.getElementById('aceito-termos').focus();
                                e.preventDefault();
                                return;
                            }
                        });

                        // Animação de foco nos campos
                        document.querySelectorAll('.form-contato input, .form-contato select, .form-contato textarea').forEach(field => {
                            field.addEventListener('focus', function() {
                                this.parentElement.classList.add('focused');
                            });
                            
                            field.addEventListener('blur', function() {
                                if (this.value === '') {
                                    this.parentElement.classList.remove('focused');
                                }
                            });
                            
                            // Verificar se já tem valor ao carregar
                            if (field.value !== '') {
                                field.parentElement.classList.add('focused');
                            }
                        });

                        // Contador de caracteres para textarea
                        const msgTextarea = document.getElementById('msg');
                        const maxLength = 1000;
                        
                        // Criar contador
                        const counter = document.createElement('div');
                        counter.className = 'char-counter';
                        counter.textContent = `0/${maxLength}`;
                        msgTextarea.parentElement.appendChild(counter);
                        msgTextarea.setAttribute('maxlength', maxLength);
                        
                        msgTextarea.addEventListener('input', function() {
                            const currentLength = this.value.length;
                            counter.textContent = `${currentLength}/${maxLength}`;
                            
                            if (currentLength > maxLength * 0.9) {
                                counter.style.color = '#e74c3c';
                            } else {
                                counter.style.color = '#7f8c8d';
                            }
                        });
                    </script>
                </div>
                
                <!-- Informações de Contato -->
                <div class="info-contato">
                    <div class="card-info">
                        <div class="card-header">
                            <h2><i class="fas fa-info-circle"></i> Informações de Contato</h2>
                            <p>Entre em contato conosco através dos canais abaixo</p>
                        </div>
                        
                        <div class="info-grid">
                            <div class="info-item">
                                <div class="info-icone">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="info-texto">
                                    <h3>Endereço</h3>
                                    <p>Rua Desembargador Isnard dos Reis, 1068</p>
                                    <p>São Paulo/SP - CEP: 01234-567</p>
                                    <small class="info-extra">Próximo ao metrô Vila Madalena</small>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icone">
                                    <i class="fas fa-phone-alt"></i>
                                </div>
                                <div class="info-texto">
                                    <h3>Telefones</h3>
                                    <p><a href="tel:11989096947">(11) 98909-6947</a></p>
                                    <small class="info-extra">Vendas e Atendimento</small>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icone">
                                    <i class="fas fa-envelope"></i>
                                </div>
                                <div class="info-texto">
                                    <h3>E-mail</h3>
                                    <p><a href="mailto:contato@evolusom.com.br">contato@evolusom.com.br</a></p>
                                    <small class="info-extra">Resposta em até 24h</small>
                                </div>
                            </div>
                            
                            <div class="info-item">
                                <div class="info-icone">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="info-texto">
                                    <h3>Horário de Funcionamento</h3>
                                    <div class="horarios">
                                        <div class="horario-item">
                                            <span class="dia">Segunda a Sexta:</span>
                                            <span class="hora">8h às 18h</span>
                                        </div>
                                        <div class="horario-item">
                                            <span class="dia">Sábado:</span>
                                            <span class="hora">8h às 13h</span>
                                        </div>
                                        <div class="horario-item fechado">
                                            <span class="dia">Domingo:</span>
                                            <span class="hora">Fechado</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="contato-acoes">
                            <div class="botoes-contato">
                                <a href="tel:11989096947" class="botao-telefone">
                                    <i class="fas fa-phone"></i> 
                                    <span>Ligar Agora</span>
                                </a>
                                <a href="https://wa.me/5511989096947" class="botao-whatsapp" target="_blank">
                                    <i class="fab fa-whatsapp"></i> 
                                    <span>WhatsApp</span>
                                </a>
                            </div>
                            
                            <div class="redes-sociais-contato">
                                <h4><i class="fas fa-share-alt"></i> Siga-nos nas Redes Sociais</h4>
                                <div class="icones-sociais">
                                    <a href="#" target="_blank" title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="#" target="_blank" title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="#" target="_blank" title="YouTube">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="#" target="_blank" title="LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-destaque">
                            <div class="destaque-item">
                                <i class="fas fa-shield-alt"></i>
                                <span>Garantia em todos os serviços</span>
                            </div>
                            <div class="destaque-item">
                                <i class="fas fa-tools"></i>
                                <span>Profissionais especializados</span>
                            </div>
                            <div class="destaque-item">
                                <i class="fas fa-clock"></i>
                                <span>Atendimento rápido</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mapa -->
    <section class="mapa-secao">
        <div class="container">
            <h2 class="titulo-secao">Nossa Localização</h2>
            <p class="subtitulo-secao">Venha nos visitar e conheça nossa loja</p>
            
            <div class="mapa-container">
                <iframe src="https://www.google.com/maps?q=Rua+Desembargador+Isnard+dos+Reis,+1068,+São+Paulo+-+SP&output=embed" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            
            <div class="mapa-acoes">
                <a href="https://www.google.com/maps/dir//Rua+Desembargador+Isnard+dos+Reis,+1068,+São+Paulo+-+SP" target="_blank" class="botao-rota">
                    <i class="fas fa-route"></i> Como Chegar
                </a>
            </div>
        </div>
    </section>

    <!-- FAQs -->
    <section class="faq-secao">
        <div class="container">
            <h2 class="titulo-secao">Perguntas Frequentes</h2>
            <p class="subtitulo-secao">Tire suas dúvidas sobre nossos serviços e atendimento</p>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-pergunta">
                        <h3>Como posso agendar um serviço?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-resposta">
                        <p>Você pode agendar um serviço de várias formas: através do nosso site na página de agendamento, por telefone, WhatsApp ou presencialmente em nossa loja. Recomendamos o agendamento prévio para garantir disponibilidade no horário desejado.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-pergunta">
                        <h3>Quais formas de pagamento são aceitas?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-resposta">
                        <p>Aceitamos diversas formas de pagamento: dinheiro, cartões de crédito e débito, PIX e transferência bancária. Para serviços acima de R$ 1.000, oferecemos parcelamento em até 12x no cartão de crédito (sujeito a juros da operadora).</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-pergunta">
                        <h3>Vocês oferecem garantia nos serviços?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-resposta">
                        <p>Sim, todos os nossos serviços possuem garantia. O período varia conforme o tipo de serviço: para instalação de películas, a garantia é de 3 anos; para instalações elétricas e de som, 1 ano; para chaves e controles, 90 dias. As garantias dos produtos seguem as especificações dos fabricantes.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-pergunta">
                        <h3>Quanto tempo leva para realizar os serviços?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-resposta">
                        <p>O tempo varia conforme o serviço: instalação de películas (2-3 horas), vidros elétricos (3-4 horas), som automotivo (4-6 horas), iluminação (2-3 horas), chaves e controles (30-60 minutos), multimídia (3-4 horas). Para serviços mais complexos, podemos precisar do veículo por mais tempo.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-pergunta">
                        <h3>Preciso deixar o veículo? Por quanto tempo?</h3>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="faq-resposta">
                        <p>Sim, para a maioria dos serviços é necessário deixar o veículo conosco. O tempo varia conforme o serviço, mas geralmente recomendamos deixar o veículo por um dia para garantir a qualidade do serviço. Para serviços mais simples como confecção de chaves, você pode aguardar no local.</p>
                    </div>
                </div>
            </div>
            
       
        </div>
    </section>

 

<?php require_once("templates/footer.php")?>

    <!-- Script para o FAQ -->
    <script>
        document.querySelectorAll('.faq-pergunta').forEach(pergunta => {
            pergunta.addEventListener('click', () => {
                const faqItem = pergunta.parentElement;
                faqItem.classList.toggle('ativo');
            });
        });
    </script>
</body>
</html>

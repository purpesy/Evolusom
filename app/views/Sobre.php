<?php require_once("templates/head.php") ?>

<body class="sobre">
    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>

    <!-- Banner Sobre -->
    <section class="banner-sobre">
        <div class="container">
            <div class="conteudo-banner">
                <h2>Conheça a Evolusom</h2>
                <p>Mais de 15 anos transformando veículos com qualidade, inovação e paixão por som automotivo</p>
            </div>
        </div>
    </section>

    <!-- História da Empresa -->
    <section class="historia">
        <div class="container">
            <h2 class="titulo-secao">Nossa História</h2>
            <div class="historia-conteudo">
                <div class="historia-texto">
                    <p>A Evolusom nasceu em 2014 da paixão de Kaine Felipe dos Santos por carros e tecnologia de som automotivo. Localizada na Rua Desembargador Isnard dos Reis, no coração da Cidade Kemel em São Paulo, nossa empresa começou como um pequeno projeto familiar com o sonho de revolucionar a experiência sonora dos veículos paulistanos.</p>
                    
                    <p>Desde o início, nossa missão foi clara: não apenas instalar equipamentos de som, mas criar verdadeiras experiências sensoriais sobre rodas. Com conhecimento técnico adquirido em anos de estudo e prática, Carlos iniciou a Evolusom com apenas dois funcionários em um espaço modesto, mas com grandes ambições.</p>
                    
                    <p>Ao longo dos anos, construímos nossa reputação através da excelência no atendimento, qualidade incomparável dos serviços e um compromisso inabalável com a satisfação de nossos clientes. Hoje, somos referência em som automotivo na região metropolitana de São Paulo, com uma equipe especializada e tecnologia de ponta.</p>
                    
                    <p>Nossa localização estratégica na Zona Leste de São Paulo nos permite atender clientes de toda a região com facilidade de acesso e estacionamento. Evoluímos de uma pequena oficina para um centro completo de customização automotiva, sempre mantendo os valores familiares que nos trouxeram até aqui.</p>
                </div>
                <div class="historia-imagem">
                    <img src="https://streetviewpixels-pa.googleapis.com/v1/thumbnail?cb_client=maps_sv.tactile&w=500&h=300&pitch=9.066360171049453&panoid=Ki9zqhspyTrKCByFA3yipA&yaw=267.4285715474069" alt="Fachada da Evolusom - Rua Desembargador Isnard dos Reis">
                    <p class="imagem-legenda">Nossa sede na Rua Desembargador Isnard dos Reis, 1068 - Cidade Kemel, São Paulo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nossa Equipe -->
    <section class="equipe">
        <div class="container">
            <h2 class="titulo-secao">Nossa Equipe</h2>
            <p class="subtitulo-secao">Profissionais apaixonados por som automotivo e excelência em atendimento</p>

            <div class="equipe-grid">
                <!-- Fundador -->
                <div class="membro-equipe">
                    <div class="membro-foto">
                        <img src="<?php echo URL_BASE ?>/assets/img/cliente1.jpg" alt="Carlos Alberto Mendes">
                    </div>
                    <div class="membro-info">
                        <h3>Carlos Alberto Mendes</h3>
                        <p class="membro-cargo">Fundador e CEO</p>
                        <p class="membro-descricao">Apaixonado por tecnologia automotiva há mais de 20 anos, Carlos fundou a Evolusom com a visão de transformar a experiência sonora dos veículos. Especialista em sistemas de alta fidelidade e customização automotiva.</p>
                        <div class="membro-redes">
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Gerente Técnico -->
                <div class="membro-equipe">
                    <div class="membro-foto">
                        <img src="<?php echo URL_BASE ?>/assets/img/cliente2.jpg" alt="Roberto Silva">
                    </div>
                    <div class="membro-info">
                        <h3>Roberto Silva</h3>
                        <p class="membro-cargo">Gerente Técnico</p>
                        <p class="membro-descricao">Com formação em eletrônica automotiva e 15 anos de experiência, Roberto lidera nossa equipe técnica garantindo a qualidade e precisão de todas as instalações realizadas na Evolusom.</p>
                        <div class="membro-redes">
                            <a href="#" target="_blank"><i class="fab fa-linkedin"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-instagram"></i></a>
                            <a href="#" target="_blank"><i class="fab fa-facebook"></i></a>
                        </div>
                    </div>
                </div>

          
             
            </div>
        </div>
    </section>

    <!-- Depoimentos -->
    <section class="depoimentos-sobre">
        <div class="container">
            <h2 class="titulo-secao">O que nossos clientes dizem</h2>
            <div class="depoimentos-slider">
                <!-- Depoimento 1 -->
                <div class="depoimento-card">
                    <div class="depoimento-texto">
                        <i class="fas fa-quote-left"></i>
                        <p>A Evolusom superou todas as minhas expectativas! Instalaram um sistema de som completo no meu Civic e o resultado foi simplesmente perfeito. A qualidade do som é incrível e o atendimento foi excepcional do início ao fim.</p>
                    </div>
                    <div class="depoimento-autor">
                        <img src="<?php echo URL_BASE ?>/assets/img/cliente1.jpg" alt="Diego Fernandes">
                        <div class="autor-info">
                            <h4>Diego Fernandes</h4>
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Cliente desde 2020</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 2 -->
                <div class="depoimento-card">
                    <div class="depoimento-texto">
                        <i class="fas fa-quote-left"></i>
                        <p>Profissionalismo e qualidade definem a Evolusom. Além da instalação impecável do som, eles aplicaram película e fizeram um trabalho de customização interna que deixou meu carro com cara de zero. Recomendo sem hesitar!</p>
                    </div>
                    <div class="depoimento-autor">
                        <img src="<?php echo URL_BASE ?>/assets/img/cliente2.jpg" alt="Amanda Silva">
                        <div class="autor-info">
                            <h4>Amanda Silva</h4>
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Cliente desde 2019</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 3 -->
                <div class="depoimento-card">
                    <div class="depoimento-texto">
                        <i class="fas fa-quote-left"></i>
                        <p>Já passei em várias lojas da região, mas nenhuma chegou perto do nível da Evolusom. A atenção aos detalhes, o carinho com o veículo do cliente e a qualidade técnica são incomparáveis. Meu Som ficou um espetáculo!</p>
                    </div>
                    <div class="depoimento-autor">
                        <img src="<?php echo URL_BASE ?>/assets/img/cliente3.jpg" alt="Rafael Santos">
                        <div class="autor-info">
                            <h4>Rafael Santos</h4>
                            <div class="estrelas">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p>Cliente desde 2018</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="depoimentos-controles">
                <button class="controle-prev"><i class="fas fa-chevron-left"></i></button>
                <div class="depoimentos-indicadores">
                    <span class="indicador ativo"></span>
                    <span class="indicador"></span>
                    <span class="indicador"></span>
                </div>
                <button class="controle-next"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>


    <!-- Missão, Visão e Valores -->
    <section class="missao-visao-valores">
        <div class="container">
            <h2 class="titulo-secao">Missão, Visão e Valores</h2>
            <div class="mvv-grid">
                <div class="mvv-item missao">
                    <div class="mvv-icone">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3>Missão</h3>
                    <p>Transformar a experiência sonora automotiva de nossos clientes através de soluções tecnológicas inovadoras, instalações profissionais e atendimento excepcional, superando expectativas e criando momentos únicos sobre rodas.</p>
                </div>
                <div class="mvv-item visao">
                    <div class="mvv-icone">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3>Visão</h3>
                    <p>Ser reconhecida como a principal referência em som e customização automotiva na região metropolitana de São Paulo, expandindo nossa presença e mantendo a excelência que nos define há mais de 15 anos.</p>
                </div>
                <div class="mvv-item valores">
                    <div class="mvv-icone">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Valores</h3>
                    <ul class="lista-valores">
                        <li><i class="fas fa-check-circle"></i> Paixão por excelência em tudo que fazemos</li>
                        <li><i class="fas fa-check-circle"></i> Compromisso total com a satisfação do cliente</li>
                        <li><i class="fas fa-check-circle"></i> Honestidade e transparência nas relações</li>
                 
                    </ul>
                </div>
            </div>
        </div>
    </section>



    <!-- Rodapé -->
    <?php require_once("templates/footer.php") ?>
    
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        // Configuração do Lightbox
        lightbox.option({
            'resizeDuration': 200,
            'wrapAround': true,
            'albumLabel': "Imagem %1 de %2"
        });

        // Script para o carrossel de depoimentos
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.depoimentos-slider');
            const cards = document.querySelectorAll('.depoimento-card');
            const prevBtn = document.querySelector('.controle-prev');
            const nextBtn = document.querySelector('.controle-next');
            const indicators = document.querySelectorAll('.indicador');

            let currentIndex = 0;
            const cardWidth = cards[0].offsetWidth;
            const cardMargin = 30;

            function updateSlider() {
                slider.style.transform = `translateX(-${currentIndex * (cardWidth + cardMargin)}px)`;

                indicators.forEach((indicator, index) => {
                    if (index === currentIndex) {
                        indicator.classList.add('ativo');
                    } else {
                        indicator.classList.remove('ativo');
                    }
                });
            }

            prevBtn.addEventListener('click', () => {
                if (currentIndex > 0) {
                    currentIndex--;
                    updateSlider();
                }
            });

            nextBtn.addEventListener('click', () => {
                if (currentIndex < cards.length - 1) {
                    currentIndex++;
                    updateSlider();
                }
            });

            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentIndex = index;
                    updateSlider();
                });
            });
        });
    </script>
</body>

</html>
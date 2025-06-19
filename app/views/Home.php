<?php require_once("templates/head.php") ?>

<body>

    <!-- Alertas de Sistema -->
    <?php if (isset($_SESSION['erro-login'])): ?>
        <div class="alerta-sistema alerta-erro">
            <div class="container">
                <div class="alerta-conteudo">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span><?= $_SESSION['erro-login'] ?></span>
                    <button class="alerta-fechar" onclick="fecharAlerta(this)">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php unset($_SESSION['erro-login']); ?>
    <?php endif; ?>

    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>

    <!-- Banner Principal -->
    <?php require_once("templates/banner.php") ?>

    <!-- Seção de Destaque dos Serviços -->
    <?php require_once("templates/serv-destaque.php") ?>

    <!-- Seção de Produtos -->
    <section class="produtos-destaque">
        <div class="container">
            <h2 class="titulo-secao" data-aos="fade-down">Nossos Produtos</h2>
            
            <!-- Carrossel de Produtos -->
            <div class="produtos-carousel-container" data-aos="fade-up" data-aos-delay="200">
                <div class="produtos-carousel-wrapper">
                    <!-- Botões de navegação -->
                    <button class="carousel-btn carousel-btn-prev" id="produtosPrevBtn">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="carousel-btn carousel-btn-next" id="produtosNextBtn">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                    
                    <div class="produtos-carousel-track" id="produtosCarouselTrack">
                        <?php if (!empty($produtos_destaque)): ?>
                            <?php foreach ($produtos_destaque as $produto): ?>
                                <div class="produto-slide">
                                    <div class="produto-card-moderno">
                                        <?php 
                                        // Define badges aleatórios para variar
                                        $badges = ['Novo', 'Oferta', 'Popular', 'Premium'];
                                        $badge_classes = ['novo', 'oferta', 'popular', 'premium'];
                                        $random_badge = rand(0, 3);
                                        if ($random_badge < 3): // 75% de chance de ter badge
                                        ?>
                                            <div class="produto-badges">
                                                <div class="badge <?= $badge_classes[$random_badge] ?>"><?= $badges[$random_badge] ?></div>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="produto-imagem-container">
                                            <img src="<?= !empty($produto['produto_foto']) ? URL_BASE . 'assets/img/produtos/' . htmlspecialchars($produto['produto_foto']) : 'https://via.placeholder.com/400x300/f0f0f0/666?text=' . urlencode($produto['produto_nome']) ?>" 
                                                 alt="<?= htmlspecialchars($produto['produto_nome']) ?>" 
                                                 loading="lazy">
                                            <div class="produto-hover-overlay">
                                                <button class="btn-acao" onclick="window.location.href='<?= URL_BASE ?>produto'">
                                                    <i class="fas fa-eye"></i>
                                                    <span>Ver Detalhes</span>
                                                </button>
                                                <button class="btn-acao favorito">
                                                    <i class="far fa-heart"></i>
                                                </button>
                                            </div>
                                        </div>
                                        
                                        <div class="produto-info">
                                            <div class="produto-categoria"><?= isset($produto['nome_categoria']) ? htmlspecialchars($produto['nome_categoria']) : 'Produtos' ?></div>
                                            <h3 class="produto-titulo"><?= htmlspecialchars($produto['produto_nome']) ?></h3>
                                            <p class="produto-descricao"><?= htmlspecialchars(substr($produto['produto_descricao'], 0, 80)) ?>...</p>
                                            
                                            <div class="produto-avaliacao">
                                                <div class="estrelas">
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                    <i class="fas fa-star"></i>
                                                </div>
                                                <span class="avaliacao-texto">(<?= rand(15, 95) ?> avaliações)</span>
                                            </div>
                                            
                                            <div class="produto-preco">
                                                <span class="preco-atual">R$ <?= number_format($produto['produto_preco'], 2, ',', '.') ?></span>
                                                <?php if (rand(0, 2) == 0): // 33% de chance de ter preço anterior ?>
                                                    <span class="preco-anterior">R$ <?= number_format($produto['produto_preco'] * 1.2, 2, ',', '.') ?></span>
                                                <?php endif; ?>
                                            </div>
                                            
                                            <div class="produto-acoes">
                                                <button class="btn-principal" onclick="interesseProdutoWhatsApp('<?= htmlspecialchars($produto['produto_nome']) ?>', '<?= isset($produto['nome_categoria']) ? htmlspecialchars($produto['nome_categoria']) : 'Produto' ?>', '<?= number_format($produto['produto_preco'], 2, ',', '.') ?>')">
                                                    <i class="fab fa-whatsapp"></i>
                                                    Fale Conosco
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Fallback caso não tenha produtos -->
                            <div class="produto-slide">
                                <div class="produto-card-moderno">
                                    <div class="produto-imagem-container">
                                        <img src="https://via.placeholder.com/400x300/f0f0f0/666?text=Produtos+em+breve" alt="Produtos em breve">
                                    </div>
                                    <div class="produto-info">
                                        <div class="produto-categoria">Em breve</div>
                                        <h3 class="produto-titulo">Produtos em breve</h3>
                                        <p class="produto-descricao">Estamos preparando nossos produtos para você!</p>
                                        <div class="produto-preco">
                                            <span class="preco-atual">Em breve</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <!-- Indicadores -->
                <div class="carousel-indicators" id="produtosIndicators">
                    <!-- Indicadores serão gerados pelo JavaScript -->
                </div>
            </div>

            <!-- Botão de Ação -->
            <div class="produtos-cta" data-aos="fade-up" data-aos-delay="400">
                <a href="<?= URL_BASE ?>produto" class="btn-ver-todos-produtos">
                    <span>Ver Todos os Produtos</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Depoimentos de Clientes -->
    <?php require_once("templates/depoimento.php") ?>

    <!-- Galeria de Imagens e Vídeos -->
    <!-- <section class="galeria">
        <div class="container">
            <h2 class="titulo-secao">Galeria de Trabalhos</h2>
            <div class="grid-galeria">
                <div class="item-galeria">
                    <img src="https://via.placeholder.com/300x200" alt="Instalação de Som">
                </div>
                <div class="item-galeria">
                    <img src="https://via.placeholder.com/300x200" alt="Aplicação de Película">
                </div>
                <div class="item-galeria">
                    <img src="https://via.placeholder.com/300x200" alt="Instalação de Multimídia">
                </div>
                <div class="item-galeria">
                    <img src="https://via.placeholder.com/300x200" alt="Faróis Instalados">
                </div>
               <div class="item-galeria video">
    <iframe width="300" height="200" src="https://www.youtube.com/embed/K3U1FPv5HKs" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
</div>

                <div class="item-galeria">
                    <img src="https://via.placeholder.com/300x200" alt="Caixa de Som Personalizada">
                </div>
            </div>
            <a href="agendar.html" class="botao-agendar">Agende uma Visita</a>
        </div>
    </section> -->

    <!-- Seção de Promoções e Destaques -->
    <?php require_once("templates/promo.php") ?>



    <!-- Seção Informativa e Educativa -->
    <!-- <section class="blog-dicas">
        <div class="container">
            <h2 class="titulo-secao">Blog e Dicas</h2>
            <div class="lista-posts">
                <div class="post">
                    <div class="imagem-post">
                        <img src="https://via.placeholder.com/300x200" alt="Dica sobre som automotivo">
                    </div>
                    <div class="conteudo-post">
                        <h3>Como escolher o melhor som para seu carro</h3>
                        <p>Confira nossas dicas para escolher o sistema de som ideal para o seu veículo...</p>
                        <a href="#" class="link-ler-mais">Ler mais</a>
                    </div>
                </div>
                <div class="post">
                    <div class="imagem-post">
                        <img src="https://via.placeholder.com/300x200" alt="Dica sobre películas">
                    </div>
                    <div class="conteudo-post">
                        <h3>Benefícios das películas automotivas</h3>
                        <p>Saiba como as películas podem proteger você e seu veículo dos raios solares...</p>
                        <a href="#" class="link-ler-mais">Ler mais</a>
                    </div>
                </div>
                <div class="post">
                    <div class="imagem-post">
                        <img src="https://via.placeholder.com/300x200" alt="Dica sobre manutenção">
                    </div>
                    <div class="conteudo-post">
                        <h3>Cuidados com a manutenção do seu sistema de som</h3>
                        <p>Aprenda como prolongar a vida útil dos equipamentos de som do seu carro...</p>
                        <a href="#" class="link-ler-mais">Ler mais</a>
                    </div>
                </div>
            </div>
        </div>
    </section> -->


    <?php require_once("templates/footer.php") ?>

    <script>
    
    document.querySelectorAll('.botao-agendar').forEach(botao => {
        botao.addEventListener('click', function(event) {
            event.preventDefault();
            const formulario = document.getElementById('formulario-popup');
            if (formulario) {
                formulario.style.display = 'block';
            }
        });
    });

    const botaoFechar = document.getElementById('fechar-formulario');
    if (botaoFechar) {
        botaoFechar.addEventListener('click', function () {
            const formulario = document.getElementById('formulario-popup');
            if (formulario) {
                formulario.style.display = 'none';
            }
        });
    }

    // Carrossel de Produtos com Controles - Responsivo
    const trackProdutos = document.getElementById('produtosCarouselTrack');
    if (trackProdutos) {
        const slidesProdutos = trackProdutos.querySelectorAll('.produto-slide');
        const totalSlidesProdutos = slidesProdutos.length;
        const prevBtn = document.getElementById('produtosPrevBtn');
        const nextBtn = document.getElementById('produtosNextBtn');
        const indicatorsContainer = document.getElementById('produtosIndicators');
        
        if (totalSlidesProdutos > 1) {
            let currentIndexProdutos = 0;
            let autoplayTimerProdutos;
            const autoplayIntervalProdutos = 4000; // 4 segundos
            
            // Função para obter quantos slides mostrar baseado na largura da tela
            function getSlidesToShowProdutos() {
                const width = window.innerWidth;
                if (width <= 576) return 1; // Mobile: 1 card
                if (width <= 768) return 2; // Tablet: 2 cards
                return 4; // Desktop: 4 cards
            }
            
            // Função para criar indicadores
            function createIndicatorsProdutos() {
                const slidesToShow = getSlidesToShowProdutos();
                const totalPages = Math.ceil(totalSlidesProdutos / slidesToShow);
                
                indicatorsContainer.innerHTML = '';
                
                for (let i = 0; i < totalPages; i++) {
                    const indicator = document.createElement('button');
                    indicator.className = 'carousel-indicator';
                    if (i === 0) indicator.classList.add('active');
                    
                    indicator.addEventListener('click', () => {
                        currentIndexProdutos = i;
                        updateCarouselProdutos();
                        updateIndicatorsProdutos();
                        restartAutoplayProdutos();
                    });
                    
                    indicatorsContainer.appendChild(indicator);
                }
            }
            
            // Função para atualizar indicadores
            function updateIndicatorsProdutos() {
                const indicators = indicatorsContainer.querySelectorAll('.carousel-indicator');
                const slidesToShow = getSlidesToShowProdutos();
                const currentPage = Math.floor(currentIndexProdutos / slidesToShow);
                
                indicators.forEach((indicator, index) => {
                    indicator.classList.toggle('active', index === currentPage);
                });
            }
            
            // Função para atualizar o carrossel
            function updateCarouselProdutos() {
                const slidesToShow = getSlidesToShowProdutos();
                const slideWidth = 100 / slidesToShow;
                const maxIndex = Math.max(0, totalSlidesProdutos - slidesToShow);
                
                // Ajustar largura do track
                trackProdutos.style.width = `${(totalSlidesProdutos * slideWidth)}%`;
                
                // Reposicionar se necessário
                if (currentIndexProdutos > maxIndex) {
                    currentIndexProdutos = maxIndex;
                }
                
                const translateX = -currentIndexProdutos * slideWidth;
                trackProdutos.style.transform = `translateX(${translateX}%)`;
                
                return { slidesToShow, slideWidth, maxIndex };
            }
            
            // Função para mover o carrossel
            function moveCarouselProdutos(direction = 'next') {
                const { slidesToShow, maxIndex } = updateCarouselProdutos();
                
                if (direction === 'next') {
                    currentIndexProdutos++;
                    if (currentIndexProdutos > maxIndex) {
                        currentIndexProdutos = 0; // Volta para o início
                    }
                } else {
                    currentIndexProdutos--;
                    if (currentIndexProdutos < 0) {
                        currentIndexProdutos = maxIndex; // Vai para o final
                    }
                }
                
                const slideWidth = 100 / slidesToShow;
                const translateX = -currentIndexProdutos * slideWidth;
                trackProdutos.style.transform = `translateX(${translateX}%)`;
                updateIndicatorsProdutos();
            }
            
            // Iniciar autoplay
            function startAutoplayProdutos() {
                if (autoplayTimerProdutos) clearInterval(autoplayTimerProdutos);
                autoplayTimerProdutos = setInterval(() => moveCarouselProdutos('next'), autoplayIntervalProdutos);
            }
            
            // Parar autoplay
            function stopAutoplayProdutos() {
                if (autoplayTimerProdutos) clearInterval(autoplayTimerProdutos);
            }
            
            // Reiniciar autoplay
            function restartAutoplayProdutos() {
                stopAutoplayProdutos();
                startAutoplayProdutos();
            }
            
            // Event listeners para botões
            prevBtn.addEventListener('click', () => {
                moveCarouselProdutos('prev');
                restartAutoplayProdutos();
            });
            
            nextBtn.addEventListener('click', () => {
                moveCarouselProdutos('next');
                restartAutoplayProdutos();
            });
            
            // Inicializar
            createIndicatorsProdutos();
            updateCarouselProdutos();
            startAutoplayProdutos();
            
            // Reajustar no resize
            window.addEventListener('resize', function() {
                createIndicatorsProdutos();
                updateCarouselProdutos();
                updateIndicatorsProdutos();
            });
            
            // Pausar no hover
            trackProdutos.addEventListener('mouseenter', stopAutoplayProdutos);
            trackProdutos.addEventListener('mouseleave', startAutoplayProdutos);
            
            // Pausar no hover do container também
            const containerProdutos = trackProdutos.closest('.produtos-carousel-container');
            if (containerProdutos) {
                containerProdutos.addEventListener('mouseenter', stopAutoplayProdutos);
                containerProdutos.addEventListener('mouseleave', startAutoplayProdutos);
            }
        }
    }
    
    // Função para interesse no produto via WhatsApp
    function interesseProdutoWhatsApp(nomeProduto) {
        const numeroWhatsApp = '5511989096947';
        const mensagem = `Olá! Tenho interesse no produto: ${nomeProduto}`;
        const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`;
        window.open(urlWhatsApp, '_blank');
    }
    
    // Função para fechar alerta
    function fecharAlerta(botao) {
        const alerta = botao.closest('.alerta-sistema');
        if (alerta) {
            alerta.style.animation = 'slideUp 0.3s ease-in forwards';
            setTimeout(() => {
                alerta.remove();
            }, 300);
        }
    }
</script>

<style>
/* Alertas de Sistema */
.alerta-sistema {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    z-index: 10000;
    padding: 15px 0;
    animation: slideDown 0.5s ease-out;
}

.alerta-erro {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    color: white;
    box-shadow: 0 4px 15px rgba(231, 76, 60, 0.3);
}

.alerta-conteudo {
    display: flex;
    align-items: center;
    justify-content: space-between;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.alerta-conteudo i:first-child {
    font-size: 18px;
    margin-right: 12px;
    color: #fff;
}

.alerta-conteudo span {
    flex: 1;
    font-size: 16px;
    font-weight: 500;
}

.alerta-fechar {
    background: none;
    border: none;
    color: white;
    font-size: 18px;
    cursor: pointer;
    padding: 5px;
    border-radius: 50%;
    transition: background 0.3s ease;
    margin-left: 15px;
}

.alerta-fechar:hover {
    background: rgba(255, 255, 255, 0.2);
}

@keyframes slideDown {
    from {
        transform: translateY(-100%);
        opacity: 0;
    }
    to {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideUp {
    from {
        transform: translateY(0);
        opacity: 1;
    }
    to {
        transform: translateY(-100%);
        opacity: 0;
    }
}

/* Responsivo */
@media (max-width: 768px) {
    .alerta-sistema {
        padding: 12px 0;
    }
    
    .alerta-conteudo {
        padding: 0 15px;
    }
    
    .alerta-conteudo span {
        font-size: 14px;
    }
}
</style>

</body>

</html>
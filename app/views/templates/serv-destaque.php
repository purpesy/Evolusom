<section class="servicos-destaque">
    <div class="container">
        <h2 class="titulo-secao" data-aos="fade-down">Nossos Serviços</h2>
        
        <!-- Carrossel de Serviços -->
        <div class="servicos-carousel-container" data-aos="fade-up" data-aos-delay="200">
            <!-- Botões de navegação -->
            <button class="carousel-btn carousel-btn-prev" id="servicosPrevBtn">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="carousel-btn carousel-btn-next" id="servicosNextBtn">
                <i class="fas fa-chevron-right"></i>
            </button>
            
            <div class="servicos-carousel-wrapper">
                <div class="servicos-carousel-track" id="servicosCarouselTrack">
                    <?php if (isset($servicos_destaque) && !empty($servicos_destaque)): ?>
                        <?php foreach ($servicos_destaque as $servico): ?>
                            <div class="servico-slide">
                                <div class="servico-card-moderno">
                            
                                    
                                    <div class="servico-imagem-container">
                                        <img src="<?= !empty($servico['foto_servico']) ? URL_BASE . 'assets/img/servicos/' . $servico['foto_servico'] : 'https://via.placeholder.com/400x300/f0f0f0/666?text=' . urlencode($servico['nome_servico']) ?>" 
                                             alt="<?= htmlspecialchars($servico['alt_servico'] ?? $servico['nome_servico']) ?>" 
                                             loading="lazy">
                                        <div class="servico-hover-overlay">
                                            <button class="btn-acao" onclick="window.location.href='<?= URL_BASE ?>servico'">
                                                <i class="fas fa-eye"></i>
                                                <span>Ver Detalhes</span>
                                            </button>
                                            <button class="btn-acao favorito">
                                                <i class="far fa-heart"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="servico-info">
                                        <div class="servico-categoria">Serviços Automotivos</div>
                                        <h3 class="servico-titulo"><?= htmlspecialchars($servico['nome_servico']) ?></h3>
                                        <p class="servico-descricao"><?= htmlspecialchars(substr($servico['descricao_servico'], 0, 80)) ?>...</p>
                                        
                                        <div class="servico-avaliacao">
                                            <div class="estrelas">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="avaliacao-texto">(<?= rand(15, 195) ?> avaliações)</span>
                                        </div>
                                        
                                        <div class="servico-preco">
                                            <span class="preco-atual">R$ <?= number_format($servico['preco_servico'], 2, ',', '.') ?></span>
                                            <span class="servico-tempo">
                                                <i class="fas fa-clock"></i>
                                                <?= htmlspecialchars($servico['tempo_servico'] ?? '2-3h') ?>
                                            </span>
                                        </div>
                                        
                                        <div class="servico-acoes">
                                            <button class="btn-principal" onclick="agendarServicoWhatsApp('<?= htmlspecialchars($servico['nome_servico']) ?>', '<?= number_format($servico['preco_servico'], 2, ',', '.') ?>')">
                                                <i class="fas fa-calendar-plus"></i>
                                                Agendar Agora
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <!-- Fallback caso não tenha serviços -->
                        <div class="servico-slide">
                            <div class="servico-card-moderno">
                                <div class="servico-imagem-container">
                                    <img src="https://via.placeholder.com/400x300/f0f0f0/666?text=Serviços+em+breve" alt="Serviços em breve">
                                </div>
                                <div class="servico-info">
                                    <div class="servico-categoria">Em breve</div>
                                    <h3 class="servico-titulo">Serviços em breve</h3>
                                    <p class="servico-descricao">Estamos preparando nossos serviços para você!</p>
                                    <div class="servico-preco">
                                        <span class="preco-atual">Consulte</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Indicadores -->
            <div class="carousel-indicators" id="servicosIndicators">
                <!-- Indicadores serão gerados pelo JavaScript -->
            </div>
        </div>

        <!-- Botão de Ação -->
        <div class="servicos-cta" data-aos="fade-up" data-aos-delay="400">
            <a href="<?= URL_BASE ?>servico" class="btn-ver-todos-servicos">
                <span>Ver Todos os Serviços</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<script>
// Função para agendar serviço via WhatsApp
function agendarServicoWhatsApp(nomeServico, preco) {
    const numeroWhatsApp = '5511989096947';
    const mensagem = `Olá! Gostaria de agendar o serviço: ${nomeServico} - Valor: R$ ${preco}`;
    const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${encodeURIComponent(mensagem)}`;
    window.open(urlWhatsApp, '_blank');
}

// Carrossel de Serviços com Controles - Responsivo
document.addEventListener('DOMContentLoaded', function() {
    const trackServicos = document.getElementById('servicosCarouselTrack');
    if (!trackServicos) return;
    
    const slidesServicos = trackServicos.querySelectorAll('.servico-slide');
    const totalSlidesServicos = slidesServicos.length;
    const prevBtn = document.getElementById('servicosPrevBtn');
    const nextBtn = document.getElementById('servicosNextBtn');
    const indicatorsContainer = document.getElementById('servicosIndicators');
    
    if (totalSlidesServicos <= 1) return;
    
    let currentIndexServicos = 0;
    let autoplayTimerServicos;
    const autoplayIntervalServicos = 3000; // 3 segundos
    
    // Função para obter quantos slides mostrar baseado na largura da tela
    function getSlidesToShowServicos() {
        const width = window.innerWidth;
        if (width <= 576) return 1; // Mobile: 1 card
        if (width <= 768) return 2; // Tablet: 2 cards
        return 4; // Desktop: 4 cards
    }
    
    // Função para criar indicadores
    function createIndicatorsServicos() {
        const slidesToShow = getSlidesToShowServicos();
        const totalPages = Math.ceil(totalSlidesServicos / slidesToShow);
        
        indicatorsContainer.innerHTML = '';
        
        for (let i = 0; i < totalPages; i++) {
            const indicator = document.createElement('button');
            indicator.className = 'carousel-indicator';
            if (i === 0) indicator.classList.add('active');
            
            indicator.addEventListener('click', () => {
                currentIndexServicos = i;
                updateCarouselServicos();
                updateIndicatorsServicos();
                restartAutoplayServicos();
            });
            
            indicatorsContainer.appendChild(indicator);
        }
    }
    
    // Função para atualizar indicadores
    function updateIndicatorsServicos() {
        const indicators = indicatorsContainer.querySelectorAll('.carousel-indicator');
        const slidesToShow = getSlidesToShowServicos();
        const currentPage = Math.floor(currentIndexServicos / slidesToShow);
        
        indicators.forEach((indicator, index) => {
            indicator.classList.toggle('active', index === currentPage);
        });
    }
    
    // Função para atualizar o carrossel
    function updateCarouselServicos() {
        const slidesToShow = getSlidesToShowServicos();
        const slideWidth = 100 / slidesToShow;
        const maxIndex = Math.max(0, totalSlidesServicos - slidesToShow);
        
        // Ajustar largura do track
        trackServicos.style.width = `${(totalSlidesServicos * slideWidth)}%`;
        
        // Reposicionar se necessário
        if (currentIndexServicos > maxIndex) {
            currentIndexServicos = maxIndex;
        }
        
        const translateX = -currentIndexServicos * slideWidth;
        trackServicos.style.transform = `translateX(${translateX}%)`;
        
        return { slidesToShow, slideWidth, maxIndex };
    }
    
    // Função para mover o carrossel
    function moveCarouselServicos(direction = 'next') {
        const { slidesToShow, maxIndex } = updateCarouselServicos();
        
        if (direction === 'next') {
            currentIndexServicos++;
            if (currentIndexServicos > maxIndex) {
                currentIndexServicos = 0; // Volta para o início
            }
        } else {
            currentIndexServicos--;
            if (currentIndexServicos < 0) {
                currentIndexServicos = maxIndex; // Vai para o final
            }
        }
        
        const slideWidth = 100 / slidesToShow;
        const translateX = -currentIndexServicos * slideWidth;
        trackServicos.style.transform = `translateX(${translateX}%)`;
        updateIndicatorsServicos();
    }
    
    // Iniciar autoplay
    function startAutoplayServicos() {
        if (autoplayTimerServicos) clearInterval(autoplayTimerServicos);
        autoplayTimerServicos = setInterval(() => moveCarouselServicos('next'), autoplayIntervalServicos);
    }
    
    // Parar autoplay
    function stopAutoplayServicos() {
        if (autoplayTimerServicos) clearInterval(autoplayTimerServicos);
    }
    
    // Reiniciar autoplay
    function restartAutoplayServicos() {
        stopAutoplayServicos();
        startAutoplayServicos();
    }
    
    // Event listeners para botões
    prevBtn.addEventListener('click', () => {
        moveCarouselServicos('prev');
        restartAutoplayServicos();
    });
    
    nextBtn.addEventListener('click', () => {
        moveCarouselServicos('next');
        restartAutoplayServicos();
    });
    
    // Inicializar
    createIndicatorsServicos();
    updateCarouselServicos();
    startAutoplayServicos();
    
    // Reajustar no resize
    window.addEventListener('resize', function() {
        createIndicatorsServicos();
        updateCarouselServicos();
        updateIndicatorsServicos();
    });
    
    // Pausar no hover
    trackServicos.addEventListener('mouseenter', stopAutoplayServicos);
    trackServicos.addEventListener('mouseleave', startAutoplayServicos);
    
    // Pausar no hover do container também
    const containerServicos = trackServicos.closest('.servicos-carousel-container');
    if (containerServicos) {
        containerServicos.addEventListener('mouseenter', stopAutoplayServicos);
        containerServicos.addEventListener('mouseleave', startAutoplayServicos);
    }
    
    // Esconder controles no mobile
    function toggleControls() {
        const width = window.innerWidth;
        const showControls = width > 576;
        
        prevBtn.style.display = showControls ? 'flex' : 'none';
        nextBtn.style.display = showControls ? 'flex' : 'none';
    }
    
    toggleControls();
    window.addEventListener('resize', toggleControls);
});
</script>
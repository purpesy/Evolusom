<?php require_once("templates/head.php") ?>
<body class="servicos-moderno">

    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>
    
    <!-- Hero Section -->
    <section class="hero-servicos">
        <div class="hero-overlay"></div>
        <div class="container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fas fa-tools"></i>
                    <span>Serviços Especializados</span>
                </div>
                <h1>Transforme Seu Veículo com Nossos Serviços</h1>
                <p>Profissionais experientes, tecnologia de ponta e qualidade garantida para deixar seu carro do jeito que você sempre sonhou</p>
                
                <div class="hero-stats">
                    <div class="stat-item">
                        <span class="stat-number">15+</span>
                        <span class="stat-label">Anos de Experiência</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">5000+</span>
                        <span class="stat-label">Carros Transformados</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-number">100%</span>
                        <span class="stat-label">Satisfação</span>
                    </div>
                </div>
                
                <div class="hero-actions">
                    <button class="btn-primary" onclick="abrirWhatsApp()">
                        <i class="fab fa-whatsapp"></i>
                        Agendar pelo WhatsApp
                    </button>
                    <button class="btn-secondary" onclick="scrollToServicos()">
                        <i class="fas fa-arrow-down"></i>
                        Ver Serviços
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Filtros de Serviços -->
    <!-- <section class="filtros-servicos">
        <div class="container">
            <div class="filtros-content d-flex align-items-center justify-content-between gap-4">
                <div class="filtro-categoria flex-grow-1">
                    <label class="d-block mb-2">Categoria:</label>
                    <select id="filtroCategoria" class="form-select w-100">
                        <option value="">Todos os Serviços</option>
                        <option value="som">Som & Multimídia</option>
                        <option value="seguranca">Segurança & Alarmes</option>
                        <option value="conforto">Conforto & Praticidade</option>
                        <option value="estetica">Estética & Proteção</option>
                    </select>
                </div>
                
                <div class="filtro-preco flex-grow-1">
                    <label class="d-block mb-2">Faixa de Preço:</label>
                    <select id="filtroPreco" class="form-select w-100">
                        <option value="">Todos os Preços</option>
                        <option value="0-300">Até R$ 300</option>
                        <option value="300-600">R$ 300 - R$ 600</option>
                        <option value="600-1000">R$ 600 - R$ 1.000</option>
                        <option value="1000+">Acima de R$ 1.000</option>
                    </select>
                </div>
                
                <div class="filtro-busca flex-grow-1">
                    <label class="d-block mb-2">Buscar:</label>
                    <div class="input-group">
                        <input type="text" id="buscarServico" class="form-control" placeholder="Buscar serviço...">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- Grid de Serviços -->
    <section class="servicos-grid" id="servicos">
        <div class="container">
            <div class="section-header">
                <h2>Nossos Serviços Especializados</h2>
              
            </div>
            
            <div class="servicos-container" id="servicosContainer">
                <?php if (isset($servicos_destaque) && !empty($servicos_destaque)): ?>
                    <?php foreach ($servicos_destaque as $servico): ?>
                        <div class="servico-card">
                            <div class="servico-imagem">
                                <img src="<?= !empty($servico['foto_servico']) ? URL_BASE . 'assets/img/servicos/' . $servico['foto_servico'] : 'https://via.placeholder.com/400x250/f0f0f0/666?text=' . urlencode($servico['nome_servico']) ?>" 
                                     alt="<?= htmlspecialchars($servico['alt_servico'] ?? $servico['nome_servico']) ?>" loading="lazy">
                                <div class="servico-categoria">Serviços Automotivos</div>
                            </div>
                            <div class="servico-info">
                                <h3 class="servico-titulo"><?= htmlspecialchars($servico['nome_servico']) ?></h3>
                                <p class="servico-descricao"><?= htmlspecialchars($servico['descricao_servico']) ?></p>
                                
                                <div class="servico-rating">
                                    <div class="stars">★★★★★</div>
                                    <span class="rating-text">4.8 (<?= rand(50, 200) ?> avaliações)</span>
                                </div>
                                
                                <div class="servico-detalhes">
                                    <div class="servico-preco">R$ <?= number_format($servico['preco_servico'], 2, ',', '.') ?></div>
                                    <div class="servico-tempo">
                                        <i class="fas fa-clock"></i>
                                        <?= htmlspecialchars($servico['tempo_servico'] ?? '2-3 horas') ?>
                                    </div>
                                </div>
                                
                                <div class="servico-actions">
                                    <button class="btn-agendar-servico-full" onclick="agendarServicoWhatsApp('<?= htmlspecialchars($servico['nome_servico']) ?>')">
                                        <i class="fas fa-calendar-plus"></i>
                                        Agendar
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="servico-card">
                        <div class="servico-imagem">
                            <img src="https://via.placeholder.com/400x250/f0f0f0/666?text=Serviços+em+breve" alt="Serviços em breve">
                            <div class="servico-categoria">Em breve</div>
                        </div>
                        <div class="servico-info">
                            <h3 class="servico-titulo">Serviços em breve</h3>
                            <p class="servico-descricao">Estamos preparando nossos serviços para você!</p>
                            <div class="servico-detalhes">
                                <div class="servico-preco">Consulte</div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="load-more-container">
                <button id="loadMore" class="btn-load-more">
                    <i class="fas fa-plus"></i>
                    Carregar Mais Serviços
                </button>
            </div>
        </div>
    </section>

    <!-- Pacotes Promocionais -->
    <section class="pacotes-promocionais">
        <div class="container">
            <div class="section-header">
                <h2>Pacotes Promocionais</h2>
                <p>Economize combinando nossos serviços em pacotes especiais</p>
            </div>
            
            <div class="pacotes-grid">
                <div class="pacote-card">
                    <div class="pacote-badge">ECONÔMICO</div>
                    <div class="pacote-header">
                        <h3>Pacote Essencial</h3>
                        <div class="pacote-preco">
                            <span class="preco-atual">R$ 799</span>
                            <span class="preco-original">R$ 999</span>
                        </div>
                        <div class="desconto">20% OFF</div>
                    </div>
                    <div class="pacote-content">
                        <ul class="pacote-itens">
                            <li><i class="fas fa-check"></i> Película Automotiva Completa</li>
                            <li><i class="fas fa-check"></i> Alarme com Controle Remoto</li>
                            <li><i class="fas fa-check"></i> Instalação de Som Básico</li>
                        </ul>
                        <div class="pacote-tempo">
                            <i class="fas fa-clock"></i> Entrega em 1 dia útil
                        </div>
                    </div>
                    <button class="btn-pacote" onclick="agendarPacote('essencial')">
                        Agendar Agora
                    </button>
                </div>
                
                <div class="pacote-card destaque">
                    <div class="pacote-badge popular">MAIS POPULAR</div>
                    <div class="pacote-header">
                        <h3>Pacote Premium</h3>
                        <div class="pacote-preco">
                            <span class="preco-atual">R$ 1.899</span>
                            <span class="preco-original">R$ 2.499</span>
                        </div>
                        <div class="desconto">25% OFF</div>
                    </div>
                    <div class="pacote-content">
                        <ul class="pacote-itens">
                            <li><i class="fas fa-check"></i> Película Premium Anti-Risco</li>
                            <li><i class="fas fa-check"></i> Sistema de Som Completo</li>
                            <li><i class="fas fa-check"></i> Central Multimídia Android</li>
                            <li><i class="fas fa-check"></i> Câmera de Ré HD</li>
                            <li><i class="fas fa-check"></i> Alarme com Sen. Presença</li>
                        </ul>
                        <div class="pacote-tempo">
                            <i class="fas fa-clock"></i> Entrega em 2 dias úteis
                        </div>
                    </div>
                    <button class="btn-pacote" onclick="agendarPacote('premium')">
                        Agendar Agora
                    </button>
                </div>
                
                <div class="pacote-card">
                    <div class="pacote-badge">LUXO</div>
                    <div class="pacote-header">
                        <h3>Pacote VIP</h3>
                        <div class="pacote-preco">
                            <span class="preco-atual">R$ 3.499</span>
                            <span class="preco-original">R$ 4.299</span>
                        </div>
                        <div class="desconto">30% OFF</div>
                    </div>
                    <div class="pacote-content">
                        <ul class="pacote-itens">
                            <li><i class="fas fa-check"></i> Película Ceramica Premium</li>
                            <li><i class="fas fa-check"></i> Som Profissional com Sub</li>
                            <li><i class="fas fa-check"></i> Multimídia Tesla Style</li>
                            <li><i class="fas fa-check"></i> Câmera 360° + Sensores</li>
                            <li><i class="fas fa-check"></i> Iluminação LED Completa</li>
                            <li><i class="fas fa-check"></i> Vidros e Travas Elétricas</li>
                        </ul>
                        <div class="pacote-tempo">
                            <i class="fas fa-clock"></i> Entrega em 3 dias úteis
                        </div>
                    </div>
                    <button class="btn-pacote" onclick="agendarPacote('vip')">
                        Agendar Agora
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefícios -->
    <section class="beneficios-servicos">
        <div class="container">
            <div class="section-header">
                <h2>Por Que Escolher a Evolusom?</h2>
                <p>Diferenciais que fazem toda a diferença na qualidade do seu serviço</p>
            </div>
            
            <div class="beneficios-grid">
                <div class="beneficio-item">
                    <div class="beneficio-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Garantia Estendida</h3>
                    <p>Até 3 anos de garantia em nossos serviços e produtos, garantindo sua tranquilidade</p>
                    <div class="beneficio-badge">
                        <span>3 anos</span>
                    </div>
                </div>
                
           
                
                <div class="beneficio-item">
                    <div class="beneficio-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Agilidade Garantida</h3>
                    <p>Cumprimos rigorosamente os prazos acordados, respeitando seu tempo</p>
                    <div class="beneficio-badge">
                        <span>100%</span>
                    </div>
                </div>
                
               
                
            
                
                <div class="beneficio-item">
                    <div class="beneficio-icon">
                        <i class="fas fa-thumbs-up"></i>
                    </div>
                    <h3>Satisfação Garantida</h3>
                    <p>Mais de 5.000 clientes satisfeitos em todo o Brasil confiam nos nossos serviços</p>
                    <div class="beneficio-badge">
                        <span>5k+</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="faq-servicos">
        <div class="container">
            <div class="section-header">
                <h2>Perguntas Frequentes</h2>
                <p>Tire suas dúvidas sobre nossos serviços</p>
            </div>
            
            <div class="faq-container">
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Quanto tempo leva para instalar uma película completa?</h4>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>A instalação de película completa leva em média 2 a 3 horas, dependendo do tipo de veículo. Recomendamos deixar o carro conosco por um dia para garantir a secagem adequada e evitar imperfeições.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Vocês oferecem garantia para todos os serviços?</h4>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Sim! Oferecemos garantia de até 3 anos para películas, 1 ano para instalações elétricas e som, e seguimos a garantia do fabricante para todos os produtos utilizados.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>É possível agendar para o mesmo dia?</h4>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Para serviços simples como chaves e pequenos reparos, sim. Para instalações maiores, recomendamos agendamento com 2-3 dias de antecedência para garantir disponibilidade e qualidade.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h4>Quais formas de pagamento aceitam?</h4>
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="faq-answer">
                        <p>Aceitamos dinheiro, PIX, cartões de débito e crédito (até 12x), e oferecemos condições especiais para serviços acima de R$ 1.000.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal de Serviço -->
    <div id="servicoModal" class="modal-servico">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modalTitulo"></h3>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="modal-imagem">
                    <img id="modalImagem" src="" alt="">
                </div>
                <div class="modal-info">
                    <div class="modal-categoria" id="modalCategoria"></div>
                    <p id="modalDescricao"></p>
                    
                    <div class="modal-detalhes">
                        <div class="detalhe-item">
                            <i class="fas fa-clock"></i>
                            <span>Tempo: <strong id="modalTempo"></strong></span>
                        </div>
                        <div class="detalhe-item">
                            <i class="fas fa-tag"></i>
                            <span>A partir de: <strong id="modalPreco"></strong></span>
                        </div>
                        <div class="detalhe-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Garantia: <strong id="modalGarantia"></strong></span>
                        </div>
                    </div>
                    
                    <div class="modal-beneficios">
                        <h4>Benefícios Inclusos:</h4>
                        <ul id="modalBeneficios"></ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-agendar" onclick="agendarServico()">
                    <i class="fas fa-calendar-plus"></i>
                    Agendar Serviço
                </button>
                <button class="btn-whatsapp-modal" onclick="consultarWhatsApp()">
                    <i class="fab fa-whatsapp"></i>
                    Consultar no WhatsApp
                </button>
            </div>
        </div>
    </div>



    <!-- Rodapé -->
    <?php require_once("templates/footer.php")?>
    
    <script src="<?= URL_BASE ?>assets/js/script.js"></script>
    <script src="<?= URL_BASE ?>assets/js/animacoes.js"></script>
    
    <script>
    // Inicializar FAQ quando a página carregar
    document.addEventListener('DOMContentLoaded', function() {
        setupFAQ();
    });
    
    // Função para FAQ
    function setupFAQ() {
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question?.addEventListener('click', () => {
                faqItems.forEach(otherItem => {
                    if (otherItem !== item) {
                        otherItem.classList.remove('active');
                    }
                });
                item.classList.toggle('active');
            });
        });
    }
    
    // Funções simples para WhatsApp
    function agendarServicoWhatsApp(nomeServico) {
        const numero = '5511989096947';
        const mensagem = encodeURIComponent(`Olá! Gostaria de agendar o serviço: ${nomeServico}`);
        window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
    }
    
    function abrirWhatsApp() {
        const numero = '5511989096947';
        const mensagem = encodeURIComponent('Olá! Gostaria de agendar um serviço automotivo.');
        window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
    }
    
    function agendarPacote(tipoPacote) {
        const numero = '5511989096947';
        const mensagem = encodeURIComponent(`Olá! Tenho interesse no pacote ${tipoPacote}.`);
        window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
    }
    
    function scrollToServicos() {
        document.getElementById('servicos')?.scrollIntoView({ behavior: 'smooth' });
    }
    </script>
</body>
</html>

<?php require_once("templates/head.php") ?>
<body class="produtos-moderno">
    <!-- Cabeçalho -->
    <?php require_once("templates/header.php") ?>
    
    <!-- Banner Hero Moderno -->
    <section class="hero-produtos">
        <div class="hero-overlay"></div>
        <div class="container produtoTitlu">
            <div class="hero-content">
                <h1>Nossos Produtos</h1>
                <p>Descubra produtos de alta qualidade para seu veículo</p>
        
            </div>
        </div>
     
    </section>

    <!-- Barra de informações e busca -->
    <section class="info-busca-secao">
        <div class="container">
            <div class="info-busca-container">
                <div class="info-categoria-atual">
                    <?php if(isset($_GET['categoria']) && !empty($categorias)): ?>
                        <h2 class="categoria-titulo">
                            <i class="fas fa-tag"></i>
                            <?php 
                            foreach($categorias as $cat) {
                                if($cat['id_categoria'] == $_GET['categoria']) {
                                    echo htmlspecialchars($cat['nome_categoria']);
                                    break;
                                }
                            }
                            ?>
                        </h2>
                        <p class="categoria-descricao">Produtos selecionados especialmente para você</p>
                    <?php else: ?>
                        <h2 class="categoria-titulo">
                            <i class="fas fa-th-large"></i>
                            Todos os Produtos
                        </h2>
                        <p class="categoria-descricao">Confira nossa linha completa de produtos</p>
                    <?php endif; ?>
                </div>
                
                <!-- <div class="busca-container">
                    <form method="GET" class="form-busca">
                        <?php if(isset($_GET['categoria'])): ?>
                            <input type="hidden" name="categoria" value="<?= $_GET['categoria'] ?>">
                        <?php endif; ?>
                        <div class="input-busca-grupo">
                            <input type="text" name="busca" placeholder="Buscar produtos..." 
                                   value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>" 
                                   class="input-busca">
                            <button type="submit" class="btn-busca">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div> -->
            </div>
        </div>
    </section>

    <!-- Grid de Produtos -->
    <section class="produtos-showcase">
        <div class="container">
            <div class="produtos-grid" id="produtos-grid">
                
                
                <?php foreach($produtos as $produto): ?>
                <div class="produto-card-moderno" data-categoria="<?= strtolower(str_replace(' ', '-', $produto['nome_categoria'])) ?>">
                    
                    <?php // Campo produto_promocao não existe no banco, removendo condição ?>
                    
                    <div class="produto-imagem-container">
                        <img src="<?= !empty($produto['produto_foto']) ? URL_BASE . 'assets/img/produtos/' . $produto['produto_foto'] : 'https://via.placeholder.com/400x300/f0f0f0/666?text=' . urlencode($produto['produto_nome']) ?>" 
                             alt="<?= htmlspecialchars($produto['produto_nome']) ?>" loading="lazy">
                        <div class="produto-hover-overlay">
                            <button class="btn-acao" onclick="abrirModalProduto(<?= $produto['id_produto'] ?>)">
                                <i class="fas fa-eye"></i>
                                <span>Ver Detalhes</span>
                            </button>
                            <button class="btn-acao favorito">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="produto-info">
                        <div class="produto-categoria"><?= htmlspecialchars($produto['nome_categoria']) ?></div>
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
                        </div>
                        
                        <div class="produto-acoes">
                            <button class="btn-principal" onclick="abrirWhatsApp('<?= htmlspecialchars($produto['produto_nome']) ?>', '<?= htmlspecialchars($produto['nome_categoria']) ?>', '<?= number_format($produto['produto_preco'], 2, ',', '.') ?>')">
                                <i class="fab fa-whatsapp"></i>
                                Fale Conosco
                            </button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>



            </div>

            <!-- Paginação -->
            <?php if($totalPaginas > 1): ?>
            <div class="paginacao-moderna">
                <?php if($paginaAtual > 1): ?>
                    <a href="?pagina=<?= $paginaAtual - 1 ?><?= isset($_GET['categoria']) ? '&categoria=' . $_GET['categoria'] : '' ?><?= isset($_GET['busca']) ? '&busca=' . $_GET['busca'] : '' ?>" class="btn-pag">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <?php else: ?>
                    <button class="btn-pag" disabled><i class="fas fa-chevron-left"></i></button>
                <?php endif; ?>
                
                <?php 
                // Lógica de paginação
                $inicio = max(1, $paginaAtual - 2);
                $fim = min($totalPaginas, $paginaAtual + 2);
                
                // Mostrar primeira página se necessário
                if($inicio > 1): ?>
                    <a href="?pagina=1<?= isset($_GET['categoria']) ? '&categoria=' . $_GET['categoria'] : '' ?><?= isset($_GET['busca']) ? '&busca=' . $_GET['busca'] : '' ?>" class="btn-pag">1</a>
                    <?php if($inicio > 2): ?>
                        <span class="pag-dots">...</span>
                    <?php endif; ?>
                <?php endif; ?>
                
                <?php for($i = $inicio; $i <= $fim; $i++): ?>
                    <?php if($i == $paginaAtual): ?>
                        <button class="btn-pag ativo"><?= $i ?></button>
                    <?php else: ?>
                        <a href="?pagina=<?= $i ?><?= isset($_GET['categoria']) ? '&categoria=' . $_GET['categoria'] : '' ?><?= isset($_GET['busca']) ? '&busca=' . $_GET['busca'] : '' ?>" class="btn-pag"><?= $i ?></a>
                    <?php endif; ?>
                <?php endfor; ?>
                
                <?php 
                // Mostrar última página se necessário
                if($fim < $totalPaginas): ?>
                    <?php if($fim < $totalPaginas - 1): ?>
                        <span class="pag-dots">...</span>
                    <?php endif; ?>
                    <a href="?pagina=<?= $totalPaginas ?><?= isset($_GET['categoria']) ? '&categoria=' . $_GET['categoria'] : '' ?><?= isset($_GET['busca']) ? '&busca=' . $_GET['busca'] : '' ?>" class="btn-pag"><?= $totalPaginas ?></a>
                <?php endif; ?>
                
                <?php if($paginaAtual < $totalPaginas): ?>
                    <a href="?pagina=<?= $paginaAtual + 1 ?><?= isset($_GET['categoria']) ? '&categoria=' . $_GET['categoria'] : '' ?><?= isset($_GET['busca']) ? '&busca=' . $_GET['busca'] : '' ?>" class="btn-pag">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                <?php else: ?>
                    <button class="btn-pag" disabled><i class="fas fa-chevron-right"></i></button>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Seção de Benefícios -->
    <section class="beneficios-secao">
        <div class="container">
            <h2 class="titulo-secao">Por que escolher nossos produtos?</h2>
            <div class="beneficios-grid">
                <div class="beneficio-item">
                    <div class="beneficio-icone">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Garantia Estendida</h3>
                    <p>Todos os produtos com garantia de fábrica + nossa garantia adicional</p>
                </div>
                <div class="beneficio-item">
                    <div class="beneficio-icone">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Instalação Profissional</h3>
                    <p>Equipe especializada e certificada para instalação perfeita</p>
                </div>
                <div class="beneficio-item">
                    <div class="beneficio-icone">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Produtos Originais</h3>
                    <p>Trabalhamos apenas com marcas reconhecidas e produtos originais</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal de Produto -->
    <div class="modal-produto-moderno" id="modal-produto">
        <div class="modal-overlay" onclick="fecharModalProduto()"></div>
        <div class="modal-container">
            <button class="modal-fechar" onclick="fecharModalProduto()">
                <i class="fas fa-times"></i>
            </button>
            <div class="modal-conteudo">
                <div class="modal-imagem">
                    <img id="modal-img" src="" alt="">
                </div>
                <div class="modal-info">
                    <h2 id="modal-titulo">Nome do Produto</h2>
                    <div class="modal-categoria" id="modal-categoria">Categoria</div>
                    <div class="modal-avaliacao">
                        <div class="estrelas">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <span>(47 avaliações)</span>
                    </div>
                    <div class="modal-preco">
                        <span class="preco-atual">R$ 399,90</span>
                    </div>
                    <div class="modal-descricao">
                        <h3>Descrição</h3>
                        <p id="modal-desc">Descrição detalhada do produto...</p>
                    </div>
                    <div class="modal-especificacoes">
                        <h3>Especificações</h3>
                        <ul id="modal-specs">
                            <li><strong>Marca:</strong> Pioneer</li>
                            <li><strong>Potência:</strong> 350W RMS</li>
                            <li><strong>Garantia:</strong> 12 meses</li>
                        </ul>
                    </div>
                    <div class="modal-acoes">
                        <button class="btn-principal-modal" onclick="abrirWhatsAppModal()">
                            <i class="fab fa-whatsapp"></i>
                            Conversar no WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <?php require_once("templates/footer.php") ?>

    <!-- Scripts -->
    <script>
        // Dados dos produtos vindos do banco de dados
        const produtosDados = <?= json_encode($produtosJs) ?>;
        const categorias = <?= json_encode($categorias) ?>;
        const paginacao = {
            atual: <?= $paginaAtual ?>,
            total: <?= $totalPaginas ?>,
            totalProdutos: <?= $totalProdutos ?>
        };

        // Filtros e busca
        let produtosFiltrados = [];
        let paginaAtual = 1;
        const produtosPorPagina = 6;

        document.addEventListener('DOMContentLoaded', function() {
            // Filtros por categoria
            const filtrosBtns = document.querySelectorAll('.filtro-btn');
            filtrosBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove classe ativo de todos
                    filtrosBtns.forEach(b => b.classList.remove('ativo'));
                    // Adiciona ao clicado
                    this.classList.add('ativo');
                    
                    const categoria = this.dataset.categoria;
                    filtrarProdutos(categoria);
                });
            });

            // Busca
            const inputBusca = document.getElementById('busca-produto');
            if (inputBusca) {
                inputBusca.addEventListener('input', function() {
                    const termo = this.value.toLowerCase();
                    buscarProdutos(termo);
                });
            }

            // Animações de entrada
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationDelay = `${Math.random() * 0.5}s`;
                        entry.target.classList.add('animate-in');
                    }
                });
            });

            document.querySelectorAll('.produto-card-moderno').forEach(card => {
                observer.observe(card);
            });
        });

        function filtrarProdutos(categoria) {
            const produtos = document.querySelectorAll('.produto-card-moderno');
            
            produtos.forEach(produto => {
                if (categoria === 'todos' || produto.dataset.categoria === categoria) {
                    produto.style.display = 'block';
                    produto.style.animation = 'fadeIn 0.5s ease forwards';
                } else {
                    produto.style.display = 'none';
                }
            });
        }

        function buscarProdutos(termo) {
            const produtos = document.querySelectorAll('.produto-card-moderno');
            
            produtos.forEach(produto => {
                const titulo = produto.querySelector('.produto-titulo').textContent.toLowerCase();
                const categoria = produto.querySelector('.produto-categoria').textContent.toLowerCase();
                const descricao = produto.querySelector('.produto-descricao').textContent.toLowerCase();
                
                if (titulo.includes(termo) || categoria.includes(termo) || descricao.includes(termo)) {
                    produto.style.display = 'block';
                    produto.style.animation = 'fadeIn 0.5s ease forwards';
                } else {
                    produto.style.display = 'none';
                }
            });
        }

        // Modal de produtos
        function abrirModalProduto(id) {
            const produto = produtosDados.find(p => p.id == id);
            if (produto) {
                // Preencher dados no modal
                document.getElementById('modal-img').src = produto.imagem;
                document.getElementById('modal-titulo').textContent = produto.titulo;
                document.getElementById('modal-categoria').textContent = produto.categoria;
                document.getElementById('modal-desc').textContent = produto.descricao || 'Descrição completa em breve.';
                
                // Preço
                const precoFormatado = `R$ ${produto.preco}`;
                document.querySelector('.modal-preco .preco-atual').textContent = precoFormatado;
                
                // Especificações padrão baseadas na categoria
                const specsList = document.getElementById('modal-specs');
                let especificacoesPadrao = [
                    'Produto original e com garantia',
                    'Instalação profissional inclusa',
                    'Suporte técnico especializado',
                    'Entrega rápida na região'
                ];
                specsList.innerHTML = especificacoesPadrao.map(spec => `<li>${spec}</li>`).join('');
                
                document.getElementById('modal-produto').classList.add('ativo');
                document.body.style.overflow = 'hidden';
            }
        }

        function fecharModalProduto() {
            document.getElementById('modal-produto').classList.remove('ativo');
            document.body.style.overflow = 'auto';
        }

        // Função para abrir WhatsApp direto dos cards
        function abrirWhatsApp(nomeProduto, categoria, preco) {
            const mensagem = `🛒 *Interesse em Produto*

👤 Olá! Tenho interesse no seguinte produto:

📦 *Produto:* ${nomeProduto}
🏷️ *Categoria:* ${categoria}
💰 *Preço:* R$ ${preco}

Gostaria de mais informações sobre disponibilidade, formas de pagamento e instalação.

Aguardo retorno! 😊`;

            const numeroWhatsApp = '5511989096947';
            const mensagemCodificada = encodeURIComponent(mensagem);
            const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemCodificada}`;
            
            window.open(urlWhatsApp, '_blank');
        }

        // Função para WhatsApp do modal
        function abrirWhatsAppModal() {
            const titulo = document.getElementById('modal-titulo').textContent;
            const categoria = document.getElementById('modal-categoria').textContent;
            const preco = document.querySelector('.modal-preco .preco-atual').textContent;

            const mensagem = `🛒 *Interesse em Produto*

👤 Olá! Tenho interesse no seguinte produto:

📦 *Produto:* ${titulo}
🏷️ *Categoria:* ${categoria}
💰 *Preço:* ${preco}

Gostaria de mais informações sobre disponibilidade, formas de pagamento e instalação.

Aguardo retorno! 😊`;

            const numeroWhatsApp = '5511989096947';
            const mensagemCodificada = encodeURIComponent(mensagem);
            const urlWhatsApp = `https://wa.me/${numeroWhatsApp}?text=${mensagemCodificada}`;
            
            window.open(urlWhatsApp, '_blank');
        }

        // Favoritos
        document.querySelectorAll('.btn-acao.favorito').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                const icon = this.querySelector('i');
                
                if (icon.classList.contains('far')) {
                    icon.classList.remove('far');
                    icon.classList.add('fas');
                    this.style.color = '#eb0589';
                } else {
                    icon.classList.remove('fas');
                    icon.classList.add('far'); 
                    this.style.color = '';
                }
            });
        });

        // Scroll suave
        function scrollToSection(sectionId) {
            document.getElementById(sectionId).scrollIntoView({
                behavior: 'smooth'
            });
        }



        // CSS inline para animações
        const style = document.createElement('style');
        style.textContent = `
            /* Seção de informações e busca */
            .info-busca-secao {
                background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
                padding: 40px 0;
                border-bottom: 1px solid #dee2e6;
                margin-top: -20px; /* Para colar no header */
            }

            .info-busca-container {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 40px;
            }

            .info-categoria-atual {
                flex: 1;
            }

            .categoria-titulo {
                display: flex;
                align-items: center;
                gap: 15px;
                margin: 0 0 8px 0;
                font-size: 28px;
                font-weight: 700;
                color: #2d3748;
            }

            .categoria-titulo i {
                color: #eb0589;
                font-size: 24px;
            }

            .categoria-descricao {
                margin: 0;
                color: #6c757d;
                font-size: 16px;
                font-weight: 400;
            }

            .busca-container {
                flex: 0 0 400px;
            }

            .form-busca {
                position: relative;
            }

            .input-busca-grupo {
                position: relative;
                display: flex;
                align-items: center;
                background: white;
                border-radius: 50px;
                overflow: hidden;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .input-busca-grupo:focus-within {
                box-shadow: 0 6px 25px rgba(235, 5, 137, 0.2);
                transform: translateY(-2px);
            }

            .input-busca {
                flex: 1;
                padding: 15px 25px;
                border: none;
                outline: none;
                font-size: 16px;
                background: transparent;
                color: #2d3748;
            }

            .input-busca::placeholder {
                color: #a0aec0;
            }

            .btn-busca {
                background: linear-gradient(135deg, #eb0589, #ff6b9d);
                border: none;
                padding: 15px 25px;
                color: white;
                cursor: pointer;
                transition: all 0.3s ease;
                border-radius: 0 50px 50px 0;
            }

            .btn-busca:hover {
                background: linear-gradient(135deg, #d10578, #e55a8c);
                transform: scale(1.05);
            }

            .btn-busca i {
                font-size: 18px;
            }

            /* Responsivo */
            @media (max-width: 768px) {
                .info-busca-container {
                    flex-direction: column;
                    gap: 25px;
                    text-align: center;
                }

                .categoria-titulo {
                    justify-content: center;
                    font-size: 24px;
                }

                .busca-container {
                    flex: none;
                    width: 100%;
                }

                .input-busca-grupo {
                    border-radius: 25px;
                }

                .btn-busca {
                    border-radius: 0 25px 25px 0;
                    padding: 15px 20px;
                                 }
             }

            /* Ajuste para botão único */
            .produto-acoes .btn-principal {
                flex: 1;
                justify-content: center;
            }

            .modal-acoes .btn-principal-modal {
                width: 100%;
                justify-content: center;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .produto-card-moderno {
                opacity: 0;
                transform: translateY(20px);
                transition: all 0.3s ease;
            }
            
            .produto-card-moderno.animate-in {
                animation: fadeIn 0.6s ease forwards;
            }

            /* Modal de Orçamento */
            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                backdrop-filter: blur(5px);
                z-index: 1000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                visibility: hidden;
                transition: all 0.3s ease;
            }

            .modal-overlay.ativo {
                opacity: 1;
                visibility: visible;
            }


        `;
        document.head.appendChild(style);

        // Verificar se há hash na URL para categoria (fallback)
        function verificarHashCategoria() {
            const hash = window.location.hash;
            if (hash && hash.startsWith('#categoria-')) {
                const categoriaId = hash.replace('#categoria-', '');
                console.log('Detectado hash de categoria:', categoriaId);
                
                // Redirecionar para a URL correta com parâmetro GET
                const baseUrl = window.URL_BASE || (window.location.origin + '/Evolusom/public/');
                const novaUrl = baseUrl + 'produto?categoria=' + categoriaId;
                
                // Limpar o hash e usar a URL com parâmetro
                window.history.replaceState({}, '', novaUrl);
                window.location.reload();
            }
        }

        // Executar verificação quando a página carregar
        document.addEventListener('DOMContentLoaded', verificarHashCategoria);
        
        // Também verificar se a URL mudou (para SPAs)
        window.addEventListener('hashchange', verificarHashCategoria);
    </script>
</body>
</html>


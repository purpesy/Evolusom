/**
 * PRODUTOS MODERNO - EVOLUSOM
 * JavaScript para funcionalidades interativas da página de produtos
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Produtos Moderno carregado');
    
    // Inicializar funcionalidades
    initFiltros();
    initBusca();
    initVisualizacao();
    initModal();
    initPaginacao();
    initAnimacoes();
});

// =============================================================================
// FILTROS DE CATEGORIA
// =============================================================================
function initFiltros() {
    const filtros = document.querySelectorAll('.filtro-btn');
    const produtos = document.querySelectorAll('.produto-card-moderno');
    
    filtros.forEach(filtro => {
        filtro.addEventListener('click', () => {
            // Remove ativo de todos os filtros
            filtros.forEach(f => f.classList.remove('ativo'));
            // Adiciona ativo ao filtro clicado
            filtro.classList.add('ativo');
            
            const categoria = filtro.dataset.categoria;
            
            // Animar saída dos produtos
            produtos.forEach(produto => {
                produto.style.opacity = '0';
                produto.style.transform = 'translateY(20px)';
            });
            
            // Filtrar produtos após animação
            setTimeout(() => {
                produtos.forEach(produto => {
                    const produtoCategoria = produto.dataset.categoria;
                    
                    if (categoria === 'todos' || produtoCategoria === categoria) {
                        produto.style.display = 'block';
                        setTimeout(() => {
                            produto.style.opacity = '1';
                            produto.style.transform = 'translateY(0)';
                        }, 100);
                    } else {
                        produto.style.display = 'none';
                    }
                });
            }, 300);
            
            // Scroll suave para os produtos
            document.querySelector('.produtos-showcase').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
}

// =============================================================================
// BUSCA DE PRODUTOS
// =============================================================================
function initBusca() {
    const campoBusca = document.getElementById('busca-produto');
    const botaoBusca = campoBusca?.nextElementSibling;
    const produtos = document.querySelectorAll('.produto-card-moderno');
    
    if (!campoBusca) return;
    
    // Busca em tempo real
    campoBusca.addEventListener('input', realizarBusca);
    
    // Busca ao clicar no botão
    botaoBusca?.addEventListener('click', realizarBusca);
    
    // Busca ao pressionar Enter
    campoBusca.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            realizarBusca();
        }
    });
    
    function realizarBusca() {
        const termo = campoBusca.value.toLowerCase().trim();
        let produtosEncontrados = 0;
        
        produtos.forEach(produto => {
            const titulo = produto.querySelector('.produto-titulo')?.textContent.toLowerCase() || '';
            const descricao = produto.querySelector('.produto-descricao')?.textContent.toLowerCase() || '';
            const categoria = produto.querySelector('.produto-categoria')?.textContent.toLowerCase() || '';
            
            const encontrado = titulo.includes(termo) || 
                             descricao.includes(termo) || 
                             categoria.includes(termo);
            
            if (termo === '' || encontrado) {
                produto.style.display = 'block';
                produto.style.opacity = '1';
                produto.style.transform = 'translateY(0)';
                produtosEncontrados++;
            } else {
                produto.style.opacity = '0';
                produto.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    produto.style.display = 'none';
                }, 300);
            }
        });
        
        // Exibir mensagem se nenhum produto for encontrado
        mostrarResultadoBusca(produtosEncontrados, termo);
    }
}

function mostrarResultadoBusca(quantidade, termo) {
    const container = document.querySelector('.produtos-grid');
    const mensagemExistente = container.querySelector('.mensagem-busca');
    
    // Remove mensagem anterior
    if (mensagemExistente) {
        mensagemExistente.remove();
    }
    
    // Se não encontrou produtos, mostra mensagem
    if (quantidade === 0 && termo !== '') {
        const mensagem = document.createElement('div');
        mensagem.className = 'mensagem-busca';
        mensagem.innerHTML = `
            <div style="grid-column: 1 / -1; text-align: center; padding: 60px 20px; color: #666;">
                <i class="fas fa-search" style="font-size: 3rem; margin-bottom: 20px; opacity: 0.3;"></i>
                <h3 style="margin-bottom: 10px;">Nenhum produto encontrado</h3>
                <p>Não encontramos produtos para "${termo}". Tente outros termos de busca.</p>
            </div>
        `;
        container.appendChild(mensagem);
    }
}

// =============================================================================
// ALTERNADOR DE VISUALIZAÇÃO
// =============================================================================
function initVisualizacao() {
    const botoes = document.querySelectorAll('.view-btn');
    const grid = document.querySelector('.produtos-grid');
    
    botoes.forEach(botao => {
        botao.addEventListener('click', () => {
            // Remove ativo de todos os botões
            botoes.forEach(b => b.classList.remove('ativo'));
            // Adiciona ativo ao botão clicado
            botao.classList.add('ativo');
            
            const view = botao.dataset.view;
            
            if (view === 'list') {
                grid.style.gridTemplateColumns = '1fr';
                grid.style.gap = '20px';
                
                // Ajustar layout dos cards para visualização em lista
                const cards = document.querySelectorAll('.produto-card-moderno');
                cards.forEach(card => {
                    card.style.display = 'grid';
                    card.style.gridTemplateColumns = '250px 1fr';
                    card.style.maxWidth = 'none';
                });
            } else {
                grid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(350px, 1fr))';
                grid.style.gap = '30px';
                
                // Resetar layout dos cards para visualização em grid
                const cards = document.querySelectorAll('.produto-card-moderno');
                cards.forEach(card => {
                    card.style.display = 'block';
                    card.style.gridTemplateColumns = 'none';
                    card.style.maxWidth = '';
                });
            }
        });
    });
}

// =============================================================================
// MODAL DE PRODUTO
// =============================================================================
function initModal() {
    const modal = document.getElementById('modal-produto');
    const overlay = document.querySelector('.modal-overlay');
    const fecharBtn = document.querySelector('.modal-fechar');
    
    // Fechar modal
    if (overlay) overlay.addEventListener('click', fecharModalProduto);
    if (fecharBtn) fecharBtn.addEventListener('click', fecharModalProduto);
    
    // Fechar com ESC
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal?.classList.contains('ativo')) {
            fecharModalProduto();
        }
    });
}

function abrirModalProduto(id) {
    const modal = document.getElementById('modal-produto');
    if (!modal) return;
    
    // Dados dos produtos (em uma aplicação real, viriam do banco de dados)
    const dadosProdutos = {
        1: {
            titulo: 'Alto-Falante Pioneer TS-A1670F 6.5"',
            categoria: 'Som Automotivo',
            preco: 'R$ 339,90',
            descricao: 'Alto-falante de alta qualidade com potência de 350W RMS, design moderno e som cristalino. Ideal para quem busca qualidade sonora superior.',
            imagem: 'https://images.unsplash.com/photo-1558618047-3c8c76ca7d13?w=500&h=400&fit=crop',
            specs: [
                { label: 'Marca', value: 'Pioneer' },
                { label: 'Potência RMS', value: '350W' },
                { label: 'Potência Máxima', value: '700W' },
                { label: 'Tamanho', value: '6.5 polegadas' },
                { label: 'Garantia', value: '12 meses' }
            ]
        },
        2: {
            titulo: 'Película 3M Crystalline Premium',
            categoria: 'Películas',
            preco: 'R$ 249,90/m²',
            descricao: 'Película premium com tecnologia 3M, oferece proteção UV 99%, redução térmica superior e durabilidade excepcional.',
            imagem: 'https://images.unsplash.com/photo-1549317661-bd32c8ce0db2?w=500&h=400&fit=crop',
            specs: [
                { label: 'Marca', value: '3M' },
                { label: 'Proteção UV', value: '99%' },
                { label: 'Redução Térmica', value: '85%' },
                { label: 'Espessura', value: '4 mil' },
                { label: 'Garantia', value: '10 anos' }
            ]
        },
        3: {
            titulo: 'Alarme Positron Exact 360',
            categoria: 'Alarmes',
            preco: 'R$ 189,90',
            descricao: 'Sistema de alarme completo com sensor de presença, controle remoto e tecnologia anti-furto avançada.',
            imagem: 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=500&h=400&fit=crop',
            specs: [
                { label: 'Marca', value: 'Positron' },
                { label: 'Alcance', value: '300 metros' },
                { label: 'Sensor', value: 'Presença + Impacto' },
                { label: 'Controles', value: '2 controles' },
                { label: 'Garantia', value: '24 meses' }
            ]
        },
        4: {
            titulo: 'Kit Vidro Elétrico Universal 4P',
            categoria: 'Vidros Elétricos',
            preco: 'R$ 429,90',
            descricao: 'Kit completo para transformar vidros manuais em elétricos, com sistema anti-esmagamento e compatibilidade universal.',
            imagem: 'https://images.unsplash.com/photo-1603729362753-de3088ce8f97?w=500&h=400&fit=crop',
            specs: [
                { label: 'Tipo', value: 'Universal 4 Portas' },
                { label: 'Voltagem', value: '12V' },
                { label: 'Anti-esmagamento', value: 'Sim' },
                { label: 'Instalação', value: 'Plug & Play' },
                { label: 'Garantia', value: '18 meses' }
            ]
        },
        5: {
            titulo: 'Central Multimídia Android 10"',
            categoria: 'Multimídia',
            preco: 'R$ 1.299,90',
            descricao: 'Central multimídia com tela de 10 polegadas, Android, GPS, Bluetooth, WiFi e espelhamento de tela.',
            imagem: 'https://images.unsplash.com/photo-1485827404703-89b55fcc595e?w=500&h=400&fit=crop',
            specs: [
                { label: 'Tela', value: '10 polegadas HD' },
                { label: 'Sistema', value: 'Android 11' },
                { label: 'Conectividade', value: 'WiFi + Bluetooth' },
                { label: 'GPS', value: 'Integrado' },
                { label: 'Garantia', value: '12 meses' }
            ]
        },
        6: {
            titulo: 'Câmera de Ré HD Visão Noturna',
            categoria: 'Câmeras',
            preco: 'R$ 179,90',
            descricao: 'Câmera de ré com resolução HD, visão noturna infravermelha e resistência à água IP67.',
            imagem: 'https://images.unsplash.com/photo-1610833921852-55d28dfd7126?w=500&h=400&fit=crop',
            specs: [
                { label: 'Resolução', value: 'HD 1280x720' },
                { label: 'Visão Noturna', value: 'Infravermelha' },
                { label: 'Resistência', value: 'IP67' },
                { label: 'Ângulo', value: '170°' },
                { label: 'Garantia', value: '12 meses' }
            ]
        }
    };
    
    const produto = dadosProdutos[id];
    if (!produto) return;
    
    // Preencher dados no modal
    document.getElementById('modal-titulo').textContent = produto.titulo;
    document.getElementById('modal-categoria').textContent = produto.categoria;
    document.querySelector('.modal-preco .preco-atual').textContent = produto.preco;
    document.getElementById('modal-desc').textContent = produto.descricao;
    document.getElementById('modal-img').src = produto.imagem;
    
    // Preencher especificações
    const specsList = document.getElementById('modal-specs');
    specsList.innerHTML = produto.specs.map(spec => 
        `<li><strong>${spec.label}:</strong> ${spec.value}</li>`
    ).join('');
    
    // Configurar botões de ação
    const whatsappBtn = document.querySelector('.btn-principal-modal');
    const orcamentoBtn = document.querySelector('.btn-secundario-modal');
    
    const mensagemWhatsapp = `Olá! Tenho interesse no produto: ${produto.titulo}. Gostaria de mais informações.`;
    whatsappBtn.onclick = () => {
        window.open(`https://wa.me/5511999999999?text=${encodeURIComponent(mensagemWhatsapp)}`, '_blank');
    };
    
    orcamentoBtn.onclick = () => {
        // Aqui poderia abrir um formulário de orçamento ou redirecionar
        alert('Em breve você será redirecionado para o formulário de orçamento!');
    };
    
    // Mostrar modal
    modal.classList.add('ativo');
    document.body.style.overflow = 'hidden';
    
    // Animação de entrada
    setTimeout(() => {
        modal.style.opacity = '1';
    }, 10);
}

function fecharModalProduto() {
    const modal = document.getElementById('modal-produto');
    if (!modal) return;
    
    modal.classList.remove('ativo');
    document.body.style.overflow = 'auto';
}

// =============================================================================
// PAGINAÇÃO
// =============================================================================
function initPaginacao() {
    const botoesPag = document.querySelectorAll('.btn-pag');
    
    botoesPag.forEach(botao => {
        botao.addEventListener('click', () => {
            if (botao.disabled) return;
            
            // Remove ativo de todos os botões
            botoesPag.forEach(b => b.classList.remove('ativo'));
            
            // Se não for botão de navegação, marca como ativo
            if (!botao.innerHTML.includes('chevron')) {
                botao.classList.add('ativo');
            }
            
            // Scroll suave para o topo dos produtos
            document.querySelector('.produtos-showcase').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });
    });
}

// =============================================================================
// ANIMAÇÕES E EFEITOS
// =============================================================================
function initAnimacoes() {
    // Animação de entrada dos produtos ao fazer scroll
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    // Observar produtos
    const produtos = document.querySelectorAll('.produto-card-moderno');
    produtos.forEach((produto, index) => {
        // Inicializar estado
        produto.style.opacity = '0';
        produto.style.transform = 'translateY(30px)';
        produto.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        
        observer.observe(produto);
    });
    
    // Animação dos benefícios
    const beneficios = document.querySelectorAll('.beneficio-item');
    beneficios.forEach((beneficio, index) => {
        beneficio.style.opacity = '0';
        beneficio.style.transform = 'translateY(30px)';
        beneficio.style.transition = `opacity 0.6s ease ${index * 0.2}s, transform 0.6s ease ${index * 0.2}s`;
        
        observer.observe(beneficio);
    });
}

// =============================================================================
// FUNCIONALIDADES AUXILIARES
// =============================================================================

// Função global para abrir modal (chamada pelos botões nos cards)
window.abrirModalProduto = abrirModalProduto;

// Smooth scroll para elementos internos
document.addEventListener('click', (e) => {
    if (e.target.matches('a[href^="#"]')) {
        e.preventDefault();
        const target = document.querySelector(e.target.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    }
});

// Loading state para botões
function addLoadingState(button, duration = 2000) {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Carregando...';
    button.disabled = true;
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.disabled = false;
    }, duration);
}

// Aplicar loading nos botões de ação
document.addEventListener('click', (e) => {
    if (e.target.matches('.btn-principal, .btn-secundario')) {
        if (!e.target.onclick) { // Se não tem onclick customizado
            addLoadingState(e.target);
        }
    }
});

// Lazy loading para imagens
if ('IntersectionObserver' in window) {
    const imageObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src || img.src;
                img.classList.remove('lazy');
                imageObserver.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[loading="lazy"]').forEach(img => {
        imageObserver.observe(img);
    });
}

console.log('✨ Produtos Moderno inicializado com sucesso!'); 
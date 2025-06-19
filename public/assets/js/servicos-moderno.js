// === SERVICOS MODERNO JS ===

// Dados dos serviços
const servicosData = [
    {
        id: 1,
        titulo: "Película Automotiva Premium",
        categoria: "estetica",
        preco: 299,
        tempo: "2-3 horas",
        garantia: "3 anos",
        rating: 4.9,
        avaliacoes: 127,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Película+Automotiva",
        descricao: "Proteção solar UV, privacidade e redução térmica com películas de alta qualidade. Bloqueio de 99% dos raios UV nocivos.",
        beneficios: [
            "Bloqueio 99% dos raios UV",
            "Redução térmica até 70%",
            "Proteção da pele e estofados",
            "Maior privacidade no veículo",
            "Redução do ofuscamento"
        ]
    },
    {
        id: 2,
        titulo: "Som Automotivo Completo",
        categoria: "som",
        preco: 899,
        tempo: "4-6 horas",
        garantia: "1 ano",
        rating: 4.8,
        avaliacoes: 89,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Som+Automotivo",
        descricao: "Sistema de som completo com alto-falantes, módulo amplificador e subwoofer para uma experiência sonora única.",
        beneficios: [
            "Som cristalino e potente",
            "Subwoofer de alta performance",
            "Equalização personalizada",
            "Instalação profissional",
            "Produtos de marcas renomadas"
        ]
    },
    {
        id: 3,
        titulo: "Alarme com Sensor de Presença",
        categoria: "seguranca",
        preco: 399,
        tempo: "2 horas",
        garantia: "2 anos",
        rating: 4.7,
        avaliacoes: 156,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Alarme+Automotivo",
        descricao: "Sistema de segurança avançado com sensores de presença, controle remoto e sirene anti-furto de alta potência.",
        beneficios: [
            "Sensor de presença inteligente",
            "Controle remoto de longo alcance",
            "Sirene de alta potência",
            "Proteção contra clonagem",
            "Sistema anti-furto avançado"
        ]
    },
    {
        id: 4,
        titulo: "Vidros Elétricos Universais",
        categoria: "conforto",
        preco: 549,
        tempo: "3-4 horas",
        garantia: "1 ano",
        rating: 4.6,
        avaliacoes: 73,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Vidros+Elétricos",
        descricao: "Conversão para vidros elétricos com sistema anti-esmagamento e acionamento suave para todas as portas.",
        beneficios: [
            "Sistema anti-esmagamento",
            "Acionamento suave e silencioso",
            "Compatível com maioria dos veículos",
            "Controle individual por porta",
            "Instalação técnica especializada"
        ]
    },
    {
        id: 5,
        titulo: "Central Multimídia Android",
        categoria: "som",
        preco: 1299,
        tempo: "3-4 horas",
        garantia: "1 ano",
        rating: 4.9,
        avaliacoes: 94,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Central+Multimídia",
        descricao: "Central multimídia com Android, GPS, Bluetooth, Wi-Fi e compatibilidade com Apple CarPlay e Android Auto.",
        beneficios: [
            "Sistema Android atualizado",
            "GPS com mapas offline",
            "Bluetooth e Wi-Fi integrados",
            "Apple CarPlay e Android Auto",
            "Tela HD de alta resolução"
        ]
    },
    {
        id: 6,
        titulo: "Câmera de Ré HD",
        categoria: "seguranca",
        preco: 249,
        tempo: "1-2 horas",
        garantia: "1 ano",
        rating: 4.5,
        avaliacoes: 112,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Câmera+de+Ré",
        descricao: "Câmera de ré em alta definição com visão noturna, linha guia dinâmica e tela para visualização.",
        beneficios: [
            "Imagem HD de alta qualidade",
            "Visão noturna avançada",
            "Linhas guia dinâmicas",
            "Ativação automática com ré",
            "À prova d'água e poeira"
        ]
    },
    {
        id: 7,
        titulo: "Travas Elétricas Centralizadas",
        categoria: "conforto",
        preco: 329,
        tempo: "2 horas",
        garantia: "1 ano",
        rating: 4.4,
        avaliacoes: 68,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Travas+Elétricas",
        descricao: "Sistema de travamento centralizado para todas as portas com controle remoto e acionamento automático.",
        beneficios: [
            "Travamento de todas as portas",
            "Controle remoto incluído",
            "Acionamento automático",
            "Sistema anti-furto integrado",
            "Instalação técnica profissional"
        ]
    },
    {
        id: 8,
        titulo: "Iluminação LED Completa",
        categoria: "estetica",
        preco: 459,
        tempo: "3 horas",
        garantia: "2 anos",
        rating: 4.7,
        avaliacoes: 85,
        imagem: "https://via.placeholder.com/400x250/f0f0f0/666?text=Iluminação+LED",
        descricao: "Kit completo de iluminação LED para faróis, lanternas, placa e luz interna com maior eficiência energética.",
        beneficios: [
            "Tecnologia LED de ponta",
            "Maior economia de energia",
            "Iluminação mais potente",
            "Maior durabilidade",
            "Design moderno e elegante"
        ]
    }
];

// Variáveis globais
let servicosExibidos = 6;
let servicosFiltrados = servicosData;
let modal = null;

// Inicialização
document.addEventListener('DOMContentLoaded', function() {
    inicializarPagina();
    configurarEventListeners();
    renderizarServicos();
    configurarModal();
    configurarFAQ();
    configurarAnimacoes();
});

// Função principal de inicialização
function inicializarPagina() {
    console.log('Inicializando página de serviços...');
    
    // Adicionar classes para animações
    const elementos = document.querySelectorAll('.servico-card, .pacote-card, .beneficio-item');
    elementos.forEach((el, index) => {
        el.style.animationDelay = `${index * 0.1}s`;
    });
}

// Configurar event listeners
function configurarEventListeners() {
    // Filtros
    const filtroCategoria = document.getElementById('filtroCategoria');
    const filtroPreco = document.getElementById('filtroPreco');
    const buscarServico = document.getElementById('buscarServico');
    const loadMoreBtn = document.getElementById('loadMore');

    if (filtroCategoria) {
        filtroCategoria.addEventListener('change', aplicarFiltros);
    }
    
    if (filtroPreco) {
        filtroPreco.addEventListener('change', aplicarFiltros);
    }
    
    if (buscarServico) {
        buscarServico.addEventListener('input', debounce(aplicarFiltros, 300));
    }
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', carregarMaisServicos);
    }

    // Scroll suave para seção de serviços
    window.scrollToServicos = function() {
        document.getElementById('servicos').scrollIntoView({ 
            behavior: 'smooth' 
        });
    };
}

// Função debounce para busca
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Aplicar filtros
function aplicarFiltros() {
    const categoria = document.getElementById('filtroCategoria').value;
    const preco = document.getElementById('filtroPreco').value;
    const busca = document.getElementById('buscarServico').value.toLowerCase();

    servicosFiltrados = servicosData.filter(servico => {
        // Filtro por categoria
        if (categoria && servico.categoria !== categoria) {
            return false;
        }

        // Filtro por preço
        if (preco) {
            const [min, max] = preco.split('-').map(p => p === '1000+' ? Infinity : parseInt(p));
            if (max && (servico.preco < min || servico.preco > max)) {
                return false;
            }
            if (preco === '1000+' && servico.preco < 1000) {
                return false;
            }
        }

        // Filtro por busca
        if (busca) {
            const titulo = servico.titulo.toLowerCase();
            const descricao = servico.descricao.toLowerCase();
            const categoriaTexto = getCategoriaTexto(servico.categoria).toLowerCase();
            
            if (!titulo.includes(busca) && !descricao.includes(busca) && !categoriaTexto.includes(busca)) {
                return false;
            }
        }

        return true;
    });

    servicosExibidos = 6;
    renderizarServicos();
}

// Obter texto da categoria
function getCategoriaTexto(categoria) {
    const categorias = {
        'som': 'Som & Multimídia',
        'seguranca': 'Segurança & Alarmes',
        'conforto': 'Conforto & Praticidade',
        'estetica': 'Estética & Proteção'
    };
    return categorias[categoria] || categoria;
}

// Renderizar serviços
function renderizarServicos() {
    const container = document.getElementById('servicosContainer');
    const loadMoreBtn = document.getElementById('loadMore');
    
    if (!container) return;

    // Limpar container
    container.innerHTML = '';

    if (servicosFiltrados.length === 0) {
        container.innerHTML = `
            <div class="no-results">
                <i class="fas fa-search"></i>
                <h3>Nenhum serviço encontrado</h3>
                <p>Tente ajustar seus filtros ou termo de busca</p>
            </div>
        `;
        loadMoreBtn.style.display = 'none';
        return;
    }

    // Renderizar serviços
    const servicosParaExibir = servicosFiltrados.slice(0, servicosExibidos);
    
    servicosParaExibir.forEach((servico, index) => {
        const servicoHTML = criarCardServico(servico);
        container.appendChild(servicoHTML);
        
        // Adicionar animação com delay
        setTimeout(() => {
            servicoHTML.classList.add('visible');
        }, index * 100);
    });

    // Controlar botão "Carregar Mais"
    if (servicosExibidos >= servicosFiltrados.length) {
        loadMoreBtn.style.display = 'none';
    } else {
        loadMoreBtn.style.display = 'inline-flex';
    }
}

// Criar card de serviço
function criarCardServico(servico) {
    const card = document.createElement('div');
    card.className = 'servico-card';
    card.style.opacity = '0';
    card.style.transform = 'translateY(30px)';
    card.style.transition = 'all 0.6s ease';

    const stars = '★'.repeat(Math.floor(servico.rating)) + 
                 (servico.rating % 1 ? '☆' : '') + 
                 '☆'.repeat(5 - Math.ceil(servico.rating));

    card.innerHTML = `
        <div class="servico-imagem">
            <img src="${servico.imagem}" alt="${servico.titulo}" loading="lazy">
            <div class="servico-categoria">${getCategoriaTexto(servico.categoria)}</div>
        </div>
        <div class="servico-info">
            <h3 class="servico-titulo">${servico.titulo}</h3>
            <p class="servico-descricao">${servico.descricao}</p>
            
            <div class="servico-rating">
                <div class="stars">
                    ${stars.split('').map(star => `<span class="star">${star}</span>`).join('')}
                </div>
                <span class="rating-text">${servico.rating} (${servico.avaliacoes} avaliações)</span>
            </div>
            
            <div class="servico-detalhes">
                <div class="servico-preco">R$ ${servico.preco}</div>
                <div class="servico-tempo">
                    <i class="fas fa-clock"></i>
                    ${servico.tempo}
                </div>
            </div>
            
            <div class="servico-actions">
                <button class="btn-detalhes" onclick="abrirModal(${servico.id})">
                    <i class="fas fa-info-circle"></i>
                    Detalhes
                </button>
                <button class="btn-agendar-servico" onclick="agendarServico(${servico.id})">
                    <i class="fas fa-calendar-plus"></i>
                    Agendar
                </button>
            </div>
        </div>
    `;

    // Adicionar classe para animação
    card.classList.add('visible');
    
    return card;
}

// Carregar mais serviços
function carregarMaisServicos() {
    servicosExibidos += 6;
    renderizarServicos();
}

// Configurar modal
function configurarModal() {
    modal = document.getElementById('servicoModal');
    const closeBtn = document.querySelector('.modal-close');
    
    if (closeBtn) {
        closeBtn.addEventListener('click', fecharModal);
    }
    
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                fecharModal();
            }
        });
    }
    
    // Fechar modal com ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            fecharModal();
        }
    });
}

// Abrir modal com detalhes do serviço
function abrirModal(servicoId) {
    const servico = servicosData.find(s => s.id === servicoId);
    if (!servico) return;

    const modal = document.getElementById('servicoModal');
    
    // Preencher dados do modal
    document.getElementById('modalTitulo').textContent = servico.titulo;
    document.getElementById('modalCategoria').textContent = getCategoriaTexto(servico.categoria);
    document.getElementById('modalImagem').src = servico.imagem;
    document.getElementById('modalImagem').alt = servico.titulo;
    document.getElementById('modalDescricao').textContent = servico.descricao;
    document.getElementById('modalTempo').textContent = servico.tempo;
    document.getElementById('modalPreco').textContent = `R$ ${servico.preco}`;
    document.getElementById('modalGarantia').textContent = servico.garantia;
    
    // Preencher benefícios
    const beneficiosList = document.getElementById('modalBeneficios');
    beneficiosList.innerHTML = servico.beneficios
        .map(beneficio => `<li><i class="fas fa-check"></i> ${beneficio}</li>`)
        .join('');
    
    // Mostrar modal
    modal.style.display = 'block';
    document.body.style.overflow = 'hidden';
}

// Fechar modal
function fecharModal() {
    const modal = document.getElementById('servicoModal');
    modal.style.display = 'none';
    document.body.style.overflow = 'auto';
}

// Configurar FAQ
function configurarFAQ() {
    const faqItems = document.querySelectorAll('.faq-item');
    
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        
        question.addEventListener('click', () => {
            // Fechar outros itens
            faqItems.forEach(otherItem => {
                if (otherItem !== item) {
                    otherItem.classList.remove('active');
                }
            });
            
            // Toggle item atual
            item.classList.toggle('active');
        });
    });
}

// Configurar animações de entrada
function configurarAnimacoes() {
    // Intersection Observer para animações
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observar elementos para animação
    const elements = document.querySelectorAll('.pacote-card, .beneficio-item, .faq-item');
    elements.forEach(el => observer.observe(el));
}

// Funções de ação
function abrirWhatsApp() {
    const numero = '5511999999999'; // Substitua pelo número real
    const mensagem = encodeURIComponent('Olá! Gostaria de agendar um serviço automotivo. Podem me ajudar?');
    window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
}

function ligar() {
    window.open('tel:+5511999999999', '_self'); // Substitua pelo número real
}

function agendarServico(servicoId = null) {
    let mensagem = 'Olá! Gostaria de agendar um serviço automotivo.';
    
    if (servicoId) {
        const servico = servicosData.find(s => s.id === servicoId);
        if (servico) {
            mensagem = `Olá! Gostaria de agendar o serviço: ${servico.titulo}. Podem me passar mais informações?`;
        }
    }
    
    const numero = '5511999999999'; // Substitua pelo número real
    const mensagemEncoded = encodeURIComponent(mensagem);
    window.open(`https://wa.me/${numero}?text=${mensagemEncoded}`, '_blank');
}

function consultarWhatsApp() {
    const modalTitulo = document.getElementById('modalTitulo').textContent;
    const mensagem = encodeURIComponent(`Olá! Gostaria de mais informações sobre: ${modalTitulo}`);
    const numero = '5511999999999'; // Substitua pelo número real
    window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
}

function agendarPacote(tipoPacote) {
    const pacotes = {
        'essencial': 'Pacote Essencial (R$ 799)',
        'premium': 'Pacote Premium (R$ 1.899)',
        'vip': 'Pacote VIP (R$ 3.499)'
    };
    
    const nomePacote = pacotes[tipoPacote] || 'Pacote Promocional';
    const mensagem = encodeURIComponent(`Olá! Tenho interesse no ${nomePacote}. Podem me passar mais detalhes?`);
    const numero = '5511999999999'; // Substitua pelo número real
    window.open(`https://wa.me/${numero}?text=${mensagem}`, '_blank');
}

// Scroll suave para seção de serviços
function scrollToServicos() {
    document.getElementById('servicos').scrollIntoView({ 
        behavior: 'smooth' 
    });
}

// Adicionar estilo para animações
const style = document.createElement('style');
style.textContent = `
    .servico-card.visible {
        opacity: 1 !important;
        transform: translateY(0) !important;
    }
    
    .animate-in {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
`;
document.head.appendChild(style); 
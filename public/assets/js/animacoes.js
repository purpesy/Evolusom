/**
 * EVOLUSOM - Sistema de Animações e Interações
 * Integração de bibliotecas e animações customizadas
 * Criado para melhorar a experiência do usuário
 */

class EvolusomAnimations {
    constructor() {
        this.isInitialized = false;
        this.init();
    }

    // Inicialização principal
    init() {
        if (this.isInitialized) return;
        
        // Aguarda o DOM estar pronto
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => this.setup());
        } else {
            this.setup();
        }
    }

    // Configuração das animações
    setup() {
        this.initAOS();
        this.initSmoothScrolling();
        this.initHoverEffects();
        this.initCounterAnimations();
        this.initFormAnimations();
        this.initParticles();
        this.initCustomAnimations();
        this.isInitialized = true;
        
        console.log('🚀 Evolusom Animations carregadas com sucesso!');
    }

    // 1. Animações AOS (Animate On Scroll)
    initAOS() {
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100,
                delay: 0
            });
        }
        
        // Adiciona classes AOS aos elementos principais
        this.addAOSToElements();
    }

    addAOSToElements() {
        // Cards de serviços
        const serviceCards = document.querySelectorAll('.servico, .card-servico');
        serviceCards.forEach((card, index) => {
            card.setAttribute('data-aos', 'fade-up');
            card.setAttribute('data-aos-delay', (index * 100).toString());
        });

        // Depoimentos
        const testimonials = document.querySelectorAll('.depoimento');
        testimonials.forEach((testimonial, index) => {
            testimonial.setAttribute('data-aos', 'fade-left');
            testimonial.setAttribute('data-aos-delay', (index * 150).toString());
        });

        // Títulos de seção
        const sectionTitles = document.querySelectorAll('.titulo-secao');
        sectionTitles.forEach(title => {
            title.setAttribute('data-aos', 'fade-down');
        });

        // Produtos
        const products = document.querySelectorAll('.produto-card');
        products.forEach((product, index) => {
            product.setAttribute('data-aos', 'zoom-in');
            product.setAttribute('data-aos-delay', (index * 50).toString());
        });
    }

    // 2. Smooth Scrolling
    initSmoothScrolling() {
        // Scroll suave para âncoras
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', (e) => {
                e.preventDefault();
                const target = document.querySelector(anchor.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Botão voltar ao topo
        this.createBackToTopButton();
    }

    createBackToTopButton() {
        const backToTop = document.createElement('button');
        backToTop.innerHTML = '<i class="fas fa-arrow-up"></i>';
        backToTop.className = 'back-to-top';
        backToTop.style.cssText = `
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: #eb0589;
            color: white;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: 0 4px 12px rgba(235, 5, 137, 0.3);
        `;

        document.body.appendChild(backToTop);

        // Mostrar/esconder com base no scroll
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.style.opacity = '1';
                backToTop.style.visibility = 'visible';
            } else {
                backToTop.style.opacity = '0';
                backToTop.style.visibility = 'hidden';
            }
        });

        // Ação do clique
        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    }

    // 3. Efeitos de Hover
    initHoverEffects() {
        // Efeito hover nos cards
        const cards = document.querySelectorAll('.servico, .card-servico, .produto-card');
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                card.style.transform = 'translateY(-10px)';
                card.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.1)';
            });

            card.addEventListener('mouseleave', () => {
                card.style.transform = 'translateY(0)';
                card.style.boxShadow = '0 5px 15px rgba(0, 0, 0, 0.05)';
            });
        });

        // Efeito hover nos botões
        const buttons = document.querySelectorAll('.botao-agendar, .botao-saiba-mais');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', () => {
                button.style.transform = 'scale(1.05)';
            });

            button.addEventListener('mouseleave', () => {
                button.style.transform = 'scale(1)';
            });
        });
    }

    // 4. Animações de Contador
    initCounterAnimations() {
        const counters = document.querySelectorAll('.counter');
        
        const animateCounter = (counter) => {
            const target = parseInt(counter.getAttribute('data-target') || counter.textContent);
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                counter.textContent = Math.floor(current);
                
                if (current >= target) {
                    counter.textContent = target;
                    clearInterval(timer);
                }
            }, 16);
        };

        // Observer para iniciar animação quando visível
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        });

        counters.forEach(counter => observer.observe(counter));
    }

    // 5. Animações de Formulário
    initFormAnimations() {
        const formInputs = document.querySelectorAll('input, textarea, select');
        
        formInputs.forEach(input => {
            // Animação de foco
            input.addEventListener('focus', () => {
                input.style.transform = 'scale(1.02)';
                input.style.boxShadow = '0 0 10px rgba(235, 5, 137, 0.2)';
            });

            input.addEventListener('blur', () => {
                input.style.transform = 'scale(1)';
                input.style.boxShadow = 'none';
            });

            // Validação visual
            input.addEventListener('invalid', () => {
                input.style.borderColor = '#e74c3c';
                input.style.animation = 'shake 0.5s ease-in-out';
            });

            input.addEventListener('input', () => {
                if (input.checkValidity()) {
                    input.style.borderColor = '#2ecc71';
                }
            });
        });

        // Adiciona CSS para animação shake
        const style = document.createElement('style');
        style.textContent = `
            @keyframes shake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }
        `;
        document.head.appendChild(style);
    }

    // 6. Sistema de Notificações (SweetAlert2)
    initNotificationSystem() {
        // Configuração global do SweetAlert2
        if (typeof Swal !== 'undefined') {
            window.showSuccess = (message, title = 'Sucesso!') => {
                Swal.fire({
                    icon: 'success',
                    title: title,
                    text: message,
                    confirmButtonColor: '#eb0589',
                    timer: 3000,
                    timerProgressBar: true
                });
            };

            window.showError = (message, title = 'Erro!') => {
                Swal.fire({
                    icon: 'error',
                    title: title,
                    text: message,
                    confirmButtonColor: '#eb0589'
                });
            };

            window.showConfirm = (message, callback, title = 'Confirmar') => {
                Swal.fire({
                    title: title,
                    text: message,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#eb0589',
                    cancelButtonColor: '#95a5a6',
                    confirmButtonText: 'Sim',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed && callback) {
                        callback();
                    }
                });
            };
        }
    }

    // 7. Partículas de Fundo (DESABILITADO - estava impedindo interação)
    initParticles() {
        // Partículas temporariamente desabilitadas para evitar conflitos de interação
        /*
        const banner = document.querySelector('.banner-principal');
        if (banner && typeof tsParticles !== 'undefined') {
            // Cria container para partículas
            const particlesContainer = document.createElement('div');
            particlesContainer.id = 'particles-banner';
            particlesContainer.style.cssText = `
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                z-index: 1;
                pointer-events: none;
            `;
            banner.style.position = 'relative';
            banner.insertBefore(particlesContainer, banner.firstChild);

            // Configuração das partículas
            tsParticles.load("particles-banner", {
                particles: {
                    number: { value: 50 },
                    color: { value: "#eb0589" },
                    shape: { type: "circle" },
                    opacity: { value: 0.3, random: true },
                    size: { value: 3, random: true },
                    links: {
                        enable: true,
                        distance: 150,
                        color: "#eb0589",
                        opacity: 0.2,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 1,
                        direction: "none",
                        random: false,
                        straight: false,
                        out_mode: "out",
                        bounce: false
                    }
                },
                interactivity: {
                    detect_on: "canvas",
                    events: {
                        onhover: { enable: true, mode: "repulse" },
                        onclick: { enable: true, mode: "push" },
                        resize: true
                    }
                },
                retina_detect: true
            });
        }
        */
    }

    // 8. Animações Customizadas
    initCustomAnimations() {
        // Animação de digitação para o título principal
        this.initTypewriterEffect();
        
        // Animação de progresso para skills/serviços
        this.initProgressBars();
        
        // Efeito parallax suave
        this.initParallax();
    }

    initTypewriterEffect() {
        const typewriterElements = document.querySelectorAll('.typewriter');
        
        typewriterElements.forEach(element => {
            const text = element.textContent;
            element.textContent = '';
            element.style.borderRight = '2px solid #eb0589';
            
            let i = 0;
            const timer = setInterval(() => {
                element.textContent += text.charAt(i);
                i++;
                
                if (i >= text.length) {
                    clearInterval(timer);
                    setTimeout(() => {
                        element.style.borderRight = 'none';
                    }, 1000);
                }
            }, 100);
        });
    }

    initProgressBars() {
        const progressBars = document.querySelectorAll('.progress-bar');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const progressBar = entry.target;
                    const percentage = progressBar.getAttribute('data-percentage');
                    
                    progressBar.style.width = '0%';
                    setTimeout(() => {
                        progressBar.style.width = percentage + '%';
                        progressBar.style.transition = 'width 2s ease-in-out';
                    }, 200);
                    
                    observer.unobserve(progressBar);
                }
            });
        });

        progressBars.forEach(bar => observer.observe(bar));
    }

    initParallax() {
        const parallaxElements = document.querySelectorAll('.parallax');
        
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            
            parallaxElements.forEach(element => {
                const rate = scrolled * -0.5;
                element.style.transform = `translateY(${rate}px)`;
            });
        });
    }

    // 9. Utilitários
    static addLoadingState(element, text = 'Carregando...') {
        const originalText = element.textContent;
        element.textContent = text;
        element.disabled = true;
        element.style.opacity = '0.7';
        
        return () => {
            element.textContent = originalText;
            element.disabled = false;
            element.style.opacity = '1';
        };
    }

    static fadeIn(element, duration = 300) {
        element.style.opacity = '0';
        element.style.display = 'block';
        
        let start = performance.now();
        
        function animate(time) {
            let progress = (time - start) / duration;
            if (progress > 1) progress = 1;
            
            element.style.opacity = progress;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        }
        
        requestAnimationFrame(animate);
    }

    static fadeOut(element, duration = 300) {
        let start = performance.now();
        
        function animate(time) {
            let progress = (time - start) / duration;
            if (progress > 1) progress = 1;
            
            element.style.opacity = 1 - progress;
            
            if (progress < 1) {
                requestAnimationFrame(animate);
            } else {
                element.style.display = 'none';
            }
        }
        
        requestAnimationFrame(animate);
    }
}

// Inicialização automática
document.addEventListener('DOMContentLoaded', function() {
    window.evolusomAnimations = new EvolusomAnimations();
});

// Exporta para uso global
window.EvolusomAnimations = EvolusomAnimations;

/* ========================================= */
/* === PÁGINA HOME - CARROSSÉIS === */
/* ========================================= */

/**
 * Inicialização dos Carrosséis da Página Home
 * Serviços e Produtos com Slick Slider
 */
class HomeCarousels {
    constructor() {
        this.init();
    }

    init() {
        // Aguarda jQuery e Slick estarem carregados
        this.waitForLibraries().then(() => {
            this.initServiceCarousel();
            this.initProductCarousel();
            console.log('🎠 Carrosséis da Home iniciados com sucesso!');
        });
    }

    waitForLibraries() {
        return new Promise((resolve) => {
            const checkLibraries = () => {
                if (typeof $ !== 'undefined' && $.fn.slick) {
                    resolve();
                } else {
                    setTimeout(checkLibraries, 100);
                }
            };
            checkLibraries();
        });
    }

    // Carrossel de Serviços
    initServiceCarousel() {
        const $serviceCarousel = $('.servicos-carousel');
        
        if ($serviceCarousel.length) {
            $serviceCarousel.slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 3000,
                pauseOnHover: true,
                pauseOnFocus: true,
                accessibility: true,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Log de sucesso
            console.log('✅ Carrossel de Serviços inicializado');
        }
    }

    // Carrossel de Produtos
    initProductCarousel() {
        const $productCarousel = $('.produtos-carousel');
        
        if ($productCarousel.length) {
            $productCarousel.slick({
                dots: true,
                infinite: true,
                speed: 500,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                pauseOnHover: true,
                pauseOnFocus: true,
                accessibility: true,
                arrows: true,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });

            // Log de sucesso
            console.log('✅ Carrossel de Produtos inicializado');
        }
    }

    // Método para reinicializar carrosséis (útil para carregamento dinâmico)
    reinitialize() {
        $('.servicos-carousel, .produtos-carousel').slick('unslick');
        this.init();
    }

    // Método para destruir carrosséis
    destroy() {
        $('.servicos-carousel, .produtos-carousel').slick('unslick');
        console.log('🗑️ Carrosséis destruídos');
    }
}

// Auto-inicialização quando DOM estiver pronto
document.addEventListener('DOMContentLoaded', function() {
    // Verifica se estamos na página que tem carrosséis
    if (document.querySelector('.servicos-carousel') || document.querySelector('.produtos-carousel')) {
        window.homeCarousels = new HomeCarousels();
    }
});

// Exporta para uso global
window.HomeCarousels = HomeCarousels;

// Sistema de Modal removido - agora está centralizado no script.js
window.EvolusomAnimations = EvolusomAnimations;






function handleProductsClick(event) {
    // Se estiver no mobile (menu aberto), mostrar categorias
    const menuContainer = document.querySelector('.menu-container');
    const isMobile = window.innerWidth <= 992 || menuContainer.classList.contains('active');
    
    if (isMobile) {
        event.preventDefault();
        const dropdown = event.target.closest('.dropdown');
        const isActive = dropdown.classList.contains('active');
        
        // Fechar todos os dropdowns
        document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('active'));
        
        // Se não estava ativo, ativar este
        if (!isActive) {
            dropdown.classList.add('active');
            loadCategorias();
        }
    }
    // No desktop, deixa ir para a página de produtos normalmente
}

// Função para toggle do menu mobile
function toggleMobileMenu() {
    const menuContainer = document.querySelector('.menu-container');
    const hamburguer = document.querySelector('.menu-hamburguer');
    
    menuContainer.classList.toggle('active');
    hamburguer.classList.toggle('active');
}

// Carregar categorias dinamicamente (agora as categorias são carregadas diretamente no PHP)
function loadCategorias() {
    // As categorias já estão carregadas no HTML pelo PHP
    // Esta função agora é apenas um placeholder para compatibilidade
    console.log('Categorias já carregadas via PHP');
}

// Função para navegar para categoria de forma segura
function irParaCategoria(categoriaId) {
    console.log('🔥 Função irParaCategoria chamada com ID:', categoriaId);
    
    // Usar a URL base definida globalmente
    const baseUrl = window.URL_BASE || (window.location.origin + '/Evolusom/public/');
    console.log('📍 Base URL:', baseUrl);
    
    // Navegar usando window.location.href de forma mais segura
    const url = baseUrl + 'produto';
    const urlCompleta = url + '?categoria=' + categoriaId;
    
    console.log('🚀 Navegando para:', urlCompleta);
    
    // Fechar menu mobile se estiver aberto (depois de definir a URL)
    try {
        closeMobileMenuOnCategoryClick();
    } catch (e) {
        console.log('Erro ao fechar menu:', e);
    }
    
    // Navegar diretamente - mais simples
    setTimeout(() => {
        window.location.href = urlCompleta;
    }, 100);
}

// Tornar a função global
window.irParaCategoria = irParaCategoria;

// Função para fechar menu mobile quando clicar numa categoria
function closeMobileMenuOnCategoryClick() {
    const menuContainer = document.querySelector('.menu-container');
    const hamburguer = document.querySelector('.menu-hamburguer');
    
    if (window.innerWidth <= 992 && menuContainer.classList.contains('active')) {
        menuContainer.classList.remove('active');
        hamburguer.classList.remove('active');
    }
}

// Fechar dropdown ao clicar fora
document.addEventListener('click', function(event) {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('active');
        }
    });
});

// Configurar menu hambúrguer e hover
document.addEventListener('DOMContentLoaded', function() {
    const hamburguer = document.querySelector('.menu-hamburguer');
    if (hamburguer) {
        hamburguer.addEventListener('click', toggleMobileMenu);
    }
    
    // Configurar hover para desktop (apenas em telas grandes)
    const dropdown = document.querySelector('.dropdown');
    if (dropdown && window.innerWidth > 992) {
        dropdown.addEventListener('mouseenter', function() {
            loadCategorias();
        });
    }
    
    // Reconfigurar hover quando redimensionar janela
    window.addEventListener('resize', function() {
        const dropdown = document.querySelector('.dropdown');
        if (dropdown) {
            if (window.innerWidth > 992) {
                dropdown.addEventListener('mouseenter', function() {
                    loadCategorias();
                });
            }
        }
    });
});



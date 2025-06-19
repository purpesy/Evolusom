// EVOLUSOM - Script Principal Simplificado

// EVOLUSOM - Modal SUPER SIMPLES que FUNCIONA

function abrirModal() {
    // Remove modal existente se houver
    const modalExistente = document.getElementById('modalLogin');
    if (modalExistente) {
        modalExistente.remove();
    }

    // Cria modal do zero
    const modal = document.createElement('div');
    modal.id = 'modalLogin';
    modal.innerHTML = `
        <div style="
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.8);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: Arial, sans-serif;
        ">
            <div style="
                background: white;
                padding: 40px;
                border-radius: 10px;
                width: 90%;
                max-width: 400px;
                position: relative;
                box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            ">
                <span onclick="fecharModal()" style="
                    position: absolute;
                    top: 10px;
                    right: 15px;
                    font-size: 30px;
                    cursor: pointer;
                    color: #666;
                ">&times;</span>
                
                <h2 style="
                    text-align: center;
                    margin-bottom: 30px;
                    color: #333;
                    font-size: 24px;
                ">LOGIN</h2>
                
                <form method="POST" action="${window.URL_BASE || (window.location.protocol + '//' + window.location.host + '/Evolusom/public/')}login/entrar">
                    <div style="margin-bottom: 20px;">
                        <label style="
                            display: block;
                            margin-bottom: 5px;
                            color: #333;
                            font-weight: bold;
                        ">USUÁRIO OU E-MAIL</label>
                        <input type="text" name="email" required style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #ddd;
                            border-radius: 5px;
                            font-size: 16px;
                            box-sizing: border-box;
                        " placeholder="Digite seu usuário ou e-mail">
                    </div>
                    
                    <div style="margin-bottom: 30px;">
                        <label style="
                            display: block;
                            margin-bottom: 5px;
                            color: #333;
                            font-weight: bold;
                        ">SENHA</label>
                        <input type="password" name="senha" required style="
                            width: 100%;
                            padding: 12px;
                            border: 2px solid #ddd;
                            border-radius: 5px;
                            font-size: 16px;
                            box-sizing: border-box;
                        " placeholder="Digite sua senha">
                    </div>
                    
                    <button type="submit" style="
                        width: 100%;
                        padding: 15px;
                        background: #eb0589;
                        color: white;
                        border: none;
                        border-radius: 5px;
                        font-size: 16px;
                        font-weight: bold;
                        cursor: pointer;
                        text-transform: uppercase;
                    ">ENTRAR</button>
                </form>
            </div>
        </div>
    `;

    document.body.appendChild(modal);
    document.body.style.overflow = 'hidden';
    
    // Focus no primeiro input
    const input = modal.querySelector('input');
    if (input) {
        setTimeout(() => input.focus(), 100);
    }

    console.log('✅ Modal criado e aberto');
}

function fecharModal() {
    const modal = document.getElementById('modalLogin');
    if (modal) {
        modal.remove();
        document.body.style.overflow = 'auto';
        console.log('❌ Modal fechado');
    }
}

// INICIALIZAÇÃO QUANDO DOM CARREGAR
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Script Evolusom carregado');

    // ESC para fechar
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            fecharModal();
        }
    });

    // Clique fora para fechar
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('modalLogin');
        if (modal && e.target === modal.firstElementChild) {
            fecharModal();
        }
    });

    // MENU HAMBÚRGUER
    const menuBtn = document.querySelector('.menu-hamburguer');
    const menuContainer = document.querySelector('.menu-container');

    if (menuBtn && menuContainer) {
        menuBtn.onclick = function() {
            menuBtn.classList.toggle('ativo');
            menuContainer.classList.toggle('ativo');
            
            if (menuContainer.classList.contains('ativo')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        };

        // Fechar menu ao clicar em links
        const links = menuContainer.querySelectorAll('a');
        links.forEach(link => {
            link.onclick = function() {
                menuBtn.classList.remove('ativo');
                menuContainer.classList.remove('ativo');
                document.body.style.overflow = 'auto';
            };
        });
    }
});

console.log('🎯 Script Evolusom inicializado com sucesso!');

// ========== SMOOTH SCROLL ==========
document.addEventListener('DOMContentLoaded', function() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        });
    });
});

// ========== ANIMAÇÃO DE ENTRADA DOS ELEMENTOS ==========
document.addEventListener('DOMContentLoaded', function() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observar elementos que devem animar
    const elementsToAnimate = document.querySelectorAll('.servico-card, .produto-card, .depoimento-card');
    elementsToAnimate.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
});

// ========== UTILITÁRIOS ==========
// Função para formatar telefone
function formatarTelefone(telefone) {
    const numeros = telefone.replace(/\D/g, '');
    
    if (numeros.length === 11) {
        return `(${numeros.substring(0, 2)}) ${numeros.substring(2, 7)}-${numeros.substring(7)}`;
    } else if (numeros.length === 10) {
        return `(${numeros.substring(0, 2)}) ${numeros.substring(2, 6)}-${numeros.substring(6)}`;
    }
    
    return telefone;
}

// Função para validar email
function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

// Função para mostrar notificações
function mostrarNotificacao(mensagem, tipo = 'info') {
    const notificacao = document.createElement('div');
    notificacao.className = `notificacao ${tipo}`;
    notificacao.textContent = mensagem;
    
    document.body.appendChild(notificacao);
    
    setTimeout(() => {
        notificacao.style.opacity = '1';
        notificacao.style.transform = 'translateY(0)';
    }, 100);
    
    setTimeout(() => {
        notificacao.style.opacity = '0';
        notificacao.style.transform = 'translateY(-20px)';
        setTimeout(() => notificacao.remove(), 300);
    }, 3000);
}


document.addEventListener('DOMContentLoaded', function() {
    // Navegação por tabs
    const tabs = document.querySelectorAll('.tab');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active de todas as tabs
            tabs.forEach(t => t.classList.remove('active'));
            // Adiciona active na tab clicada
            tab.classList.add('active');

            // Esconde todos os conteúdos
            contents.forEach(content => content.classList.remove('active'));
            // Mostra o conteúdo correspondente
            const target = tab.getAttribute('data-tab');
            document.querySelector(`.tab-content[data-tab="${target}"]`).classList.add('active');
        });
    });

    // Menu Hamburguer
    const menuBtn = document.querySelector('.menu-hamburguer');
    const menuContainer = document.querySelector('.menu-container');

    if (menuBtn && menuContainer) {
        menuBtn.onclick = function() {
            menuBtn.classList.toggle('ativo');
            menuContainer.classList.toggle('ativo');
            
            if (menuContainer.classList.contains('ativo')) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = 'auto';
            }
        };

        // Fechar menu ao clicar em links
        const links = menuContainer.querySelectorAll('a');
        links.forEach(link => {
            link.onclick = function() {
                menuBtn.classList.remove('ativo');
                menuContainer.classList.remove('ativo');
                document.body.style.overflow = 'auto';
            };
        });
    }
});

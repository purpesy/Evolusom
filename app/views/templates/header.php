<script>
    // Definir URL base globalmente para JavaScript
    window.URL_BASE = '<?= URL_BASE ?>';
</script>

<header class="cabecalho">
    <link rel="stylesheet" href="<?= URL_BASE ?>assets/css/style.css">
    
    <div class="header-top">
        <div class="container">
            <div class="contato-rapido">
                <span><i class="fas fa-phone"></i> Ligue: (11) 98909-6947</span>
                <span><i class="fas fa-map-marker-alt"></i> Rua Desembargador Isnard dos Reis, 1068</span>
            </div>
        </div>
    </div>
    
    <div class="header-main">
        <div class="container">
            <div class="header-content">
                <div class="logo">
                    <a href="<?= URL_BASE ?>home">
                        <span class="logo-text">
                            <span class="logo-evollu">Evollu</span><span class="logo-som">SOM</span>
                        </span>
                    </a>
                </div>
                
                <button class="menu-hamburguer" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                
                <div class="menu-container">
                    <nav class="menu">
                        <ul>
                            <li><a href="<?= URL_BASE ?>home"><i class="fas fa-home"></i> Início</a></li>
                            <li class="dropdown">
                                <a href="<?= URL_BASE ?>produto" class="dropdown-toggle" onclick="handleProductsClick(event)">
                                    <i class="fas fa-shopping-bag"></i> Produtos <i class="fas fa-chevron-down"></i>
                                </a>
                                <div class="dropdown-menu" id="products-dropdown">
                                    <div id="categorias-menu">
                                        <!-- Categorias com links diretos simples -->
                                        <a href="<?= URL_BASE ?>produto/categoria/1" class="dropdown-item" onclick="closeMobileMenuOnCategoryClick()">
                                            <i class="fas fa-tag"></i> Som Automotivo
                                        </a>
                                        <a href="<?= URL_BASE ?>produto/categoria/2" class="dropdown-item" onclick="closeMobileMenuOnCategoryClick()">
                                            <i class="fas fa-tag"></i> Películas
                                        </a>
                                        <a href="<?= URL_BASE ?>produto/categoria/3" class="dropdown-item" onclick="closeMobileMenuOnCategoryClick()">
                                            <i class="fas fa-tag"></i> Alarmes
                                        </a>
                                        <a href="<?= URL_BASE ?>produto/categoria/4" class="dropdown-item" onclick="closeMobileMenuOnCategoryClick()">
                                            <i class="fas fa-tag"></i> Vidros e Travas
                                        </a>
                                        <a href="<?= URL_BASE ?>produto/categoria/5" class="dropdown-item" onclick="closeMobileMenuOnCategoryClick()">
                                            <i class="fas fa-tag"></i> Iluminação
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li><a href="<?= URL_BASE ?>servico"><i class="fas fa-tools"></i> Serviços</a></li>
                            <li><a href="<?= URL_BASE ?>sobre"><i class="fas fa-info-circle"></i> Sobre Nós</a></li>
                            <li><a href="<?= URL_BASE ?>contato"><i class="fas fa-envelope"></i> Contato</a></li>
                        </ul>
                    </nav>
                    
                    <div class="acoes">
                        <?php if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'cliente'): ?>
                            <div class="dropdown-usuario">
                                <button class="botao-login dropdown-toggle-usuario">
                                    <i class="fas fa-user"></i> <?= $_SESSION['tipo_nome'] ?>
                                </button>
                                <div class="dropdown-menu-usuario">
                                    <a href="<?= URL_BASE ?>usuario" class="dropdown-item-usuario">
                                        <i class="fas fa-user-circle"></i> Minha Conta
                                    </a>
                                    <a href="<?= URL_BASE ?>login/logout" class="dropdown-item-usuario" onclick="return confirm('Tem certeza que deseja sair?')">
                                        <i class="fas fa-sign-out-alt"></i> Sair
                                    </a>
                                </div>
                            </div>
                        <?php elseif(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'funcionario'): ?>
                            <div class="dropdown-usuario">
                                <button class="botao-funcionario dropdown-toggle-usuario">
                                    <i class="fas fa-user-tie"></i> <?= $_SESSION['tipo_nome'] ?>
                                </button>
                                <div class="dropdown-menu-usuario">
                                    <a href="<?= URL_BASE ?>dash" class="dropdown-item-usuario">
                                        <i class="fas fa-tachometer-alt"></i> Painel Admin
                                    </a>
                                    <a href="<?= URL_BASE ?>login/logout" class="dropdown-item-usuario" onclick="return confirm('Tem certeza que deseja sair?')">
                                        <i class="fas fa-sign-out-alt"></i> Sair
                                    </a>
                                </div>
                            </div>
                        <?php else: ?>
                            <button onclick="abrirModal()" class="botao-login">
                                <i class="fas fa-user"></i> Login
                            </button>
                        <?php endif; ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Dropdown do usuário */
.dropdown-usuario {
    position: relative;
    display: inline-block;
}

.dropdown-toggle-usuario {
    background: white;
    color: black;
    border: 2px solid #e91e63;
    padding: 12px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
}

.dropdown-toggle-usuario:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(233, 30, 99, 0.3);
    background: #fafafa;
    border-color: #d81b60;
}

.botao-funcionario {
    background: white !important;
    color: black !important;
    border: 2px solid #e91e63 !important;
}

.botao-funcionario:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(233, 30, 99, 0.3);
    background: #fafafa !important;
    border-color: #d81b60 !important;
}

.dropdown-menu-usuario {
    position: absolute;
    top: 100%;
    right: 0;
    background: white;
    min-width: 180px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    border-radius: 8px;
    padding: 8px 0;
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all 0.3s ease;
    z-index: 1000;
    margin-top: 8px;
    border: 1px solid rgba(0,0,0,0.1);
}

.dropdown-usuario:hover .dropdown-menu-usuario {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.dropdown-item-usuario {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 20px;
    color: #333;
    text-decoration: none;
    transition: background 0.2s ease;
    font-size: 14px;
}

.dropdown-item-usuario:hover {
    background: #f8f9fa;
    color: #2c3e50;
    text-decoration: none;
}

.dropdown-item-usuario i {
    width: 16px;
    text-align: center;
}
</style>



<script src="<?= URL_BASE ?>assets/js/script.js"></script>






    
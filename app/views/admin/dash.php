<?php
// Garantir que a sessão esteja iniciada
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>EvoluSom - Painel Administrativo</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/vendors/font-awesome/css/font-awesome.min.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/css/style.css">
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/css/dash.css">
  <!-- EvoluSom Custom Styles -->
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/css/evolusom-custom.css">
  <!-- Dashboard Responsivo -->
  <link rel="stylesheet" href="<?= URL_BASE ?>assets/dash/css/responsive-dashboard.css">

  <!-- End layout styles -->
  <link rel="shortcut icon" href="<?= URL_BASE ?>assets/dash/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <a class="navbar-brand brand-logo" href="<?= URL_BASE ?>dash">
          <span class="logo-text">
            <span class="logo-evollu">Evollu</span><span class="logo-som">SOM</span>
          </span>
        </a>
        <a class="navbar-brand brand-logo-mini" href="<?= URL_BASE ?>dash">
          <span class="logo-text">
            <span class="logo-evollu">E</span><span class="logo-som">S</span>
          </span>
        </a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-stretch">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="mdi mdi-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <div class="nav-profile-img">
     
          
              </div>
              <div class="nav-profile-text">
                <p class="mb-1 text-black">
                  <?php 
                  if(isset($_SESSION['tipo']) && $_SESSION['tipo'] == 'funcionario' && isset($_SESSION['tipo_nome'])) {
                      echo $_SESSION['tipo_nome'];
                  } else {
                      echo 'Administrador EvoluSom';
                  }
                  ?>
                </p>
              </div>
            </a>
            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item" href="<?= URL_BASE ?>home">
                <i class="mdi mdi-home me-2 text-info"></i> Ir para Home </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="<?= URL_BASE ?>login/logout" onclick="return confirm('Tem certeza que deseja sair do sistema?')">
                <i class="mdi mdi-logout me-2 text-primary"></i> Sair do Sistema </a>
            </div>
          </li>
          <li class="nav-item d-none d-lg-block full-screen-link">
            <a class="nav-link">
              <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
            </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
              <i class="mdi mdi-bell-outline"></i>
              <span class="count-symbol bg-danger"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <h6 class="p-3 mb-0">Notificações</h6>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="mdi mdi-calendar"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Agendamento hoje</h6>
                  <p class="text-gray ellipsis mb-0"> Lembrete: você tem agendamentos de serviços hoje </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="mdi mdi-cog"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Configurações</h6>
                  <p class="text-gray ellipsis mb-0"> Atualizar configurações do sistema </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="mdi mdi-link-variant"></i>
                  </div>
                </div>
                <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                  <h6 class="preview-subject font-weight-normal mb-1">Novo Produto</h6>
                  <p class="text-gray ellipsis mb-0"> Produtos adicionados ao estoque! </p>
                </div>
              </a>
              <div class="dropdown-divider"></div>
              <h6 class="p-3 mb-0 text-center">Ver todas as notificações</h6>
            </div>
          </li>

        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
     
          <li class="nav-item">
            <a class="nav-link" href="<?= URL_BASE ?>dash">
              <span class="menu-title">Dashboard</span>
              <i class="mdi mdi-view-dashboard menu-icon"></i>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#clientes" aria-expanded="false" aria-controls="clientes">
              <span class="menu-title">Clientes</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-group menu-icon"></i>
            </a>
            <div class="collapse" id="clientes">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>cliente/listar">Clientes</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#produtos" aria-expanded="false" aria-controls="produtos">
              <span class="menu-title">Produtos</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-package-variant menu-icon"></i>
            </a>
            <div class="collapse" id="produtos">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>produto/listar">Produtos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>categoria/listar">Categorias</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>estoque/listar">Estoque</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#categoria" aria-expanded="false" aria-controls="categoria">
              <span class="menu-title">Categorias</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-tag-multiple menu-icon"></i>
            </a>
            <div class="collapse" id="categoria">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="<?= URL_BASE ?>categoria/listar">Categorias</a>
                  </li>
                </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#vendas" aria-expanded="false" aria-controls="vendas">
              <span class="menu-title">Vendas</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-cart menu-icon"></i>
            </a>
            <div class="collapse" id="vendas">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>venda/listar">Vendas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>venda/nova">Nova Venda</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#pedidos" aria-expanded="false" aria-controls="pedidos">
              <span class="menu-title">Pedidos</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-clipboard-text menu-icon"></i>
            </a>
            <div class="collapse" id="pedidos">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>pedido/listar">Pedidos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>pedido/novo">Novo Pedido</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#servicos" aria-expanded="false" aria-controls="servicos">
              <span class="menu-title">Serviços</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-tools menu-icon"></i>
            </a>
            <div class="collapse" id="servicos">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>servico/listar">Serviços</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>agendamento/listar">Agendamentos</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#fornecedores" aria-expanded="false" aria-controls="fornecedores">
              <span class="menu-title">Fornecedores</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-truck menu-icon"></i>
            </a>
            <div class="collapse" id="fornecedores">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>fornecedor/listar">Fornecedores</a>
                </li>
              </ul>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#usuarios" aria-expanded="false" aria-controls="usuarios">
              <span class="menu-title">Funcionários</span>
              <i class="menu-arrow"></i>
              <i class="mdi mdi-account-key menu-icon"></i>
            </a>
            <div class="collapse" id="usuarios">
              <ul class="nav flex-column sub-menu">
             
                <li class="nav-item">
                  <a class="nav-link" href="<?= URL_BASE ?>funcionario/listar">Funcionários</a>
                </li>
              </ul>
            </div>
          </li>
     
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
            <h3 class="page-title"> Dashboard EvoluSom </h3>
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL_BASE ?>dash">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Painel Principal</li>
              </ol>
            </nav>
          </div>
          <div class="row">

            <?php

            if (isset($conteudo)) {

              $this->carregarViews($conteudo, $dados);
            } else {

              echo '<h2>Bem-vindo ao Dashboard do EvoluSom</h2>';
            }

            ?>

          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024 EvoluSom. Todos os direitos reservados.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Sistema de gestão para equipamentos de som</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="<?= URL_BASE ?>assets/dash/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="<?= URL_BASE ?>assets/dash/js/off-canvas.js"></script>
  <script src="<?= URL_BASE ?>assets/dash/js/misc.js"></script>
  <script src="<?= URL_BASE ?>assets/dash/js/settings.js"></script>
  <script src="<?= URL_BASE ?>assets/dash/js/todolist.js"></script>
  <script src="<?= URL_BASE ?>assets/dash/js/jquery.cookie.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <!-- End custom js for this page -->
  
  <!-- Script de Responsividade EvoluSom -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Melhorar responsividade do sidebar
      const sidebarToggler = document.querySelector('.navbar-toggler-right');
      const sidebar = document.querySelector('.sidebar');
      const mainPanel = document.querySelector('.main-panel');
      
      if (sidebarToggler && sidebar) {
        sidebarToggler.addEventListener('click', function() {
          sidebar.classList.toggle('show');
          
          // Criar backdrop se não existir
          let backdrop = document.querySelector('.sidebar-backdrop');
          if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'sidebar-backdrop';
            document.body.appendChild(backdrop);
          }
          
          backdrop.classList.toggle('show');
          
          // Fechar sidebar ao clicar no backdrop
          backdrop.addEventListener('click', function() {
            sidebar.classList.remove('show');
            backdrop.classList.remove('show');
          });
        });
      }
      
      // Fechar sidebar ao redimensionar para desktop
      window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
          sidebar?.classList.remove('show');
          document.querySelector('.sidebar-backdrop')?.classList.remove('show');
        }
      });
      
      // Melhorar tabelas responsivas
      const tables = document.querySelectorAll('.table');
      tables.forEach(table => {
        if (!table.closest('.table-responsive')) {
          const wrapper = document.createElement('div');
          wrapper.className = 'table-responsive';
          table.parentNode.insertBefore(wrapper, table);
          wrapper.appendChild(table);
        }
      });
      
      // Adicionar tooltips em botões pequenos
      const smallButtons = document.querySelectorAll('.btn-sm');
      smallButtons.forEach(btn => {
        if (!btn.title && btn.querySelector('i')) {
          const icon = btn.querySelector('i');
          if (icon.classList.contains('mdi-check-circle')) {
            btn.title = 'Ativar/Desativar';
          } else if (icon.classList.contains('mdi-pencil')) {
            btn.title = 'Editar';
          } else if (icon.classList.contains('mdi-delete')) {
            btn.title = 'Excluir';
          }
        }
      });
    });
  </script>
  
  <script>
  $(document).ready(function() {
    // Função para controlar navegação ativa
    function setActiveNavigation() {
      var currentUrl = window.location.pathname;
      
      // Remove todas as classes ativas primeiro
      $('.sidebar .nav-item').removeClass('active');
      $('.sidebar .collapse').removeClass('show');
      $('.sidebar .nav-link').removeClass('active');
      
      // Verifica cada link na sidebar
      $('.sidebar .nav-item a.nav-link').each(function() {
        var linkHref = $(this).attr('href');
        
        if (linkHref && currentUrl.includes(linkHref.replace(/^.*\/\/[^\/]+/, ''))) {
          var $navItem = $(this).closest('.nav-item');
          
          // Se é um item de submenu
          if ($(this).closest('.sub-menu').length) {
            $(this).addClass('active');
            $(this).closest('.collapse').addClass('show');
            $(this).closest('.collapse').prev('.nav-link').closest('.nav-item').addClass('active');
          } else {
            // Se é um item principal
            $navItem.addClass('active');
          }
          
          return false; // Para na primeira correspondência
        }
      });
      
      // Se nenhum link específico foi encontrado, ativa o dashboard como padrão
      if (!$('.sidebar .nav-item.active').length && (currentUrl.includes('/admin/dashboard') || currentUrl.endsWith('/admin') || currentUrl === '/')) {
        $('.sidebar .nav-item a[href*="dashboard"]').closest('.nav-item').addClass('active');
      }
    }
    
    // Aplica a navegação ativa no carregamento da página
    setActiveNavigation();
    
    // Controla o comportamento dos menus dropdown
    $('.sidebar .nav-item > .nav-link[data-bs-toggle="collapse"]').on('click', function(e) {
      e.preventDefault();
      
      var $navItem = $(this).closest('.nav-item');
      var $collapse = $($(this).attr('href'));
      
      // Se o menu já está ativo, apenas alterna o submenu
      if ($navItem.hasClass('active')) {
        $collapse.collapse('toggle');
      } else {
        // Remove ativo de outros itens
        $('.sidebar .nav-item').removeClass('active');
        $('.sidebar .collapse').collapse('hide');
        
        // Ativa o item atual
        $navItem.addClass('active');
        $collapse.collapse('show');
      }
    });
  });
  </script>
</body>

</html>
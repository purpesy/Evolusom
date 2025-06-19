# 🔊 Evolusom - E-commerce de Sons e Acessórios Automotivos

<div align="center">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript">
  <img src="https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white" alt="HTML5">
  <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS3">
  <img src="https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
</div>

<div align="center">
  <h3>🎵 Sistema completo de e-commerce especializado em som automotivo</h3>
  <p>Plataforma web moderna para venda de produtos e serviços automotivos com painel administrativo integrado</p>
</div>

---

## 📋 Sobre o Projeto

O **Evolusom** é uma aplicação web completa desenvolvida para uma loja especializada em som e acessórios automotivos. O sistema oferece uma experiência de compra moderna e intuitiva para os clientes, além de um painel administrativo robusto para gerenciamento completo do negócio.

### 🎯 Principais Objetivos
- Criar uma presença digital profissional para a loja
- Facilitar o processo de vendas e atendimento ao cliente
- Gerenciar eficientemente produtos, serviços e pedidos
- Oferecer uma experiência de usuário moderna e responsiva

---

## ✨ Funcionalidades

### 🛍️ Para Clientes
- **Catálogo de Produtos**: Navegação intuitiva com filtros por categoria e busca
- **Carrossel Interativo**: Visualização dinâmica dos produtos em destaque
- **Sistema de Contato**: Integração direta com WhatsApp para atendimento
- **Agendamento de Serviços**: Sistema completo para agendar instalações
- **Galeria de Trabalhos**: Showcase dos serviços realizados
- **Design Responsivo**: Experiência otimizada para todos os dispositivos

### 🔧 Para Administradores
- **Dashboard Completo**: Visão geral do negócio com métricas importantes
- **Gerenciamento de Produtos**: CRUD completo com upload de imagens
- **Controle de Categorias**: Organização eficiente do catálogo
- **Gestão de Serviços**: Cadastro e controle de serviços oferecidos
- **Sistema de Pedidos**: Acompanhamento completo do processo de venda
- **Controle de Estoque**: Monitoramento em tempo real dos produtos
- **Gestão de Clientes**: Cadastro e histórico de clientes
- **Sistema de Usuários**: Controle de acesso com diferentes níveis
- **Relatórios**: Análises detalhadas de vendas e performance

### 🔐 Recursos de Segurança
- Autenticação de usuários com sessões
- Sanitização de dados de entrada
- Prevenção contra SQL Injection
- Controle de acesso baseado em roles
- Validação de formulários client-side e server-side

---

## 🚀 Tecnologias Utilizadas

### Backend
- **PHP 7.4+** - Linguagem principal do servidor
- **MySQL** - Sistema de gerenciamento de banco de dados
- **PDO** - Interface de acesso a banco de dados
- **MVC Pattern** - Arquitetura Model-View-Controller

### Frontend
- **HTML5** - Estrutura semântica das páginas
- **CSS3** - Estilização moderna com Flexbox/Grid
- **JavaScript (ES6+)** - Interatividade e dinamismo
- **Bootstrap** - Framework CSS responsivo
- **Font Awesome** - Ícones profissionais
- **AOS (Animate On Scroll)** - Animações suaves

### Recursos Adicionais
- **PHPMailer** - Sistema de envio de emails
- **WhatsApp API** - Integração para atendimento
- **Upload de Arquivos** - Sistema de upload de imagens
- **Paginação** - Navegação otimizada de produtos
- **SEO Friendly URLs** - URLs amigáveis para busca

---

## 📁 Estrutura do Projeto

```
Evolusom/
├── 📁 app/
│   ├── 📁 controllers/     # Controladores da aplicação
│   │   ├── HomeController.php
│   │   ├── ProdutoController.php
│   │   ├── ClienteController.php
│   │   ├── AgendamentoController.php
│   │   └── ...
│   ├── 📁 models/          # Modelos de dados
│   │   ├── Produto.php
│   │   ├── Cliente.php
│   │   ├── Servico.php
│   │   └── ...
│   └── 📁 views/           # Templates e views
│       ├── Home.php
│       ├── Produtos.php
│       ├── admin/
│       └── templates/
├── 📁 config/              # Configurações do sistema
│   └── config.php
├── 📁 public/              # Arquivos públicos
│   ├── index.php           # Ponto de entrada
│   ├── 📁 assets/          # CSS, JS, imagens
│   ├── 📁 uploads/         # Uploads de usuários
│   └── .htaccess           # Configurações Apache
├── 📁 routes/              # Sistema de rotas
│   ├── Routes.php
│   ├── Controller.php
│   └── Model.php
└── README.md
```

---

## 🛠️ Instalação e Configuração

### Pré-requisitos
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache/Nginx)
- Extensões PHP: PDO, PDO_MySQL, GD, mbstring

### Passos de Instalação

1. **Clone o repositório**
   ```bash
   git clone https://github.com/purpesy/evolusom.git
   cd evolusom
   ```

2. **Configure o banco de dados**
   ```sql
   CREATE DATABASE evolusom_db;
   ```

3. **Configure as variáveis de ambiente**
   ```php
   // config/config.php
   define('DB_HOST', 'localhost');
   define('DB_NAME', 'evolusom_db');
   define('DB_USER', 'seu_usuario');
   define('DB_PASS', 'sua_senha');
   define('URL_BASE', 'http://localhost/evolusom/public/');
   ```

4. **Importe o banco de dados**
   ```bash
   mysql -u seu_usuario -p evolusom_db < database/evolusom.sql
   ```

5. **Configure as permissões**
   ```bash
   chmod 755 public/uploads/
   chmod 755 public/assets/img/
   ```

6. **Acesse o sistema**
   - Frontend: `http://localhost/evolusom/public/`
   - Admin: `http://localhost/evolusom/public/dash`
  Login: email: rafael.souza@loja.com senha: senha123
---

## 🎨 Demonstração

### Interface do Cliente
- **Homepage**: Design moderno com carrossel de produtos e serviços
- **Catálogo**: Filtros avançados e visualização em grid responsivo
- **Detalhes do Produto**: Galeria de imagens e informações completas
- **Contato**: Formulário integrado com WhatsApp

### Painel Administrativo
- **Dashboard**: Métricas em tempo real e gráficos interativos
- **Gestão de Produtos**: Interface drag-and-drop para upload de imagens
- **Controle de Pedidos**: Fluxo completo de processamento
- **Relatórios**: Exportação em PDF/Excel

---

## 🌟 Destaques Técnicos

### Arquitetura MVC
- **Models**: Responsáveis pela lógica de negócio e acesso aos dados
- **Views**: Templates com separação clara entre lógica e apresentação
- **Controllers**: Gerenciam o fluxo da aplicação e requisições

### Performance
- **Lazy Loading**: Carregamento otimizado de imagens
- **Paginação**: Controle eficiente de grandes volumes de dados
- **Cache de Consultas**: Otimização de consultas frequentes
- **Compressão de Assets**: CSS/JS minificados

### Segurança
- **Prepared Statements**: Prevenção contra SQL Injection
- **CSRF Protection**: Tokens de validação em formulários
- **Input Validation**: Sanitização rigorosa de dados
- **Session Management**: Controle seguro de sessões

---

## 📊 Métricas do Projeto

- **Linhas de Código**: ~8.000 linhas
- **Arquivos PHP**: 25+ controladores e modelos
- **Templates**: 15+ views responsivas
- **Tabelas de Banco**: 12 tabelas relacionais
- **Funcionalidades**: 20+ módulos completos

---

## 🚀 Próximas Funcionalidades

- [ ] **Sistema de Avaliações** - Reviews e ratings de produtos
- [ ] **Carrinho de Compras** - E-commerce completo
- [ ] **Gateway de Pagamento** - Integração com Stripe/PayPal
- [ ] **Notificações Push** - Alertas em tempo real

---

## 🤝 Contribuição

Contribuições são sempre bem-vindas! Para contribuir:

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/NovaFuncionalidade`)
5. Abra um Pull Request

---

## 📄 Licença

Este projeto está sob a licença MIT.

---

## 👨‍💻 Autor

**Lucas Gabriel**
- LinkedIn: www.linkedin.com/in/lucas-dev-gabriel
- Email: lucasgabdsantos@gmail.com
- Portfolio: https://agenciatipi03.smpsistema.com.br/aluno/lucas/portfolio/

---

## 📞 Contato

Para dúvidas, sugestões ou oportunidades de trabalho:

- 📧 **Email**: lucasgabdsantos@gmail.com
- 💼 **LinkedIn**: www.linkedin.com/in/lucas-dev-gabriel
- 🐱 **GitHub**: https://github.com/purpesy/
- 🌐 **Portfolio**: https://agenciatipi03.smpsistema.com.br/aluno/lucas/portfolio/

---

<div align="center">
  <h3>⭐ Se este projeto foi útil para você, considere dar uma estrela!</h3>
  <p>Desenvolvido com ❤️ para demonstrar habilidades em desenvolvimento web full-stack</p>
</div>

---

## 🏆 Certificações e Reconhecimentos

Este projeto demonstra competências em:
- ✅ Desenvolvimento Full-Stack PHP
- ✅ Arquitetura MVC
- ✅ Design de Banco de Dados
- ✅ UI/UX Design
- ✅ Segurança Web
- ✅ Performance e Otimização
- ✅ Metodologias Ágeis

**Ideal para portfólio profissional e demonstração de skills técnicas avançadas.**

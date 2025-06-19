# 📋 Documentação das Classes EvoluSom
## Classes CSS Humanizadas em Português Brasileiro

### 🎨 **CORES E ESTILOS BASE**

#### Cores de Texto
- `.evolusom-azul-profundo` - Texto azul profundo (#1a237e)
- `.evolusom-indigo` - Texto índigo (#3f51b5)
- `.evolusom-laranja-vibrante` - Texto laranja vibrante (#ff6f00)
- `.evolusom-verde-sucesso` - Texto verde sucesso (#2e7d32)
- `.evolusom-vermelho-perigo` - Texto vermelho perigo (#c62828)

#### Cores de Fundo
- `.evolusom-fundo-azul-profundo` - Fundo azul profundo
- `.evolusom-fundo-indigo` - Fundo índigo
- `.evolusom-fundo-laranja-vibrante` - Fundo laranja vibrante
- `.evolusom-fundo-verde-sucesso` - Fundo verde sucesso
- `.evolusom-fundo-vermelho-perigo` - Fundo vermelho perigo

---

### 🔘 **BOTÕES MODERNOS E ELEGANTES**

#### Botões Principais
- `.botao-evolusom-principal` - Botão principal com gradiente azul
- `.botao-evolusom-destaque` - Botão de destaque com gradiente laranja
- `.botao-evolusom-sucesso` - Botão de sucesso com gradiente verde
- `.botao-evolusom-contorno` - Botão com contorno e efeito de preenchimento

#### Tamanhos de Botões
- `.botao-evolusom-pequeno` - Botão pequeno (8px 16px)
- `.botao-evolusom-grande` - Botão grande (18px 36px)

**Exemplo de uso:**
```html
<button class="botao-evolusom-principal">
  <i class="mdi mdi-save"></i> Salvar
</button>

<button class="botao-evolusom-destaque botao-evolusom-pequeno">
  Editar
</button>
```

---

### 📝 **FORMULÁRIOS ULTRA MODERNOS**

#### Container Principal
- `.container-formulario-evolusom` - Container principal do formulário
- `.cabecalho-formulario-evolusom` - Cabeçalho com gradiente
- `.titulo-formulario-evolusom` - Título do formulário
- `.subtitulo-formulario-evolusom` - Subtítulo do formulário

#### Campos de Formulário
- `.grupo-campo-evolusom` - Grupo de campo (margin-bottom: 28px)
- `.rotulo-campo-evolusom` - Rótulo do campo
- `.rotulo-campo-evolusom.obrigatorio` - Rótulo com asterisco vermelho
- `.campo-texto-evolusom` - Input de texto
- `.selecao-evolusom` - Select dropdown
- `.area-texto-evolusom` - Textarea

#### Estados de Validação
- `.campo-valido` - Campo válido (borda verde)
- `.campo-invalido` - Campo inválido (borda vermelha)
- `.campo-carregando` - Campo com animação de carregamento

#### Grupos de Entrada
- `.grupo-entrada-evolusom` - Container para input com prefixo
- `.prefixo-entrada-evolusom` - Prefixo (ex: "R$")

**Exemplo de uso:**
```html
<div class="container-formulario-evolusom">
  <div class="cabecalho-formulario-evolusom">
    <h4 class="titulo-formulario-evolusom">Novo Cliente</h4>
    <p class="subtitulo-formulario-evolusom">Cadastrar novo cliente</p>
  </div>
  
  <div class="grupo-campo-evolusom">
    <label class="rotulo-campo-evolusom obrigatorio">Nome</label>
    <input type="text" class="campo-texto-evolusom" required>
    <div class="feedback-validacao-evolusom" id="feedback-nome"></div>
  </div>
</div>
```

---

### 📊 **CARDS DE INFORMAÇÃO MODERNOS**

#### Estrutura do Card
- `.cartao-informacao-evolusom` - Container principal do card
- `.cabecalho-cartao-evolusom` - Cabeçalho do card
- `.icone-cartao-evolusom` - Ícone do cabeçalho
- `.titulo-cartao-evolusom` - Título do card

#### Itens de Informação
- `.item-informacao-evolusom` - Item de informação
- `.rotulo-informacao-evolusom` - Rótulo do item
- `.valor-informacao-evolusom` - Valor do item

**Exemplo de uso:**
```html
<div class="cartao-informacao-evolusom">
  <div class="cabecalho-cartao-evolusom">
    <div class="icone-cartao-evolusom">
      <i class="mdi mdi-account"></i>
    </div>
    <h5 class="titulo-cartao-evolusom">Informações do Cliente</h5>
  </div>
  <div class="item-informacao-evolusom">
    <span class="rotulo-informacao-evolusom">Nome:</span>
    <span class="valor-informacao-evolusom">João Silva</span>
  </div>
</div>
```

---

### 🏷️ **BADGES E ETIQUETAS COLORIDAS**

#### Tipos de Etiquetas
- `.etiqueta-evolusom` - Estilo base da etiqueta
- `.etiqueta-principal-evolusom` - Etiqueta azul
- `.etiqueta-sucesso-evolusom` - Etiqueta verde
- `.etiqueta-alerta-evolusom` - Etiqueta laranja
- `.etiqueta-perigo-evolusom` - Etiqueta vermelha
- `.etiqueta-info-evolusom` - Etiqueta azul claro

**Exemplo de uso:**
```html
<span class="etiqueta-sucesso-evolusom">
  <i class="mdi mdi-check"></i> Ativo
</span>

<span class="etiqueta-perigo-evolusom">
  <i class="mdi mdi-close"></i> Cancelado
</span>
```

---

### 🎬 **ANIMAÇÕES SUAVES**

#### Classes de Animação
- `.animacao-aparecer-evolusom` - Animação de aparecer (fadeIn)
- `.animacao-deslizar-evolusom` - Animação de deslizar para cima

**Exemplo de uso:**
```html
<div class="container-formulario-evolusom animacao-deslizar-evolusom">
  <!-- Conteúdo -->
</div>
```

---

### 📱 **LAYOUT RESPONSIVO**

#### Sistema de Grid
- `.linha-formulario-evolusom` - Linha com 2 campos
- `.linha-tercos-evolusom` - Linha com 3 campos
- `.campo-completo-evolusom` - Campo de largura total

#### Grupos de Botões
- `.botoes-acao-evolusom` - Container de botões de ação
- `.grupo-botoes-evolusom` - Grupo de botões

**Exemplo de uso:**
```html
<div class="linha-formulario-evolusom">
  <div class="grupo-campo-evolusom">
    <label class="rotulo-campo-evolusom">Nome</label>
    <input type="text" class="campo-texto-evolusom">
  </div>
  <div class="grupo-campo-evolusom">
    <label class="rotulo-campo-evolusom">Email</label>
    <input type="email" class="campo-texto-evolusom">
  </div>
</div>

<div class="botoes-acao-evolusom">
  <a href="#" class="botao-evolusom-contorno">Voltar</a>
  <div class="grupo-botoes-evolusom">
    <button class="botao-evolusom-principal">Salvar</button>
  </div>
</div>
```

---

### ✅ **FEEDBACK DE VALIDAÇÃO**

#### Classes de Feedback
- `.feedback-validacao-evolusom` - Container do feedback
- `.feedback-validacao-evolusom.valido` - Feedback positivo (verde)
- `.feedback-validacao-evolusom.invalido` - Feedback negativo (vermelho)

**Exemplo JavaScript:**
```javascript
function mostrarFeedback(elementoId, mensagem, valido) {
    const feedback = document.getElementById(elementoId);
    feedback.textContent = mensagem;
    feedback.className = valido ? 
        'feedback-validacao-evolusom valido' : 
        'feedback-validacao-evolusom invalido';
}
```

---

### 🎨 **UTILITÁRIOS EXTRAS**

#### Espaçamentos
- `.espacamento-superior-evolusom` - Margin-top: 24px
- `.espacamento-inferior-evolusom` - Margin-bottom: 24px

#### Alinhamento
- `.texto-centralizado-evolusom` - Text-align: center

#### Sombras
- `.sombra-suave-evolusom` - Sombra leve
- `.sombra-media-evolusom` - Sombra média
- `.sombra-forte-evolusom` - Sombra forte

---

## 🚀 **Exemplo Completo de Formulário**

```html
<div class="container-formulario-evolusom animacao-deslizar-evolusom">
  <div class="cabecalho-formulario-evolusom">
    <h4 class="titulo-formulario-evolusom">Cadastro de Cliente</h4>
    <p class="subtitulo-formulario-evolusom">Preencha os dados do cliente</p>
  </div>

  <form onsubmit="return validarFormulario()">
    <div class="linha-formulario-evolusom">
      <div class="grupo-campo-evolusom">
        <label class="rotulo-campo-evolusom obrigatorio">Nome</label>
        <input type="text" class="campo-texto-evolusom" id="nome" required>
        <div class="feedback-validacao-evolusom" id="feedback-nome"></div>
      </div>
      
      <div class="grupo-campo-evolusom">
        <label class="rotulo-campo-evolusom obrigatorio">Email</label>
        <input type="email" class="campo-texto-evolusom" id="email" required>
        <div class="feedback-validacao-evolusom" id="feedback-email"></div>
      </div>
    </div>

    <div class="grupo-campo-evolusom">
      <label class="rotulo-campo-evolusom">Telefone</label>
      <div class="grupo-entrada-evolusom">
        <div class="prefixo-entrada-evolusom">📞</div>
        <input type="tel" class="campo-texto-evolusom" placeholder="(11) 99999-9999">
      </div>
    </div>

    <div class="botoes-acao-evolusom">
      <a href="#" class="botao-evolusom-contorno">
        <i class="mdi mdi-arrow-left"></i> Voltar
      </a>
      <div class="grupo-botoes-evolusom">
        <button type="submit" class="botao-evolusom-principal">
          <i class="mdi mdi-content-save"></i> Salvar Cliente
        </button>
      </div>
    </div>
  </form>
</div>
```

---

## 📋 **Checklist de Implementação**

✅ **Cores humanizadas** (evolusom-azul-profundo, etc.)
✅ **Botões modernos** (botao-evolusom-principal, etc.)
✅ **Formulários avançados** (container-formulario-evolusom, etc.)
✅ **Cards informativos** (cartao-informacao-evolusom, etc.)
✅ **Sistema de etiquetas** (etiqueta-sucesso-evolusom, etc.)
✅ **Animações suaves** (animacao-aparecer-evolusom, etc.)
✅ **Layout responsivo** (linha-formulario-evolusom, etc.)
✅ **Validação visual** (feedback-validacao-evolusom, etc.)
✅ **Utilitários extras** (espacamento-superior-evolusom, etc.)
✅ **Sem variáveis :root** (apenas classes diretas)

---

## 🎯 **Próximos Passos Sugeridos**

1. **Aplicar às views restantes** (fornecedores, serviços, etc.)
2. **Criar temas adicionais** (modo escuro, cores personalizadas)
3. **Adicionar mais utilitários** conforme necessidade
4. **Documentar padrões específicos** do EvoluSom

---

*Esta documentação foi criada para facilitar o uso e manutenção das classes CSS do sistema EvoluSom, seguindo convenções em português brasileiro para melhor compreensão da equipe.* 
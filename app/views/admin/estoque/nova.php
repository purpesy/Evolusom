<div class="col-12 grid-margin stretch-card">
  <div class="container-formulario-evolusom animacao-deslizar-evolusom">
    <!-- Header Profissional -->
    <div class="cabecalho-formulario-evolusom">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="titulo-formulario-evolusom mb-0">
            <i class="mdi mdi-database-plus me-2"></i>Movimentação de Estoque
          </h4>
          <p class="subtitulo-formulario-evolusom mb-0">Sistema de controle de entrada e saída</p>
        </div>
        <div class="badge badge-info px-3 py-2">
          <i class="mdi mdi-clock-outline me-1"></i>
          <span id="data-atual"></span>
        </div>
      </div>
    </div>

    <form class="forms-sample" method="POST" action="<?= URL_BASE ?>estoque/cadastrar" onsubmit="return validarFormulario()">
      
      <!-- Seção 1: Informações do Produto -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-package-variant text-primary me-2"></i>Informações do Produto
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-8">
              <div class="grupo-campo-evolusom">
                <label for="id_produto" class="rotulo-campo-evolusom obrigatorio">Produto</label>
                <select class="selecao-evolusom" id="id_produto" name="id_produto" required>
                  <option value="">Selecione um produto...</option>
                  <?php if (!empty($produtos)): ?>
                    <?php foreach ($produtos as $produto): ?>
                      <option value="<?= $produto['id_produto'] ?>" data-codigo="<?= isset($produto['produto_codigo']) ? $produto['produto_codigo'] : '' ?>">
                        <?= $produto['produto_nome'] ?><?= isset($produto['produto_codigo']) ? ' (Cód: ' . $produto['produto_codigo'] . ')' : '' ?>
                      </option>
                    <?php endforeach; ?>
                  <?php endif; ?>
                </select>
                <div class="feedback-validacao-evolusom" id="feedback-produto"></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="grupo-campo-evolusom">
                <label for="estoque_tipo_movimentacao" class="rotulo-campo-evolusom obrigatorio">Tipo de Operação</label>
                <select class="selecao-evolusom" id="estoque_tipo_movimentacao" name="estoque_tipo_movimentacao" required>
                  <option value="">Selecione...</option>
                  <option value="Entrada">📥 Entrada</option>
                  <option value="Saída">📤 Saída</option>
                </select>
                <div class="feedback-validacao-evolusom" id="feedback-tipo"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Seção 2: Detalhes da Movimentação -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-cog text-warning me-2"></i>Detalhes da Movimentação
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="row">
            <div class="col-md-6">
              <div class="grupo-campo-evolusom">
                <label for="estoque_quantidade" class="rotulo-campo-evolusom obrigatorio">Quantidade</label>
                <div class="input-group">
                  <span class="input-group-text bg-primary text-white">
                    <i class="mdi mdi-numeric"></i>
                  </span>
                  <input type="number" class="form-control campo-texto-evolusom" id="estoque_quantidade" 
                         name="estoque_quantidade" placeholder="0" min="1" step="1" required>
                  <span class="input-group-text bg-light">unidades</span>
                </div>
                <div class="feedback-validacao-evolusom" id="feedback-quantidade"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="grupo-campo-evolusom">
                <label for="estoque_data_referencia" class="rotulo-campo-evolusom">Data da Movimentação</label>
                <div class="input-group">
                  <span class="input-group-text bg-success text-white">
                    <i class="mdi mdi-calendar"></i>
                  </span>
                  <input type="date" class="form-control campo-texto-evolusom" id="estoque_data_referencia" 
                         name="estoque_data_referencia" readonly>
                </div>
                <small class="text-muted">Registrada automaticamente</small>
              </div>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-12">
              <div class="grupo-campo-evolusom">
                <label for="estoque_observacoes" class="rotulo-campo-evolusom">Observações</label>
                <textarea class="area-texto-evolusom" id="estoque_observacoes" name="estoque_observacoes" 
                          rows="3" placeholder="Descreva o motivo da movimentação (opcional)"></textarea>
                <div class="feedback-validacao-evolusom" id="feedback-observacoes"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Resumo Dinâmico -->
      <div class="card border-0 shadow-sm mb-4" id="card-resumo" style="display: none;">
        <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-clipboard-check text-success me-2"></i>Resumo da Operação
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="row text-center">
            <div class="col-md-4">
              <div class="border-end">
                <h6 class="text-muted mb-1">Produto</h6>
                <p class="fw-bold mb-0" id="resumo-produto">-</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="border-end">
                <h6 class="text-muted mb-1">Operação</h6>
                <p class="fw-bold mb-0" id="resumo-tipo">-</p>
              </div>
            </div>
            <div class="col-md-4">
              <h6 class="text-muted mb-1">Quantidade</h6>
              <p class="fw-bold mb-0" id="resumo-quantidade">-</p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Botões de Ação Profissionais -->
      <div class="card border-0 shadow-sm">
        <div class="card-body p-4">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="d-flex align-items-center text-muted">
                <i class="mdi mdi-information-outline me-2"></i>
                <small>Todos os campos obrigatórios devem ser preenchidos</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex gap-2 justify-content-end">
                <a href="<?= URL_BASE ?>estoque/listar" class="btn btn-outline-secondary px-4">
                  <i class="mdi mdi-arrow-left me-1"></i>Cancelar
                </a>
                <button type="button" class="btn btn-outline-warning px-3" onclick="limparFormulario()" title="Limpar formulário">
                  <i class="mdi mdi-refresh"></i>
                </button>
                <button type="submit" class="btn btn-primary px-4" id="btn-salvar">
                  <i class="mdi mdi-content-save me-1"></i>Registrar Movimentação
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<style>
/* Estilos profissionais adicionais */
.container-formulario-evolusom {
  background: #ffffff;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  overflow: hidden;
}

.cabecalho-formulario-evolusom {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 2rem;
  position: relative;
}

.cabecalho-formulario-evolusom::before {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 200px;
  height: 200px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  transform: translate(50px, -50px);
}

.titulo-formulario-evolusom {
  font-size: 1.5rem;
  font-weight: 700;
  letter-spacing: -0.5px;
}

.subtitulo-formulario-evolusom {
  opacity: 0.9;
  font-weight: 300;
}

.card {
  border-radius: 10px !important;
  transition: all 0.3s ease;
}

.card:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0,0,0,0.15) !important;
}

.card-header {
  border-radius: 10px 10px 0 0 !important;
}

.card-title {
  font-size: 0.95rem;
  letter-spacing: 0.3px;
}

.input-group-text {
  border: none;
  font-weight: 600;
}

.btn {
  border-radius: 8px;
  font-weight: 600;
  letter-spacing: 0.3px;
  transition: all 0.3s ease;
  border: none;
  padding: 0.6rem 1.2rem;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
}

.btn-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
}

.btn-outline-secondary {
  border: 2px solid #6c757d;
  color: #6c757d;
}

.btn-outline-secondary:hover {
  background: #6c757d;
  color: white;
  transform: translateY(-1px);
}

.btn-outline-warning {
  border: 2px solid #ffc107;
  color: #ffc107;
}

.btn-outline-warning:hover {
  background: #ffc107;
  color: #000;
  transform: translateY(-1px);
}

.rotulo-campo-evolusom {
  font-weight: 600;
  color: #495057;
  margin-bottom: 0.5rem;
  font-size: 0.9rem;
  letter-spacing: 0.3px;
}

.campo-texto-evolusom, .selecao-evolusom, .area-texto-evolusom {
  border: 2px solid #e9ecef;
  border-radius: 8px;
  padding: 0.75rem 1rem;
  transition: all 0.3s ease;
  font-size: 0.95rem;
}

.campo-texto-evolusom:focus, .selecao-evolusom:focus, .area-texto-evolusom:focus {
  border-color: #667eea;
  box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.1);
  outline: none;
}

.feedback-validacao-evolusom {
  font-size: 0.85rem;
  margin-top: 0.5rem;
  font-weight: 500;
}

.feedback-validacao-evolusom.valido {
  color: #28a745;
}

.feedback-validacao-evolusom.invalido {
  color: #dc3545;
}

.badge {
  font-size: 0.8rem;
  font-weight: 500;
  border-radius: 6px;
}

@media (max-width: 768px) {
  .cabecalho-formulario-evolusom {
    padding: 1.5rem;
  }
  
  .titulo-formulario-evolusom {
    font-size: 1.3rem;
  }
  
  .d-flex.gap-2 {
    flex-direction: column;
  }
  
  .btn {
    width: 100%;
    margin-bottom: 0.5rem;
  }
}
</style>

<script>
function validarFormulario() {
    const produto = document.getElementById('id_produto');
    const tipo = document.getElementById('estoque_tipo_movimentacao');
    const quantidade = document.getElementById('estoque_quantidade');
    
    // Reset de classes de validação
    [produto, tipo, quantidade].forEach(el => {
        el.classList.remove('is-valid', 'is-invalid');
    });
    
    let valido = true;
    
    // Validar produto
    if (!produto.value) {
        produto.classList.add('is-invalid');
        mostrarFeedback('feedback-produto', 'Selecione um produto', false);
        valido = false;
    } else {
        produto.classList.add('is-valid');
        mostrarFeedback('feedback-produto', 'Produto selecionado', true);
    }
    
    // Validar tipo
    if (!tipo.value) {
        tipo.classList.add('is-invalid');
        mostrarFeedback('feedback-tipo', 'Selecione o tipo de operação', false);
        valido = false;
    } else {
        tipo.classList.add('is-valid');
        mostrarFeedback('feedback-tipo', `${tipo.value} selecionada`, true);
    }
    
    // Validar quantidade
    const qtd = parseInt(quantidade.value);
    if (!quantidade.value || qtd <= 0) {
        quantidade.classList.add('is-invalid');
        mostrarFeedback('feedback-quantidade', 'Informe uma quantidade válida', false);
        valido = false;
    } else {
        quantidade.classList.add('is-valid');
        mostrarFeedback('feedback-quantidade', `${qtd} unidades confirmadas`, true);
    }
    
    if (valido) {
        const btnSalvar = document.getElementById('btn-salvar');
        btnSalvar.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i>Processando...';
        btnSalvar.disabled = true;
    }
    
    return valido;
}

function mostrarFeedback(elementoId, mensagem, valido) {
    const feedback = document.getElementById(elementoId);
    feedback.textContent = mensagem;
    feedback.className = valido ? 'feedback-validacao-evolusom valido' : 'feedback-validacao-evolusom invalido';
}

function atualizarResumo() {
    const produto = document.getElementById('id_produto');
    const tipo = document.getElementById('estoque_tipo_movimentacao');
    const quantidade = document.getElementById('estoque_quantidade');
    const cardResumo = document.getElementById('card-resumo');
    
    const produtoTexto = produto.value ? produto.options[produto.selectedIndex].text.split(' (')[0] : '-';
    const tipoTexto = tipo.value ? tipo.value : '-';
    const quantidadeTexto = quantidade.value ? `${quantidade.value} unidades` : '-';
    
    document.getElementById('resumo-produto').textContent = produtoTexto;
    document.getElementById('resumo-tipo').textContent = tipoTexto;
    document.getElementById('resumo-quantidade').textContent = quantidadeTexto;
    
    if (produto.value || tipo.value || quantidade.value) {
        cardResumo.style.display = 'block';
    } else {
        cardResumo.style.display = 'none';
    }
}

function limparFormulario() {
    if (confirm('Deseja realmente limpar todos os campos?')) {
        document.getElementById('id_produto').value = '';
        document.getElementById('estoque_tipo_movimentacao').value = '';
        document.getElementById('estoque_quantidade').value = '';
        document.getElementById('estoque_observacoes').value = '';
        
        document.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });
        
        document.querySelectorAll('.feedback-validacao-evolusom').forEach(el => {
            el.textContent = '';
        });
        
        document.getElementById('card-resumo').style.display = 'none';
        document.getElementById('id_produto').focus();
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Definir data atual
    const hoje = new Date().toISOString().split('T')[0];
    document.getElementById('estoque_data_referencia').value = hoje;
    
    // Mostrar data no header
    const dataAtual = new Date().toLocaleDateString('pt-BR');
    document.getElementById('data-atual').textContent = dataAtual;
    
    // Event listeners
    document.getElementById('id_produto').addEventListener('change', atualizarResumo);
    document.getElementById('estoque_tipo_movimentacao').addEventListener('change', atualizarResumo);
    document.getElementById('estoque_quantidade').addEventListener('input', atualizarResumo);
});
</script> 
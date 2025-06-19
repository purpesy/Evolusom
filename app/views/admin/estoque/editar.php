<div class="col-12 grid-margin stretch-card">
  <div class="container-formulario-evolusom animacao-deslizar-evolusom">
    <!-- Header Profissional -->
    <div class="cabecalho-formulario-evolusom">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h4 class="titulo-formulario-evolusom mb-0">
            <i class="mdi mdi-database-edit me-2"></i>Editar Movimentação de Estoque
          </h4>
          <p class="subtitulo-formulario-evolusom mb-0">Atualizar informações da movimentação #<?= $estoque['id_estoque'] ?></p>
        </div>
        <div class="badge badge-warning px-3 py-2">
          <i class="mdi mdi-pencil me-1"></i>Editando
        </div>
      </div>
    </div>

    <form class="forms-sample" method="POST" action="<?= URL_BASE ?>estoque/atualizar" onsubmit="return validarFormulario()">
      <input type="hidden" name="id_estoque" value="<?= $estoque['id_estoque'] ?>">
      
      <!-- Informações Originais -->
      <div class="card border-0 shadow-sm mb-4" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
        <div class="card-header border-0 py-3" style="background: transparent;">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-history text-info me-2"></i>Informações Atuais
          </h6>
        </div>
        <div class="card-body p-4">
          <div class="row text-center">
            <div class="col-md-3">
              <h6 class="text-muted mb-1">Data Original</h6>
              <p class="fw-bold mb-0"><?= date('d/m/Y H:i', strtotime($estoque['estoque_data_movimentacao'])) ?></p>
            </div>
            <div class="col-md-3">
              <h6 class="text-muted mb-1">Tipo Atual</h6>
              <p class="fw-bold mb-0">
                <?= $estoque['estoque_tipo_movimentacao'] === 'Entrada' ? '📥' : '📤' ?>
                <?= $estoque['estoque_tipo_movimentacao'] ?>
              </p>
            </div>
            <div class="col-md-3">
              <h6 class="text-muted mb-1">Quantidade Atual</h6>
              <p class="fw-bold mb-0"><?= $estoque['estoque_quantidade'] ?> unidades</p>
            </div>
            <div class="col-md-3">
              <h6 class="text-muted mb-1">ID da Movimentação</h6>
              <p class="fw-bold mb-0">#<?= $estoque['id_estoque'] ?></p>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Seção 1: Informações do Produto -->
      <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-package-variant text-primary me-2"></i>Alterar Produto
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
                      <option value="<?= $produto['id_produto'] ?>" 
                              data-codigo="<?= isset($produto['produto_codigo']) ? $produto['produto_codigo'] : '' ?>"
                              <?= ($produto['id_produto'] == $estoque['id_produto']) ? 'selected' : '' ?>>
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
                  <option value="Entrada" <?= ($estoque['estoque_tipo_movimentacao'] == 'Entrada') ? 'selected' : '' ?>>📥 Entrada</option>
                  <option value="Saída" <?= ($estoque['estoque_tipo_movimentacao'] == 'Saída') ? 'selected' : '' ?>>📤 Saída</option>
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
            <i class="mdi mdi-cog text-warning me-2"></i>Alterar Detalhes
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
                         name="estoque_quantidade" placeholder="0" min="1" step="1" 
                         value="<?= $estoque['estoque_quantidade'] ?>" required>
                  <span class="input-group-text bg-light">unidades</span>
                </div>
                <div class="feedback-validacao-evolusom" id="feedback-quantidade"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="grupo-campo-evolusom">
                <label for="estoque_data_movimentacao" class="rotulo-campo-evolusom">Data Original</label>
                <div class="input-group">
                  <span class="input-group-text bg-info text-white">
                    <i class="mdi mdi-lock"></i>
                  </span>
                  <input type="text" class="form-control campo-texto-evolusom" 
                         value="<?= date('d/m/Y H:i', strtotime($estoque['estoque_data_movimentacao'])) ?>" readonly>
                </div>
                <small class="text-muted">Data não pode ser alterada</small>
              </div>
            </div>
          </div>
          
          <div class="row mt-3">
            <div class="col-12">
              <div class="grupo-campo-evolusom">
                <label for="estoque_observacoes" class="rotulo-campo-evolusom">Observações</label>
                <textarea class="area-texto-evolusom" id="estoque_observacoes" name="estoque_observacoes" 
                          rows="3" placeholder="Atualize ou adicione observações sobre a movimentação"><?= htmlspecialchars($estoque['estoque_observacoes'] ?? '') ?></textarea>
                <div class="feedback-validacao-evolusom" id="feedback-observacoes"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Resumo das Alterações -->
      <div class="card border-0 shadow-sm mb-4" id="card-alteracoes" style="display: none;">
        <div class="card-header border-0 py-3" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
          <h6 class="card-title mb-0 fw-bold text-dark">
            <i class="mdi mdi-alert-circle text-warning me-2"></i>Alterações Detectadas
          </h6>
        </div>
        <div class="card-body p-4">
          <div id="lista-alteracoes" class="text-muted">
            <small>As alterações serão mostradas aqui conforme você edita os campos</small>
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
                <small>Alterações serão aplicadas imediatamente após salvar</small>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex gap-2 justify-content-end">
                <a href="<?= URL_BASE ?>estoque/listar" class="btn btn-outline-secondary px-4">
                  <i class="mdi mdi-arrow-left me-1"></i>Cancelar
                </a>
                <button type="button" class="btn btn-outline-danger px-3" onclick="restaurarValores()" title="Restaurar valores originais">
                  <i class="mdi mdi-restore"></i>
                </button>
                <button type="submit" class="btn btn-success px-4" id="btn-salvar">
                  <i class="mdi mdi-content-save me-1"></i>Salvar Alterações
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
  background: linear-gradient(135deg, #fd79a8 0%, #fdcb6e 100%);
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

.btn-success {
  background: linear-gradient(135deg, #00b894 0%, #00cec9 100%);
  box-shadow: 0 4px 15px rgba(0, 184, 148, 0.3);
}

.btn-success:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(0, 184, 148, 0.4);
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

.btn-outline-danger {
  border: 2px solid #e17055;
  color: #e17055;
}

.btn-outline-danger:hover {
  background: #e17055;
  color: white;
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
  border-color: #fd79a8;
  box-shadow: 0 0 0 0.2rem rgba(253, 121, 168, 0.1);
  outline: none;
}

.feedback-validacao-evolusom {
  font-size: 0.85rem;
  margin-top: 0.5rem;
  font-weight: 500;
}

.feedback-validacao-evolusom.valido {
  color: #00b894;
}

.feedback-validacao-evolusom.invalido {
  color: #e17055;
}

.badge {
  font-size: 0.8rem;
  font-weight: 500;
  border-radius: 6px;
}

.alteracao-item {
  padding: 0.5rem;
  background: #fff3cd;
  border-left: 4px solid #ffc107;
  margin-bottom: 0.5rem;
  border-radius: 4px;
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
// Valores originais para comparação
const valoresOriginais = {
    id_produto: '<?= $estoque['id_produto'] ?>',
    tipo_movimentacao: '<?= $estoque['estoque_tipo_movimentacao'] ?>',
    quantidade: '<?= $estoque['estoque_quantidade'] ?>',
    observacoes: '<?= htmlspecialchars($estoque['estoque_observacoes'] ?? '') ?>'
};

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
        btnSalvar.innerHTML = '<i class="mdi mdi-loading mdi-spin me-1"></i>Salvando...';
        btnSalvar.disabled = true;
    }
    
    return valido;
}

function mostrarFeedback(elementoId, mensagem, valido) {
    const feedback = document.getElementById(elementoId);
    feedback.textContent = mensagem;
    feedback.className = valido ? 'feedback-validacao-evolusom valido' : 'feedback-validacao-evolusom invalido';
}

function detectarAlteracoes() {
    const produto = document.getElementById('id_produto').value;
    const tipo = document.getElementById('estoque_tipo_movimentacao').value;
    const quantidade = document.getElementById('estoque_quantidade').value;
    const observacoes = document.getElementById('estoque_observacoes').value;
    
    const alteracoes = [];
    const cardAlteracoes = document.getElementById('card-alteracoes');
    const listaAlteracoes = document.getElementById('lista-alteracoes');
    
    // Verificar alterações
    if (produto !== valoresOriginais.id_produto) {
        const produtoTexto = produto ? document.getElementById('id_produto').options[document.getElementById('id_produto').selectedIndex].text : 'Não selecionado';
        alteracoes.push(`<div class="alteracao-item"><strong>Produto:</strong> Alterado para "${produtoTexto.split(' (')[0]}"</div>`);
    }
    
    if (tipo !== valoresOriginais.tipo_movimentacao) {
        alteracoes.push(`<div class="alteracao-item"><strong>Tipo:</strong> Alterado para "${tipo}"</div>`);
    }
    
    if (quantidade !== valoresOriginais.quantidade) {
        alteracoes.push(`<div class="alteracao-item"><strong>Quantidade:</strong> Alterado de ${valoresOriginais.quantidade} para ${quantidade} unidades</div>`);
    }
    
    if (observacoes !== valoresOriginais.observacoes) {
        const status = observacoes.length > valoresOriginais.observacoes.length ? 'Adicionado' : 'Modificado';
        alteracoes.push(`<div class="alteracao-item"><strong>Observações:</strong> ${status} conteúdo</div>`);
    }
    
    // Mostrar/esconder card de alterações
    if (alteracoes.length > 0) {
        listaAlteracoes.innerHTML = alteracoes.join('');
        cardAlteracoes.style.display = 'block';
    } else {
        cardAlteracoes.style.display = 'none';
    }
}

function restaurarValores() {
    if (confirm('Deseja restaurar todos os valores originais?')) {
        document.getElementById('id_produto').value = valoresOriginais.id_produto;
        document.getElementById('estoque_tipo_movimentacao').value = valoresOriginais.tipo_movimentacao;
        document.getElementById('estoque_quantidade').value = valoresOriginais.quantidade;
        document.getElementById('estoque_observacoes').value = valoresOriginais.observacoes;
        
        // Limpar validações
        document.querySelectorAll('.is-valid, .is-invalid').forEach(el => {
            el.classList.remove('is-valid', 'is-invalid');
        });
        
        // Limpar feedbacks
        document.querySelectorAll('.feedback-validacao-evolusom').forEach(el => {
            el.textContent = '';
        });
        
        // Esconder alterações
        document.getElementById('card-alteracoes').style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Event listeners para detectar alterações
    document.getElementById('id_produto').addEventListener('change', detectarAlteracoes);
    document.getElementById('estoque_tipo_movimentacao').addEventListener('change', detectarAlteracoes);
    document.getElementById('estoque_quantidade').addEventListener('input', detectarAlteracoes);
    document.getElementById('estoque_observacoes').addEventListener('input', detectarAlteracoes);
    
    // Detectar alterações iniciais
    detectarAlteracoes();
});
</script> 
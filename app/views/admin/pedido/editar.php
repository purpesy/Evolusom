<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Pedido #<?= $pedido['id_pedido'] ?></h4>
          <p class="card-description">Atualizar informações do pedido</p>
        </div>
        <a href="<?= URL_BASE ?>pedido/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Pedido
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>pedido/atualizar" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_pedido" value="<?= $pedido['id_pedido'] ?>">
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_cliente">Cliente</label>
              <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Selecione um cliente</option>
                <?php if (!empty($clientes)): ?>
                  <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id_cliente'] ?>" <?= $cliente['id_cliente'] == $pedido['id_cliente'] ? 'selected' : '' ?>>
                      <?= $cliente['cliente_nome'] ?> - <?= $cliente['cliente_telefone'] ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label for="pedido_data">Data do Pedido</label>
              <input type="date" class="form-control" id="pedido_data" name="pedido_data" value="<?= date('Y-m-d', strtotime($pedido['pedido_data'])) ?>" required>
              <small class="form-text text-muted">Data de criação do pedido</small>
            </div>
          </div>
          
          <div class="col-md-3">
            <div class="form-group">
              <label for="pedido_status">Status</label>
              <select class="form-control" id="pedido_status" name="pedido_status" required>
                <option value="Pendente" <?= $pedido['pedido_status'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Aprovado" <?= $pedido['pedido_status'] == 'Aprovado' ? 'selected' : '' ?>>Aprovado</option>
                <option value="Entregue" <?= $pedido['pedido_status'] == 'Entregue' ? 'selected' : '' ?>>Entregue</option>
                <option value="Cancelado" <?= $pedido['pedido_status'] == 'Cancelado' ? 'selected' : '' ?>>Cancelado</option>
              </select>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="pedido_valor_total">Valor Total</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">R$</span>
                </div>
                <input type="text" class="form-control" id="pedido_valor_total" name="pedido_valor_total" value="<?= number_format($pedido['pedido_valor_total'], 2, ',', '.') ?>" required>
              </div>
              <small class="form-text text-muted">Valor total do pedido</small>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Pedido
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Data Atual:</strong> <?= date('d/m/Y', strtotime($pedido['pedido_data'])) ?></p>
                <p><strong>Status Atual:</strong> 
                  <?php if ($pedido['pedido_status'] == 'Pendente'): ?>
                    <span class="badge badge-warning">Pendente</span>
                  <?php elseif ($pedido['pedido_status'] == 'Aprovado'): ?>
                    <span class="badge badge-success">Aprovado</span>
                  <?php elseif ($pedido['pedido_status'] == 'Entregue'): ?>
                    <span class="badge badge-primary">Entregue</span>
                  <?php elseif ($pedido['pedido_status'] == 'Cancelado'): ?>
                    <span class="badge badge-danger">Cancelado</span>
                  <?php else: ?>
                    <span class="badge badge-secondary"><?= $pedido['pedido_status'] ?></span>
                  <?php endif; ?>
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Cliente:</strong> 
                  <?php
                  // Encontrar nome do cliente atual
                  $clienteAtual = '';
                  foreach ($clientes as $cliente) {
                      if ($cliente['id_cliente'] == $pedido['id_cliente']) {
                          $clienteAtual = $cliente['cliente_nome'];
                          break;
                      }
                  }
                  echo $clienteAtual;
                  ?>
                </p>
                <p><strong>Valor Atual:</strong> <strong class="text-success">R$ <?= number_format($pedido['pedido_valor_total'], 2, ',', '.') ?></strong></p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>pedido/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Pedido
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function formatarMoeda(campo) {
    let valor = campo.value.replace(/\D/g, '');
    
    if (valor.length === 0) {
        campo.value = '';
        return;
    }
    
    valor = (parseFloat(valor) / 100).toFixed(2);
    valor = valor.replace('.', ',');
    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
    
    campo.value = valor;
}

function validarFormulario() {
    const cliente = document.getElementById('id_cliente').value;
    const data = document.getElementById('pedido_data').value;
    const valor = document.getElementById('pedido_valor_total').value.trim();
    const status = document.getElementById('pedido_status').value;
    
    if (!cliente) {
        alert('Por favor, selecione um cliente.');
        document.getElementById('id_cliente').focus();
        return false;
    }
    
    if (!data) {
        alert('Por favor, selecione a data do pedido.');
        document.getElementById('pedido_data').focus();
        return false;
    }
    
    if (!valor) {
        alert('Por favor, informe o valor total do pedido.');
        document.getElementById('pedido_valor_total').focus();
        return false;
    }
    
    // Converter valor para formato decimal antes de enviar
    const valorNumerico = parseFloat(valor.replace(/\./g, '').replace(',', '.'));
    if (valorNumerico <= 0) {
        alert('O valor do pedido deve ser maior que zero!');
        document.getElementById('pedido_valor_total').focus();
        return false;
    }
    
    if (!status) {
        alert('Por favor, selecione o status do pedido.');
        document.getElementById('pedido_status').focus();
        return false;
    }
    
    // Converter o valor para formato brasileiro antes de enviar
    document.getElementById('pedido_valor_total').value = valorNumerico.toFixed(2);
    
    return true;
}

// Configurações da interface
document.addEventListener('DOMContentLoaded', function() {
    const valorInput = document.getElementById('pedido_valor_total');
    const clienteSelect = document.getElementById('id_cliente');
    const statusSelect = document.getElementById('pedido_status');
    
    // Aplicar máscara de moeda
    valorInput.addEventListener('input', function() {
        formatarMoeda(this);
    });
    
    // Feedback visual para campos
    clienteSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#28a745';
        } else {
            this.style.borderColor = '';
        }
    });
    
    // Feedback visual para valor
    valorInput.addEventListener('blur', function() {
        const valor = this.value.replace(/\D/g, '');
        if (valor && parseFloat(valor) > 0) {
            this.style.borderColor = '#28a745';
        } else {
            this.style.borderColor = '#dc3545';
        }
    });
    
    // Feedback visual para status
    statusSelect.addEventListener('change', function() {
        this.style.borderColor = '#28a745';
    });
});
</script> 
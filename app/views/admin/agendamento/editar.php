<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Agendamento #<?= $agendamento['id_agendamento'] ?></h4>
          <p class="card-description">Atualizar informações do agendamento</p>
        </div>
        <a href="<?= URL_BASE ?>agendamento/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Agendamento
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>agendamento/atualizar" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_agendamento" value="<?= $agendamento['id_agendamento'] ?>">
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_cliente">Cliente</label>
              <select class="form-control" id="id_cliente" name="id_cliente" required>
                <option value="">Selecione um cliente</option>
                <?php if (!empty($clientes)): ?>
                  <?php foreach ($clientes as $cliente): ?>
                    <option value="<?= $cliente['id_cliente'] ?>" <?= $cliente['id_cliente'] == $agendamento['id_cliente'] ? 'selected' : '' ?>>
                      <?= $cliente['cliente_nome'] ?> - <?= $cliente['cliente_telefone'] ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
              </select>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="agendamento_data">Data e Hora</label>
              <input type="datetime-local" class="form-control" id="agendamento_data" name="agendamento_data" value="<?= date('Y-m-d\TH:i', strtotime($agendamento['agendamento_data'])) ?>" required>
              <small class="form-text text-muted">Data e horário do agendamento</small>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="agendamento_observacoes">Observações do Serviço</label>
              <textarea class="form-control" id="agendamento_observacoes" name="agendamento_observacoes" rows="4" required><?= $agendamento['agendamento_observacoes'] ?></textarea>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="status_agendamento">Status</label>
              <select class="form-control" id="status_agendamento" name="status_agendamento" required>
                <option value="Pendente" <?= $agendamento['status_agendamento'] == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Ativa" <?= $agendamento['status_agendamento'] == 'Ativa' ? 'selected' : '' ?>>Ativa</option>
                <option value="Finalizada" <?= $agendamento['status_agendamento'] == 'Finalizada' ? 'selected' : '' ?>>Finalizada</option>
                <option value="Cancelada" <?= $agendamento['status_agendamento'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Agendamento
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Data Atual:</strong> <?= date('d/m/Y H:i', strtotime($agendamento['agendamento_data'])) ?></p>
                <p><strong>Status Atual:</strong> 
                  <?php if ($agendamento['status_agendamento'] == 'Ativa'): ?>
                    <span class="badge badge-success">Ativa</span>
                  <?php elseif ($agendamento['status_agendamento'] == 'Pendente'): ?>
                    <span class="badge badge-warning">Pendente</span>
                  <?php elseif ($agendamento['status_agendamento'] == 'Finalizada'): ?>
                    <span class="badge badge-primary">Finalizada</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Cancelada</span>
                  <?php endif; ?>
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Cliente:</strong> 
                  <?php
                  // Encontrar nome do cliente atual
                  $clienteAtual = '';
                  foreach ($clientes as $cliente) {
                      if ($cliente['id_cliente'] == $agendamento['id_cliente']) {
                          $clienteAtual = $cliente['cliente_nome'];
                          break;
                      }
                  }
                  echo $clienteAtual;
                  ?>
                </p>
                <p><strong>Observações:</strong> <?= substr($agendamento['agendamento_observacoes'], 0, 100) ?>...</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>agendamento/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Agendamento
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function validarFormulario() {
    const cliente = document.getElementById('id_cliente').value;
    const data = document.getElementById('agendamento_data').value;
    const observacoes = document.getElementById('agendamento_observacoes').value.trim();
    const status = document.getElementById('status_agendamento').value;
    
    if (!cliente) {
        alert('Por favor, selecione um cliente.');
        document.getElementById('id_cliente').focus();
        return false;
    }
    
    if (!data) {
        alert('Por favor, selecione a data e hora do agendamento.');
        document.getElementById('agendamento_data').focus();
        return false;
    }
    
    // Só validar data futura se o status for "Ativa"
    if (status == 'Ativa') {
        const dataAgendamento = new Date(data);
        const agora = new Date();
        
        if (dataAgendamento <= agora) {
            alert('Agendamentos ativos devem ter data no futuro!');
            document.getElementById('agendamento_data').focus();
            return false;
        }
    }
    
    if (!observacoes) {
        alert('Por favor, descreva o serviço a ser realizado.');
        document.getElementById('agendamento_observacoes').focus();
        return false;
    }
    
    if (observacoes.length < 10) {
        alert('As observações devem ter pelo menos 10 caracteres.');
        document.getElementById('agendamento_observacoes').focus();
        return false;
    }
    
    return true;
}

// Configurações da interface
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status_agendamento');
    const dataInput = document.getElementById('agendamento_data');
    
    // Função para controlar validação de data baseada no status
    function atualizarValidacaoData() {
        if (statusSelect.value == 'Ativa') {
            const agora = new Date();
            agora.setHours(agora.getHours() + 1);
            dataInput.min = agora.toISOString().slice(0, 16);
        } else {
            dataInput.removeAttribute('min');
        }
    }
    
    statusSelect.addEventListener('change', atualizarValidacaoData);
    atualizarValidacaoData(); // Chama na inicialização
    
    // Feedback visual para campos
    const clienteSelect = document.getElementById('id_cliente');
    clienteSelect.addEventListener('change', function() {
        if (this.value) {
            this.style.borderColor = '#28a745';
        } else {
            this.style.borderColor = '';
        }
    });
});
</script> 
<?php
// Espera-se que $venda e $funcionarios venham do controller
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Venda #<?= $venda['id_venda'] ?></h4>
          <p class="card-description">Atualizar informações de pagamento da venda</p>
        </div>
        <a href="<?= URL_BASE ?>venda/visualizar/<?= $venda['id_venda'] ?>" class="btn btn-info btn-sm">
          <i class="mdi mdi-eye"></i> Visualizar Completa
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>venda/atualizar">
        <input type="hidden" name="id_venda" value="<?= $venda['id_venda'] ?>">
        
        <!-- Informações da Venda -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h6 class="card-title"><i class="mdi mdi-credit-card text-primary"></i> Informações da Venda</h6>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="venda_data">Data da Venda</label>
                  <input type="date" class="form-control" id="venda_data" name="venda_data" 
                         value="<?= $venda['venda_data'] ?>" required>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="id_funcionario">Funcionário Responsável</label>
                  <select class="form-select" id="id_funcionario" name="id_funcionario" required>
                    <option disabled>Selecione o funcionário</option>
                    <?php if (!empty($funcionarios)): ?>
                      <?php foreach ($funcionarios as $funcionario): ?>
                        <option value="<?= $funcionario['id_funcionario'] ?>" 
                                <?= ($funcionario['id_funcionario'] == $venda['id_funcionario']) ? 'selected' : '' ?>>
                          <?= htmlspecialchars($funcionario['funcionario_nome']) ?> - <?= htmlspecialchars($funcionario['funcionario_cargo']) ?>
                        </option>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <option disabled>Nenhum funcionário encontrado</option>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Informações do Pedido (Somente Leitura) -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h6 class="card-title"><i class="mdi mdi-file-document text-info"></i> Informações do Pedido (Não Editável)</h6>
            <div class="row">
              <div class="col-md-6">
                <table class="table table-borderless table-sm">
                  <tr>
                    <td><strong>Pedido #:</strong></td>
                    <td><?= $venda['id_pedido'] ?></td>
                  </tr>
                  <tr>
                    <td><strong>Cliente:</strong></td>
                    <td><?= htmlspecialchars($venda['cliente_nome']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Data do Pedido:</strong></td>
                    <td><?= date('d/m/Y H:i', strtotime($venda['pedido_data'])) ?></td>
                  </tr>
                </table>
              </div>
              <div class="col-md-6">
                <table class="table table-borderless table-sm">
                  <tr>
                    <td><strong>Valor do Pedido:</strong></td>
                    <td>R$ <?= number_format($venda['pedido_valor_total'], 2, ',', '.') ?></td>
                  </tr>
                  <tr>
                    <td><strong>Email Cliente:</strong></td>
                    <td><?= htmlspecialchars($venda['cliente_email']) ?></td>
                  </tr>
                  <tr>
                    <td><strong>Valor da Venda:</strong></td>
                    <td><strong>R$ <?= number_format($venda['venda_valor'], 2, ',', '.') ?></strong></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="alert alert-info mb-0">
              <i class="mdi mdi-information"></i> 
              <strong>Nota:</strong> O pedido e seu valor não podem ser alterados através da edição da venda. 
              Para alterar o pedido, edite-o diretamente na seção de pedidos.
            </div>
          </div>
        </div>

        <!-- Informações de Pagamento -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h6 class="card-title"><i class="mdi mdi-cash text-success"></i> Informações de Pagamento</h6>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="forma_pagamento">Forma de Pagamento</label>
                  <select class="form-control" id="forma_pagamento" name="forma_pagamento" required>
                    <option value="">Selecione a forma de pagamento</option>
                    <option value="Dinheiro" <?= ($venda['forma_pagamento'] == 'Dinheiro') ? 'selected' : '' ?>>Dinheiro</option>
                    <option value="Cartão de Débito" <?= ($venda['forma_pagamento'] == 'Cartão de Débito') ? 'selected' : '' ?>>Cartão de Débito</option>
                    <option value="Cartão de Crédito" <?= ($venda['forma_pagamento'] == 'Cartão de Crédito') ? 'selected' : '' ?>>Cartão de Crédito</option>
                    <option value="PIX" <?= ($venda['forma_pagamento'] == 'PIX') ? 'selected' : '' ?>>PIX</option>
                    <option value="Transferência Bancária" <?= ($venda['forma_pagamento'] == 'Transferência Bancária') ? 'selected' : '' ?>>Transferência Bancária</option>
                    <option value="Boleto" <?= ($venda['forma_pagamento'] == 'Boleto') ? 'selected' : '' ?>>Boleto Bancário</option>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status_pagamento">Status do Pagamento</label>
                  <select class="form-control" id="status_pagamento" name="status_pagamento" required>
                    <option value="">Selecione o status</option>
                    <option value="Pendente" <?= ($venda['status_pagamento'] == 'Pendente') ? 'selected' : '' ?>>Pendente</option>
                    <option value="Aprovado" <?= ($venda['status_pagamento'] == 'Aprovado') ? 'selected' : '' ?>>Aprovado</option>
                    <option value="Rejeitado" <?= ($venda['status_pagamento'] == 'Rejeitado') ? 'selected' : '' ?>>Rejeitado</option>
                  </select>
                  <small class="form-text text-muted">
                    <i class="mdi mdi-information"></i> 
                    Status do processamento do pagamento
                  </small>
                </div>
              </div>
            </div>

            <!-- Status Atual -->
            <div class="row">
              <div class="col-12">
                <div class="alert alert-<?= 
                  $venda['status_pagamento'] == 'Aprovado' ? 'success' : 
                  ($venda['status_pagamento'] == 'Rejeitado' ? 'danger' : 'warning') 
                ?>" role="alert">
                  <strong>Status Atual:</strong> 
                  <span class="badge badge-<?= 
                    $venda['status_pagamento'] == 'Aprovado' ? 'success' : 
                    ($venda['status_pagamento'] == 'Rejeitado' ? 'danger' : 'warning') 
                  ?>">
                    <?= $venda['status_pagamento'] ?>
                  </span>
                  com forma de pagamento: <strong><?= $venda['forma_pagamento'] ?></strong>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Histórico de Mudanças -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h6 class="card-title"><i class="mdi mdi-history text-secondary"></i> Informações Originais</h6>
            <div class="row">
              <div class="col-md-6">
                <small class="text-muted">
                  <strong>Data Original da Venda:</strong> <?= date('d/m/Y', strtotime($venda['venda_data'])) ?><br>
                  <strong>Funcionário Original:</strong> <?= htmlspecialchars($venda['funcionario_nome']) ?>
                </small>
              </div>
              <div class="col-md-6">
                <small class="text-muted">
                  <strong>Forma Pagamento Original:</strong> <?= $venda['forma_pagamento'] ?><br>
                  <strong>Status Original:</strong> <?= $venda['status_pagamento'] ?>
                </small>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>venda/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <div>
            <a href="<?= URL_BASE ?>venda/visualizar/<?= $venda['id_venda'] ?>" class="btn btn-info me-2">
              <i class="mdi mdi-eye"></i> Visualizar Completa
            </a>
            <button type="submit" class="btn btn-gradient-success">
              <i class="mdi mdi-content-save"></i> Atualizar Venda
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status_pagamento');
    const originalStatus = '<?= $venda['status_pagamento'] ?>';
    
    // Aviso quando mudar para aprovado
    statusSelect.addEventListener('change', function() {
        if (this.value === 'Aprovado' && originalStatus !== 'Aprovado') {
            if (!confirm('Confirma a aprovação do pagamento?')) {
                this.value = originalStatus;
            }
        }
        
        if (this.value === 'Rejeitado' && originalStatus !== 'Rejeitado') {
            if (!confirm('Tem certeza que deseja rejeitar este pagamento?')) {
                this.value = originalStatus;
            }
        }
    });
    
    // Validação do formulário
    document.querySelector('.forms-sample').addEventListener('submit', function(e) {
        const forma = document.getElementById('forma_pagamento').value;
        const status = document.getElementById('status_pagamento').value;
        
        if (!forma || !status) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios!');
            return false;
        }
        
        // Confirmação final se for mudança crítica
        if (status === 'Aprovado' && originalStatus !== 'Aprovado') {
            if (!confirm('Confirma a aprovação final do pagamento?')) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script>

<style>
.table-borderless td {
    border: none;
    padding: 0.25rem 0.5rem;
}

.badge {
    padding: 0.5em 0.8em;
    font-size: 0.85em;
}

.alert i {
    margin-right: 5px;
}

.card .card-title {
    margin-bottom: 15px;
    font-weight: 600;
}
</style>

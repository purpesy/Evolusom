<?php
// Espera-se que $funcionarios e $pedidos venham do controller
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Nova Venda</h4>
      <p class="card-description">Processar pagamento de um pedido existente</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>venda/cadastrar">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="venda_data">Data da Venda</label>
              <input type="date" class="form-control" id="venda_data" name="venda_data" value="<?= date('Y-m-d') ?>" required>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_funcionario">Funcionário Responsável</label>
              <select class="form-select" id="id_funcionario" name="id_funcionario" required>
                <option selected disabled>Selecione o funcionário</option>
                <?php if (!empty($funcionarios)): ?>
                  <?php foreach ($funcionarios as $funcionario): ?>
                    <option value="<?= $funcionario['id_funcionario'] ?>">
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
        
        <!-- Seção do Pedido -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-file-document text-primary"></i> Pedido a ser Processado
            </h5>
            
            <div class="row">
              <div class="col-md-8">
                <div class="form-group">
                  <label for="id_pedido">Selecionar Pedido</label>
                  <select class="form-select" id="id_pedido" name="id_pedido" required>
                    <option selected disabled>Selecione o pedido</option>
                    <?php if (!empty($pedidos)): ?>
                      <?php foreach ($pedidos as $pedido): ?>
                        <option value="<?= $pedido['id_pedido'] ?>" 
                                data-valor="<?= $pedido['pedido_valor_total'] ?>"
                                data-cliente="<?= htmlspecialchars($pedido['cliente_nome']) ?>"
                                data-data="<?= date('d/m/Y', strtotime($pedido['pedido_data'])) ?>">
                          Pedido #<?= $pedido['id_pedido'] ?> - <?= htmlspecialchars($pedido['cliente_nome']) ?> - R$ <?= number_format($pedido['pedido_valor_total'], 2, ',', '.') ?>
                        </option>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <option disabled>Nenhum pedido pendente encontrado</option>
                    <?php endif; ?>
                  </select>
                  <small class="form-text text-muted">Apenas pedidos que ainda não foram vendidos são exibidos</small>
                </div>
              </div>
              
              <div class="col-md-4">
                <div class="form-group">
                  <label for="valor_pedido">Valor do Pedido</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">R$</span>
                    </div>
                    <input type="text" class="form-control" id="valor_pedido" readonly placeholder="0,00">
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Detalhes do Pedido (mostrado quando selecionado) -->
            <div id="detalhes-pedido" style="display: none;" class="mt-3">
              <div class="alert alert-info">
                <h6><i class="mdi mdi-information"></i> Detalhes do Pedido</h6>
                <p class="mb-1"><strong>Cliente:</strong> <span id="cliente-nome"></span></p>
                <p class="mb-1"><strong>Data do Pedido:</strong> <span id="data-pedido"></span></p>
                <p class="mb-0"><strong>Valor Total:</strong> R$ <span id="valor-total"></span></p>
              </div>
            </div>
          </div>
        </div>

        <!-- Informações de Pagamento -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-credit-card text-primary"></i> Informações de Pagamento
            </h5>
            
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="forma_pagamento">Forma de Pagamento</label>
                  <select class="form-control" id="forma_pagamento" name="forma_pagamento" required>
                    <option value="">Selecione a forma de pagamento</option>
                    <option value="Dinheiro">Dinheiro</option>
                    <option value="Cartão de Débito">Cartão de Débito</option>
                    <option value="Cartão de Crédito">Cartão de Crédito</option>
                    <option value="PIX">PIX</option>
                    <option value="Transferência Bancária">Transferência Bancária</option>
                    <option value="Boleto">Boleto Bancário</option>
                  </select>
                </div>
              </div>
              
              <div class="col-md-6">
                <div class="form-group">
                  <label for="status_pagamento">Status do Pagamento</label>
                  <select class="form-control" id="status_pagamento" name="status_pagamento" required>
                    <option value="">Selecione o status</option>
                    <option value="Pendente">Pendente</option>
                    <option value="Aprovado">Aprovado</option>
                    <option value="Rejeitado">Rejeitado</option>
                  </select>
                  <small class="form-text text-muted">Status do processamento do pagamento</small>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>venda/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Processar Venda
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectPedido = document.getElementById('id_pedido');
    const valorPedido = document.getElementById('valor_pedido');
    const detalhesPedido = document.getElementById('detalhes-pedido');
    const clienteNome = document.getElementById('cliente-nome');
    const dataPedido = document.getElementById('data-pedido');
    const valorTotal = document.getElementById('valor-total');
    
    selectPedido.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value) {
            const valor = selectedOption.getAttribute('data-valor');
            const cliente = selectedOption.getAttribute('data-cliente');
            const data = selectedOption.getAttribute('data-data');
            
            // Preencher campos
            valorPedido.value = parseFloat(valor).toFixed(2).replace('.', ',');
            clienteNome.textContent = cliente;
            dataPedido.textContent = data;
            valorTotal.textContent = parseFloat(valor).toFixed(2).replace('.', ',');
            
            // Mostrar detalhes
            detalhesPedido.style.display = 'block';
        } else {
            valorPedido.value = '';
            detalhesPedido.style.display = 'none';
        }
    });
    
    // Validação do formulário
    document.querySelector('.forms-sample').addEventListener('submit', function(e) {
        const pedido = document.getElementById('id_pedido').value;
        const funcionario = document.getElementById('id_funcionario').value;
        const formaPagamento = document.getElementById('forma_pagamento').value;
        const statusPagamento = document.getElementById('status_pagamento').value;
        
        if (!pedido || !funcionario || !formaPagamento || !statusPagamento) {
            e.preventDefault();
            alert('Por favor, preencha todos os campos obrigatórios!');
            return false;
        }
        
        // Confirmação se status for aprovado
        if (statusPagamento === 'Aprovado') {
            if (!confirm('Confirma o processamento da venda? O pedido será marcado como entregue.')) {
                e.preventDefault();
                return false;
            }
        }
    });
});
</script> 
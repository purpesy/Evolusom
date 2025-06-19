<?php
// Espera-se que $venda venha do controller (com dados da venda, pedido e itens)
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">Detalhes da Venda #<?= $venda['id_venda'] ?></h4>
        <div>
          <a href="<?= URL_BASE ?>venda/editar/<?= $venda['id_venda'] ?>" class="btn btn-warning btn-sm">
            <i class="mdi mdi-pencil"></i> Editar
          </a>
          <a href="<?= URL_BASE ?>venda/listar" class="btn btn-light btn-sm">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
        </div>
      </div>

      <div class="row">
        <!-- Informações da Venda -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-credit-card text-primary"></i> Informações da Venda</h6>
              <table class="table table-borderless">
                <tr>
                  <td><strong>Data da Venda:</strong></td>
                  <td><?= date('d/m/Y', strtotime($venda['venda_data'])) ?></td>
                </tr>
                <tr>
                  <td><strong>Funcionário:</strong></td>
                  <td><?= htmlspecialchars($venda['funcionario_nome']) ?></td>
                </tr>
                <tr>
                  <td><strong>Forma de Pagamento:</strong></td>
                  <td><span class="badge badge-info"><?= $venda['forma_pagamento'] ?></span></td>
                </tr>
                <tr>
                  <td><strong>Status do Pagamento:</strong></td>
                  <td>
                    <span class="badge badge-<?= 
                      $venda['status_pagamento'] == 'Aprovado' ? 'success' : 
                      ($venda['status_pagamento'] == 'Rejeitado' ? 'danger' : 'warning') 
                    ?>">
                      <?= $venda['status_pagamento'] ?>
                    </span>
                  </td>
                </tr>
                <tr>
                  <td><strong>Valor da Venda:</strong></td>
                  <td><strong>R$ <?= number_format($venda['venda_valor'], 2, ',', '.') ?></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- Informações do Pedido -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-file-document text-primary"></i> Informações do Pedido</h6>
              <table class="table table-borderless">
                <tr>
                  <td><strong>Pedido #:</strong></td>
                  <td><?= $venda['id_pedido'] ?></td>
                </tr>
                <tr>
                  <td><strong>Data do Pedido:</strong></td>
                  <td><?= date('d/m/Y H:i', strtotime($venda['pedido_data'])) ?></td>
                </tr>
                <tr>
                  <td><strong>Cliente:</strong></td>
                  <td><?= htmlspecialchars($venda['cliente_nome']) ?></td>
                </tr>
                <tr>
                  <td><strong>Email do Cliente:</strong></td>
                  <td><?= htmlspecialchars($venda['cliente_email']) ?></td>
                </tr>
                <tr>
                  <td><strong>Valor do Pedido:</strong></td>
                  <td><strong>R$ <?= number_format($venda['pedido_valor_total'], 2, ',', '.') ?></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>

      <!-- Itens do Pedido -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-package-variant text-primary"></i> Itens do Pedido Vendido</h6>
              
              <?php if (!empty($venda['itens_pedido'])): ?>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Produto</th>
                        <th>Descrição</th>
                        <th>Quantidade</th>
                        <th>Preço Unitário</th>
                        <th>Total</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $contador = 1; ?>
                      <?php foreach ($venda['itens_pedido'] as $item): ?>
                        <tr>
                          <td><?= $contador++ ?></td>
                          <td><strong><?= htmlspecialchars($item['produto_nome']) ?></strong></td>
                          <td><?= htmlspecialchars($item['produto_descricao']) ?></td>
                          <td><?= $item['quantidade'] ?></td>
                          <td>R$ <?= number_format($item['preco_unitario'], 2, ',', '.') ?></td>
                          <td><strong>R$ <?= number_format($item['valor_total'], 2, ',', '.') ?></strong></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr class="table-active">
                        <td colspan="5" class="text-right"><strong>Total da Venda:</strong></td>
                        <td><strong>R$ <?= number_format($venda['venda_valor'], 2, ',', '.') ?></strong></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              <?php else: ?>
                <div class="alert alert-warning">
                  <i class="mdi mdi-alert"></i> Não foi possível carregar os itens do pedido.
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>

      <!-- Ações -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-cog text-primary"></i> Ações de Pagamento</h6>
              <div class="btn-group" role="group">
                <a href="<?= URL_BASE ?>venda/editar/<?= $venda['id_venda'] ?>" class="btn btn-warning">
                  <i class="mdi mdi-pencil"></i> Editar Venda
                </a>
                
                <?php if ($venda['status_pagamento'] == 'Pendente'): ?>
                  <button type="button" class="btn btn-success" onclick="aprovarPagamento(<?= $venda['id_venda'] ?>)">
                    <i class="mdi mdi-check"></i> Aprovar Pagamento
                  </button>
                  <button type="button" class="btn btn-danger" onclick="rejeitarPagamento(<?= $venda['id_venda'] ?>)">
                    <i class="mdi mdi-close"></i> Rejeitar Pagamento
                  </button>
                <?php endif; ?>
                
                <button type="button" class="btn btn-secondary" onclick="excluirVenda(<?= $venda['id_venda'] ?>)">
                  <i class="mdi mdi-delete"></i> Excluir Venda
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Resumo Financeiro -->
      <div class="row mt-4">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-chart-line text-primary"></i> Resumo Financeiro</h6>
              <div class="row">
                <div class="col-md-3">
                  <div class="text-center">
                    <h4 class="text-primary">R$ <?= number_format($venda['venda_valor'], 2, ',', '.') ?></h4>
                    <p class="text-muted">Valor Total</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="text-center">
                    <h4 class="<?= $venda['status_pagamento'] == 'Aprovado' ? 'text-success' : 'text-warning' ?>">
                      <?= $venda['status_pagamento'] ?>
                    </h4>
                    <p class="text-muted">Status</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="text-center">
                    <h4 class="text-info"><?= $venda['forma_pagamento'] ?></h4>
                    <p class="text-muted">Forma de Pagamento</p>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="text-center">
                    <h4 class="text-dark"><?= count($venda['itens_pedido']) ?></h4>
                    <p class="text-muted">Itens Vendidos</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function aprovarPagamento(id) {
    if (confirm('Confirma a aprovação do pagamento?')) {
        window.location.href = '<?= URL_BASE ?>venda/aprovarpagamento/' + id;
    }
}

function rejeitarPagamento(id) {
    if (confirm('Confirma a rejeição do pagamento?')) {
        window.location.href = '<?= URL_BASE ?>venda/rejeitarpagamento/' + id;
    }
}

function excluirVenda(id) {
    if (confirm('Tem certeza que deseja excluir esta venda?')) {
        window.location.href = '<?= URL_BASE ?>venda/excluir/' + id;
    }
}
</script> 
<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Vendas</h4>
        <a href="<?= URL_BASE ?>venda/nova" class="btn btn-gradient-primary btn-fw">Nova Venda</a>
      </div>
    
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Data da Venda</th>
              <th>Pedido</th>
              <th>Cliente</th>
              <th>Funcionário</th>
              <th>Forma Pagamento</th>
              <th>Valor Total</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($vendas)): ?>
              <?php foreach ($vendas as $linha): ?>
                <tr>
                  <td><strong>#<?= $linha['id_venda'] ?></strong></td>
                  <td>
                    <?= date('d/m/Y', strtotime($linha['venda_data'])) ?>
                    <br><small class="text-muted"><?= date('H:i', strtotime($linha['venda_data'])) ?></small>
                  </td>
                  <td>
                    <strong>Pedido #<?= $linha['id_pedido'] ?></strong>
                    <br><small class="text-muted"><?= date('d/m/Y', strtotime($linha['pedido_data'])) ?></small>
                  </td>
                  <td>
                    <strong><?= htmlspecialchars($linha['cliente_nome']) ?></strong>
                  </td>
                  <td>
                    <?= htmlspecialchars($linha['funcionario_nome']) ?>
                  </td>
                  <td>
                    <span class="badge badge-info">
                      <?= htmlspecialchars($linha['forma_pagamento']) ?>
                    </span>
                  </td>
                  <td>
                    <strong class="text-success">
                      R$ <?= number_format($linha['venda_valor'], 2, ',', '.') ?>
                    </strong>
                  </td>
                  <td>
                    <?php 
                    $status = $linha['status_pagamento'];
                    if ($status == 'Aprovado'): ?>
                      <span class="badge badge-success">
                        <i class="mdi mdi-check-circle"></i> Aprovado
                      </span>
                    <?php elseif ($status == 'Pendente'): ?>
                      <span class="badge badge-warning">
                        <i class="mdi mdi-clock"></i> Pendente
                      </span>
                    <?php elseif ($status == 'Rejeitado'): ?>
                      <span class="badge badge-danger">
                        <i class="mdi mdi-close-circle"></i> Rejeitado
                      </span>
                    <?php else: ?>
                      <span class="badge badge-secondary">
                        <?= htmlspecialchars($status) ?>
                      </span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="<?= URL_BASE ?>venda/visualizar/<?= $linha['id_venda'] ?>" class="btn btn-info btn-sm" title="Visualizar">
                        <i class="mdi mdi-eye"></i>
                      </a>
                      <a href="<?= URL_BASE ?>venda/editar/<?= $linha['id_venda'] ?>" class="btn btn-warning btn-sm" title="Editar">
                        <i class="mdi mdi-pencil"></i>
                      </a>
                      <?php if ($status == 'Pendente'): ?>
                        <a href="<?= URL_BASE ?>venda/aprovarpagamento/<?= $linha['id_venda'] ?>" 
                           class="btn btn-success btn-sm" 
                           onclick="return confirm('Confirma a aprovação do pagamento?')" 
                           title="Aprovar Pagamento">
                          <i class="mdi mdi-check"></i>
                        </a>
                        <a href="<?= URL_BASE ?>venda/rejeitarpagamento/<?= $linha['id_venda'] ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Confirma a rejeição do pagamento?')" 
                           title="Rejeitar Pagamento">
                          <i class="mdi mdi-close"></i>
                        </a>
                      <?php endif; ?>
                                               <a href="<?= URL_BASE ?>venda/excluir/<?= $linha['id_venda'] ?>" 
                           class="btn btn-secondary btn-sm" 
                           onclick="return confirm('Deseja realmente excluir esta venda?')" 
                           title="Excluir">
                        <i class="mdi mdi-delete"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center">
                  <div class="alert alert-info mb-0">
                    <i class="mdi mdi-information"></i> Nenhuma venda encontrada
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <?php if (!empty($vendas)): ?>
        <div class="mt-3">
          <div class="row">
            <div class="col-md-6">
              <small class="text-muted">
                <i class="mdi mdi-information"></i> 
                Total de <?= count($vendas) ?> venda(s) encontrada(s)
              </small>
            </div>
            <div class="col-md-6 text-right">
              <small class="text-muted">
                <i class="mdi mdi-calculator"></i> 
                Valor Total: R$ <?= number_format(array_sum(array_column($vendas, 'venda_valor')), 2, ',', '.') ?>
              </small>
            </div>
          </div>
        </div>
      <?php endif; ?>

      <!-- Legendas -->
      <div class="mt-3">
        <small class="text-muted">
          <strong>Legenda dos Status:</strong>
          <span class="badge badge-success badge-sm">Aprovado</span>
          <span class="badge badge-warning badge-sm">Pendente</span>
          <span class="badge badge-danger badge-sm">Rejeitado</span>
        </small>
      </div>
    </div>
  </div>
</div>

<style>
.btn-group {
    display: flex;
    gap: 3px;
    flex-wrap: wrap;
}

.btn-group .btn {
    padding: 0.4rem;
    line-height: 1;
}

.badge {
    padding: 0.5em 0.8em;
    font-size: 0.85em;
}

.badge i {
    margin-right: 3px;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-danger {
    background-color: #dc3545;
    color: white;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
}

.badge-secondary {
    background-color: #6c757d;
    color: white;
}

.badge-sm {
    font-size: 0.75em;
    padding: 0.3em 0.6em;
}

.table th, .table td {
    vertical-align: middle;
}
</style> 
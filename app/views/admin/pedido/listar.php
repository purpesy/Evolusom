<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Pedidos</h4>
        <a href="<?= URL_BASE ?>pedido/novo" class="btn btn-gradient-primary btn-fw">Novo Pedido</a>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>#</th>
              <th>Data</th>
              <th>Cliente</th>
              <th>Valor Total</th>
              <th>Status</th>
              <th>Ações</th>
            </tr>
          </thead>

          <tbody>
            <?php if (!empty($pedidos)): ?>
              <?php foreach ($pedidos as $linha): ?>
                <tr>
                  <td><strong>#<?= $linha['id_pedido'] ?></strong></td>
                  <td>
                    <strong><?= date('d/m/Y', strtotime($linha['pedido_data'])) ?></strong>
                    <br><small class="text-muted"><?= date('H:i', strtotime($linha['pedido_data'])) ?></small>
                  </td>
                  <td>
                    <?php
                    if (isset($linha['cliente_nome']) && !empty($linha['cliente_nome'])) {
                        echo '<strong>' . htmlspecialchars($linha['cliente_nome']) . '</strong>';
                        if (isset($linha['cliente_telefone'])) {
                            echo '<br><small class="text-muted">' . htmlspecialchars($linha['cliente_telefone']) . '</small>';
                        }
                    } else {
                        echo '<em>Cliente ID: ' . $linha['id_cliente'] . '</em>';
                    }
                    ?>
                  </td>
                  <td>
                    <strong class="text-success">
                      R$ <?= number_format($linha['pedido_valor_total'], 2, ',', '.') ?>
                    </strong>
                  </td>
                  <td>
                    <?php 
                    $status = $linha['pedido_status'];
                    
                    // Debug: mostrar o valor original do status
                    // echo "<!-- Status original: " . var_export($status, true) . " -->";
                    
                    if ($status == 'Pendente' || $status == '0' || $status === 0): ?>
                      <span class="badge badge-warning">
                        <i class="mdi mdi-clock"></i> Pendente
                      </span>
                    <?php elseif ($status == 'Aprovado' || $status == '1' || $status === 1): ?>
                      <span class="badge badge-info">
                        <i class="mdi mdi-check"></i> Aprovado
                      </span>
                    <?php elseif ($status == 'Entregue' || $status == '2' || $status === 2): ?>
                      <span class="badge badge-success">
                        <i class="mdi mdi-check-circle"></i> Entregue
                      </span>
                    <?php elseif ($status == 'Cancelado' || $status == '3' || $status === 3): ?>
                      <span class="badge badge-danger">
                        <i class="mdi mdi-close-circle"></i> Cancelado
                      </span>
                    <?php else: ?>
                      <span class="badge badge-secondary">
                        <i class="mdi mdi-help-circle"></i> <?= htmlspecialchars($status) ?>
                      </span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <div class="btn-group" role="group">
                      <a href="<?= URL_BASE ?>pedido/visualizar/<?= $linha['id_pedido'] ?>" class="btn btn-info btn-sm" title="Visualizar">
                        <i class="mdi mdi-eye"></i>
                      </a>
                      <a href="<?= URL_BASE ?>pedido/editar/<?= $linha['id_pedido'] ?>" class="btn btn-warning btn-sm" title="Editar">
                        <i class="mdi mdi-pencil"></i>
                      </a>
                      <a href="<?= URL_BASE ?>pedido/excluir/<?= $linha['id_pedido'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este pedido? Esta ação não pode ser desfeita.')" title="Excluir">
                        <i class="mdi mdi-delete"></i>
                      </a>
                    </div>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="6" class="text-center">
                  <div class="alert alert-info mb-0">
                    <i class="mdi mdi-information"></i> Nenhum pedido encontrado
                  </div>
                </td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <?php if (!empty($pedidos)): ?>
        <div class="mt-3">
          <div class="row">
            <div class="col-md-6">
              <small class="text-muted">
                <i class="mdi mdi-information"></i> 
                Total de <?= count($pedidos) ?> pedido(s) encontrado(s)
              </small>
            </div>
            <div class="col-md-6 text-right">
              <small class="text-muted">
                <strong>Legenda:</strong>
                <span class="badge badge-warning badge-sm">Pendente</span>
                <span class="badge badge-info badge-sm">Aprovado</span>
                <span class="badge badge-success badge-sm">Entregue</span>
                <span class="badge badge-danger badge-sm">Cancelado</span>
              </small>
            </div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>

<style>
.badge {
    padding: 0.5em 0.8em;
    font-size: 0.85em;
    font-weight: 500;
}

.badge i {
    margin-right: 4px;
}

.badge-warning {
    background-color: #ffc107;
    color: #212529;
}

.badge-info {
    background-color: #17a2b8;
    color: white;
}

.badge-success {
    background-color: #28a745;
    color: white;
}

.badge-danger {
    background-color: #dc3545;
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

.btn-group .btn {
    margin-right: 2px;
}
</style>
<?php
// Espera-se que $pedido e $itens venham do controller
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="card-title mb-0">Detalhes do Pedido #<?= $pedido['id_pedido'] ?></h4>
        <div>
          <a href="<?= URL_BASE ?>pedido/editar/<?= $pedido['id_pedido'] ?>" class="btn btn-warning btn-sm">
            <i class="mdi mdi-pencil"></i> Editar
          </a>
          <a href="<?= URL_BASE ?>pedido/listar" class="btn btn-light btn-sm">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
        </div>
      </div>

      <div class="row">
        <!-- Informações do Pedido -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-file-document text-primary"></i> Informações do Pedido</h6>
              <table class="table table-borderless">
                <tr>
                  <td><strong>Data do Pedido:</strong></td>
                  <td><?= date('d/m/Y H:i', strtotime($pedido['pedido_data'])) ?></td>
                </tr>
                <tr>
                  <td><strong>Status:</strong></td>
                  <td>
                    <?php 
                    $status = $pedido['pedido_status'];
                    
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
                </tr>
                <tr>
                  <td><strong>Valor Total:</strong></td>
                  <td><strong>R$ <?= number_format($pedido['pedido_valor_total'], 2, ',', '.') ?></strong></td>
                </tr>
              </table>
            </div>
          </div>
        </div>

        <!-- Informações do Cliente -->
        <div class="col-md-6">
          <div class="card">
            <div class="card-body">
              <h6 class="card-title"><i class="mdi mdi-account text-primary"></i> Informações do Cliente</h6>
              <table class="table table-borderless">
                <tr>
                  <td><strong>Nome:</strong></td>
                  <td><?= htmlspecialchars($pedido['cliente_nome']) ?></td>
                </tr>
                <tr>
                  <td><strong>Telefone:</strong></td>
                  <td><?= htmlspecialchars($pedido['cliente_telefone']) ?></td>
                </tr>
                <tr>
                  <td><strong>Email:</strong></td>
                  <td><?= htmlspecialchars($pedido['cliente_email']) ?></td>
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
              <h6 class="card-title"><i class="mdi mdi-package-variant text-primary"></i> Itens do Pedido</h6>
              
              <?php if (!empty($itens)): ?>
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
                      <?php foreach ($itens as $item): ?>
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
                        <td colspan="5" class="text-right"><strong>Total do Pedido:</strong></td>
                        <td><strong>R$ <?= number_format($pedido['pedido_valor_total'], 2, ',', '.') ?></strong></td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              <?php else: ?>
                <div class="alert alert-warning">
                  <i class="mdi mdi-alert"></i> Este pedido não possui itens cadastrados.
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
              <h6 class="card-title"><i class="mdi mdi-cog text-primary"></i> Ações</h6>
              <div class="btn-group" role="group">
                <a href="<?= URL_BASE ?>pedido/editar/<?= $pedido['id_pedido'] ?>" class="btn btn-warning">
                  <i class="mdi mdi-pencil"></i> Editar Pedido
                </a>
                
                <?php if ($pedido['pedido_status'] == 'Pendente'): ?>
                  <button type="button" class="btn btn-success" onclick="marcarComoEntregue(<?= $pedido['id_pedido'] ?>)">
                    <i class="mdi mdi-check"></i> Marcar como Entregue
                  </button>
                <?php endif; ?>
                
                <button type="button" class="btn btn-danger" onclick="excluirPedido(<?= $pedido['id_pedido'] ?>)">
                  <i class="mdi mdi-delete"></i> Excluir Pedido
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function marcarComoEntregue(id) {
    if (confirm('Confirma que este pedido foi entregue?')) {
        // Criar formulário para enviar via POST
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '<?= URL_BASE ?>pedido/atualizar';
        
        const idInput = document.createElement('input');
        idInput.type = 'hidden';
        idInput.name = 'id_pedido';
        idInput.value = id;
        
        const statusInput = document.createElement('input');
        statusInput.type = 'hidden';
        statusInput.name = 'pedido_status';
        statusInput.value = 'Entregue';
        
        form.appendChild(idInput);
        form.appendChild(statusInput);
        document.body.appendChild(form);
        form.submit();
    }
}

function excluirPedido(id) {
    if (confirm('Tem certeza que deseja excluir este pedido? Esta ação não pode ser desfeita.')) {
        window.location.href = '<?= URL_BASE ?>pedido/excluir/' + id;
    }
}
</script> 
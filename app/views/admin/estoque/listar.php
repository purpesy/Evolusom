<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Movimentações de Estoque</h4>
        <a href="<?= URL_BASE ?>estoque/nova" class="btn btn-gradient-primary btn-fw">Nova Movimentação</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Data</th>
            <th>Produto</th>
            <th>Tipo</th>
            <th>Quantidade</th>
            <th>Observações</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($estoque)): ?>
            <?php foreach ($estoque as $linha): ?>
              <tr>
                <td>
                  <span class="badge badge-info">
                    <?= date('d/m/Y H:i', strtotime($linha['estoque_data_movimentacao'])) ?>
                  </span>
                </td>
                <td>
                  <strong><?= $linha['produto_nome'] ?></strong>
                </td>
                <td>
                  <?php if ($linha['estoque_tipo_movimentacao'] == 'Entrada'): ?>
                    <span class="badge badge-success">Entrada</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Saída</span>
                  <?php endif; ?>
                </td>
                <td>
                  <strong><?= $linha['estoque_quantidade'] ?></strong>
                </td>
                <td>
                  <?= substr($linha['estoque_observacoes'], 0, 40) ?>...
                </td>
                <td>
                  <a href="<?= URL_BASE ?>estoque/editar/<?= $linha['id_estoque'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>estoque/excluir/<?= $linha['id_estoque'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir esta movimentação?')" title="Excluir">
                    <i class="mdi mdi-delete"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">Nenhuma movimentação encontrada</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
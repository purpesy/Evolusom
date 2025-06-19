<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Categorias</h4>
        <a href="<?= URL_BASE ?>categoria/nova" class="btn btn-gradient-primary btn-fw">Nova Categoria</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Status</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($categoria)): ?>
            <?php foreach ($categoria as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['nome_categoria'] ?></strong>
                </td>
                <td>
                  <?= substr($linha['descricao_categoria'], 0, 60) ?>...
                </td>
                <td>
                  <?php if ($linha['status_categoria'] == 'Ativa'): ?>
                    <span class="badge badge-success">Ativa</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Inativa</span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= URL_BASE ?>categoria/editar/<?= $linha['id_categoria'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>categoria/toggleStatus/<?= $linha['id_categoria'] ?>" class="btn <?= $linha['status_categoria'] == 'Ativa' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['status_categoria'] == 'Ativa' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center">Nenhuma categoria encontrada</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
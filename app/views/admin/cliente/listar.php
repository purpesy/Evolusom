<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Clientes</h4>
        <a href="<?= URL_BASE ?>cliente/novo" class="btn btn-gradient-primary btn-fw">Novo Cliente</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>CPF</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($cliente)): ?>
            <?php foreach ($cliente as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['cliente_nome'] ?></strong>
                </td>
                <td>
                  <span class="badge badge-info">
                    <?= $linha['cliente_telefone'] ?>
                  </span>
                </td>
                <td>
                  <?= $linha['cliente_email'] ?>
                </td>
                <td>
                  <span class="badge badge-secondary">
                    <?= $linha['cliente_cpf'] ?>
                  </span>
                </td>
                <td>
                  <a href="<?= URL_BASE ?>cliente/editar/<?= $linha['id_cliente'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>cliente/toggleStatus/<?= $linha['id_cliente'] ?>" class="btn <?= $linha['cliente_status'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['cliente_status'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">Nenhum cliente encontrado</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
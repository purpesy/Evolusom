<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Funcionários</h4>
        <a href="<?= URL_BASE ?>funcionario/novo" class="btn btn-gradient-primary btn-fw">Novo Funcionário</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>CPF</th>
            <th>Cargo</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($funcionarios)): ?>
            <?php foreach ($funcionarios as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['funcionario_nome'] ?></strong>
                </td>
                <td>
                  <span class="badge badge-info">
                    <?= $linha['funcionario_cpf'] ?>
                  </span>
                </td>
                <td>
                  <span class="badge badge-success">
                    <?= $linha['funcionario_cargo'] ?>
                  </span>
                </td>
                <td>
                  <?= $linha['funcionario_telefone'] ?>
                </td>
                <td>
                  <?= $linha['funcionario_email'] ?>
                </td>
                <td>
                  <a href="<?= URL_BASE ?>funcionario/editar/<?= $linha['id_funcionario'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>funcionario/toggleStatus/<?= $linha['id_funcionario'] ?>" class="btn <?= $linha['funcionario_status'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['funcionario_status'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">Nenhum funcionário encontrado</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div> 
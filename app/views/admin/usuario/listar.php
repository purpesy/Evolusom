<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Usuários do Sistema</h4>
        <a href="<?= URL_BASE ?>usuario/novo" class="btn btn-gradient-primary btn-fw">Novo Usuário</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Login</th>
            <th>Email</th>
            <th>Nível</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($usuarios)): ?>
            <?php foreach ($usuarios as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['usuario_nome'] ?></strong>
                </td>
                <td>
                  <span class="badge badge-info">
                    <?= $linha['usuario_login'] ?>
                  </span>
                </td>
                <td>
                  <?= $linha['usuario_email'] ?>
                </td>
                <td>
                  <?php if ($linha['usuario_nivel'] == 'admin'): ?>
                    <span class="badge badge-danger">Administrador</span>
                  <?php elseif ($linha['usuario_nivel'] == 'vendedor'): ?>
                    <span class="badge badge-warning">Vendedor</span>
                  <?php else: ?>
                    <span class="badge badge-success"><?= ucfirst($linha['usuario_nivel']) ?></span>
                  <?php endif; ?>
                </td>
                <td>
                  <a href="<?= URL_BASE ?>usuario/editar/<?= $linha['id_usuario'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>usuario/toggleStatus/<?= $linha['id_usuario'] ?>" class="btn <?= $linha['usuario_status'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['usuario_status'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-center">Nenhum usuário encontrado</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div> 
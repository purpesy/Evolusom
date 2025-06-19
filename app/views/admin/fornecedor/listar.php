<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Fornecedores</h4>
        <a href="<?= URL_BASE ?>fornecedor/novo" class="btn btn-gradient-primary btn-fw">Novo Fornecedor</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Telefone</th>
            <th>Email</th>
            <th>Endereço</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($fornecedor)): ?>
            <?php foreach ($fornecedor as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['fornecedor_nome'] ?></strong>
                </td>
                <td>
                  <span class="badge badge-info">
                    <?= $linha['fornecedor_cnpj'] ?>
                  </span>
                </td>
                <td>
                  <?= $linha['fornecedor_telefone'] ?>
                </td>
                <td>
                  <?= $linha['fornecedor_email'] ?>
                </td>
                <td>
                  <?= substr($linha['fornecedor_endereco'], 0, 30) ?>...
                </td>
                <td>
                  <a href="<?= URL_BASE ?>fornecedor/editar/<?= $linha['id_fornecedor'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>fornecedor/toggleStatus/<?= $linha['id_fornecedor'] ?>" class="btn <?= $linha['fornecedor_status'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['fornecedor_status'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">Nenhum fornecedor encontrado</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
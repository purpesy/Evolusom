<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
        <h4 class="card-title">Lista de Serviços</h4>
        <a href="<?= URL_BASE ?>servico/novo" class="btn btn-gradient-primary btn-fw">Novo Serviço</a>
      </div>
      
      <table class="table">
        <thead>
          <tr>
            <th>Nome do Serviço</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($servicos)): ?>
            <?php foreach ($servicos as $linha): ?>
              <tr>
                <td>
                  <strong><?= $linha['nome_servico'] ?></strong>
                </td>
                <td>
                  <?= substr($linha['descricao_servico'], 0, 60) ?>...
                </td>
                <td>
                  <span class="badge badge-success">
                    R$ <?= number_format($linha['preco_servico'], 2, ',', '.') ?>
                  </span>
                </td>
                <td>
                  <a href="<?= URL_BASE ?>servico/editar/<?= $linha['id_servico'] ?>" class="btn btn-warning btn-sm" title="Editar">
                    <i class="mdi mdi-pencil"></i>
                  </a>
                  <a href="<?= URL_BASE ?>servico/toggleStatus/<?= $linha['id_servico'] ?>" class="btn <?= $linha['status_servico'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm" title="Alterar Status">
                    <i class="mdi <?= $linha['status_servico'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="4" class="text-center">Nenhum serviço encontrado</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div> 
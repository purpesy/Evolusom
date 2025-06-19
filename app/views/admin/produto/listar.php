<div class="col-lg-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="flex_adicionar">
      <h4 class="card-title">Produtos</h4>
      <a href="<?php echo URL_BASE?>produto/adicionar" class="btn btn-gradient-secondary btn-fw">Adicionar Produto</a>
      </div>
      <div class="table-responsive">
        <table class="table">



        <thead>
          <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th class="d-none-mobile">Categoria</th>
            <th>Status</th>
            <th class="d-none-mobile">Data de cadastro</th>
            <th>Ações</th>
          </tr>
        </thead>

        <tbody>

          <?php foreach ($produto as $linha): ?>
            <tr>
              <td>
                <?php if (!empty($linha['produto_foto'])): ?>
                  <img src="<?= URL_BASE ?>assets/img/produtos/<?= $linha['produto_foto'] ?>" alt="<?= $linha['produto_nome'] ?>" style="width: 50px; height: 50px; object-fit: cover;">
                <?php else: ?>
                  <img src="https://via.placeholder.com/50x50/f0f0f0/666?text=Sem+Imagem" alt="Sem imagem" style="width: 50px; height: 50px;">
                <?php endif; ?>
              </td>
              <td><?= $linha['produto_nome'] ?></td>
              <td><?= substr($linha['produto_descricao'], 0, 50) ?>...</td>
              <td class="d-none-mobile"><?= $linha['nome_categoria'] ?></td>
              <td>
                <span class="badge <?= $linha['produto_status'] == 'Ativo' ? 'badge-success' : 'badge-secondary' ?>">
                  <?= $linha['produto_status'] ?>
                </span>
              </td>
              <td class="d-none-mobile"><?= date('d/m/Y', strtotime($linha['produto_data_cadastro'])) ?></td>
              <td>
                <a href="<?= URL_BASE ?>produto/toggleStatus/<?= $linha['id_produto'] ?>" class="btn <?= $linha['produto_status'] == 'Ativo' ? 'btn-success' : 'btn-secondary' ?> btn-sm">
                  <i class="mdi <?= $linha['produto_status'] == 'Ativo' ? 'mdi-check-circle' : 'mdi-close-circle' ?>"></i>
                </a>
                <a href="<?= URL_BASE ?>produto/editar/<?= $linha['id_produto'] ?>" class="btn btn-warning btn-sm">
                  <i class="mdi mdi-pencil"></i>
                </a>
                <a href="<?= URL_BASE ?>produto/excluir/<?= $linha['id_produto'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluir este produto?')">
                  <i class="mdi mdi-delete"></i>
                </a>
              </td>

            </tr>
          <?php endforeach; ?>

        </tbody>
      </table>
      </div>
    </div>
  </div>
</div>
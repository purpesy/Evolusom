<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Editar Produto</h4>
      <p class="card-description">Atualize os dados do produto</p>

      <?php if (isset($_SESSION['erro'])): ?>
        <div class="alert alert-danger">
          <?= $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
      <?php endif; ?>

      <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= URL_BASE ?>produto/editar/<?= $produto['id_produto'] ?>">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="produto_nome">Nome do Produto</label>
              <input type="text" class="form-control" id="produto_nome" name="produto_nome" 
                     value="<?= htmlspecialchars($produto['produto_nome']) ?>" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="produto_preco">Valor (R$)</label>
              <input type="number" step="0.01" class="form-control" id="produto_preco" name="produto_valor" 
                     value="<?= htmlspecialchars($produto['produto_preco']) ?>" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="vcategoria">Categoria</label>
              <select class="form-select" id="vcategoria" name="vcategoria" required>
                <option value="" disabled>Selecione a categoria</option>
                <?php foreach ($categorias as $linha): ?>
                  <option value="<?= htmlspecialchars($linha['id_categoria']) ?>" 
                          <?= ($linha['id_categoria'] == $produto['id_categoria']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($linha['nome_categoria']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="produto_quantidade">Quantidade em Estoque</label>
              <input type="number" class="form-control" id="produto_quantidade" name="produto_quantidade" 
                     value="<?= htmlspecialchars($produto['produto_quantidade']) ?>" min="0" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="produto_foto">Foto do Produto</label>
          <?php if (!empty($produto['produto_foto'])): ?>
            <div class="mb-2">
              <img src="<?= URL_BASE ?>assets/img/produtos/<?= $produto['produto_foto'] ?>" 
                   alt="Foto atual" class="img-thumbnail" style="max-width: 200px;">
            </div>
          <?php endif; ?>
          <input type="file" class="form-control" id="produto_foto" name="produto_foto" accept="image/*">
          <small class="form-text text-muted">Deixe em branco para manter a foto atual</small>
        </div>

        <div class="form-group">
          <label for="produto_descricao">Descrição</label>
          <textarea class="form-control" id="produto_descricao" name="produto_descricao" rows="4" required><?= htmlspecialchars($produto['produto_descricao']) ?></textarea>
        </div>

        <div class="form-group">
          <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="produto_status" name="produto_status" 
                   <?= ($produto['produto_status'] == 1) ? 'checked' : '' ?>>
            <label class="form-check-label" for="produto_status">Produto Ativo</label>
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>produto/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Salvar Alterações
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
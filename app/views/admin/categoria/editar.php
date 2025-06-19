<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Categoria #<?= $categoria['id_categoria'] ?></h4>
          <p class="card-description">Atualizar informações da categoria</p>
        </div>
        <a href="<?= URL_BASE ?>categoria/nova" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Nova Categoria
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>categoria/atualizar">
        <input type="hidden" name="id_categoria" value="<?= $categoria['id_categoria'] ?>">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_categoria">Nome da Categoria</label>
              <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" value="<?= $categoria['nome_categoria'] ?>" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-10">
            <div class="form-group">
              <label for="descricao_categoria">Descrição</label>
              <textarea class="form-control" id="descricao_categoria" name="descricao_categoria" rows="4" required><?= $categoria['descricao_categoria'] ?></textarea>
            </div>
          </div>
          
          <div class="col-md-2">
            <div class="form-group">
              <label for="status_categoria">Status</label>
              <select class="form-select" id="status_categoria" name="status_categoria" required>
                <option value="Ativa" <?= ($categoria['status_categoria'] == 'Ativa') ? 'selected' : '' ?>>Ativa</option>
                <option value="Inativa" <?= ($categoria['status_categoria'] == 'Inativa') ? 'selected' : '' ?>>Inativa</option>
              </select>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais da Categoria
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nome Atual:</strong> <?= $categoria['nome_categoria'] ?></p>
                <p><strong>Status Atual:</strong> 
                  <?php if ($categoria['status_categoria'] == 'Ativa'): ?>
                    <span class="badge badge-success">Ativa</span>
                  <?php else: ?>
                    <span class="badge badge-danger">Inativa</span>
                  <?php endif; ?>
                </p>
              </div>
              <div class="col-md-6">
                <p><strong>Descrição Atual:</strong> <?= substr($categoria['descricao_categoria'], 0, 100) ?>...</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>categoria/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Categoria
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

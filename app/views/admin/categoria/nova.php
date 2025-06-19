<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Nova Categoria</h4>
      <p class="card-description">Cadastrar uma nova categoria no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>categoria/cadastrar">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_categoria">Nome da Categoria</label>
              <input type="text" class="form-control" id="nome_categoria" name="nome_categoria" placeholder="Ex: Amplificadores" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="descricao_categoria">Descrição</label>
              <textarea class="form-control" id="descricao_categoria" name="descricao_categoria" rows="4" placeholder="Descreva a categoria de produtos..." required></textarea>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>categoria/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Categoria
          </button>
        </div>
      </form>
    </div>
  </div>
</div> 
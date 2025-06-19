<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Adicionar Produto</h4>
      <p class="card-description">Preencha os dados do novo produto</p>

      <form class="forms-sample" method="POST" enctype="multipart/form-data" action="<?= URL_BASE ?>produto/adicionar">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="produto_nome">Nome do Produto</label>
              <input type="text" class="form-control" id="produto_nome" name="produto_nome" placeholder="Nome do produto" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="produto_preco">Valor (R$)</label>
              <input type="number" step="0.01" class="form-control" id="produto_preco" name="produto_preco" placeholder="0.00" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="id_categoria">Categoria</label>
              <select class="form-select" id="id_categoria" name="id_categoria" required>
                <option value="" selected disabled>Selecione a categoria</option>
                <?php foreach ($categorias as $linha): ?>
                  <option value="<?= htmlspecialchars($linha['id_categoria']) ?>">
                    <?= htmlspecialchars($linha['nome_categoria']) ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group">
              <label for="produto_quantidade">Quantidade em Estoque</label>
              <input type="number" class="form-control" id="produto_quantidade" name="produto_quantidade" placeholder="Quantidade" min="0" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <label for="produto_foto">Foto do Produto</label>
          <input type="file" class="form-control" id="produto_foto" name="produto_foto" accept="image/*">
          <small class="form-text text-muted">Formatos aceitos: JPG, JPEG, PNG, GIF</small>
        </div>

        <div class="form-group">
          <label for="produto_descricao">Descrição</label>
          <textarea class="form-control" id="produto_descricao" name="produto_descricao" rows="4" placeholder="Descrição do produto" required></textarea>
        </div>

        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>produto/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Produto
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>

document.addEventListener('DOMContentLoaded', function (){

    const visualizarImg  = document.getElementById('img-form');
    const arquivo        = document.getElementById('foto_curso');

    visualizarImg.addEventListener('click', function () {
        // alert("cliquei na img")
        // console.log("clique img")
        arquivo.click();
    });    

    arquivo.addEventListener('change', function(){

        if(arquivo.files && arquivo.files[0]){

            let render = new FileReader()
            render.onload = function(e){
                visualizarImg.src = e.target.result
            }

            render.readAsDataURL(arquivo.files[0])

        }

    })

})

</script>

</div>

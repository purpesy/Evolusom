<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Serviço</h4>
      <p class="card-description">Cadastrar um novo serviço no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>servico/cadastrar" onsubmit="return validarFormulario()">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_servico">Nome do Serviço</label>
              <input type="text" class="form-control" id="nome_servico" name="nome_servico" placeholder="Ex: Instalação de Som Automotivo" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="descricao_servico">Descrição do Serviço</label>
              <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4" placeholder="Descreva detalhadamente o serviço oferecido..." required></textarea>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="preco_servico">Preço (R$)</label>
              <input type="number" class="form-control" id="preco_servico" name="preco_servico" placeholder="0,00" step="0.01" min="0" required>
              <small class="form-text text-muted">Use ponto para decimais (ex: 150.50)</small>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>servico/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Serviço
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function validarFormulario() {
    const nome = document.getElementById('nome_servico').value.trim();
    const descricao = document.getElementById('descricao_servico').value.trim();
    const preco = document.getElementById('preco_servico').value;
    
    if (!nome) {
        alert('Por favor, preencha o nome do serviço.');
        document.getElementById('nome_servico').focus();
        return false;
    }
    
    if (!descricao) {
        alert('Por favor, preencha a descrição do serviço.');
        document.getElementById('descricao_servico').focus();
        return false;
    }
    
    if (!preco || preco <= 0) {
        alert('Por favor, informe um preço válido para o serviço.');
        document.getElementById('preco_servico').focus();
        return false;
    }
    
    return true;
}

// Formatação do campo preço
document.getElementById('preco_servico').addEventListener('blur', function() {
    if (this.value) {
        this.value = parseFloat(this.value).toFixed(2);
    }
});
</script> 
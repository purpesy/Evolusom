<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Serviço #<?= $servico['id_servico'] ?></h4>
          <p class="card-description">Atualizar informações do serviço</p>
        </div>
        <a href="<?= URL_BASE ?>servico/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Serviço
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>servico/atualizar" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_servico" value="<?= $servico['id_servico'] ?>">
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="nome_servico">Nome do Serviço</label>
              <input type="text" class="form-control" id="nome_servico" name="nome_servico" value="<?= $servico['nome_servico'] ?>" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="descricao_servico">Descrição do Serviço</label>
              <textarea class="form-control" id="descricao_servico" name="descricao_servico" rows="4" required><?= $servico['descricao_servico'] ?></textarea>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="preco_servico">Preço (R$)</label>
              <input type="number" class="form-control" id="preco_servico" name="preco_servico" value="<?= $servico['preco_servico'] ?>" step="0.01" min="0" required>
              <small class="form-text text-muted">Use ponto para decimais (ex: 150.50)</small>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Serviço
            </h5>
            <div class="row">
              <div class="col-md-8">
                <p><strong>Nome Atual:</strong> <?= $servico['nome_servico'] ?></p>
                <p><strong>Descrição Atual:</strong> <?= substr($servico['descricao_servico'], 0, 100) ?>...</p>
              </div>
              <div class="col-md-4">
                <p><strong>Preço Atual:</strong> R$ <?= number_format($servico['preco_servico'], 2, ',', '.') ?></p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>servico/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Serviço
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
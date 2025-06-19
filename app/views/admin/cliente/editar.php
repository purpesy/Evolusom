<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Cliente #<?= $cliente['id_cliente'] ?></h4>
          <p class="card-description">Atualizar informações do cliente</p>
        </div>
        <a href="<?= URL_BASE ?>cliente/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Cliente
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>cliente/atualizar">
        <input type="hidden" name="id_cliente" value="<?= $cliente['id_cliente'] ?>">
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_nome">Nome Completo</label>
              <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" value="<?= $cliente['cliente_nome'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_cpf">CPF</label>
              <input type="text" class="form-control" id="cliente_cpf" name="cliente_cpf" value="<?= $cliente['cliente_cpf'] ?>" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_telefone">Telefone</label>
              <input type="tel" class="form-control" id="cliente_telefone" name="cliente_telefone" value="<?= $cliente['cliente_telefone'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_email">Email</label>
              <input type="email" class="form-control" id="cliente_email" name="cliente_email" value="<?= $cliente['cliente_email'] ?>" required>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Cliente
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nome Atual:</strong> <?= $cliente['cliente_nome'] ?></p>
                <p><strong>CPF Atual:</strong> <?= $cliente['cliente_cpf'] ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Telefone Atual:</strong> <?= $cliente['cliente_telefone'] ?></p>
                <p><strong>Email Atual:</strong> <?= $cliente['cliente_email'] ?></p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>cliente/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Cliente
          </button>
        </div>
      </form>
    </div>
  </div>
</div> 
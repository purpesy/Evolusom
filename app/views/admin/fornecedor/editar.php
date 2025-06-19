<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Fornecedor #<?= $fornecedor['id_fornecedor'] ?></h4>
          <p class="card-description">Atualizar informações do fornecedor</p>
        </div>
        <a href="<?= URL_BASE ?>fornecedor/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Fornecedor
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>fornecedor/atualizar" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_fornecedor" value="<?= $fornecedor['id_fornecedor'] ?>">
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="fornecedor_nome">Nome/Razão Social</label>
              <input type="text" class="form-control" id="fornecedor_nome" name="fornecedor_nome" value="<?= $fornecedor['fornecedor_nome'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="fornecedor_cnpj">CNPJ</label>
              <input type="text" class="form-control" id="fornecedor_cnpj" name="fornecedor_cnpj" value="<?= $fornecedor['fornecedor_cnpj'] ?>" maxlength="18" required>
              <small class="form-text text-muted">Formato: 00.000.000/0000-00</small>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fornecedor_telefone">Telefone</label>
              <input type="tel" class="form-control" id="fornecedor_telefone" name="fornecedor_telefone" value="<?= $fornecedor['fornecedor_telefone'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="fornecedor_email">Email</label>
              <input type="email" class="form-control" id="fornecedor_email" name="fornecedor_email" value="<?= $fornecedor['fornecedor_email'] ?>" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="fornecedor_endereco">Endereço Completo</label>
              <textarea class="form-control" id="fornecedor_endereco" name="fornecedor_endereco" rows="3" required><?= $fornecedor['fornecedor_endereco'] ?></textarea>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Fornecedor
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nome Atual:</strong> <?= $fornecedor['fornecedor_nome'] ?></p>
                <p><strong>CNPJ Atual:</strong> <?= $fornecedor['fornecedor_cnpj'] ?></p>
                <p><strong>Telefone Atual:</strong> <?= $fornecedor['fornecedor_telefone'] ?></p>
              </div>
              <div class="col-md-6">
                <p><strong>Email Atual:</strong> <?= $fornecedor['fornecedor_email'] ?></p>
                <p><strong>Endereço Atual:</strong> <?= substr($fornecedor['fornecedor_endereco'], 0, 80) ?>...</p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>fornecedor/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Fornecedor
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function mascaraCNPJ(campo) {
    let valor = campo.value.replace(/\D/g, '');
    
    if (valor.length <= 14) {
        valor = valor.replace(/(\d{2})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1/$2');
        valor = valor.replace(/(\d{4})(\d{1,2})$/, '$1-$2');
    }
    
    campo.value = valor;
}

function validarCNPJ(cnpj) {
    // Remove formatação
    cnpj = cnpj.replace(/[^\d]+/g,'');
    
    // Apenas verifica se tem 14 dígitos (simplificado para testes)
    return cnpj.length == 14;
}

function validarFormulario() {
    const cnpj = document.getElementById('fornecedor_cnpj').value;
    const nome = document.getElementById('fornecedor_nome').value.trim();
    const email = document.getElementById('fornecedor_email').value.trim();
    const telefone = document.getElementById('fornecedor_telefone').value.trim();
    const endereco = document.getElementById('fornecedor_endereco').value.trim();
    
    // Validações básicas
    if (!nome) {
        alert('Por favor, preencha o nome do fornecedor.');
        document.getElementById('fornecedor_nome').focus();
        return false;
    }
    
    if (!email) {
        alert('Por favor, preencha o email do fornecedor.');
        document.getElementById('fornecedor_email').focus();
        return false;
    }
    
    if (!telefone) {
        alert('Por favor, preencha o telefone do fornecedor.');
        document.getElementById('fornecedor_telefone').focus();
        return false;
    }
    
    if (!endereco) {
        alert('Por favor, preencha o endereço do fornecedor.');
        document.getElementById('fornecedor_endereco').focus();
        return false;
    }
    
    // Validação simplificada de CNPJ (apenas 14 dígitos)
    if (cnpj) {
        const cnpjLimpo = cnpj.replace(/\D/g, '');
        if (cnpjLimpo.length != 14) {
            alert('CNPJ deve ter 14 dígitos!');
            document.getElementById('fornecedor_cnpj').focus();
            return false;
        }
    } else {
        alert('Por favor, preencha o CNPJ do fornecedor.');
        document.getElementById('fornecedor_cnpj').focus();
        return false;
    }
    
    return true;
}

// Aplica máscara ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('fornecedor_cnpj');
    
    // Aplica máscara no valor existente
    mascaraCNPJ(cnpjInput);
    
    // Aplica máscara ao digitar
    cnpjInput.addEventListener('input', function() {
        mascaraCNPJ(this);
    });
    
    // Feedback visual simplificado
    cnpjInput.addEventListener('blur', function() {
        const valor = this.value.replace(/\D/g, '');
        if (valor.length == 14) {
            this.style.borderColor = '#28a745';
            this.title = 'CNPJ completo (14 dígitos)';
        } else if (valor.length > 0) {
            this.style.borderColor = '#ffc107';
            this.title = 'CNPJ incompleto';
        } else {
            this.style.borderColor = '';
            this.title = '';
        }
    });
});
</script> 
<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Fornecedor</h4>
      <p class="card-description">Cadastrar um novo fornecedor no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>fornecedor/cadastrar" onsubmit="return validarFormulario()">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="fornecedor_nome">Nome/Razão Social</label>
              <input type="text" class="form-control" id="fornecedor_nome" name="fornecedor_nome" placeholder="Ex: Som & Cia Ltda" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="fornecedor_cnpj">CNPJ</label>
              <input type="text" class="form-control" id="fornecedor_cnpj" name="fornecedor_cnpj" placeholder="00.000.000/0000-00" maxlength="18" required>
              <small class="form-text text-muted">Formato: 00.000.000/0000-00</small>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="fornecedor_telefone">Telefone</label>
              <input type="tel" class="form-control" id="fornecedor_telefone" name="fornecedor_telefone" placeholder="(11) 3333-4444" required pattern="^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$" maxlength="15">
              <small class="form-text text-muted">Formato: (11) 99999-9999</small>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="fornecedor_email">Email</label>
              <input type="email" class="form-control" id="fornecedor_email" name="fornecedor_email" placeholder="contato@fornecedor.com" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="fornecedor_endereco">Endereço Completo</label>
              <textarea class="form-control" id="fornecedor_endereco" name="fornecedor_endereco" rows="3" placeholder="Rua, número, bairro, cidade, CEP..." required></textarea>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>fornecedor/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Fornecedor
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

function validarTelefoneBR(telefone) {
    const regex = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return regex.test(telefone);
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
    
    if (!validarTelefoneBR(telefone)) {
        alert('Por favor, insira um telefone válido no formato (11) 99999-9999 ou (11) 9999-9999.');
        document.getElementById('fornecedor_telefone').focus();
        return false;
    }
    
    return true;
}

// Aplica máscara ao digitar
document.addEventListener('DOMContentLoaded', function() {
    const cnpjInput = document.getElementById('fornecedor_cnpj');
    
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

// Máscara ao digitar
const telInput = document.getElementById('fornecedor_telefone');
telInput.addEventListener('input', function (e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});
</script> 
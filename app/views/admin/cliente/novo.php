<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Cliente</h4>
      <p class="card-description">Cadastrar um novo cliente no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>cliente/cadastrar" onsubmit="return validarFormulario()">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_nome">Nome Completo</label>
              <input type="text" class="form-control" id="cliente_nome" name="cliente_nome" placeholder="Ex: João Silva" required>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_cpf">CPF</label>
              <input type="text" class="form-control" id="cliente_cpf" name="cliente_cpf" placeholder="000.000.000-00" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_telefone">Telefone</label>
              <input type="tel" class="form-control" id="cliente_telefone" name="cliente_telefone" placeholder="(11) 99999-9999" required pattern="^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$" maxlength="15">
              <small class="form-text text-muted">Formato: (11) 99999-9999</small>
            </div>
          </div>
          
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_email">Email</label>
              <input type="email" class="form-control" id="cliente_email" name="cliente_email" placeholder="cliente@email.com" required>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="cliente_senha">Senha</label>
              <input type="password" class="form-control" id="cliente_senha" name="cliente_senha" placeholder="Mínimo 6 caracteres" minlength="6" required>
              <small class="form-text text-muted">A senha deve ter no mínimo 6 caracteres</small>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>cliente/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Cliente
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function validarTelefoneBR(telefone) {
    const regex = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return regex.test(telefone);
}

function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

function validarCPF(cpf) {
    // Remove caracteres não numéricos
    cpf = cpf.replace(/\D/g, '');
    
    // Verifica se tem 11 dígitos
    if (cpf.length !== 11) return false;
    
    // Verifica se todos os dígitos são iguais
    if (/^(\d)\1{10}$/.test(cpf)) return false;
    
    return true; // Validação básica - em produção usar validação completa
}

function validarFormulario() {
    const nome = document.getElementById('cliente_nome').value.trim();
    const cpf = document.getElementById('cliente_cpf').value.trim();
    const tel = document.getElementById('cliente_telefone').value.trim();
    const email = document.getElementById('cliente_email').value.trim();
    const senha = document.getElementById('cliente_senha').value;
    
    // Validar nome
    if (!nome || nome.length < 2) {
        alert('Por favor, insira um nome válido (mínimo 2 caracteres).');
        document.getElementById('cliente_nome').focus();
        return false;
    }
    
    // Validar CPF
    if (!validarCPF(cpf)) {
        alert('Por favor, insira um CPF válido.');
        document.getElementById('cliente_cpf').focus();
        return false;
    }
    
    // Validar telefone
    if (!validarTelefoneBR(tel)) {
        alert('Por favor, insira um telefone válido no formato (11) 99999-9999.');
        document.getElementById('cliente_telefone').focus();
        return false;
    }
    
    // Validar email
    if (!validarEmail(email)) {
        alert('Por favor, insira um email válido.');
        document.getElementById('cliente_email').focus();
        return false;
    }
    
    // Validar senha
    if (!senha || senha.length < 6) {
        alert('A senha deve ter no mínimo 6 caracteres.');
        document.getElementById('cliente_senha').focus();
        return false;
    }
    
    return true;
}

// Configurar máscaras e validações quando a página carregar
document.addEventListener('DOMContentLoaded', function() {
    // Máscara para telefone
    const telInput = document.getElementById('cliente_telefone');
    telInput.addEventListener('input', function (e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
        e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
    });
    
    // Máscara para CPF
    const cpfInput = document.getElementById('cliente_cpf');
    cpfInput.addEventListener('input', function (e) {
        let x = e.target.value.replace(/\D/g, '').match(/(\d{0,3})(\d{0,3})(\d{0,3})(\d{0,2})/);
        e.target.value = !x[2] ? x[1] : x[1] + '.' + x[2] + (x[3] ? '.' + x[3] : '') + (x[4] ? '-' + x[4] : '');
    });
    
    // Feedback visual para campos válidos
    const campos = ['cliente_nome', 'cliente_cpf', 'cliente_telefone', 'cliente_email', 'cliente_senha'];
    campos.forEach(function(campoId) {
        const campo = document.getElementById(campoId);
        campo.addEventListener('blur', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#28a745';
            } else {
                this.style.borderColor = '#dc3545';
            }
        });
    });
});
</script> 
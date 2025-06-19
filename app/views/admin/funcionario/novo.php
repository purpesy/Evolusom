<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Funcionário</h4>
      <p class="card-description">Cadastrar um novo funcionário no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>funcionario/cadastrar" onsubmit="return validarFormulario()">
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="funcionario_nome">Nome Completo</label>
              <input type="text" class="form-control" id="funcionario_nome" name="funcionario_nome" placeholder="Ex: João Silva Santos" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_cpf">CPF</label>
              <input type="text" class="form-control" id="funcionario_cpf" name="funcionario_cpf" placeholder="000.000.000-00" maxlength="14" required>
              <small class="form-text text-muted">Formato: 000.000.000-00</small>
            </div>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_cargo">Cargo</label>
              <select class="form-control" id="funcionario_cargo" name="funcionario_cargo" required>
                <option value="">Selecione o cargo</option>
                <option value="Vendedor">Vendedor</option>
                <option value="Técnico">Técnico</option>
                <option value="Gerente">Gerente</option>
                <option value="Atendente">Atendente</option>
                <option value="Instalador">Instalador</option>
                <option value="Administrativo">Administrativo</option>
              </select>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_telefone">Telefone</label>
              <input type="tel" class="form-control" id="funcionario_telefone" name="funcionario_telefone" placeholder="(11) 99999-9999" required pattern="^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$" maxlength="15">
              <small class="form-text text-muted">Formato: (11) 99999-9999</small>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_email">Email</label>
              <input type="email" class="form-control" id="funcionario_email" name="funcionario_email" placeholder="funcionario@evolusom.com" required>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_senha">Senha</label>
              <input type="password" class="form-control" id="funcionario_senha" name="funcionario_senha" placeholder="Senha" required>
              <small class="form-text text-muted">A senha deve ter no mínimo 8 caracteres</small>
            </div>
          </div>
        </div>

        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>funcionario/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-primary">
            <i class="mdi mdi-content-save"></i> Cadastrar Funcionário
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
function mascaraCPF(campo) {
    let valor = campo.value.replace(/\D/g, '');
    
    if (valor.length <= 11) {
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d)/, '$1.$2');
        valor = valor.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    }
    
    campo.value = valor;
}

function validarTelefoneBR(telefone) {
    const regex = /^\(?\d{2}\)?[\s-]?\d{4,5}-?\d{4}$/;
    return regex.test(telefone);
}

function validarFormulario() {
    const nome = document.getElementById('funcionario_nome').value.trim();
    const cpf = document.getElementById('funcionario_cpf').value.trim();
    const cargo = document.getElementById('funcionario_cargo').value;
    const telefone = document.getElementById('funcionario_telefone').value.trim();
    const email = document.getElementById('funcionario_email').value.trim();
    const senha = document.getElementById('funcionario_senha').value.trim();

    if (!nome) {
        alert('Por favor, preencha o nome do funcionário.');
        document.getElementById('funcionario_nome').focus();
        return false;
    }
    
    if (!cpf) {
        alert('Por favor, preencha o CPF do funcionário.');
        document.getElementById('funcionario_cpf').focus();
        return false;
    }
    
    const cpfLimpo = cpf.replace(/\D/g, '');
    if (cpfLimpo.length != 11) {
        alert('CPF deve ter 11 dígitos!');
        document.getElementById('funcionario_cpf').focus();
        return false;
    }
    
    if (!cargo) {
        alert('Por favor, selecione o cargo do funcionário.');
        document.getElementById('funcionario_cargo').focus();
        return false;
    }
    
    if (!telefone) {
        alert('Por favor, preencha o telefone do funcionário.');
        document.getElementById('funcionario_telefone').focus();
        return false;
    }
    
    if (!email) {
        alert('Por favor, preencha o email do funcionário.');
        document.getElementById('funcionario_email').focus();
        return false;
    }

    if (!senha) {
        alert('Por favor, preencha a senha do funcionário.');
        document.getElementById('funcionario_senha').focus();
        return false;
    }

    if (!validarTelefoneBR(telefone)) {
        alert('Por favor, insira um telefone válido no formato (11) 99999-9999 ou (11) 9999-9999.');
        document.getElementById('funcionario_telefone').focus();
        return false;
    }

    return true;
}

// Aplica máscara ao digitar
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('funcionario_cpf');
    
    cpfInput.addEventListener('input', function() {
        mascaraCPF(this);
    });
    
    // Feedback visual simplificado
    cpfInput.addEventListener('blur', function() {
        const valor = this.value.replace(/\D/g, '');
        if (valor.length == 11) {
            this.style.borderColor = '#28a745';
            this.title = 'CPF completo (11 dígitos)';
        } else if (valor.length > 0) {
            this.style.borderColor = '#ffc107';
            this.title = 'CPF incompleto';
        } else {
            this.style.borderColor = '';
            this.title = '';
        }
    });
});

// Máscara ao digitar
const telInput = document.getElementById('funcionario_telefone');
telInput.addEventListener('input', function (e) {
    let x = e.target.value.replace(/\D/g, '').match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
    e.target.value = !x[2] ? x[1] : '(' + x[1] + ') ' + x[2] + (x[3] ? '-' + x[3] : '');
});
</script> 
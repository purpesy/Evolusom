<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
          <h4 class="card-title">Editar Funcionário #<?= $funcionario['id_funcionario'] ?></h4>
          <p class="card-description">Atualizar informações do funcionário</p>
        </div>
        <a href="<?= URL_BASE ?>funcionario/novo" class="btn btn-gradient-primary btn-sm">
          <i class="mdi mdi-plus"></i> Novo Funcionário
        </a>
      </div>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>funcionario/atualizar" onsubmit="return validarFormulario()">
        <input type="hidden" name="id_funcionario" value="<?= $funcionario['id_funcionario'] ?>">
        
        <div class="row">
          <div class="col-md-8">
            <div class="form-group">
              <label for="funcionario_nome">Nome Completo</label>
              <input type="text" class="form-control" id="funcionario_nome" name="funcionario_nome" value="<?= $funcionario['funcionario_nome'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_cpf">CPF</label>
              <input type="text" class="form-control" id="funcionario_cpf" name="funcionario_cpf" value="<?= $funcionario['funcionario_cpf'] ?>" maxlength="14" required>
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
                <option value="Vendedor" <?= $funcionario['funcionario_cargo'] == 'Vendedor' ? 'selected' : '' ?>>Vendedor</option>
                <option value="Técnico" <?= $funcionario['funcionario_cargo'] == 'Técnico' ? 'selected' : '' ?>>Técnico</option>
                <option value="Gerente" <?= $funcionario['funcionario_cargo'] == 'Gerente' ? 'selected' : '' ?>>Gerente</option>
                <option value="Atendente" <?= $funcionario['funcionario_cargo'] == 'Atendente' ? 'selected' : '' ?>>Atendente</option>
                <option value="Instalador" <?= $funcionario['funcionario_cargo'] == 'Instalador' ? 'selected' : '' ?>>Instalador</option>
                <option value="Administrativo" <?= $funcionario['funcionario_cargo'] == 'Administrativo' ? 'selected' : '' ?>>Administrativo</option>
              </select>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_telefone">Telefone</label>
              <input type="tel" class="form-control" id="funcionario_telefone" name="funcionario_telefone" value="<?= $funcionario['funcionario_telefone'] ?>" required>
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="funcionario_email">Email</label>
              <input type="email" class="form-control" id="funcionario_email" name="funcionario_email" value="<?= $funcionario['funcionario_email'] ?>" required>
            </div>
          </div>
        </div>
        
        <!-- Informações Atuais -->
        <div class="card mb-3" style="border: 1px solid #dee2e6; background-color: #f8f9fa;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-information-outline text-info"></i> Informações Atuais do Funcionário
            </h5>
            <div class="row">
              <div class="col-md-6">
                <p><strong>Nome Atual:</strong> <?= $funcionario['funcionario_nome'] ?></p>
                <p><strong>CPF Atual:</strong> <?= $funcionario['funcionario_cpf'] ?></p>
                <p><strong>Cargo Atual:</strong> <span class="badge badge-success"><?= $funcionario['funcionario_cargo'] ?></span></p>
              </div>
              <div class="col-md-6">
                <p><strong>Telefone Atual:</strong> <?= $funcionario['funcionario_telefone'] ?></p>
                <p><strong>Email Atual:</strong> <?= $funcionario['funcionario_email'] ?></p>
              </div>
            </div>
          </div>
        </div>
        
        <div class="d-flex justify-content-between">
          <a href="<?= URL_BASE ?>funcionario/listar" class="btn btn-light">
            <i class="mdi mdi-arrow-left"></i> Voltar
          </a>
          <button type="submit" class="btn btn-gradient-success">
            <i class="mdi mdi-content-save"></i> Atualizar Funcionário
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

function validarFormulario() {
    const nome = document.getElementById('funcionario_nome').value.trim();
    const cpf = document.getElementById('funcionario_cpf').value.trim();
    const cargo = document.getElementById('funcionario_cargo').value;
    const telefone = document.getElementById('funcionario_telefone').value.trim();
    const email = document.getElementById('funcionario_email').value.trim();
    
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
    
    return true;
}

// Aplica máscara ao carregar a página
document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('funcionario_cpf');
    
    // Aplica máscara no valor existente
    mascaraCPF(cpfInput);
    
    // Aplica máscara ao digitar
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
</script> 
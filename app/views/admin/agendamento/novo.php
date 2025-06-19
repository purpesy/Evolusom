<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Agendamento</h4>
      <p class="card-description">Agendar um novo serviço para cliente</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>agendamento/cadastrar" onsubmit="return validarFormulario()">
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
              <option value="">Selecione um cliente</option>
              <?php if (!empty($clientes)): ?>
                <?php foreach ($clientes as $cliente): ?>
                  <option value="<?= $cliente['id_cliente'] ?>">
                    <?= htmlspecialchars($cliente['cliente_nome']) ?>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label for="agendamento_data">Data e Hora</label>
            <input type="datetime-local" class="form-control" id="agendamento_data" name="agendamento_data" required>
          </div>
        </div>

        <div class="form-group">
          <label for="agendamento_observacoes">Observações do Serviço</label>
          <textarea class="form-control" id="agendamento_observacoes" name="agendamento_observacoes" rows="4" placeholder="Descreva o serviço a ser realizado, endereço de instalação, equipamentos envolvidos, etc." required></textarea>
        </div>

        <div class="form-group">
          <label for="status_agendamento">Status</label>
          <select class="form-control" id="status_agendamento" name="status_agendamento" required>
            <option value="Pendente" selected>Pendente</option>
            <option value="Ativa">Ativa</option>
            <option value="Finalizada">Finalizada</option>
            <option value="Cancelada">Cancelada</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary me-2">Agendar</button>
        <button type="reset" class="btn btn-light">Cancelar</button>
      </form>
    </div>
  </div>
</div>

<script>
function validarFormulario() {
    const cliente = document.getElementById('id_cliente');
    const data = document.getElementById('agendamento_data');
    const observacoes = document.getElementById('agendamento_observacoes');
    const status = document.getElementById('status_agendamento');
    
    let valido = true;
    if (!cliente.value) {
        alert('Por favor, selecione um cliente.');
        cliente.focus();
        valido = false;
    }
    if (!data.value) {
        alert('Por favor, selecione a data e hora do agendamento.');
        data.focus();
        valido = false;
    } else {
        const dataAgendamento = new Date(data.value);
        const agora = new Date();
        if (dataAgendamento <= agora) {
            alert('A data do agendamento deve ser no futuro!');
            data.focus();
            valido = false;
        }
    }
    if (!observacoes.value.trim() || observacoes.value.trim().length < 10) {
        alert('Por favor, descreva o serviço a ser realizado (mínimo 10 caracteres).');
        observacoes.focus();
        valido = false;
    }
    if (!status.value) {
        alert('Por favor, selecione o status do agendamento.');
        status.focus();
        valido = false;
    }
    return valido;
}
</script> 
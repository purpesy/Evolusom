<?php
// Espera-se que $vendas, $data_inicio e $data_fim venham do controller (opcionais)
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Relatório de Vendas</h4>
      <p class="card-description">Gerar relatório de vendas por período</p>

      <!-- Filtros -->
      <form method="POST" action="<?= URL_BASE ?>venda/relatoriovendas" class="mb-4">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="data_inicio">Data Início</label>
              <input type="date" class="form-control" id="data_inicio" name="data_inicio" 
                     value="<?= isset($data_inicio) ? $data_inicio : '' ?>" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="data_fim">Data Fim</label>
              <input type="date" class="form-control" id="data_fim" name="data_fim" 
                     value="<?= isset($data_fim) ? $data_fim : '' ?>" required>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>&nbsp;</label>
              <div>
                <button type="submit" class="btn btn-primary">
                  <i class="mdi mdi-magnify"></i> Gerar Relatório
                </button>
                <a href="<?= URL_BASE ?>venda/listar" class="btn btn-light">
                  <i class="mdi mdi-arrow-left"></i> Voltar
                </a>
              </div>
            </div>
          </div>
        </div>
      </form>

      <?php if (isset($vendas)): ?>
        <!-- Resumo do Relatório -->
        <div class="row mb-4">
          <div class="col-md-3">
            <div class="card bg-gradient-primary text-white">
              <div class="card-body">
                <h5 class="card-title">Total de Vendas</h5>
                <h3><?= count($vendas) ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-gradient-success text-white">
              <div class="card-body">
                <h5 class="card-title">Valor Total</h5>
                <h3>R$ <?= number_format(array_sum(array_column($vendas, 'venda_valor')), 2, ',', '.') ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-gradient-warning text-white">
              <div class="card-body">
                <h5 class="card-title">Aprovadas</h5>
                <h3><?= count(array_filter($vendas, function($v) { return $v['status_pagamento'] == 'Aprovado'; })) ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card bg-gradient-info text-white">
              <div class="card-body">
                <h5 class="card-title">Pendentes</h5>
                <h3><?= count(array_filter($vendas, function($v) { return $v['status_pagamento'] == 'Pendente'; })) ?></h3>
              </div>
            </div>
          </div>
        </div>

        <?php if (!empty($vendas)): ?>
          <!-- Tabela de Vendas -->
          <div class="card">
            <div class="card-body">
              <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="card-title mb-0">
                  Vendas de <?= date('d/m/Y', strtotime($data_inicio)) ?> até <?= date('d/m/Y', strtotime($data_fim)) ?>
                </h6>
                <button type="button" class="btn btn-success btn-sm" onclick="exportarExcel()">
                  <i class="mdi mdi-file-excel"></i> Exportar Excel
                </button>
              </div>

              <div class="table-responsive">
                <table class="table table-striped" id="tabela-relatorio">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Data</th>
                      <th>Pedido</th>
                      <th>Cliente</th>
                      <th>Funcionário</th>
                      <th>Forma Pagamento</th>
                      <th>Status</th>
                      <th>Valor</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($vendas as $venda): ?>
                      <tr>
                        <td>#<?= $venda['id_venda'] ?></td>
                        <td><?= date('d/m/Y', strtotime($venda['venda_data'])) ?></td>
                        <td>Pedido #<?= $venda['id_pedido'] ?></td>
                        <td><?= htmlspecialchars($venda['cliente_nome']) ?></td>
                        <td><?= htmlspecialchars($venda['funcionario_nome']) ?></td>
                        <td><?= htmlspecialchars($venda['forma_pagamento']) ?></td>
                        <td>
                          <span class="badge badge-<?= 
                            $venda['status_pagamento'] == 'Aprovado' ? 'success' : 
                            ($venda['status_pagamento'] == 'Pendente' ? 'warning' : 'danger') 
                          ?>">
                            <?= $venda['status_pagamento'] ?>
                          </span>
                        </td>
                        <td>R$ <?= number_format($venda['venda_valor'], 2, ',', '.') ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                  <tfoot>
                    <tr class="table-active">
                      <td colspan="7" class="text-right"><strong>Total:</strong></td>
                      <td><strong>R$ <?= number_format(array_sum(array_column($vendas, 'venda_valor')), 2, ',', '.') ?></strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>

          <!-- Gráfico por Forma de Pagamento -->
          <div class="row mt-4">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Vendas por Forma de Pagamento</h6>
                  <canvas id="grafico-pagamento"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h6 class="card-title">Vendas por Status</h6>
                  <canvas id="grafico-status"></canvas>
                </div>
              </div>
            </div>
          </div>

        <?php else: ?>
          <div class="alert alert-info">
            <i class="mdi mdi-information"></i> Nenhuma venda encontrada no período selecionado.
          </div>
        <?php endif; ?>

      <?php endif; ?>
    </div>
  </div>
</div>

<script>
function exportarExcel() {
    // Simples exportação para Excel usando JavaScript
    const tabela = document.getElementById('tabela-relatorio');
    const dadosTabela = [];
    
    // Cabeçalhos
    const cabecalhos = [];
    tabela.querySelectorAll('thead th').forEach(th => {
        cabecalhos.push(th.textContent.trim());
    });
    dadosTabela.push(cabecalhos);
    
    // Dados
    tabela.querySelectorAll('tbody tr').forEach(tr => {
        const linha = [];
        tr.querySelectorAll('td').forEach(td => {
            linha.push(td.textContent.trim());
        });
        dadosTabela.push(linha);
    });
    
    // Converter para CSV
    const csv = dadosTabela.map(linha => linha.join(';')).join('\n');
    
    // Download
    const blob = new Blob([csv], { type: 'text/csv;charset=utf-8;' });
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = 'relatorio_vendas_<?= date('Y-m-d') ?>.csv';
    link.click();
}

// Definir data padrão para o mês atual
document.addEventListener('DOMContentLoaded', function() {
    const dataInicio = document.getElementById('data_inicio');
    const dataFim = document.getElementById('data_fim');
    
    if (!dataInicio.value) {
        const hoje = new Date();
        const primeiroDia = new Date(hoje.getFullYear(), hoje.getMonth(), 1);
        dataInicio.value = primeiroDia.toISOString().split('T')[0];
    }
    
    if (!dataFim.value) {
        const hoje = new Date();
        dataFim.value = hoje.toISOString().split('T')[0];
    }
});

<?php if (isset($vendas) && !empty($vendas)): ?>
// Dados para gráficos
const formasPagamento = {};
const statusPagamento = {};

<?php foreach ($vendas as $venda): ?>
    // Contar formas de pagamento
    const forma = '<?= addslashes($venda['forma_pagamento']) ?>';
    formasPagamento[forma] = (formasPagamento[forma] || 0) + 1;
    
    // Contar status
    const status = '<?= addslashes($venda['status_pagamento']) ?>';
    statusPagamento[status] = (statusPagamento[status] || 0) + 1;
<?php endforeach; ?>

// Gráfico de formas de pagamento (se você tiver Chart.js)
// const ctxPagamento = document.getElementById('grafico-pagamento').getContext('2d');
// ... implementar gráficos se necessário

<?php endif; ?>
</script>

<style>
.card {
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    border: none;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #007bff, #0056b3);
}

.bg-gradient-success {
    background: linear-gradient(45deg, #28a745, #1e7e34);
}

.bg-gradient-warning {
    background: linear-gradient(45deg, #ffc107, #d39e00);
}

.bg-gradient-info {
    background: linear-gradient(45deg, #17a2b8, #117a8b);
}

.table th, .table td {
    vertical-align: middle;
}

.badge {
    padding: 0.5em 0.8em;
    font-size: 0.85em;
}
</style> 
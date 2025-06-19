<div class="col-lg-12 grid-margin stretch-card">
  <div class="container-formulario-evolusom animacao-aparecer-evolusom">
    <div class="cabecalho-formulario-evolusom">
      <h4 class="titulo-formulario-evolusom">Lista de Agendamentos</h4>
      <p class="subtitulo-formulario-evolusom">Gerenciar todos os agendamentos de serviços</p>
    </div>
    
    <div class="botoes-acao-evolusom espacamento-inferior-evolusom">
      <div class="grupo-botoes-evolusom">
        <a href="<?= URL_BASE ?>agendamento/novo" class="botao-evolusom-principal">
          <i class="mdi mdi-calendar-plus"></i> Novo Agendamento
        </a>
      </div>
      <div class="grupo-botoes-evolusom">
        <button onclick="atualizarTabela()" class="botao-evolusom-contorno botao-evolusom-pequeno">
          <i class="mdi mdi-refresh"></i> Atualizar
        </button>
      </div>
    </div>
    
    <div class="table-responsive sombra-suave-evolusom" style="border-radius: 12px; overflow: hidden;">
      <table class="table table-hover" style="margin-bottom: 0;">
        <thead style="background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%); color: white;">
          <tr>
            <th style="border: none; padding: 16px; font-weight: 700;">Data/Hora</th>
            <th style="border: none; padding: 16px; font-weight: 700;">Cliente</th>
            <th style="border: none; padding: 16px; font-weight: 700;">Observações</th>
            <th style="border: none; padding: 16px; font-weight: 700;">Status</th>
            <th style="border: none; padding: 16px; font-weight: 700; text-align: center;">Ações</th>
          </tr>
        </thead>

        <tbody>
          <?php if (!empty($agendamento)): ?>
            <?php foreach ($agendamento as $linha): ?>
              <tr style="transition: all 0.3s ease;" onmouseover="this.style.backgroundColor='#f8f9ff'" onmouseout="this.style.backgroundColor=''">
                <td style="padding: 16px; border-bottom: 1px solid #e8eaf6;">
                  <div class="etiqueta-info-evolusom" style="font-size: 0.9rem;">
                    <i class="mdi mdi-calendar-clock"></i>
                    <?= date('d/m/Y H:i', strtotime($linha['agendamento_data'])) ?>
                  </div>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid #e8eaf6;">
                  <div style="font-weight: 700; color: #1a237e; margin-bottom: 4px;">
                    <?= $linha['cliente_nome'] ?>
                  </div>
                  <div style="font-size: 0.85rem; color: #757575;">
                    <i class="mdi mdi-phone"></i> <?= $linha['cliente_telefone'] ?>
                  </div>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid #e8eaf6;">
                  <div style="color: #424242; line-height: 1.4;">
                    <?= substr($linha['agendamento_observacoes'], 0, 60) ?><?= strlen($linha['agendamento_observacoes']) > 60 ? '...' : '' ?>
                  </div>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid #e8eaf6;">
                  <?php if ($linha['status_agendamento'] == 'Ativa'): ?>
                    <span class="etiqueta-sucesso-evolusom">
                      <i class="mdi mdi-check-circle"></i> Ativa
                    </span>
                  <?php elseif ($linha['status_agendamento'] == 'Pendente'): ?>
                    <span class="etiqueta-aviso-evolusom">
                      <i class="mdi mdi-clock-outline"></i> Pendente
                    </span>
                  <?php elseif ($linha['status_agendamento'] == 'Cancelada'): ?>
                    <span class="etiqueta-perigo-evolusom">
                      <i class="mdi mdi-close-circle"></i> Cancelada
                    </span>
                  <?php else: ?>
                    <span class="etiqueta-alerta-evolusom">
                      <i class="mdi mdi-check"></i> Finalizada
                    </span>
                  <?php endif; ?>
                </td>
                <td style="padding: 16px; border-bottom: 1px solid #e8eaf6; text-align: center;">
                  <div class="grupo-botoes-evolusom" style="gap: 8px;">
                    <a href="<?= URL_BASE ?>agendamento/editar/<?= $linha['id_agendamento'] ?>" 
                       class="botao-evolusom-destaque botao-evolusom-pequeno" 
                       title="Editar agendamento"
                       style="padding: 6px 12px;">
                      <i class="mdi mdi-pencil"></i>
                    </a>
                    <a href="<?= URL_BASE ?>agendamento/excluir/<?= $linha['id_agendamento'] ?>" 
                       class="botao-evolusom-contorno botao-evolusom-pequeno" 
                       onclick="return confirmarExclusao('<?= $linha['cliente_nome'] ?>')" 
                       title="Excluir agendamento"
                       style="padding: 6px 12px; border-color: #c62828; color: #c62828;">
                      <i class="mdi mdi-delete"></i>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" style="padding: 40px; text-align: center; border-bottom: none;">
                <div style="color: #757575; font-size: 1.1rem;">
                  <i class="mdi mdi-calendar-remove" style="font-size: 3rem; color: #e0e0e0; display: block; margin-bottom: 16px;"></i>
                  <strong>Nenhum agendamento encontrado</strong>
                  <br>
                  <small style="margin-top: 8px; display: block;">
                    Clique em "Novo Agendamento" para criar o primeiro agendamento
                  </small>
                </div>
              </td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
    
    <!-- Estatísticas rápidas -->
    <?php if (!empty($agendamento)): ?>
    <div class="linha-quartos-evolusom espacamento-superior-evolusom">
      <div class="cartao-informacao-evolusom">
        <div class="cabecalho-cartao-evolusom">
          <div class="icone-cartao-evolusom" style="background: linear-gradient(135deg, #ff9800 0%, #ffc107 100%);">
            <i class="mdi mdi-clock-outline"></i>
          </div>
          <h5 class="titulo-cartao-evolusom">Pendentes</h5>
        </div>
        <div class="item-informacao-evolusom">
          <span class="rotulo-informacao-evolusom">Total:</span>
          <span class="valor-informacao-evolusom">
            <?php 
            $pendentes = array_filter($agendamento, function($a) { return $a['status_agendamento'] == 'Pendente'; });
            echo count($pendentes);
            ?>
          </span>
        </div>
      </div>
      
      <div class="cartao-informacao-evolusom">
        <div class="cabecalho-cartao-evolusom">
          <div class="icone-cartao-evolusom" style="background: linear-gradient(135deg, #2e7d32 0%, #4caf50 100%);">
            <i class="mdi mdi-check-circle"></i>
          </div>
          <h5 class="titulo-cartao-evolusom">Agendamentos Ativos</h5>
        </div>
        <div class="item-informacao-evolusom">
          <span class="rotulo-informacao-evolusom">Total:</span>
          <span class="valor-informacao-evolusom">
            <?php 
            $ativos = array_filter($agendamento, function($a) { return $a['status_agendamento'] == 'Ativa'; });
            echo count($ativos);
            ?>
          </span>
        </div>
      </div>
      
      <div class="cartao-informacao-evolusom">
        <div class="cabecalho-cartao-evolusom">
          <div class="icone-cartao-evolusom" style="background: linear-gradient(135deg, #f57c00 0%, #ff9800 100%);">
            <i class="mdi mdi-check"></i>
          </div>
          <h5 class="titulo-cartao-evolusom">Finalizados</h5>
        </div>
        <div class="item-informacao-evolusom">
          <span class="rotulo-informacao-evolusom">Total:</span>
          <span class="valor-informacao-evolusom">
            <?php 
            $finalizados = array_filter($agendamento, function($a) { return $a['status_agendamento'] == 'Finalizada'; });
            echo count($finalizados);
            ?>
          </span>
        </div>
      </div>
      
      <div class="cartao-informacao-evolusom">
        <div class="cabecalho-cartao-evolusom">
          <div class="icone-cartao-evolusom" style="background: linear-gradient(135deg, #d32f2f 0%, #f44336 100%);">
            <i class="mdi mdi-close-circle"></i>
          </div>
          <h5 class="titulo-cartao-evolusom">Cancelados</h5>
        </div>
        <div class="item-informacao-evolusom">
          <span class="rotulo-informacao-evolusom">Total:</span>
          <span class="valor-informacao-evolusom">
            <?php 
            $cancelados = array_filter($agendamento, function($a) { return $a['status_agendamento'] == 'Cancelada'; });
            echo count($cancelados);
            ?>
          </span>
        </div>
      </div>
    </div>
    <?php endif; ?>
  </div>
</div>

<style>
.container-formulario-evolusom {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
}

.cabecalho-formulario-evolusom {
    margin-bottom: 24px;
}

.titulo-formulario-evolusom {
    color: #1a237e;
    font-size: 1.5rem;
    font-weight: 600;
    margin: 0;
}

.subtitulo-formulario-evolusom {
    color: #757575;
    margin: 8px 0 0;
}

.botoes-acao-evolusom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
}

.grupo-botoes-evolusom {
    display: flex;
    gap: 12px;
}

.botao-evolusom-principal {
    background: linear-gradient(135deg, #1a237e 0%, #3f51b5 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 6px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.botao-evolusom-principal:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(26, 35, 126, 0.2);
    color: white;
}

.botao-evolusom-contorno {
    background: white;
    border: 1px solid #e0e0e0;
    color: #424242;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
}

.botao-evolusom-contorno:hover {
    background: #f5f5f5;
    border-color: #bdbdbd;
}

.botao-evolusom-pequeno {
    padding: 6px 12px;
    font-size: 0.9rem;
}

.etiqueta-sucesso-evolusom {
    background: #e8f5e9;
    color: #2e7d32;
    padding: 6px 12px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.9rem;
}

.etiqueta-perigo-evolusom {
    background: #ffebee;
    color: #c62828;
    padding: 6px 12px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.9rem;
}

.etiqueta-alerta-evolusom {
    background: #fff3e0;
    color: #f57c00;
    padding: 6px 12px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.9rem;
}

.etiqueta-aviso-evolusom {
    background: #fff9c4;
    color: #f57c00;
    padding: 6px 12px;
    border-radius: 4px;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.9rem;
}

.linha-tercos-evolusom {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 32px;
}

.linha-quartos-evolusom {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-top: 32px;
}

.cartao-informacao-evolusom {
    background: white;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}

.cabecalho-cartao-evolusom {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.icone-cartao-evolusom {
    width: 40px;
    height: 40px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.titulo-cartao-evolusom {
    margin: 0;
    font-size: 1rem;
    color: #424242;
    font-weight: 600;
}

.item-informacao-evolusom {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.rotulo-informacao-evolusom {
    color: #757575;
    font-size: 0.9rem;
}

.valor-informacao-evolusom {
    color: #1a237e;
    font-size: 1.2rem;
    font-weight: 600;
}

.animacao-aparecer-evolusom {
    animation: aparecer 0.6s ease-out;
}

@keyframes aparecer {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .linha-tercos-evolusom {
        grid-template-columns: 1fr;
    }
    
    .botoes-acao-evolusom {
        flex-direction: column;
        gap: 12px;
    }
    
    .grupo-botoes-evolusom {
        width: 100%;
    }
    
    .botao-evolusom-principal,
    .botao-evolusom-contorno {
        width: 100%;
        justify-content: center;
    }
}
</style>

<script>
function confirmarExclusao(nomeCliente) {
    return confirm(`Deseja realmente excluir o agendamento do cliente "${nomeCliente}"?\n\nEsta ação não poderá ser desfeita.`);
}

function atualizarTabela() {
    location.reload();
}

// Animação suave ao carregar
document.addEventListener('DOMContentLoaded', function() {
    const tabela = document.querySelector('.table-responsive');
    tabela.style.opacity = '0';
    tabela.style.transform = 'translateY(20px)';
    
    setTimeout(() => {
        tabela.style.transition = 'all 0.6s ease';
        tabela.style.opacity = '1';
        tabela.style.transform = 'translateY(0)';
    }, 200);
});
</script>
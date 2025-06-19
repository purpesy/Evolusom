<?php
// Espera-se que $clientes e $produtos venham do controller
?>

<div class="col-12 grid-margin stretch-card">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">Novo Pedido</h4>
      <p class="card-description">Cadastrar um novo pedido no sistema</p>

      <form class="forms-sample" method="POST" action="<?= URL_BASE ?>pedido/cadastrar">
        <div class="row">
          <div class="col-md-6 form-group">
            <label for="id_cliente">Cliente</label>
            <select class="form-control" id="id_cliente" name="id_cliente" required>
              <option value="">Selecione um cliente</option>
              <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id_cliente'] ?>">
                  <?= htmlspecialchars($cliente['cliente_nome']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col-md-6 form-group">
            <label for="pedido_data">Data do Pedido</label>
            <input type="datetime-local" class="form-control" id="pedido_data" name="pedido_data" value="<?= date('Y-m-d\TH:i') ?>" required>
          </div>
        </div>

        <!-- Seção de Produtos -->
        <div class="card mb-3" style="border: 1px solid #dee2e6;">
          <div class="card-body">
            <h5 class="card-title mb-3">
              <i class="mdi mdi-package-variant text-primary"></i> Produtos do Pedido
            </h5>
            
            <div id="produtos-container">
              <div class="produto-item mb-3" style="border: 1px solid #e0e0e0; padding: 15px; border-radius: 5px;">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label>Produto</label>
                      <select class="form-control produto-select" name="produtos[0][id_produto]" required>
                        <option value="">Selecione um produto</option>
                        <?php foreach ($produtos as $produto): ?>
                          <option value="<?= $produto['id_produto'] ?>" data-preco="<?= $produto['produto_preco'] ?>">
                            <?= htmlspecialchars($produto['produto_nome']) ?> - R$ <?= number_format($produto['produto_preco'], 2, ',', '.') ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Quantidade</label>
                      <input type="number" class="form-control quantidade-input" name="produtos[0][quantidade]" min="1" value="1" required>
                    </div>
                  </div>
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Preço Unit.</label>
                      <input type="number" step="0.01" class="form-control preco-input" name="produtos[0][preco_unitario]" placeholder="0,00" required>
                    </div>
                  </div>
                  
                  <div class="col-md-2">
                    <div class="form-group">
                      <label>Total</label>
                      <input type="text" class="form-control total-item" readonly placeholder="0,00">
                    </div>
                  </div>
                  
                  <div class="col-md-1">
                    <div class="form-group">
                      <label>&nbsp;</label>
                      <button type="button" class="btn btn-danger btn-sm remove-produto" style="width: 100%;">
                        <i class="mdi mdi-delete"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row mb-3">
              <div class="col-md-6">
                <button type="button" id="add-produto" class="btn btn-success">
                  <i class="mdi mdi-plus"></i> Adicionar Produto
                </button>
              </div>
              <div class="col-md-6 text-right">
                <h5>Total do Pedido: R$ <span id="total-pedido">0,00</span></h5>
              </div>
            </div>
          </div>
        </div>

        <button type="submit" class="btn btn-primary me-2">Cadastrar Pedido</button>
        <a href="<?= URL_BASE ?>pedido/listar" class="btn btn-light">Cancelar</a>
      </form>
    </div>
  </div>
</div>

<script>
let produtoIndex = 1;

// Função para calcular total de um item
function calcularTotalItem(produtoItem) {
    const quantidade = parseFloat(produtoItem.querySelector('.quantidade-input').value) || 0;
    const preco = parseFloat(produtoItem.querySelector('.preco-input').value) || 0;
    const total = quantidade * preco;
    
    produtoItem.querySelector('.total-item').value = total.toFixed(2).replace('.', ',');
    calcularTotalPedido();
}

// Função para calcular total do pedido
function calcularTotalPedido() {
    let totalPedido = 0;
    
    document.querySelectorAll('.produto-item').forEach(item => {
        const quantidade = parseFloat(item.querySelector('.quantidade-input').value) || 0;
        const preco = parseFloat(item.querySelector('.preco-input').value) || 0;
        totalPedido += (quantidade * preco);
    });
    
    document.getElementById('total-pedido').textContent = totalPedido.toFixed(2).replace('.', ',');
}

// Função para configurar eventos de um produto
function configurarEventosProduto(produtoItem) {
    const selectProduto = produtoItem.querySelector('.produto-select');
    const inputQuantidade = produtoItem.querySelector('.quantidade-input');
    const inputPreco = produtoItem.querySelector('.preco-input');
    const btnRemover = produtoItem.querySelector('.remove-produto');
    
    // Evento para preencher preço automaticamente
    selectProduto.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const preco = selectedOption.getAttribute('data-preco');
        if (preco) {
            inputPreco.value = preco;
            calcularTotalItem(produtoItem);
        }
    });
    
    // Eventos para recalcular quando quantidade ou preço mudam
    inputQuantidade.addEventListener('input', () => calcularTotalItem(produtoItem));
    inputPreco.addEventListener('input', () => calcularTotalItem(produtoItem));
    
    // Evento para remover produto
    btnRemover.addEventListener('click', function() {
        if (document.querySelectorAll('.produto-item').length > 1) {
            produtoItem.remove();
            calcularTotalPedido();
            renumerar();
        } else {
            alert('É necessário ter pelo menos um produto no pedido!');
        }
    });
}

// Função para renumerar os inputs
function renumerar() {
    document.querySelectorAll('.produto-item').forEach((item, index) => {
        item.querySelector('.produto-select').name = `produtos[${index}][id_produto]`;
        item.querySelector('.quantidade-input').name = `produtos[${index}][quantidade]`;
        item.querySelector('.preco-input').name = `produtos[${index}][preco_unitario]`;
    });
}

// Adicionar novo produto
document.getElementById('add-produto').addEventListener('click', function() {
    const container = document.getElementById('produtos-container');
    const novoProduto = document.querySelector('.produto-item').cloneNode(true);
    
    // Limpar valores do novo produto
    novoProduto.querySelector('.produto-select').value = '';
    novoProduto.querySelector('.quantidade-input').value = '1';
    novoProduto.querySelector('.preco-input').value = '';
    novoProduto.querySelector('.total-item').value = '';
    
    container.appendChild(novoProduto);
    configurarEventosProduto(novoProduto);
    renumerar();
    produtoIndex++;
});

// Configurar eventos do primeiro produto
document.addEventListener('DOMContentLoaded', function() {
    configurarEventosProduto(document.querySelector('.produto-item'));
});
</script>

<?php

class PedidoController extends Controller
{
    private $modelPedido;
    private $modelCliente;
    private $modelProduto;
    private $modelItemPedido;

    public function __construct()
    {
        $this->modelPedido = new Pedido();
        $this->modelCliente = new Cliente();
        $this->modelProduto = new Produto();
        $this->modelItemPedido = new ItemPedido();
    }

    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/pedido/listar';
        
        $pedidos = $this->modelPedido->getPedidos();
        $dados['pedidos'] = $pedidos;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/pedido/novo';
        
        // Buscar clientes e produtos para os selects
        $clientes = $this->modelCliente->getClientes();
        $produtos = $this->modelProduto->getProdutos();
        
        $dados['clientes'] = $clientes;
        $dados['produtos'] = $produtos;
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            error_log("Dados recebidos para pedido: " . print_r($dadosPost, true));
            
            // Criar o pedido básico
            $id_pedido = $this->modelPedido->addPedido(
                $dadosPost['pedido_data'],
                $dadosPost['id_cliente']
            );

            if ($id_pedido) {
                // Adicionar itens ao pedido se existirem
                if (isset($dadosPost['produtos']) && is_array($dadosPost['produtos'])) {
                    $total_pedido = 0;
                    
                    foreach ($dadosPost['produtos'] as $produto) {
                        if (!empty($produto['id_produto']) && !empty($produto['quantidade']) && !empty($produto['preco_unitario'])) {
                            $resultado_item = $this->modelItemPedido->addItemPedido(
                                $id_pedido,
                                $produto['id_produto'],
                                $produto['quantidade'],
                                $produto['preco_unitario']
                            );
                            
                            if ($resultado_item) {
                                $total_pedido += ($produto['quantidade'] * $produto['preco_unitario']);
                            }
                        }
                    }
                    
                    // Atualizar o valor total do pedido
                    if ($total_pedido > 0) {
                        $this->modelPedido->patchPedido(['pedido_valor_total' => $total_pedido], $id_pedido);
                    }
                }
                
                echo "<script>alert('Pedido criado com sucesso!'); window.location.href='" . URL_BASE . "pedido/listar';</script>";
            } else {
                echo "<script>alert('Erro ao criar pedido! Verifique os dados.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Nenhum dado foi enviado!'); window.history.back();</script>";
        }
    }

    public function Visualizar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/pedido/visualizar';

        $pedido = $this->modelPedido->getPedidobyID($id);
        
        if (empty($pedido)) {
            echo "<script>alert('Pedido não encontrado!'); window.history.back();</script>";
            return;
        }

        // Buscar itens do pedido
        $itens = $this->modelItemPedido->getItensPorPedido($id);
        
        $dados['pedido'] = $pedido[0];
        $dados['itens'] = $itens;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/pedido/editar';

        $pedido = $this->modelPedido->getPedidobyID($id);
        
        if (empty($pedido)) {
            echo "<script>alert('Pedido não encontrado!'); window.history.back();</script>";
            return;
        }

        // Buscar clientes e produtos para os selects
        $clientes = $this->modelCliente->getClientes();
        $produtos = $this->modelProduto->getProdutos();
        
        // Buscar itens do pedido
        $itens = $this->modelItemPedido->getItensPorPedido($id);
        
        $dados['pedido'] = $pedido[0];
        $dados['clientes'] = $clientes;
        $dados['produtos'] = $produtos;
        $dados['itens'] = $itens;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idPedido = $dadosPost['id_pedido'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['pedido_data']) && !empty($dadosPost['pedido_data'])) {
                $dadosUpdate['pedido_data'] = $dadosPost['pedido_data'];
            }
            
            if (isset($dadosPost['id_cliente']) && !empty($dadosPost['id_cliente'])) {
                $dadosUpdate['id_cliente'] = $dadosPost['id_cliente'];
            }
            
            if (isset($dadosPost['pedido_status']) && !empty($dadosPost['pedido_status'])) {
                $dadosUpdate['pedido_status'] = $dadosPost['pedido_status'];
            }

            // Atualizar dados básicos do pedido
            $resultado = $this->modelPedido->patchPedido($dadosUpdate, $idPedido);

            // Atualizar itens se fornecidos
            if (isset($dadosPost['produtos']) && is_array($dadosPost['produtos'])) {
                // Remover itens existentes (simplificado - em produção, seria melhor fazer update/insert/delete específicos)
                $this->removerTodosItensPedido($idPedido);
                
                $total_pedido = 0;
                
                foreach ($dadosPost['produtos'] as $produto) {
                    if (!empty($produto['id_produto']) && !empty($produto['quantidade']) && !empty($produto['preco_unitario'])) {
                        $this->modelItemPedido->addItemPedido(
                            $idPedido,
                            $produto['id_produto'],
                            $produto['quantidade'],
                            $produto['preco_unitario']
                        );
                        
                        $total_pedido += ($produto['quantidade'] * $produto['preco_unitario']);
                    }
                }
                
                // Atualizar o valor total
                $this->modelPedido->patchPedido(['pedido_valor_total' => $total_pedido], $idPedido);
            }

            if ($resultado) {
                echo "<script>alert('Pedido atualizado com sucesso!'); window.location.href='" . URL_BASE . "pedido/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar pedido!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            $pedido = $this->modelPedido->getPedidobyID($id);
            
            if (empty($pedido)) {
                echo "<script>alert('Pedido não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelPedido->excluirPedido($id);

            if ($resultado) {
                echo "<script>alert('Pedido excluído com sucesso!'); window.location.href='" . URL_BASE . "pedido/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir pedido!'); window.history.back();</script>";
            }
        }
    }

    // Método para buscar preço do produto via AJAX
    public function BuscarPrecoProduto($id_produto)
    {
        header('Content-Type: application/json');
        
        if (empty($id_produto)) {
            echo json_encode(['error' => 'ID do produto não informado']);
            return;
        }

        try {
            $produto = $this->modelProduto->getProdutobyID($id_produto);
            
            if (!empty($produto)) {
                echo json_encode([
                    'success' => true,
                    'preco' => $produto[0]['produto_preco'] ?? 0,
                    'nome' => $produto[0]['produto_nome'] ?? ''
                ]);
            } else {
                echo json_encode(['error' => 'Produto não encontrado']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Erro ao buscar produto']);
        }
    }

    private function removerTodosItensPedido($id_pedido)
    {
        try {
            // Buscar todos os itens do pedido e removê-los individualmente
            $itens = $this->modelItemPedido->getItensPorPedido($id_pedido);
            
            foreach ($itens as $item) {
                $this->modelItemPedido->removeItemPedido($item['id_itempedido']);
            }
            
            return true;
        } catch (Exception $e) {
            error_log("Erro ao remover itens do pedido: " . $e->getMessage());
            return false;
        }
    }
} 
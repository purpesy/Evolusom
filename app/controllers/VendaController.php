<?php

class VendaController extends Controller{

    private $modelVenda;
    private $modelFuncionario;
    private $modelPedido;

    public function __construct(){

        $this->modelVenda = new Venda();
        $this->modelFuncionario = new Funcionario();
        $this->modelPedido = new Pedido();

    }

    public function Listar(){

        $dados = array();
        $dados['conteudo'] = 'admin/venda/listar';

        $vendas = $this->modelVenda->getVendas();
        $dados['vendas'] = $vendas;

        $this->carregarViews('admin/dash', $dados);
        
    }

    public function Nova(){

        $dados = array();
        $dados['conteudo'] = 'admin/venda/nova';

        // Buscar funcionários e pedidos disponíveis para os selects
        $funcionarios = $this->modelFuncionario->getFuncionarios();
        $pedidos = $this->modelVenda->getPedidosDisponiveis();

        $dados['funcionarios'] = $funcionarios;
        $dados['pedidos'] = $pedidos;

        $this->carregarViews('admin/dash', $dados);
        
    }

    public function Cadastrar($dadosPost){

        if (!empty($dadosPost)) {
            
            error_log("Dados recebidos para venda: " . print_r($dadosPost, true));
            
            // Validação dos campos obrigatórios
            $campos_obrigatorios = ['venda_data', 'id_funcionario', 'id_pedido', 'forma_pagamento'];
            $campos_faltando = [];
            
            foreach ($campos_obrigatorios as $campo) {
                if (empty($dadosPost[$campo])) {
                    $campos_faltando[] = $campo;
                }
            }
            
            if (!empty($campos_faltando)) {
                $mensagem = "Campos obrigatórios não preenchidos: " . implode(', ', $campos_faltando);
                error_log($mensagem);
                echo "<script>alert('$mensagem'); window.history.back();</script>";
                return;
            }
            
            $resultado = $this->modelVenda->addVenda(
                $dadosPost['venda_data'],
                $dadosPost['id_funcionario'],
                $dadosPost['id_pedido'],
                $dadosPost['forma_pagamento'],
                $dadosPost['status_pagamento'] ?? 'Pendente'
            );

            if ($resultado) {
                echo "<script>alert('Venda registrada com sucesso!'); window.location.href='" . URL_BASE . "venda/listar';</script>";
            } else {
                echo "<script>alert('Erro ao registrar venda! Verifique os logs para mais detalhes.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Nenhum dado foi enviado!'); window.history.back();</script>";
        }
    }

    public function Visualizar($id){

        $dados = array();
        $dados['conteudo'] = 'admin/venda/visualizar';

        // Buscar a venda com todos os detalhes
        $venda = $this->modelVenda->getVendaComDetalhes($id);
        
        if (empty($venda)) {
            echo "<script>alert('Venda não encontrada!'); window.history.back();</script>";
            return;
        }

        $dados['venda'] = $venda;

        $this->carregarViews('admin/dash', $dados);
        
    }

    public function Editar($id){

        $dados = array();
        $dados['conteudo'] = 'admin/venda/editar';

        // Buscar a venda específica
        $venda = $this->modelVenda->getVendaByID($id);
        
        if (empty($venda)) {
            echo "<script>alert('Venda não encontrada!'); window.history.back();</script>";
            return;
        }

        // Buscar funcionários para o select
        $funcionarios = $this->modelFuncionario->getFuncionarios();

        $dados['venda'] = $venda[0];
        $dados['funcionarios'] = $funcionarios;

        $this->carregarViews('admin/dash', $dados);
        
    }

    public function Atualizar($dadosPost){

        if (!empty($dadosPost)) {
            
            $idVenda = $dadosPost['id_venda'];
            
            // Preparar dados para atualização
            $dadosUpdate = array();
            
            if (isset($dadosPost['venda_data']) && !empty($dadosPost['venda_data'])) {
                $dadosUpdate['venda_data'] = $dadosPost['venda_data'];
            }
            
            if (isset($dadosPost['id_funcionario']) && !empty($dadosPost['id_funcionario'])) {
                $dadosUpdate['id_funcionario'] = $dadosPost['id_funcionario'];
            }
            
            if (isset($dadosPost['forma_pagamento']) && !empty($dadosPost['forma_pagamento'])) {
                $dadosUpdate['forma_pagamento'] = $dadosPost['forma_pagamento'];
            }
            
            if (isset($dadosPost['status_pagamento']) && !empty($dadosPost['status_pagamento'])) {
                $dadosUpdate['status_pagamento'] = $dadosPost['status_pagamento'];
            }

            // Atualiza a venda
            $resultado = $this->modelVenda->patchVenda($dadosUpdate, $idVenda);

            if ($resultado) {
                echo "<script>alert('Venda atualizada com sucesso!'); window.location.href='" . URL_BASE . "venda/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar venda!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id){

        if (!empty($id)) {
            
            // Buscar a venda para verificar se existe
            $venda = $this->modelVenda->getVendaByID($id);
            
            if (empty($venda)) {
                echo "<script>alert('Venda não encontrada!'); window.history.back();</script>";
                return;
            }

            // Exclui a venda
            $resultado = $this->modelVenda->excluirVenda($id);

            if ($resultado) {
                echo "<script>alert('Venda excluída com sucesso!'); window.location.href='" . URL_BASE . "venda/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir venda!'); window.history.back();</script>";
            }
        }
    }

    // Método para aprovar pagamento
    public function AprovarPagamento($id){
        
        if (!empty($id)) {
            
            $venda = $this->modelVenda->getVendaByID($id);
            
            if (empty($venda)) {
                echo "<script>alert('Venda não encontrada!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelVenda->patchVenda(['status_pagamento' => 'Aprovado'], $id);

            if ($resultado) {
                echo "<script>alert('Pagamento aprovado com sucesso!'); window.location.href='" . URL_BASE . "venda/listar';</script>";
            } else {
                echo "<script>alert('Erro ao aprovar pagamento!'); window.history.back();</script>";
            }
        }
    }

    // Método para rejeitar pagamento
    public function RejeitarPagamento($id){
        
        if (!empty($id)) {
            
            $venda = $this->modelVenda->getVendaByID($id);
            
            if (empty($venda)) {
                echo "<script>alert('Venda não encontrada!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelVenda->patchVenda(['status_pagamento' => 'Rejeitado'], $id);

            if ($resultado) {
                echo "<script>alert('Pagamento rejeitado!'); window.location.href='" . URL_BASE . "venda/listar';</script>";
            } else {
                echo "<script>alert('Erro ao rejeitar pagamento!'); window.history.back();</script>";
            }
        }
    }

    // Método AJAX para buscar detalhes do pedido
    public function BuscarDetalhesPedido($id_pedido)
    {
        header('Content-Type: application/json');
        
        if (empty($id_pedido)) {
            echo json_encode(['error' => 'ID do pedido não informado']);
            return;
        }

        try {
            $pedido = $this->modelPedido->getPedidoComItens($id_pedido);
            
            if (!empty($pedido)) {
                echo json_encode([
                    'success' => true,
                    'pedido' => $pedido
                ]);
            } else {
                echo json_encode(['error' => 'Pedido não encontrado']);
            }
        } catch (Exception $e) {
            echo json_encode(['error' => 'Erro ao buscar detalhes do pedido']);
        }
    }

    // Relatório de vendas por período
    public function RelatorioVendas()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/venda/relatorio';

        // Se há dados POST, buscar vendas do período
        if (!empty($_POST)) {
            $data_inicio = $_POST['data_inicio'] ?? '';
            $data_fim = $_POST['data_fim'] ?? '';
            
            if (!empty($data_inicio) && !empty($data_fim)) {
                $vendas = $this->modelVenda->getVendasPorPeriodo($data_inicio, $data_fim);
                $dados['vendas'] = $vendas;
                $dados['data_inicio'] = $data_inicio;
                $dados['data_fim'] = $data_fim;
            }
        }

        $this->carregarViews('admin/dash', $dados);
    }
}

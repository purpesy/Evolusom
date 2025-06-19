<?php

class ApiController extends Controller
{

    private $agendamentoModel;
    private $categoriaModel;
    private $clienteModel;
    private $estoqueModel;
    private $fornecedorModel;
    private $funcionarioModel;
    private $pedidoModel;
    private $produtoModel;
    private $servicoModel;
    private $vendaModel;

    public function __construct()
    {
        $this->agendamentoModel = new Agendamento();
        $this->categoriaModel = new Categoria();
        $this->clienteModel = new Cliente();
        $this->estoqueModel = new Estoque();
        $this->fornecedorModel = new Fornecedor();
        $this->funcionarioModel = new Funcionario();
        $this->pedidoModel = new Pedido();
        $this->produtoModel = new Produto();
        $this->servicoModel = new Servico();
        $this->vendaModel = new Venda();
    }

    // ===========================================================================
    // *********************Agendamento*********************************
    // ===========================================================================

    public function ListarAgendamentos()
    {
        $agendamentos = $this->agendamentoModel->getTodosAgendamentos();
        if (empty($agendamentos)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum agendamento encontrado"]);
            return;
        }
        echo json_encode($agendamentos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarAgendamentoPorID($id)
    {
        $agendamento = $this->agendamentoModel->getAgendamentobyID($id);
        if (empty($agendamento)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Agendamento não encontrado"]);
            return;
        }
        echo json_encode($agendamento, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }


    public function AtualizarAgendamento($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->agendamentoModel->patchAgendamento($id, $dados);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Agendamento atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou agendamento não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Categoria***********************************
    // ===========================================================================
    public function ListarCategorias()
    {
        $categorias = $this->categoriaModel->getCategorias();
        if (empty($categorias)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhuma categoria encontrada"]);
            return;
        }
        echo json_encode($categorias, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarCategoriaPorID($id)
    {
        $categoria = $this->categoriaModel->getCategoriabyID($id);
        if (empty($categoria)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Categoria não encontrada"]);
            return;
        }
        echo json_encode($categoria, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function AtualizarCategoria($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->categoriaModel->patchCategoria($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Categoria atualizada com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou categoria não encontrada"]);
        }
    }

    // ===========================================================================
    // *********************Cliente*************************************
    // ===========================================================================
    public function ListarClientes()
    {
        $clientes = $this->clienteModel->getClientes();
        if (empty($clientes)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum cliente encontrado"]);
            return;
        }
        echo json_encode($clientes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarClientePorID($id)
    {
        $cliente = $this->clienteModel->getClientebyID($id);
        if (empty($cliente)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Cliente não encontrado"]);
            return;
        }
        echo json_encode($cliente, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarCliente($dados)
    {
        if (empty($dados['nome']) || empty($dados['telefone']) || empty($dados['email']) || empty($dados['cpf'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->clienteModel->addCliente($dados['nome'], $dados['telefone'], $dados['email'], $dados['cpf']);

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Cliente cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar cliente"]);
        }
    }

    public function AtualizarCliente($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->clienteModel->patchCliente($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Cliente atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou cliente não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Estoque*************************************
    // ===========================================================================


    public function ListarEstoques()
    {
        $estoques = $this->estoqueModel->getEstoques();
        if (empty($estoques)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum estoque encontrado"]);
            return;
        }
        echo json_encode($estoques, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarEstoquePorID($id)
    {
        $estoque = $this->estoqueModel->getEstoquebyID($id);
        if (empty($estoque)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Estoque não encontrado"]);
            return;
        }
        echo json_encode($estoque, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarEstoque($dados)
    {
        if (empty($dados['quantidade']) || empty($dados['tipo']) || empty($dados['observacoes']) || empty($dados['id_produto'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->estoqueModel->addeEstoque(
            $dados['quantidade'],
            $dados['tipo'],
            $dados['observacoes'],
            $dados['id_produto']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Estoque cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar estoque"]);
        }
    }

    public function AtualizarEstoque($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->estoqueModel->patchEstoque($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Estoque atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou estoque não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Fornecedor*************************************
    // ===========================================================================

    public function ListarFornecedores()
    {
        $fornecedores = $this->fornecedorModel->getFornecedores();
        if (empty($fornecedores)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum fornecedor encontrado"]);
            return;
        }
        echo json_encode($fornecedores, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarFornecedorPorID($id)
    {
        $fornecedor = $this->fornecedorModel->getFornecedorbyID($id);
        if (empty($fornecedor)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Fornecedor não encontrado"]);
            return;
        }
        echo json_encode($fornecedor, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarFornecedor($dados)
    {
        if (empty($dados['nome']) || empty($dados['cnpj']) || empty($dados['email']) || empty($dados['fone']) || empty($dados['endereco'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->fornecedorModel->addFornecedor(
            $dados['nome'],
            $dados['cnpj'],
            $dados['email'],
            $dados['fone'],
            $dados['endereco']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Fornecedor cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar fornecedor"]);
        }
    }

    public function AtualizarFornecedor($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->fornecedorModel->patchFornecedor($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Fornecedor atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou fornecedor não encontrado"]);
        }
    }


    // ===========================================================================
    // *********************Funcionario*************************************
    // ===========================================================================

    public function ListarFuncionarios()
    {
        $funcionarios = $this->funcionarioModel->getFuncionarios();
        if (empty($funcionarios)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum funcionário encontrado"]);
            return;
        }
        echo json_encode($funcionarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarFuncionarioPorID($id)
    {
        $funcionario = $this->funcionarioModel->getFuncionarioByID($id);
        if (empty($funcionario)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Funcionário não encontrado"]);
            return;
        }
        echo json_encode($funcionario, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarFuncionario($dados)
    {
        if (empty($dados['nome']) || empty($dados['fone']) || empty($dados['email']) || empty($dados['cargo']) || empty($dados['cpf'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->funcionarioModel->addFuncionario(
            $dados['nome'],
            $dados['fone'],
            $dados['email'],
            $dados['cargo'],
            $dados['cpf']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Funcionário cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar funcionário"]);
        }
    }

    public function AtualizarFuncionario($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->funcionarioModel->patchFuncionario($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Funcionário atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou funcionário não encontrado"]);
        }
    }


    // ===========================================================================
    // *********************Pedido*************************************
    // ===========================================================================

    public function ListarPedidos()
    {
        $pedidos = $this->pedidoModel->getPedidos();
        if (empty($pedidos)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum pedido encontrado"]);
            return;
        }
        echo json_encode($pedidos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarPedidoPorID($id)
    {
        $pedido = $this->pedidoModel->getPedidobyID($id);
        if (empty($pedido)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Pedido não encontrado"]);
            return;
        }
        echo json_encode($pedido, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarPedido($dados)
    {
        if (empty($dados['datapedido']) || empty($dados['valor_total']) || empty($dados['id_cliente'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->pedidoModel->addPedido(
            $dados['datapedido'],
            $dados['valor_total'],
            $dados['id_cliente']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Pedido cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar pedido"]);
        }
    }

    public function AtualizarPedido($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->pedidoModel->patchPedido($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Pedido atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou pedido não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Produto*************************************
    // ===========================================================================
    public function ListarProdutos()
    {
        $produtos = $this->produtoModel->getProdutos();
        if (empty($produtos)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum produto encontrado"]);
            return;
        }
        echo json_encode($produtos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarProdutoPorID($id)
    {
        $produto = $this->produtoModel->getProdutobyID($id);
        if (empty($produto)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Produto não encontrado"]);
            return;
        }
        echo json_encode($produto, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarProduto($dados)
    {
        if (empty($dados['nome']) || empty($dados['descricao']) || empty($dados['preco']) || empty($dados['quantidade']) || empty($dados['id_categoria'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->produtoModel->addProduto($dados['nome'], $dados['descricao'], $dados['preco'], $dados['quantidade'], $dados['id_categoria']);

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Produto cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar produto"]);
        }
    }

    public function AtualizarProduto($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->produtoModel->patchProduto($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Produto atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou produto não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Servico*************************************
    // ===========================================================================

    public function ListarServicos()
    {
        $servicos = $this->servicoModel->getServico();
        if (empty($servicos)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhum servico encontrado"]);
            return;
        }
        echo json_encode($servicos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarServicoPorID($id)
    {
        $servico = $this->servicoModel->getServicobyID($id);
        if (empty($servico)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Servico não encontrado"]);
            return;
        }
        echo json_encode($servico, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarServico($dados)
    {
        if (empty($dados['nome']) || empty($dados['descricao']) || empty($dados['preco'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->servicoModel->addServico(
            $dados['nome'],
            $dados['descricao'],
            $dados['preco']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Serviço cadastrado com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar serviço"]);
        }
    }

    public function AtualizarServico($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->servicoModel->patchServico($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Servico atualizado com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou servico não encontrado"]);
        }
    }

    // ===========================================================================
    // *********************Venda***************************************
    // ===========================================================================

    public function ListarVendas()
    {
        $vendas = $this->vendaModel->getVendas();
        if (empty($vendas)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Nenhuma venda encontrada"]);
            return;
        }
        echo json_encode($vendas, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function BuscarVendaPorID($id)
    {
        $venda = $this->vendaModel->getVendaByID($id);
        if (empty($venda)) {
            http_response_code(404);
            echo json_encode(["Mensagem" => "Venda não encontrada"]);
            return;
        }
        echo json_encode($venda, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function CadastrarVenda($dados)
    {
        if (empty($dados['datavenda']) || empty($dados['valor']) || empty($dados['funcionario']) || empty($dados['produto'])) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para cadastro"]);
            return;
        }

        $resultado = $this->vendaModel->addVenda(
            $dados['datavenda'],
            $dados['valor'],
            $dados['funcionario'],
            $dados['produto']
        );

        if ($resultado) {
            http_response_code(201);
            echo json_encode(["Mensagem" => "Venda cadastrada com sucesso"]);
        } else {
            http_response_code(500);
            echo json_encode(["Mensagem" => "Erro ao cadastrar venda"]);
        }
    }

    public function AtualizarVenda($id, $dados)
    {
        if (empty($id) || empty($dados)) {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Dados incompletos para atualização"]);
            return;
        }

        $resultado = $this->vendaModel->patchVenda($dados, $id);

        if ($resultado) {
            http_response_code(200);
            echo json_encode(["Mensagem" => "Venda atualizada com sucesso"]);
        } else {
            http_response_code(400);
            echo json_encode(["Mensagem" => "Nenhum dado válido informado ou venda não encontrada"]);
        }
    }
}

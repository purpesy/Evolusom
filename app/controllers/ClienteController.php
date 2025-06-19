<?php

class ClienteController extends Controller
{
    private $modelCliente;

    public function __construct()
    {
        $this->modelCliente = new Cliente();
    }

    public function index()
    {
        $dados = array();
    
        $todosClientes = $this->modelCliente->getClientes();
    
        // Pega o primeiro cliente apenas
        $dados['usuario'] = isset($todosClientes[0]) ? $todosClientes[0] : null;

        // Busca os serviços agendados do cliente
        if ($dados['usuario']) {
            $modelAgendamento = new Agendamento();
            $dados['agendamentos'] = $modelAgendamento->getAgendamentosPorCliente($dados['usuario']['id_cliente']);
        }
    
        $this->carregarViews('usuario', $dados);
    }

    public function editarPerfil()
    {
        $dados = array();
        
        // Verificar se o usuário está logado
        if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'cliente') {
            header('Location:' . URL_BASE . 'home');
            exit;
        }

        // Buscar dados do cliente logado
        $usuario = $this->modelCliente->getClientebyID($_SESSION['tipo_id']);
        
        if(!empty($usuario)) {
            $dados['usuario'] = $usuario[0];
        } else {
            $_SESSION['erro'] = "Erro ao carregar dados do cliente";
            header('Location:' . URL_BASE . 'usuario');
            exit;
        }

        $this->carregarViews('editarPerfil', $dados);
    }

    public function atualizarPerfil()
    {
        if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] != 'cliente') {
            header('Location:' . URL_BASE . 'home');
            exit;
        }

        $dados = array(
            'id_cliente' => $_SESSION['tipo_id'],
            'cliente_nome' => $_POST['cliente_nome'],
            'cliente_email' => $_POST['cliente_email'],
            'cliente_telefone' => $_POST['cliente_telefone']
        );

        // Se uma nova senha foi fornecida
        if(!empty($_POST['cliente_senha'])) {
            if($_POST['cliente_senha'] === $_POST['confirmar_senha']) {
                $dados['cliente_senha'] = password_hash($_POST['cliente_senha'], PASSWORD_DEFAULT);
            } else {
                $_SESSION['erro'] = "As senhas não coincidem";
                header('Location:' . URL_BASE . 'cliente/editarPerfil');
                exit;
            }
        }

        if($this->modelCliente->atualizarCliente($dados)) {
            $_SESSION['sucesso'] = "Perfil atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar perfil";
        }

        header('Location:' . URL_BASE . 'usuario');
        exit;
    }



    ///////////////////////////////
    //////////dash////////////////
    ///////////////////////////////

    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/cliente/listar';
        
        $cliente = $this->modelCliente->getClientes();
        $dados['cliente'] = $cliente;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/cliente/novo';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            // Debug: Verificar estrutura da tabela
            $verificacao = $this->modelCliente->verificarTabelaCliente();
            if (isset($verificacao['erro'])) {
                error_log("Erro na tabela de clientes: " . $verificacao['erro']);
                echo "<script>alert('Erro na estrutura do banco de dados!'); window.history.back();</script>";
                return;
            }
            
            // Validação básica
            if (empty($dadosPost['cliente_nome']) || empty($dadosPost['cliente_telefone']) || 
                empty($dadosPost['cliente_email']) || empty($dadosPost['cliente_cpf']) || 
                empty($dadosPost['cliente_senha'])) {
                echo "<script>alert('Todos os campos são obrigatórios!'); window.history.back();</script>";
                return;
            }
            
            // Verificar se email já existe
            $clienteExistente = $this->verificarEmailExistente($dadosPost['cliente_email']);
            if ($clienteExistente) {
                echo "<script>alert('Este email já está cadastrado!'); window.history.back();</script>";
                return;
            }
            
            // Log dos dados recebidos para debug
            error_log("Dados recebidos para cadastro de cliente: " . print_r($dadosPost, true));
            
            $resultado = $this->modelCliente->addCliente(
                trim($dadosPost['cliente_nome']),
                trim($dadosPost['cliente_telefone']),
                trim($dadosPost['cliente_email']),
                trim($dadosPost['cliente_cpf']),
                trim($dadosPost['cliente_senha'])
            );

            if ($resultado) {
                echo "<script>alert('Cliente cadastrado com sucesso!'); window.location.href='" . URL_BASE . "cliente/listar';</script>";
            } else {
                error_log("Falha ao cadastrar cliente. Dados: " . print_r($dadosPost, true));
                echo "<script>alert('Erro ao cadastrar cliente! Verifique os dados e tente novamente.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Nenhum dado foi enviado!'); window.history.back();</script>";
        }
    }
    
    private function verificarEmailExistente($email)
    {
        $clientes = $this->modelCliente->getClientes();
        foreach ($clientes as $cliente) {
            if ($cliente['cliente_email'] === $email) {
                return true;
            }
        }
        return false;
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/cliente/editar';

        // Buscar o cliente específico
        $cliente = $this->modelCliente->getClientebyID($id);
        
        if (empty($cliente)) {
            echo "Cliente não encontrado!";
            return;
        }

        $dados['cliente'] = $cliente[0]; // Pega o primeiro resultado

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idCliente = $dadosPost['id_cliente'];
            
            // Preparar dados para atualização
            $dadosUpdate = array();
            
            if (isset($dadosPost['cliente_nome']) && !empty($dadosPost['cliente_nome'])) {
                $dadosUpdate['cliente_nome'] = $dadosPost['cliente_nome'];
            }
            
            if (isset($dadosPost['cliente_telefone']) && !empty($dadosPost['cliente_telefone'])) {
                $dadosUpdate['cliente_telefone'] = $dadosPost['cliente_telefone'];
            }
            
            if (isset($dadosPost['cliente_email']) && !empty($dadosPost['cliente_email'])) {
                $dadosUpdate['cliente_email'] = $dadosPost['cliente_email'];
            }
            
            if (isset($dadosPost['cliente_cpf']) && !empty($dadosPost['cliente_cpf'])) {
                $dadosUpdate['cliente_cpf'] = $dadosPost['cliente_cpf'];
            }

            // Atualiza o cliente
            $resultado = $this->modelCliente->patchCliente($dadosUpdate, $idCliente);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'cliente/listar');
                exit;
            } else {
                echo "Erro ao atualizar cliente!";
            }
        } else {
            echo "Dados POST vazios!";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            // Buscar o cliente para verificar se existe
            $cliente = $this->modelCliente->getClientebyID($id);
            
            if (empty($cliente)) {
                echo "Cliente não encontrado!";
                return;
            }

            // Exclui o cliente (exclusão física)
            $resultado = $this->modelCliente->excluirCliente($id);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'cliente/listar');
                exit;
            } else {
                echo "Erro ao excluir cliente!";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Cliente não encontrado";
            header("Location: " . URL_BASE . "cliente/listar");
            exit;
        }

        $cliente = $this->modelCliente->getClientebyID($id);
        
        if (!$cliente) {
            $_SESSION['erro'] = "Cliente não encontrado";
            header("Location: " . URL_BASE . "cliente/listar");
            exit;
        }

        $novoStatus = $cliente[0]['cliente_status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelCliente->patchCliente(['cliente_status' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status do cliente atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do cliente";
        }

        header("Location: " . URL_BASE . "cliente/listar");
        exit;
    }

   
}

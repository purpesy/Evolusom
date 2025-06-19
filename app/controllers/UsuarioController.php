<?php

class UsuarioController extends Controller
{
    private $modelUsuario;
    private $modelCliente;
    private $modelProduto;
    private $modelAgendamento;

    public function __construct()
    {

        $this->modelUsuario = new Usuario();
        $this->modelCliente = new Cliente();
        $this->modelAgendamento = new Agendamento();


    }

    public function index()
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
            
            // Buscar agendamentos do cliente
            $agendamentos = $this->modelAgendamento->getAgendamentosPorCliente($_SESSION['tipo_id']);
            $dados['agendamentos'] = $agendamentos;
        } else {
            $_SESSION['erro'] = "Erro ao carregar dados do cliente";
            header('Location:' . URL_BASE . 'home');
            exit;
        }

        $this->carregarViews('usuario', $dados);
    }



    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/usuario/listar';
        
        $usuarios = $this->modelUsuario->getUsuarios();
        $dados['usuarios'] = $usuarios;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/usuario/novo';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelUsuario->addUsuario(
                $dadosPost['usuario_nome'],
                $dadosPost['usuario_email'],
                $dadosPost['usuario_login'],
                $dadosPost['usuario_senha'],
                $dadosPost['usuario_nivel']
            );

            if ($resultado) {
                echo "<script>alert('Usuário cadastrado com sucesso!'); window.location.href='" . URL_BASE . "usuario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar usuário!'); window.history.back();</script>";
            }
        }
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/usuario/editar';

        $usuario = $this->modelUsuario->getUsuariobyID($id);
        
        if (empty($usuario)) {
            echo "<script>alert('Usuário não encontrado!'); window.history.back();</script>";
            return;
        }

        $dados['usuario'] = $usuario[0];

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idUsuario = $dadosPost['id_usuario'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['usuario_nome']) && !empty($dadosPost['usuario_nome'])) {
                $dadosUpdate['usuario_nome'] = $dadosPost['usuario_nome'];
            }
            
            if (isset($dadosPost['usuario_email']) && !empty($dadosPost['usuario_email'])) {
                $dadosUpdate['usuario_email'] = $dadosPost['usuario_email'];
            }
            
            if (isset($dadosPost['usuario_login']) && !empty($dadosPost['usuario_login'])) {
                $dadosUpdate['usuario_login'] = $dadosPost['usuario_login'];
            }
            
            // Só atualiza senha se foi fornecida
            if (isset($dadosPost['usuario_senha']) && !empty($dadosPost['usuario_senha'])) {
                $dadosUpdate['usuario_senha'] = $dadosPost['usuario_senha'];
            }
            
            if (isset($dadosPost['usuario_nivel']) && !empty($dadosPost['usuario_nivel'])) {
                $dadosUpdate['usuario_nivel'] = $dadosPost['usuario_nivel'];
            }

            $resultado = $this->modelUsuario->patchUsuario($dadosUpdate, $idUsuario);

            if ($resultado) {
                echo "<script>alert('Usuário atualizado com sucesso!'); window.location.href='" . URL_BASE . "usuario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar usuário!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            $usuario = $this->modelUsuario->getUsuariobyID($id);
            
            if (empty($usuario)) {
                echo "<script>alert('Usuário não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelUsuario->excluirUsuario($id);

            if ($resultado) {
                echo "<script>alert('Usuário excluído com sucesso!'); window.location.href='" . URL_BASE . "usuario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir usuário!'); window.history.back();</script>";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Usuário não encontrado";
            header("Location: " . URL_BASE . "usuario/listar");
            exit;
        }

        $usuario = $this->modelUsuario->getUsuariobyID($id);
        
        if (!$usuario) {
            $_SESSION['erro'] = "Usuário não encontrado";
            header("Location: " . URL_BASE . "usuario/listar");
            exit;
        }

        $novoStatus = $usuario[0]['usuario_status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelUsuario->patchUsuario(['usuario_status' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status do usuário atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do usuário";
        }

        header("Location: " . URL_BASE . "usuario/listar");
        exit;
    }
} 
<?php

class FuncionarioController extends Controller
{
    private $modelFuncionario;

    public function __construct()
    {
        $this->modelFuncionario = new Funcionario();
    }

    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/funcionario/listar';
        
        $funcionarios = $this->modelFuncionario->getFuncionarios();
        $dados['funcionarios'] = $funcionarios;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/funcionario/novo';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelFuncionario->addFuncionario(
                $dadosPost['funcionario_nome'],
                $dadosPost['funcionario_telefone'],
                $dadosPost['funcionario_email'],
                $dadosPost['funcionario_cargo'],
                $dadosPost['funcionario_cpf'],
                $dadosPost['funcionario_senha']
            );

            if ($resultado) {
                echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location.href='" . URL_BASE . "funcionario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar funcionário!'); window.history.back();</script>";
            }
        }
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/funcionario/editar';

        $funcionario = $this->modelFuncionario->getFuncionariobyID($id);
        
        if (empty($funcionario)) {
            echo "<script>alert('Funcionário não encontrado!'); window.history.back();</script>";
            return;
        }

        $dados['funcionario'] = $funcionario[0];

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idFuncionario = $dadosPost['id_funcionario'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['funcionario_nome']) && !empty($dadosPost['funcionario_nome'])) {
                $dadosUpdate['funcionario_nome'] = $dadosPost['funcionario_nome'];
            }
            
            if (isset($dadosPost['funcionario_telefone']) && !empty($dadosPost['funcionario_telefone'])) {
                $dadosUpdate['funcionario_telefone'] = $dadosPost['funcionario_telefone'];
            }
            
            if (isset($dadosPost['funcionario_email']) && !empty($dadosPost['funcionario_email'])) {
                $dadosUpdate['funcionario_email'] = $dadosPost['funcionario_email'];
            }
            
            if (isset($dadosPost['funcionario_cargo']) && !empty($dadosPost['funcionario_cargo'])) {
                $dadosUpdate['funcionario_cargo'] = $dadosPost['funcionario_cargo'];
            }
            
            if (isset($dadosPost['funcionario_cpf']) && !empty($dadosPost['funcionario_cpf'])) {
                $dadosUpdate['funcionario_cpf'] = $dadosPost['funcionario_cpf'];
            }

            $resultado = $this->modelFuncionario->patchFuncionario($dadosUpdate, $idFuncionario);

            if ($resultado) {
                echo "<script>alert('Funcionário atualizado com sucesso!'); window.location.href='" . URL_BASE . "funcionario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar funcionário!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            $funcionario = $this->modelFuncionario->getFuncionariobyID($id);
            
            if (empty($funcionario)) {
                echo "<script>alert('Funcionário não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelFuncionario->excluirFuncionario($id);

            if ($resultado) {
                echo "<script>alert('Funcionário excluído com sucesso!'); window.location.href='" . URL_BASE . "funcionario/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir funcionário!'); window.history.back();</script>";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Funcionário não encontrado";
            header("Location: " . URL_BASE . "funcionario/listar");
            exit;
        }

        $funcionario = $this->modelFuncionario->getFuncionariobyID($id);
        
        if (!$funcionario) {
            $_SESSION['erro'] = "Funcionário não encontrado";
            header("Location: " . URL_BASE . "funcionario/listar");
            exit;
        }

        $novoStatus = $funcionario[0]['funcionario_status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelFuncionario->patchFuncionario(['funcionario_status' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status do funcionário atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do funcionário";
        }

        header("Location: " . URL_BASE . "funcionario/listar");
        exit;
    }
} 
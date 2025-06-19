<?php

class ServicoController extends Controller
{
    private $modelServico;

    public function __construct()
    {
        $this->modelServico = new Servico();
    }

    public function index()
    {
        $dados = array();
        $dados['titulo'] = '🔊 Evolusom - Serviços Automotivos';
        $dados['servicos_destaque'] = $this->modelServico->getServicosLimitados(6);
        $this->carregarViews('servicos', $dados);
    }

    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/servico/listar';
        
        $servicos = $this->modelServico->getServicos();
        $dados['servicos'] = $servicos;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/servico/novo';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelServico->addServico(
                $dadosPost['nome_servico'],
                $dadosPost['descricao_servico'],
                $dadosPost['preco_servico']
            );

            if ($resultado) {
                echo "<script>alert('Serviço cadastrado com sucesso!'); window.location.href='" . URL_BASE . "servico/listar';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar serviço!'); window.history.back();</script>";
            }
        }
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/servico/editar';

        $servico = $this->modelServico->getServicobyID($id);
        
        if (empty($servico)) {
            echo "<script>alert('Serviço não encontrado!'); window.history.back();</script>";
            return;
        }

        $dados['servico'] = $servico[0];

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idServico = $dadosPost['id_servico'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['nome_servico']) && !empty($dadosPost['nome_servico'])) {
                $dadosUpdate['nome_servico'] = $dadosPost['nome_servico'];
            }
            
            if (isset($dadosPost['descricao_servico']) && !empty($dadosPost['descricao_servico'])) {
                $dadosUpdate['descricao_servico'] = $dadosPost['descricao_servico'];
            }
            
            if (isset($dadosPost['preco_servico']) && !empty($dadosPost['preco_servico'])) {
                $dadosUpdate['preco_servico'] = $dadosPost['preco_servico'];
            }

            $resultado = $this->modelServico->patchServico($dadosUpdate, $idServico);

            if ($resultado) {
                echo "<script>alert('Serviço atualizado com sucesso!'); window.location.href='" . URL_BASE . "servico/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar serviço!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            $servico = $this->modelServico->getServicobyID($id);
            
            if (empty($servico)) {
                echo "<script>alert('Serviço não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelServico->excluirServico($id);

            if ($resultado) {
                echo "<script>alert('Serviço excluído com sucesso!'); window.location.href='" . URL_BASE . "servico/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir serviço!'); window.history.back();</script>";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Serviço não encontrado";
            header("Location: " . URL_BASE . "servico/listar");
            exit;
        }

        $servico = $this->modelServico->getServicobyID($id);
        
        if (!$servico) {
            $_SESSION['erro'] = "Serviço não encontrado";
            header("Location: " . URL_BASE . "servico/listar");
            exit;
        }

        $novoStatus = $servico[0]['status_servico'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelServico->patchServico(['status_servico' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status do serviço atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do serviço";
        }

        header("Location: " . URL_BASE . "servico/listar");
        exit;
    }
}
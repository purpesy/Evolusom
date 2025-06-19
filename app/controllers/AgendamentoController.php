<?php

class AgendamentoController extends Controller{

    private $modelAgendamento;
    private $modelCliente;

    public function __construct(){
        $this->modelAgendamento = new Agendamento();
        $this->modelCliente = new Cliente();
    }

    public function Listar(){
        $dados = array();
        $dados['conteudo'] = 'admin/agendamento/listar';
        
        $agendamento = $this->modelAgendamento->getTodosAgendamentos();
        $dados['agendamento'] = $agendamento;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo(){
        $dados = array();
        $dados['conteudo'] = 'admin/agendamento/novo';
        
        // Buscar clientes para o select
        $clientes = $this->modelCliente->getClientes();
        $dados['clientes'] = $clientes;
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost){
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelAgendamento->addAgendamento(
                $dadosPost['agendamento_data'],
                $dadosPost['agendamento_observacoes'],
                $dadosPost['id_cliente']
            );

            if ($resultado) {
                echo "<script>alert('Agendamento criado com sucesso!'); window.location.href='" . URL_BASE . "agendamento/listar';</script>";
            } else {
                echo "<script>alert('Erro ao criar agendamento!'); window.history.back();</script>";
            }
        }
    }

    public function Editar($id){
        $dados = array();
        $dados['conteudo'] = 'admin/agendamento/editar';

        $agendamento = $this->modelAgendamento->getAgendamentobyID($id);
        
        if (empty($agendamento)) {
            echo "<script>alert('Agendamento não encontrado!'); window.history.back();</script>";
            return;
        }

        // Buscar clientes para o select
        $clientes = $this->modelCliente->getClientes();
        
        $dados['agendamento'] = $agendamento[0];
        $dados['clientes'] = $clientes;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost){
        if (!empty($dadosPost)) {
            
            $idAgendamento = $dadosPost['id_agendamento'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['agendamento_data']) && !empty($dadosPost['agendamento_data'])) {
                $dadosUpdate['agendamento_data'] = $dadosPost['agendamento_data'];
            }
            
            if (isset($dadosPost['agendamento_observacoes']) && !empty($dadosPost['agendamento_observacoes'])) {
                $dadosUpdate['agendamento_observacoes'] = $dadosPost['agendamento_observacoes'];
            }
            
            if (isset($dadosPost['id_cliente']) && !empty($dadosPost['id_cliente'])) {
                $dadosUpdate['id_cliente'] = $dadosPost['id_cliente'];
            }
            
            if (isset($dadosPost['status_agendamento']) && !empty($dadosPost['status_agendamento'])) {
                $dadosUpdate['status_agendamento'] = $dadosPost['status_agendamento'];
            }

            // Usar método atualizarAgendamento
            $resultado = $this->modelAgendamento->atualizarAgendamento($dadosUpdate, $idAgendamento);

            if ($resultado) {
                echo "<script>alert('Agendamento atualizado com sucesso!'); window.location.href='" . URL_BASE . "agendamento/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar agendamento!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id){
        if (!empty($id)) {
            
            $agendamento = $this->modelAgendamento->getAgendamentobyID($id);
            
            if (empty($agendamento)) {
                echo "<script>alert('Agendamento não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelAgendamento->excluirAgendamento($id);

            if ($resultado) {
                echo "<script>alert('Agendamento excluído com sucesso!'); window.location.href='" . URL_BASE . "agendamento/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir agendamento!'); window.history.back();</script>";
            }
        }
    }
}
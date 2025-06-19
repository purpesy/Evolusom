<?php

class EstoqueController extends Controller{

    private $modelEstoque;
    private $modelProduto;

    public function __construct(){
        $this->modelEstoque = new Estoque();
        $this->modelProduto = new Produto();
    }

    public function Listar(){
        $dados = array();
        $dados['conteudo'] = 'admin/estoque/listar';
        
        $estoque = $this->modelEstoque->getEstoques();
        $dados['estoque'] = $estoque;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Nova(){
        $dados = array();
        $dados['conteudo'] = 'admin/estoque/nova';
        
        // Buscar produtos para o select
        $produtos = $this->modelProduto->getProdutos();
        $dados['produtos'] = $produtos;
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost){
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelEstoque->addeEstoque(
                $dadosPost['estoque_quantidade'],
                $dadosPost['estoque_tipo_movimentacao'],
                $dadosPost['estoque_observacoes'],
                $dadosPost['id_produto']
            );

            if ($resultado) {
                header('Location: ' . URL_BASE . 'estoque/listar');
                exit;
            } else {
                echo "Erro ao cadastrar movimentação de estoque!";
            }
        }
    }

    public function Editar($id){
        $dados = array();
        $dados['conteudo'] = 'admin/estoque/editar';

        $estoque = $this->modelEstoque->getEstoquebyID($id);
        
        if (empty($estoque)) {
            echo "Movimentação de estoque não encontrada!";
            return;
        }

        // Buscar produtos para o select
        $produtos = $this->modelProduto->getProdutos();
        
        $dados['estoque'] = $estoque[0];
        $dados['produtos'] = $produtos;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost){
        if (!empty($dadosPost)) {
            
            $idEstoque = $dadosPost['id_estoque'];
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['estoque_quantidade']) && !empty($dadosPost['estoque_quantidade'])) {
                $dadosUpdate['estoque_quantidade'] = $dadosPost['estoque_quantidade'];
            }
            
            if (isset($dadosPost['estoque_tipo_movimentacao']) && !empty($dadosPost['estoque_tipo_movimentacao'])) {
                $dadosUpdate['estoque_tipo_movimentacao'] = $dadosPost['estoque_tipo_movimentacao'];
            }
            
            if (isset($dadosPost['estoque_observacoes']) && !empty($dadosPost['estoque_observacoes'])) {
                $dadosUpdate['estoque_observacoes'] = $dadosPost['estoque_observacoes'];
            }
            
            if (isset($dadosPost['id_produto']) && !empty($dadosPost['id_produto'])) {
                $dadosUpdate['id_produto'] = $dadosPost['id_produto'];
            }

            $resultado = $this->modelEstoque->patchEstoque($dadosUpdate, $idEstoque);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'estoque/listar');
                exit;
            } else {
                echo "Erro ao atualizar movimentação de estoque!";
            }
        } else {
            echo "Dados POST vazios!";
        }
    }

    public function Excluir($id){
        if (!empty($id)) {
            
            $estoque = $this->modelEstoque->getEstoquebyID($id);
            
            if (empty($estoque)) {
                echo "Movimentação de estoque não encontrada!";
                return;
            }

            $resultado = $this->modelEstoque->excluirEstoque($id);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'estoque/listar');
                exit;
            } else {
                echo "Erro ao excluir movimentação de estoque!";
            }
        }
    }
}
<?php

class FornecedorController extends Controller
{
    private $modelFornecedor;

    public function __construct()
    {
        $this->modelFornecedor = new Fornecedor();
    }

    // dash

    public function Listar()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/fornecedor/listar';
        
        $fornecedor = $this->modelFornecedor->getFornecedores();
        $dados['fornecedor'] = $fornecedor;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Novo()
    {
        $dados = array();
        $dados['conteudo'] = 'admin/fornecedor/novo';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            // Verifica se o CNPJ já existe
            if ($this->modelFornecedor->verificarCnpjExistente($dadosPost['fornecedor_cnpj'])) {
                echo "<script>alert('Erro: Este CNPJ já está cadastrado no sistema!'); window.history.back();</script>";
                return;
            }
            
            $resultado = $this->modelFornecedor->addFornecedor(
                $dadosPost['fornecedor_nome'],
                $dadosPost['fornecedor_cnpj'],
                $dadosPost['fornecedor_email'],
                $dadosPost['fornecedor_telefone'],
                $dadosPost['fornecedor_endereco']
            );

            if ($resultado) {
                echo "<script>alert('Fornecedor cadastrado com sucesso!'); window.location.href='" . URL_BASE . "fornecedor/listar';</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar fornecedor!'); window.history.back();</script>";
            }
        }
    }

    public function Editar($id)
    {
        $dados = array();
        $dados['conteudo'] = 'admin/fornecedor/editar';

        $fornecedor = $this->modelFornecedor->getFornecedorbyID($id);
        
        if (empty($fornecedor)) {
            echo "Fornecedor não encontrado!";
            return;
        }

        $dados['fornecedor'] = $fornecedor[0];

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost)
    {
        if (!empty($dadosPost)) {
            
            $idFornecedor = $dadosPost['id_fornecedor'];
            
            // Verifica se o CNPJ já existe para outro fornecedor
            if (isset($dadosPost['fornecedor_cnpj']) && !empty($dadosPost['fornecedor_cnpj'])) {
                if ($this->modelFornecedor->verificarCnpjExistente($dadosPost['fornecedor_cnpj'], $idFornecedor)) {
                    echo "<script>alert('Erro: Este CNPJ já está cadastrado para outro fornecedor!'); window.history.back();</script>";
                    return;
                }
            }
            
            $dadosUpdate = array();
            
            if (isset($dadosPost['fornecedor_nome']) && !empty($dadosPost['fornecedor_nome'])) {
                $dadosUpdate['fornecedor_nome'] = $dadosPost['fornecedor_nome'];
            }
            
            if (isset($dadosPost['fornecedor_cnpj']) && !empty($dadosPost['fornecedor_cnpj'])) {
                $dadosUpdate['fornecedor_cnpj'] = $dadosPost['fornecedor_cnpj'];
            }
            
            if (isset($dadosPost['fornecedor_email']) && !empty($dadosPost['fornecedor_email'])) {
                $dadosUpdate['fornecedor_email'] = $dadosPost['fornecedor_email'];
            }
            
            if (isset($dadosPost['fornecedor_telefone']) && !empty($dadosPost['fornecedor_telefone'])) {
                $dadosUpdate['fornecedor_telefone'] = $dadosPost['fornecedor_telefone'];
            }
            
            if (isset($dadosPost['fornecedor_endereco']) && !empty($dadosPost['fornecedor_endereco'])) {
                $dadosUpdate['fornecedor_endereco'] = $dadosPost['fornecedor_endereco'];
            }

            $resultado = $this->modelFornecedor->patchFornecedor($dadosUpdate, $idFornecedor);

            if ($resultado) {
                echo "<script>alert('Fornecedor atualizado com sucesso!'); window.location.href='" . URL_BASE . "fornecedor/listar';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar fornecedor ou CNPJ já existe!'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Dados POST vazios!'); window.history.back();</script>";
        }
    }

    public function Excluir($id)
    {
        if (!empty($id)) {
            
            $fornecedor = $this->modelFornecedor->getFornecedorbyID($id);
            
            if (empty($fornecedor)) {
                echo "<script>alert('Fornecedor não encontrado!'); window.history.back();</script>";
                return;
            }

            $resultado = $this->modelFornecedor->excluirFornecedor($id);

            if ($resultado) {
                echo "<script>alert('Fornecedor excluído com sucesso!'); window.location.href='" . URL_BASE . "fornecedor/listar';</script>";
            } else {
                echo "<script>alert('Erro ao excluir fornecedor!'); window.history.back();</script>";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Fornecedor não encontrado";
            header("Location: " . URL_BASE . "fornecedor/listar");
            exit;
        }

        $fornecedor = $this->modelFornecedor->getFornecedorbyID($id);
        
        if (!$fornecedor) {
            $_SESSION['erro'] = "Fornecedor não encontrado";
            header("Location: " . URL_BASE . "fornecedor/listar");
            exit;
        }

        $novoStatus = $fornecedor[0]['fornecedor_status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelFornecedor->patchFornecedor(['fornecedor_status' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status do fornecedor atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do fornecedor";
        }

        header("Location: " . URL_BASE . "fornecedor/listar");
        exit;
    }
}
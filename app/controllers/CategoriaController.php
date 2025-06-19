<?php

class CategoriaController extends Controller
{
    private $modelCategoria;
    private $modelProduto;

    public function __construct()
    {
        $this->modelCategoria = new Categoria();
        $this->modelProduto = new Produto();
    }

    public function produtoCategoria($link){

        $dados = array();

        $categoria = $this->modelCategoria->getCategoriaNome($link);

        foreach ($categoria as $linha) {

            if ($this->gerarLinkCategoria($linha['nome_categoria']) == $link) {

              
                $dados['categorias'] = $linha;
                $dados['titulo'] = $linha['nome_categoria'];
                $this->carregarViews('categoria/listar', $dados);
                return;
            } else {
        }

        }
        
    }

    function gerarLinkcategoria($link)
    {

        $link = mb_strtolower($link, 'UTF-8');
        $caracter = [


            'á' => 'a',
            'à' => 'a',
            'ã' => 'a',
            'â' => 'a',
            'ä' => 'a',
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'í' => 'i',
            'ì' => 'i',
            'î' => 'i',
            'ï' => 'i',
            'ó' => 'o',
            'ò' => 'o',
            'õ' => 'o',
            'ô' => 'o',
            'ö' => 'o',
            'ú' => 'u',
            'ù' => 'u',
            'û' => 'u',
            'ü' => 'u',
            'ç' => 'c',
            ' ' => '-',
            '!' => '',
            '"' => '',
            '#' => '',
            '$' => '',
            '%' => '',
            '&' => '',
            "'" => '',
            '(' => '',
            ')' => '',
            '*' => '',
            '+' => '',
            ',' => '',
            '.' => '',
            '/' => '',
            ':' => '',
            ';' => '',
            '<' => '',
            '=' => '',
            '>' => '',
            '?' => '',
            '@' => '',
            '[' => '',
            ']' => '',
            '^' => '',
            '`' => '',
            '{' => '',
            '|' => '',
            '}' => '',
            '~' => '',
            '\\' => '',
            '–' => '-',
            '—' => '-',
            '"' => '',
            '"' => '',
            '´' => '',
        ];

        $link = strtr($link, $caracter);

        return $link;
    }


    // dash

    public function Listar(){
        $dados = array();
        $dados['conteudo'] = 'admin/categoria/listar';
        
        $categoria = $this->modelCategoria->getCategorias();
        $dados['categoria'] = $categoria;

        $this->carregarViews('admin/dash', $dados);
    }

    public function Nova(){
        $dados = array();
        $dados['conteudo'] = 'admin/categoria/nova';
        
        $this->carregarViews('admin/dash', $dados);
    }

    public function Cadastrar($dadosPost){
        if (!empty($dadosPost)) {
            
            $resultado = $this->modelCategoria->addCategoria(
                $dadosPost['nome_categoria'],
                $dadosPost['descricao_categoria']
            );

            if ($resultado) {
                header('Location: ' . URL_BASE . 'categoria/listar');
                exit;
            } else {
                echo "Erro ao cadastrar categoria!";
            }
        }
    }

    public function Editar($id){
        $dados = array();
        $dados['conteudo'] = 'admin/categoria/editar';

        // Buscar a categoria específica
        $categoria = $this->modelCategoria->getCategoriabyID($id);
        
        if (empty($categoria)) {
            echo "Categoria não encontrada! ID: " . $id;
            return;
        }

        $dados['categoria'] = $categoria[0]; // Pega o primeiro resultado

        $this->carregarViews('admin/dash', $dados);
    }

    public function Atualizar($dadosPost){
        if (!empty($dadosPost)) {
            
            $idCategoria = $dadosPost['id_categoria'];
            
            // Preparar dados para atualização
            $dadosUpdate = array();
            
            if (isset($dadosPost['nome_categoria']) && !empty($dadosPost['nome_categoria'])) {
                $dadosUpdate['nome_categoria'] = $dadosPost['nome_categoria'];
            }
            
            if (isset($dadosPost['descricao_categoria']) && !empty($dadosPost['descricao_categoria'])) {
                $dadosUpdate['descricao_categoria'] = $dadosPost['descricao_categoria'];
            }
            
            if (isset($dadosPost['status_categoria']) && !empty($dadosPost['status_categoria'])) {
                $dadosUpdate['status_categoria'] = $dadosPost['status_categoria'];
            }

            // Atualiza a categoria
            $resultado = $this->modelCategoria->patchCategoria($dadosUpdate, $idCategoria);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'categoria/listar');
                exit;
            } else {
                echo "Erro ao atualizar categoria!";
            }
        } else {
            echo "Dados POST vazios!";
        }
    }

    // Método para retornar categorias em JSON (para o dropdown do header)
    public function listarJson(){
        header('Content-Type: application/json');
        
        $categorias = $this->modelCategoria->getCategorias();
        
        // Filtrar apenas categorias ativas
        $categoriasAtivas = array_filter($categorias, function($categoria) {
            return $categoria['status_categoria'] === 'Ativa';
        });
        
        echo json_encode(array_values($categoriasAtivas));
        exit;
    }

    public function Excluir($id){
        if (!empty($id)) {
            
            // Buscar a categoria para verificar se existe
            $categoria = $this->modelCategoria->getCategoriabyID($id);
            
            if (empty($categoria)) {
                echo "Categoria não encontrada!";
                return;
            }

            // Atualizar status para inativo em vez de excluir
            $dadosUpdate = ['status_categoria' => 'Inativa'];
            $resultado = $this->modelCategoria->patchCategoria($dadosUpdate, $id);

            if ($resultado) {
                header('Location: ' . URL_BASE . 'categoria/listar');
                exit;
            } else {
                echo "Erro ao excluir categoria!";
            }
        }
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Categoria não encontrada";
            header("Location: " . URL_BASE . "categoria/listar");
            exit;
        }

        $categoria = $this->modelCategoria->getCategoriabyID($id);
        
        if (!$categoria) {
            $_SESSION['erro'] = "Categoria não encontrada";
            header("Location: " . URL_BASE . "categoria/listar");
            exit;
        }

        $novoStatus = $categoria[0]['status_categoria'] == 'Ativa' ? 'Inativa' : 'Ativa';
        
        if ($this->modelCategoria->patchCategoria(['status_categoria' => $novoStatus], $id)) {
            $_SESSION['sucesso'] = "Status da categoria atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status da categoria";
        }

        header("Location: " . URL_BASE . "categoria/listar");
        exit;
    }
}
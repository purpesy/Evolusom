<?php

class ProdutoController extends Controller
{


    private $modelProduto;
    private $modelCategoria;

    public function __construct()
    {

        $this->modelProduto = new Produto();
        $this->modelCategoria = new Categoria();
    }

    public function index()
    {
        $dados = array();

        // Parâmetros de filtro e paginação
        $categoria = isset($_GET['categoria']) ? (int)$_GET['categoria'] : null;
        $busca = isset($_GET['busca']) ? trim($_GET['busca']) : null;
        $pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
        $produtosPorPagina = 6; // Quantos produtos mostrar por vez
        $offset = ($pagina - 1) * $produtosPorPagina;

        // Buscar produtos baseado nos filtros
        if ($busca) {
            $produtos = $this->modelProduto->buscarProdutos($busca, $produtosPorPagina);
            $totalProdutos = $this->modelProduto->contarProdutos(null, $busca);
        } elseif ($categoria) {
            $produtos = $this->modelProduto->getProdutosPorCategoria($categoria, $produtosPorPagina);
            $totalProdutos = $this->modelProduto->contarProdutos($categoria);
        } else {
            $produtos = $this->modelProduto->getProdutosParaPagina($produtosPorPagina, $offset);
            $totalProdutos = $this->modelProduto->contarProdutos();
        }

        // Buscar todas as categorias para os filtros
        $categorias = $this->modelCategoria->getCategorias();

        // Calcular informações de paginação
        $totalPaginas = ceil($totalProdutos / $produtosPorPagina);

        // Formatar produtos para o JavaScript
        $produtosFormatados = [];
        foreach ($produtos as $produto) {
            $produtosFormatados[] = [
                'id' => (int)$produto['id_produto'],
                'titulo' => $produto['produto_nome'],
                'categoria' => $produto['nome_categoria'],
                'preco' => number_format($produto['produto_preco'], 2, ',', '.'),
                'precoNumerico' => (float)$produto['produto_preco'],
                'imagem' => !empty($produto['produto_foto']) ? URL_BASE . 'assets/img/produtos/' . $produto['produto_foto'] : 'https://via.placeholder.com/400x300/f0f0f0/666?text=' . urlencode($produto['produto_nome']),
                'descricao' => $produto['produto_descricao'],
                'estoque' => (int)$produto['produto_quantidade'],
                'disponivel' => (int)$produto['produto_quantidade'] > 0,
                'categoryId' => (int)$produto['id_categoria']
            ];
        }

        $dados['produtos'] = $produtos;
        $dados['produtosJs'] = $produtosFormatados;
        $dados['categorias'] = $categorias;
        $dados['totalProdutos'] = $totalProdutos;
        $dados['totalPaginas'] = $totalPaginas;
        $dados['paginaAtual'] = $pagina;
        $dados['categoriaAtual'] = $categoria;
        $dados['buscaAtual'] = $busca;

        $this->carregarViews('produtos', $dados);
    }

    // Método para lidar com URLs do tipo produto/categoria/1
    public function categoria($categoriaId = null)
    {
        if ($categoriaId) {
            // Redirecionar para a URL com parâmetro GET
            header('Location: ' . URL_BASE . 'produto?categoria=' . $categoriaId);
            exit;
        } else {
            // Se não tem categoria, vai para todos os produtos
            header('Location: ' . URL_BASE . 'produto');
            exit;
        }
    }

    function gerarLinkProduto($link)
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


    public function listar()
    {

        $dados = array();

        $dados['conteudo'] = 'admin/produto/listar';

        $produto = $this->modelProduto->getProdutos('produto');

        $dados['produto'] = $produto;

        $this->carregarViews('admin/dash', $dados);
    }


    //tabela para adicionar produto
    public function adicionar()
    {

        $dados = array();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $produto_nome = filter_input(INPUT_POST, 'produto_nome', FILTER_SANITIZE_SPECIAL_CHARS);
            $produto_descricao = filter_input(INPUT_POST, 'produto_descricao', FILTER_SANITIZE_SPECIAL_CHARS);
            $produto_preco = filter_input(INPUT_POST, 'produto_preco', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $id_categoria = filter_input(INPUT_POST, 'id_categoria', FILTER_SANITIZE_SPECIAL_CHARS);
            $produto_quantidade = filter_input(INPUT_POST, 'produto_quantidade', FILTER_SANITIZE_NUMBER_INT);
            $produto_alt = $produto_nome;

            date_default_timezone_set('America/Sao_Paulo');
            $data_criacao_produto = date('Y-m-d H:i:s');
            $produto_status = 'Pendente';

            if ($produto_nome && $produto_descricao && $produto_quantidade && $produto_status) {

                $dadosProduto = array(
                    
                    'produto_nome'                  => $produto_nome,
                    'produto_descricao'             => $produto_descricao,
                    'produto_preco'                 => $produto_preco,
                    'produto_quantidade'            => $produto_quantidade,
                    'produto_status'                => $produto_status,
                    'produto_data_cadastro'         => $data_criacao_produto,
                    'id_categoria'                  => $id_categoria

                );

                $id_produto = $this->modelProduto->addProduto($dadosProduto);

                if ($id_produto) {
                    if(isset($_FILES['produto_foto']) && $_FILES['produto_foto']['error'] == 0) {
                        $arquivo = $this->uploadFoto($_FILES['produto_foto'], $id_produto, $produto_nome);
                        if ($arquivo) {
                            $this->modelProduto->atualizarFoto($id_produto, $arquivo);
                            $_SESSION['Mensagem'] = "Produto adicionado com sucesso!";
                            $_SESSION['tipoMsg'] = "Sucesso!";
                        } else {
                            $_SESSION['Mensagem'] = "Produto adicionado, mas houve erro no upload da foto.";
                            $_SESSION['tipoMsg'] = "Aviso!";
                        }
                    } else {
                        $_SESSION['Mensagem'] = "Produto adicionado com sucesso!";
                        $_SESSION['tipoMsg'] = "Sucesso!";
                    }
                    header('Location: ' . URL_BASE . 'produto/listar');
                    exit;
                }
            }
        }

        $dados['conteudo'] = 'admin/produto/adicionar';
        $dados['categorias'] = $this->modelCategoria->getCategorias();
        $this->carregarViews('admin/dash', $dados);

    }

    public function uploadFoto($file, $id, $nome)
    {
        // Validação de arquivo
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return false;
        }

        // Verificar se o arquivo tem erro
        if ($file['error'] !== UPLOAD_ERR_OK) {
            error_log('Erro no upload: ' . $file['error']);
            return false;
        }

        // Validar tipo de arquivo
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!in_array($ext, $extensoesPermitidas)) {
            error_log('Extensão não permitida: ' . $ext);
            return false;
        }

        // Validar tamanho do arquivo (máximo 5MB)
        $tamanhoMaximo = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $tamanhoMaximo) {
            error_log('Arquivo muito grande: ' . $file['size']);
            return false;
        }

        $dir = '../public/assets/img/produtos/';

        if (!file_exists($dir)) {
            if (!mkdir($dir, 0755, true)) {
                error_log('Erro ao criar diretório: ' . $dir);
                return false;
            }
        }

        $novoNome = $id . '_' . $this->gerarLinkProduto($nome) . '.' . $ext;

        if (move_uploaded_file($file['tmp_name'], $dir . $novoNome)) {
            return $novoNome;
        }
        
        error_log('Erro ao mover arquivo para: ' . $dir . $novoNome);
        return false;
    }
    
    
    
    public function editar()
    {
        // Pega o ID do último segmento da URL
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Produto não encontrado";
            header("Location: " . URL_BASE . "produto/listar");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['produto_nome'] ?? '';
            $descricao = $_POST['produto_descricao'] ?? '';
            $preco = $_POST['produto_valor'] ?? '';
            $quantidade = $_POST['produto_quantidade'] ?? '';
            $id_categoria = $_POST['vcategoria'] ?? '';
            $status = isset($_POST['produto_status']) ? 1 : 0;

            if (empty($nome) || empty($descricao) || empty($preco) || empty($quantidade) || empty($id_categoria)) {
                $_SESSION['erro'] = "Todos os campos são obrigatórios";
                header("Location: " . URL_BASE . "produto/editar/" . $id);
                exit;
            }

            $dados = [
                'nome_produto' => $nome,
                'descricao_produto' => $descricao,
                'valor_produto' => $preco,
                'quantidade_produto' => $quantidade,
                'id_categoria' => $id_categoria,
                'status_produto' => $status
            ];

            // Processa a imagem apenas se uma nova foi enviada
            if (isset($_FILES['produto_foto']) && $_FILES['produto_foto']['error'] === UPLOAD_ERR_OK) {
                $arquivo = $_FILES['produto_foto'];
                $extensao = strtolower(pathinfo($arquivo['name'], PATHINFO_EXTENSION));
                $permitidos = ['jpg', 'jpeg', 'png', 'gif'];

                if (!in_array($extensao, $permitidos)) {
                    $_SESSION['erro'] = "Tipo de arquivo não permitido";
                    header("Location: " . URL_BASE . "produto/editar/" . $id);
                    exit;
                }

                $nomeArquivo = uniqid() . '.' . $extensao;
                $destino = 'assets/img/produtos/' . $nomeArquivo;

                if (move_uploaded_file($arquivo['tmp_name'], $destino)) {
                    // Remove a imagem antiga se existir
                    $produto_atual = $this->modelProduto->getProdutoId($id);
                    if ($produto_atual && !empty($produto_atual['foto_produto'])) {
                        $imagem_antiga = 'assets/img/produtos/' . $produto_atual['foto_produto'];
                        if (file_exists($imagem_antiga)) {
                            unlink($imagem_antiga);
                        }
                    }
                    $dados['foto_produto'] = $nomeArquivo;
                }
            }

            if ($this->modelProduto->updateProduto($dados, $id)) {
                $_SESSION['sucesso'] = "Produto atualizado com sucesso!";
                header("Location: " . URL_BASE . "produto/listar");
                exit;
            } else {
                $_SESSION['erro'] = "Erro ao atualizar produto";
                header("Location: " . URL_BASE . "produto/editar/" . $id);
                exit;
            }
        }

        $dados = array();
        $dados['conteudo'] = 'admin/produto/editar';
        $dados['produto'] = $this->modelProduto->getProdutoId($id);
        $dados['categorias'] = $this->modelCategoria->getCategorias('categorias');

        if (!$dados['produto']) {
            $_SESSION['erro'] = "Produto não encontrado";
            header("Location: " . URL_BASE . "produto/listar");
            exit;
        }

        $this->carregarViews('admin/dash', $dados);
    }

    public function toggleStatus()
    {
        $url = explode('/', $_SERVER['REQUEST_URI']);
        $id = end($url);

        if (!$id || !is_numeric($id)) {
            $_SESSION['erro'] = "Produto não encontrado";
            header("Location: " . URL_BASE . "produto/listar");
            exit;
        }

        $produto = $this->modelProduto->getProdutoId($id);
        
        if (!$produto) {
            $_SESSION['erro'] = "Produto não encontrado";
            header("Location: " . URL_BASE . "produto/listar");
            exit;
        }

        $novoStatus = $produto['produto_status'] == 'Ativo' ? 'Inativo' : 'Ativo';
        
        if ($this->modelProduto->atualizarStatus($id, $novoStatus)) {
            $_SESSION['sucesso'] = "Status do produto atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar status do produto";
        }

        header("Location: " . URL_BASE . "produto/listar");
        exit;
    }
}

<?php

class Produto extends Model
{

    public function getProdutos()
    {
        $sql = "SELECT * FROM tbl_produto  INNER JOIN tbl_categoria ON tbl_produto.id_categoria = tbl_categoria.id_categoria";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método específico para a página de produtos com dados formatados
    public function getProdutosParaPagina($limite = null, $offset = 0)
    {
        $sql = "SELECT * FROM tbl_produto p 
                INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
                LEFT JOIN tbl_especificacao e ON p.id_produto = e.id_produto
                WHERE p.produto_status = 'Ativo'
                ORDER BY RAND()";
        
        if ($limite) {
            $sql .= " LIMIT :limite OFFSET :offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            $stmt = $this->db->query($sql);
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar produtos em destaque para a home (6 produtos)
    public function getProdutosDestaque($limite = 6)
    {
        $sql = "SELECT p.*, c.nome_categoria 
                FROM tbl_produto p 
                INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
                WHERE p.produto_status = 'Ativo'
                ORDER BY RAND()
                LIMIT :limite";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produtos por categoria
    public function getProdutosPorCategoria($categoriaId, $limite = null)
    {
        $sql = "SELECT * FROM tbl_produto p 
                INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
                LEFT JOIN tbl_especificacao e ON p.id_produto = e.id_produto
                WHERE p.produto_status = 'Ativo' AND c.id_categoria = :categoria_id
                ORDER BY p.produto_nome ASC";
        
        if ($limite) {
            $sql .= " LIMIT :limite";
        }
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':categoria_id', $categoriaId, PDO::PARAM_INT);
        
        if ($limite) {
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar produtos com filtro de busca
    public function buscarProdutos($termo, $limite = null)
    {
        $sql = "SELECT * FROM tbl_produto p 
                INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
                LEFT JOIN tbl_especificacao e ON p.id_produto = e.id_produto
                WHERE p.produto_status = 'Ativo' 
                AND (p.produto_nome LIKE :termo OR p.produto_descricao LIKE :termo OR c.nome_categoria LIKE :termo)
                ORDER BY p.produto_nome ASC";
        
        if ($limite) {
            $sql .= " LIMIT :limite";
        }
        
        $stmt = $this->db->prepare($sql);
        $termo = "%{$termo}%";
        $stmt->bindValue(':termo', $termo, PDO::PARAM_STR);
        
        if ($limite) {
            $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        }
        
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



    // Contar total de produtos para paginação
    public function contarProdutos($categoriaId = null, $termo = null)
    {
        $sql = "SELECT COUNT(DISTINCT p.id_produto) as total FROM tbl_produto p 
                INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
                LEFT JOIN tbl_especificacao e ON p.id_produto = e.id_produto
                WHERE p.produto_status = 'Ativo'";
        
        $params = [];
        
        if ($categoriaId) {
            $sql .= " AND c.id_categoria = :categoria_id";
            $params[':categoria_id'] = $categoriaId;
        }
        
        if ($termo) {
            $sql .= " AND (p.produto_nome LIKE :termo OR p.produto_descricao LIKE :termo OR c.nome_categoria LIKE :termo)";
            $params[':termo'] = "%{$termo}%";
        }
        
        $stmt = $this->db->prepare($sql);
        
        foreach ($params as $param => $value) {
            $stmt->bindValue($param, $value);
        }
        
        $stmt->execute();
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

    //irar trazer as informaçoes dos produtos de acordo com a categoria
    public function getCategoriaProduto($id){

        $sql = "SELECT * FROM tbl_produto 
        INNER JOIN tbl_categoria ON tbl_produto.id_categoria = tbl_categoria.id_categoria
        WHERE produto_status = 'Ativo' AND id_categoria = :id_categoria";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_categoria', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProdutobyID($id)
    {
        $sql = "SELECT * FROM tbl_produto WHERE produto_status = 'Ativo' AND id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addProduto($dados)
    {
        $sql = "INSERT INTO tbl_produto (produto_nome, produto_descricao, produto_preco, produto_quantidade, produto_status, produto_data_cadastro, id_categoria) 
                VALUES (:nome, :descricao, :preco, :quantidade, :status, NOW(), :id_categoria)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $dados['produto_nome']);
        $stmt->bindValue(':descricao', $dados['produto_descricao']);
        $stmt->bindValue(':preco', $dados['produto_preco']);
        $stmt->bindValue(':quantidade', $dados['produto_quantidade']);
        $stmt->bindValue(':status', 'Pendente');
        $stmt->bindValue(':id_categoria', $dados['id_categoria']);

        $stmt->execute();
        return $this->db->lastInsertId();
    }

    public function patchProduto($dados, $id)
    {
        $campos = [];
        $parametros = [];
        foreach ($dados as $campo => $valor) {
            if (!empty($valor)) {
                $campos[] = "$campo = :$campo";
                $parametros[":$campo"] = $valor;
            }
        }
        if (empty($campos)) {
            return false;
        }
        // Adiciona o ID
        $parametros[':id_produto'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_produto SET " . implode(', ', $campos) . " WHERE id_produto = :id_produto";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function updateProduto($dados, $id){
        $campos = [];
        $parametros = [];
        foreach ($dados as $campo => $valor) {
            if (!empty($valor)) {
                $campos[] = "$campo = :$campo";
            }
        }
    }

    public function atualizarFoto($id, $foto)
    {

        $sql  = "UPDATE tbl_produto SET produto_foto = :foto WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':foto', $foto);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    public function getProdutoId($id){
        $sql = "SELECT * FROM tbl_produto
        INNER JOIN tbl_categoria ON tbl_produto.id_categoria = tbl_categoria.id_categoria
        WHERE id_produto = :id";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function atualizarStatus($id, $status)
    {
        $sql = "UPDATE tbl_produto SET produto_status = :status WHERE id_produto = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':status', $status);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }

}



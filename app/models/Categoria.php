<?php

class Categoria extends Model
{

    public function getCategorias()
    {
        $sql = "SELECT * FROM tbl_categoria";
        $query = $this->db->query($sql);
        $query->execute();
        $categoria = $query->fetchAll(PDO::FETCH_ASSOC);
        return $categoria;
    }




    //metodo para pegar o peagar o produto pelo nome da categoria
    public function getCategoriaNome($nome)
    {
        $sql = "SELECT * FROM tbl_produto 
        INNER JOIN tbl_categoria ON tbl_produto.id_categoria = tbl_categoria.id_categoria
        WHERE nome_categoria = :nome ORDER BY produto_nome";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':nome' => "$nome%"]);

        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }

    public function getProdutosPorCategoria($nomeCategoria)
{
    $sql = "SELECT *
            FROM tbl_produto p
            INNER JOIN tbl_categoria c ON p.id_categoria = c.id_categoria
            WHERE c.nome_categoria = :nome";

    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(':nome', $nomeCategoria);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}




    public function getCategoriabyID($id)
    {
        $sql = "SELECT * FROM tbl_categoria WHERE id_categoria = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategoria($nome, $descricao)
    {
        $sql = "INSERT INTO tbl_categoria (nome_categoria, descricao_categoria, status_categoria) VALUES (:nome, :descricao, 'Ativa')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        return $stmt->execute();
    }

    public function patchCategoria($dados, $id)
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
        $parametros[':id_categoria'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_categoria SET " . implode(', ', $campos) . " WHERE id_categoria = :id_categoria";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirCategoria($id)
    {
        $sql = "UPDATE tbl_categoria SET status_categoria = 'Inativa' WHERE id_categoria = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

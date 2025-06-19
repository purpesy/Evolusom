<?php

class Estoque extends Model
{

    public function getEstoques()
    {
        $sql = "SELECT * FROM tbl_estoque 
                INNER JOIN tbl_produto ON tbl_estoque.id_produto = tbl_produto.id_produto
                ORDER BY estoque_data_movimentacao DESC";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEstoquebyID($id)
    {
        $sql = "SELECT * FROM tbl_estoque WHERE id_estoque = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addeEstoque($quantidade, $tipo, $observacoes, $id_produto)
    {
        $sql = "INSERT INTO tbl_estoque (estoque_quantidade, estoque_data_movimentacao, estoque_tipo_movimentacao, estoque_observacoes, id_produto) VALUES (:quantidade, NOW(), :tipo, :observacoes, :id_produto)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':quantidade', $quantidade);
        $stmt->bindValue(':tipo', $tipo);
        $stmt->bindValue(':observacoes', $observacoes);
        $stmt->bindValue(':id_produto', $id_produto);
        return $stmt->execute();
    }

    public function patchEstoque($dados, $id)
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
        $parametros[':id_estoque'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_estoque SET " . implode(', ', $campos) . " WHERE id_estoque = :id_estoque";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirEstoque($id)
    {
        $sql = "DELETE FROM tbl_estoque WHERE id_estoque = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

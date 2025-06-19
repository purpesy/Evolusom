<?php

class ItemPedido extends Model
{
    public function getItensPorPedido($id_pedido)
    {
        $sql = "SELECT ip.*, p.produto_nome, p.produto_descricao 
                FROM tbl_itempedido ip 
                INNER JOIN tbl_produto p ON ip.id_produto = p.id_produto 
                WHERE ip.id_pedido = :id_pedido 
                ORDER BY ip.id_itempedido";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pedido', (int)$id_pedido, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar itens do pedido: ' . $e->getMessage());
            return [];
        }
    }

    public function addItemPedido($id_pedido, $id_produto, $quantidade, $preco_unitario)
    {
        if (empty($id_pedido) || empty($id_produto) || empty($quantidade) || empty($preco_unitario)) {
            return false;
        }

        $valor_total = $quantidade * $preco_unitario;

        try {
            $sql = "INSERT INTO tbl_itempedido (id_pedido, id_produto, quantidade, preco_unitario, valor_total) 
                    VALUES (:id_pedido, :id_produto, :quantidade, :preco_unitario, :valor_total)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pedido', $id_pedido);
            $stmt->bindValue(':id_produto', $id_produto);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':preco_unitario', $preco_unitario);
            $stmt->bindValue(':valor_total', $valor_total);
            
            $resultado = $stmt->execute();
            
            if ($resultado) {
                return $this->db->lastInsertId();
            }
            
            return false;
            
        } catch (PDOException $e) {
            error_log("Erro ao inserir item do pedido: " . $e->getMessage());
            return false;
        }
    }

    public function updateItemPedido($id_itempedido, $quantidade, $preco_unitario)
    {
        if (empty($id_itempedido) || empty($quantidade) || empty($preco_unitario)) {
            return false;
        }

        $valor_total = $quantidade * $preco_unitario;

        try {
            $sql = "UPDATE tbl_itempedido 
                    SET quantidade = :quantidade, preco_unitario = :preco_unitario, valor_total = :valor_total 
                    WHERE id_itempedido = :id_itempedido";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':quantidade', $quantidade);
            $stmt->bindValue(':preco_unitario', $preco_unitario);
            $stmt->bindValue(':valor_total', $valor_total);
            $stmt->bindValue(':id_itempedido', $id_itempedido);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erro ao atualizar item do pedido: " . $e->getMessage());
            return false;
        }
    }

    public function removeItemPedido($id_itempedido)
    {
        try {
            $sql = "DELETE FROM tbl_itempedido WHERE id_itempedido = :id_itempedido";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_itempedido', (int)$id_itempedido, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao remover item do pedido: " . $e->getMessage());
            return false;
        }
    }

    public function calcularTotalPedido($id_pedido)
    {
        try {
            $sql = "SELECT SUM(valor_total) as total FROM tbl_itempedido WHERE id_pedido = :id_pedido";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pedido', (int)$id_pedido, PDO::PARAM_INT);
            $stmt->execute();
            
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] ?? 0;
        } catch (PDOException $e) {
            error_log("Erro ao calcular total do pedido: " . $e->getMessage());
            return 0;
        }
    }

    public function getItemById($id_itempedido)
    {
        try {
            $sql = "SELECT ip.*, p.produto_nome 
                    FROM tbl_itempedido ip 
                    INNER JOIN tbl_produto p ON ip.id_produto = p.id_produto 
                    WHERE ip.id_itempedido = :id_itempedido";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_itempedido', (int)$id_itempedido, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar item por ID: " . $e->getMessage());
            return false;
        }
    }
} 
<?php

class Pedido extends Model
{

    public function getPedidos()
    {
        $sql = "SELECT p.*, c.cliente_nome, c.cliente_telefone 
                FROM tbl_pedido p 
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente 
                ORDER BY p.id_pedido DESC";
        
        try {
            $query = $this->db->query($sql);
            $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Converter status numérico para texto se necessário
            foreach ($pedidos as &$pedido) {
                $pedido['pedido_status'] = $this->converterStatus($pedido['pedido_status']);
            }
            
            return $pedidos;
        } catch (PDOException $e) {
            error_log('Erro ao buscar pedidos: ' . $e->getMessage());
            return [];
        }
    }

    private function converterStatus($status)
    {
        // Se o status já é texto, retorna como está
        if (!is_numeric($status)) {
            return $status;
        }
        
        // Converte status numérico para texto
        switch ((int)$status) {
            case 0:
                return 'Pendente';
            case 1:
                return 'Aprovado';
            case 2:
                return 'Entregue';
            case 3:
                return 'Cancelado';
            default:
                return 'Pendente';
        }
    }

    public function getPedidobyID($id)
    {
        $sql = "SELECT p.*, c.cliente_nome, c.cliente_telefone, c.cliente_email 
                FROM tbl_pedido p 
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente 
                WHERE p.id_pedido = :id";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Converter status numérico para texto se necessário
            foreach ($pedidos as &$pedido) {
                $pedido['pedido_status'] = $this->converterStatus($pedido['pedido_status']);
            }
            
            return $pedidos;
        } catch (PDOException $e) {
            error_log('Erro ao buscar pedido por ID: ' . $e->getMessage());
            return [];
        }
    }

    public function addPedido($datapedido, $id_cliente, $produtos = [])
    {
        // Validação básica
        if (empty($datapedido) || empty($id_cliente)) {
            return false;
        }

        try {
            // Inicia transação
            $this->db->beginTransaction();

            // Criar pedido com valor inicial 0
            $sql = "INSERT INTO tbl_pedido (pedido_data, pedido_valor_total, id_cliente, pedido_status) 
                    VALUES (:datapedido, 0, :id_cliente, 0)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':datapedido', $datapedido);
            $stmt->bindValue(':id_cliente', $id_cliente);
            
            $resultado = $stmt->execute();
            
            if (!$resultado) {
                $this->db->rollBack();
                return false;
            }

            $id_pedido = $this->db->lastInsertId();

            // Se há produtos, adicioná-los ao pedido
            if (!empty($produtos)) {
                $modelItemPedido = new ItemPedido();
                $valor_total = 0;

                foreach ($produtos as $produto) {
                    $item_resultado = $modelItemPedido->addItemPedido(
                        $id_pedido,
                        $produto['id_produto'],
                        $produto['quantidade'],
                        $produto['preco_unitario']
                    );

                    if (!$item_resultado) {
                        $this->db->rollBack();
                        return false;
                    }

                    $valor_total += ($produto['quantidade'] * $produto['preco_unitario']);
                }

                // Atualizar o valor total do pedido
                $this->atualizarValorTotal($id_pedido, $valor_total);
            }

            $this->db->commit();
            return $id_pedido;
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erro ao inserir pedido: " . $e->getMessage());
            return false;
        }
    }

    public function addProdutoAoPedido($id_pedido, $id_produto, $quantidade, $preco_unitario)
    {
        try {
            $modelItemPedido = new ItemPedido();
            
            // Adicionar item ao pedido
            $resultado = $modelItemPedido->addItemPedido($id_pedido, $id_produto, $quantidade, $preco_unitario);
            
            if ($resultado) {
                // Recalcular o total do pedido
                $this->recalcularTotalPedido($id_pedido);
                return $resultado;
            }
            
            return false;
            
        } catch (Exception $e) {
            error_log("Erro ao adicionar produto ao pedido: " . $e->getMessage());
            return false;
        }
    }

    public function recalcularTotalPedido($id_pedido)
    {
        try {
            $modelItemPedido = new ItemPedido();
            $total = $modelItemPedido->calcularTotalPedido($id_pedido);
            
            return $this->atualizarValorTotal($id_pedido, $total);
            
        } catch (Exception $e) {
            error_log("Erro ao recalcular total do pedido: " . $e->getMessage());
            return false;
        }
    }

    private function atualizarValorTotal($id_pedido, $valor_total)
    {
        try {
            $sql = "UPDATE tbl_pedido SET pedido_valor_total = :valor_total WHERE id_pedido = :id_pedido";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':valor_total', $valor_total);
            $stmt->bindValue(':id_pedido', $id_pedido);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erro ao atualizar valor total do pedido: " . $e->getMessage());
            return false;
        }
    }

    public function getPedidoComItens($id_pedido)
    {
        try {
            // Buscar dados do pedido
            $pedido = $this->getPedidobyID($id_pedido);
            
            if (empty($pedido)) {
                return null;
            }

            // Buscar itens do pedido
            $modelItemPedido = new ItemPedido();
            $itens = $modelItemPedido->getItensPorPedido($id_pedido);

            $pedido[0]['itens'] = $itens;
            
            return $pedido[0];
            
        } catch (Exception $e) {
            error_log("Erro ao buscar pedido com itens: " . $e->getMessage());
            return null;
        }
    }

    public function getPedidosPendentes()
    {
        $sql = "SELECT p.*, c.cliente_nome, c.cliente_telefone 
                FROM tbl_pedido p 
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente 
                WHERE p.pedido_status = 0
                ORDER BY p.pedido_data ASC";
        
        try {
            $query = $this->db->query($sql);
            $pedidos = $query->fetchAll(PDO::FETCH_ASSOC);
            
            // Converter status numérico para texto
            foreach ($pedidos as &$pedido) {
                $pedido['pedido_status'] = $this->converterStatus($pedido['pedido_status']);
            }
            
            return $pedidos;
        } catch (PDOException $e) {
            error_log('Erro ao buscar pedidos pendentes: ' . $e->getMessage());
            return [];
        }
    }

    public function marcarComoEntregue($id_pedido)
    {
        try {
            $sql = "UPDATE tbl_pedido SET pedido_status = 'Entregue' WHERE id_pedido = :id_pedido";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_pedido', (int)$id_pedido, PDO::PARAM_INT);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erro ao marcar pedido como entregue: " . $e->getMessage());
            return false;
        }
    }

    public function patchPedido($dados, $id)
    {
        $campos = [];
        $parametros = [];
        
        foreach ($dados as $campo => $valor) {
            // Converter status de texto para número se necessário
            if ($campo === 'pedido_status') {
                $valor = $this->converterStatusParaNumero($valor);
            }
            
            if (!empty($valor) || $valor === '0' || $valor === 0) {
                $campos[] = "$campo = :$campo";
                $parametros[":$campo"] = $valor;
            }
        }
        
        if (empty($campos)) {
            return false;
        }
        
        // Adiciona o ID
        $parametros[':id_pedido'] = $id;
        
        try {
            // Monta a query
            $sql = "UPDATE tbl_pedido SET " . implode(', ', $campos) . " WHERE id_pedido = :id_pedido";
            $stmt = $this->db->prepare($sql);
            
            // Faz o bind dos parâmetros
            foreach ($parametros as $campo => $valor) {
                $stmt->bindValue($campo, $valor);
            }
            
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar pedido: " . $e->getMessage());
            return false;
        }
    }

    private function converterStatusParaNumero($status)
    {
        // Se já é número, retorna como está
        if (is_numeric($status)) {
            return (int)$status;
        }
        
        // Converte texto para número
        switch (strtolower(trim($status))) {
            case 'pendente':
                return 0;
            case 'aprovado':
                return 1;
            case 'entregue':
                return 2;
            case 'cancelado':
                return 3;
            default:
                return 0; // Default para Pendente
        }
    }

    public function excluirPedido($id)
    {
        try {
            // Inicia transação
            $this->db->beginTransaction();

            // Remove todos os itens do pedido
            $sql_itens = "DELETE FROM tbl_itempedido WHERE id_pedido = :id_pedido";
            $stmt_itens = $this->db->prepare($sql_itens);
            $stmt_itens->bindValue(':id_pedido', (int)$id, PDO::PARAM_INT);
            $stmt_itens->execute();

            // Remove o pedido
            $sql_pedido = "DELETE FROM tbl_pedido WHERE id_pedido = :id_pedido";
            $stmt_pedido = $this->db->prepare($sql_pedido);
            $stmt_pedido->bindValue(':id_pedido', (int)$id, PDO::PARAM_INT);
            $resultado = $stmt_pedido->execute();

            if ($resultado) {
                $this->db->commit();
                return true;
            } else {
                $this->db->rollBack();
                return false;
            }
            
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Erro ao excluir pedido: " . $e->getMessage());
            return false;
        }
    }
}

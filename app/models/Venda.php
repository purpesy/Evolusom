<?php

class Venda extends Model
{

    public function getVendas()
    {
        $sql = "SELECT v.*, f.funcionario_nome, p.pedido_data, p.pedido_valor_total, c.cliente_nome
                FROM tbl_venda v
                INNER JOIN tbl_funcionario f ON v.id_funcionario = f.id_funcionario
                INNER JOIN tbl_pedido p ON v.id_pedido = p.id_pedido
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente
                ORDER BY v.id_venda DESC";
        
        try {
            $query = $this->db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar vendas: ' . $e->getMessage());
            return [];
        }
    }

    public function getVendaByID($id)
    {
        $sql = "SELECT v.*, f.funcionario_nome, p.pedido_data, p.pedido_valor_total, c.cliente_nome, c.cliente_email
                FROM tbl_venda v
                INNER JOIN tbl_funcionario f ON v.id_funcionario = f.id_funcionario
                INNER JOIN tbl_pedido p ON v.id_pedido = p.id_pedido
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente
                WHERE v.id_venda = :id";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar venda por ID: ' . $e->getMessage());
            return [];
        }
    }

    public function addVenda($datavenda, $id_funcionario, $id_pedido, $forma_pagamento, $status_pagamento = 'Pendente')
    {
        // Validação básica
        if (empty($datavenda) || empty($id_funcionario) || empty($id_pedido) || empty($forma_pagamento)) {
            error_log("Dados obrigatórios faltando - Data: $datavenda, Funcionário: $id_funcionario, Pedido: $id_pedido, Forma: $forma_pagamento");
            return false;
        }

        try {
            // Verificar se o pedido existe
            $modelPedido = new Pedido();
            $pedido = $modelPedido->getPedidobyID($id_pedido);
            
            if (empty($pedido)) {
                error_log("Pedido não encontrado: " . $id_pedido);
                return false;
            }

            // Verificar se já existe uma venda para este pedido
            $sql_check = "SELECT id_venda FROM tbl_venda WHERE id_pedido = :id_pedido";
            $stmt_check = $this->db->prepare($sql_check);
            $stmt_check->bindValue(':id_pedido', $id_pedido);
            $stmt_check->execute();
            
            if ($stmt_check->fetch()) {
                error_log("Já existe uma venda para o pedido: " . $id_pedido);
                return false;
            }

            // Usar o valor do pedido para a venda
            $valor_venda = $pedido[0]['pedido_valor_total'];

            $sql = "INSERT INTO tbl_venda (venda_data, venda_valor, id_funcionario, id_pedido, forma_pagamento, status_pagamento) 
                    VALUES (:datavenda, :valor, :funcionario, :pedido, :forma_pagamento, :status_pagamento)";
            
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':datavenda', $datavenda);
            $stmt->bindValue(':valor', $valor_venda);
            $stmt->bindValue(':funcionario', (int)$id_funcionario, PDO::PARAM_INT);
            $stmt->bindValue(':pedido', (int)$id_pedido, PDO::PARAM_INT);
            $stmt->bindValue(':forma_pagamento', $forma_pagamento);
            $stmt->bindValue(':status_pagamento', $status_pagamento);
            
            $resultado = $stmt->execute();
            
            if ($resultado) {
                return $this->db->lastInsertId();
            }
            
            return false;
            
        } catch (PDOException $e) {
            error_log("Erro ao inserir venda: " . $e->getMessage());
            return false;
        }
    }

    public function getPedidosDisponiveis()
    {
        // Buscar pedidos que ainda não foram vendidos
        $sql = "SELECT p.*, c.cliente_nome, c.cliente_telefone 
                FROM tbl_pedido p 
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente 
                WHERE p.id_pedido NOT IN (SELECT id_pedido FROM tbl_venda WHERE id_pedido IS NOT NULL)
                ORDER BY p.pedido_data DESC";
        
        try {
            $query = $this->db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar pedidos disponíveis: ' . $e->getMessage());
            return [];
        }
    }

    public function getVendaComDetalhes($id_venda)
    {
        try {
            // Buscar dados da venda
            $venda = $this->getVendaByID($id_venda);
            
            if (empty($venda)) {
                return null;
            }

            // Buscar itens do pedido
            $modelItemPedido = new ItemPedido();
            $itens = $modelItemPedido->getItensPorPedido($venda[0]['id_pedido']);

            $venda[0]['itens_pedido'] = $itens;
            
            return $venda[0];
            
        } catch (Exception $e) {
            error_log("Erro ao buscar venda com detalhes: " . $e->getMessage());
            return null;
        }
    }

    public function patchVenda($dados, $id)
    {
        $campos = [];
        $parametros = [];
        
        foreach ($dados as $campo => $valor) {
            if (!empty($valor) || $valor === '0' || $valor === 0) {
                $campos[] = "$campo = :$campo";
                $parametros[":$campo"] = $valor;
            }
        }
        
        if (empty($campos)) {
            return false;
        }
        
        // Adiciona o ID
        $parametros[':id_venda'] = $id;
        
        try {
            // Monta a query
            $sql = "UPDATE tbl_venda SET " . implode(', ', $campos) . " WHERE id_venda = :id_venda";
            
            $stmt = $this->db->prepare($sql);
            
            // Faz o bind dos parâmetros
            foreach ($parametros as $campo => $valor) {
                $stmt->bindValue($campo, $valor);
            }
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erro ao atualizar venda: " . $e->getMessage());
            return false;
        }
    }

    public function excluirVenda($id)
    {
        try {
            // Buscar a venda para pegar o pedido associado
            $venda = $this->getVendaByID($id);
            
            if (!empty($venda)) {
                // Voltar o status do pedido para pendente
                $modelPedido = new Pedido();
                $modelPedido->patchPedido(['pedido_status' => 'Pendente'], $venda[0]['id_pedido']);
            }
            
            // Excluir a venda
            $sql = "DELETE FROM tbl_venda WHERE id_venda = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
            
            return $stmt->execute();
            
        } catch (PDOException $e) {
            error_log("Erro ao excluir venda: " . $e->getMessage());
            return false;
        }
    }

    public function getVendasPorPeriodo($data_inicio, $data_fim)
    {
        $sql = "SELECT v.*, f.funcionario_nome, p.pedido_valor_total, c.cliente_nome
                FROM tbl_venda v
                INNER JOIN tbl_funcionario f ON v.id_funcionario = f.id_funcionario
                INNER JOIN tbl_pedido p ON v.id_pedido = p.id_pedido
                LEFT JOIN tbl_cliente c ON p.id_cliente = c.id_cliente
                WHERE v.venda_data BETWEEN :data_inicio AND :data_fim
                ORDER BY v.venda_data DESC";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':data_inicio', $data_inicio);
            $stmt->bindValue(':data_fim', $data_fim);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar vendas por período: ' . $e->getMessage());
            return [];
        }
    }
}

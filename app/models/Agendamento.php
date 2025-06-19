<?php

class Agendamento extends Model
{

    public function getTodosAgendamentos()
    {
        $sql = "SELECT * FROM tbl_agendamento 
                INNER JOIN tbl_cliente ON tbl_agendamento.id_cliente = tbl_cliente.id_cliente
                ORDER BY tbl_agendamento.agendamento_data DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAgendamentobyID($id)
    {
        $sql = "SELECT * FROM tbl_agendamento 
                INNER JOIN tbl_cliente ON tbl_agendamento.id_cliente = tbl_cliente.id_cliente 
                WHERE tbl_agendamento.id_agendamento = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addAgendamento($dataAgendamento, $observacao, $cliente)
    {
        $sql = "INSERT INTO tbl_agendamento (agendamento_data, agendamento_observacoes, id_cliente, status_agendamento) 
                VALUES (:dataAgendamento, :observacao, :id_cliente, 'Pendente')";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':dataAgendamento', $dataAgendamento);
        $stmt->bindValue(':observacao', $observacao);
        $stmt->bindValue(':id_cliente', $cliente);
        return $stmt->execute();
    }

    public function patchAgendamento($id, $dados)
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

        $sql = "UPDATE tbl_agendamento SET " . implode(", ", $campos) . " WHERE id_agendamento = :id_agendamento";
        $stmt = $this->db->prepare($sql);
       
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        
        $stmt->bindValue(':id_agendamento', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function atualizarAgendamento($dados, $id)
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
        
        $parametros[':id_agendamento'] = $id;
        
        $sql = "UPDATE tbl_agendamento SET " . implode(', ', $campos) . " WHERE id_agendamento = :id_agendamento";
        $stmt = $this->db->prepare($sql);
        
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        
        return $stmt->execute();
    }

    public function excluirAgendamento($id)
    {
        $sql = "DELETE FROM tbl_agendamento WHERE id_agendamento = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAgendamentosPorCliente($id_cliente)
    {
        $sql = "SELECT * FROM tbl_agendamento 
                WHERE id_cliente = :id_cliente 
                ORDER BY agendamento_data DESC";
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id_cliente', (int)$id_cliente, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Erro ao buscar agendamentos do cliente: ' . $e->getMessage());
            return [];
        }
    }
}

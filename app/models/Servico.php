<?php

class Servico extends Model
{

    public function getServicos()
    {
        $sql = "SELECT * FROM tbl_servico ORDER BY nome_servico";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para buscar serviços limitados (para página de serviços)
    public function getServicosLimitados($limite = 6)
    {
        $sql = "SELECT * FROM tbl_servico ORDER BY RAND() LIMIT :limite";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limite', $limite, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getServicobyID($id)
    {
        $sql = "SELECT * FROM tbl_servico WHERE id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addServico($nome, $descricao, $preco)
    {
        $sql = "INSERT INTO tbl_servico (nome_servico, descricao_servico, preco_servico) VALUES (:nome, :descricao, :preco)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':descricao', $descricao);
        $stmt->bindValue(':preco', $preco);
        return $stmt->execute();
    }

    public function patchServico($dados, $id)
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
        $parametros[':id_servico'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_servico SET " . implode(', ', $campos) . " WHERE id_servico = :id_servico";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirServico($id)
    {
        $sql = "DELETE FROM tbl_servico WHERE id_servico = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

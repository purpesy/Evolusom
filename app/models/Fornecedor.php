<?php

class Fornecedor extends Model
{

    public function getFornecedores()
    {
        $sql = "SELECT * FROM tbl_fornecedor";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFornecedorbyID($id)
    {
        $sql = "SELECT * FROM tbl_fornecedor WHERE id_fornecedor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificarCnpjExistente($cnpj, $idExcluir = null)
    {
        if ($idExcluir) {
            $sql = "SELECT COUNT(*) FROM tbl_fornecedor WHERE fornecedor_cnpj = :cnpj AND id_fornecedor != :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':cnpj', $cnpj);
            $stmt->bindValue(':id', $idExcluir);
        } else {
            $sql = "SELECT COUNT(*) FROM tbl_fornecedor WHERE fornecedor_cnpj = :cnpj";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':cnpj', $cnpj);
        }
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    public function addFornecedor($nome, $cnpj, $email, $fone, $endereco)
    {
        // Verifica se o CNPJ já existe
        if ($this->verificarCnpjExistente($cnpj)) {
            return false; // CNPJ já existe
        }

        $sql = "INSERT INTO tbl_fornecedor (fornecedor_nome, fornecedor_cnpj, fornecedor_email, fornecedor_telefone, fornecedor_endereco) VALUES (:nome, :cnpj, :email, :fone, :endereco)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':cnpj', $cnpj);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':fone', $fone);
        $stmt->bindValue(':endereco', $endereco);
        return $stmt->execute();
    }

    public function patchFornecedor($dados, $id)
    {
        // Se está atualizando o CNPJ, verifica se já existe
        if (isset($dados['fornecedor_cnpj'])) {
            if ($this->verificarCnpjExistente($dados['fornecedor_cnpj'], $id)) {
                return false; // CNPJ já existe para outro fornecedor
            }
        }

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
        $parametros[':id_fornecedor'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_fornecedor SET " . implode(', ', $campos) . " WHERE id_fornecedor = :id_fornecedor";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirFornecedor($id)
    {
        $sql = "DELETE FROM tbl_fornecedor WHERE id_fornecedor = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

<?php

class Funcionario extends Model
{

    public function getFuncionarios()
    {
        $sql = "SELECT * FROM tbl_funcionario";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getFuncionariobyID($id)
    {
        $sql = "SELECT * FROM tbl_funcionario WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFuncionario($nome, $fone, $email, $cargo, $cpf, $senha)
    {
        $sql = "INSERT INTO tbl_funcionario (funcionario_nome, funcionario_telefone, funcionario_email, funcionario_cargo, funcionario_cpf, funcionario_senha) VALUES (:nome, :fone, :email, :cargo, :cpf, :senha)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':fone', $fone);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':cargo', $cargo);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':senha', $senha);
        return $stmt->execute();
    }

    public function patchFuncionario($dados, $id)
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
        $parametros[':id_funcionario'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_funcionario SET " . implode(', ', $campos) . " WHERE id_funcionario = :id_funcionario";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirFuncionario($id)
    {
        $sql = "DELETE FROM tbl_funcionario WHERE id_funcionario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    //metodo para buscar funcionarios por email e senha, somente os ativos

    public function buscarFunc($email, $senha)
    {
        $sql = "SELECT * FROM tbl_funcionario WHERE funcionario_email = :email AND funcionario_senha = :senha";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

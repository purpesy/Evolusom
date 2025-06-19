<?php

class Cliente extends Model
{

    public function getClientes()
    {
        $sql = "SELECT * FROM tbl_cliente";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
    }

    public function getClientebyID($id)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCliente($nome, $telefone, $email, $cpf, $senha)
    {
        try {
            $sql = "INSERT INTO tbl_cliente (cliente_nome, cliente_telefone, cliente_email, cliente_cpf, cliente_senha, cliente_status) VALUES (:nome, :telefone, :email, :cpf, :senha, 'Ativo')";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':telefone', $telefone);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':cpf', $cpf);
            $stmt->bindValue(':senha', $senha);
            
            $resultado = $stmt->execute();
            
            if (!$resultado) {
                error_log("Erro ao inserir cliente: " . implode(", ", $stmt->errorInfo()));
            }
            
            return $resultado;
        } catch (PDOException $e) {
            error_log("Erro PDO ao inserir cliente: " . $e->getMessage());
            return false;
        }
    }

    public function patchCliente($dados, $id)
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
        $parametros[':id_cliente'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_cliente SET " . implode(', ', $campos) . " WHERE id_cliente = :id_cliente";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirCliente($id)
    {
        $sql = "DELETE FROM tbl_cliente WHERE id_cliente = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function buscarCliente($email, $senha)
    {
        $sql = "SELECT * FROM tbl_cliente WHERE cliente_email = :email AND cliente_senha = :senha AND cliente_status = 'Ativo'";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':senha', $senha);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function verificarTabelaCliente()
    {
        try {
            // Verificar se a tabela existe
            $sql = "SHOW TABLES LIKE 'tbl_cliente'";
            $stmt = $this->db->query($sql);
            $tabela = $stmt->fetch();
            
            if (!$tabela) {
                return ['erro' => 'Tabela tbl_cliente não existe'];
            }
            
            // Verificar estrutura da tabela
            $sql = "DESCRIBE tbl_cliente";
            $stmt = $this->db->query($sql);
            $colunas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return ['sucesso' => true, 'colunas' => $colunas];
            
        } catch (PDOException $e) {
            return ['erro' => $e->getMessage()];
        }
    }

    public function atualizarCliente($dados)
    {
        $sql = "UPDATE tbl_cliente SET 
                cliente_nome = :cliente_nome,
                cliente_email = :cliente_email,
                cliente_telefone = :cliente_telefone";

        // Se uma nova senha foi fornecida, adiciona ao SQL
        if(isset($dados['cliente_senha'])) {
            $sql .= ", cliente_senha = :cliente_senha";
        }

        $sql .= " WHERE id_cliente = :id_cliente";

        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_cliente', $dados['id_cliente']);
        $stmt->bindParam(':cliente_nome', $dados['cliente_nome']);
        $stmt->bindParam(':cliente_email', $dados['cliente_email']);
        $stmt->bindParam(':cliente_telefone', $dados['cliente_telefone']);

        if(isset($dados['cliente_senha'])) {
            $stmt->bindParam(':cliente_senha', $dados['cliente_senha']);
        }

        return $stmt->execute();
    }
}

<?php

class Usuario extends Model
{

    public function getUsuarios()
    {
        $sql = "SELECT * FROM tbl_usuario ORDER BY usuario_nome";
        $query = $this->db->query($sql);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsuariobyID($id)
    {
        $sql = "SELECT * FROM tbl_usuario WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addUsuario($nome, $email, $login, $senha, $nivel)
    {
        $sql = "INSERT INTO tbl_usuario (usuario_nome, usuario_email, usuario_login, usuario_senha, usuario_nivel) VALUES (:nome, :email, :login, :senha, :nivel)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':login', $login);
        $stmt->bindValue(':senha', md5($senha)); // Hash simples para testes
        $stmt->bindValue(':nivel', $nivel);
        return $stmt->execute();
    }

    public function patchUsuario($dados, $id)
    {
        // Se estiver atualizando a senha, aplica hash
        if (isset($dados['usuario_senha']) && !empty($dados['usuario_senha'])) {
            $dados['usuario_senha'] = md5($dados['usuario_senha']);
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
        $parametros[':id_usuario'] = $id;
        // Monta a query
        $sql = "UPDATE tbl_usuario SET " . implode(', ', $campos) . " WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        // Faz o bind dos parâmetros
        foreach ($parametros as $campo => $valor) {
            $stmt->bindValue($campo, $valor);
        }
        return $stmt->execute();
    }

    public function excluirUsuario($id)
    {
        $sql = "DELETE FROM tbl_usuario WHERE id_usuario = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
        return $stmt->execute();
    }
} 
<?php 

class Contato extends Model{

    public function salvarEmail($nome, $email, $fone, $assunto, $msg, $status, $dataHora){

        $sql = "INSERT INTO tbl_contato(nome_contato, email_contato, telefone_contato, 
        assunto_contato, mensagem_contato, status_contato, data_hora_contato) 
        VALUES (:nome, :email, :fone, :assunto, :msg, :status_contato, :data_hora)";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':fone', $fone);
        $stmt->bindValue(':assunto', $assunto);
        $stmt->bindValue(':msg', $msg); 
        $stmt->bindValue(':status_contato', $status);
        $stmt->bindValue(':data_hora', $dataHora);
        
        return $stmt->execute();

        // toda vez que meu metodo que criar, precisar enviar informação pro 
        //banco e ela for variavel, sempre passar parâmetros, e usar o prepare para pegar parametro e variavel

    }

}
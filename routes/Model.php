<?php

class Model{
    protected $db;

    public function __construct(){
        try {
            $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=' . (defined('DB_CHARSET') ? DB_CHARSET : 'utf8');
            
            $this->db = new PDO($dsn, DB_USER, DB_PASS, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
            
        } catch (PDOException $e) {
            error_log('Erro de conexão com banco de dados: ' . $e->getMessage());
            
            // Em produção, não mostrar detalhes do erro
            if (ini_get('display_errors')) {
                die('Falha na conexão com o banco de dados: ' . $e->getMessage());
            } else {
                die('Erro interno do servidor. Tente novamente mais tarde.');
            }
        }
    }
    
    /**
     * Método para executar queries com tratamento de erro
     */
    protected function executeQuery($sql, $params = []) {
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        } catch (PDOException $e) {
            error_log('Erro na query: ' . $e->getMessage() . ' | SQL: ' . $sql);
            throw $e;
        }
    }
}
<?php
class Conexao{
    protected $pdo;
	
    public function __construct() {
        try {
			$this->pdo = new PDO("mysql:dbname=verzel;host=localhost", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro: ".$e->getMessage();
            die();
        }
    }
}
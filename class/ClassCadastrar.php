<?php
include_once 'class/ClassConexao.php';

class Cadastrar extends Conexao{	

    public function cadastrarUsuario($nome = '', $email = '', $senha = '', $foto = '') {
        $query = 'INSERT INTO usuario (nome, email, senha, foto)
				  VALUES (:nome, :email, :senha, :foto)';
		$query = $this->pdo->prepare($query);
		$query->bindValue(":nome", $nome);
		$query->bindValue(":email", $email);
		$query->bindValue(":senha", $senha);
		$query->bindValue(":foto", $foto);
        $query->execute();
	}

	public function dadosUsuario(){
		$id = $_SESSION['login'];
		$query = "SELECT * FROM usuario WHERE id = :id";
		$query = $this->pdo->prepare($query);
		$query->bindValue(":id", $id);
		$query->execute();

		if($query->rowCount() > 0) {
			return $query->fetch();
		} else {
			return array();
		}
	}
	
	public function login() {
		$_SESSION['login'] = '';

		if(!empty($_POST['email']) && !empty($_POST['senha'])) {
			$email = $_POST['email'];
			$senha = hash('sha512', $_POST['senha']);
			
			$query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '$senha'";
			$query = $this->pdo->prepare($query);
            $query->bindValue(":email", $email);
            $query->bindValue(":senha", $senha);
			$query->execute();
			
			if($query->rowCount() > 0) {
				session_start();
				$query = $query->fetch();
				$id = $query['id'];
				$nome = $query['nome'];
				$_SESSION['login'] = $id;
				$_SESSION['nome'] = $nome;
				
				header("Location: index.php");
			}
		} else {
			echo "nao logou";
		}
	}

	public function editar($nome = '', $email = '', $senha = '', $foto = '') {
		if(!empty($_SESSION['id'])) {
			$id = $_SESSION['id'];
			$query = "UPDATE usuario 
					SET id = '$id', nome = :nome, email = :email, foto = :foto
					WHERE id = '$id'";
			$query = $this->pdo->prepare($query);
			$query->bindValue(":email", $email);
			$query->bindValue(":senha", $senha);
			$query->execute();

			header("Location: index.php");
		} else {
			echo "erro atualizar";
		}
	}

	public function deslogar() {
        session_destroy();
		header("Location:index.php");
		exit;
	}

	public function comentarioUsuario($comment = '', $criacao = '') {
		$usuario_id = $_SESSION['login'];

        $query = 'INSERT INTO comentario (comment, criacao, usuario_id)
				  VALUES (:comment, :criacao, :usuario_id)';
		$query = $this->pdo->prepare($query);
		$query->bindValue(":comment", $comment);
		$query->bindValue(":criacao", $criacao);
		$query->bindValue(":usuario_id", $usuario_id);
        $query->execute();
	}

	public function comentarios() {
		$query = 'SELECT * FROM comentario
				  INNER JOIN usuario ON comentario.usuario_id = usuario.id';
		$query = $this->pdo->prepare($query);
		$query->execute();
			
			if($query->rowCount() > 0) {
				return $query->fetchAll();
			} else {
				return array();
			}
	}

}
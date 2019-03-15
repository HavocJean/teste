<?php
include_once 'class/ClassCadastrar.php';

    $login = New Cadastrar();
    
    if(!empty($_POST['entrar'])){
        $login->login();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <style>
        .login>input {
            margin-left: 10px;
        }
        .login>input, label {
            margin-top: 5px;
        }
        a {
            text-decoration: none;
            color: #000;
        }
        .cadastro {
            color: blue;
        }
        .cadastro:hover {
            color: red;
        }
    </style>
</head>
<body style="margin-left:15%;width:70%;">
    <h3>Faça o login para comentar!</h3>
    <form action="" method="post" class="login">
        <label id="email" >Email:</label><input type="email" name="email" id="email"/><br>
        <label id="password" >Senha:</label><input type="password" name="senha" id="password"/><br>
        <input type="submit" name="entrar" value="Entrar" />
        <button style="margin-left:10px"><a href="index.php">Voltar</a></button> 
    </form>
    <div>
        <p>Não é cadastrado? cadastre-se <a href="cadastrar.php" class="cadastro">aqui</a>.</p>
    </div>
    
</body>
</html>
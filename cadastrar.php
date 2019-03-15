<?php
include_once 'class/ClassCadastrar.php';

    $cadastro = New Cadastrar();

    if(!empty($_POST['enviar'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = hash('sha512', $_POST['senha']);
        $foto = $_FILES['foto'];

        $nome_imagem = md5(uniqid(time())) . ".jpg";
        $caminho_imagem = "fotos/" . $nome_imagem;
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        $foto = $caminho_imagem;

        $cadastro->cadastrarUsuario($nome, $email, $senha, $foto);

        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cadastre-se</title>
    <style>
        a {
            text-decoration: none;
            color: #000;
        }
        .cadastrar>input {
            margin-left: 10px;
        }
        .cadastrar>input, label {
            margin-top: 5px;
        }
    </style>
</head>
<body style="margin-left:15%;width:70%;">
    <p>Cadastrar:</p>
    <form action="" method="post" enctype="multipart/form-data" class="cadastrar">
        <label id="nome" >Nome:</label><input type="text" name="nome" id="nome"/><br>
        <label id="email" >Email:</label><input type="email" name="email" id="email"/><br>
        <label id="password" >Senha:</label><input type="password" name="senha" id="password"/><br>
        <label id="fileupload" >Foto:</label><input type="file" name="foto" id="fileupload"/><br>
        <input type="submit" name="enviar" value="Enviar" />
        <button style="margin-left:10px"><a href="index.php">Voltar</a></button> 
    </form>
    
</body>
</html>
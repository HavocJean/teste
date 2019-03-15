<?php
include_once 'class/ClassCadastrar.php';
    session_start();
    $usuario = New Cadastrar();
    $exibir = $usuario->dadosUsuario();

    if(!empty($_POST['editar'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = hash('sha512', $_POST['senha']);
        $foto = $_FILES['foto'];

        $nome_imagem = md5(uniqid(time())) . ".jpg";
        $caminho_imagem = "fotos/" . $nome_imagem;
        move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        $foto = $caminho_imagem;

        $usuario->editar($nome, $email, $senha, $foto);
    } 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar - Usuário</title>
    <style>
        .editar>input {
            margin-left: 10px;
        }
        .editar>input, label {
            margin-top: 5px;
        }
        a {
            text-decoration: none;
            color: #000;
        }
    </style>
</head>
<body style="margin-left:15%;width:70%;">
    <h3>Editar usuário:</h3>
    <form action="" method="post" class="editar">
        <img src="<?php echo $exibir['foto']; ?>" alt="perfil" width="100px"><br>
        <label id="fileupload" >Foto:</label><input type="file" name="foto" id="fileupload"/><br>
        <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
        <label id="nome" >Nome:</label><input type="text" name="nome" id="nome" value="<?php echo $exibir['nome']; ?>"/><br>
        <label id="email" >Email:</label><input type="email" name="email" id="email" value="<?php echo $exibir['email']; ?>"/><br>
        <label id="password" >Senha:</label><input type="password" name="senha" id="password" value="<?php echo $exibir['senha']; ?>"/><br>
        <input type="submit" name="editar" value="Editar" />
        <button style="margin-left:10px"><a href="index.php">Voltar</a></button> 
    </form>
</body>

</html>
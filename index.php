<?php
    include_once 'class/ClassCadastrar.php';
    session_start();

    if(isset($_SESSION['login']) && !empty($_POST['logout'])) {
        $logout = New Cadastrar();
        $logout->deslogar();
    }

    if(empty($_SESSION['login']) && !empty($_POST['enviar'])) {
        header("Location:login.php");
    }

    if(isset($_SESSION['login']) && !empty($_POST['enviar'])){
        $comentario = $_POST['comentario'];
        $date = new DateTime("now", new DateTimeZone('America/Sao_Paulo'));
        $criacao =  $date->format('Y-m-d H:i:s');

        $comentarios = New Cadastrar();
        $comentarios->comentarioUsuario($comentario, $criacao); 
    }

    $comentario = New Cadastrar();
    $comentarios = $comentario->comentarios();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Produto Inovador</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .comentar>input,textarea {
            float: left;
        }
        .comentar>input {
            margin-top: 45px;
            margin-left: 10px;
        }
        nav>a {
            text-decoration: none;
            color: #000;
            margin-left: 30px;
        }
        a:hover {
            color: red;
        }
    </style>
</head>
<body style="margin-left:15%;width:70%;">
    <nav>
        <a href="#">Link Um</a>
        <a href="#">Link Dois</a>
        <a href="#">Link Três</a>
        <form method="post" style="float:right;margin-right:50px;"><input type="submit" name="logout" value="Logout" /></form>
        <a href="#" style="float:right;margin-right:20px;">
            <?php
                if(!empty($_SESSION['login'])){
                    echo "Logado como: ".$_SESSION['nome'];
                } else {
                    echo "<a href='login.php' style='float:right;margin-right:20px;'>Login</a>";
                }
            ?>
        </a>
        <a href="editar.php" style="float:right;">
            <?php
                if(!empty($_SESSION['login'])){
                    echo "Editar Informaçoes";
                } else {
                    echo " ";
                }
            ?>
        </a>
    </nav>
    <div>
        <h1>produto inovador</h1>

        <h3>Comentários:</h3>

        <p><?php
            foreach($comentarios as $c){
                echo '<b>'.$c['nome'].'</b> - '.date('d/m/Y H:i:s', strtotime($c['criacao'])).'<br>'.$c['comment'].'<hr>';
            }
        ?></p>
    </div>
    <div>
        <p style="margin-top:30px;">Deixe seu comentário:</p>
        <form class="comentar" method="post" action="">
            <textarea name="comentario" rows="4" cols="80"></textarea>
            <input type="submit" name="enviar" value="Enviar" /> 
        </form>
    </div>
    <div style="clear:both;">
        <p>Não é cadastrado? cadastre-se <a href="cadastrar.php">aqui</a>.</p>
    </div>
    
    
</body>
</html>
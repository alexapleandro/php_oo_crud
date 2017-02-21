<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 21/02/2017
 * Time: 10:00
 */

function __autoload($class_name){
        require_once 'classes/' . $class_name . '.php';
    }
?>

<!DOCTYPE HTML>
<html land="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP OO</title>
    <meta name="description" content="EXEMPLO PHP OO" />
    <meta name="robots" content="index, follow" />
    <meta name="author" content="Alex Leandro"/>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" />
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body>

<div class="container">
    <header class="masthead">
        <h1 class="muted">PHP OO</h1>
        <nav class="navbar">
            <div class="navbar-inner">
                <div class="container">
                    <ul class="nav">
                        <li class="active"><a href="index.php">Página inicial</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <?php

    $usuario = new Usuarios();

    if(isset($_POST['cadastrar'])):

        $nome  = $_POST['nome'];
        $email = $_POST['email'];

        $usuario->setNome($nome);
        $usuario->setEmail($email);

        # Insert
        if($usuario->insert()){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                       </button>
                       <strong>OK!</strong> Incluido com sucesso!!! 
                   </div>';
        }

    endif;

    ?>

    <?php
    if(isset($_POST['atualizar'])):

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        $usuario->setNome($nome);
        $usuario->setEmail($email);

        if($usuario->update($id)){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                       </button>
                       <strong>OK!</strong> Alterado com sucesso!!! 
                   </div>';
        }

    endif;
    ?>

    <?php
    if (isset($_POST['excluir_ui'])):

        $id = $_POST['id_ui'];
        if($usuario->delete($id)){
            echo '<div class="alert alert-success alert-dismissible" role="alert">
                       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                       </button>
                       <strong>OK!</strong> Excluido com sucesso!!! 
                   </div>';
        }

    endif;
    ?>

    <?php
    if(isset($_GET['acao']) && $_GET['acao'] == 'editar'){

        $id = (int)$_GET['id'];
        $resultado = $usuario->find($id);
        ?>

        <form method="post" action="">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input type="text" name="nome" value="<?php echo $resultado->nome; ?>" placeholder="Nome:" />
            </div>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" name="email" value="<?php echo $resultado->email; ?>" placeholder="E-mail:" />
            </div>
            <input type="hidden" name="id" value="<?php echo $resultado->id; ?>">
            <br />
            <input type="submit" name="atualizar" class="btn btn-primary" value="Atualizar dados">
        </form>

    <?php }else{ ?>


        <form method="post" action="">
            <div class="input-prepend">
                <span class="add-on"><i class="icon-user"></i></span>
                <input type="text" name="nome" placeholder="Nome:" />
            </div>
            <div class="input-prepend">
                <span class="add-on"><i class="icon-envelope"></i></span>
                <input type="text" name="email" placeholder="E-mail:" />
            </div>
            <br />
            <input type="submit" name="cadastrar" class="btn btn-primary" value="Cadastrar dados">
        </form>

    <?php } ?>

    <table class="table table-hover">

        <thead>
        <tr>
            <th>#</th>
            <th>Nome:</th>
            <th>E-mail:</th>
            <th>Ações:</th>
        </tr>
        </thead>

        <?php foreach($usuario->findAll() as $key => $value): ?>

            <tbody>
            <tr>
                <td><?php echo $value->id; ?></td>
                <td><?php echo $value->nome; ?></td>
                <td><?php echo $value->email; ?></td>
                <td>
                    <?php echo "<a class=\"btn btn-info\" href='index.php?acao=editar&id=" . $value->id . "'>Editar</a>"; ?>

                    <form class="form_excluir" method="post" style="float: left; margin: 0 15px;">
                        <input name="id_ui" type="hidden" value="<?php echo $value->id;?>"/>
                        <button name="excluir_ui" type="submit" onclick='return confirm("Deseja realmente deletar?")' class="btn btn-danger">Excluir</button>
                    </form>

                </td>
            </tr>
            </tbody>

        <?php endforeach; ?>

    </table>

</div>

<script src="js/jQuery.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>
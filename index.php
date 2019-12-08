<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema financeiro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/jquery.min.js"></script>



<?php require "conexao.php"; ?>

<div id="wrapper">
    <div class="body-content">
        <div class="container conteudo-login">
            <div class="row caixa caixa-login ">
                <div class="width">
                    <div class="titulo">
                        <h3>Login</h3>
                        
                    </div>
                    <form action="" id="login" method="POST">
                        <div class="alert-red">
                            <div class="alert-red-dentro">
                                <button type="button" class="fechar-red" aria-hidden="true">×</button>
                                <span class="fa fa-times-circle erro-x-red"></span>
                                <p></p>
                            </div>
                        </div> 
                        <label>Email:</label>
                        <input name="email" type="text" class="email">
                        <label>Senha</label>
                        <input name="senha" type="password" class="senha">
                        <div class="esqueceu"><a href="esqueceu_senha/index.php">Esqueceu sua senha?</a></div>
                        <div class="bottom">
                            <div class="cadastro-linha">
                                <input type="checkbox"><span>Lembrar-me</span>
                                <button name="login" class="btn-login">Login</button>
                            </div>
                            <a href="cadastro.php" class="btn-cadastro">Você ainda não possui cadastro? Então click aqui.</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

<script>
    var alert_red = document.querySelector('.alert-red-dentro');
    function msg_erro(msg){
        document.querySelector('.alert-red-dentro p').innerHTML = msg;
        alert_red.style.display = 'block';
        
        setTimeout(function(){ alert_red.style.display = 'none'; }, 5000);
    }
    $(document).ready(function(){
        $(".fechar-red").click(function(){
            alert_red.style.display = 'none';
        });
    });
</script>

<?php 
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
    }
?>
<script>
    function guarda_dados_login(){
        var email = "<?php print $email?>";
        var senha = "<?php print $senha?>";
        document.querySelector('.email').value = email;
        document.querySelector('.senha').value = senha;
    }
</script>
<?php


    if(isset($_POST['login'])){
        $sql_sel_login = "SELECT * FROM usuarios WHERE email = '$email' AND senha =  '$senha'";
        $res_sel_login = mysqli_query($conexao, $sql_sel_login);
        if (($senha == '') || ($email == '')){
            echo "<script type='text/javascript'>msg_erro('Preencha todos os campos!'); guarda_dados_login(); </script>";
        }else{
        if (mysqli_num_rows($res_sel_login) > 0){
            while($res_sel_login_2 = mysqli_fetch_assoc($res_sel_login)){
                $id = $res_sel_login_2['id'];
                $nome = $res_sel_login_2['nome'];
                $sobrenome = $res_sel_login_2['sobrenome'];
                $telefone = $res_sel_login_2['telefone'];
                $codigo = rand() ;
                $sql_upd_cod_log = "UPDATE usuarios SET cod_log = '$codigo' WHERE id = '$id'";
                $res_upd_cod_log= mysqli_query($conexao, $sql_upd_cod_log);
                session_start();
                $_SESSION['valid'] = $codigo;
                echo "<script>window.location = 'index_user.php?id_user=$id&valid=$codigo';</script>"; 
            }
            //$id = $res_sel_login['id'];
        }else{
            echo "<script type='text/javascript'>msg_erro('Dados inválidos!');guarda_dados_login(); </script>";
        }
    }
    }


?>
<?php require "footer.php";?>

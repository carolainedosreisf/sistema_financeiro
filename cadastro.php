<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Financeiro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/jquery.min.js"></script>



<?php require "conexao.php"; ?>

<div id="wrapper">
    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="alert-green">
                    <div class="alert-green-dentro">
                        <button type="button" class="fechar-green" aria-hidden="true">×</button>
                        <span class="fa fa-check-circle erro-x-green"></span>
                        <p>Cadastro realizado com sucesso!</p>
                    </div>
                </div> 
            </div>
        </div>
        <div class="container conteudo-cadastro">
            <div class="row caixa caixa-cadastro">
                <div class="width">
                    <div class="titulo">
                        <h3>Cadastro</h3>
                        
                    </div>
                    <form action="" id="login" method="POST">
                        <div class="row">
                            <div class="col-md-6">
                            
                                <div class="alert-red">
                                    <div class="alert-red-dentro">
                                        <button type="button" class="fechar-red" aria-hidden="true">×</button>
                                        <span class="fa fa-times-circle erro-x-red"></span>
                                        <p></p>
                                    </div>
                                </div>
                                
                                
                                <label>Nome:</label>
                                <input name="nome" id="nome" type="text">
                                <label>Sobrenome</label>
                                <input name="sobrenome"id="sobrenome" type="text">
                                <label>Telefone</label>
                                <input name="telefone" id="telefone" type="tel">
                                
                            </div>
                            <div class="col-md-6">
                                <label>Email:</label>
                                <input name="email" id="email"  type="email">
                                <label>Senha</label>
                                <input name="senha" id="senha" type="password">
                                <label>Confirmar senha</label>
                                <input name="senha_conf" id="senha_conf" type="password">
                            </div>
                        </div>
                        <div class="bottom">
                            <div class="cadastro-linha">
                                <button name="cadastrar" class="btn-login">Cadastar-se</button>
                            </div>
                            <a href="index.php" class="btn-cadastro">Você já possui cadastro? Então click aqui para logar.</a>
                        </div>
                    </form>
                    
                    
                </div>
            </div>
        </div>



    
    
<?php 
if(isset($_POST['cadastrar'])){
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha_conf = $_POST['senha_conf'];
}
?>
<script>
    var alert_red = document.querySelector('.alert-red-dentro');
    var alert_green = document.querySelector('.alert-green-dentro');
    function msg_sucesso(){
        alert_green.style.display = 'block';
        setTimeout(function(){ alert_green.style.display = 'none'; }, 3000);
        //setTimeout(function(){ 
            //window.location="index.php";    
       // }, 5001);
        
    }
    function msg_erro(msg){
        document.querySelector('.alert-red-dentro p').innerHTML = msg;
        alert_red.style.display = 'block';
        
        setTimeout(function(){ alert_red.style.display = 'none'; }, 5000);
    }
    function guarda_dados(){
        
        var nome = "<?php print $nome; ?>";
        var sobrenome = "<?php print $sobrenome; ?>";
        var telefone = "<?php print $telefone; ?>";
        var email = "<?php print $email; ?>";
        var senha = "<?php print $senha; ?>";
        var senha_conf = "<?php print $senha_conf; ?>";
        document.querySelector('#nome').value = nome;
        document.querySelector('#sobrenome').value = sobrenome ;
        document.querySelector('#telefone').value = telefone;     
        document.querySelector('#email').value = email;     
        document.querySelector('#senha').value = senha;     
        document.querySelector('#senha_conf').value = senha_conf;     
    }
    $(document).ready(function(){
        $(".fechar-red").click(function(){
            alert_red.style.display = 'none';
        });
    });
    $(document).ready(function(){
        $(".fechar-green").click(function(){
            alert_green.style.display = 'none';
        });
    });
</script>
<?php 
if(isset($_POST['cadastrar'])){
    
    if ($nome != '' && $sobrenome != '' && $telefone != '' && $email != '' && $senha != '' ){
        $sql_sel_email = "SELECT * FROM usuarios WHERE email = '$email'";
        $res_sel_email = mysqli_query($conexao, $sql_sel_email);
        if($senha != $senha_conf){
            echo "<script type='text/javascript'>msg_erro('A senha não corresponde com a confirmação.'); guarda_dados(); </script>";
            echo (strlen($senha)) ;
        }else if(strlen($senha) < 8){
            echo "<script type='text/javascript'>msg_erro('Digite uma senha com pelo menos 8 caracteres.'); guarda_dados(); </script>";
        }else if (mysqli_num_rows($res_sel_email) > 0){
            echo "<script type='text/javascript'>msg_erro('Desculpe, mas esse email já esta em uso!'); guarda_dados(); </script>";
        }else{
            $sql_cadastra = "INSERT INTO usuarios (nome,sobrenome, telefone,email, senha, cod_log, nome_img, nome_img_original) VALUES ('$nome','$sobrenome','$telefone','$email', '$senha', '0', 'padrao.jpg', 'padrao.jpg')";
            $cad = mysqli_query($conexao, $sql_cadastra);
            echo "<script type='text/javascript'>msg_sucesso(); </script>";
            $sql_sel_login = "SELECT * FROM usuarios WHERE email = '$email' AND senha =  '$senha'";
            $res_sel_login = mysqli_query($conexao, $sql_sel_login);
            if (mysqli_num_rows($res_sel_login) > 0){
                while($res_sel_login_2 = mysqli_fetch_assoc($res_sel_login)){
                    $id = $res_sel_login_2['id'];
                    $codigo = rand() ;
                    $sql_upd_cod_log = "UPDATE usuarios SET cod_log = '$codigo' WHERE id = '$id'";
                    $res_upd_cod_log= mysqli_query($conexao, $sql_upd_cod_log);
?>
                    <div class="load-fora">
                        <div class="load-dentro">
                            <?php require "img/load.svg";?>
                        </div>
                    </div>

<?php   
                    echo "
                    <script>
                        setTimeout(function(){ 
                            window.location = 'index_user.php?id_user=$id&valid=$codigo';
                        }, 3001);
                   </script>"; 
                }
            }
        }
        
    }else{
        echo "<script type='text/javascript'>msg_erro('Por favor preencha todos os campos!'); guarda_dados(); </script>";
    } 
}

?>

<?php
     if(@$_GET['func'] == 'logar_sim'){
        
        
        
    }
    if(isset($_POST['logar_nao'])){
        echo "<script> window.location('cadastro.php');</script>";
    }
?>
    </div>
    
<?php require "footer.php";?>

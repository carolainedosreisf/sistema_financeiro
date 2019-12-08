<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Sistema Financeiro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
    <link rel="stylesheet" type="text/css" href="css/vendors.css"/>
    <link rel="stylesheet" type="text/css" href="css/algaworks.css"/>
    <link rel="stylesheet" type="text/css" href="css/application.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/jquery.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:500" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Titillium+Web:700,900" rel="stylesheet">
</head>
<body>
<?php require "../config.php";?>

	<div id="wrapper">
		<div class="body-content">
    <?php 
        //deleta caso o registro já tenha completado 1h desde o insert
        $tempo=time();
        $sql_delete_red_senha= "DELETE FROM redefinir_senha WHERE time_d <= '$tempo'";
        mysqli_query($conexao, $sql_delete_red_senha);
        
        $id_user_email = $_GET['id_user'];
        $valid_url = $_GET['valid'];
        $sql_sel_id = "SELECT * FROM usuarios WHERE email = '$id_user_email'";
        $res_sel_id = mysqli_query($conexao, $sql_sel_id);
        while($con_sel_id = mysqli_fetch_assoc($res_sel_id)){
            $id_user = $con_sel_id['id'];
            echo "<script>window.location = 'redefinir.php?id_user=$id_user&valid=$valid_url';</script>";
           
        }
        
        $id_user_url = $_GET['id_user'];
        $sql_sel_valid = "SELECT * FROM redefinir_senha WHERE id_user = '$id_user_url'";
        $res_sel_valid = mysqli_query($conexao, $sql_sel_valid);
        if (mysqli_num_rows($res_sel_valid) <= 0){
?>
            <div id="notfound">
                <div class="notfound">
                    <div class="notfound-404">
                        <h1>404</h1>
                    </div>
                    <h2>Oops! Parece que este link expirou ou não é válido.</h2>
                    <p>Para voltar para a página incial click no botão abaixo.</p>
                    <a href="../index.php">Home</a>
                </div>
            </div>
<?php
        }else{
            while($con_sel_valid = mysqli_fetch_assoc($res_sel_valid)){
                $valid_tb = $con_sel_valid['valid'];
                $id_user = $con_sel_valid['id_user'];
                //echo $valid_tb. '<br>';
                //echo $valid_url ;
                if ($valid_tb == $valid_url){
        
            
          
    ?>
    <body class="aw-layout-simple-page">
	<div id="wrapper">
		<div class="body-content">
			<div class="aw-layout-simple-page__container">
				<div class="alert-red">
					<div class="alert-red-dentro">
						<button type="button" class="fechar-red" aria-hidden="true">×</button>
						<span class="fa fa-times-circle erro-x-red"></span>
						<p>Por favor preencha os campos.</p>
					</div>
				</div> 
				<div class="alert-green">
                    <div class="alert-green-dentro">
                        <button type="button" class="fechar-green" aria-hidden="true">×</button>
                        <span class="fa fa-check-circle erro-x-green"></span>
                        <p>Sua senha foi redefinida com sucesso!</p>
                    </div>
                </div> 
				<br>
				<form method="POST">
					<div class="aw-simple-panel">
						<div class="aw-simple-panel__box">
							<div class="form-group  has-feedback">
							
								<input type="password" class="form-control  input-lg" id="senha" name="senha" placeholder="Nova senha">
								<br>
								<input type="password" class="form-control  input-lg" id="senha_conf" name="senha_conf" placeholder="Confirme a nova senha">
								<br>
								<div class="form-group">
									<button type="submit" name="enviar_senha" class="btn  btn-success btn-lg  aw-btn-full-width">Enviar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
<?php
if(isset($_POST['enviar_senha'])){
    $senha = $_POST['senha'];
    $senha_conf = $_POST['senha_conf'];
}
?>
<script>
    function guarda_dados(){
        var senha = "<?php print $senha; ?>";
        var senha_conf = "<?php print $senha_conf; ?>";
        document.querySelector('#senha').value = senha;     
        document.querySelector('#senha_conf').value = senha_conf;  
    }
    var alert_red = document.querySelector('.alert-red-dentro');
    var alert_green = document.querySelector('.alert-green-dentro');
    function msg_erro(msg){
        document.querySelector('.alert-red-dentro p').innerHTML = msg;
        alert_red.style.display = 'block';
        
        setTimeout(function(){ alert_red.style.display = 'none'; }, 5000);
    }
    function msg_sucesso(){
        alert_green.style.display = 'block';
        setTimeout(function(){ alert_green.style.display = 'none'; }, 5000);
        //setTimeout(function(){ 
            //window.location="index.php";    
       // }, 5001);
        
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

if(isset($_POST['enviar_senha'])){
    if($senha_conf != '' && $senha != '') {
        if ($senha != $senha_conf){
            echo "<script type='text/javascript'>msg_erro('A senha não corresponde com a confirmação.');guarda_dados();</script>";
        }else if(strlen($senha) < 8){
            echo "<script type='text/javascript'>msg_erro('A senha deve ter no mínimo 8 caracteres');guarda_dados();</script>";
        }else{
            $sql_upd_senha = "UPDATE usuarios SET senha = '$senha' WHERE id = '$id_user'";
            $res_upd_senha= mysqli_query($conexao, $sql_upd_senha);
            //usou apagou
            $sql_delete_red_senha_usado= "DELETE FROM redefinir_senha WHERE id_user = '$id_user'";
            mysqli_query($conexao, $sql_delete_red_senha_usado);

            echo "<script type='text/javascript'>msg_sucesso();</script>";
?>
        <div class="load-fora">
            <div class="load-dentro">
                <?php require "../img/load.svg";?>
            </div>
        </div>
<?php
        echo "
            <script>
                setTimeout(function(){ 
                    window.location = '../index.php';
                }, 3001);
            </script>"; 

        }
    } else{
        if ($senha_conf == '' && $senha == ''){
            echo "<script type='text/javascript'>msg_erro('Preencha todos os campos.');guarda_dados();</script>";
        }
        else if($senha_conf == '') {
            echo "<script type='text/javascript'>msg_erro('Preencha o campo confirmação de senha.');guarda_dados();</script>";
        }else if($senha == '')  {
            echo "<script type='text/javascript'>msg_erro('Preencha o campo senha.');guarda_dados();</script>";
        }
    }
}
?>
<?php
    }else{
?>

    <div id="notfound">
        <div class="notfound">
            <div class="notfound-404">
                <h1>404</h1>
            </div>
            <h2>Oops! Parece que este link expirou ou não é válido.</h2>
            <p>Para voltar para a página incial click no botão abaixo.</p>
            <a href="../index.php">Home</a>
        </div>
    </div>

    
<?php
        }
    }
}
?>


    </div>
<?php require "../footer.php";?>

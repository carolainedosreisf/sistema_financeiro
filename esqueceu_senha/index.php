<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema Financeiro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="../css/style.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href=""/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="../js/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/vendors.css"/>
  <link rel="stylesheet" type="text/css" href="css/algaworks.css"/>
  <link rel="stylesheet" type="text/css" href="css/application.css"/>


</head>

<body class="aw-layout-simple-page">
	<div id="wrapper">
		<div class="body-content">
			<div class="aw-layout-simple-page__container">

				<form action="mail.php" method="POST" id="formid">

					<div class="aw-simple-panel">
						
						<div class="aw-simple-panel__message">
							Informe o seu e-mail abaixo para receber as instruções de como criar uma nova senha.
						</div>
						<a href="../index.php" class="btn btn-success btn-custom">
							<i class="fa fa-arrow-left text-primary btn-icon" aria-hidden="true"></i>
							Voltar
						</a><br><br>
						
						<div class="aw-simple-panel__box">
							
							<div class="form-group  has-feedback">
								<input type="text" class="form-control  input-lg" name="email" placeholder="Seu e-mail">
								<span class="glyphicon   form-control-feedback" aria-hidden="">
									<i class="fa fa-envelope" aria-hidden="true"></i>
								</span>
								
								<div class="mensagens">
									<div id="message_envio">
									</div>
								<div>
								
								</div>
								
									<img style="display:none;"  src="../img/load.gif" class="load" id="load">
								</div>
								<div class="form-group botoes-">
									<button type="submit" name="enviar_email" style="width:100%" class="btn  btn-success btn-lg  aw-btn-full-width">Enviar email</button>
									<!--
									<a href="../index.php" class="red_senha_vl">Login</a>
									-->
								</div>
							</div>
							
						</div>
					</div>

				</form>

			</div>
		</div>
		
<?php

?>
 <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/ajax-mail.js"></script>
<?php require "../footer.php";?>



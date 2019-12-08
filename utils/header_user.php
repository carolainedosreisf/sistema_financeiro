<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistema financeiro</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/style-user.css"/>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css"/>
<link rel="stylesheet" type="text/css" href=""/>
<style type="text/css">
    #preview-pane .preview-container {
        height: 250px !important;
    }
    .jcrop-holder #preview-pane {
    display: block;
    z-index: 2000;
    top: 10px;
    right: -280px; 
    padding: 6px;
    border: 1px rgba(0,0,0,.4) solid;
    background-color: white;
    -webkit-border-radius: 6px;
    -moz-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    box-shadow: 1px 1px 5px 2px rgba(0, 0, 0, 0.2);
    }
    #preview-pane .preview-container {
    width: 250px;
    height: 170px;
    overflow: hidden;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="js/jquery.min.js"></script>
<?php 
    require 'config.php';
    require 'utils/mes.php';   
?>
<?php
        
    $ano_atual = date('Y');
    $mes_atual = date('m');
    $id_user = $_GET['id_user'];    
    $sql_sel_valid = "SELECT * FROM usuarios WHERE id = '$id_user'";
    $res_sel_valid = mysqli_query($conexao, $sql_sel_valid);
?>
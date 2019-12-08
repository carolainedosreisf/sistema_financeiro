<?php
 require 'conexao.php';

?>
<?php 
    $id_user = $_GET['id_user'];    
    if (@$_GET['func'] == 'sair') {
        $sql_upd_cod_log = "UPDATE usuarios SET cod_log = '0' WHERE id = '$id_user'";
        $res_upd_cod_log= mysqli_query($conexao, $sql_upd_cod_log);
        echo "<script>window.location = 'index.php';</script>"; 
    } 
    

?>
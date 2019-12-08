<?php 
    if(array_key_exists('id_plan',$_GET)){
        $id_plan_url =$_GET['id_plan']; 
    }
?>
<?php require "utils/header_user.php";?>
<?php 

while($con_sel_valid = mysqli_fetch_assoc($res_sel_valid)){
    $codigo =  $con_sel_valid['cod_log'];
    $_POST['valid'] = $codigo;
    $valid  = $_GET['valid'] ;
    $nome_img_db = $con_sel_valid['nome_img'];
    
    if(($codigo == $valid)){
       
?>
<?php require "utils/header_dados_user.php";?>
        <div class="container">
            <div class="row">
                <h4 class="text-center edit_dados_h4">Editar meu  dados</h4>
            

                <form name="photo" class="edit_dados" enctype="multipart/form-data" action="teste2.php" method="POST">
                    <label>Foto de perfil:</label><br>
                    <div class="foto_design">
                        <input type="file" name="image" size="30" class="selecionar_arquivo" /> 

                        <input type="hidden" name="id_user" value="<?php echo $id_user; ?>">
                        <input type="hidden" name="valid" value="<?php echo $valid;?>">

                        <input type="submit" name="upload" value="Salvar" class="salvar_foto" />
                    </div>
                    
                    
                </form>
                <?php
                    if(isset($_FILES['image'])){
                        $rand_img = rand() * rand();
                        $ext = strtolower(substr($_FILES['image']['name'],-4)); //Pegando extensão do arquivo
                        $new_name = date("mobile_".$rand_img) . $ext; //Definindo um novo nome para o arquivo
                        $dir = 'images/'; //Diretório para uploads 
                        move_uploaded_file($_FILES['image']['tmp_name'], $dir.$new_name); //Fazer upload do arquivo
                    } 
                
                    ?>
                <script>
                    var value_upload = document.querySelector('.selecionar_arquivo');
                    if (value_upload.value !== ''){
                        document.write
                        ("<?php 
                            session_start();
                            $_SESSION['id_user'] =  $id_user;
                            $_SESSION['valid'] =  $valid;  
                        ?>");
                    }else{
                    }
                    
                      
                </script>
               <?php
                    //session_destroy();
                    //session_start();
                    //$_SESSION['id_user'] =  $id_user;
                    //$_SESSION['valid'] =  $valid; 
                    
               ?>
                <form class="edit_dados" method="POST">
                    <?php require "utils/alert_red.php";?>
                    <?php require "utils/alert_green.php";?>
                    <?php $email = $con_sel_valid['email'] ?>
                    
                    <label>Nome:</label><br>
                    <input type="text" name="nome_user" class="nome_user" value="<?php echo $con_sel_valid['nome']?>"><br>
                    <label>Sobrenome:</label><br>
                    <input type="text" name="sobrenome_user" class="sobrenome_user" value="<?php echo $con_sel_valid['sobrenome']?>"><br>
                    <label>Email:</label><br>
                    <input type="tel" name="email_user" class="email_user" value="<?php echo $con_sel_valid['email']?>"><br>
                    <label>Telefone:</label><br>
                    <input type="tel" name="tel_user" class="tel_user" value="<?php echo $con_sel_valid['telefone']?>">
                    <div class="quer_editar_senha">
                        <br><label style="margin-bottom:10px;">Senha:</label>
                        <a href="edit_dados.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?><?php if(array_key_exists('id_plan',$_GET)){ echo '&id_plan='.$id_plan_url;}?>&func=edit_senha" class="editar_senha">Editar senha?</a><br>
                    </div>
                    
                    <div class="form_edit_senha" style="display:none;">
                        <br><label>Senha atual:</label><br>
                        <input type="password" name="senha_user" class="senha_user" ><br>
                        <label>Nova senha:</label><br>
                        <input type="password" name="nvsenha_user" class="nvsenha_user"><br>
                        <label>Confirmar nova senha:</label><br>
                        <input type="password" name="confnvsenha_user" class="confnvsenha_user">
                        
                    </div>
                    
                   
                        
                    <button class="btn btn-success btn-nao" name="editar_dados" type="submit">Editar</button>
                    <a href="edit_dados.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?><?php if(array_key_exists('id_plan',$_GET)){ echo '&id_plan='.$id_plan_url;}?>" class="btn btn-default nao_editar_senha btn-nao" style="display:none" name="nao_editar_senha" type="submit">Não quero editar senha</a>
                  
                    
                </form>
            </div>
        </div>

<?php
 if(@$_GET['func'] == 'edit_senha'){ 
     echo "<script>document.querySelector('.form_edit_senha').style.display ='block';document.querySelector('.nao_editar_senha').style.display ='inline-block';document.querySelector('.quer_editar_senha').style.display ='none';</script>";
 }
 if(isset($_POST['editar_dados'])){  
    $nome_user = $_POST['nome_user'];
    $sobrenome_user = $_POST['sobrenome_user'];
    $email_user = $_POST['email_user'];
    $telefone_user = $_POST['tel_user'];
    //if(@$_GET['func'] == 'edit_senha'){ 
        $senha_user = $_POST['senha_user'];
        $nvsenha_user = $_POST['nvsenha_user'];
        $confnvsenha_user = $_POST['confnvsenha_user'];
    
    //}
    
 
    
 }
    
?>

<script>

    function guarda_dados(){
       var nome_user = "<?php print $nome_user?>";
       var sobrenome_user = "<?php print $sobrenome_user?>";
       var email_user = "<?php print $email_user?>";
       var telefone_user = "<?php print $telefone_user?>";
       
       document.querySelector(".nome_user").value = nome_user;
       document.querySelector(".sobrenome_user").value = sobrenome_user;
       document.querySelector(".email_user").value = email_user;
       document.querySelector(".tel_user").value = telefone_user;
    }  
</script>
<?php


?>
<script>

function guarda_dados_senha(){
    var senha_user = "<?php print $senha_user?>";
    var nvsenha_user = "<?php print $nvsenha_user?>";
    var confnvsenha_user = "<?php print $confnvsenha_user?>";
    document.querySelector(".senha_user").value = senha_user;
    document.querySelector(".nvsenha_user").value = nvsenha_user;
    document.querySelector(".confnvsenha_user").value = confnvsenha_user;
}
    
</script>

<?php
 if(isset($_POST['editar_dados'])){  
    $sql_sel_email = "SELECT * FROM usuarios WHERE (email = '$email_user'AND email != '$email')";
    $res_sel_email = mysqli_query($conexao, $sql_sel_email);
    if(@$_GET['func'] == 'edit_senha'){ 
        if ($nome_user != '' && $sobrenome_user != '' && $email_user  != '' && $telefone_user != '' && $senha_user != '' &&         $nvsenha_user != '' && $confnvsenha_user != ''){
            if($senha_user == $con_sel_valid['senha']){
                if($nvsenha_user == $confnvsenha_user){
                    if (strlen($nvsenha_user) >= 8){
                        if(mysqli_num_rows($res_sel_email) > 0){
                            echo "<script>msg_erro('Desculpe, mas esse email já esta em uso.'); guarda_dados();</script>";  
                        }else{
                            $sql_upd_user = "UPDATE usuarios SET nome = '$nome_user', sobrenome = '$sobrenome_user', telefone = '$telefone_user', email = '$email_user', senha = '$nvsenha_user' WHERE id = '$id_user'";
                            $res_upd_user= mysqli_query($conexao, $sql_upd_user);
                            echo "<script>msg_sucesso('Dados editados com sucesso!.');</script>";
                            //echo "<script>setTimeout(function(){ window.location = 'edit_dados.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url' }, 5001);</script>";
                            //echo "aqui"   ;     

                        }
                        
                    }else{
                        echo "<script>msg_erro('A nova senha deve conter no mínimo 8 caracteres.');guarda_dados();guarda_dados_senha();</script>"; 
                    }
                }else{
                    echo "<script>msg_erro('A nova senha não corresponde com a confirmação.');guarda_dados();guarda_dados_senha();</script>";
                }
            }else{
                echo "<script>msg_erro('Senha atual incorreta.'); guarda_dados();guarda_dados_senha();</script>";
            }
            
        }else{
            echo "<script>msg_erro('Por favor, prencha todos os campos.'); guarda_dados(); guarda_dados_senha();</script>";
            
        }
    }else{
        if ($nome_user != '' && $sobrenome_user != '' && $email_user  != '' && $telefone_user != '' ){
           if(mysqli_num_rows($res_sel_email) > 0){
            
                echo "<script>msg_erro('Desculpe, mas esse email já esta em uso.'); guarda_dados();</script>";            
            }else{
                $sql_upd_user = "UPDATE usuarios SET nome = '$nome_user', sobrenome = '$sobrenome_user', telefone = '$telefone_user', email = '$email_user' WHERE id = '$id_user'";
                $res_upd_user= mysqli_query($conexao, $sql_upd_user);
                echo "<script>msg_sucesso('Dados editados com sucesso!.');guarda_dados();</script>";
            }
            

            
        }else{
            echo "<script>msg_erro('Por favor, prencha todos os campos.'); guarda_dados();</script>";            
        }
    }
    
    	
 }
?>
<script> document.querySelector('#erro_edit_dados').innerHTML =  'Preencha todos os campos';</script>
<?php require "footer.php";?>
<?php
    }else if($valid !== $codigo){
        echo "<script>window.location = 'index.php';</script>"; 
    }else{
        echo "<script>window.location = 'index.php';</script>"; 
    }

?>


<?php

    //$sql_nome_img = "UPDATE usuarios SET nome_img = 'padrao.jpg', nome_img_original = 'padrao.jpg'";
    //$res_nome_img= mysqli_query($conexao, $sql_nome_img);
}
?>
</div>

    
<?php
    
?>
<div id="wrapper">
    <div class="body-content">
    <header>
        <div class="titulo_dados"> 
        </div>
        <div class="">
            
        </div>
        
        <div class="row dados_sair_voltar">
           
            <?php 
            if(array_key_exists('id_plan',$_GET)){
                $id_plan_url =$_GET['id_plan']; 
            }
                $URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $url_sem_delimg_verimg= str_replace('&func=ver_img&del_img=sim', '', $URL_ATUAL);                  
                $url_sem_verimg= str_replace('&func=ver_img', '', $URL_ATUAL);
                $url_sem_delimg= str_replace('&del_img=sim', '', $URL_ATUAL);
                $nome_img_db = $con_sel_valid['nome_img'];
                if(!file_exists("crop_upload/upload_pic/$nome_img_db")){
    
                    $sql_nome_img2 = "UPDATE usuarios SET nome_img = 'padrao.jpg', nome_img_original = 'padrao.jpg' WHERE id = '$id_user'";
                    $res_nome_img2= mysqli_query($conexao, $sql_nome_img2);
                    echo "<script>window.location = '$URL_ATUAL' </script>";
                }
                
            ?>
                
           
            
            
            
            <div class="dados ">
            <?php
                function isMobileDevice() {
                    return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
                }
                if(isMobileDevice()){
                    $data = getimagesize("crop_upload/upload_pic/$nome_img_db");
                    $width = $data[0];
                    $height = $data[1];
                    
                    
                    if ($width < $height){
                        $x = (50*$height)/$width;
                        $width = 50;
                        $height = $x; 
                        $left = '0';
                        $right= $width;
                        $top = ($height - $width)/2;
                        $bottom = (($height - $width)/2) + $width;
                        //$height = 50;
                    }else {
                        $x = (50*$width)/$height;
                        $width = $x;
                        $height = 50;
                        $left = ($width - $height)/2;
                        $right= (($width - $height)/2) + $height;
                        $top = '0';
                        $bottom = $height;
                        //$width = 50;

                    }
                    
                    
                

            ?>
                <div class="div-img-perfil div-img">
                    <a href="<?php echo $url_sem_delimg?>&func=ver_img">
                        <div style="<?php if ($width < $height){ echo "width:$width"."px;height:50px";}else{ echo "width:50px;height:$height"."px";} ?>;position:relative;">

                            <img src="crop_upload/upload_pic/<?php echo $nome_img_db;?>" alt="Foto para clip"

                        style="width:<?php echo $width?>px;height:<?php echo $height?>px;position:absolute;clip: rect(<?php echo $top.'px,'.$right.'px,'.$bottom.'px,'.$left .'px'?>);<?php if ($width < $height){ echo "margin-top:-". $top ."px";}else{echo "margin-left:-". $left ."px";};?>; " />

                        </div>
                    </a>
                </div>
            
            <?php }else{?>
                <div class="div-img-perfil div-img">
                    <a href="<?php echo $url_sem_delimg?>&func=ver_img">
                
                        <img src="crop_upload/upload_pic/<?php echo $nome_img_db;?>" class="jcrop-preview"/>
                    </a>
                </div>
            <?php }?>
                <div class="dados_span">
                    <span><strong>Usuario: </strong><?php echo $con_sel_valid['nome']. ' '. $con_sel_valid['sobrenome']; ?></span><br>
                    <span><strong>Email: </strong><?php echo $con_sel_valid['email']; ?></span><br>
                </div>
                
            </div>
            <div class="sair_voltar">
                <div class=""><a href="edit_dados.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?><?php if(array_key_exists('id_plan',$_GET)){ echo '&id_plan='.$id_plan_url;}?>" class="default voltar_plan">Editar dados</a></div>
                <div class=""><a href="index_user.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>" class="default voltar_plan">Planilhas</a></div>
                <div class=""><a href="index_user.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>&func=sair" class="default sair">Sair</a></div>
            </div>
        </div>
    </header>
    <div class="capa"></div>
    <?php
        if (@$_GET['func'] == 'ver_img'){
    ?>
            <div class="modal-fora mostra ">
                <div class="modal-dentro mostra-img">
                    <h4 class="text-center">Minha imagem de perfil</h4>
                    
                    <form class="cad_cred" method="POST">
                    
                        <img src="crop_upload/upload_pic/<?php echo $con_sel_valid['nome_img']?>" id="img_perfil" alt="">
                        <a href="edit_dados.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>" id="btn_trocar" class="btn btn-success btn-nao">Trocar</a>                        
                        <a href="<?php echo $URL_ATUAL?>&del_img=sim" id="btn_excluir" class="btn btn-default btn-del">Excluir</a>
                        <button class="btn btn-default btn-sim" name="cancelar" type="submit">Fechar</button>
                    </form>
                </div>
            </div>
        <?php
            }
        ?>
        <script>
            var img_perfil_layout= document.querySelector('#img_perfil').src;
            
            if (img_perfil_layout.includes('padrao.jpg')){
                document.querySelector('#btn_trocar').innerHTML = 'Adicionar imagem';
                document.querySelector('#btn_excluir').style.display = 'none';
            }
        </script>
    <?php
    if(isset($_POST['cancelar'])){
        
        echo "<script type='text/javascript'>window.location ='$url_sem_verimg'</script>";
    }
    if(@$_GET['del_img'] == 'sim'){ 
                        
        if ($con_sel_valid['nome_img'] != 'padrao.jpg'){
            echo unlink("crop_upload/upload_pic/".$con_sel_valid['nome_img']);
            echo unlink("crop_upload/upload_pic/".$con_sel_valid['nome_img_original']);
        }
        $sql_nome_img = "UPDATE usuarios SET nome_img = 'padrao.jpg', nome_img_original = 'padrao.jpg' WHERE id = '$id_user'";
        $res_nome_img= mysqli_query($conexao, $sql_nome_img);
        echo "<script>window.location = '$url_sem_delimg_verimg' </script>";
        


    }
    ?>

    <script>
        

    /*
        var width_db = "<?php// print $width_db?>";
        var height_db = "<?php //print $height_db?>";
        var marginLeft_db = "<?php// print $marginLeft_db?>";
        var marginTop_db = "<?php //print $marginTop_db?>";
            
        document.querySelector('.jcrop-preview').style.width = width_db;
        document.querySelector('.jcrop-preview').style.height = height_db;
        document.querySelector('.jcrop-preview').style.marginLeft = marginLeft_db;
        document.querySelector('.jcrop-preview').style.marginTop = marginTop_db;
        */
    </script>
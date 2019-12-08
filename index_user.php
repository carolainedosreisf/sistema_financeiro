<?php require "utils/header_user.php";?>
<?php 

while($con_sel_valid = mysqli_fetch_assoc($res_sel_valid)){
    $codigo =  $con_sel_valid['cod_log'];
    $_POST['valid'] = $codigo;
    $valid  = $_GET['valid'] ;
    if(($codigo == $valid)){
?>
<?php require "utils/header_dados_user.php";?>


    <div class="section-title">
        <h3>Minhas planilhas</h3>
    </div>
    <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <a href="index_user.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>&func=add-plan" class="cards">
                        <div class="about-item about-item2">
                            <div class="blog-text text-center about-ico">
                                <img src="img/add.png" alt="">
                                <h3>Adicionar uma planilha</h3>
                                
                            </div> 
                        </div>
                    </a>
                </div>
            <?php
            


            $sql_sel_plan = "SELECT * FROM planilhas WHERE id_user = '$id_user'";
            $con_sel_plan= mysqli_query($conexao, $sql_sel_plan );
            while($res_sel_plan = mysqli_fetch_assoc($con_sel_plan)){

            $id_plan =$res_sel_plan['id_plan']; 
            ?>
            <div class="col-md-3 col-sm-6">
                    
                    <div class="about-item about-item2">
                        <div class="blog-text text-center about-ico">
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            <h3>
                                <?php 
                                    $x =  $res_sel_plan['mes']; 
                                    
                                    case_mes($x);
                                    echo '/'.$res_sel_plan['ano'];
                                
                                ?>
                            </h3>
                            <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user?>&id_plan=<?php echo $id_plan 
                            ?>">
                                <span class="posted_on">Abrir >></span>
                            </a>
                            <div class="btn-acoes">
                                <a href="index_user.php?valid=<?php echo $valid ?>&id_user=<?php echo $id_user ?>&func=deleta_plan&id_plan=<?php echo $id_plan ?>"><img src="img/trash.png" name="apagar_plan" title="Apagar"></a>
                            </div>
                        </div> 
                    </div>
                
                </div>
            <?php }?>
            </div>
        </div><!-- end container -->
    </div><!-- end section -->
    <?php

    if(@$_GET['func'] == 'deleta_plan'){
        $id_plan_url = $_GET['id_plan'];
        $sql_confirm_del = "SELECT * FROM planilhas WHERE id_plan = '$id_plan_url'";
        $con_confirm_del = mysqli_query($conexao, $sql_confirm_del);
        while ($res_confirm_del = mysqli_fetch_assoc($con_confirm_del)){
            
        
    ?>

        <div class="modal-fora mostra">
            <div class="modal-dentro">
                <h4 class="text-center">Deseja realmente apagar a planilha: <?php echo $res_confirm_del['mes_ano']; ?>?</h4>
                
                <form action="" class="sim_nao" method="POST">
                    <button class="btn btn-success btn-nao" name="apagar_nao" type="submit">Não</button>
                    <button class="btn btn-default btn-sim" name="apagar_sim" type="submit">Sim</button>
                </form>
            </div>
        </div>

        
    <?php  
    $id_user_url = $_GET['id_user'];
        
        if(isset($_POST['apagar_sim'])){
            $sql_delete = "DELETE FROM planilhas WHERE id_plan = '$id_plan_url'";
            mysqli_query($conexao, $sql_delete);
            echo "<script>window.location = 'index_user.php?valid=$valid&id_user=$id_user_url ';</script>"; 
        }
        if (isset($_POST['apagar_nao'])){
            echo "<script>window.location = 'index_user.php?valid=$valid&id_user=$id_user_url';</script>";
        }
    }
    }
    
        
    ?>

    </div>
    <?php require "footer.php";?>

    <?php
    if(@$_GET['func'] == 'add-plan'){
            
    ?>
        <div class="modal-fora mostra">
            <div class="modal-dentro">
                <h4>Adicionar uma planilha</h4>
                <form method="POST">
                    <span>Mês: </span>
                    <select name="mes" class="mes">
                        <option value="01">Janeiro</option>
                        <option value="02">Fevereiro</option>
                        <option value="03">Março</option>
                        <option value="04">Abril</option>
                        <option value="05">Maio</option>
                        <option value="06">Junho</option>
                        <option value="07">Julho</option>
                        <option value="08">Agosto</option>
                        <option value="09">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    <br><br>
                    <span>Ano: </span>
                    <select name="ano" class="ano">
                    <?php 
                        
                        for($i = $ano_atual - 5; $i <= $ano_atual + 5; $i++ ){
                            echo $i. ' ';
                    ?>
                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                    <?php 
                        }
                    ?>
                    </select>
                    <br>
                    <div class="botoes">
                    
                        <button class="btn btn-success criar" name="criar" type="submit">Criar</button>
                        <a href="<?php echo 'index_user.php?valid='.$valid.'&id_user='.$id_user.'&func=fechar';?>" class="btn btn-default cancelar">Cancelar</a>
                      
                    </div>
                </form>
            </div>
        </div>
    <?php
        }
        
    ?>
    <script>
        var id = "<?php print $id_user;?>"
    </script>
    <?php


        if(isset($_POST['criar'])){
            
            $mes = $_POST['mes'];
            $ano = $_POST['ano'];
            $mes_ano= $mes.'/'.$ano;
            $sql_add_plan = "INSERT INTO planilhas (id_user,mes,ano, mes_ano) VALUES ('$id_user','$mes','$ano','$mes_ano')";
            $res_add_plan = mysqli_query($conexao, $sql_add_plan);
            echo "<script>window.location = 'index_user.php?valid=$valid&id_user='+ id;</script>";

        }
        if(@$_GET['func'] == 'fechar'){
            echo "<script>window.location = 'index_user.php?valid=$valid&id_user='+ id;</script>";
        }
    ?>
    <script>
        var mes_atual = "<?php print $mes_atual ?>";
        var ano_atual = "<?php print $ano_atual ?>";

        document.querySelector('.mes').value = mes_atual;
        document.querySelector('.ano').value = ano_atual;
    </script>
<?php
        }else if($valid !== $codigo){
            echo "<script>window.location = 'index.php';</script>"; 
        }else{
            echo "<script>window.location = 'index.php';</script>"; 
        }
    }
?>



</body>
</html>
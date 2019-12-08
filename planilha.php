<?php $id_plan_url =$_GET['id_plan']; ?>
<?php require "utils/header_user.php";?>
<?php 

while($con_sel_valid = mysqli_fetch_assoc($res_sel_valid)){
    $codigo =  $con_sel_valid['cod_log'];
    $_POST['valid'] = $codigo;
    $valid  = $_GET['valid'] ;
    if(($codigo == $valid)){
?>
<?php require "utils/header_dados_user.php";?>

<?php
     

    if(array_key_exists('id_plan',$_GET)){
        
        $id_plan_url =$_GET['id_plan'];
        $sql_exibe = "SELECT * FROM planilhas WHERE (id_plan = '$id_plan_url') and (id_user = '$id_user')";
        $con_exibe= mysqli_query($conexao, $sql_exibe); 
        if (mysqli_num_rows($con_exibe) < 1){
    ?>
        <div class="invalido">
            <h1 clas="text-center">Página não encontada <br><i class="fa fa-frown-o" aria-hidden="true"></i></h1>
        </div>
    <?php
        }else{
    ?>

    <div class="container panel2">
        <div class="row">
        <div class="col-md-12 titulo_plan">
        <?php
        while ($res_exibe = mysqli_fetch_assoc($con_exibe)){
        ?>
            <h3>Planilha de <?php echo case_mes($res_exibe['mes'])."/".$res_exibe['ano'];?></h3>
        <?php
            }
        ?>
        </div>
            <div class="col-md-6 col-sm-12 col-xs-12 floating">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Créditos</div>
                            <div class="text-right col-md-6">
                                <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&id_plan=<?php echo $id_plan_url ?>&func=cad_cred" class="mensagem"><button class="btn-abrir btn_nv_prod"><i class="" aria-hidden="true">Cadastrar crédito</i></button></a>
                            </div>
                            
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome do crédito</th>
                                <th>Valor</th>
                                
                                <th>Ações</th>
                            </tr>
                            
                        </thead>
                        <?php
                            $sql_exibe_cred = "SELECT * FROM creditos WHERE (id_user = '$id_user') and (id_plan = '$id_plan_url') ORDER BY id_credito DESC";
                            $con_exibe_cred = mysqli_query($conexao, $sql_exibe_cred); 
                            $creditos = 0;
                            while ($res_exibe_cred = mysqli_fetch_assoc($con_exibe_cred)){
                            $creditos = $creditos + $res_exibe_cred['valor'];
                            
                        ?>
                        <tbody class="">
                            <tr>
                                <td><?php echo $res_exibe_cred['nome']?></td>
                                <td>R$ <?php echo $res_exibe_cred['valor']?></td>
                                <td>
                                    <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&func=edita_cred&id_plan=<?php echo $res_exibe_cred['id_plan']?>&id_cred=<?php echo $res_exibe_cred['id_credito']?>"><img src="img/edit.png" title="Editar"></a>
                                    <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&func=delete_cred&id_plan=<?php echo $res_exibe_cred['id_plan']?>&id_cred=<?php echo $res_exibe_cred['id_credito']?>"><img src="img/trash.png" title="Excluir"></a>
                                </td>
                            </tr> 
                        </tbody>
                        <?php }?>
                        <tr class="total_cred">
                            <td>Total: </td>
                            <td></td>
                            <td>R$ <?php echo $creditos;?></td>
                        </tr>

                    </table>
                
                </div>
            </div>
            <div class="col-md-6 col-sm-12 col-xs-12 floating">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-6">Débitos</div>
                            <div class="text-right col-md-6">
                                <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&id_plan=<?php echo $id_plan_url ?>&func=cad_deb" class="mensagem"><button class="btn-abrir btn_nv_prod"><i class="" aria-hidden="true">Cadastrar débito</i></button></a>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome do débito</th>
                                <th>Valor</th>
                                
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <?php
                            $sql_exibe_deb = "SELECT * FROM debitos WHERE (id_user = '$id_user') and (id_plan = '$id_plan_url') ORDER BY id_debito DESC";
                            $con_exibe_deb = mysqli_query($conexao, $sql_exibe_deb); 
                            $saldo= $creditos;
                            while ($res_exibe_deb = mysqli_fetch_assoc($con_exibe_deb)){
                                $saldo = $saldo - $res_exibe_deb['valor'];
                        ?>
                        <tbody class="">
                            <tr>
                                <td><?php echo $res_exibe_deb['nome']?></td>
                                <td><?php echo $res_exibe_deb['valor']?></td>
                                <td>
                                    <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&func=edita_deb&id_plan=<?php echo $res_exibe_deb['id_plan']?>&id_deb=<?php echo $res_exibe_deb['id_debito']?>"><img src="img/edit.png" title="Editar"></a>

                                    <a href="planilha.php?valid=<?php echo $valid?>&id_user=<?php echo $id_user;?>&func=delete_deb&id_plan=<?php echo $res_exibe_deb['id_plan']?>&id_deb=<?php echo $res_exibe_deb['id_debito']?>"><img src="img/trash.png" title="Excluir"></a>

                                    
                                </td>
                            </tr> 
                        </tbody>
                        <?php }?>
                        <tr class="total_deb">
                            <td>Saldo: </td>
                            <td></td>
                            <td>R$ <?php echo $saldo;?></td>
                        </tr>
                    </table>
                
                </div>
            </div>
            
        </div>
    </div>
    <?php
    
    if(@$_GET['func'] == 'cad_deb'){  
        
    ?>

        <div class="modal-fora mostra">
            <div class="modal-dentro">
                <h4 class="text-center">Cadastrar Débito</h4>
                
                <form class="cad_cred" method="POST">
                    <p id="erro_deb"></p>
                    <label>Nome do débito:</label><br>
                    <input type="text" name="nome_deb" class="nome_deb"><br>
                    <label>Valor do débito:</label><br>
                    <input type="text" name="valor_deb" class="valor_deb"><br>
                    <button class="btn btn-success btn-nao" name="cad_deb" type="submit">Cadastrar</button>
                    <a href="<?php echo 'planilha.php?valid='.$valid.'&id_user='.$id_user.'&id_plan='.$id_plan_url.'&func=fechar';?>" class="btn btn-default btn-sim">Cancelar</a>
                </form>
            </div>
        </div>

    <?php
    }
    ?>
    <?php
        if(@$_GET['func'] == 'cad_cred'){  
    ?>
        <div class="modal-fora mostra">
            <div class="modal-dentro">
                <h4 class="text-center">Cadastrar Crédito</h4>
                
                <form class="cad_cred" method="POST">
                    <p id="erro_cred"></p>
                    <label>Nome do crédito:</label><br>
                    <input type="text" name="nome_cred" class="nome_cred"><br>
                    <label>Valor do crédito:</label><br>
                    <input type="text" name="valor_cred" class="valor_cred"><br>
                    <button class="btn btn-success btn-nao" name="cad_cred" type="submit">Cadastrar</button>
                    <a href="<?php echo 'planilha.php?valid='.$valid.'&id_user='.$id_user.'&id_plan='.$id_plan_url.'&func=fechar';?>" class="btn btn-default btn-sim">Cancelar</a>
                </form>
            </div>
        </div>
    <?php
        }
    ?>
    <?php
        
        if(@$_GET['func'] == 'edita_cred'){  
            $id_cred_url =$_GET['id_cred'];
            $sql_sel_edit_cred = "SELECT * FROM creditos WHERE (id_user = '$id_user') and (id_plan = '$id_plan_url') and (id_credito = '$id_cred_url')";
            $con_sel_edit_cred = mysqli_query($conexao, $sql_sel_edit_cred); 
            while ($res_sel_edit_cred = mysqli_fetch_assoc($con_sel_edit_cred)){
    ?>

    <div class="modal-fora mostra">
        <div class="modal-dentro">
            <h4 class="text-center">Editar Crédito</h4>
            
            <form class="cad_cred" method="POST">
                <p id="erro_cred_edit"></p>
                <label>Nome do débito:</label><br>
                <input type="text" name="nome_cred_edit" class="nome_cred_edit" value="<?php echo $res_sel_edit_cred['nome'];?>"><br>
                <label>Valor do débito:</label><br>
                <input type="text" name="valor_cred_edit" class="valor_cred_edit" value="<?php echo $res_sel_edit_cred['valor'];?>"><br>
                <button class="btn btn-success btn-nao" name="salvar_cred" type="submit">Salvar</button>
                <a href="<?php echo 'planilha.php?valid='.$valid.'&id_user='.$id_user.'&id_plan='.$id_plan_url.'&func=fechar';?>" class="btn btn-default btn-sim">Cancelar</a>
            </form>
        </div>
    </div>

    <?php
            }
    }
    ?>
    <?php
        
        if(@$_GET['func'] == 'edita_deb'){  
            $id_deb_url =$_GET['id_deb'];
            $sql_sel_edit_deb = "SELECT * FROM debitos WHERE (id_user = '$id_user') and (id_plan = '$id_plan_url') and (id_debito = '$id_deb_url')";
            $con_sel_edit_deb = mysqli_query($conexao, $sql_sel_edit_deb); 
            while ($res_sel_edit_deb = mysqli_fetch_assoc($con_sel_edit_deb)){
    ?>

    <div class="modal-fora mostra">
        <div class="modal-dentro">
            <h4 class="text-center">Editar Débito</h4>
            
            <form class="cad_cred" method="POST">
                <p id="erro_deb_edit"></p>
                <label>Nome do débito:</label><br>
                <input type="text" name="nome_deb_edit" class="nome_deb_edit" value="<?php echo $res_sel_edit_deb['nome'];?>"><br>
                <label>Valor do débito:</label><br>
                <input type="text" name="valor_deb_edit" class="valor_deb_edit" value="<?php echo $res_sel_edit_deb['valor'];?>"><br>
                <button class="btn btn-success btn-nao" name="salvar_deb" type="submit">Salvar</button>
                <a href="<?php echo 'planilha.php?valid='.$valid.'&id_user='.$id_user.'&id_plan='.$id_plan_url.'&func=fechar';?>" class="btn btn-default btn-sim">Cancelar</a>
            </form>
        </div>
    </div>

    <?php
            }
    }
    ?>

    <?php
    if(@$_GET['func'] == 'delete_cred'){ 
        $id_cred_url =$_GET['id_cred'];
        $sql_delete_cred = "DELETE FROM creditos WHERE id_credito = '$id_cred_url'";
        mysqli_query($conexao, $sql_delete_cred);
        echo "<script>window.location = 'planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url';</script>"; 
    }

    ?>
    <?php
        if(isset($_POST['salvar_cred'])){
            $nome_cred_edit   = $_POST['nome_cred_edit'];
            $valor_cred_edit  = $_POST['valor_cred_edit'];
        }
    ?>
    <script>
        function msg_erro_cred_edit(msg){
            document.querySelector('#erro_cred_edit').innerHTML = msg;
        }
        
        function guarda_dados_cred_edit(){
            var nome_cred_edit = "<?php print $nome_cred_edit; ?>";
            var valor_cred_edit = "<?php print $valor_cred_edit; ?>";
            document.querySelector('.nome_cred_edit').value = nome_cred_edit;
            document.querySelector('.valor_cred_edit').value = valor_cred_edit ;  
        }
        
    </script>
    <?php
        if(isset($_POST['salvar_cred'])){
            $id_cred_url =$_GET['id_cred'];
        

            $nome_cred_edit  = $_POST['nome_cred_edit'];
            $valor_cred_edit  = $_POST['valor_cred_edit'];
            
                if (($nome_cred_edit !== '') and ($valor_cred_edit !== '') ){
                    if(is_numeric($valor_cred_edit)){
                        $sql_upd_cred = "UPDATE creditos SET nome = '$nome_cred_edit', valor = '$valor_cred_edit' WHERE id_credito = '$id_cred_url'";
                        $res_upd_cred= mysqli_query($conexao, $sql_upd_cred);
                        echo "<script>window.location = 'planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url';</script>";
                    }else{
                        echo "<script type='text/javascript'>msg_erro_cred_edit('Somente números e ponto no valor.'); guarda_dados_cred_edit();</script>";
                    }  	
                } else{
                    echo "<script type='text/javascript'>msg_erro_cred_edit('Por favor, preencha todos os campos.'); guarda_dados_cred_edit();</script>";
                }
                
            
            
        }
    ?>
    <?php
    if(@$_GET['func'] == 'delete_deb'){ 
        $id_deb_url =$_GET['id_deb'];
        $sql_delete_deb = "DELETE FROM debitos WHERE id_debito = '$id_deb_url'";
        mysqli_query($conexao, $sql_delete_deb);
        echo "<script>window.location = 'planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url';</script>"; 
    }
    ?>
    <?php
        if(isset($_POST['salvar_deb'])){
            $nome_deb_edit  = $_POST['nome_deb_edit'];
            $valor_deb_edit  = $_POST['valor_deb_edit'];
        }
    ?>
    <script>
        function msg_erro_deb_edit(msg){
            document.querySelector('#erro_deb_edit').innerHTML = msg;
        }
        function guarda_dados_deb_edit(){
            var nome_deb_edit = "<?php print $nome_deb_edit; ?>";
            var valor_deb_edit = "<?php print $valor_deb_edit; ?>";
            document.querySelector('.nome_deb_edit').value = nome_deb_edit;
            document.querySelector('.valor_deb_edit').value = valor_deb_edit ;  
        }
    </script>

    <?php
        if(isset($_POST['salvar_deb'])){
            $id_deb_url =$_GET['id_deb'];

            
            if (($nome_deb_edit !== '') and ($valor_deb_edit !== '') ){
                if(is_numeric($valor_deb_edit)){
                    $sql_upd_deb = "UPDATE debitos SET nome = '$nome_deb_edit', valor = '$valor_deb_edit'  WHERE id_debito = '$id_deb_url'";
                    $res_upd_deb= mysqli_query($conexao, $sql_upd_deb);	
                    echo "<script>window.location = 'planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url';</script>";  	
                }else{
                    echo "<script type='text/javascript'>msg_erro_deb_edit('Somente números e ponto no valor.'); guarda_dados_deb_edit();</script>";
                }
            }  else{
                echo "<script type='text/javascript'>msg_erro_deb_edit('Por favor, preencha todos os campos.');guarda_dados_deb_edit(); </script>";
            } 
        }
    ?>
    <script>
        var id = "<?php print $id_user;?>"    
    </script>
    <?php
        if(isset($_POST['cad_deb'])){
            $nome_deb  = $_POST['nome_deb'];
            $valor_deb  = $_POST['valor_deb'];  
        }
        if(@$_GET['func'] == 'fechar'){
            echo "<script>window.location = 'planilha.php?valid=$valid&id_user='+ id +'&id_plan='+ $id_plan_url;</script>";
        }
    ?>

    <script>
        function msg_erro_deb(msg){
            document.querySelector('#erro_deb').innerHTML = msg;
        }
        
        function guarda_dados_deb(){
            var nome_deb = "<?php print $nome_deb; ?>";
            var valor_deb = "<?php print $valor_deb; ?>";
            document.querySelector('.nome_deb').value = nome_deb;
            document.querySelector('.valor_deb').value = valor_deb ;  
        }
        
    </script>
    <?php
        if(isset($_POST['cad_cred'])){
            $nome_cred  = $_POST['nome_cred'];
            $valor_cred  = $_POST['valor_cred']; 
        }
    ?>
    <script>
        function msg_erro_cred(msg){
            document.querySelector('#erro_cred').innerHTML = msg;
        }
        
    
        function guarda_dados_cred(){
            var nome_cred = "<?php print $nome_cred; ?>";
            var valor_cred = "<?php print $valor_cred; ?>";
            document.querySelector('.nome_cred').value = nome_cred;
            document.querySelector('.valor_cred').value = valor_cred ;  
        }
    
        
    </script>
    <?php
        if(isset($_POST['cad_deb'])){
            if ($nome_deb != '' && $valor_deb != ''){
                if(is_numeric($valor_deb)){
                    $sql_cad_deb = "INSERT INTO debitos (id_plan, id_user, nome, valor) VALUES ('$id_plan_url','$id_user','$nome_deb','$valor_deb')";
                    $cad_cred = mysqli_query($conexao, $sql_cad_deb);
                    echo "<script type='text/javascript'>window.location ='planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url'</script>"; 
                    //echo "<script type='text/javascript'>msg_sucesso();</script>";
                }else{
                    echo "<script type='text/javascript'>msg_erro_deb('Digite somente números e ponto no valor.'); guarda_dados_deb();</script>";
                }    
            }else{
                echo "<script type='text/javascript'>msg_erro_deb('Por favor, preencha todos os campos.'); guarda_dados_deb();</script>";
            } 
        }
    ?>
    <?php
        if(isset($_POST['cad_cred'])){
            if ($nome_cred != '' && $valor_cred != '' ){
                if(is_numeric($valor_cred)){
                    $sql_cad_cred = "INSERT INTO creditos (id_plan, id_user, nome, valor) VALUES ('$id_plan_url','$id_user','$nome_cred','$valor_cred')";
                    $cad_cred = mysqli_query($conexao, $sql_cad_cred);
                    echo "<script type='text/javascript'>window.location ='planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url'</script>";  
                    //echo "<script type='text/javascript'>msg_sucesso();</script>";  
                }else{
                    echo "<script type='text/javascript'>msg_erro_cred('Somente números e ponto no valor.'); guarda_dados_cred();</script>";
                }
            }else{
                echo "<script type='text/javascript'>msg_erro_cred('Por favor, preencha todos os campos.'); guarda_dados_cred();</script>";
                
            } 
        }

    ?>
    <?php 
        if(isset($_POST['cancelar'])){
            echo "<script type='text/javascript'>window.location ='planilha.php?valid=$valid&id_user=$id_user&id_plan=$id_plan_url'</script>";
        }
    ?>
    <?php } ?>
    <?php
        }else{
    ?>
        <div class="invalido">
            <h1 clas="text-center">Página não encontada <br><i class="fa fa-frown-o" aria-hidden="true"></i></h1>
        </div>
    <?php
        }
    ?>
    </div>
    <?php require "footer.php";?>


    <?php
        
    ?>
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
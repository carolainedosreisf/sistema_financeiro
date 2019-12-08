<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $codigo = rand() * rand();
         
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $subject = "Esqueci a senha Sistema Financeiro";
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
 
            http_response_code(400);
            echo "Por favor preencha o formulário e tente novamente.";
            exit; 
        }
        $recipient = "$email";
        $email_content .= '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
        $email_content .= '<html xmlns="http://www.w3.org/1999/xhtml">';
        $email_content .= '<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>Demystifying Email Design</title><meta name="viewport" content="width=device-width, initial-scale=1.0"/><html xmlns="http://www.w3.org/1999/xhtml">
        <style>body{font-family: "Courier New", Courier;}</style>    
        </head>';
        $email_content .= '
        <body style="width:100%;margin:0px;font-family: Courier New, Courier;">
        <div>
            <a style="float: right;width: 100%;padding: 15px 10px;text-align:right;background:rgb(0, 174, 84);color: white;text-decoration: none;"href="http://carolwebdesigner.com.br/sistema_financeiro/"  >www.carolwebdesigner.com.br</a>
        </div>
        <div class="apresent" style="padding: 70px 50px 20px 50px;text-align: center;">
            <p style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;">Email para redefinir a senha do seu login no Sistema Financeiro.</p>
        </div>
        <div class="click" style="text-align:center;">
            <a href="http://carolwebdesigner.com.br/sistema_financeiro/esqueceu_senha/redefinir.php?id_user=';
            $email_content .= $email; 
            $email_content .= '&valid=';
            $email_content .= $codigo; 
            $email_content .= '"style="padding: 10px 20px;border: 3px solid rgb(0, 174, 84);font-size: 14px;color: rgb(66, 66, 66);max-width: 200px;text-align: center;text-decoration: none;"  >Redefinir a senha</a>
        </div>
        <img style="width:100%;margin-top: 30px;" src="http://carolwebdesigner.com.br/sistema_financeiro/esqueceu_senha/capa_dolar.png" alt="">
        <div class="info">
            <h4 style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;padding: 0px 10px;">Depois de clicar no botão a cima, siga essas etapas:</h4>
            <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>1.Insira a nova senha.</p>
            <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>2.Confirme sua nova senha.</p>
            <p style="font-size: 14px;color: rgb(66, 66, 66);padding: 4px 0px;padding: 0px 10px";>3.Clique em “Enviar”.</p>
            <h4 style="font-size: 16px;color: #333;line-height: 150%;font-weight: bold;padding: 0px 10px;">Este link só pode ser utilizado uma única vez. Ele expirará em uma hora.</h4>
        </div>
        </body></html>
        '; 
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        $email_headers = "De: Sistema financeiro ";
        //verifica no banco
        require '../config.php';
        $sql_sel_login = "SELECT * FROM usuarios WHERE email = '$email'";
        $res_sel_login = mysqli_query($conexao, $sql_sel_login);
        
            if (mysqli_num_rows($res_sel_login) > 0){
                if (mail($recipient, $subject, $email_content, $headers)) {
                    http_response_code(200);
                    echo "Email enviado com sucesso. Agora é só conferir sua caixa de entrada.";
                    //insere no banco
                    while($res_sel_login_2 = mysqli_fetch_assoc($res_sel_login)){
                        $id_user = $res_sel_login_2['id'];
                        $sql_sel_red_itens = "SELECT * FROM redefinir_senha";
                        $res_sel_red_itens= mysqli_query($conexao, $sql_sel_red_itens);
                        $sql_delete_red_senha= "DELETE FROM redefinir_senha WHERE id_user = '$id_user'";
                        mysqli_query($conexao, $sql_delete_red_senha);
                        $tempo=time();
                        $tempo_delete = $tempo +3600;
                        $data_delete = date("Y-m-d H:i:s",$tempo_delete);
                        $sql_red_senha= "INSERT INTO redefinir_senha (id_user, valid, time_d, data_d) VALUES ('$id_user','$codigo', '$tempo_delete','$data_delete')";
                        $cad_red_senha = mysqli_query($conexao, $sql_red_senha);
                       
                    }

                }else {
                    http_response_code(500);
                    echo "Oops! Algo ocorreu de errado durante a pré-inscrição.";
                }
            } else {
                http_response_code(500);
                echo "Desculpe, mas seu email não esta cadastrado em nosso sistema.";
            }
    } else {
        http_response_code(403);
        echo "Ocorreu algo ao enviar o email, por gentileza tente novamente.";
    }

?>

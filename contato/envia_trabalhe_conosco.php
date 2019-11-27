<?php
if ($_SERVER[HTTP_REFERER] == "http://formacerta.com.br/trabalhe-conosco/" ||
	$_SERVER[HTTP_REFERER] == "http://www.formacerta.com.br/trabalhe-conosco/") {

    require_once("class.phpmailer.php");

    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPDebug = 1;
    $mailer->Port = 587; //Indica a porta de conexão para a saída de e-mails. Utilize obrigatoriamente a porta 587.

    $mailer->Host = 'mail.formacerta.com.br'; //Onde em 'servidor_de_saida' deve ser alterado por um dos hosts abaixo:
    //Para cPanel: 'mail.dominio.com.br';
    //Para Plesk 11 / 11.5: 'smtp.dominio.com.br';

    //Descomente a linha abaixo caso revenda seja 'Plesk 11.5 Linux'
    //$mailer->SMTPSecure = 'tls';

    $nome = addslashes($_POST[nome]);
    $email = addslashes($_POST[email]);
    $telefone = addslashes($_POST[telefone]);
    $cargo = addslashes($_POST[cargo]);
    $arquivo = "";
    if (isset($_FILES[arquivo]) && $_FILES[arquivo][error] == UPLOAD_ERR_OK) {
        $arquivo = $_FILES[arquivo];
    }
    //"application/vnd.openxmlformats-officedocument.wordprocessingml.document"
    
    $mailer->SMTPAuth = true; //Define se haverá ou não autenticação no SMTP
    $mailer->Username = 'rh@formacerta.com.br'; //Informe o e-mai o completo
    $mailer->Password = 'formacerta@380'; //Senha da caixa postal
    $mailer->FromName = 'Contato pelo site formacerta.com.br'; //Nome que será exibido para o destinatário
    $mailer->From = 'rh@formacerta.com.br'; //Obrigatório ser a mesma caixa postal indicada em "username"
    //$mailer->AddAddress('rh@formacerta.com.br','adm@formacerta.com.br'); //Destinatários
    $mailer->AddAddress('vera@formacerta.com.br'); //Destinatários
    $mailer->Subject = 'Contato pelo site - ' . date("H:i") . '-' . date("d/m/Y");
    $mailer->Body = "Dados do contato para trabalho
    Nome: $nome
    Email: $email
    Telefone: $telefone";
    $mailer->AddAttachment($arquivo['tmp_name'],$arquivo['name']);
    $mailer->CharSet = 'UTF-8';

    if (!$mailer->Send()) {
        echo "Mensagem não enviada";
        echo "Erro: " . $mailer->ErrorInfo;
        exit;
    } else {
        ?>
        <script>
            alert("Sua mensagem foi enviada com sucesso.");
            window.location = "http://www.formacerta.com.br/";
        </script>
    <?php
    }

}
else{
    echo "Acesso não autorizado";
    exit;
}

?>
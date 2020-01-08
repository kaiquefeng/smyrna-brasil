<?php
    function cadastraUsuario($value){
        $arquivo = "../dashboard/json/distribuidores.json";

        $jsonUsuarios = file_get_contents($arquivo);

        $arrayUsuarios = json_decode($jsonUsuarios, true);

        array_push($arrayUsuarios["usuarios"], $value);

        $jsonUsuarios = json_encode($arrayUsuarios, JSON_UNESCAPED_SLASHES);

        $cadastrou = file_put_contents($arquivo, $jsonUsuarios);

        return $cadastrou;
    }

    
    if($_POST){
        if($_FILES){
            if($_FILES["avatar"]["error"] == UPLOAD_ERR_OK){
               

                $pastaUploads = $raizProjeto . $caminhoJson;

                $caminhoUpload = $pastaUploads . $nomeImg;

                $moveu = move_uploaded_file($nomeTmp, $caminhoUpload);
            }
        }

        $nome = $_POST["nome"];
        $email = $_POST["email"];
		$telefone = $_POST["telefone"];
		$estado = $_POST["estado"];
        $quantidade = $_POST["quantidade"];
        $mensagem = $_POST["mensagem"];

        $novoUsuario = [
            "nome" => $nome,
            "email" => $email,
			"telefone" => $telefone,
			"estado" => $estado,
            "quantidade" => $quantidade,
            "mensagem" => $mensagem,

        ];

        $cadastrou = cadastraUsuario($novoUsuario);
    }
?>

<?php
if ($_SERVER[HTTP_REFERER] == "http://smyrnabrasil.com.br/seja_distribuidor/" ||
	$_SERVER[HTTP_REFERER] == "http://smyrnabrasil.com.br/seja_distribuidor/") {

    require_once("class.phpmailer.php");

    $mailer = new PHPMailer();
    $mailer->IsSMTP();
    $mailer->SMTPDebug = 1;
    $mailer->Port = 587; //Indica a porta de conexão para a saída de e-mails. Utilize obrigatoriamente a porta 587.

    $mailer->Host = 'mail.smyrnabrasil.com.br'; //Onde em 'servidor_de_saida' deve ser alterado por um dos hosts abaixo:
    //Para cPanel: 'mail.dominio.com.br';
    //Para Plesk 11 / 11.5: 'smtp.dominio.com.br';

    //Descomente a linha abaixo caso revenda seja 'Plesk 11.5 Linux'
    //$mailer->SMTPSecure = 'tls';

    $nome = addslashes($_POST[nome]);
    $email = addslashes($_POST[email]);
    $telefone = addslashes($_POST[telefone]);
		$select = addslashes($_POST[select]);
		$quantidade = addslashes($_POST[quantidade]);
    $mensagem = addslashes($_POST[mensagem]);


    $mailer->SMTPAuth = true; //Define se haverá ou não autenticação no SMTP
    $mailer->Username = 'contato@smyrnabrasil.com.br'; //Informe o e-mai o completo
    $mailer->Password = 'Smyrna@380'; //Senha da caixa postal
    $mailer->FromName = 'Contato pelo site smyrnabrasil.com.br'; //Nome que será exibido para o destinatário
    $mailer->From = 'contato@smyrnabrasil.com.br'; //Obrigatório ser a mesma caixa postal indicada em "username"
    $mailer->AddAddress('contato@smyrnabrasil.com.br',' '); //Destinatários
    $mailer->Subject = 'Contato pelo site distribuidor - ' . date("H:i") . '-' . date("d/m/Y");
    $mailer->Body = "Dados do contato

Nome: $nome

Email: $email

Telefone: $telefone

Estado: $estado

Quantidade: $quantidade

Mensagem de Contato: $mensagem";
    $mailer->CharSet = 'UTF-8';
    if (!$mailer->Send()) {
        echo "Mensagem não enviada";
        echo "Erro: " . $mailer->ErrorInfo;
        exit;
    } else {
        ?>
        <script>
            alert("Sua mensagem foi enviada com sucesso.");
            window.location = "http://smyrnabrasil.com.br";
        </script>
    <?php
    }

}
else{
    echo "Acesso não autorizado";
    exit;
}

?>

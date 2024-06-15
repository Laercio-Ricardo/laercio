<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pegue os dados do formulário e sanitiza
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $subject = htmlspecialchars($_POST['subject']);
    $message = htmlspecialchars($_POST['message']);

    // Defina o endereço de email do destinatário
    $to = "seuemail@exemplo.com";

    // Crie o cabeçalho do email
    $headers = "From: " . $name . " <" . $email . ">\r\n";
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";

    // Crie o corpo do email
    $body = "<h2>Nova Mensagem do Formulário de Contato</h2>
             <p><strong>Nome:</strong> $name</p>
             <p><strong>Email:</strong> $email</p>
             <p><strong>Assunto:</strong> $subject</p>
             <p><strong>Mensagem:</strong> $message</p>";

    // Tente enviar o email
    if (mail($to, $subject, $body, $headers)) {
        $success = "Sua mensagem foi enviada com sucesso!";
    } else {
        $error = "Falha ao enviar a mensagem. Tente novamente mais tarde.";
    }
} else {
    $error = "Requisição inválida.";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato</title>
  <link rel="stylesheet" href="path_to_your_css_file.css"> <!-- Inclua seu arquivo CSS aqui -->
</head>
<body>
  <!-- Inclua aqui o seu formulário HTML adaptado -->
  <section id="contact" class="contact">
    <div class="container">
      <form action="contact.php" method="post" role="form" class="php-email-form mt-4">
        <div class="row">
          <div class="col-md-6 form-group">
            <input type="text" name="name" class="form-control" id="name" placeholder="Seu Nome..." required>
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input type="email" class="form-control" name="email" id="email" placeholder="Seu Email..." required>
          </div>
        </div>
        <div class="form-group mt-3">
          <input type="text" class="form-control" name="subject" id="subject" placeholder="Assunto..." required>
        </div>
        <div class="form-group mt-3">
          <textarea class="form-control" name="message" rows="5" placeholder="Mensagem..." required></textarea>
        </div>
        <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"><?php if(isset($error)) echo $error; ?></div>
          <div class="sent-message"><?php if(isset($success)) echo $success; ?></div>
        </div>
        <div class="text-center"><button type="submit">Enviar Mensagem</button></div>
      </form>
    </div>
  </section>
</body>
</html>

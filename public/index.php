<?php
  $host = "localhost";
  $dbname = "corretores";
  $username = "root";
  $password = "1396758zafqkI23.";

  try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexão realizada com sucesso";
  } catch(PDOException $e) {
    echo "Erro de conexão: " . $e->getMessage();
  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf = $_POST['cpf'];
    $cresci = $_POST['cresci'];
    $nome = $_POST['nome'];

    if (!empty($cpf) && !empty($cresci) && !empty($nome)) {
      echo "CPF: " . $cpf . "<br>";
      echo "CRESCI: " . $cresci . "<br>";
      echo "Nome: " . $nome;
  } else {
    echo "Por favor, preencha todos os campos";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>Cadastro de Corretor</h2>
  <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <input type="text" name="cpf" placeholder="Digite seu cpf">
    <input type="text" name="cresci" placeholder="Digite seu cresci">
    <input type="text" name="nome" placeholder="Digite seu nome">
    <button type="submit" value="Submit">Enviar</button>
  </form>
</body>
</html>
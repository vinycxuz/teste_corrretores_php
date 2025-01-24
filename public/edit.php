<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar corretor</title>
</head>
<body>
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

  ?>

  <form method="post" action="">
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>"><br>
    <label for="cresci">CRESCI:</label>
    <input type="text" id="cresci" name="cresci" value="<?php echo $row['cresci']; ?>"><br>
    <label for="nome">Nome:</label>
    <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>"><br>
    <input type="submit" value="Update">
  </form>
</body>
</html>
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

  $id = $_GET['id'];

  $sql = "SELECT * FROM corretor WHERE id=$id";
  $result = $pdo->query($sql);
  if ($result->rowCount() > 0) {
    $row = $result->fetch(PDO::FETCH_ASSOC);
  } else {
    echo "No user found";
    exit;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $cresci = $_POST['cresci'];
    $nome = $_POST['nome'];

    $update_sql = "UPDATE corretor SET cpf=:cpf, cresci=:cresci, nome=:nome WHERE id=:id";
    $stmt = $pdo->prepare($update_sql);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':cresci', $cresci);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
      echo "Record updated successfully";
    } else {
      echo "Error updating record: " . $stmt->errorInfo()[2];
    }
  }
  ?>

  <form method="post" action="">
    <input type="text" id="cpf" name="cpf" value="<?php echo $row['cpf']; ?>"><br>
    <input type="text" id="cresci" name="cresci" value="<?php echo $row['cresci']; ?>"><br>
    <input type="text" id="nome" name="nome" value="<?php echo $row['nome']; ?>"><br>
    <button type="submit" value="Update">Salvar</button>
  </form>
</body>
</html>
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
      try {
        $sql = "CREATE TABLE IF NOT EXISTS corretor (
            id INT AUTO_INCREMENT PRIMARY KEY,
            cpf VARCHAR(11),
            cresci VARCHAR(10),
            nome VARCHAR(80)
        )";
        $pdo->exec($sql);
    
        $sql = "INSERT INTO corretor (cpf, cresci, nome) VALUES (:cpf, :cresci, :nome)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':cpf', $cpf);
        $stmt->bindValue(':cresci', $cresci);
        $stmt->bindValue(':nome', $nome);
        $stmt->execute();
        
        echo "Dados cadastrados com sucesso!";
    } catch(PDOException $e) {
        echo "Erro ao cadastrar: " . $e->getMessage();
    }
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
  <table>
    <tr>
      <th>CPF</th>
      <th>Cresci</th>
      <th>Nome</th>
    </tr>
    <?php
      $sql = "SELECT * FROM corretor";
      $stmt = $pdo->query($sql);
      while ($row = $stmt->fetch()) {
        echo "<><td>".$row['cpf']."</td><td>".$row['cresci']."</td><td>".$row['nome']."</td><td>" . "<a href='delete.php?id=".$row['id']."'>Deletar</a></td><td> <a href='update.php?id=".$row['id']."'>editar</a></td></tr>";
      }
    ?>
  </table>
</body>
</html>
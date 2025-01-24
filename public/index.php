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
} elseif (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    try {
        $sql = "DELETE FROM corretor WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':id', $delete_id);
        $stmt->execute();
        echo "Corretor deletado com sucesso!";
    } catch(PDOException $e) {
        echo "Erro ao deletar: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Document</title>
</head>
<body>
  <main>
  <div class="form_container">
    <h2>Cadastro de Corretor</h2>
      <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-number_container">
          <input class="input-cpf" type="text" name="cpf" placeholder="Digite seu CPF">
          <input class="input-creci" type="text" name="cresci" placeholder="Digite seu Creci">
        </div>
        <input type="text" class="input-name" name="nome" placeholder="Digite seu nome">
        <button type="submit" value="Submit">Enviar</button>
      </form>
    </div>
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
          echo "<tr><td>".$row['cpf']."</td><td>".$row['cresci']."</td><td>".$row['nome']."</td><td>" . "<a href='index.php?delete_id=".$row['id']."'>Deletar</a></td><td> <a href='edit.php?id=".$row['id']."'>Editar</a></td></tr>";
        }
      ?>
    </table>
  </main>
</body>
</html>
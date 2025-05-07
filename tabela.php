<?php


$conn = new mysqli("127.0.0.1", "root", "", "omg");
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

$tabelasPermitidas = [
  "eletrica",
  "hidráulica",
  "mecânica",
  "refrigeração",
  "pintura",
  "gases_medicinais",
  "marcenaria",
  "sistema_de_tratamento_agua",
  "conservaçao_predial"
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tabela = $_POST['tabela'];
    $status = $_POST['estado'];
    $quantidade = $_POST['quantidade'];

    if (!in_array($tabela, $tabelasPermitidas)) {
        die("❌ Tabela inválida.");
    }

    $stmt = $conn->prepare("INSERT INTO `$tabela` (estado, quantidade) VALUES (?, ?)");
    $stmt->bind_param("si", $status, $quantidade);

    if ($stmt->execute()) {
        echo "<p style = color:green; >✅ Dados inseridos com sucesso na oficina <strong>$tabela</strong>!</p>";
    } else {
        echo "<p style = color:red;>❌ Falha ao inserir dados: </p>" . $stmt->error;
    }

    $stmt->close();
}

$conn->close();




?>

<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="tabela.css">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="shortcut icon" href="img/ar.png" type="image/x-icon">
</head>
<body>

<h1 style="font-size: 28px; font-weight: 700; color:rgb(37, 86, 136)">Arkmeds Dashboard</h1>

<form action="" method="post" class="oficinas">
<fieldset>
  <label for="Tabela" class="nome3">Escolha a oficina</label>
  <select name="tabela" id="tabela" required>
    <option value="eletrica">Elétrica</option>
    <option value="hidráulica">Hidráulica</option>
    <option value="mecânica">Mecânica</option>
    <option value="refrigeração">Refrigeração</option>
    <option value="pintura">Pintura</option>
    <option value="gases_medicinais">Gases Medicinais</option>
    <option value="sistema_de_tratamento_agua">Sistema de tratamento de água</option>
    <option value="marcenaria">Marcenaria</option>
    <option value="conservaçao_predial">Conservação predial</option>
  </select>



  <div class="informaçoes">
  <label for="estado" class="nome1">Status</label> <br><br>
  <input type="text" name="estado" required>
  </div>

  <div> 
  <label for="quantidade" class="nome2">Quantidade</label> <br><br>
  <input type="number" name="quantidade"  required>
  </div>

  <input type="submit" value="Enviar" id="butao">
  </fieldset>
</form>

<button class="btn-home" onclick="window.location.href='index.php'" >
    Home
  </button>

</body>
</html>

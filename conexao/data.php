<?php

 
$conn = new mysqli("127.0.0.1","root","","omg");
if($conn->connect_error){
    die("falha na conexão" . $conn->connect_error);
}



$tabelasPermitidas = [
"eletrica",
"hidráulica",
"mecânica",
"refrigeração",
"pintura",
"gases_medicinais"];

if($_SERVER['REQUEST_METHOD'] == 'POST'){

$tabelas = $_POST['tabela'];
$status = $_POST['estado'];
$quantidade = $_POST['quantidade'];

 }

 if (!in_array($tabela, $tabelasPermitidas)) {
    die("Tabela inválida.");
}


$stmt = $conn->prepare("INSERT INTO $tabela (estado,quantidade) VALUES (?,?)");
$stmt->bind_param("ss",$status,$quantidade);

if($stmt->execute()){
    echo "Dados inseridos na oficina $tabela";
}else{
    echo "Falha ao inserir dados: " . $stmt->error;
}

 ?>
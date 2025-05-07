<?php
header('Content-Type: application/json');

$conn = new mysqli("127.0.0.1", "root", "", "omg");
if ($conn->connect_error) {
    echo json_encode(['error' => "Falha na conexão: " . $conn->connect_error]);
    exit;
}

$semana = $_GET['semana'] ?? '';

if ($semana === '') {
    echo json_encode(['error' => 'Semana não especificada']);
    exit;
}

// Preparando a consulta SQL
$stmt = $conn->prepare("SELECT DISTINCT setor, estado, quantidade   FROM historico_semanal WHERE semana = ?");
if ($stmt === false) {
    echo json_encode(['error' => 'Erro ao preparar a consulta SQL: ' . $conn->error]);
    exit;
}

$stmt->bind_param("s", $semana);
$stmt->execute();
$res = $stmt->get_result();

$dados = [];
while ($row = $res->fetch_assoc()) {
    $dados[] = $row;
}

echo json_encode(['semana' => $semana, 'dados' => $dados]);

$stmt->close();
$conn->close();
?>



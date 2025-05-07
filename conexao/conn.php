<?php
header('Content-Type: application/json');

// Conexão com o banco de dados
$conn = new mysqli("127.0.0.1", "root", "", "omg");

if ($conn->connect_error) {
    echo json_encode(['error' => "Falha na conexão: " . $conn->connect_error]);
    exit;
}

$tabelas = ["eletrica", "hidráulica", "mecânica", "refrigeração", "pintura", "gases_medicinais","marcenaria","conservaçao_predial","sistema_de_tratamento_agua"];
$statusTotais = [];
$finalizadosPorSetor = [];

date_default_timezone_set('America/Sao_Paulo'); 
$dataReferencia = strtotime("2025-05-01"); 


$dataHoje = strtotime(date("Y-m-d")); 

$diasDeDiferenca = ($dataHoje - $dataReferencia) / (60 * 60 * 24); 
$semanaAtual = "semana_" . floor($diasDeDiferenca / 7) + 1;

foreach ($tabelas as $tabela) {
    $sql = "SELECT estado, SUM(quantidade) as quantidade FROM `$tabela` GROUP BY estado";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        $estado = $row['estado'];
        $quantidade = $row['quantidade'];
        $setor = $tabela;

        // Inserir dados no histórico semanal
        $conn->query("INSERT INTO historico_semanal (semana, setor, estado, quantidade, data_registro) 
                      VALUES ('$semanaAtual', '$setor', '$estado', $quantidade, '$dataHoje')");
    }
}

// Consulta de dados - Retorna os status totais e os finalizados por setor
// 1. Todos os status somados (piechart)
foreach ($tabelas as $tabela) {
    $sql = "SELECT estado AS status, SUM(quantidade) as quantidade FROM `$tabela` GROUP BY estado";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        $status = $row['status'];
        $quantidade = (int)$row['quantidade'];
        if (!isset($statusTotais[$status])) {
            $statusTotais[$status] = 0;
        }
        $statusTotais[$status] += $quantidade;
    }
}

// 2. Finalizados por setor (doughnut)
foreach ($tabelas as $tabela) {
    $res = $conn->query("SELECT  COUNT(*) as quantidade FROM `$tabela` WHERE estado = 'finalizado'");
    $quantidade = $res->fetch_assoc()['quantidade'] ?? 0;
    if ($quantidade > 0) {
        $finalizadosPorSetor[] = [
            'status' => ucfirst($tabela),
            'quantidade' => (int)$quantidade
        ];
    }
}

// Resposta JSON
echo json_encode([
    'todos' => array_map(fn($k, $v) => ['estado' => $k, 'quantidade' => $v], array_keys($statusTotais), $statusTotais),
    'finalizados' => $finalizadosPorSetor,
]);

$conn->close();
?>

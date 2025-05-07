 <?php
$conn = new mysqli("127.0.0.1", "root", "", "omg");

// Verificar se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


$semanaAtual = floor((strtotime("now") - strtotime("2025-01-01")) / (60 * 60 * 24 * 7)) + 1;
$semanaFormatada = "semana_" . $semanaAtual;
echo "Semana atual: $semanaFormatada"; 

// Pega os dados de setores e quantidades e registra conforme a semana
$tabelas = ["eletrica", "hidráulica", "mecânica", "refrigeração", "pintura", "gases_medicinais","sistema_de_tratamento_agua","marcenaria","conservaçao_predial"];
$dataHoje = date("Y-m-d");

foreach ($tabelas as $tabela) {
    $sql = "SELECT estado, SUM(quantidade) as quantidade FROM `$tabela` GROUP BY estado";
    $res = $conn->query($sql);
    while ($row = $res->fetch_assoc()) {
        $estado = $row['estado'];
        $quantidade = $row['quantidade'];
        $setor = $tabela;

        // Insere os dados na tabela de histórico semanal com a semana formatada
        $conn->query("INSERT INTO historico_semanal (semana, setor, estado, quantidade, data_registro) 
                      VALUES ('$semanaFormatada', '$setor', '$estado', $quantidade, '$dataHoje')");
    }
}

echo "Dados da semana $semanaFormatada registrados com sucesso.";
?>

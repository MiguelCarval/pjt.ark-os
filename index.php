<?php
include_once('templates/header.php');
include_once('helps/url.php');

// Conexão com o banco de dados
$conn = new mysqli("127.0.0.1", "root", "", "omg");

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Pega as semanas disponíveis no banco de dados para preencher o seletor
$sql = "SELECT DISTINCT semana FROM historico_semanal ORDER BY semana DESC";
$result = $conn->query($sql);

$semanas = [];
while ($row = $result->fetch_assoc()) {
    $semanas[] = $row['semana'];
}
?>

<main class="main">
    <div class="topbar">
        <h1 style="font-size: 28px; font-weight: 700; color:rgb(37, 86, 136)">Ark-OS Dashboard</h1>
        <div class="filters">
            <div><a href="<?= $BASE_URL ?>">Home</a></div>
            <div><a href="<?= $BASE_URL ?>\tabela.php">Inserir Dados</a></div>
        </div>
    </div>



    

    <div class="charts">
        <div class="graph">
            <div>
                <h2>Índice de Desempenho</h2>
                <div id="donutchart" style="width: 100%; height: 450px;"></div>
            </div>
        </div>

        <div class="summary">
            <h2>Ordens de Serviços</h2>
            <div id="piechart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <div class="section">
        <div class="graph">
            <select id="semanas" onchange="carregarSemana()">
                <!-- Preenchendo as semanas disponíveis dinamicamente -->
                <?php foreach ($semanas as $semana): ?>
                    <option value="<?= $semana ?>"><?= $semana ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <h4 style="transform: translateY(30px); color:rgb(32, 70, 107)">Escolha a semana desejada para alimentar o gráfico</h4>
            <img  style="width: 150px; transform:translateY(90px) translateX(20px)" src="img/ar.png" alt="icon">
        </div>

        <div class="graph">
            <h3 id="ordem">Ordens de Serviços por Mês</h3>
            <div id="chart_div" style="height: 400px; width: 1500px; "></div>
        </div>
    </div>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', { packages: ['corechart', 'line'] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
    const semana = document.getElementById('semanas').value;

    fetch(`semanal.php?semana=${semana}`)
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.error(data.error);
                return;
            }

            console.log("DADOS RECEBIDOS:", data);

            // Preparar os dados para o gráfico
            const chartData = [['Estado']]; // Primeira linha será para o eixo X (Estados ou outro critério)

            // Obter todos os setores únicos da resposta
            const setores = [...new Set(data.dados.map(item => item.setor))];

            // Adicionar os setores como colunas no gráfico
            setores.forEach(setor => {
                chartData[0].push(setor);  // Coloca os setores como cabeçalhos das colunas
            });

            // Organizar os dados por 'estado' (ou outro critério)
            const estados = [...new Set(data.dados.map(item => item.estado))];

            // Preencher os dados para cada 'estado'
            estados.forEach(estado => {
                let row = [estado]; // Linha começa com o nome do 'estado'

                // Para cada setor, somar as quantidades
                setores.forEach(setor => {
                    const quantidade = data.dados
                        .filter(item => item.estado === estado && item.setor === setor)
                        .reduce((sum, item) => sum + parseInt(item.quantidade), 0);
                    row.push(quantidade);
                });

                // Adicionar a linha de dados para o gráfico
                chartData.push(row);
            });

            // Criar a tabela de dados para o gráfico
            const dataTable = google.visualization.arrayToDataTable(chartData);

            // Definir as opções do gráfico
            const options = {
                hAxis: {
                    title: 'Estado'  // Ou 'Dia', ou 'Semana', conforme o caso
                },
                vAxis: {
                    title: 'Quantidade',
                    ticks: [0, 100,200,300,400,500, 600, 700,800,900,1000,1100,1200],  // Ajustando os ticks para mais equilíbrio
                    viewWindow: {
                        min: 0,  // Garante que o valor mínimo do eixo Y seja 0
                        max: 1200  // Ajusta o valor máximo do eixo Y conforme a necessidade dos dados
                    }
                },
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            // Criar o gráfico de linha
            const chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(dataTable, options);
        })
        .catch(error => {
            console.error("Erro ao buscar dados da semana:", error);
        });
}
document.getElementById('semanas').addEventListener('change', drawChart);

</script>
</main>



<?php

include_once('helps/url.php');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arkmeds</title>
    <link rel="shortcut icon" href="img/ar.png" type="image/x-icon">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
google.charts.load('current', { packages: ['corechart'] });

function drawCharts() {
    $.getJSON('conexao/conn.php', function(response) {
        if (response.error) {
            console.error(response.error);
            return;
        }

        const dataPizza = [['Status', 'Quantidade']];
        response.todos.forEach(item => {
        dataPizza.push([item.estado, parseInt(item.quantidade)]);
    });

        const options = {
        legend: { position: 'right' },
        pieSliceText: 'percentage',
       tooltip: { text: 'both' },
       colors: ['#0000FF', '#00BFFF', '#4682B4', '#6A5ACD', '#191970']
        };

const chart = new google.visualization.PieChart(document.getElementById('piechart'));
chart.draw(google.visualization.arrayToDataTable(dataPizza), options);


        // Gráfico Doughnut (finalizados por setor)
        const dataDonut = [['Setor', 'Quantidade']];
        response.finalizados.forEach(item => {
            dataDonut.push([item.status, parseInt(item.quantidade)]);
        });
        const chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart2.draw(google.visualization.arrayToDataTable(dataDonut), {
            title: '',
            pieHole: 0.4,
            colors: ['#228B22','#32CD32','#6B8E23','#556B2F','#8FBC8F']
        });

        // Gráfico Linha
        const dataLine = google.visualization.arrayToDataTable(response.semanal);
        const chart3 = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart3.draw(dataLine, {
            title: 'Chamados por Semana',
            curveType: 'function',
            legend: { position: 'bottom' }
        });
    });
}



google.charts.setOnLoadCallback(drawCharts);
</script>

    <link rel="stylesheet" href="<?= $BASE_URL?>css/sty.css">
</head>
<body>


   
</body>
</html>

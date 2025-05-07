
google.charts.load('current', { packages: ['corechart'] });
google.charts.setOnLoadCallback(fetchDataAndDrawCharts);

function fetchDataAndDrawCharts() {
    $.getJSON('dados_graficos.php', function(response) {
        if (response.error) {
            console.error(response.error);
            return;
        }

        // Processar dados para gráfico pizza (todos os status)
        const dataPizza = [['Status', 'Quantidade']];
        response.todos.forEach(item => {
            dataPizza.push([item.status, parseInt(item.quantidade)]);
        });

        const chart1 = new google.visualization.PieChart(document.getElementById('piechart'));
        chart1.draw(google.visualization.arrayToDataTable(dataPizza), {
            title: 'Todos os Status',
        });

        // Processar dados para gráfico doughnut (somente pendentes)
        const dataDonut = [['Status', 'Quantidade']];
        response.pendentes.forEach(item => {
            dataDonut.push([item.status, parseInt(item.quantidade)]);
        });

        const chart2 = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart2.draw(google.visualization.arrayToDataTable(dataDonut), {
            title: 'Somente Pendentes',
            pieHole: 0.4,
        });
    });
}

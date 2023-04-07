<div class="content">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <div class="titulo" style="display: flex; justify-content: space-between; align-items: center;">


        <h4>Dashboard</h4>
        <h5>Olá, <b>
                <?php echo $nome ?>
            </b> seja bem vindo!!</h5>


    </div>

    <div class='corpo'>

        <canvas id="graficoPedidos"></canvas>

    </div>
</div>

<style>
    #graficoPedidos {
        margin-left: 20%;
    }
</style>

<script>

    function gerarGraficoPedidos(pedidos) {
        // Transforma os dados dos pedidos em um formato adequado para o Chart.js
        var dados = {
            labels: ['Em andamento', 'Pendente', 'Concluído'],
            datasets: [{
                data: [pedidos.emAndamento, pedidos.pendente, pedidos.concluido],
                backgroundColor: ['#ffcd56', '#ff0000', '#48d800']
            }]
        };

        // Cria o gráfico utilizando o Chart.js
        var ctx = $('#graficoPedidos');
        var grafico = new Chart(ctx, {
            type: 'bar',
            data: dados,
            options: {
                legend: { display: false },
           
            }
        });
    }

</script>

<script>

    var quantidades = <?php echo json_encode($status); ?>

    var pedidos = {
        emAndamento: quantidades.find(obj => obj.status_pedido === "1")?.quantidade || 0,
        pendente: quantidades.find(obj => obj.status_pedido === "2")?.quantidade || 0,
        concluido: quantidades.find(obj => obj.status_pedido === "3")?.quantidade || 0
    };
    gerarGraficoPedidos(pedidos);
</script>
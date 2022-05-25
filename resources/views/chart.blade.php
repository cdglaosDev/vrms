<!doctype html>
<html>
  <head>
  <title>Bar Chart</title>
  
  <style>
  canvas {
    -moz-user-select: none;
    -webkit-user-select: none;
    -ms-user-select: none;
  }
  </style>
  </head>
  <body>
    <div id="container" style="width: 75%;">
    <canvas id="canvas"></canvas>
    </div>
    <script src="http://www.chartjs.org/dist/2.7.3/Chart.bundle.js"></script>
  <script src="http://www.chartjs.org/samples/latest/utils.js"></script>
    <script>
    var chartdata = {
    type: 'bar',
    data: {
    labels: <?php echo json_encode($Months); ?>,
    // labels: month,
    datasets: [
    {
    label: 'User lists',
    backgroundColor: '#26B99A',
    borderWidth: 1,
    data: <?php echo json_encode($Data); ?>
    }
    ]
    },
    options: {
    scales: {
    yAxes: [{
    ticks: {
    beginAtZero:true
    }
    }]
    }
    }
    }
    console.log(chartdata);
    var ctx = document.getElementById('canvas').getContext('2d');
    new Chart(ctx, chartdata);
    </script>
  </body>
</html>
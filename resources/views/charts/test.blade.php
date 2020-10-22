<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
</head>
<body>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <canvas id="myLine" width="1200" height="400"></canvas>
            </div>
            <div>
                <div class="form-check">
                    <input type="checkbox" class="myCheck-input" id="myCheck">
                    <label class="form-check-label" for="exampleCheck1">1. Gerät test</label>
                </div>
                <br>
                <br>
                <a class="btn btn-primary" href="{{ url('chart/input') }}" role="button">Change Date</a>

            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>
    Chart.pluginService.register({
        // This works to coor th backgournd
        beforeDraw: function (chart, easing) {
            if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
                var ctx = chart.chart.ctx;
                var chartArea = chart.chartArea;
                var meta = chart.getDatasetMeta(0);
                var start = meta.data[25]._model.x;
                var stop  = meta.data[keys.length-1]._model.x;
                console.log (start,stop);
                ctx.save();
                ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
                console.log (chartArea);
                ctx.fillRect(start, chartArea.top, stop - start, chartArea.bottom - chartArea.top);
                ctx.restore();
            }
        }
    });
    var ctx = document.getElementById("myLine").getContext('2d');
    var keys = {!! json_encode($keys) !!};
    var price = {!! json_encode($values) !!};
    var test = Array(keys.length).fill(0.02);
    input = {
        type: 'line',
        data: {
            labels: keys ,
            datasets: [{
                data: price,
                label: "Dataset 1",
                borderColor: "#3e95cd",
                fill: false,
                hidden: false
            },{
                data: test,
                label: "test",
                borderColor: "#cd1f28",
                fill: false,
                hidden: true
            }
            ]
        },
        options: {
            responsive:true,
            animation : false,
            bezierCurve : true,
            chartArea: {
                backgroundColor: 'rgba(251, 85, 85, 0.4)'
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:false
                    }
                }]
            },
        }
    }

    var myLine = new Chart(ctx, input);
    var x = document.getElementById("myCheck");
    x.addEventListener('change', function () {
        console.log(x.value);
        console.log(myLine.data.datasets[1].hidden);
        if(myLine.data.datasets[1].hidden === true){
            myLine.data.datasets[1].hidden = false;
        } else{
            myLine.data.datasets[1].hidden = true
        }
        console.log(myLine.data.datasets[1].hidden);
        myLine.update();
    });
</script>
</body>
</html>

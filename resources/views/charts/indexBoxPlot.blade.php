<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <!-- Fonts -->
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" type="text/css">
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/css/bootstrap-select.min.css">
</head>
<body>
<div id="app">
    @include('layouts.partials._navigation')
    <div class="container-fluid">
        @include('layouts.partials.alerts._alerts')
        <div class="row">
            <nav id="sidebarMenu" class="col-md-2 col-lg-2 d-md-block collapse">
                <div class="sidebar-sticky pt-3">
                    @include('account.layouts.partials._navigation')
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Box-Plot</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">

                    </div>
                </div>

                <div class="panel-body">
                    <canvas id="canvas" width="1200" height="400"></canvas>
                </div>


                <div>
                    <br>
                    <br>
                    <a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="{{ url('chart/boxplot/input') }}" role="button">
                        <span data-feather="calendar"></span>
                        Change Date</a>
                </div>
            </main>
        </div>
        @include('layouts.footer')
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.3/js/bootstrap-select.min.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

<script src="https://unpkg.com/chart.js@2.9.1"></script>
<script src="https://unpkg.com/@sgratzl/chartjs-chart-boxplot"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

<script>
    feather.replace();


    var data = {!! json_encode($data) !!};


    const pda = [];
    const pid = [];

    Object.keys(data.pda).map(function (month) {
        pda.push(Object.values(data.pda[month]));
        pid.push(Object.values(data.pid[month]));
    });

    console.log(pda);
    const boxplotData = {
        // define label tree
        labels: Object.keys(data.pda),
        datasets: [{
            label: 'Prices Day Ahead',
            backgroundColor: 'rgba(255,0,0,0.5)',
            borderColor: 'red',
            borderWidth: 1,
            outlierColor: '#999999',
            padding: 10,
            itemRadius: 0,
            data: pda
        }, {
            label: 'Prices Interday',
            backgroundColor:  'rgba(0,0,255,0.5)',
            borderColor: 'blue',
            borderWidth: 1,
            outlierColor: '#999999',
            padding: 10,
            itemRadius: 0,
            data: pid
        }]
    };
    window.onload = () => {
        const ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'boxplot',
            data: boxplotData,
            options: {
                responsive: true,
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Box Plot Chart'
                }
            }
        });

    };
</script>
</body>
</html>

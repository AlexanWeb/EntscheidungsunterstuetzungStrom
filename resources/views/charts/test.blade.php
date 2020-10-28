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
                        <h1 class="h2">Dashboard</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                            </div>
                            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                                <span data-feather="calendar"></span>
                                This week
                            </button>
                        </div>
                    </div>

                    <div class="panel-body">
                        <canvas id="myLine" width="1200" height="400"></canvas>
                    </div>

                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                        <h1 class="h2">Optional</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group-power mr-2">

                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                        <br>
                        <a class="btn btn-primary" href="{{ url('chart/input') }}" role="button">Change Date</a>
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>

<script>

    feather.replace()




    ////// GET RANDOM COLOR /////////

    const hex = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, "A", "B", "C", "D", "E", "F"];

    function getRandomColor(){

        let hexColor = '#';

        for(let i = 0; i<6; i++){

            hexColor += hex[getRandomNumber()];
        }
        return hexColor;
    }

    function getRandomNumber() {
        return Math.floor(Math.random() * hex.length);
    }

    ///////////// END GET RANDOM COLOR //////////////////





/////////// Beginn split the chart in two colors Past and Future  ////////////////
    Chart.pluginService.register({
        // This works to coor th backgournd
        beforeDraw: function (chart, easing) {
            // if today is between the start and end day
            if (today >= start_date && today < end_date) {
                if (chart.config.options.chartArea && chart.config.options.chartArea.backgroundColor) {
                    var ctx = chart.chart.ctx;
                    var chartArea = chart.chartArea;
                    var meta = chart.getDatasetMeta(0);
                    var start = meta.data[(getDifferenceDays(start_date, today) * 24)]._model.x;
                    var stop = meta.data[keys.length - 1]._model.x;
                    console.log(start, stop);
                    ctx.save();
                    ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
                    console.log(chartArea);
                    ctx.fillRect(start, chartArea.top, stop - start, chartArea.bottom - chartArea.top);
                    ctx.restore();
                }
            }
        }
    });


    ///////////  ENDE split the chart in two colors Past and Future  ////////////////

    var ctx = document.getElementById("myLine").getContext('2d');
    var keys = {!! json_encode($keys) !!};
    var price = {!! json_encode($values) !!};
    var powerplants =  {!! auth()->user()->powerplants->toJson() !!} ;
    var start_date =  new Date("{!! $start_date !!}") ;
    var end_date =  new Date("{!! $end_date !!}") ;
    var today =  new Date("{!! $today !!}")  ;

    console.log("yes" + getDifferenceDays (start_date, today));



    //////////// BEGINN calculat the diffrent between tow days ////////////

    function getDifferenceDays (d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2-t1)/(24*3600*1000));
    }

    //////////// BEGINN calculat the diffrent between tow days ////////////




    ///////// BEGGINN  Creat Checkboxfür Chart //////////////

    const container = document.querySelector('.btn-group-power');
    displayMenuButtons();
    function displayMenuButtons(){
        const names = powerplants.reduce(function (values, item){
            if(!values.includes(item.name)){
                values.push(item.name);
            }
            return values;
        },['all']);

        const namesBtns = names.map(function(name){

            return `<button type="button" class="btn btn-sm btn-outline-secondary" data-id=${name} value= false>${name}</button>`
        }).join("");

        container.innerHTML = namesBtns;
        const filterBtns = container.querySelectorAll('.btn-outline-secondary');
        // filter items
        filterBtns.forEach(function(btn){
            btn.addEventListener('click', function(e){

                //console.log(e.currentTarget.dataset.id);
                const id = e.currentTarget.dataset.id;

                const name = e.currentTarget.textContent;

                if(name === 'all'){

                    if(e.currentTarget.value === "false"){

                        e.currentTarget.style.background= "#4CAF50";
                        e.currentTarget.value = true;
                        datas.forEach(function(menuitem){
                            menuitem.hidden = false;

                        });
                    }
                    else{
                        e.currentTarget.style.background = "";
                        e.currentTarget.value = false;
                        datas.forEach(function(menuitem){
                            menuitem.hidden = true;
                        });
                    }

                }else{

                    datas.forEach(function(menuitem){
                        // console.log(menuItem.category);
                        if(menuitem.label === name){
                            if(menuitem.hidden === true){
                                menuitem.hidden = false;
                                e.currentTarget.style.background= "#4CAF50";
                                e.currentTarget.value = true;
                            } else{
                                menuitem.hidden = true;
                                e.currentTarget.style.background = "";
                                e.currentTarget.value = false;
                            }
                        }

                    });
                }
                myLine.update();
            });
        });
    };

    ///////// ENDE  Creat Checkboxfür Chart //////////////




    ///////// BEGGINN  vorbereitung Dataset für Chart //////////////
    const datas = powerplants.reduce(function (values, item){
        values.push({data: Array(keys.length).fill(item.marginal_cost),
            label: item.name,
            fillColor: 'rgba(220,220,220,0.2)',
            strokeColor: 'rgba(220,220,220,1)',
            pointColor: 'rgba(220,220,220,1)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointHighlightStroke:
                'rgba(220,220,220,1)',
            borderColor: getRandomColor(),
            fill: false,
            hidden: true

        });

        return values;
    },[{
        data: price,
        label: "Dataset 1",
        fillColor: 'rgba(220,220,220,0.2)',
        strokeColor: 'rgba(220,220,220,1)',
        pointColor: 'rgba(220,220,220,1)',
        pointStrokeColor: '#fff',
        pointHighlightFill: '#fff',
        pointHighlightStroke:
            'rgba(220,220,220,1)',
        borderColor: getRandomColor(),
        fill: false,
        hidden: false
    }]);

    ///////// ENDE  vorbereitung Dataset für Chart //////////////





    ///////// BEGINN creat the INPUT Dataset für Chart //////////////

    input = {
        type: 'line',
        data: {
            labels: keys ,
            datasets: datas
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


    ///////// ENDE creat the INPUT Dataset für Chart //////////////





    ///////// BEGINN creat the Chart //////////////

    var myLine = new Chart(ctx, input);


    ///////// ENDE creat the Chart //////////////



</script>
</body>
</html>

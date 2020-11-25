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
                        <h1 class="h2">Chart</h1>
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group mr-2">
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                        onclick="resetZoom()">Rest Zoom</button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="drag-switch"
                                        onclick="toggleDragMode()" >Disable drag mode</button>
                            </div>

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
                        <div class="btn-toolbar mb-2 mb-md-0">
                            <div class="btn-group-marketValue mr-2">

                            </div>
                        </div>
                    </div>
                    <div>
                        <br>
                        <br>
                        <a class="btn btn-sm btn-outline-secondary dropdown-toggle" href="{{ url('chart/input') }}" role="button">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>


    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3"></script>
    <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@0.7.7"></script>

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
                    var start = meta.data[(getDifferenceDays(start_date, today) * labelForDay)]._model.x;
                    var stop = meta.data[keys.length - 1]._model.x;
                    // console.log(start, stop);
                    ctx.save();
                    ctx.fillStyle = chart.config.options.chartArea.backgroundColor;
                    // console.log(chartArea);
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



    //// array of months //////
    const monthNames = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    /// save the days and months for the start day and end day //////

    var start_date =  new Date("{!! $start_date !!}") ;
    var end_date =  new Date("{!! $end_date !!}") ;
    var today =  new Date("{!! $start_pred !!}");

    var start_month = monthNames[start_date.getMonth()]; // month of start day

    var marketValues = {!! json_encode($marketValues) !!};


    ///// start creat data for market values //////////

    var start_month = monthNames[start_date.getMonth()]; // month of start day


    var lastDayOfMonth = new Date(start_date.getFullYear(), start_date.getMonth()+1, 0);

    var daysOfthefirst = new Date(start_date - 1);


    /// get array of date between start day and end day
    Date.prototype.addDays = function(days) {
        var date = new Date(this.valueOf());
        date.setDate(date.getDate() + days);
        return date;
    }

    function getDates(startDate, stopDate) {
        var dateArray = new Array();
        var currentDate = startDate;
        while (currentDate <= stopDate) {
            dateArray.push(new Date (currentDate));
            currentDate = currentDate.addDays(1);
        }
        return dateArray;
    }

    days = getDates(start_date, end_date); // the array of dates


    const differncSD_ED = getDifferenceDays(start_date, end_date)+1;
    const labelForDay = ((keys.length / differncSD_ED));


    // add values to array for MW_EPEX
    const MW_EPEX = [];

    days.map(function(item){

        for (i = 0; i <labelForDay; i++) {
            MW_EPEX.push((marketValues.MW_EPEX[monthNames[item.getMonth()]]/100).toFixed(4));
        }
    });


    // add values to array for MW_EPEX
    const MW_Wind_Onshore = [];

    days.map(function(item){

        for (i = 0; i <labelForDay; i++) {
            MW_Wind_Onshore.push((marketValues.MW_Wind_Onshore[monthNames[item.getMonth()]]/100).toFixed(4));
        }
    });


    // add values to array for MW_EPEX
    const MW_Wind_Offshore = [];

    days.map(function(item){

        for (i = 0; i <labelForDay; i++) {
            MW_Wind_Offshore.push((marketValues.MW_Wind_Offshore[monthNames[item.getMonth()]]/100).toFixed(4));
        }
    });

    // add values to array for MW_EPEX
    const MW_Solar = [];
    days.map(function(item){

        for (i = 0; i <labelForDay; i++) {
            MW_Solar.push((marketValues.MW_Solar[monthNames[item.getMonth()]]/100).toFixed(4));
        }
    });

    const marketValuesresult = [];
    marketValuesresult['MW_EPEX']= MW_EPEX;
    marketValuesresult['MW_Wind_Onshore']= MW_Wind_Onshore;
    marketValuesresult['MW_Wind_Offshore']= MW_Wind_Offshore;
    marketValuesresult['MW_Solar']= MW_Solar;


    ///// End creat data for market values //////////



    //////////// BEGINN calculat the diffrent between tow days ////////////

    function getDifferenceDays (d1, d2) {
        var t2 = d2.getTime();
        var t1 = d1.getTime();

        return parseInt((t2-t1)/(24*3600*1000));
    }

    //////////// BEGINN calculat the diffrent between tow days ////////////




    ///////// BEGGINN  Creat Checkbox of Power plants für Chart //////////////

    const container_power = document.querySelector('.btn-group-power');
    displayListeButtons();
    function displayListeButtons(){
        const names = powerplants.reduce(function (values, item){
            if(!values.includes(item.name)){
                values.push(item.name);
            }
            return values;
        },['all']);

        const namesBtns = names.map(function(name){

            return `<button type="button" class="btn btn-sm btn-outline-secondary" data-id=${name} value= false>${name}</button>`
        }).join("");

        container_power.innerHTML = namesBtns;
        const filterBtns = container_power.querySelectorAll('.btn-outline-secondary');
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
                        datas.forEach(function(item){
                            if(names.includes(item.label)){
                                item.hidden = false;
                            }
                        });
                    }
                    else{
                        e.currentTarget.style.background = "";
                        e.currentTarget.value = false;
                        datas.forEach(function(item){
                            if(names.includes(item.label)){
                                item.hidden = true;
                            }
                        });
                    }

                }else{

                    datas.forEach(function(item){
                        // console.log(item.category);
                        if(item.label === name){
                            if(item.hidden === true){
                                item.hidden = false;
                                e.currentTarget.style.background= "#4CAF50";
                                e.currentTarget.value = true;
                            } else{
                                item.hidden = true;
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



    ///////// BEGGINN  Creat Checkbox of  Market values for  Chart //////////////

    const container_marketValue = document.querySelector('.btn-group-marketValue');
    displayListeButtonsOfMarketValues();
    function displayListeButtonsOfMarketValues(){
        const names = Object.keys(marketValues).reduce(function (values, item){
            if(!values.includes(item)){
                values.push(item);
            }
            return values;
        },['all']);

        const namesBtns = names.map(function(name){

            return `<button type="button" class="btn btn-sm btn-outline-secondary" data-id=${name} value= false>${name}</button>`
        }).join("");

        container_marketValue.innerHTML = namesBtns;
        const filterBtns = container_marketValue.querySelectorAll('.btn-outline-secondary');
        // filter items
        filterBtns.forEach(function(btn){
            btn.addEventListener('click', function(e){

                const id = e.currentTarget.dataset.id;

                const name = e.currentTarget.textContent;

                if(name === 'all' ){   // if futten all test nur jetzt

                    if(e.currentTarget.value === "false"){

                        e.currentTarget.style.background= "#4CAF50";
                        e.currentTarget.value = true;
                        datas.forEach(function(item){

                            if(Object.keys(marketValues).includes(item.label)){
                                item.hidden = false;
                            }

                        });
                    }
                    else{
                        e.currentTarget.style.background = "";
                        e.currentTarget.value = false;
                        datas.forEach(function(item){
                            if(Object.keys(marketValues).includes(item.label)){
                                item.hidden = true;
                            }
                        });
                    }

                }else{

                    datas.forEach(function(item){
                        // console.log(menuItem.category);
                        if(item.label === name){
                            if(item.hidden === true){
                                item.hidden = false;
                                e.currentTarget.style.background= "#4CAF50";
                                e.currentTarget.value = true;
                            } else{
                                item.hidden = true;
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

    ///////// ENDE  Creat Checkbox of Market values für Chart //////////////




    ///////// BEGGINN  vorbereitung Dataset von Kraw für Chart //////////////
    const data_power = powerplants.reduce(function (values, item){ // fügen die Dataset von KA für Array hinzu //
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
        label: "Price",
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

    ////////// add dataset of Market values to datas ///////////

    // marketValuesresult

    // Array(keys.length).fill((item.value/100).toFixed(4))
    const datas = Object.keys(marketValues).reduce(function (values, item){
        values.push({data: marketValuesresult[item],
            label: item,
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
    },data_power);


    ///////// ENDE  vorbereitung Dataset für Chart //////////////


    ///////// BEGINN creat the INPUT Dataset für Chart //////////////

    var dragOptions = {
        animationDuration: 1000
    };


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
                backgroundColor: 'rgba(255,5,37,0.4)'
            },
            scales: {
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "price"
                    },
                    ticks: {
                        beginAtZero:false
                    }
                }],
                xAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Date"
                    },
                    ticks: {
                        autoSkip: true,
                        maxTicksLimit: 20
                    }
                }]
            },
        plugins: {
            zoom: {
                // Container for pan options
                pan: {
                    // Boolean to enable panning
                    enabled: true,
                    drag: dragOptions,
                    // Panning directions. Remove the appropriate direction to disable
                    // Eg. 'y' would only allow panning in the y direction
                    mode: 'xy',

                    speed: 0.05

                },

                // Container for zoom options
                zoom: {
                    // Boolean to enable zooming
                    enabled: true,

                    // Zooming directions. Remove the appropriate direction to disable
                    // Eg. 'y' would only allow zooming in the y direction
                    mode: 'xy',
                }
            }
        }
        }
    }


    ///////// ENDE creat the INPUT Dataset für Chart //////////////





    ///////// BEGINN creat the Chart //////////////

    var myLine = new Chart(ctx, input);


    ///////// ENDE creat the Chart //////////////



    ////// BEGINN RestZoom Button ////////
    function resetZoom() {
        window.myLine.resetZoom();
    }
    ////// Ende RestZoom Button ////////


    ////// BEGINN Diesblay Zoom Button ////////

    window.toggleDragMode = function() {
        var chart = window.myLine;
        var zoomOptions = chart.options.plugins.zoom.zoom;
        zoomOptions.drag = zoomOptions.drag ? false : dragOptions;

        chart.update();
        document.getElementById('drag-switch').innerText = zoomOptions.drag ? 'Disable drag mode' : 'Enable drag mode';
    };

    ////// BEGINN Diesblay Zoom Button ////////

</script>
</body>
</html>

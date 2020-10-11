<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>


<body>


<div id="app">
    @include('layouts.partials._navigation')
    <div class="container">
        <main class="py-4">
            @include('layouts.partials.alerts._alerts')
            <div class="container">
                <div class="card">
                    <h5 class="card-header">Details</h5>
                    <div class="card-body">
                        <form class="form-horizontal" method="GET" action="{{ route('getDetails') }}" >
                            {{ csrf_field() }}
                            <div class="card">
                                <div class="card-header">
                                    <h6>Type of sale</h6>
                                </div>
                                <div class="card-body">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="form-check-input" type="radio" name="type_sale" id="type_sale1" value="day_Ahead" checked>
                                        <label class="form-check-label" for="type_sale1">
                                            Day-Ahead Auction
                                        </label>
                                    </div>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input class="form-check-input" type="radio" name="type_sale" id="type_sale2" value="intraday">
                                        <label class="form-check-label" for="type_sale2">
                                            Intraday Auction
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <br>
                            <div class="card row">
                                <div class="card-header">
                                    <h6>Date</h6>
                                </div>
                                <div class="card-body">
                                    <div class="card-group">
                                            <div class="card " style="width: 18rem;">
                                                <div class="card-header">
                                                    <h7>Start day</h7>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <input class="date form-control" type="text" name="start_day" id="start">
                                                    </div>
                                                </div>
                                            </div><div class="card" style="width: 18rem;">
                                                <div class="card-header">
                                                    <h7>End day</h7>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <input class="date form-control" type="text" name="end_day" id="end_day">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card" style="width: 18rem;">
                                                <div class="card-header">
                                                    <h7>Today</h7>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group">
                                                        <input class="date form-control" type="text" name="today" id="today">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-check"></i>
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('layouts.footer')
</div>
<script src="{{asset('js/bootstrap.js')}}"></script>
@yield('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

</body>
</html>


<script type="text/javascript">
    $('.date').datepicker({
        format: 'dd-mm-yyyy'
    });
</script>

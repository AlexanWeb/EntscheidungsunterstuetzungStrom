@extends('account.layouts.default')

@section('account.content')

    @admin
    <div class="card">
        <h5 class="card-header">
            <span data-feather="calendar"></span>
            Today</h5>
        <div class="card-body">
            <form action="{{route('home')}}" method="GET">
                {{csrf_field()}}
                <label for="date_example" class="control-label">Today</label>
                <input type="date" name="date_example" id="date_example" class="form-control"
                       min="2020-01-01" max="2020-07-15">

                <button type="submit"class="btn btn-primary mt-1">Update</button>
            </form>
        </div>
    </div>

    @endadmin
    <br>
    <div class="card">
        <h5 class="card-header">Angagen für Preise in MHw.</h5>
        <div class="card-body">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Uhrzeit
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dby['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbt['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbtm['Day']}}
                    </div>
                </div>

                <div class="row">
                    {{-- rgba to change background color --}}
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Maximum
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                          {{number_format($dby['Maximum'], 2)}} € um {{$hY[0]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Maximum'] - $dby['Maximum'], $dby['Maximum'])}}">
                        {{number_format($dbt['Maximum'], 2)}} € um {{$hY[1]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Maximum'] - $dbt['Maximum'], $dbt['Maximum'])}}">
                        {{number_format($dbtm['Maximum'], 2)}} € um {{$hY[2]}}
                    </div>
                </div>

                @for($i = 1; $i < 25; $i++)

                        <div class="row">
                            @if($i===3)
                                <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', 3600*($i-1)) }} - {{date('H:i', 3600*$i)}}</div>
                                <div class="col-sm-3 border-bottom border-top text-center" > {{number_format($dby['Hour_'.$i.'A'], 2)}} €</div>
                                <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Hour_'.$i.'A'] - $dby['Hour_'.$i.'A'], $dby['Hour_'.$i.'A'])}}"> {{ number_format($dbt['Hour_'.$i.'A'], 2)}} €</div>
                                <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Hour_'.$i.'A'] - $dbt['Hour_'.$i.'A'], $dbt['Hour_'.$i.'A'])}}"> {{number_format($dbtm['Hour_'.$i.'A'], 2)}} €</div>
                            @else
                                <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', 3600*($i-1)) }} - {{date('H:i', 3600*$i)}}</div>
                                <div class="col-sm-3 border-bottom border-top text-center" > {{number_format($dby['Hour_'.$i], 2)}} €</div>
                                <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Hour_'.$i] - $dby['Hour_'.$i], $dby['Hour_'.$i])}}"> {{ number_format($dbt['Hour_'.$i], 2)}} €</div>
                                <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Hour_'.$i] - $dbt['Hour_'.$i], $dbt['Hour_'.$i])}}"> {{number_format($dbtm['Hour_'.$i], 2)}} €</div>
                            @endif

                        </div>
                @endfor

            </div>
        </div>
    </div>

    <br>
    <div class="card">
        <h5 class="card-header">Angagen für Preise in MHw. Prices intera day</h5>
        <div class="card-body">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Uhrzeit
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dby_pid['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbt_pid['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbtm_pid['Day']}}
                    </div>
                </div>

                <div class="row">
                    {{-- rgba to change background color --}}
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Maximum
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{number_format($dby_pid['Maximum'], 2)}} € um {{$hY_pid[0]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Maximum'] - $dby['Maximum'], $dby['Maximum'])}}">
                        {{number_format($dbt_pid['Maximum'], 2)}} € um {{$hY_pid[1]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Maximum'] - $dbt['Maximum'], $dbt['Maximum'])}}">
                        {{number_format($dbtm_pid['Maximum'], 2)}} € um {{$hY_pid[2]}}
                    </div>
                </div>


                <div class="row">
                    {{-- rgba to change background color --}}
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Quarter
                    </div>

                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q1
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q2
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q3
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q4
                    </div>


                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q1
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q2
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q3
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q4
                    </div>


                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q1
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q2
                    </div>
                    <div class="col-md-6-25 border-bottom border-top text-center" >
                        Q3
                    </div>

                    <div class="col-md-6-25 border-bottom border-top text-center">
                        Q4
                    </div>

                </div>

                @for($i = 1; $i < 25; $i++)

                    <div class="row">
                        @if($i===3)
                            <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', 3600*($i-1)) }} - {{date('H:i', 3600*$i)}}</div>

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center" > {{number_format($dby_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>
                            @endfor

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt_pid['Hour_'.$i.'A_Q'.$j] - $dby_pid['Hour_'.$i.'A_Q'.$j], $dby_pid['Hour_'.$i.'A_Q'.$j])}}" > {{number_format($dbt_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>
                            @endfor

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center"
                                     style="background-color: {{bg_color_prices($dbtm_pid['Hour_'.$i.'A_Q'.$j] - $dbt_pid['Hour_'.$i.'A_Q'.$j], $dbt_pid['Hour_'.$i.'A_Q'.$j])}}" >
                                    {{number_format($dbtm_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>
                            @endfor


                        @else
                            <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', 3600*($i-1)) }} - {{date('H:i', 3600*$i)}}</div>
                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center" > {{number_format($dby_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>
                            @endfor

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt_pid['Hour_'.$i.'_Q'.$j] - $dby_pid['Hour_'.$i.'_Q'.$j], $dby_pid['Hour_'.$i.'_Q'.$j])}}"> {{number_format($dbt_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>
                            @endfor

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-md-6-25 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm_pid['Hour_'.$i.'_Q'.$j] - $dbt_pid['Hour_'.$i.'_Q'.$j], $dbt_pid['Hour_'.$i.'_Q'.$j])}}"> {{number_format($dbtm_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>
                            @endfor

                        @endif

                    </div>
                @endfor

            </div>
        </div>
    </div>


    <br>
    <div class="card">
        <h5 class="card-header">Angagen für Preise in MHw. Prices intera day</h5>
        <div class="card-body">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Uhrzeit
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dby_pid['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbt_pid['Day']}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{$dbtm_pid['Day']}}
                    </div>
                </div>

                <div class="row">
                    {{-- rgba to change background color --}}
                    <div class="col-sm-3 border-bottom border-top text-center">
                        Maximum
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center">
                        {{number_format($dby_pid['Maximum'], 2)}} € um {{$hY_pid[0]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Maximum'] - $dby['Maximum'], $dby['Maximum'])}}">
                        {{number_format($dbt_pid['Maximum'], 2)}} € um {{$hY_pid[1]}}
                    </div>
                    <div class="col-sm-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Maximum'] - $dbt['Maximum'], $dbt['Maximum'])}}">
                        {{number_format($dbtm_pid['Maximum'], 2)}} € um {{$hY_pid[2]}}
                    </div>
                </div>




                @for($i = 1; $i < 25; $i++)

                    <div class="row">
                        @if($i===3)

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', (3600*($i-1)+ 60*($j-1)*15)) }} - {{date('H:i', (3600*($i-1)+ 60*($j)*15))}}</div>

                                <div class="col-md-3 border-bottom border-top text-center" > {{number_format($dby_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>

                                <div class="col-md-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt_pid['Hour_'.$i.'A_Q'.$j] - $dby_pid['Hour_'.$i.'A_Q'.$j], $dby_pid['Hour_'.$i.'A_Q'.$j])}}" > {{number_format($dbt_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>

                                <div class="col-md-3 border-bottom border-top text-center"
                                     style="background-color: {{bg_color_prices($dbtm_pid['Hour_'.$i.'A_Q'.$j] - $dbt_pid['Hour_'.$i.'A_Q'.$j], $dbt_pid['Hour_'.$i.'A_Q'.$j])}}" >
                                    {{number_format($dbtm_pid['Hour_'.$i.'A_Q'.$j], 2)}} €</div>
                            @endfor


                        @else

                            @for($j = 1; $j < 5; $j++)
                                <div class="col-sm-3 border-bottom border-top text-center"> {{date('H:i', (3600*($i-1)+ 60*($j-1)*15)) }} - {{date('H:i', (3600*($i-1)+ 60*($j)*15))}}</div>

                                <div class="col-md-3 border-bottom border-top text-center" > {{number_format($dby_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>

                                <div class="col-md-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt_pid['Hour_'.$i.'_Q'.$j] - $dby_pid['Hour_'.$i.'_Q'.$j], $dby_pid['Hour_'.$i.'_Q'.$j])}}"> {{number_format($dbt_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>

                                <div class="col-md-3 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm_pid['Hour_'.$i.'_Q'.$j] - $dbt_pid['Hour_'.$i.'_Q'.$j], $dbt_pid['Hour_'.$i.'_Q'.$j])}}"> {{number_format($dbtm_pid['Hour_'.$i.'_Q'.$j], 2)}} €</div>
                            @endfor

                        @endif

                    </div>
                @endfor

            </div>
        </div>
    </div>


@endsection

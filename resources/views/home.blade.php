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
                <input type="date" name="date_example" id="date_example" class="form-control">

                <button type="submit"class="btn btn-primary mt-1">Update</button>
            </form>
        </div>
    </div>

    @endadmin
    <br>
    <div class="card">
        <h5 class="card-header">Angagen für Preise in MHw.</h5>
        <div class="card-body">

            <div class="container">

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

@endsection

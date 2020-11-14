@extends('layouts.app')

@section('content')

    @admin
    <form action="{{route('home')}}" method="GET">
        {{csrf_field()}}
        <label for="date_example" class="control-label">Today</label>
        <input type="date" name="date_example" id="date_example" class="form-control">

        <button type="submit"class="btn btn-primary mt-1">Update</button>
    </form>

    <div class="card-body">
        <form class="form-horizontal" method="GET" action="{{ route('home') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="card">
                <div class="card">
                    <div class="card-header">
                        <h4>CSV file to import</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                            <div class="custom-file">
                                <input id="file" type="file" class="custom-file-input" name="file" required>
                                <label class="custom-file-label" for="file">Choose file</label>

                                @if ($errors->has('file'))
                                    <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
                        </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="mt-1">
                        <button type="submit" class="btn btn-primary" name="submit"><i class="fa fa-check"></i>
                            Submit
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endadmin

    Angagen für Preise in MHw.
    <div class="container">

        <div class="row">
            <div class="col-sm-2 border-bottom border-top text-center">
                Uhrzeit
            </div>
            <div class="col-sm-2 border-bottom border-top text-center">
               {{$dby['Day']}}
            </div>
            <div class="col-sm-2 border-bottom border-top text-center">
               {{$dbt['Day']}}
            </div>
            <div class="col-sm-2 border-bottom border-top text-center">
                {{$dbtm['Day']}}
            </div>
        </div>

        <div class="row">
            {{-- rgba to change background color --}}
            <div class="col-sm-2 border-bottom border-top text-center">
                Maximum
            </div>
            <div class="col-sm-2 border-bottom border-top text-center">
                  {{number_format($dby['Maximum'], 2)}} € um {{$hY[0]}}
            </div>
            <div class="col-sm-2 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Maximum'] - $dby['Maximum'], $dby['Maximum'])}}">
                {{number_format($dbt['Maximum'], 2)}} € um {{$hY[1]}}
            </div>
            <div class="col-sm-2 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Maximum'] - $dbt['Maximum'], $dbt['Maximum'])}}">
                {{number_format($dbtm['Maximum'], 2)}} € um {{$hY[2]}}
            </div>
        </div>

        @for($i = 1; $i < 25; $i++)
            <div class="row">
                <div class="col-sm-2 border-bottom border-top text-center"> {{date('H:i', 3600*($i-1)) }} - {{date('H:i', 3600*$i)}}</div>
                <div class="col-sm-2 border-bottom border-top text-center" > {{number_format($dby['Hour_'.$i], 2)}} €</div>
                <div class="col-sm-2 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbt['Hour_'.$i] - $dby['Hour_'.$i], $dby['Hour_'.$i])}}"> {{ number_format($dbt['Hour_'.$i], 2)}} €</div>
                <div class="col-sm-2 border-bottom border-top text-center" style="background-color: {{bg_color_prices($dbtm['Hour_'.$i] - $dbt['Hour_'.$i], $dbt['Hour_'.$i])}}"> {{number_format($dbtm['Hour_'.$i], 2)}} €</div>
            </div>
        @endfor

    </div>
@endsection

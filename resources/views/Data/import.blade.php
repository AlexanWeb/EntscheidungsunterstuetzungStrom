@extends('account.layouts.default')

@section('account.content')
    <div class="card" >

        <h5 class="card-header">Import Data</h5>

        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('admin.upload') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

                <div class="card">
                    <div class="card-header">
                        <h4>Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="form-check-input" type="radio" name="data" id="type_sale1" value="day_Ahead" checked>
                            <label class="form-check-label" for="type_sale1">
                                Price of Day-Ahead Auction
                            </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="form-check-input" type="radio" name="data" id="type_sale2" value="intraday">
                            <label class="form-check-label" for="type_sale2">
                                Price of Intraday Auction
                            </label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input class="form-check-input" type="radio" name="data" id="market_values" value="market_values">
                            <label class="form-check-label" for="market_values">
                                Market values
                            </label>
                        </div>
                    </div>
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
    </div>
@endsection


@extends('layouts.app')

@section('content')
    <div class="card" >

        <h5 class="card-header">Import Data</h5>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('upload') }}" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('file') ? ' has-error' : '' }}">
                <h4 for="file" class="card-title">CSV file to import</h4>

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
@endsection


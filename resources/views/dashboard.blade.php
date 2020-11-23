@extends('account.layouts.default')

@section('account.content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>There is currently not data available. Please try again later.</h4>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

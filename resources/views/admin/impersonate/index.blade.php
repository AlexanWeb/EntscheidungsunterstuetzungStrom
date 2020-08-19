@extends('account.layouts.default')

@section('account.content')
            <div class="card">
                <div class="card-header">
                    Impersonate a User
                </div>
                <div class="card-body">
                    <form action="{{route('admin.impersonate.start')}}" method="POST">
                        @csrf

                        <div class="from-group{{$errors->has('email') ? 'has.error':''}}">
                            <label for="email" class="col-form-label">User Mail</label>
                            <input id="email" type="text" class="form-control" name="email" >
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif

                        </div>

                    </form>
                </div>
            </div>
@endsection

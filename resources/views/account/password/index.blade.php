@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel panel-body">
            <form action="{{route('password.store')}}" method="POST">
                {{csrf_field()}}

                <div class="form-group{{$errors->has('password_current') ? 'has-error':''}}">

                    <label for="password_current" class="control-label">Current Password</label>
                    <input type="password" name="password_current" id="password_current" class="form-control">
                    @if($errors->has('password_current'))
                        <span class="help-block">
                            <stron>{{$errors->first('password_current')}}</stron>
                        </span>
                    @endif
                </div>

                <div class="form-group{{$errors->has('password') ? 'has-error':''}}">

                    <label for="password" class="control-label">New Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    @if($errors->has('password'))
                        <span class="help-block">
                            <stron>{{$errors->first('password')}}</stron>
                        </span>
                    @endif
                </div>

                <div class="form-group{{$errors->has('password_confirmation') ? 'has-error':''}}">

                    <label for="password_confirmation" class="control-label">Confirm Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                    @if($errors->has('password_confirmation'))
                        <span class="help-block">
                            <stron>{{$errors->first('password_confirmation')}}</stron>
                        </span>
                    @endif
                </div>


                <button type="submit"class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
@endsection

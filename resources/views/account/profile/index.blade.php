@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel panel-body">
            <form action="{{route('profile.store')}}" method="POST">
                {{csrf_field()}}

               <div class="form-group{{$errors->has('name') ? 'has-error':''}}">

                   <label for="name" class="control-label">Name</label>
                   <input type="text" name="name" id="name" class="form-control" value="{{old('name', auth()->user()->name)}}">
                    @if($errors->has('name'))
                        <span class="help-block">
                            <stron>{{$errors->first('name')}}</stron>
                        </span>
                    @endif
               </div>
                <div class="form-group{{$errors->has('email') ? 'has-error':''}}">

                    <label for="email" class="control-label">Email</label>
                    <input type="text" name="email" id="email" class="form-control"  value="{{old('email', auth()->user()->email)}}">

                </div>

                @if($errors->has('email'))
                    <span class="help-block">
                            <stron>{{$errors->first('email')}}</stron>
                        </span>
                @endif

                <button type="submit"class="btn btn-primary">Update</button>
            </form>

        </div>
    </div>
@endsection

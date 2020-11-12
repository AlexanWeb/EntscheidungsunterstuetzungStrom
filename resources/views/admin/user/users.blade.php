@extends('account.layouts.default')

@section('account.content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">ID</th>

                            <th scope="col">Name</th>

                            <th scope="col">Email</th>

                            <th scope="col">Show power plants</th>

                            <th scope="col">Actions</th>

                        </tr>
                    </thead>

                    <tbody>

                    @if(isset($users) && $users -> count() > 0)
                        @foreach($users as $user)

                            <tr>

                                <th scope="row">{{$user->id}}</th>

                                <td>{{$user->name}} </td>

                                <td>{{$user->email}} </td>

                                <td> <a href="{{route('user.powerplants', $user->id)}}">
                                        <button type="button" class="btn btn-primary">Show</button>
                                    </a>
                                </td>

                                <td>
                                    <a href="#">
                                        <button type="button" class="btn btn-success"
                                                onclick="return confirm('Are you sure? Do you want to make this User Admin')">
                                            Test</button>
                                    </a>
                                    <a href="#"
                                       data-method="DELETE">
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure? Do you want to delete this User Admin')">
                                            Test</button>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
                <a href="#">
                    <button type="button" class="btn btn-primary btn-lg btn-block">Add new User</button>
                </a>
            </div>
        </div>
    </div>
@endsection

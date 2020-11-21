@extends('account.layouts.default')

@section('account.content')

    <div class="container">
        <div class="card">
            <h5 class="card-header">Users</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">
                                    <div class="row justify-content-center">
                                        ID
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="row justify-content-center">
                                        Name
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="row justify-content-center">
                                        Email
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="row justify-content-center">
                                        Show power plants
                                    </div>
                                </th>

                                <th scope="col">
                                    <div class="row justify-content-center">
                                        Actions
                                    </div>
                                </th>

                            </tr>
                            </thead>

                            <tbody>

                            @if(isset($users) && $users -> count() > 0)
                                @foreach($users as $user)

                                    <tr>

                                        <th scope="row">
                                            <div class="row justify-content-center ">
                                                {{$user->id}}
                                            </div>
                                        </th>

                                        <td>
                                            <div class="row justify-content-center">
                                                {{$user->name}}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="row justify-content-center">
                                                {{$user->email}}
                                            </div>
                                        </td>

                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="{{route('user.powerplants', $user->id)}}">
                                                    <button type="button" class="btn btn-primary">Show</button>
                                                </a>
                                            </div>
                                        </td>

                                        <td>
                                            <div class="row justify-content-center">
                                                <a href="{{route('admin.user.edit', $user->id)}}">
                                                    <button type="button" class="btn btn-success">
                                                        Roles</button>
                                                </a>
                                                <a href="#"
                                                   data-method="DELETE">
                                                    <button type="submit" class="btn btn-danger"
                                                            onclick="return confirm('Are you sure? Do you want to delete this User Admin')">
                                                        Test</button>
                                                </a>
                                            </div>


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
        </div>
    </div>
@endsection

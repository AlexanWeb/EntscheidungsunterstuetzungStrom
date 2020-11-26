@extends('account.layouts.default')

@section('account.content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th scope="col" style="display:none">#</th>

                            <th scope="col">Name</th>

                            <th scope="col">Type</th>

                            <th scope="col">Marginal cost (Grenzkosten)</th>

                            <th scope="col">Actions</th>

                        </tr>
                    </thead>

                    <tbody>
                    @foreach(auth()->user()->powerplants as $powerplant)

                        <tr>

                            <th scope="row" style="display:none">{{$powerplant->id}}</th>

                            <td>{{$powerplant->name}} </td>

                            <td>{{$powerplant->type}} </td>

                            <td>{{$powerplant->marginal_cost}} </td>

                            <td>
                            <!-- <button type="button" class="btn btn-primary">Show</button> -->
                                <a href="{{ route('powerplant.showtoedit', ['id' => $powerplant->id]) }}">
                                    <button type="button" class="btn btn-success">Edit</button>
                                </a>
                                <a href="{{ route('powerplant.delete', ['id' => $powerplant->id]) }}"
                                   data-method="DELETE">
                                    <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                </a>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>

                </table>
                <a href="{{route('powerplant.index')}}">
                    <button type="button" class="btn btn-primary btn-lg btn-block">Add new power plant</button>
                </a>
            </div>
        </div>
    </div>
@endsection

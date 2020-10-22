@extends('account.layouts.default')

@section('account.content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>

                            <th scope="col">#</th>

                            <th scope="col">Name</th>

                            <th scope="col">Type</th>

                            <th scope="col">Marginal cost (Grenzkosten)</th>

                            <th scope="col">Actions</th>

                        </tr>
                    </thead>

                    <tbody>

                    @if(isset($powerplants) && $powerplants -> count() > 0)
                        @foreach($powerplants as $powerplant)

                            <tr>

                                <th scope="row">{{$powerplant->id}}</th>

                                <td>{{$powerplant->name}} </td>

                                <td>{{$powerplant->type}} </td>

                                <td>{{$powerplant->marginal_cost}} </td>

                                <td>
                                    <a href="{{ route('powerplant.delete', ['id' => $powerplant->id]) }}"
                                       data-method="DELETE">
                                        <button type="submit" class="btn btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </a>
                                </td>

                            </tr>
                        @endforeach
                    @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection

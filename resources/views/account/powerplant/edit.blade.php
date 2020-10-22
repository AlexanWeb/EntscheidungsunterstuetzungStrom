@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel panel-body">
            <form action="{{route('powerplant.edit')}}" method="Post">
                {{csrf_field()}}
                <div class="card">

                    <h5 class="card-header text-center">Edit power plant</h5>


                    <div class="card-body ">
                        <div class="form-group" >
                            <label for="id" class="control-label">ID</label>
                            <input type="text" name="id" id="id" class="form-control"
                                   value={{$powerplant->id}} readonly>
                        </div>
                        <div class="form-group {{$errors->has('power_plant_name') ? 'has-error':''}}">
                            <label for="power_plant_name" class="control-label">Name Power Plant</label>
                            <input type="text" name="power_plant_name" id="power_plant_name" class="form-control"
                                   value={{$powerplant->name}}>
                            @error('power_plant_name')
                            <small class = "form-text text-danger">{{$errors->first('power_plant_name')}}</small>
                            @enderror
                        </div>


                        <div class="form-group {{$errors->has('type_powerplant') ? 'has-error':''}}">

                            <label class="mr-sm-2" for="type_powerplant">Type Power Plant</label>
                            <select class="form-control mr-sm-2" id="type_powerplant" name="type_powerplant">
                                <option value={{$powerplant->type}}>{{$powerplant->type}}</option>
                                <option value="Wind Onshore">Wind Onshore</option>
                                <option value="Wind Offshore">Wind Offshore</option>
                                <option value="Solar">Solar</option>
                                <option value="Solar">Controllable (Steuerbar)</option>
                            </select>
                            @error('type_powerplant')
                            <small class = "form-text text-danger">{{$errors->first('type_powerplant')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('marginal_cost') ? 'has-error':''}}">
                            <label for="marginal_cost" class="control-label">Marginal cost (Grenzkosten)</label>
                            <input type="text" name="marginal_cost" id="marginal_cost" class="form-control"
                                   value={{$powerplant->marginal_cost}}>
                            @error('marginal_cost')
                            <small class = "form-text text-danger">{{$errors->first('marginal_cost')}}</small>
                            @enderror
                        </div>

                        <button type="submit"class="btn btn-primary">Update</button>

                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

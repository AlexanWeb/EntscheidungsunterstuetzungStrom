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
                                   value="{{$powerplant->name}}">
                            @error('power_plant_name')
                            <small class = "form-text text-danger">{{$errors->first('power_plant_name')}}</small>
                            @enderror
                        </div>


                        <div class="form-group {{$errors->has('type_powerplant') ? 'has-error':''}}">

                            <label class="mr-sm-2" for="type_powerplant">Type Power Plant</label>
                            <select class="form-control mr-sm-2" id="type_powerplant" name="type_powerplant">

                                <option value="Photovoltaic system" {{return_if($powerplant->type == "Photovoltaic system", 'selected')}}>Photovoltaic system (Photovoltaikanlage)</option>
                                <option value="Biogas plant" {{return_if($powerplant->type == "Biogas plant", 'selected')}} >Biogas plant (Biogasanlage)</option>
                                <option value="Hydropower plant" {{return_if($powerplant->type == "Hydropower plant", 'selected')}} >Hydropower plant (Wasserkraftanlage)</option>
                                <option value="Wind turbine" {{return_if($powerplant->type == "Wind turbine", 'selected')}}>Wind turbine (Windkraftanlage)</option>

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

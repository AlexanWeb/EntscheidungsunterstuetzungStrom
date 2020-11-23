@extends('account.layouts.default')

@section('account.content')

    <div class="panel panel-default">
        <div class="panel panel-body">
            <form action="{{route('powerplant.store')}}" method="POST">
                {{csrf_field()}}
                <div class="card">

                    <h5 class="card-header text-center">Add new power plant</h5>

                    <div class="card-body ">
                        <div class="form-group {{$errors->has('power_plant_name') ? 'has-error':''}}">
                            <label for="power_plant_name" class="control-label">Name Power Plant</label>
                            <input type="text" name="power_plant_name" id="power_plant_name" class="form-control" placeholder="Name ">
                            @error('power_plant_name')
                            <small class = "form-text text-danger">{{$errors->first('power_plant_name')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('type_powerplant') ? 'has-error':''}}">

                            <label class="mr-sm-2" for="type_powerplant">Type Power Plant</label>
                            <select class="form-control mr-sm-2" id="type_powerplant" name="type_powerplant">
                                <option value=null selected>Choose...</option>
                                <option value="Photovoltaic system">Photovoltaic system (Photovoltaikanlage)</option>
                                <option value="Biogas plant">Biogas plant (Biogasanlage)</option>
                                <option value="Hydropower plant">Hydropower plant (Wasserkraftanlage)</option>
                                <option value="Wind turbine">Wind turbine (Windkraftanlage)</option>
                            </select>
                            @error('type_powerplant')
                            <small class = "form-text text-danger">{{$errors->first('type_powerplant')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('marginal_cost') ? 'has-error':''}}">
                            <label for="marginal_cost" class="control-label">Marginal cost (Grenzkosten)</label>
                            <input type="text" name="marginal_cost" id="marginal_cost" class="form-control" placeholder="Marginal cost (Grenzkosten)">
                            @error('marginal_cost')
                            <small class = "form-text text-danger">{{$errors->first('marginal_cost')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('test1') ? 'has-error':''}}">
                            <label for="test1" class="control-label">Test 1</label>
                            <input type="text" name="test1" id="test1" class="form-control" placeholder="Test 1" >
                            @error('test1')
                            <small class = "form-text text-danger">{{$errors->first('test1')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('test2') ? 'has-error':''}}">
                            <label for="test2" class="control-label">Test 2</label>
                            <input type="text" name="test2" id="test2" class="form-control" placeholder="Test 2" >
                            @error('test2')
                            <small class = "form-text text-danger">{{$errors->first('test2')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('test3') ? 'has-error':''}}">
                            <label for="marginal_cost" class="control-label">Test 3</label>
                            <input type="text" name="test3" id="test3" class="form-control" placeholder="Test 3" >
                            @error('test3')
                            <small class = "form-text text-danger">{{$errors->first('test3')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('marginal_cost') ? 'has-error':''}}">
                            <label for="test4" class="control-label">Test 4</label>
                            <input type="text" name="test4" id="test4" class="form-control" placeholder="Test 4" >
                            @error('test4')
                            <small class = "form-text text-danger">{{$errors->first('test4')}}</small>
                            @enderror
                        </div>

                        <button type="submit"class="btn btn-primary">Submit</button>

                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

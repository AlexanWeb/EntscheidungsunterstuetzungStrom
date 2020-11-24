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

                        Or Levelized cost of electricity
                        <div class="form-group {{$errors->has('investment') ? 'has-error':''}}">
                            <label for="test1" class="control-label">Investment Cost</label>
                            <input type="text" name="investment" id="investment" class="form-control" placeholder="Investment Cost
                            (includes every aspect of the installation)" >
                            @error('investment')
                            <small class = "form-text text-danger">{{$errors->first('investment')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('interest') ? 'has-error':''}}">
                            <label for="interest" class="control-label">Interest</label>
                            <input type="text" name="interest" id="interest" class="form-control" placeholder="Interest for capital" >
                            @error('interest')
                            <small class = "form-text text-danger">{{$errors->first('interest')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('returns') ? 'has-error':''}}">
                            <label for="marginal_cost" class="control-label">Returns</label>
                            <input type="text" name="returns" id="returns" class="form-control" placeholder="Anual returns separted by ';'one value for each year">
                            @error('returns')
                            <small class = "form-text text-danger">{{$errors->first('returns')}}</small>
                            @enderror
                        </div>

                        <div class="form-group {{$errors->has('cost') ? 'has-error':''}}">
                            <label for="cost" class="control-label">Cost</label>
                            <input type="text" name="cost" id="cost" class="form-control" placeholder="Anual cost seperated by ';' one value for each year" >
                            @error('cost')
                            <small class = "form-text text-danger">{{$errors->first('cost')}}</small>
                            @enderror
                        </div>

                        <button type="submit"class="btn btn-primary">Submit</button>

                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection

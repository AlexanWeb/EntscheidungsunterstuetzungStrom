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



                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="no_marginal_cost" value="no">
                            <label class="form-check-label" for="no_marginal_cost" >
                                <h5> No Marginal cost, Levelized cost of electricity    </h5>
                            </label>
                        </div>

                        <br>
                        <fieldset id="no_of_staff" disabled>
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
                                <input type="text" name="returns" id="returns" class="form-control" placeholder="Annual returns separted by ';'one value for each year">
                                @error('returns')
                                <small class = "form-text text-danger">{{$errors->first('returns')}}</small>
                                @enderror
                            </div>

                            <div class="form-group {{$errors->has('cost') ? 'has-error':''}}">
                                <label for="cost" class="control-label">Cost</label>
                                <input type="text" name="cost" id="cost" class="form-control" placeholder="Annual cost seperated by ';' one value for each year" >
                                @error('cost')
                                <small class = "form-text text-danger">{{$errors->first('cost')}}</small>
                                @enderror
                            </div>
                        </fieldset>

                        <button type="submit"class="btn btn-primary">Update</button>

                    </div>

                </div>

            </form>

        </div>
    </div>
@endsection
@section('scripts')

    <script >
        $(document).ready(function(){
            $('#no_marginal_cost').click(function(){
                var rBtnVal = $(this).val();
                if(rBtnVal == "yes"){
                    $("#no_of_staff").attr("disabled", true);
                    document.getElementById("no_marginal_cost").value = "no";
                    $("#marginal_cost").attr("disabled", false);
                }
                else{
                    document.getElementById("no_marginal_cost").value = "yes";
                    $("#no_of_staff").attr("disabled", false);
                    $("#marginal_cost").attr("disabled", true);
                }
            });
        });
    </script>
@endsection

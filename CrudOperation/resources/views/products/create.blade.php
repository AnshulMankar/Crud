@extends('products.layout')
  
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<div class="container col-sm-4">
    <form id="registration" action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" id="fn" name="fname" class="form-control" placeholder="First Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" id="ln" name="lname" class="form-control" placeholder="Last Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>E-mail:</strong>
                    <input type="text" id="email" name="email" class="form-control" placeholder="E-mail">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="phone" id="phone" class="form-control" placeholder="Phone">
                </div>
            </div>
            <div id="xam" class="col-xs-12 col-sm-12 col-md-12 ">
                <input type="text" class="input" id="xam" name="hobbies[]" placeholder="Enter Hobbies" />
                <input type="button" id="xam" value=" + " class="addinput" style="float:left; background: blue" />
                <input type="button" id="xam" value=" - " class="button-remove" style="float:left; background: red" />
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 emptydiv"></div>
            <br>
            <div class="form-group mb-3">
                        <select  id="country-dd" class="form-control" name="country_id">
                            <option value="">Select Country</option>
                            @foreach ($countries as $data)
                            <option value="{{$data->id}}">
                                {{$data->name}}
                            </option>
                            @endforeach
                        </select>
            </div>
            <div class="form-group mb-3">
                        <select id="state-dd" class="form-control" name="state_id">
                        </select>
                    </div>
            <div class="form-group">
                    <select id="city-dd" class="form-control" name="city_id"></select>
            </div>
            <br>
            <br>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <strong>Profile Photo</strong> <input type="file" item="img" name="image" id="fileToUpload">
            </div>

            <br><br>
            <br><br>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>


    </form>

<script>

        
        $(document).on("click",".addinput",function () {
              $("#xam").clone().appendTo(".emptydiv");
          }).on('click', '.button-remove', function() {
              $("#xam").remove();
          });


            $('#country-dd').on('change', function() 
            {
                var country_id = this.value;
                $("#state-dd").html('');

                $.ajax({
                    url:"{{url('getstate')}}?country_id="+country_id,
                    type: "POST",
                    data: {
                        country_id: country_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(res)
                    {
                        if(res.states){
                            $("#state-dd").empty();
                            var elementoptions = '<option>Select State</option>';
                            
                            $.each(res.states,function(key,value){
                                elementoptions += '<option value="'+value.id+'">'+value.name+'</option>';
                             });
                            $("#state-dd").append(elementoptions);

                        }else{
                            $("#state-dd").empty();
                        }
                    }

                });

            });

            $('#state-dd').on('change', function() {
                var state_id = this.value;
                $("#city-dd").html('');
                $.ajax({
                    url:"{{url('getcity')}}?state_id="+state_id,
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#city-dd').html('<option value="">Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#city-dd").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                });
            });
</script>
@endsection
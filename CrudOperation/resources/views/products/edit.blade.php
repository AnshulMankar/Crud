@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
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
  <div class="container" >
    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>First Name:</strong>
                <input type="text" name="fname" value="{{$product->fname}}" class="form-control" placeholder="First Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Last Name:</strong>
                <input type="text" name="lname" class="form-control" value="{{$product->lname}}" placeholder="Last Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Email:</strong>
                <input type="text" name="email" class="form-control" value="{{$product->email}}"placeholder="Email">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Contact Number:</strong>
                <input type="text" name="phone" class="form-control" value="{{$product->phone}}" placeholder="Last Name">
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Hobbies:</strong>
                    @foreach(explode(",",$product->hobbies) as $val)
                        <div id="xam" class="col-xs-12 col-sm-12 col-md-12 ">
                            <input type="text" class="input" id="xam" value="{{str_replace (array('[','"','"',']'), '' , $val)}}" name="hobbies[]" placeholder="Enter Hobbies" />
                            <input type="button" id="xam" value=" + " class="addinputx " style="float:left; background: blue" />
                            <input type="button" id="xam" value=" - " class="button-remove " style="float:left; background: red" />
                        </div>
                     @endforeach
                    <div class="col-xs-12 col-sm-12 col-md-12 emptydiv"></div>
                </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image</strong>
                    <input type="text" name="image" value="{{ $product->image }}" class="form-control" placeholder="Phone Number">
                </div>
        </div>
            <div class="col-xs-12 col-sm-12 col-md-12 ">
                <label for="country">Country</label>
                    <select class="form-control" id="country-dropdown" name="country_id" data-dependent="state" >
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                        <option value="{{$country->id}}">
                        {{$country->name}}
                        </option>
                        @endforeach

                    </select>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 ">
            <label for="states" >State</label>
            <select class="form-control" name="state_id" value="{{$product->state}}"  id="state-dropdown" data-dependent="cities">
                @foreach($states as $state)
                    <option value="{{$state->id}}">
                        {{$state->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 ">
            <label for="city">City</label>
            <select class="form-control" name="city_id" id="city-dropdown" }>
                @foreach($cities as $city)
                    <option value="{{$city->id}}" >
                        {{$city->name}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
              <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>

    <script >

            $('#country-dropdown').on('change', function()
            {
                var country_id = this.value;
                $("#state-dropdown").html('');

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
                            $("#state-dropdown").empty();
                            var elementoptions = '<option>Select State</option>';
                            //$("#state-dropdown").append('<option>Select State</option>');
                            $.each(res.states,function(key,value){
                                elementoptions += '<option value="'+value.id+'">'+value.name+'</option>';
                                // $("#state-dropdown").append('<option value="'+key+'">'+value+'</option>');
                            });
                            $("#state-dropdown").append(elementoptions);

                        }else{
                            $("#state-dropdown").empty();
                        }
                    }

                });

            });

            $('#state-dropdown').on('change', function() {
                var state_id = this.value;
                $("#city-dropdown").html('');
                $.ajax({
                    url:"{{url('getcity')}}?state_id="+state_id,
                    type: "POST",
                    data: {
                        state_id: state_id,
                        _token: '{{csrf_token()}}'
                    },
                    dataType : 'json',
                    success: function(result){
                        $('#city-dropdown').html('<option value="">Select City</option>');
                        $.each(result.cities,function(key,value){
                            $("#city-dropdown").append('<option value="'+value.id+'">'+value.name+'</option>');
                        });
                    }
                });
            });

            $(document).on("click",".addinputx",function () {
                $("#xam").clone().appendTo(".emptydiv");
            }).on('click', '.button-remove', function() {
                $("#xam").remove();
            });
            if($('#registration').length > 0 )
            {
                $('#registration').validate({
                    rules:
                        {
                            fname: {
                                required: true,
                            },
                            lname: {
                                required: true,
                            },
                            email: {
                                required:true,
                                email: true,
                            },
                            phone:{
                                required:true,
                            }
                        },
                    messages:{
                        fname : {
                            required: "Please Enter Valid First Name !",
                        },
                        lname : {
                            required: "Please Enter Valid Last Name !",
                        },
                        email : {
                            required: "Please Enter Valid Email Address !",
                            email: "Please Enter Valid Email Address !",
                        },
                        phone : {
                            required: "Please Enter Valid Email Address !",
                            email: "Please Enter Valid Email Address !",
                        },
                    }

                });
            }
        </script>

@endsection

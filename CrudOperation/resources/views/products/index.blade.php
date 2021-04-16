@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> CRUD </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table id="users" class="table table-bordered" >
        <tr>
            <th>No</th>
            <th>Full Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Hobbies</th>
            <th>Image</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>

            <th width="280px">Action</th>
        </tr>
        @foreach ($products as $product)
        <tr>

            <td>{{ $product->id }}</td>
            <td>{{ $product->fname }}</td>
            <td>{{ $product->lname }}</td>
            <td>{{ $product->email }}</td>
            <td>{{ $product->phone }}</td>
            <td>{{ str_replace (array('[','"','"',']'), '' , $product->hobbies)}}</td>
            <td>{{ $product->image }}</td>
            <td>{{ $product->countryName }}</td>
            <td>{{ $product->stateName }}</td>
            <td>{{ $product->cityName }}</td>



            <td>
                <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                    <a class="btn btn-info" href="{{ route('products.show',$product->id) }}">Show</a>

                    <a class="btn btn-primary" href="{{ route('products.edit',$product->id) }}">Edit</a>

                    @csrf
                    @method('DELETE')

                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>

<script>

        $('#users').dataTable();

        $(document).on("click",".addinput",function () {
            $(".demox:first").clone().appendTo(".emptydiv");
        });

</script>



@endsection

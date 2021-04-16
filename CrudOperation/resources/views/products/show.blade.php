@extends('products.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <tr>
            <td>First Name</td>
            <td>Last Name</td>
            <td>Email</td>
            <td>Phone</td>
            <td>Country</td>
            <td>State</td>
            <td>City</td>
            <td>Hobbies</td>

        </tr>

<tr>
<td>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->fname }}
            </div>
        </div>
</td>
    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->lname }}
            </div>
        </div>
    </td>
    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->email }}
            </div>
        </div>
    </td>
    <td>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->phone }}
            </div>
        </div>
    </td>
    <td>
        <div class="container">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->countryName }}
            </div>
        </div>
    </td>
    <td>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->stateName }}
            </div>
        </div>
    </td>
    <td>
    <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->cityName }}
            </div>
        </div>
        </div>
    </td>
       <td> <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {{ $product->hobbies }}
            </div>
        </div>
    </div>
</td>
</tr>
    </table>
@endsection

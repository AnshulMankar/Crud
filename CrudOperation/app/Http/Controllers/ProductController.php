<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\country;
use App\Models\state;
use App\Models\city;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function index()
    {
        $products = Product::leftJoin('countries','products.country_id',"=",'countries.id')
            ->leftJoin('states','products.state_id','=','states.id')
            ->leftJoin('cities','products.city_id','=','cities.id')
            ->select(
                'products.fname',
                'products.id',
                'products.lname',
                'products.email',
                'products.phone',
                'products.hobbies',
                'products.image',
                'countries.name as countryName',
                'states.name as stateName',
                'cities.name as cityName'
            );
        $products = $products->get();

        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();

        return view('products.create', [
            "countries" => $countries,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'image' => 'required|max:2048',
            'email' => 'required|email|unique:products',
        ]);

        $request_data=$request->all();
        $hobbies = implode(',',$request_data['hobbies']);
        $request_data['hobbies']=$hobbies;
        Product::create($request_data);

        return redirect()->route('products.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */

    public function getstateinfo(Request $request)
    {
        $data['states'] = state::where("country_id",$request->country_id)
            ->get(["name","id"]);
        return response()->json($data);
    }

    public function getcityinfo(Request $request)
    {
        $data['cities'] = city::where("state_id",$request->state_id)
            ->get(["name","id"]);
        return response()->json($data);
    }


    public function show(Product $product)
    {
        $product = Product::leftJoin('countries','products.country_id',"=",'countries.id')
            ->leftJoin('states','products.state_id','=','states.id')
            ->leftJoin('cities','products.city_id','=','cities.id')
            ->select(
                'products.fname',
                'products.id',
                'products.lname',
                'products.email',
                'products.phone',
                'products.hobbies',
                'products.image',
                'countries.name as countryName',
                'states.name as stateName',
                'cities.name as cityName'
            )
            ->where('products.id', $product->id)
        ;
        $product = $product->first();

        return view('products.show',['product'=>$product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = product::find($id);
        $countries = country::all();
        $states = state::where("country_id",$products->country_id)
        ->get(["name","id"]);
        $cities = city::where("state_id",$products->state_id)
            ->get(["name","id"]);

        return view('products.edit',[
            'product'=>$products,
            'countries'=>$countries,
            'states'=>$states,
            'cities'=>$cities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([

        ]);

        $product->update($request->all());

        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}

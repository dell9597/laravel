<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $fields = $request->validate([
            'name' => 'required|string',
            'type' => 'required|integer',
            'price' => 'required|integer',
        ]);

        $product = new Product;
        $product->name = $fields['name'];
        $product->price = $fields['price'];
        $product->type =  $fields['type'];
        $result = $product->save();

        if($result){
            $result = [
                'name' => 'show',
                'payload' => $product->all(),
            ];
            return $result;
            // return  $result;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = [
            'name' => 'show',
            'payload' => Product::find($id),
        ];
        return $result;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $product = Product::find($id)->update($request->all());
        $result = [
            'name' => 'update',
            'payload' => $product,
        ];
        return $result;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $product =  Product::find($id)->delete();
        $result = [
            'name' => 'destroy',
            'payload' => $product,
        ];
        return $result;
    }
}

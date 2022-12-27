<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::with('panel')->get();

        return response()->json([
            'message' => "get product success",
            'data' => $product
        ],200);
        // return Product::all();
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
            'panelId' => 'required|string',
            'burden' => 'required|string', 
            'voltage' => 'required|string',
            'electricCurrent' => 'required|string',
            'power' => 'required|string'
        ]);

        $product = Product::create($request->all());
        $response = [
            'product' => $product,
            'message' => "created succesfully"
        ];
        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('panel')->where('id', $id)->first();
        return response()->json([
            'message' => "get single product success",
            'data' => $product
        ],200);
        // return Product::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    //    return Product::destroy($id);
    $product = Product::destroy($id);
        return response()->json([
            'message' => "delete product success"
        ],200);
    }


    // /**
    //  * Search for a name.
    //  *
    //  * @param  str  $name
    //  * @return \Illuminate\Http\Response
    //  */
    // // public function search($id)
    // // {
    // //    return Product::destroy($id);
    // // }

}

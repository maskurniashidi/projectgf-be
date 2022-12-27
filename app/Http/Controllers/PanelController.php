<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;

class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $panel = Panel::with('product')->get();
    
        // $panel = Panel::all();
        // $product = panel::with('product');
        return response()->json([
            'message' => "get all panel success",
            'data' => $panel
        ],200);


        
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
            'panelName' => 'required|string',
            'maxPower' => 'required|string', 
            'remainingPower' => 'required|string'
            ]);
        return Panel::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $panel = Panel::with('product')->where('id', $id)->first();
        return response()->json([
            'message' => "get panel success",
            'data' => $panel
        ],200);
        
        // return Panel::find($id);
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
        $panel = Panel::find($id);
        $panel->update($request->all());
        
        return $panel;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Panel::destroy($id);
    }
}

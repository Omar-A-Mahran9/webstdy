<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Option_Value;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alloption=array();
        $options=Option::latest()->get();
        foreach($options as $option ){
            $option->optionvalues;
            array_push($alloption, $option);
        }
          return array_reverse($alloption);
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validate=$request->validate([
            'OptionName'=>'required',
             'OptionValues' => 'required|array|min:1',
        ]);
        $data=[
            'OptionName'=>$request->OptionName,  
        ];
        $option=Option::create($data);

        $array=array();
        foreach(request('OptionValues') as $OptionValue){
            $data=[
                'Option_id'=> $option->id,
                'valueName'=>$OptionValue,  
            ];
            $option_value=Option_Value::create($data);
            array_push($array,$option_value);
        };

        return response()->json(['option'=>$option,'value'=>$array]);
 
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Option $option)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($option )
    {
         $optionn=Option::find($option);
 
        $optionn->delete();
        return response()->noContent();
    }
}

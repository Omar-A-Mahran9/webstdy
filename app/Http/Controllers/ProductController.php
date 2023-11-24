<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Variant;
use App\Models\variants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $AllProduct=Product::latest()->get();
        return $AllProduct;
    }

    public function showproduct($id)
    {
        $Product=Product::find($id);
        return $Product;
    }
    public function filter($id) {
         $AllProducts=Product::latest()->get();
        $AllProduct=array();
        foreach( $AllProducts as $prd ){
            // $prd->variant ;
            foreach( $prd->variant as $prod ){
                 if($prod->option_values_id==$id){
                    array_push($AllProduct, $prd);
                }
            }
            
             
        };
         return $AllProduct;
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
            'productname'=>'required',
            'ProductDescription'=>'required',
            'productQuantity'=>'required',
            'ProductPrice'=>'required',
            'productImage'=>'required',
        ]);
        $link=null;
        if($request->productImage){
            $request->validate([
            'productImage' => 'required|image|mimes:jpg,jpeg,png,bmp',
            ]);
            if($request->hasFile('productImage')){
                $file = $request->file('productImage');
                $link=Storage::put('/product',$file);
             } 
        }
        $data=[
            'productname'=>$request->productname,
            'ProductDescription'=>$request->ProductDescription,
            'productQuantity'=>$request->productQuantity,
            'ProductPrice'=> $request->ProductPrice,
            'productImage'=>$link
        ];
        $allVariant=json_decode($request->variant);
        
        $product=Product::create($data);
        foreach( $allVariant as $variant){
            $variantData=[
                'Option_id'=>$variant->optionId,
                'Product_id'=>$product->id,
                'option_values_id'=>$variant->valueId,
                'price'=>$variant->variantPrice,
            ];
            variants::create($variantData);

         }
        return $product;
     
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product=Product::find($id);
        $Image=$product->productImage;
        if(request('productImage')===$Image){
            $link=$Image;
        $validate=$request->validate([
            'productname'=>'required',
            'ProductDescription'=>'required',
            'productQuantity'=>'required',
            'ProductPrice'=>'required',
        ]);
        
       }
       else{
        $validate=$request->validate([
            'productname'=>'required',
            'ProductDescription'=>'required',
            'productQuantity'=>'required',
            'ProductPrice'=>'required',
            'productImage'=>'required|image|mimes:jpg,jpeg,png,bmp',
        ]);
        $link=null;
            if($request->hasFile('productImage')){
                 $perviousimage=$product->getRawOriginal('productImage');
                 
                 $link=Storage::put('/product',$request->file('productImage'));
                $product->update(['productImage'=>$link]);
                Storage::delete($perviousimage);
             } 
   
       }
        
        $data=[
            'productname'=>$request->productname,
            'ProductDescription'=>$request->ProductDescription,
            'productQuantity'=>$request->productQuantity,
            'ProductPrice'=> $request->ProductPrice,
            'productImage'=>$link
        ];
        $product->update($data);
        return $product;
     
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product=Product::find($id);
        $Image=$product->getRawOriginal('productImage');
        Storage::delete($Image);
        $product->delete();
        return response()->noContent();

        //
    }
}
 
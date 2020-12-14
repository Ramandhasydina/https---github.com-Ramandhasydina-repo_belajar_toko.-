<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\product;
use Illuminate\Support\Facades\Validator;

class productController extends Controller
{
    public function show () 
    {
        return product::all();
    }
    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'product_name' => 'required'
            ]
        );

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = product::create([
            'product_name' => $request->product_name
        ]);

        if($simpan) {
            return Response()->json(['status'=>1]);
        }
        else {
            return Response()->json(['status'=>0]);
        }
    }

    public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'product_name' => 'required'
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = product::where('product_id', $id)->update([
            'product_id' => $request->product_naame
        ]);

        if($ubah) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->json(['status' => 0]);
        }
    }
    
    public function destroy($id)
    {
        $hapus = product::where('product_id', $id)->delete();
        if($hapus) {
        return Response()->json(['status' => 1]);    
    }
        else {
        return Response()->json(['status' => 0]);
    }
 }

}


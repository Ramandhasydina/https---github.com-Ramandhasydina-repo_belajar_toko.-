<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use Illuminate\Support\Facades\Validator;

class orderController extends Controller
{
    public function show()
    {
        $data_order = order::join('customers', 'order.customer_id', 'customers.customer_id')->leftjoin('product', 'order.product_id', 'product.product_id')->get();
        return Response()->json($data_order);
    }

    public function detail($id)
    {
        if(order::where('order_id', $id)->exists()){
            $data_order = order::join('customers', 'order.customers_id', 'customers.customers_id')->leftjoin('product', 'order.product_id', 'product.product_id')
                                        ->where('order.order_id', '=', $id)
                                        ->get();

            return Response()->json($data_order);
        }
        else{
            return Response()->json(['message' => 'not found']);
        }
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),
            [
                'customers_id' => 'required',
                'product_id' => 'required'
            ]
        );

        if($validator->fails()) {
            return Response()->json($validator->errors());
        }

        $simpan = order::create([
            'customers-' => $request->customers_id,
            'id_product' => $request->product_id
        ]);

        if($simpan)
        {
            return Response()->json(['status' => 1]);
        }
        else
        {
            return Response()->json(['status' => 0]);
        }
    }

    public function update($id, Request $request)
    {
        $validator=Validator::make($request->all(),
            [                
                '_customers_id' => 'required',
                'product_id' => 'required',
            ]
        );

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $ubah = order::where('order_id', $id)->update([            
            'customers_id' => $request->customers_id,
            'product_id' => $request->product_id,
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
        $hapus = order::where('order_id', $id)->delete();
        if($hapus) {
            return Response()->json(['status' => 1]);
        }
        else {
            return Response()->sjon(['status' => 0]);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function products(){
       // Session::put('page','sections');
        $products = Product::get()->toArray();
        //  dd($products);
        return view('admin.products.products')->with(compact('products'));
    }
    public function updateProductStatus(Request $request){
        if($request->ajax()){
           $data = $request->all();
           // echo "<pre>"; print_r($data); die;
           if($data['status']=="Active"){
               $status = 0;
           }else{
               $status = 1;
           }
           Product::where('id',$data['product_id'])->update(['status'=>$status]);
        //    return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
           $response = ['status' => $status, 'product_id' => $data['product_id']];
           return response()->json($response, 200);
        }
       }
       public function deleteProduct($id){
        //حذف منتج
        Product::where('id',$id)->delete();
        $message = "Product has been deleted successfully!"; 
        return redirect()->back()->with('success_message',$message);
  }


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;


class HomeController extends Controller
{

    public function index() {
        $product = product::paginate(10);
        return view('home.userpage',compact('product'));
    }

    public function redirect() {

        $usertype = Auth::user()->usertype;
        if($usertype == '1') {
            return view('admin.home');
        } else {
            $product = product::paginate(10);
            return view('home.userpage',compact('product'));
        }

    }

    public function product_details($id) {
        $product = product::find($id);
        return view('home.product_details',compact('product'));
    }

    public function add_cart(Request $request,$id) {
        $user = Auth::user();
        $product = product::find($id);

        if($product->discount_price != null) {
            $sum_price = $product->discount_price * $request->quantity;
        } else {
            $sum_price = $product->price * $request->quantity;
        }

        cart::insert([
            'name'=>$user->name,
            'email'=>$user->email,
            'phone'=>$user->phone,
            'address'=>$user->address,
            'user_id'=>$user->id,

            'product_title'=>$product->title,
            'price'=>$sum_price,
            'image'=>$product->image,
            'product_id'=>$product->id,

            'quantity'=>$request->quantity,
 
            'created_at'=>Carbon::now('GMT+7')

        ]);
        return redirect()->back();
    }

    public function show_cart() {
        $id = Auth::user()->id;
        $cart = cart::where('user_id','=',$id)->get();
        return view('home.show_cart',compact('cart'));
    }

    public function remove_cart($id) {
        $cart = cart::find($id);
        $cart->delete();
        return redirect()->back();
    }

}
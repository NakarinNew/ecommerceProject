<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Comment;
use App\Models\Reply;
use App\Models\Order;
use Session;
use Stripe;


class HomeController extends Controller
{

    public function index() {
        $product = product::paginate(10);
        $comment = comment::orderby('id','desc')->get();
        $reply = reply::all();
        return view('home.userpage',compact('product','comment','reply'));
    }

    public function redirect() {

        $usertype = Auth::user()->usertype;
        if($usertype == '1') {
            $total_product = product::all()->count();
            $total_order = order::all()->count();
            $total_user = user::all()->count();

            $order = order::all();
            $total_revenue = 0;
            foreach($order as $row) {
                $total_revenue = $total_revenue+$row->price;
            }
            $total_delivered = order::where('deilvery_status','=','delivered')->get()->count();
            $total_processing = order::where('deilvery_status','=','processing')->get()->count();
            return view('admin.home',compact('total_product','total_order','total_user','total_revenue','total_delivered','total_processing'));
        } else {
            $product = product::paginate(10);
            $comment = comment::orderby('id','desc')->get();
            $reply = reply::all();
            return view('home.userpage',compact('product','comment','reply'));
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

    public function cash_order() {
        $user = Auth::user();
        $user_id = $user->id;
        
        $data = cart::where('user_id','=',$user_id)->get();
        foreach($data as $row) {
            order::insert([
                'name'=>$row->name,
                'email'=>$row->email,
                'phone'=>$row->phone,
                'address'=>$row->address,
                'user_id'=>$row->user_id,
    
                'product_title'=>$row->product_title,
                'price'=>$row->price,
                'quantity'=>$row->quantity,
                'image'=>$row->image,
                'product_id'=>$row->product_id,

                'payment_status'=>'cash on deilvery',
                'deilvery_status'=>'processing',
     
                'created_at'=>Carbon::now('GMT+7')
            ]);
            $cart_id = $row->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }
        return redirect()->back()->with('message','We have Received Your Order. We will connect with you soon.');
    }

    public function stripe($totalprice) {
        return view('home.stripe',compact('totalprice'));
    }

    public function stripePost(Request $request,$totalprice) {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create ([
                "amount" => $totalprice * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Thank for Payment (Test payment.)" 
        ]);
      
        $user = Auth::user();
        $user_id = $user->id;
        
        $data = cart::where('user_id','=',$user_id)->get();
        foreach($data as $row) {
            order::insert([
                'name'=>$row->name,
                'email'=>$row->email,
                'phone'=>$row->phone,
                'address'=>$row->address,
                'user_id'=>$row->user_id,
    
                'product_title'=>$row->product_title,
                'price'=>$row->price,
                'quantity'=>$row->quantity,
                'image'=>$row->image,
                'product_id'=>$row->product_id,

                'payment_status'=>'Paid',
                'deilvery_status'=>'processing',
     
                'created_at'=>Carbon::now('GMT+7')
            ]);
            $cart_id = $row->id;
            $cart = cart::find($cart_id);
            $cart->delete();
        }

        Session::flash('success', 'Payment successful!');
              
        return back();
    }

    public function show_order() {
        $user = Auth::user();
        $user_id = $user->id;
        $order = order::where('user_id','=',$user_id)->get();

        return view('home.order',compact('order'));
    }

    public function cancel_order($id) {
        order::find($id)->update([
            'deilvery_status'=>'You canceled the order'
        ]);
        return redirect()->back();
    }

    public function add_comment(Request $request) {
        $user = Auth::user();
        comment::insert([
            'name'=>$user->name,
            'user_id'=>$user->id,
            'comment'=>$request->comment,
            'created_at'=>Carbon::now('GMT+7')
        ]);
        return redirect()->back();
    }

    public function add_reply(Request $request) {
        $user = Auth::user();
        reply::insert([
            'name'=>$user->name,
            'user_id'=>$user->id,
            'comment_id'=>$request->commentId,
            'reply'=>$request->reply,
            'created_at'=>Carbon::now('GMT+7')
        ]);
        return redirect()->back();
    }

}
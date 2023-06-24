<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Catagory;
use App\Models\Product;

class AdminController extends Controller
{
    public function view_catagory() {
        $data = catagory::all();
        return view('admin.catagory',compact('data'));
    }

    public function add_catagory(Request $request) {
        $data = new catagory;
        $data -> catagory_name=$request->catagory;
        
        $data->save();
        return redirect()->back()->with('message','Catagory Added Successfully');
    }

    public function delete_catagory($id){
        $data = catagory::find($id);
        $data -> delete();

        return redirect()->back()->with('message','Catagory Deleted Successfully');
    }

    public function view_product() {;
        $catagory = catagory::all();
        return view('admin.product',compact('catagory'));
    }

    public function add_product(Request $request){
        $product = new product;
        
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->discount_price=$request->dis_price;
        
        $product->catagory=$request->catagory;

        // การเข้ารหัสรูปภาพ
        $image = $request->file('image');
        // เปลี่ยนชื่อภาพใหม่
        $name_gen = hexdec(uniqid());
        // ดึงนามสกุลไฟล์ภาพ
        $img_ext = strtolower($image->getClientOriginalExtension());
        // ไฟล์ภาพที่ต้องการ
        $img_name = $name_gen.'.'.$img_ext;
        // อัพโหลดและบันทึกรูปภาพ
        $upload_location = 'product/image/';
        $full_path = $upload_location.$img_name;
        $image->move($upload_location,$img_name);
        $product->image=$full_path;

        $product->save();
        return redirect()->back()->with('message','Product Added Successfully');

    }

    public function show_product() {
        $product = product::all();
        return view('admin.show_product',compact('product'));
    }

    public function delete_product($id){
        // ลบภาพ
        $image = product::find($id)->image;
        unlink($image);
        // ลบข้อมูล
        $product = product::find($id);
        $product -> delete();

        return redirect()->back()->with('message','Product Deleted Successfully');
    }

    public function update_product($id) {
        $product = product::find($id);
        $catagory = catagory::all();
        return view('admin.update_product',compact('product','catagory'));
    }
}

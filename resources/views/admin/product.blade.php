<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style type="text/css">
        .div_center {
            text-align: center;
            padding-top: 40px;
        }
        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }
        .center {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
          border: 3px solid #00A6FF;
        }
        label{
            display: inline-block;
            width: 200px;
        }
        .dis_design{
            padding-bottom: 15px;
        }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar');
      <!-- partial -->
      @include('admin.header');
      <!-- partial -->
      <div class="main-panel">
          <div class="content-wrapper">

                @if(session()->has('message'))
                  <div class="alert alert-success">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      {{session()->get('message')}}
                  </div>
                @endif

                <div class="div_center">
                    <h2 class="h2_font">Add Product</h2>

                    <form action="{{url('/add_product')}}" method="POST" enctype="multipart/form-data"> 

                        @csrf

                        <div class="dis_design">
                            <label>Product Title : </label>
                            <input type="text" name="title" placeholder="Write a Title" required="">
                        </div>
                        <div class="dis_design">
                            <label>Product Description : </label>
                            <input type="text" name="description" placeholder="Write a Description" required="">
                        </div>
                        <div class="dis_design">
                            <label>Product Price : </label>
                            <input type="number" name="price" placeholder="Write a Price" required="">
                        </div>
                        <div class="dis_design">
                            <label>Discount Price : </label>
                            <input type="number" name="discount_price" placeholder="Write a Discount Price is a apply">
                        </div>
                        <div class="dis_design">
                            <label>Product Quantity : </label>
                            <input type="number" name="quantity" min="0" placeholder="Write a Quantity" required="">
                        </div>
                        <div class="dis_design">
                            <label>Product Catagory : </label>
                            <select name="catagory" required="">
                                <option value="" selected="">Add a Catagory Here</option>
                                @foreach($catagory as $catagory)
                                <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="dis_design">
                            <label>Product Image Here : </label>
                            <input type="file" name="image" placeholder="Write a Title" required="">
                        </div>
                        <div class="dis_design">
                            <input type="submit" class="btn btn-outline-primary" value="Add Product">
                        </div>

                    </form>

                </div>

          </div>
      </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>

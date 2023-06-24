<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style>
        .center {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
          border: 3px solid #000;
        }
        .th_col {
            padding-left: 30px;
            padding-right: 30px;
        }
        .h2_font {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;
        }
        .img_set {
            width: 200px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        /* */
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

             <h2 class="h2_font">Add Product</h2>

                <table class="table-bordered center">
                    <thead class="table-dark">
                        <tr>
                            <th class="th_col">Product Title</th>
                            <th class="th_col">Description</th>
                            <th class="th_col">Quantity</th>
                            <th class="th_col">Catagory</th>
                            <th class="th_col">Price</th>
                            <th class="th_col">Discount Price</th>
                            <th class="th_col">Product Image</th>
                            <th class="th_col">Edit</th>
                            <th class="th_col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($product as $product)
                        <tr>
                            <td>{{$product->title}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>{{$product->catagory}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount_price}}</td>
                            <td>
                                <img class="img_set" src="{{asset($product->image)}}">
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('update_product',$product->id)}}">Edit</a>
                            </td>
                            <td>
                                <a onclick="return confirm('Are You Sure To Delete.')" class="btn btn-danger" href="{{url('delete_product',$product->id)}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

          </div>
      </div>
      <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>

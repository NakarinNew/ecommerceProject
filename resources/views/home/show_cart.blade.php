<!DOCTYPE html>
<html>
   <head>
      <base href="/public">
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
      <style>
        .center {
          margin: auto;
          width: 70%;
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
            width: 150px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .total_deg {
            margin: auto;
            text-align: center;
            font-size: 30px;
            padding: 40px;
        }
        /* */
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->
         
                @if(session()->has('message'))
                  <div class="alert alert-success center">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                      {{session()->get('message')}}
                  </div>
                @endif
      
            <table class="table-bordered center">
                    <thead class="table-dark">
                        <tr>
                            <th class="th_col">Product Title</th>
                            <th class="th_col">Product Quantity</th>
                            <th class="th_col">Price</th>
                            <th class="th_col">Image</th>
                            <th class="th_col">Action</th>
                        </tr>
                    </thead>
                    <?php $totalprice=0; ?>
                    @foreach($cart as $row)
                    <tbody>
                        <tr>
                            <td>{{$row->product_title}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>${{$row->price}}</td>
                            <td>
                                <img class="img_set" src="{{asset($row->image)}}">
                            </td>
                            <td><a class="btn btn-danger" onclick="return confirm('Are you sure to remove this Item ?')" href="{{url('remove_cart',$row->id)}}">Remove Item</a></td>
                        </tr>
                    </tbody>
                    <?php $totalprice=$totalprice + $row->price ?>
                    @endforeach
            </table>
            <div class="total_deg">
                <h1>Total Price : ${{$totalprice}}</h1>
                <br >
                @if($totalprice != 0)
                <a href="{{url('cash_order')}}" class="btn btn-danger">Cash On Deilvery</a>
                <a href="{{url('stripe',$totalprice)}}" class="btn btn-danger">Pay Using Card</a>
                @else
                <h3>There are no products in the cart.</h3>
                @endif
            </div>

      <!-- footer start -->
      @include('home.footer');
      <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>
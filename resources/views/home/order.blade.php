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
            width: 120px;
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
         <div>
         <table class="table-bordered center">
                    <thead class="table-dark">
                        <tr>
                            <th class="th_col">Product Title</th>
                            <th class="th_col">Quantity</th>
                            <th class="th_col">Price</th>
                            <th class="th_col">Payment Status</th>
                            <th class="th_col">Deilvery Status</th>
                            <th class="th_col">Image</th>
                            <th class="th_col">Cancel Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order as $row)
                        <tr>
                            <td>{{$row->product_title}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>${{$row->price}}</td>
                            <td>{{$row->payment_status}}</td>
                            <td>{{$row->deilvery_status}}</td>
                            <td>
                                <img class="img_set" src="{{asset($row->image)}}">
                            </td>
                            <td>
                                @if($row->deilvery_status == 'processing')
                                <a class="btn btn-danger" onclick="return confirm('Are you sure to Cancel this Order ?')" href="{{url('cancel_order',$row->id)}}">Cancel</a>
                                @else
                                <p style="color: red;">Not Allowed</p>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
         </div>

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
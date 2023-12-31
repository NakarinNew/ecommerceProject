<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    @include('admin.css');
    <style type="text/css">
        .dis_design{
            padding-bottom: 15px;
        }
        .center {
          margin: auto;
          width: 100%;
          text-align: center;
          margin-top: 30px;
          border: 3px solid #000;
        }
        .h2_font {
            text-align: center;
            font-size: 40px;
            padding-bottom: 40px;
        }
        .img_set {
            width: 100px;
            display: block;
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
            
                <h2 class="h2_font">All Order</h2>

                <div>
                  <form action="{{url('search')}}" method="get">
                    @csrf
                    <input type="text" name="search" placeholder="Search For Something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                  </form>
                </div>
          
                <div class="table-responsive">
                      <table class="table-bordered center">
                        <thead class="table-dark">
                          <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Product Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Payment Status</th>
                            <th>Delivery Status</th>
                            <th>Image</th>
                            <th>Delivered</th>
                            <th>Print PDF</th>
                            <th>Send Email</th>
                          </tr>
                        </thead>
                        <tbody>
                        @forelse($order as $row)
                          <tr>
                            <td>{{$row->name}}</td>
                            <td>{{$row->email}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->product_title}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>${{$row->price}}</td>
                            <td>{{$row->payment_status}}</td>
                            <td>{{$row->deilvery_status}}</td>
                            <td class="img_set">
                                <img src="{{asset($row->image)}}">
                            </td>
                            <td>
                              @if($row->deilvery_status=='processing')
                              <a class="btn btn-dark" onclick="return confirm('Are you sure this product is delivered ?')" href="{{url('delivered',$row->id)}}">Delivered</a>
                              @else
                              <h3 style="color: #01A6BA;">Delivered</h3>
                              @endif
                            </td>
                            <td>
                              <a class="btn btn-secondary" href="{{url('print_pdf',$row->id)}}">Print</a>
                            </td>
                            <td>
                              <a href="{{url('send_email',$row->id)}}" class="btn btn-info">Send</a>
                            </td>
                          </tr>
                        @empty
                        <tr>
                          <td colspan="16">
                            No Data Found.
                          </td>
                        </tr>
                        @endforelse
                        </tbody>
                      </table>
                </div>
            
          </div>
        </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.script');
    <!-- End custom js for this page -->
  </body>
</html>

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

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

      <style>
         .center {
          margin: auto;
          width: 50%;
          text-align: center;
          margin-top: 30px;
        }
        .link-color:link {
         color: red;
         background-color: transparent;
         text-decoration: none;
        }
      </style>
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header');
         <!-- end header section -->

         <!-- slider section -->
         @include('home.slider');
         <!-- end slider section -->
      </div>
      <!-- why section -->
      @include('home.why');
      <!-- end why section -->
      
      <!-- arrival section -->
      @include('home.new_arrival');
      <!-- end arrival section -->
      
      <!-- product section -->
      @include('home.product');
      <!-- end product section -->

      <!-- Comment and reply system starts here  -->
      <div class="center">
         <h1 style="font-size: 30px; padding-bottom: 20px;">Comments</h1>
         <form action="{{url('add_comment')}}" method="POST">
            @csrf
            <textarea name="comment" cols="30" rows="10" placeholder="Comment Something here"></textarea>
            <input type="submit" class="btn btn-danger" value="Comment">
         </form>
      </div>

      <div style="padding-left: 25%; padding-bottom: 20px;">
         <h1 style="font-size: 20px; padding-bottom: 20px;">All Comments</h1>
         @foreach($comment as $row)
         <div>
            <b>{{$row->name}}</b>
            <p>{{$row->comment}}</p>
            <a href="javascript:void(0);" onclick="reply(this)" class="link-color" data-Commentid="{{$row->id}}">Reply</a>
            @foreach($reply as $row_reply)
               @if($row_reply->comment_id == $row->id)
                  <div style="padding-left: 3%; padding-bottom: 10px;">
                     <b>{{$row_reply->name}}</b>
                     <p>{{$row_reply->reply}}</p>
                     <a href="javascript:void(0);" onclick="reply(this)" class="link-color" data-Commentid="{{$row->id}}">Reply</a>
                  </div>
               @endif
            @endforeach
         </div>
         @endforeach

         <!-- Reply TextBox -->
         <div style="display: none;" class="replyDiv">
            <form action="{{url('add_reply')}}" method="POST">
               @csrf
               <input type="text" id="commentId" name="commentId" hidden="">
               <textarea style="width: 50%;" placeholder="Write Something here" name="reply"></textarea>
               <br>
               <button type="submit" style="margin-bottom: 20px;" class="btn btn-outline-danger">Reply</button>
               <a href="javascript:void(0);" style="margin-bottom: 20px;" class="btn btn-outline-secondary" onClick="reply_close(this)">Close</a>
            </form>
         </div>
      </div>
      <!-- end Comment and reply system starts here  -->

      <!-- subscribe section -->
      @include('home.subscribe');
      <!-- end subscribe section -->

      <!-- client section -->
      @include('home.client');
      <!-- end client section -->

      <!-- footer start -->
      @include('home.footer');
      <!-- footer end -->

      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      
      <!-- reply function -->
      <script>
         function reply(caller){
            document.getElementById('commentId').value=$(caller).attr('data-Commentid');
            $('.replyDiv').insertAfter($(caller));
            $('.replyDiv').show();
         }
         function reply_close(caller){ 
            $('.replyDiv').hide();
         }
      </script>
      <!-- Refresh Page and Keep Scroll Position -->
      <script>
            document.addEventListener("DOMContentLoaded", function(event) { 
                  var scrollpos = localStorage.getItem('scrollpos');
                  if (scrollpos) window.scrollTo(0, scrollpos);
            });
            window.onbeforeunload = function(e) {
                  localStorage.setItem('scrollpos', window.scrollY);
            };
      </script>
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
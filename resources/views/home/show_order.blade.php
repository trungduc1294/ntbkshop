<!DOCTYPE html>
<html>
<head>
    <!-- Basic -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <!-- Site Metas -->
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <link rel="shortcut icon" href="images/shortcut.png" type="">
    <title>NTBK Shop</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}"/>
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet"/>

    <style>
        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            padding: 30px;
        }

        table, th, td{
            border: 1px solid grey;
        }

        th{
            font-size: 20px;
            padding: 5px;
            background-color: skyblue;
        }

        .total_deg{
            font-size: 20px;
            padding: 40px;
        }

        @media screen and (max-width:600px) {
           .center {
               width: 100%;
               padding: 0px;
           }

            table, th, td{
                border: 1px solid grey;
                font-size: 10px;
            }

            .btn_deg{
                font-size: 10px;
            }
        }
    </style>
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

    @if(Session::has('message'))
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
            {{Session::get('message')}}
        </div>
    @endif


    <div class="center">
        <table>
            <tr>
                <th>Product Title</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Payment status</th>
                <th>Delivery status</th>
                <th>Image</th>
                <th>Action</th>
            </tr>

            <?php $totalPrice = 0 ?>

            @foreach($orders as $item)
                @if($item->delivery_status != 'done')
                    <tr>
                        <td>{{$item->product_title}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->payment_status}}</td>
                        <td style="color: red">{{$item->delivery_status}}</td>
                        <td><img src="/product/{{$item->image}}" alt="" width="100px" height="100px"></td>
                        @if($item->delivery_status == 'processing')
                            <td>
                                <a onclick="return confirm('Are you sure to remove this cart?')" class="btn btn-danger btn_deg" href="{{url('/cancel_order', $item->id)}}">Cancel Order</a>
                            </td>
                        @endif
                    </tr>
                @endif

            @endforeach

        </table>

    </div>



    <div class="cpy_">
        <p class="mx-auto">
            ©  Nghệ Tĩnh Bách Khoa - Cháy hết mình, Tình Nghệ Tĩnh
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

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
    <title>Famms - Fashion HTML Template</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="{{asset('home/css/bootstrap.css')}}"/>
    <!-- font awesome style -->
    <link href="{{asset('home/css/font-awesome.min.css')}}" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="{{asset('home/css/style.css')}}" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="{{asset('home/css/responsive.css')}}" rel="stylesheet"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
            integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 10px;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        .qrImg{
            width: 400px;
            height: 400px;
            margin: 0 auto;
        }

        @media screen and (max-width: 600px) {
            .qrImg{
                width: 100%;
            }

            table{
                width: 100%;
                th, td{
                    width: 40px;
                }
            }
        }
    </style>
</head>

<body>

@include('sweetalert::alert');

<div class="hero_area">
    <!-- header section strats -->
    @include('shipper.header')
    <!-- end header section -->

    <div class="qrcode">
        <img class="qrImg" src="{{asset('/images/'.$qrCode->qr_code)}}">
    </div>

    <h1 style="margin-top: 60px" class="title_deg">Đơn ship ngày hôm nay</h1>

    <table class="table_deg">
        <tr>
            <th>Tên</th>
            <th>Sdt</th>
            <th>Đ/c</th>
            <th>Hàng</th>
            <th>SL</th>
            <th>Giá</th>
            <th>Action</th>
        </tr>

        @forelse($today_orders as $order)
            <tr>
                <td>{{$order->name}}</td>
                <td>{{$order->phone}}</td>
                <td>{{$order->address}}</td>
                <td>{{$order->product_title}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->price}}</td>
                @if($order->delivery_status == "done")
                    <td>
                        <p style="color: green">Done</p>
                    </td>
                @else
                    <td>
                        <a class="btn btn-info" href="{{url('done_order', $order->id)}}">Done</a>
                    </td>
                @endif
            </tr>
        @empty
            <tr>
                <td colspan="50">No data available</td>
            </tr>
        @endforelse
    </table>

    <div class="cpy_">
        <p class="mx-auto">
            © 2023 - Đồ án 1 - Hoàng Hà Trung Đức 20205066
        </p>
    </div>
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

<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
            integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css"/>
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet"/>
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet"/>
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet"/>


    <style>
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            padding: 30px;
        }


        table, th, td {
            border: 1px solid grey;
        }

        th {
            font-size: 24px;
            padding: 5px;
            background-color: skyblue;
        }

        .total_deg {
            font-size: 20px;
            padding: 40px;
        }


        @media screen and (max-width:600px) {
            .center {
                width: 100%;
                padding: 0px;
            }

            table, th, td {
                border: 1px solid grey;
                font-size: 12px;
            }

            .total_deg{
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>

@include('sweetalert::alert');

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
        <form action="{{url('post_destination_form')}}" method="post">
            @csrf
            <input type="text" name="destination" placeholder="Nhập địa chỉ nhận hàng">
            <input type="submit" value="Xác nhận">
        </form>
    </div>


    <div class="cpy_">
        <p class="mx-auto">
            ©  Nghệ Tĩnh Bách Khoa - Cháy hết mình, Tình Nghệ Tĩnh
        </p>
    </div>

    <script>
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                title: "Are you sure to cancel this product",
                text: "You will not be able to revert this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }
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

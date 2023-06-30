<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        .title_deg {
            font-size: 24px;
            font-weight: 600;
            text-align: center;
            padding-bottom: 20px;
        }

        .table_deg {
            border: 1px solid white;
            width: 100%;
            margin: auto;
            text-align: center;
        }

        th {
            background-color: skyblue;
        }

        th, td {
            padding: 5px;
        }
    </style>
</head>
<body>

<div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')

    <!-- partial -->
    @include('admin.header')
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            @if(Session::has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{Session::get('message')}}
                </div>
            @endif

            <h1 class="title_deg">All Orders</h1>

            <div style="margin: 20px auto;">
                <form action="{{url('search')}}" method="get">
                    @csrf
                    <input style="color: black" type="text" name="search" placeholder="search for something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>

            <table class="table_deg">
                <tr>
                    <th>Thời gian</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Product title</th>
                    <th>Quantity</th>
                    <th>Price</th>

                    <th>Payment status</th>
                    <th>Image</th>
                    <th>Delivered</th>
                    <th>Chọn shipper</th>
                </tr>

                @forelse($orders as $order)
                    <tr>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->email}}</td>
                        <td>{{$order->address}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>

                        @if($order->delivery_status == "done")
                            <td style="color: #00d25b">{{$order->delivery_status}}</td>
                        @else
                            <td style="color: red">{{$order->delivery_status}}</td>
                        @endif

                        <td>
                            <img style="width: 100px; height: 100px;" src="/product/{{$order->image}}" alt="">
                        </td>
                        <td>
                            @if($order->delivery_status == 'processing')
                                <a onclick="return confirm('Are you sure this product be delievered.')"
                                   class="btn btn-primary" href="{{url('/delivered', $order->id)}}">Deliver</a>
                            @else
                                <p style="color: green;">Delivered</p>
                            @endif

                        </td>
                        {{--                        <td>--}}
                        {{--                            <a class="btn btn-secondary" href="{{url('/print_pdf', $order->id)}}">Print PDF</a>--}}
                        {{--                        </td>--}}
                        {{--                        <td>--}}
                        {{--                            <a class="btn btn-info" href="{{url('send_email', $order->id)}}">Send email</a>--}}
                        {{--                        </td>--}}
                        @if($order->shipper_id)
                            <td style="color: green">
                                {{$order->shipper_name}}
                            </td>
                        @else
                            <td>
                                <form action="{{url('set_shipper')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="order_id" value="{{$order->id}}">
                                    <select name="shipper_id" id="" class="form-control">
                                        <option value="">Select a shipper</option>
                                        @foreach($shippers as $shipper)
                                            <option value="{{$shipper->id}}">{{$shipper->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Assign" class="btn btn-primary">
                                </form>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="50">No data available</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>

    {{--Return Scroll position after reload--}}
    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>


    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

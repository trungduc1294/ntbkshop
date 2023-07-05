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

            <div class="export_excel">
                <a href="{{url('export_order')}}" class="btn btn-outline-primary">Export to Excel</a>
            </div>

            <table class="table_deg">
                <tr>
                    <th>ID</th>
                    <th>Thời gian</th>
                    <th>Tên</th>
                    <th>Đại chỉ</th>
                    <th>SĐT</th>
                    <th>Tên sản phẩm</th>
                    <th> Số lượng</th>
                    <th>Giá</th>
                    <th>TG giao hàng</th>
                    <th>Note</th>

                    <th>Phương thức thanh toaán</th>
                    <th>Ảnh</th>
                    <th>Delivered</th>
                    <th>Chọn shipper</th>
                    <th>Xóa</th>
                </tr>

                @forelse($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>{{$order->created_at}}</td>
                        <td>{{$order->name}}</td>
                        <td>{{$order->destination}}</td>
                        <td>{{$order->phone}}</td>
                        <td>{{$order->product_title}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{$order->price}}</td>
                        <td>{{$order->delivery_time}}</td>
                        <td>{{$order->note}}</td>

                        @if($order->delivery_status == "done" or $order->delivery_status == "cash payment done" or $order->delivery_status == "transfer payment done")
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
                                        <option value="">Chọn shipper</option>
                                        @foreach($shippers as $shipper)
                                            <option value="{{$shipper->id}}">{{$shipper->name}}</option>
                                        @endforeach
                                    </select>
                                    <input type="submit" value="Assign" class="btn btn-primary">
                                </form>
                            </td>
                        @endif
                        @if($order->delivery_status == 'processing')
                            <td>
                                <a href="{{url('delete_order', $order->id)}}" class="btn btn-danger">Xóa</a>
                            </td>
                        @else
                            <td>
                                <p style="color: red">Không thể xóa</p>
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
        document.addEventListener("DOMContentLoaded", function (event) {
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function (e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
    </script>


    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

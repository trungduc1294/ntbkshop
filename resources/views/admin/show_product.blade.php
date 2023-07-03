<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        .center {
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 40px;
            border: 3px solid white;
        }

        .font_size {
            text-align: center;
            font-size: 40px;
            padding-top: 40px;
        }

        .img_size{
            width: 150px;
            height: 150px;
        }

        .th_color{
            background-color: skyblue;
            color: white;
        }

        .th_deg{
            padding: 20px;
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
            {{--Message notice--}}
            @if(Session::has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{Session::get('message')}}
                </div>
            @endif

            <h1 class="font_size">All Product</h1>

            <table class="center">
                <tr class="th_color">
                    <th class="th_deg">ID</th>
                    <th class="th_deg">Tên sản phẩm</th>
                    <th class="th_deg">Mô tả</th>
                    <th class="th_deg">Số lượng</th>
                    <th class="th_deg">Danh mục</th>
                    <th class="th_deg">Giá</th>
                    <th class="th_deg">Giá ưu đãi</th>
                    <th class="th_deg">Hình ảnh</th>
                    <th class="th_deg">Xóa</th>
                    <th class="th_deg">Sửa</th>
                </tr>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->quantity}}</td>
                        <td>{{$product->catagory}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->discount_price}}</td>
                        <td>
                            <img class="img_size" src="/product/{{$product->image}}">
                        </td>
                        <td>
                            <a onclick="return confirm('Chắc chưa?')" class="btn btn-danger" href="{{url('delete_product', $product->id)}}">Xóa</a>
                        </td>
                        <td>
                            <a class="btn btn-success" href="{{url('update_product', $product->id)}}">Sửa</a>
                        </td>
                    </tr>
                @endforeach
            </table>

        </div>
    </div>


    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

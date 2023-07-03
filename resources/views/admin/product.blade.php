<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')

    <style>
        .div_center{
            text-align: center;
            padding-top: 40px;
        }

        .font_size{
            font-size: 40px;
            padding-bottom: 40px;
        }

        .text_color{
            color: black;
            padding-bottom: 20px;
        }

        label{
            display: inline-block;
            width: 200px;
        }

        .div_design{
            padding-bottom: 15px;
        }
    </style>

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

            @if(Session::has('message'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{Session::get('message')}}
                </div>
            @endif

            <div class="div_center">
                <h1 class="font_size">Thêm sản phẩm</h1>

                <form action="{{url('/add_product')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="div_design">
                        <label>Product id</label>
                        <input class="text_color" type="number" name="id" placeholder="ID" required="">
                    </div>

                    <div class="div_design">
                        <label>Product title</label>
                        <input class="text_color" type="text" name="title" placeholder="Tên sản phẩm" required="">
                    </div>

                    <div class="div_design">
                        <label>Product Description</label>
                        <input class="text_color" type="text" name="description" placeholder="Mô tả" required="">
                    </div>

                    <div class="div_design">
                        <label>Product Price</label>
                        <input class="text_color" type="number" name="price" placeholder="Giá" required="">
                    </div>

                    <div class="div_design">
                        <label>Discount Price</label>
                        <input class="text_color" type="number" name="discount_price" placeholder="Giá ưu đãi (không cần)">
                    </div>

                    <div class="div_design">
                        <label>Product Quantity</label>
                        <input class="text_color" type="number" min="0" name="quantity" placeholder="Số lượng" required="">
                    </div>

                    <div class="div_design">
                        <label>Product Catagory</label>
                        <select class="text_color" name="catagory" id="" required="">
                            <option value="" selected="">Thêm danh mục sản phẩm</option>
                            @foreach($catagory as $catagory)
                                <option value="{{$catagory->catagory_name}}">{{$catagory->catagory_name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="div_design">
                        <label>Product Image</label>
                        <input type="file" name="image" required="">
                    </div>

                    <div class="div_design">
                        <input type="submit" value="Add Product" class="btn btn-primary">
                    </div>
                </form>


                <table class="center">
                    <tr class="th_color">
                        <th class="th_deg">ID</th>
                        <th class="th_deg">Product Title</th>
                        <th class="th_deg">Description</th>
                        <th class="th_deg">Quantity</th>
                        <th class="th_deg">Catagory</th>
                        <th class="th_deg">Price</th>
                        <th class="th_deg">Discount Price</th>
                        <th class="th_deg">Product Image</th>
                        <th class="th_deg">Delete</th>
                        <th class="th_deg">Edit</th>
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
                                <a onclick="return confirm('Are you sure to delete it?')" class="btn btn-danger" href="{{url('delete_product', $product->id)}}">Delete</a>
                            </td>
                            <td>
                                <a class="btn btn-success" href="{{url('update_product', $product->id)}}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </table>

            </div>
        </div>
    </div>



    <!-- container-scroller -->

    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

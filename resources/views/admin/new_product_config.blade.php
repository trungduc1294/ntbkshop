<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font {
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color {
            color: black;
        }

        .center {
            margin: auto;
            width: 70%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

        th {
            background-color: skyblue;
        }

        th, td, tr {
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
                <h2 class="h2_font">Add New Hot Product</h2>
            </div>

            <form action="{{url('new_product_config')}}" method="post">
                @csrf
                <label for="product">Choose a product:</label>

                <select style="color: black;" name="product_id" id="product_id">
                    <option style="color: black;" value="">Select Product</option>
                    @foreach($products as $product)
                        <option style="color: black;" value="{{$product->id}}">{{$product->title}}</option>
                    @endforeach
                    <input style="margin-left: 20px" type="submit" class="btn btn-primary" value="Choose">
                </select>
            </form>

            <table class="center">
                <tr>
                    <th>Hot Product Title</th>
                    <th>Hot Product Description</th>
                    <th>Action</th>
                    <th>Show</th>
                </tr>
                @foreach($hotProducts as $hotProduct)
                    <tr>
                        <td>{{$hotProduct->title}}</td>
                        <td>{{$hotProduct->description}}</td>
                        <td>
                            <a
                                onclick="return confirm('Are you sure to delete this banner ?')"
                                href="{{url('delete_hot_product', $hotProduct->id)}}"
                                class="btn btn-danger"
                            >
                                Delete
                            </a>
                        </td>
                        <td>
                            @if($hotProduct->status == 'active')
                                <p style="color: green;">Actived</p>
                            @else
                                <a
                                    onclick="return confirm('Are you sure to choose this product ?')"
                                    href="{{url('choose_hot_product', $hotProduct->id)}}"
                                    class="btn btn-info"
                                >
                                    Choose
                                </a>
                            @endif
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

<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
    <style>
        .div_center {
            text-align: center;
            padding-top: 40px;
        }

        .h2_font{
            font-size: 40px;
            padding-bottom: 40px;
        }

        .input_color{
            color: black;
        }

        .center{
            margin: auto;
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
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
                <h2 class="h2_font">Add Catagory</h2>

                <form action="{{url('/add_catagory')}}" method="post">
                    @csrf
                    <input type="number" name="id" required="" placeholder="ID" style="color: #000">
                    <input class="input_color" type="text" name="catagory" placeholder="Tên danh mục">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add Catagory">
                </form>
            </div>

            <table class="center">
                <tr>
                    <td>ID</td>
                    <td>Tên danh mục</td>
                    <td>Action</td>
                </tr>
                @foreach($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{$data->catagory_name}}</td>
                        <td>
                            <a
                                onclick="return confirm('Are you sure to delete {{$data->catagory_name}} catagory ?')"
                                href="{{url('delete_catagory', $data->id)}}"
                                class="btn btn-danger"
                            >
                                Xóa
                            </a>
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

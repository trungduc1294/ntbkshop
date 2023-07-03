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
            width: 50%;
            text-align: center;
            margin-top: 30px;
            border: 3px solid white;
        }

        th {
            background-color: skyblue;
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
                <h2 class="h2_font">Thêm banner</h2>

                <form action="{{url('/add_banner_sale')}}" method="post">
                    @csrf
                    <input type="number" name="id" required="" placeholder="id" style="color:#000000;">
                    <input class="input_color" type="text" name="title" placeholder="Tiêu đề">
                    <input class="input_color" type="text" name="bannerContent" placeholder="Nội dung">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add Catagory">
                </form>

            </div>

            <table class="center">
                <tr>
                    <th>Id</th>
                    <th>Tiêu đề</th>
                    <th>Nội dung</th>
                    <th>Action</th>
                </tr>
                @foreach($banners as $banner)
                    <tr>
                        <td>{{$banner->id}}</td>
                        <td>{{$banner->title}}</td>
                        <td>{{$banner->content}}</td>
                        <td>
                            <a
                                onclick="return confirm('Are you sure to delete this banner ?')"
                                href="{{url('delete_banner', $banner->id)}}"
                                class="btn btn-danger"
                            >
                                Xóa
                            </a>
                        </td>
                    </tr>
                @endforeach

            </table>

            <div class="div_center">
                <form action="{{url('/add_banner_img')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="number" name="id" required="" placeholder="ID" style="color:#000000;">
                    <input type="file" name="image" required="">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add Banner Image">
                </form>
            </div>

            <table class="center">
                <tr>
                    <th>Id</th>
                    <th>Ảnh banner</th>
                    <th>Action</th>
                    <th>Lựa chọn</th>
                </tr>
                @foreach($bannerImgs as $bannerImg)
                    <tr>
                        <td>{{$bannerImg->id}}</td>
                        <td>
                            <img src="{{asset('/images/'.$bannerImg->image)}}" width="100px" height="100px">
                        </td>
                        <td>
                            <a
                                onclick="return confirm('Are you sure to delete this banner ?')"
                                href="{{url('delete_banner_img', $bannerImg->id)}}"
                                class="btn btn-danger"
                            >
                                Delete
                            </a>
                        </td>
                        <td>
                            @if($bannerImg->status == 'active')
                                <p style="color: green;">Actived</p>
                            @else
                                <a
                                    onclick="return confirm('Are you sure to choose this banner ?')"
                                    href="{{url('choose_banner_img', $bannerImg->id)}}"
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

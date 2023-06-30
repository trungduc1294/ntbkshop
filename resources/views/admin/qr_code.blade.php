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
                <form action="{{url('/add_qrcode_img')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="qr_code" required="">
                    <br>
                    <label for="name">Tên ch TK:</label>
                    <input style="color: black" type="text" name="name" required="">
                    <input type="submit" name="submit" class="btn btn-primary" value="Add QR Code">
                </form>
            </div>

            <table class="center">
                <tr>
                    <th>Id</th>
                    <th>QR Image</th>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Show</th>
                </tr>
                @foreach($qrCodes as $qrCode)
                    <tr>
                        <td>{{$qrCode->id}}</td>
                        <td>
                            <img src="{{asset('/images/'.$qrCode->qr_code)}}" width="100px" height="100px">
                        </td>
                        <td>{{$qrCode->name}}</td>
                        <td>
                            <a
                                onclick="return confirm('Are you sure to delete this banner ?')"
                                href="{{url('delete_qrcode_img', $qrCode->id)}}"
                                class="btn btn-danger"
                            >
                                Delete
                            </a>
                        </td>
                        <td>
                            @if($qrCode->status == 'active')
                                <p style="color: green;">Actived</p>
                            @else
                                <a
                                    onclick="return confirm('Are you sure to choose this banner ?')"
                                    href="{{url('choose_qrcode_img', $qrCode->id)}}"
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

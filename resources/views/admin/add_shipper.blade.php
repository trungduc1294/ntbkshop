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

            <h1 class="title_deg">Thêm shipper</h1>

            <div style="margin: 20px auto;">
                <form action="{{url('search_user')}}" method="get">
                    @csrf
                    <input style="color: black" type="text" name="search" placeholder="search for something">
                    <input type="submit" value="Search" class="btn btn-outline-primary">
                </form>
            </div>

            <table class="table_deg">
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Action</th>
                </tr>

                @forelse($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>
                            <a class="btn btn-info" href="{{url('choose_shipper', $user->id)}}">Chọn</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="50">No data available</td>
                    </tr>
                @endforelse
            </table>


            <h1 style="margin-top: 60px" class="title_deg">Thông tin shipper</h1>
            <table class="table_deg">
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Số điện thoại</th>
                    <th>Action</th>
                </tr>

                @forelse($shippers as $shipper)
                    <tr>
                        <td>{{$shipper->name}}</td>
                        <td>{{$shipper->email}}</td>
                        <td>{{$shipper->phone}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="50">No data available</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>


    <!-- plugins:js -->
    @include('admin.script')
    <!-- End custom js for this page -->
</body>
</html>

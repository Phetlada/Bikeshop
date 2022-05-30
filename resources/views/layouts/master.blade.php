<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=devices-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title @yield("title","BikeShop | จำหน่สยอะไหล่จักรยานออนไลน์")>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{ asset('js/angular.min.js')}}"></script>

</head>

<body>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/toastr/toastr.min.js') }}"></script>
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">BikeShop</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">        
                <ul class="nav navbar-nav">       
                    <li><a href="{{ URL::to('home') }}">หน้าแรก</a></li>@guest
                    @else
                    <li><a href="{{ URL::to('product') }}">ข้อมูลสินค้า </a></li>
                    <li><a href="#">รายงาน</a></li> @endguest
                </ul>            
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><i class="fa fa-shopping-cart"></i> ตะกร้า 
                        <span class="label label-danger"></span></a></li> @guest
                        <li><a href="{{ route('login') }}">ล็อกอิน</a></li>
                        <li><a href="{{ route('register') }}">ลงทะเบียน</a></li> @else
                        <li><a href="#">{{ Auth::user()->name }} </a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault(); 
                        document.getElementById('logout-form').submit();">ออกจากระบบ </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                     @endguest
                   
                </ul>
            </div>
        </div>
    </nav>
    @yield('content')
    <!-- js -->
    @if(session('msg'))
        @if(session('ok'))
            <script>toastr.success("{{ session('msg') }}")</script>
        @else
            <script>toastr.error("{{ session('msg') }}")</script>
        @endif
    @endif
    {{-- <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong>หัวข้อ</strong>
                </div>
            </div>
            <div class="panel-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>รหัสสินค้า</th>
                            <th>ชื่อสินค้า</th>
                            <th>ราคาขาย</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>P001</td>
                            <td>ชุดจักรยาาน ขนาด XL</td>
                            <td>2500.00</td>
                        </tr>
                        <tr>
                            <td>P002</td>
                            <td>หมวกกันน็อก รุ่น</td>
                            <td>1500.00</td>
                        </tr>
                        <tr>
                            <td>P003</td>
                            <td>ชุดเกียร์ Shimano รุ่น SH-001</td>
                            <td>450.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <a href="#" class="btn btn-default"><i class="fas fa-home"></i> หน้าหลัก</a>
        <a href="#" class="btn btn-primary"><i class="fas fa-save"></i>บันทึก</a>
        <a href="#" class="btn btn-info"><i class="fas fa-edit"></i>แก้ไข</a>
        <a href="#" class="btn btn-danger"><i class="fas fa-trash"></i>ลบ</a>
    </div> --}}
    {{-- <script type="text/javascript">
        toastr.success('save')
        toastr.error('error')
    </script> --}}
</body>
</html>
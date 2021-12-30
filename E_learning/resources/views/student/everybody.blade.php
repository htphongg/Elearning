<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả thành viên</title>
    <link rel="stylesheet" href="../asset/css/everybody.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
</head>

<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <a href="{{ route('sv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id] )}}" class="main-title">{{ $lopHoc->ten_lop}}</a>
                <a href="{{ route('sv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id] )}}" class="sub-title">{{ $lopHoc->mo_ta}}</a>
            </div>
            <div class="route">
                <a href="{{ route('sv-chi-tiet-lop', ['lop_hoc_id' => $lopHoc->id] )}}">Bảng tin</a>
                <a href="{{ route('sv-cong-viec', ['lop_hoc_id' => $lopHoc->id] )}}">Bài tập trên lớp</a>
                <a href="{{ route('sv-moi-nguoi', ['lop_hoc_id' => $lopHoc->id] )}}">Mọi người</a>
            </div>
        </div>
        <!-- <div class="right">
            <div class="menu">
                <i class="fas fa-bars"></i>
            </div>
            <div class="account">
                <i class="far fa-user-circle"></i>
            </div>
        </div> -->
    </div>

    <!-- Drawer details -->
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('sv-trang-chu') }}">Lớp học</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-body-title">Đã đăng ký</div>
            <div class="dra-item">
                <i class="far fa-list-alt icon"></i>
                Việc cần làm
            </div>
            @foreach($dsLopDaVao as $lop)
                <div class="dra-item">
                    <div class="dra-item-avt icon">C</div>
                    <a href=" {{route('sv-chi-tiet-lop',['lop_hoc_id' => $lop->id])}} " class="dra-item-desc"> {{ $lop->ten_lop }} </a>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="far fa-save icon"></i>
                Lớp học đã lưu trữ
            </div>
            <div class="dra-item">
                <i class="fas fa-cog icon"></i>
                Cài đặt
            </div>
            <div class="dra-item">
                <i class="fas fa-user-circle icon"></i>
                <a href="{{route('sv-cap-nhat-thong-tin')}}">Cập nhật thông tin cá nhân</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-exchange-alt icon"></i>
                <a href="{{route('sv-doi-mat-khau')}}">Thay đổi mật khẩu</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{route('sv-dang-xuat')}}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <!-- End Drawer details -->

    <div id="container">
        <div class="wrap">
            <div class="post">
                <div class="post-name">Giảng viên</div>
                <!-- <div class="quantity">2 giảng viên</div> -->
            </div>
            <hr>
        </div>
        @foreach ($lopHoc->dsNguoiDung as $ngDung)
            @if($ngDung->loai_nguoi_dung_id == 2)
                <div class="wrap-ac">
                    <div class="account">
                        <div class="ac-avt"></div>
                        <div class="ac-name">{{ $ngDung->ho_ten }}</div>
                    </div>
                    <hr>
                </div>
            @endif
        @endforeach
        <div class="wrap">
            <div class="post">
                <div class="post-name">Sinh viên</div>
                <!-- <div class="quantity">5 sinh viên</div> -->
            </div>
            <hr>
        </div>
        @foreach ($lopHoc->dsNguoiDung as $ngDung)
            @if($ngDung->loai_nguoi_dung_id == 1)
                <div class="wrap-ac">
                    <div class="account">
                        <div class="ac-avt"></div>
                        <div class="ac-name">{{ $ngDung->ho_ten }}</div>
                    </div>
                <hr>
                </div>
            @endif
        @endforeach
    </div>

    <script src="../asset/js/style.js"></script>
</body>

</html>
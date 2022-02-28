<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="wispanh=device-wispanh, initial-scale=1.0">
    <title>Cập nhật thông tin sinh viên</title>
    <link rel="stylesheet" href="{{ asset('../asset/css/function-style-admin.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/fontawesome/css/all.css') }}">
</head>

<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="{{ asset('../asset/img/googlelogo_clr_74x24px.SVg') }}" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>
        <div class="right">

        </div>
    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('ad-trang-chu') }}">Trang Chủ</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-item">
                <div class="dra-item-avt icon">G</div>
                <a href="{{ route('ad-ds-giang-vien') }}">Giảng Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">S</div>
                <a href="{{ route('ad-ds-sinh-vien') }}">Sinh Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">L</div>
                <a href="">Lớp Học</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">B</div>
                <a href="{{ route('ad-ds-bai-dang') }}">Bài Đăng</a>
            </div>
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="fas fa-user-circle icon"></i>
                <a href="{{ route('ad-cap-nhat-thong-tin') }}">Cập nhật thông tin cá nhân</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-exchange-alt icon"></i>
                <a href="{{ route('ad-doi-mat-khau') }}">Thay đổi mật khẩu</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{ route('ad-dang-xuat') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="container">
        <div id="body">
            <div class="top"></div>
            <div class="content">
                <h1 class="text-center">Chi tiết</h1>
                <hr />
                <div>
                    <dl class="row">
                        <span class="col-sm-2">
                            Mã lớp
                        </span>
                        <span class="col-sm-10">
                            {{ $chitietlop->ma_lop }}
                        </span>
                        <span class="col-sm-2">
                            Tên lớp
                        </span>
                        <span class="col-sm-10">
                            {{ $chitietlop->ten_lop }}
                        </span>
                        <span class="col-sm-2">
                            Mô tả
                        </span>
                        <span class="col-sm-10">
                            {{ $chitietlop->mo_ta }}
                        </span>
                        <span class="col-sm-2">
                            Ngày tạo
                        </span>
                        <span class="col-sm-10">
                            {{ Date_format(new Datetime($chitietlop->created_at), 'H:i:A d-m-Y') }}
                        </span>

                    </dl>
                </div>
                <a href="{{ route('ad-ds-lop') }}" class="btn btn-danger">Quay lại</a>
            </div>
        </div>
        <div id="footer"></div>
    </div>
    <script src="{{ asset('../asset/js/style.js') }}"></script>
</body>

</html>

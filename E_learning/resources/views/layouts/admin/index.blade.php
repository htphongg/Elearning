<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
    <link rel="stylesheet" href="../asset/css/style.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="../asset/img/googlelogo_clr_74x24px.svg" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>

    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('trang-chu-admin') }}">Trang Chủ</a>
            </div>

        </div>
        <hr>
        <div class="dra-body">

            <div class="dra-item">
                <div class="dra-item-avt icon">G</div>
                <a href="{{ route('ds_giang_vien') }}">Giảng Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">S</div>
                <a href="">Sinh Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">L</div>
                <a href="">Lớp Học</a>
            </div>

            <hr>
            <div class="dra-footer">

                <div class="dra-item">
                    <i class="fas fa-exchange-alt icon"></i>
                    <a href="{{ route('doi-mat-khau') }}">Thay đổi mật khẩu</a>
                </div>
                <div class="dra-item">
                    <i class="fas fa-sign-out-alt icon"></i>
                    <a href="{{ route('dang-xuat') }}">Đăng xuất</a>
                </div>
            </div>
        </div>


        <script src="../asset/js/style.js"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
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
        <div class="right">
            <div class="create-class mr-5 ">
                <a href="{{ route('gv-tao-lop') }}"><i class="fas fa-plus text-dark"></i></a>
            </div>
        </div>
    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="../teacher/index.html">Lớp học</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-body-title">Giảng dạy</div>
            <div class="dra-item">
                <i class="far fa-list-alt icon"></i>
                Để đánh giá
            </div>
            @foreach($dsLop as $lop)
                <div class="dra-item">
                    <div class="dra-item-avt icon">C</div>
                    {{ $lop->ten_lop }}
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
                <a href="{{route('gv-cap-nhat-thong-tin')}}">Cập nhật thông tin cá nhân</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-exchange-alt icon"></i>
                <a href="{{route('gv-doi-mat-khau')}}">Thay đổi mật khẩu</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{route('gv-dang-xuat')}}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="container">      
        <div id="body">
            <div class="top">
                <div class="work">
                    <i class="far fa-list-alt"></i>
                    <span>Để đánh giá</span>
                </div>
                <div class="calender">
                    <i class="far fa-calendar-check"></i>
                    <span>Lịch</span>
                </div>
            </div>
            <div class="content row ">
               @foreach($dsLop as $lop)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="left">
                                    <a class="title" href="{{ route('gv-chi-tiet-lop') }}">{{ $lop->ten_lop }}</a>
                                    <a class="subtitle" href="#">{{ $lop->mo_ta }}</a>
                                </div>
                                <div class="right">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                                <div class="avt">

                                </div>
                            </div>
                            <div class="card-body"></div>
                            <div class="card-footer">
                                <i class="fas fa-briefcase"></i>
                                <i class="far fa-folder"></i>
                            </div>
                        </div>
                    </div>
               @endforeach
            </div>
        </div>
        <div id="footer"></div>
    </div>
    <script src="../asset/js/style.js"></script>
</body>
</html>
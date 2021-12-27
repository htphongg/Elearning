<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{  $lopHoc->ten_lop }}</title>
    <link rel="stylesheet" href="../asset/css/class.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>
<body>

    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}" class="main-title">{{ $lopHoc->ten_lop }}</a>
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}"class="sub-title">{{ $lopHoc->mo_ta }}</a>
            </div>
            <div class="route">
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}">Bảng tin</a>
                <a href="{{route('gv-cong-viec',['lop_hoc_id' => $lopHoc->id]) }}">Bài tập trên lớp</a>
                <a href="{{route('gv-moi-nguoi',['lop_hoc_id' => $lopHoc->id]) }}">Mọi người</a>
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}">Số điểm</a>
            </div>
        </div>
    </div>

    <!-- Drawer details --> 
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('gv-trang-chu') }}">Lớp học</a>
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
                    <a href="{{ route('gv-chi-tiet-lop',['lop_hoc_id' => $lop->id]) }}"> {{ $lop->ten_lop }}</a>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="far fa-save icon"></i>
                <a href="{{ route('gv-ds-lop-luu-tru') }}">Lớp học đã lưu trữ</a>
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
    <!-- End Drawer details -->

    <div id="container">
        <div id="body">
            <div class="content">
                <div class="title">
                    <span class="subject-name">{{ $lopHoc->ten_lop }}</span>
                    <span class="desc">{{ $lopHoc->mo_ta }}</span>
                    <div class="dropdown menu">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                            Tùy chỉnh
                        </button>
                    </div>
                </div>
                <div class="main-content">
                    <div class="left">
                        <div class="meetting">
                            <div class="link">
                                <div class="logo">
                                    <img src="../asset/img/logomeet.png" alt="Logo Meet">
                                    <span>Meet</span>
                                </div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="button">
                                <span>Tham gia</span>
                            </div>
                        </div>
                        <div class="pathclass">
                            <div class="link">
                                <div class="code">
                                    <span>Mã lớp</span>
                                </div>
                                <i class="fas fa-ellipsis-v"></i>
                            </div>
                            <div class="text">
                                <span>{{ $lopHoc->ma_lop }}</span>
                                <a href="#"><i class="fas fa-lg fa-expand"></i></a>
                            </div>
                        </div>
                        <div class="deadline">
                            <span class="deadline-title">Sắp đến hạn</span>
                            <span class="deadline-content">Tuyệt vời, không có bài tập nào sắp đến hạn!</span>
                            <a href="#">Xem tất cả</a>
                        </div>
                    </div>
                    <div class="right">
                        <div class="post-noti">
                            <div class="post-noti-avt"></div>
                            <a href="#">Thông báo nội dung nào đó cho lớp học của bạn</a>
                            <!-- <a href="#"><i class="fas fa-lg fa-retweet"></i></a> -->
                        </div>
                        <div class="post">
                            
                        </div>
                    </div>                   
                </div>
            </div>
        </div>
        <div id="footer">
            
        </div>
    </div>

    <script src="../asset/js/style.js"></script>
</body>
</html>
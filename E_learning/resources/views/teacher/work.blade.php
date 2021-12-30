<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập</title>
    <link rel="stylesheet" href="../asset/css/work.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">  
</head>
<body>
    <!-- Header -->
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
    <!-- End Header -->

    <!-- Drawer details --> 
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{route('gv-trang-chu')}}">Lớp học</a>
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
    
    <!-- Body -->
    <div id="container">
        <div id="sidebar">
            <div class="topic-title">
                Tất cả chủ đề
            </div>
            <div class="topic">
                Thông báo
            </div>
            <div class="topic">
                Tài liệu
            </div>
            <div class="topic">
                Bài tập
            </div>
        </div>
        <div id="content">
            <!-- Navigation -->
            <div class="navbar">
                <div class="nav-left"> 
                    <a href="{{ route('gv-dang-bai') }}"  class="btn btn-primary"><i class="fas fa-plus"></i>Tạo</a>
                </div>
                <div class="nav-right">
                    <a href="#"><i class="far fa-calendar"></i> Lịch Google</a>
                    <a href="#"><i class="fab fa-google-drive"></i> Thư mục Drive của lớp học</a>
                </div>
            </div>
            <!-- End Navigation -->

            <!-- Post -->
            <div class="post-title">
                <div class="wrap">
                    <span>Thông báo</span>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Danh sách nhóm đồ án môn học</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đã đăng vào 11 thg 11
                    </div>
                     <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Đăng ký đồ án LT Web PHP Nâng Cao</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đã đăng vào 1 thg 11
                    </div>
                     <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <!-- End Example -->
            <div class="post-title">
                <div class="wrap">
                    <span>Tài liệu</span>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Bài 1: Giới thiệu Laravel Framework</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đã đăng vào 27 thg 9
                    </div>
                    <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <!-- End Example -->
            <div class="post-title">
                <div class="wrap">
                    <span>Bài tập</span>
                    <i class="fas fa-ellipsis-v"></i>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Bài tập 1: Cài đặt môi trường phát triển</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đến hạn 23:59, 27 thg 9
                    </div>
                    <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Bài tập 1: Cài đặt môi trường phát triển</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đến hạn 23:59, 27 thg 9
                    </div>
                    <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Bài tập 1: Cài đặt môi trường phát triển</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đến hạn 23:59, 27 thg 9
                    </div>
                    <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <div class="example">
                <div class="ex-left">
                    <div class="ex-avt">
                        <i class="far fa-bookmark"></i>
                    </div>
                    <div class="ex-title">Bài tập 1: Cài đặt môi trường phát triển</div>
                </div>
                <div class="ex-right">
                    <div class="ex-date-up">
                        Đến hạn 23:59, 27 thg 9
                    </div>
                    <div class="ex-more-if">
                        <i class="fas fa-ellipsis-v"></i>
                    </div>
                </div>
            </div>
            <!-- End Example -->
            
            <!-- End Post -->        
        </div>
    </div>
    
    <script src="../asset/js/style.js"></script>
</body>
</html>
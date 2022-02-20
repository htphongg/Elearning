
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
            <div class="addclass">
                <a href="{{ route('sv-tham-gia-lop') }}"><i class="fas fa-plus mr-2"></i>Tham gia lớp học</a>
            </div>
        </div>
    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{route('sv-trang-chu')}}">Lớp học</a>
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
    <div id="container">
        <div id="body">
            <div class="top">
                <div class="work">
                    <i class="far fa-list-alt"></i>
                    <span>Việc cần làm</span>
                </div>
                <div class="calender">
                    <i class="far fa-calendar-check"></i>
                    <span>Lịch</span>
                </div>
            </div>
            <div class="content row ">
                @foreach($dsLopDaVao as $lop)
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <div class="left">
                                    <a class="title" href="{{ route('sv-chi-tiet-lop',['lop_hoc_id' => $lop->id]) }}">{{ $lop->ten_lop }}</a>
                                    <a class="subtitle" href="#"> {{ $lop->mo_ta}} </a>
                                    <a href="#">
                                      <!-- Hiển thị tên giảng viên -->
                                    </a>
                                </div>
                                <div class="right">
                                    <i class="fas fa-ellipsis-v"></i>
                                </div>
                                <div class="avt">
                                </div>
                            </div>
                            <div class="card-body"></div>
                            <div class="card-footer">
                                <a href="{{ route('sv-roi-lop',['lop_hoc_id' => $lop->id ]) }}" onClick="return confirm('Bạn có chắc muốn rời khỏi lớp học này?')" ><i class="far fa-trash-alt text-dark"></i></a>
                                <i class="fas fa-briefcase"></i>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div id="toast"></div>
        <div id="footer"></div>
    </div>
    <script src="../asset/js/showNoti.js"></script>
    <script>
            if( {{ Session::has('success') }} )
            {
                showSuccessToast( 'Thành công',"{{ Session::get('success') }} ");
            }
            
        </script>
        <script>
            if( {{ Session::has('error') }} )
            {
                showErrorToast( 'Lỗi',"{{ Session::get('error') }}");
            }   
        </script>
    <script src="../asset/js/login.js"></script>
    <script src="../asset/js/style.js"></script>
</body>
</html>


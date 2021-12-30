<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phòng chờ</title>
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
            <a class="btn btn-info mr-5" href="{{ route('gv-moi-nguoi',['lop_hoc_id' => $lopHoc->id]) }}">Quay lại</a>
        </div> 
    </div>
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
    <div id="container">   
        <div class="ds-sv">
            <h2 class="text-center">Danh sách sinh viên đang chờ duyệt</h2>   
            <table class="table table-bordered mt-3 text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Họ tên</th>
                        <th>Email</th>
                        <th>Loại người dùng</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lopHoc->dsNguoiDung as $ngDung)
                       @if($ngDung->pivot->trang_thai == 0)
                            <tr>
                                <td>{{ $ngDung->ho_ten}}</td>
                                <td>{{ $ngDung->email}}</td>
                                <td>{{ $ngDung->loaiNguoiDung->ten_loai}}</td>
                                <td>
                                    <a href="{{ route('gv-xl-phong-cho-lop-hoc',['lop_id' => $lopHoc->id, 'ngd_id' => $ngDung->id, 'tacvu' => 't' ]) }}" class="btn btn-success">Chấp nhận</a>
                                    <a href="{{ route('gv-xl-phong-cho-lop-hoc',['lop_id' => $lopHoc->id, 'ngd_id' => $ngDung->id, 'tacvu' => 'x' ]) }}" class="btn btn-danger">Xoá</a>
                                </td>
                            </tr>
                       @endif
                   @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="toast"></div>
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
    <script src="../asset/js/style.js"></script>
</body>
</html>


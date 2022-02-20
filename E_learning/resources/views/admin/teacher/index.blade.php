<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách giảng viên</title>
    <link rel="stylesheet" href="../asset/css/style-admin.css">
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
                <img src="../asset/img/googlelogo_clr_74x24px.GVg" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>
        <div class="right">
            <div class="addclass">
                <a href="{{ route('ad-them-moi-gv') }}"><i class="fas fa-plus"></i></a>
            </div>
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
                <a href="{{ route('ad-ds-lop') }}">Lớp Học</a>
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
    <!-- <div id="line">
    </div> -->
    <div id="container">
        <div id="body">
            <div class="top">

            </div>
            <div class="content">
                <h2 class="text-center mt-3 mb-3 mt-5">Danh Sách Giảng Viên</h2>
                <table class="table text-center table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Tên đăng nhập</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsGV as $GV)
                            <tr>
                                <td>{{ $GV->ho_ten }}</td>
                                <td>{{ Date_format(new Datetime($GV->ngay_sinh), 'd-m-Y') }}</td>
                                <td>{{ $GV->gioi_tinh }}</td>
                                <td>{{ $GV->dia_chi }}</td>
                                <td>{{ $GV->sdt }}</td>
                                <td>{{ $GV->email }}</td>
                                <td>{{ $GV->ten_dang_nhap }}</td>
                                <td>
                                    <a class="btn btn-success"
                                        href="{{ route('ad-cap-nhat-gv', ['id' => $GV->id]) }}">Sửa</a>
                                    <a class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')"
                                        href="{{ route('ad-xoa-bo-gv', ['id' => $GV->id]) }}">Xóa</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div id="footer">

        </div>
    </div>

    <script src="../asset/js/style.js"></script>
</body>

</html>

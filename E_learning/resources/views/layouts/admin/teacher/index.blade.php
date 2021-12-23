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
        <div class="right">
            <div class="addclass">
                <a href="{{ route('them_moi') }}"><i class="fas fa-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('trang-chu-admin') }}">Trang Chủ</a>
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
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{ route('dang-xuat') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="line">
        <hr>
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
            <div class="content">
                <h1>Danh Sách Giảng Viên</h1>
                <Table class="table">
                    <thead>
                        <tr>
                            <th>Họ tên</th>
                            <th>Ngày sinh</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                            <th>Tên đăng nhập</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsGV as $GV)
                            <tr>
                                <td>{{ $GV->ho_ten }}</td>
                                <td>{{ $GV->ngay_sinh }}</td>
                                <td>{{ $GV->gioi_tinh }}</td>
                                <td>{{ $GV->dia_chi }}</td>
                                <td>{{ $GV->sdt }}</td>
                                <td>{{ $GV->email }}</td>
                                <td>{{ $GV->ten_dang_nhap }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </Table>

            </div>
        </div>

        <div id="footer">

        </div>
    </div>

    <script src="../asset/js/style.js"></script>
</body>

</html>

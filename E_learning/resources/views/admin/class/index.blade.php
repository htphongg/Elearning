<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
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
                <img src="../asset/img/googlelogo_clr_74x24px.svg" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>
        <div class="right">
            <div class="addclass">
                <a href="{{ route('ad-them-moi-lh') }}"><i class="fas fa-plus"></i></a>
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
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{ route('ad-dang-xuat') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="line">
        <hr>
    </div>
    <div id="container">
        <div id="body">
            <div class="top">
            </div>
            <div class="content">
                <h1>Danh Sách Lớp</h1>
                <Table class="table">
                    <thead>
                        <tr>
                            <th>Mã lớp</th>
                            <th>Tên lớp</th>
                            <th>Mô tả</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dsLH as $LH)
                            <tr>
                                <td>{{ $LH->ma_lop }}</td>
                                <td>{{ $LH->ten_lop }}</td>
                                <td>{{ $LH->mo_ta }}</td>
                                <td>
                                    <a href="{{ route('ad-cap-nhat-lh', ['id' => $LH->id]) }}">Sửa</a> |
                                    <a href="{{ route('ad-xoa-bo-lh', ['id' => $LH->id]) }}">Xóa</a>
                                </td>

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

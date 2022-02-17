<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới lớp</title>
    <link rel="stylesheet" href="../asset/css/function-style-admin.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="header">
        <div id="header">
            <div class="left">
                <div class="drawer js-drawer">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="logo">
                    <img src="/asset/img/googlelogo_clr_74x24px.svg" alt="">
                </div>
                <span class="webname">Lớp học</span>
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
    <!-- <div id="line">
        <hr>
    </div> -->
    <div id="container">
        <div id="body">
            <div class="top"> </div>
            <div class="content">
                <h1 class="text-center">Thêm mới lớp</h1>
                <form action="{{ route('ad-xl-them-moi-lh') }}" class="was-validated" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="code">Mã lớp:</label>
                        <input type="text" class="form-control" value="{{ Str::random(6) }}" name="ma_lop" required
                            disabled>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="name">Tên lớp:</label>
                        <input type="text" class="form-control" placeholder="Tên lớp" name="ten_lop" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="description">Mô tả:</label>
                        <input type="text" class="form-control" placeholder="Mô tả" name="mo_ta" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>

                    <div class="btn-sub">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="{{ route('ad-ds-lop') }}" class="btn btn-danger">Quay lại</a>
                    </div>

                </form>
            </div>
        </div>
        <div id="footer"> </div>
    </div>
    <script src="../asset/js/style.js"></script>
</body>

</html>

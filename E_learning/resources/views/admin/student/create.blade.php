<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
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
                    <img src="../asset/img/googlelogo_clr_74x24px.svg" alt="">
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
                <a href="{{ route('ad-dang-xuat') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <div id="container">
        <div id="body">
            <div class="top">
            </div>
            <div class="content">
                <h1 class="text-center">Thêm mới sinh viên</h1>
                <form action="{{ route('ad-xl-them-moi-sv') }}" class="was-validated" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="uname">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="uname" placeholder="Tên đăng nhập"
                            name="ten_dang_nhap" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mật khẩu:</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Mật khẩu" name="password"
                            required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" class="form-control" id="name" placeholder="Họ tên" name="ho_ten" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày Sinh:</label>
                        <input type="date" class="form-control" id="date" name="ngay_sinh" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="date">Giới tính:</label>
                        <br>
                        <input type="radio" class="" id="gender" name="gioi_tinh" value="Nam" checked> Nam
                        <input type="radio" class="" id="gender" name="gioi_tinh" value="Nữ"> Nữ
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="dia_chi" placeholder="địa chỉ"
                            required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" maxlength="10" name="sdt"
                            placeholder="Số điện thoại" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="btn-sub">
                        <button type="submit" class="btn btn-primary">Thêm</button>
                        <a href="{{ route('ad-ds-sinh-vien') }}" class="btn btn-danger">Quay lại</a>
                    </div>
                </form>
            </div>
        </div> <div id="footer">
        </div>
    </div>
    <script src="../asset/js/style.js"></script>
</body>
</html>

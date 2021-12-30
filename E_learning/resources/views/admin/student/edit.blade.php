<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classroom</title>
    <link rel="stylesheet" href="/asset/css/function-style-admin.css">
    <link rel="stylesheet" href="/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="../asset/img/googlelogo_clr_74x24px.SVg" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>
        <div class="right">

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
                <h1>Cập nhật giảng viên</h1>
                <form action="{{ route('ad-xl-cap-nhat-sv', ['id' => $dsSV->id]) }}" class="was-validated"
                    method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="uname">Tên đăng nhập:</label>
                        <input type="text" class="form-control" id="uname" placeholder="Tên đăng nhập"
                            name="ten_dang_nhap" value="{{ $dsSV->ten_dang_nhap }}" readonly>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ tên:</label>
                        <input type="text" class="form-control" id="name" placeholder="Họ tên" name="ho_ten"
                            value="{{ $dsSV->ho_ten }}" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="date">Ngày Sinh:</label>
                        <input type="date" class="form-control" id="date" name="ngay_sinh"
                            value="{{ $dsSV->ngay_sinh }}" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="date">Giới tính:</label>
                        <br>
                        @if (strcasecmp($dsSV->gioi_tinh, 'Nam') == 0)
                            <input type="radio" id="gender" checked value="Nam" name="gioi_tinh"> Nam
                            <input type="radio" id="gender" value="Nữ" name="gioi_tinh"> Nữ
                        @elseif(strcasecmp($dsSV->gioi_tinh, 'Nữ') == 0)
                            <input type="radio" id="gender" value="Nam" name="gioi_tinh"> Nam
                            <input type="radio" id="gender" checked value="Nữ" name="gioi_tinh"> Nữ
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ:</label>
                        <input type="text" class="form-control" id="address" name="dia_chi"
                            value="{{ $dsSV->dia_chi }}" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại:</label>
                        <input type="text" class="form-control" id="phone" maxlength="10" name="sdt"
                            value="{{ $dsSV->sdt }}" required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $dsSV->email }}"
                            required>
                        <div class="valid-feedback">Valid.</div>
                        <div class="invalid-feedback">Please fill out this field.</div>
                    </div>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <a href="{{ route('ad-ds-sinh-vien') }}" class="btn btn-danger">Quay lại</a>
                </form>

            </div>
        </div>

        <div id="footer">

        </div>
    </div>

    <script src="../asset/js/style.js"></script>
</body>

</html>

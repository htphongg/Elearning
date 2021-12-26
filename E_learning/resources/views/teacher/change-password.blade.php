<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thay đổi mật khẩu</title>
    <link rel="stylesheet" href="../asset/css/update-infor.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>
<body>
    <div id="container">
        <h2>Form thay đổi mật khẩu</h2>
        <form action="{{route('gv-xl-doi-mat-khau')}}" class="was-validated" method="post">
            @csrf
            <input type="text" hidden name="nguoi_dung_id" value="{{$ngDung->id}}">
            <div class="form-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" class="form-control" value="{{$ngDung->ten_dang_nhap}}" readonly>
            </div>
            <div class="form-group">
                <label for="old-password">Xác nhận mật khẩu cũ:</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="old-password" placeholder="Nhập vào mật khẩu hiện tại" name="old_password" required>
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btnPasswordOld">
                        <span class="fas fa-eye"></span>
                    </button>
                    </div>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="new-password">Mật khẩu mới:</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="new-password" placeholder="Nhập vào mật khẩu mới" name="new_password" required>
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btnPasswordNew">
                        <span class="fas fa-eye"></span>
                    </button>
                    </div>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="cf-new-password">Xác nhận mật khẩu mới:</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="cf-new-password" placeholder="Xác nhận mật khẩu mới" name="cf_new_password" required>
                    <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="btnPasswordCf">
                        <span class="fas fa-eye"></span>
                    </button>
                    </div>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                </div>
            </div>
            <div class="container-btn">
                <button type="submit" class="btn btn-success">Lưu thông tin</button>
                <a href="{{route('gv-trang-chu')}}" class="btn btn-danger" >Quay về trang chủ</a>
            </div>
        </form>
    </div>
    <script src="../asset/js/change-password.js"></script>
</body>
</html>
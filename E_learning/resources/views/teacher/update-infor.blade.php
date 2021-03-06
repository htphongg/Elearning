<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật thông tin cá nhân</title>
    <link rel="stylesheet" href="../asset/css/update-infor.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>
<body>
    <div id="container">
        <h2>Form cập nhật thông tin cá nhân</h2>
        <form action="{{route('gv-xl-cap-nhat-thong-tin',['nguoi_dung_id' => $ngDung->id])}}" class="was-validated" method="post">
          @csrf
          <div class="form-group">
              <label for="role">Vai trò:</label>
              <input type="text" class="form-control" value="{{$ngDung->loaiNguoiDung->ten_loai}}" readonly>
          </div>
          <div class="form-group">
            <label for="uname">Họ tên:</label>
            <input type="text" class="form-control" value="{{$ngDung->ho_ten}}" readonly>
          </div>
          <div class="form-group">
            <label for="birthday">Ngày sinh:</label>
            <input type="date" class="form-control"  value="{{$ngDung->ngay_sinh}}" readonly>
          </div>
          <div class="form-group">
              <label for="sex">Giới tính:</label>
                  @if(strcasecmp($ngDung->gioi_tinh,'nam') == 0)
                    <div class="form-check-inline ml-3">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="sex" checked disabled readonly>Nam
                        </label>
                    </div> 
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="sex" disabled readonly>Nữ
                        </label>
                    </div> 
                  @else
                    <div class="form-check-inline ml-3">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="sex" disabled readonly>Nam
                        </label>
                    </div> 
                    <div class="form-check-inline">
                        <label class="form-check-label">
                          <input type="radio" class="form-check-input" name="sex" disabled checked readonly>Nữ
                        </label>
                    </div> 
                  @endif                      
          </div>
          <div class="form-group">
              <label for="address">Địa chỉ:</label>
              <input type="text" class="form-control" name="address" required value="{{$ngDung->dia_chi}}" >
              @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <div class="valid-feedback">Hợp lệ.</div>
              <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
          </div>
          <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" name="email" required value="{{$ngDung->email}}" >
              @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
              @enderror
              <div class="valid-feedback">Hợp lệ.</div>
              <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
          </div>
          <div class="container-btn">
            <button type="submit" class="btn btn-success">Lưu thông tin</button>
            <a href="{{route('gv-trang-chu')}}" class="btn btn-danger" >Quay về trang chủ</a>
          </div>
        </form>
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
</body>
</html>
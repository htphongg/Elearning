<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin lớp học</title>
    <link rel="stylesheet" href="../asset/css/edit-class.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="container">
        <h3 class="text-center">Cập nhật thông tin lớp học</h3>
        <form action="{{ route('gv-xl-chinh-sua-lop',['lop_hoc_id' =>  $lopHoc->id ]) }}" class="was-validated" method="post">
            @csrf
            <div class="form-group">
                <label >Tên lớp:</label>
                <input type="text" class="form-control" value="{{ $lopHoc->ten_lop }}" readonly>
            </div>
            <div class="form-group">
                <label for="mo_ta">Mô tả:</label>
                <input type="text" class="form-control" placeholder="Nhập vào mô tả" value="{{ $lopHoc->mo_ta }}" name="mo_ta" required>
                <div class="valid-feedback">Hợp lệ.</div>
                <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
            </div>
            <div class="btn-create">
                <button type="submit" class="btn btn-primary">Cập nhật</button>
                <a type="button" href="{{ route('gv-trang-chu') }}"  class="btn btn-danger">Quay về trang chủ</a>
            </div>
        </form>
    </div>
    <div id="toast"></div>
    <script src="../asset/js/showNoti.js"></script>
    <script>
        if( {{ Session::has('error') }} )
        {
            showErrorToast( 'Lỗi',"{{ Session::get('error') }}");
        }
     </script>
</body>
</html>
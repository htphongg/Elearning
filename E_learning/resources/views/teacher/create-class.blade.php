<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tạo lớp học</title>
        <link rel="stylesheet" href="../asset/css/create-class.css">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    </head>
    <body>
        <div id="container">
            <div class="create-class">
                <h1 class="text-center">Tạo lớp học</h1>
                <form action="{{ route('gv-xl-tao-lop') }}" class="was-validated" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="ten-lop">Tên lớp:</label>
                        <input type="text" class="form-control" placeholder="Nhập vào tên lớp" name="ten_lop" required>
                        <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Hãy điền vào trường này.</div>
                    </div>
                    <div class="form-group">
                        <label for="mo-ta">Mô tả:</label>
                        <input type="text" class="form-control" placeholder="Nhập vào mô tả" name="mo_ta">
                    </div>        
                    <div class="btn-create">
                        <button type="submit" class="btn btn-primary">Tạo lớp học</button>
                        <a type="button" href="{{ route('gv-trang-chu') }}"  class="btn btn-danger">Quay về trang chủ</a>
                    </div>      
                </form>
            </div>
        </div>
    </body>
</html>
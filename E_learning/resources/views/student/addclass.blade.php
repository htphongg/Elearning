<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm lớp</title>
    <link rel="stylesheet" href="../asset/css/addclass.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="container">
        <div id="addclass">
            <form action="{{route('sv-xl-tham-gia-lop')}}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Mã lớp" required name="codeclass">
                </div>
                <button class="button" type="submit">Tham gia</button>
                <div class="instructions"> Cách đăng nhập bằng mã lớp học:</div>
                <ul>
                    <li>Sử dụng tài khoản được cấp phép</li>
                    <li>Sử dụng mã lớp học gồm 6 chữ cái hoặc số, không có dấu cách hoặc ký hiệu</li>
                </ul>
            </form>
        </div>
    </div>
</body>

</html>
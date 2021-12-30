<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng bài</title>
    <link rel="stylesheet" href="{{ asset('asset/css/create-post.css') }}">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>
<body>
    <div id="container">
        <h2 class="text-center mb-4">Form đăng bài</h2>
        <form action="#">
            <div class="row">
                <div class="form-group">
                    <div class="col">
                        <label>Loại bài đăng:</label>
                        <select id="cars">
                            <option value="">Tài liệu</option>
                            <option value="">Bài tập</option>
                            <option value="">Bài kiểm tra</option>
                            <option value="">Thông báo</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <!-- <label for="pwd">Password:</label>                   
                    <input type="password" class="form-control" placeholder="Enter password" name="pswd"> -->
                </div>
            </div>    
            <div class="form-group">
                <label >Tiêu đề:</label>
                <input type="text" class="form-control" placeholder="Nhập vào tiêu đề">
            </div>
            <div class="form-group">
                <label >Nội dung:</label>
                <input type="text" class="form-control" placeholder="Nhập vào nội dung">
            </div>
            <div class="form-group">
                <label >Tệp đính kèm:</label>
                <input type="file" class="form-control">
            </div>
            <div class="btn-submit text-center mt-5">
                <button type="submit" class="btn btn-primary">Đăng bài</button>
            </div>
        </form>
    </div>
</body>
</html>
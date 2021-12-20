<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../asset/css/login.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>
<body>
   <div id="container">
        <div id="login">
           <div class="header">
                <div class="avt">
                    <i class="far fa-user"></i>
                </div>
           </div>
           <div class="text-center">Sign In</div>
            <form action="{{ route('DangNhap') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tên đăng nhập" required name="ten_dang_nhap">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Password" required name="password">
                </div>
                <button  class="button" type="submit">Login</button>
                <!-- <a class="button" href="./student/index.html" type="submit">Login</a> -->
            </form>
            <div class="footer">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label text-primary" for="flexCheckChecked">
                      Remember Me
                    </label>
                </div>
                <div class="forgot-pass text-primary">
                    <a href="/layouts/login/forgot-password.html">Forgot password?</a>
                </div>  
            </div>
        </div>
   </div>
</body>
</html>
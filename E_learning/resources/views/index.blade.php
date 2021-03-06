<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
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
           <div class="text-center">Đăng nhập</div>
            <form action="{{route('xl-dang-nhap')}}" method="post">
                @csrf
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Tên đăng nhập"  required id="username" name="username">
                    @error('username')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group"> 
                    <input type="password" class="form-control" placeholder="Mật khẩu" required id="password" name="password">
                    @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button  class="button" id="js-btnDangNhap" type="submit">Đăng nhập</button>
            </form>
            <div class="footer">
                <div></div>
                <div class="forgot-pass text-primary">
                    <a href="{{route('quen-mat-khau')}}">Quên mật khẩu?</a>
                </div>  
            </div>
        </div>
        <div id="toast"></div>
   </div>
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
   <script src="../asset/js/login.js"></script>
</body>
</html>
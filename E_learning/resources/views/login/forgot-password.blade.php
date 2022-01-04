<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../asset/css/forgot-password.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
</head>
<body>
    <div class="container padding-bottom-3x mb-2 mt-5">
	    <div class="row justify-content-center">
	        <div class="col-lg-8 col-md-10">
	            <div class="forgot">
	                <h2>Quên mật khẩu của bạn?</h2>
	                <p>Thay đổi mật khẩu của bạn với 3 bước đơn giản. Điều này sẽ giúp bạn bảo mật mật khẩu của mình!</p>
	                <ol class="list-unstyled">
	                    <li><span class="text-primary text-medium">1. </span>Nhập địa chỉ email của bạn dưới đây.</li>
	                    <li><span class="text-primary text-medium">2. </span>Hệ thống của chúng tôi sẽ gửi cho bạn một liên kết tạm thời.</li>
	                    <li><span class="text-primary text-medium">3. </span>Sử dụng liên kết để đặt lại mật khẩu của bạn</li>
	                </ol>
	            </div>
	            <form action="{{ route('xl-quen-mat-khau') }}" class="card mt-4" method="post">
					@csrf
	                <div class="card-body">
	                    <div class="form-group"> 
                            <label for="email_for_pass">Nhập địa chỉ Email của bạn.</label> 
                            <input class="form-control" type="text" name="email_for_pass" required>
                            <small class="form-text text-muted">Nhập địa chỉ email bạn đã sử dụng trong quá trình đăng ký trên E-learning. Sau đó, chúng tôi sẽ gửi một liên kết đến địa chỉ email này.</small> 
                        </div>
	                </div>
	                <div class="card-footer"> 
                        <button class="btn btn-success" type="submit">Nhận liên kết</button> 
                        <a href="{{route('dang-nhap')}}" class="btn btn-danger">Quay về trang đăng nhập</a> 
                    </div>
	            </form>
	        </div>
	    </div>
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
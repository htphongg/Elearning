<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mời tham gia</title>
        <link rel="stylesheet" href="../asset/css/create-class.css">
        <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    </head>
    <body>
        <div id="container">
            <div class="create-class">
                <h1 class="text-center">Gửi mail</h1>
                <form action="{{ route('gv-xl-moi-tham-gia',['lop_hoc_id' => $lop_hoc_id]) }}" class="was-validated" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="email">Nhập email:</label>
                        <input type="email" class="form-control" placeholder="Nhập vào email" name="email" required>
                        <div class="valid-feedback">Hợp lệ.</div>
                            <div class="invalid-feedback">Hãy điền vào trường này.</div>
                    </div>       
                    <div class="btn-create">
                        <button type="submit" class="btn btn-primary">Mời</button>
                        <a type="button" href="{{ route('gv-moi-nguoi',['lop_hoc_id' => $lop_hoc_id]) }}"  class="btn btn-danger">Quay lại</a>
                    </div>      
                </form>
            </div>
        </div>
    <div id="toast"></div>
    </body>
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
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa thông tin bài đăng</title>
    <link rel="stylesheet" href="{{ asset('/asset/css/edit-post.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/fontawesome/css/all.css') }}">
</head>

<body>
    <div id="container">
        <h3 class="text-center">Chỉnh sửa bài viết </h3>
        <form action="{{ route('gv-xl-chinh-sua-bai-dang',['id' => $baiDang->id, 'lop_hoc_id' => $baiDang->lop_hoc_id]) }}" class="was-validated" method="post">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label>Loại bài đăng:</label>
                        <input type="text" class="form-control" value="{{ $baiDang->loaiBaiDang->ten_loai }}" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label >Hạn nộp:</label>
                        @if(strcasecmp($baiDang->loaiBaiDang->ten_loai,'Bài tập') == 0)
                            <input type="datetime-local" class="form-control" name="deadline">
                        @else
                            <input type="datetime-local" class="form-control" name="deadline" disabled>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label >Tiêu đề</label>
                <input type="text" class="form-control" value="{{ $baiDang->tieu_de }}" name="tieu_de" required >
                <div class="valid-feedback">Hợp lệ.</div>
                <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
            </div>
            <div class="form-group">
                <label >Nội dung</label>
                <input type="text" class="form-control" value="{{ $baiDang->noi_dung }}" name="noi_dung" required>  
                <div class="valid-feedback">Hợp lệ.</div>
                <div class="invalid-feedback">Vui lòng điền vào trường này.</div>            
            </div>
            <div class="form-group">
                <label >Tệp đính kèm:</label>
                <input type="file" class="form-control" name="dinh_kem">
            </div>
            <div class="btn-create">
                <button type="submit" class="btn btn-primary">Lưu chỉnh sửa</button>
                <a type="button" href="{{route('gv-cong-viec',['lop_hoc_id' => $baiDang->lop_hoc_id]) }}"  class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    </div>
    <div id="toast"></div>
    <script src="{{ asset('asset/js/showNoti.js') }}"></script>
    <script>
        if( {{ Session::has('error') }} )
        {
            showErrorToast( 'Lỗi',"{{ Session::get('error') }}");
        }
     </script>
</body>
</html>
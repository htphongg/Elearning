<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng bài</title>
    <link rel="stylesheet" href="{{ asset('asset/css/create-post.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="container">
        <h2 class="text-center mb-4">Form đăng bài</h2>
        <form action="{{ route('gv-xl-dang-bai', ['lop_hoc_id' => $lop_hoc_id]) }}" class="was-validated" method="post"
            enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="form-group">
                    <div class="col mr-5">
                        <label>Loại bài đăng:</label><br>
                        <select name="loai_bai_dang">
                            <option value="Tài liệu">Tài liệu</option>
                            <option value="Bài tập">Bài tập</option>
                            <option value="Thông báo">Thông báo</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <label>Hạn nộp:</label>
                    <input type="datetime-local" class="form-control" name="deadline">
                </div>
            </div>
            <div class="form-group">
                <label>Tiêu đề:</label>
                <input type="text" class="form-control" placeholder="Nhập vào tiêu đề" name="tieu_de" required>
                <div class="valid-feedback">Hợp lệ.</div>
                <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
            </div>
            <div class="form-group">
                <label>Nội dung:</label>
                <input type="text" class="form-control" placeholder="Nhập vào nội dung" name="noi_dung" required>
                <div class="valid-feedback">Hợp lệ.</div>
                <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
            </div>
            <div class="form-group">
                <label>Tệp đính kèm:</label>
                <input type="file" class="form-control" name="dinh_kem">
            </div>
            <div class="btn-submit text-center mt-5">
                <button type="submit" class="btn btn-primary">Đăng bài</button>
                <a href="{{ route('gv-cong-viec', ['lop_hoc_id' => $lop_hoc_id]) }}" class="btn btn-danger">Quay lại</a>
            </div>
        </form>
    </div>
    <div id="toast"></div>
</body>
<script src="../asset/js/showNoti.js"></script>
<script>
    if ({{ Session::has('success') }}) {
        showSuccessToast('Thành công', "{{ Session::get('success') }} ");
    }
</script>
<script>
    if ({{ Session::has('error') }}) {
        showErrorToast('Lỗi', "{{ Session::get('error') }}");
    }
</script>

</html>

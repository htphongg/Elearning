<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách lớp</title>
    <link rel="stylesheet" href="../asset/css/style-admin.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
</head>

<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="logo">
                <img src="../asset/img/googlelogo_clr_74x24px.svg" alt="">
            </div>
            <span class="webname">Lớp học</span>
        </div>
        <div class="right">

        </div>
    </div>
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('ad-trang-chu') }}">Trang Chủ</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-item">
                <div class="dra-item-avt icon">G</div>
                <a href="{{ route('ad-ds-giang-vien') }}">Giảng Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">S</div>
                <a href="{{ route('ad-ds-sinh-vien') }}">Sinh Viên</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">L</div>
                <a href="{{ route('ad-ds-lop') }}">Lớp Học</a>
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">B</div>
                <a href="{{ route('ad-ds-bai-dang') }}">Bài Đăng</a>
            </div>
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="fas fa-user-circle icon"></i>
                <a href="{{ route('ad-cap-nhat-thong-tin') }}">Cập nhật thông tin cá nhân</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-exchange-alt icon"></i>
                <a href="{{ route('ad-doi-mat-khau') }}">Thay đổi mật khẩu</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{ route('ad-dang-xuat') }}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <!-- <div id="line">
        <hr>
    </div> -->
    <div id="container">
        <div id="body">
            <div class="top"> </div>
            <div class="content">
                <h2 class="mb-3 text-center mt-5">Danh Sách Lớp</h2>
                <form action="{{ route('ad-loc') }}" method="POST">
                    @csrf
                    <h6 class="title-dropdown1">Loại bài đăng:</h6>
                    <select name="loai_bai_dang" id="dropdown-type">
                        <option value="0">Tất cả</option>
                        @foreach ($ds_loai as $loaibaidang)
                            <option value="{{ $loaibaidang->id }}"
                                {{ $loaibaidang->id == $index_baidang ? 'selected' : '' }}>
                                {{ $loaibaidang->ten_loai }}</option>
                        @endforeach
                    </select>
                    <h6 class="title-dropdown2">Lớp:</h6>
                    <select name="lop_hoc" id="dropdown-class">
                        <option value="0" selected>Tất cả</option>
                        @foreach ($ds_baidang_cuaLop as $baidangcualop)
                            <option value="{{ $baidangcualop->id }}"
                                {{ $baidangcualop->id == $index_lophoc ? 'selected' : '' }}>
                                {{ $baidangcualop->ten_lop }}
                            </option>
                        @endforeach
                    </select>
                    <button id="btn-filter" type="submit" class="btn">Lọc</button>
                </form>
                <Table class="table text-center table-bordered">
                    <thead class="table-dark ">
                        <tr>
                            <th>Tiêu đề</th>
                            <th>Nội dung</th>
                            <th>Hạn nộp</th>
                            <th>Loại</th>
                            <th>Lớp</th>
                            <th>Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ds_baidang as $baidang)
                            <tr>
                                <td>{{ $baidang->tieu_de }}</td>
                                <td class="text-left">{{ substr($baidang->noi_dung, 0, 30) }}</td>
                                <td>
                                    @if ($baidang->han_nop != null)
                                        {{ Date_format(new Datetime($baidang->han_nop), 'H:i:A d-m-Y') }}
                                    @endif

                                </td>
                                <td>
                                    {{ $baidang->loaiBaiDang->ten_loai }}
                                </td>
                                <td>
                                    {{ $baidang->lopHoc->ten_lop }}
                                </td>
                                <td><a href="{{ route('ad-chi-tiet-bai-dang', ['id' => $baidang->id]) }}"
                                        class="btn btn-primary">Xem chi
                                        tiết</a>
                                    <a href="{{ route('ad-xoa-bo-bd', ['id' => $baidang->id]) }}"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger">Xóa</a>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">không có dữ liệu</td>
                            </tr>
                        @endforelse
                    </tbody>
                </Table>
            </div>
        </div>

        <div id="footer">

        </div>
    </div>

    <script src="../asset/js/style.js"></script>
</body>

</html>

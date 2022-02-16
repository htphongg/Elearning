<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài đăng</title>
    <link rel="stylesheet" href="{{ asset('/asset/css/details-homework.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('../lib/fontawesome/css/all.css') }}">
</head>
<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <span class="main-title">{{ $lopHoc->ten_lop}}</span>
                <span class="sub-title">{{ $lopHoc->mo_ta}}</span>
            </div>
        </div>
        <div class="right">
            <a class="btn btn-info mr-5" href="{{route( 'sv-cong-viec', ['lop_hoc_id' => $lopHoc->id] )}}">Quay lại bài tập trên lớp</a>
        </div>
    </div>

    <!-- Drawer details --> 
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{ route('sv-trang-chu') }}">Lớp học</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-body-title">Đã đăng ký</div>
            <div class="dra-item">
                <i class="far fa-list-alt icon"></i>
                Việc cần làm
            </div>
            @foreach($dsLopDaVao as $lop)
                <div class="dra-item">
                    <div class="dra-item-avt icon">C</div>
                    <a href="{{ route('gv-chi-tiet-lop',['lop_hoc_id' => $lop->id]) }}"> {{ $lop->ten_lop }}</a>
                </div>
            @endforeach
        </div>
        <hr>
        <div class="dra-footer">
            <div class="dra-item">
                <i class="far fa-save icon"></i>
                Lớp học đã lưu trữ
            </div>
            <div class="dra-item">
                <i class="fas fa-cog icon"></i>
                Cài đặt
            </div>
            <div class="dra-item">
                <i class="fas fa-user-circle icon"></i>
                <a href="{{route('gv-cap-nhat-thong-tin')}}">Cập nhật thông tin cá nhân</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-exchange-alt icon"></i>
                <a href="{{route('gv-doi-mat-khau')}}">Thay đổi mật khẩu</a>
            </div>
            <div class="dra-item">
                <i class="fas fa-sign-out-alt icon"></i>
                <a href="{{route('gv-dang-xuat')}}">Đăng xuất</a>
            </div>
        </div>
    </div>
    <!-- End Drawer details -->

    <div id="container">
        <div class="post">
            <div class="post-title">
                <div class="post-logo">
                    <i class="fas fa-file-alt"></i>
                </div>
                <div class="post-text">
                    <span>{{ $baiDang->tieu_de }}</span>
                    <p>{{ $lopHoc->dsNguoiDung->where('loai_nguoi_dung_id','=',2)->first()->ho_ten }} • @php echo date_format (new DateTime($baiDang->created_at), 'd/m/Y'); @endphp </p>
                    <p> 
                        @if($baiDang->han_nop != null)
                            <strong>Hạn nộp:</strong> @php echo date_format (new DateTime($baiDang->han_nop), 'd/m/Y | H:i:s' ); @endphp
                        @else
                            Không có ngày đến hạn
                        @endif
                    </p>
                </div>
            </div>
            <div class="line"><hr></div>
            <div class="post-content"> 
                {{ $baiDang->noi_dung}}
            </div>
            <div class="line"><hr></div>
            <div class="post-acttached">
                @if(count($baiDang->dsDinhKem) == 0)
                    <p>Không có tệp đính kèm nào.</p>
                @else
                    @foreach($baiDang->dsDinhKem as $dkem)
                        <embed src='{{ asset("../dinhkem/post/$dkem->dinh_kem") }}' width="100%" height="500px" />
                    @endforeach
                @endif             
            </div>
            <div class="line"><hr></div>
            <div class="post-cmt">
                <div class="post-cmt-title">
                    <i class="fas fa-user-friends"></i>
                    <p>Nhận xét của lớp học</p>
                </div>
                @foreach($baiDang->dsBinhLuan as $cmt)
                    <div class="comment mt-2 mb-2">
                        <div class="comment-avt">
                            <i class="far fa-user-circle mr-3"></i>
                        </div>
                        <div class="comment-content">
                            <p class="mb-0 font-weight-bold">{{$cmt->nguoiDung->ho_ten}}</p>
                            <p class="mb-0">{{$cmt->noi_dung}}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="line"><hr>
                <div class="post-cmt-title">
                    <p>Nhận xét của bạn:</p>
                </div>
            </div>
            <form action="{{ route('sv-binh-luan',['bai_dang_id' => $baiDang->id , 'lop_hoc_id' => $lopHoc->id ]) }}" method = "post">
                @csrf
                <div class="user-cmt">
                <div class="user-cmt-left w-100">
                        <i class="far fa-user-circle"></i>
                        <input  class="w-100 mr-2" type="text" name="user_comment">
                        <label for="images">
                            <i class="fas fa-camera mt-2"> </i>
                        </label>
                        <input style="display: none;" type="file" id="images" name="images">
                    </div>
                    <div class="user-cmt-right">
                        <button type="submit" class="btn btn-info"><i class="far fa-paper-plane"></i></button>
                    </div>
                </div>
            </form>
        </div>
        <!-- Nộp bài -->
        <form action="#">
            <div class="attached">
                <div class="attached-header">
                    <p class="attached-header-left">Bài tập của bạn</p>
                    <p class="attached-header-right">Đã nộp</p>
                </div>
                <div class="attached-content">
                    <div class="form-group">
                        <div class="form-group">
                            <label >Tệp đính kèm:</label>
                            <input type="file" class="form-control" name="dinh_kem">
                        </div>
                    </div>
                </div>
                <div class="attached-footer text-center">
                    <button type="submit" class="btn btn-info">Nộp bài</button>
                </div>
            </div>
        </form>
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
<script src="{{ asset('../asset/js/style.js') }}"></script>
</html>
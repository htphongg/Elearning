<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài tập</title>
    <link rel="stylesheet" href="../asset/css/work.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.css') }}">  
</head>
<body>
    <!-- Header -->
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}" class="main-title">{{ $lopHoc->ten_lop }}</a>
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}"class="sub-title">{{ $lopHoc->mo_ta }}</a>
            </div>
            <div class="route">
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}">Bảng tin</a>
                <a href="{{route('gv-cong-viec',['lop_hoc_id' => $lopHoc->id]) }}">Bài tập trên lớp</a>
                <a href="{{route('gv-moi-nguoi',['lop_hoc_id' => $lopHoc->id]) }}">Mọi người</a>
                <a href="{{route('gv-chi-tiet-lop',['lop_hoc_id' => $lopHoc->id]) }}">Số điểm</a>
            </div>
        </div>
    </div>
    <!-- End Header -->

    <!-- Drawer details --> 
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="{{route('gv-trang-chu')}}">Lớp học</a>
            </div>
            <div class="dra-item">
                <i class="far fa-calendar icon"></i>
                Lịch
            </div>
        </div>
        <hr>
        <div class="dra-body">
            <div class="dra-body-title">Giảng dạy</div>
            <div class="dra-item">
                <i class="far fa-list-alt icon"></i>
                Để đánh giá 
            </div>
            @foreach($dsLop as $lop)
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
                <a href="{{ route('gv-ds-lop-luu-tru') }}">Lớp học đã lưu trữ</a>
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
    
    <!-- Body -->
    <div id="container">
        <div id="sidebar">
            <div class="topic-title">
                Tất cả chủ đề
            </div>
            <div class="topic">
                Thông báo
            </div>
            <div class="topic">
                Tài liệu
            </div>
            <div class="topic">
                Bài tập
            </div>
        </div>
        <div id="content">
            <p id="demo"></p>
            <!-- Navigation -->
            <div class="navbar">
                <div class="nav-left"> 
                    <a href="{{ route('gv-dang-bai',['lop_hoc_id' =>$lopHoc->id]) }}"  class="btn btn-primary"><i class="fas fa-plus"></i>Tạo</a>
                </div>
                <div class="nav-right">
                    <a href="#"><i class="far fa-calendar"></i> Lịch Google</a>
                    <a href="#"><i class="fab fa-google-drive"></i> Thư mục Drive của lớp học</a>
                </div>
                <!--  -->
            </div>
            <!-- End Navigation -->

            <!-- Post -->
            <div class="post-title">
                <div class="wrap">
                    <span>Thông báo</span>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            @foreach($lopHoc->dsBaiDang as $baiDang)
                @if($baiDang->loai_bai_dang_id == 3)
                    <a href="{{ route('gv-chi-tiet-bai-dang',['id' => $baiDang->id,'type' => $baiDang->loai_bai_dang_id,'lop_hoc_id' => $lopHoc->id ]) }}">
                        <div class="example">
                            <div class="ex-left">
                                <div class="ex-avt">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="ex-title">{{ $baiDang->tieu_de }}</div>
                            </div>
                            <div class="ex-right">
                                <div class="ex-date-up">
                                    Đã đăng vào:
                                    @php 
                                        echo date_format (new DateTime($baiDang->created_at), 'd/m/Y');
                                    @endphp
                                </div>
                                <div class="ex-more-if">
                                    <a href="{{ route('gv-chinh-sua-bai-dang',['id' => $baiDang->id ]) }}" class="btn btn-warning mr-2"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('gv-xoa-bai',['bai_dang_id' => $baiDang->id ]) }}" onClick="return confirm('Bạn có chắc muốn xoá?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach           
            <!-- End Example -->
            <div class="post-title">
                <div class="wrap">
                    <span>Tài liệu</span>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            @foreach($lopHoc->dsBaiDang as $baiDang)
                @if($baiDang->loai_bai_dang_id == 1)
                    <a href="{{ route('gv-chi-tiet-bai-dang',['id' => $baiDang->id,'type' => $baiDang->loai_bai_dang_id,'lop_hoc_id' => $lopHoc->id ]) }}">
                        <div class="example">
                            <div class="ex-left">
                                <div class="ex-avt">
                                    <i class="far fa-bookmark"></i>
                                </div>
                                <div class="ex-title">{{ $baiDang->tieu_de }}</div>
                            </div>
                            <div class="ex-right">
                                <div class="ex-date-up">
                                    Đã đăng vào: 
                                    @php 
                                        echo date_format (new DateTime($baiDang->created_at), 'd/m/Y');
                                    @endphp
                                </div>
                                <div class="ex-more-if">
                                    <a href="{{ route('gv-chinh-sua-bai-dang',['id' => $baiDang->id ]) }}" class="btn btn-warning mr-2"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('gv-xoa-bai',['bai_dang_id' => $baiDang->id ]) }}" onClick="return confirm('Bạn có chắc muốn xoá?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach      
            <!-- End Example -->
            <div class="post-title">
                <div class="wrap">
                    <span>Bài tập</span>
                </div>
                <hr>              
            </div>
            <!-- Example -->
            @foreach($lopHoc->dsBaiDang as $baiDang)
                @if($baiDang->loai_bai_dang_id == 2)
                    <a href="{{ route('gv-chi-tiet-bai-dang',['id' => $baiDang->id,'type' => $baiDang->loai_bai_dang_id,'lop_hoc_id' => $lopHoc->id]) }}">
                        <div class="example">
                            <div class="ex-left">
                                <div class="ex-avt">
                                    <i class="fas fa-file-alt"></i>
                                </div>
                                <div class="ex-title">{{ $baiDang->tieu_de }}</div>
                            </div>
                            <div class="ex-right">
                                @if( $baiDang->han_nop != null)
                                    <div class="ex-date-up">
                                        Ngày đến hạn:
                                        @php 
                                            echo date_format (new DateTime($baiDang->han_nop), 'd/m/Y | H:i');
                                        @endphp
                                    </div>
                                    
                                @else
                                    <div class="ex-date-up">
                                        Không có ngày đến hạn
                                    </div>
                                @endif
                                <div class="ex-more-if">
                                    <a href="{{ route('gv-chinh-sua-bai-dang',['id' => $baiDang->id ]) }}" class="btn btn-warning mr-2"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('gv-xoa-bai',['bai_dang_id' => $baiDang->id ]) }}" onClick="return confirm('Bạn có chắc muốn xoá?')" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach      
            <!-- End Example -->    
            <!-- End Post -->        
        </div>
    </div>
    <div class="box mt-5"></div>
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
    <script src="../asset/js/style.js"></script>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Score</title>
    <link rel="stylesheet" href="../asset/css/score.css">
    <link rel="stylesheet" href="../lib/fontawesome/css/all.css">
    <link rel="stylesheet" href="../lib/bootstrap/css/bootstrap.css">  
</head>
<body>
    <div id="header">
        <div class="left">
            <div class="drawer js-drawer">
                <i class="fas fa-bars"></i>
            </div>
            <div class="title">
                <span class="main-title">CĐ TH 19PMC - Lập trình web PHP Nâng cao (LT + ĐA)</span>
                <span class="sub-title">Học kỳ 1 - NH 21-22</span>
            </div>
            <div class="route">
                <a href="./class.html">Bảng tin</a>
                <a href="./work.html">Bài tập trên lớp</a>
                <a href="./everybody.html">Mọi người</a>
                <a href="./score.html">Số điểm</a>
            </div>
        </div>
        <div class="right">
            <div class="menu">
                <i class="fas fa-bars"></i>
            </div>
            <div class="account">
                <i class="far fa-user-circle"></i>
            </div>
        </div>
    </div>

    <!-- Drawer details --> 
    <div class="dra-details">
        <div class="dra-header">
            <div class="dra-item">
                <i class="fas fa-home icon"></i>
                <a href="../index.html">Lớp học</a>
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
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
               CĐTH19PMC
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                Lập trình web PHP
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                ASP.NET Core MVC
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                Lập trình di động
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                Lập trình di động
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                Lập trình di động
            </div>
            <div class="dra-item">
                <div class="dra-item-avt icon">C</div>
                Lập trình di động
            </div>
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
        </div>
    </div>
    <!-- End Drawer details -->

    <script src="../asset/js/style.js"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <link rel="stylesheet" href="{{ asset('/css/get-new-password.css') }}">
    <link rel="stylesheet" href="{{ asset('./lib/bootstrap/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('./lib/fontawesome/css/all.css') }}">
    <style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body{
        background-color: #ccc !important;
    }

    #container{
        margin: 100px 400px;
        padding: 30px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    .btn-reset{
        display: flex;
        justify-content: center;
    }


    /* Toast */
    #toast {
        position: fixed;
        top: 15px;
        right: 25px;
        /* bottom: 50px; */
        z-index: 999999;
    }
    
    .toast {
        display: flex;
        align-items: center; 
        background-color: #dfdfdf;
        border-radius: 2px;
        padding: 20px 0;
        min-width: 380px;
        height: 80px;
        border-left: 4px solid;
        box-shadow: 0 5px 8px rgba(0, 0, 0, 0.08);
        animation: slideInLeft ease .3s , fadeOut linear 1s 2s forwards;
        transition: all linear 0.3s;
    }

    .toast__icon{
    font-size: 24px;
        
    }

    .toast__title{
        font-size: 16px;
        font-weight: 600px;
        color: black;
    }   

    .toast__msg{
        font-size: 14px;
        color: #888;
        margin-top: 4px;
        line-height: 1.5;
    } 

    .toast__icon,
    .toast__close{
        padding: 0px 16px;
    }

    .toast__body{
        flex-grow: 1;
    }

    .toast__close{
    font-size: 20px;
        color: rgba(0, 0, 0, 0.3);
        cursor: pointer;
        
    }
    .toast--success {
        border-color: #47d864;
    }
    .toast--success .toast__icon {
        color: #47d864;
    }
    
    .toast--success .toast__icon {
        color: #47d864;
    }
    
    .toast--error {
        border-color: #ff623d;
    }

    .toast--error .toast__icon {
        color: #ff623d;
    }

    @keyframes slideInLeft {
        from {
        opacity: 0;
        transform: translateX(calc(100% + 25px));
        }
        to {
        opacity: 1;
        transform: translateX(0);
        }
    }
    
    @keyframes fadeOut {
        to {
        opacity: 0;
        }
    }

    /* End Toast */
    </style>
</head>
<body>
    <div id="container">
        <h2 class="text-center">Đặt lại mật khẩu</h2>
        <form action="{{ route('xl-dat-lai-mat-khau',['a' => $id, 'b' => $token]) }}" class="was-validated" method ='post'>
            @csrf
            <div class="form-group">
                <label for="new_password">Mật khẩu mới:</label>      
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="new_password" placeholder="Nhập vào mật khẩu mới" name="new_password" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnPasswordNew">
                            <span class="fas fa-eye"></span>
                        </button>
                    </div>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                </div>
            </div>
            <div class="form-group">
                <label for="cf_new_password">Xác nhận mật khẩu mới:</label>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" id="cf_new_password" placeholder="Xác nhận mật khẩu mới" name="cf_new_password" required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btnPasswordCf">
                            <span class="fas fa-eye"></span>
                        </button>
                    </div>
                    <div class="valid-feedback">Hợp lệ.</div>
                    <div class="invalid-feedback">Vui lòng điền vào trường này.</div>
                </div>
            </div>
            <div class="btn-reset">
                <button type="submit" class="btn btn-primary">Lưu mật khẩu mới</button>
            </div>
        </form>
    </div>
    <div id="toast"></div>
    <script>
        function toast({title ='',message ='',type ="sussces",duration = 2000})
        {
            const main = document.getElementById('toast')
            if(main)
            {
                const toast = document.createElement('div');
                const icons = {
                    success: 'fas fa-check-circle',
                    error: 'fas fa-exclamation-triangle'
                };
                
                //Auto remove toast
                const autoRemoveId = setTimeout(function () {
                    main.removeChild(toast);
                },duration + 1000);

                //Remove toast
                toast.onclick = function (e) {
                    if (e.target.closest(".toast__close")) {
                    main.removeChild(toast);
                    clearTimeout(autoRemoveId);
                    }
                };

                const icon = icons[type];

                const delay = (duration/1000).toFixed(2);
                
                toast.classList.add('toast',`toast--${type}`);

                toast.innerHTML = `
                    <div class="toast__icon">
                        <i class="${icon}"></i>
                    </div>
                    <div class="toast__body">
                        <h3 class="toast__title">${title}</h3>
                        <p class="toast__msg">${message}</p>
                    </div>
                    <div class="toast__close">
                        <i class="fas fa-times"></i>
                    </div>
                `;
                main.appendChild(toast);

                
            }
        }

        function showSuccessToast(title, message){
            toast({
                title,
                message,
                type: 'success',
                duration: 2000
            });
        }

        function showErrorToast(title, message){
            toast({
                title,
                message,
                type: 'error',
                duration: 2000
            });
        }
    </script>
    <script>
        if( {{ Session::has('success') }} )
            showSuccessToast( 'Thành công',"{{ Session::get('success') }} ");
    </script>
    <script>
        if( {{ Session::has('error') }} )
            showErrorToast( 'Lỗi',"{{ Session::get('error') }}");
    </script>
    <script>
        const ipnElemenNew = document.querySelector('#new_password')
        const ipnElemenCf = document.querySelector('#cf_new_password')

        const btnElementNew = document.querySelector('#btnPasswordNew')
        const btnElementCf = document.querySelector('#btnPasswordCf')


        btnElementNew.addEventListener('click', function() {

            const currentType = ipnElemenNew.getAttribute('type')
        
            ipnElemenNew.setAttribute(
            'type',
            currentType === 'password' ? 'text' : 'password'
            )
        })
        
        btnElementCf.addEventListener('click', function() {
        
            const currentType = ipnElemenCf.getAttribute('type')
        
            ipnElemenCf.setAttribute(
            'type',
            currentType === 'password' ? 'text' : 'password'
            )
        })
    </script>
</body>
</html>
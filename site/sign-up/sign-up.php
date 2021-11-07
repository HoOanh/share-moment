<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharemoment | Sign up</title>
    <link rel="stylesheet" href="../../app/css/sign-up.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
</head>

<body>
    <header>
        <div class="header_wrap-form">
            <a href="">
                <img class="header_wrap-logo-form" src="./images/header/logo.png" alt="" />
            </a>
            <div class="header_user-form">
                <a href="../login"><button class="header_user-button-register">Đăng nhập</button></a
            >
          </div>
        </div>
      </header>


    <div class="wrraper">


        <div class="form">
            <div class="form-header">Đăng ký tài khoản</div>
            <form class="form1" method="post" enctype="multipart/form-data">
                <div class="error">
                    <span class="er"></span>

                </div>
                <div class="name-detail">
                    <div class="field">
                        <label>Họ</label>
                        <input type="text" placeholder="Tên"  name="fname"  required>
                    </div>
                    <div class="field">
                        <label>Tên</label>
                        <input type="text" placeholder="Họ"  name="lname" required >
                    </div>
                </div>
                <div class="field">
                    <label>Tên đăng nhập</label>
                    <input type="text" placeholder="Tên đăng nhập" name="user_name" required>
                </div>
                <div class="field">
                    <label>Địa chỉ email</label>
                    <input type="email" placeholder="thongtin@vidu.com"  name="email" required>
                </div>
                <div class="field">
                    <label>Mật khẩu</label>
                    <input type="password" placeholder="Nhập mật khẩu" name="pass" required>
                    <i class="fas fa-eye"></i>
                </div>
                <div class="field">
                    <label>Ảnh đại diện</label>
                    <input type="file"  name="img" required>

                </div>
                <div class="info-detail">
                    <div class="field">
                        <label>Giới tính</label>
                        <select name = "gender"  required>
                            <option value = '1'>Nam</option>
                            <option value = '0'>Nữ</option>
                            <option value = '2'>Khác</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Số điện thoại</label>
                        <input type="text" placeholder="0123456789"  name="phone" required>
                    </div>
                </div>
                <div class="term">
                    <input type="checkbox" required>
                    <p>Tôi đồng ý với <a href='#'>chính sách và các điều khoản</a></p>
            </div>
            <button type='submit' class="send-btn">
                    <span>Tham gia</span>
                </button>
            </form>
        </div>
        </div>


        <footer>
            <div class="footer_wrap-form">
                <ul class="footer_box-menu">
                    <li><a href="">ABOUT</a></li>
                    <li><a href="">HELP</a></li>
                    <li><a href="">TERMS</a></li>
                    <li><a href="">PRIVACY</a></li>
                </ul>
                <div class="footer_box-copyright">© Copyright 2020 by Socialite</div>
            </div>
        </footer>


        <script src="../../app/js/pass-show-hide.js"></script>
        <script src="../../app/ajax/sign_up.js"></script>
</body>

</html>
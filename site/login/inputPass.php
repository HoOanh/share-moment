<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sharemoment | Login</title>

    <!-- Font awesome cdnjs -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Custom css file -->
    <link rel="stylesheet" href="../../app/css/login.css">
</head>

<body>
    <!-- left content -->
    <div class="left">
        <div class="left-container">

            <div class="left-logo">
                <img src="../../images/header/logo.png" alt="logo">
            </div>
            <p>Kết nối đến những người bạn và vòng quanh thế giới với Sharemoment</p>
        </div>
    </div>
    <div class="right">
        <div class="right-contaner">
            <form class="form2">
                <div class="form-header">Nhập mật khẩu mới</div>
                <div class="error">
                    <span class="er"></span>
                </div>
            
                <input type="text" value="<?=$_GET['token'] ?>" hidden name="token">
                <div class="field">
                    <input type="password" placeholder="Mật khẩu" name="pass">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="btn btn-send">Đổi mật khẩu</div>
            </form>
           
            <div class="btn btn-signup">
                <a href="../sign-up">Tạo tài khoản mới</a>
            </div>

        </div>
    </div>

    <script src="../../app/js/pass-show-hide.js"></script>
    <script src="../../app/ajax/checkToken.js"></script>
</body>

</html>
<?php
require_once "includes/conn.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>ورود</title>
    <style>
        .card {
            width: 350px !important;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">
    <form action="" method="post" class="card m-auto rounded shadow login-form">
        <div class="banner bg-white shadow rounded d-flex">
            <h5>ثبت نوبت داکتر</h5>
            <img src="assets/img/logo.png" alt="">
        </div>
        <div class="card-header text-center">
            <h2 class="py-3 pt-5">ورود</h2>
        </div>
        <div class="card-body px-5">
            <div class="form-group">
                <label for="email">آدرس ایمیل:</label>
                <input id="email" class="form-control" type="text" name="email">
                <span class="ico">email</span>
            </div>
            <div class="form-group">
                <label for="password">گذرواژه:</label>
                <input id="password" class="form-control" type="password" name="password">
                <span class="ico">lock</span>
                <span class="eye">visibility</span>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between align-items-center">
            <button class="btn btn-primary px-3" type="submit" name="submit">ورود</button>
            <a href="signup.php">ثبت نام</a>
        </div>
    </form>

    <?php require_once "includes/footer.php" ?>

    <script>
        $("form").submit(function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: "ajax/login.php",
                data: $(this).serialize(),
                success: function(response) {
                    if (response == 1) {
                        Swal.fire({
                            icon: "success",
                            title: "پیام",
                            text: "خوش آمدید!",
                        });
                        setTimeout(() => {
                            location.href = "index.php?login=success"
                        }, 2000);
                    } else if (response == 2) {
                        Swal.fire({
                            icon: "info",
                            title: "هشدار",
                            text: "لطفا آدرس ایمیل و گذرواژه را وارد کنید!",
                            confirmButtonText: "درست است"
                        });
                    } else {
                        Swal.fire({
                            icon: "warning",
                            title: "خطا",
                            text: "آدرس ایمیل یا گذرواژه اشتباه است",
                            confirmButtonText: "امتحان دوباره"
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>
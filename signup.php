<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>ثبت نام</title>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">
    <form action="" method="post" class="m-auto row col-md-4 rounded">
        <div class="banner bg-white rounded shadow">
            <h4>ثبت نوبت داکتر</h4>
            <img src="assets/img/logo.png">
        </div>
        <div class="card shadow login-form">
            <div class="card-header text-center">
                <h2 class="py-3 pt-5">ثبت نام</h2>
            </div>
            <div class="card-body px-4">
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="name">نام کامل:</label>
                        <input id="name" class="form-control" type="text" name="fullname">
                        <span class="ico">person</span>
                    </div>
                    <div class="form-group">
                        <label for="email">آدرس ایمیل:</label>
                        <input id="email" class="form-control" type="text" name="email">
                        <span class="ico">email</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="password">گذرواژه:</label>
                        <input id="password" class="form-control" type="password" name="password">
                        <span class="ico">lock</span>
                    </div>
                    <div class="form-group">
                        <label for="inp-date">تاریخ تولد:</label>
                        <input id="inp-date" class="form-control" type="text" name="birth_date">
                        <span class="ico">date_range</span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="form-group">
                        <label for="phone">شماره تماس:</label>
                        <input id="phone" class="form-control" type="text" name="phone">
                        <span class="ico">phone</span>
                    </div>
                    <div class="form-group">
                        <label for="address">آدرس:</label>
                        <input id="address" class="form-control" type="text" name="address">
                        <span class="ico">place</span>
                    </div>
                </div>
            </div>
            <div class="card-footer d-flex justify-content-between align-items-center">
                <button class="btn btn-primary px-3" type="submit">ثبت نام</button>
                <a href="login.php">ورود</a>
            </div>
        </div>
        </from>

        <?php require_once "includes/footer.php" ?>

        <script>
            $("form").submit(function(e) {
                e.preventDefault();
                $.ajax({
                    type: "post",
                    url: "ajax/register.php",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                icon: "success",
                                title: "پیام",
                                text: "ثبت نام موفقانه انجام شد"
                            });
                            setTimeout(() => {
                                location.href = "index.php"
                            }, 2000);
                        } else if (response == 2) {
                            Swal.fire({
                                icon: "info",
                                title: "هشدار",
                                text: "لطفا قسمت های ضروری را پر کنید!",
                                confirmButtonText: "درست است"
                            });
                        } else {
                            Swal.fire({
                                icon: "warning",
                                title: "خطا",
                                text: "به مشکل برخورد",
                                confirmButtonText: "امتحان دوباره"
                            });
                        }
                    }
                });
            });
        </script>
</body>

</html>
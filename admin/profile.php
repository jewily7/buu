<?php
require_once "includes/conn.php";
if (isset($_POST["update"])) {
    $name = $_POST["name"];
    $hospital = $_POST["hospital"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $photo = $_FILES["photo"]["name"];
    move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $photo);
    $sql = mysqli_query($con, "UPDATE users SET `email` = '$email', `password`= '$password',`name` = '$name', hospital = '$hospital', photo = '$photo' WHERE id =1");
    if ($sql) {
        header("location: profile.php?update=success");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>سیستم ثبت نوبت داکتر | پروفایل</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-5">
        <h2 class="pb-2 text-right">پروفایل</h2>
        <form method="POST" class="col-md-6 m-auto mt-4 card p-0 shadow profile" enctype="multipart/form-data">
            <div class="card-header text-center">
                <img src="uploads/faizy1.jpg" class="img-fluid shadow-sm">
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="name">نام کامل :</label>
                            <input type="text" name="name" id="name" placeholder="Faizy" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="hospital">شفاخانه:</label>
                            <input type="text" name="hospital" placeholder="Hospital name" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="photo">عکس:</label>
                            <input type="file" name="photo" id="photo" accept="image/*" onchange="getPhoto(event)" value="<?= $sel_profile["photo"] ?>" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="email">آدرس ایمیل:</label>
                            <input type="text" name="email" id="email" value="<?= $sel_profile["email"] ?>" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-5">
                            <label for="password">پسورد:</label>
                            <input type="password" name="password" id="password" value="<?= $sel_profile["password"] ?>" class="form-control">
                        </div>
                        <div class="col-md-5">
                            <label for="c_password">تایید پسورد:</label>
                            <input type="password" name="c_password" id="c_password" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer" >
                <button type="submit" name="update" class="btn btn-success">ذخیره تغییرات</button>
            </div>
        </form>
    </div>
    </div>

    <?php require_once "includes/footer.php" ?>
    <script>
        // function getPhoto(e) {
        //     if (e.target.files.length > 0) {
        //         var src = URL.createObjectURL(e.target.files[0]);
        //         $(".card .img-fluid").attr("src", src)
        //     }
        // }

        $("form #c_password").keyup(function(e) {
            if (($(this).val()) == $("#password").val()) {
                $(".card-footer").slideDown()
            } else {
                $(".card-footer").slideUp()
            }
        });
    </script>
</body>

</html>
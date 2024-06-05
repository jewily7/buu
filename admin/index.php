<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>ورود به سیستم</title>
    <style>
        .card {
            width: 350px !important;
        }

        .card .banner {
            justify-content: center !important;
        }
    </style>
</head>

<body class="bg-light d-flex justify-content-center align-items-center">
    <form action="" method="post" class="card m-auto rounded shadow login-form">
        <div class="card-header text-center">
            <h2 class="py-3">ورود به سیستم</h2>
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
        <div class="card-footer">
            <button class="btn btn-primary w-100 px-3" name="submit" type="submit">ورود</button>
        </div>
    </form>

    <?php require_once "includes/footer.php" ?>
    <script>
        function sayErr() {
            Swal.fire({
                icon: "warning",
                title: "خطا",
                text: "آدرس ایمیل یا گذرواژه اشتباه است",
                confirmButtonText: "امتحان دوباره"
            });
        }
    </script>

    <?php
    session_start();
    $con = mysqli_connect("localhost", "root", "", "doctor_appo") or die(mysqli_connect_error());
    if (isset($_POST["submit"])) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $password = mysqli_real_escape_string($con, $_POST["password"]);
        $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $_SESSION["email"] = $email;
            $_SESSION["admin_id"] = $row["id"];
            header("location: dashboard.php");
        } else {
            echo "<script>sayErr()</script>";
        }
    }
    ?>
</body>

</html>
<?php
require_once "../includes/conn.php";
if (isset($_POST["email"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $sql = mysqli_query($con, "SELECT * FROM users WHERE email = '$email' AND password = '$password'");
    if (mysqli_num_rows($sql) > 0) {
        echo 1;
        $row = mysqli_fetch_assoc($sql);
        $_SESSION["email"] = $email;
        $_SESSION["admin_id"] = $row["id"];
    }else{
        echo 0;
    }
}else{
    header("location: ../index.php");
}

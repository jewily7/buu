<?php
require_once "../includes/conn.php";
if (isset($_POST["fullname"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birth_date = $_POST["birth_date"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    if (empty($fullname) && empty($email)) {
        echo 2;
    } else {
        $sql = mysqli_query($con, "INSERT INTO patient(fullname,email,password,birth_date,phone,address) VALUES('$fullname','$email','$password','$birth_date','$phone','$address')");
        if ($sql) {
            echo 1;
            $_SESSION["email"] = $email;
        } else {
            echo 0;
        }
    }
}

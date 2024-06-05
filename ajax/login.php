<?php
require_once "../includes/conn.php";
if (isset($_POST["email"])) {
    $email = mysqli_real_escape_string($con, $_POST["email"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $sql = mysqli_query($con, "SELECT * FROM patient WHERE email = '$email' AND password = '$password'");
    if (empty($email) && empty($password)) {
        echo 2;
    } else {
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            echo 1;
            $_SESSION["email"] = $email;
            $_SESSION["patient_id"] = $row["id"];
        } else {
            echo 0;
        }
    }
}

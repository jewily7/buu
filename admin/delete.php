<?php
require_once "includes/conn.php";
if (isset($_GET["d_id"])) {
    $img = mysqli_fetch_assoc(mysqli_query($con, "SELECT `image` FROM doctor WHERE id =" . $_GET["d_id"]));
    $sql = mysqli_query($con, "DELETE FROM doctor WHERE id =" . $_GET["d_id"]);
    if ($sql) {
        unlink("uploads/" . $img["image"]);
        header("location: doctor.php");
    }
} else {
    header("location: doctor.php");
}
if (isset($_GET["p_id"])) {
    $sql = mysqli_query($con, "DELETE FROM patient WHERE id =" . $_GET["p_id"]);
    if ($sql)
        header("location: patient.php");
} else {
    header("location: patient.php");
}
if (isset($_GET["s_id"])) {
    $sql = mysqli_query($con, "DELETE FROM doctor_schedule WHERE s_id =" . $_GET["s_id"]);
    if ($sql)
        header("location: doctor_schedule.php");
} else {
    header("location: doctor_schedule.php");
}
if (isset($_GET["app_id"])) {
    $sql = mysqli_query($con, "DELETE FROM appointment WHERE id =" . $_GET["app_id"]);
    if ($sql)
        header("location: appointment.php");
} else {
    header("location: appointment.php");
}

<?php
require_once "../includes/conn.php";
$id;
if (isset($_GET["d_id"])) {
    $id = $_GET["d_id"];
}
if (isset($_POST["doctor_submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $date = $_POST["date"];
    $degree = $_POST["degree"];
    $expert_in = $_POST["expert_in"];
    $d_status = $_POST["d_status"];
    $img = mysqli_fetch_assoc(mysqli_query($con, "SELECT `image` FROM doctor WHERE id =$id"));
    if ($img["image"] == "") {
        $image = $_FILES["image"]["name"];
        move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $image);
        $sql = mysqli_query($con, "UPDATE doctor SET name='$name',email='$email',password='$password',`image`='$image',phone='$phone',address='$address',date_of_birth='$date',degree='$degree',expert_in='$expert_in', d_status='$d_status' WHERE id = $id");
        if ($sql) {
            header("location: ../doctor.php?update=success");
        } else {
            print_r(mysqli_error($con));
            exit;
        }
    } else {
        $sql = mysqli_query($con, "UPDATE doctor SET name='$name',email='$email',password='$password',phone='$phone',address='$address',date_of_birth='$date',degree='$degree',expert_in='$expert_in', d_status='$d_status' WHERE id = $id");
        if ($sql) {
            header("location: ../doctor.php?update=success");
        } else {
            print_r(mysqli_error($con));
            exit;
        }
    }
}
if (isset($_GET["p_id"])) {
    $id = $_GET["p_id"];
}
if (isset($_POST["patient_submit"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birth_date = $_POST["birth_date"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sql = mysqli_query($con, "UPDATE patient SET fullname='$fullname',email='$email',password='$password',birth_date = '$birth_date',phone='$phone',address='$address' WHERE id = '$id'");
    if ($sql) {
        header("location: ../patient.php?update=success");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}

if (isset($_GET["s_id"])) {
    $id = $_GET["s_id"];
}

if (isset($_POST["schedule_submit"])) {
    $doctor_id = $_POST["doctor_id"];
    $schedule_date = $_POST["schedule_date"];
    $schedule_day = $_POST["schedule_day"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $average_consultion_time = $_POST["average_consultion_time"];
    $schedule_status = $_POST["schedule_status"];
    $sql = mysqli_query($con, "UPDATE doctor_schedule SET doctor_id = '$doctor_id', schedule_date='$schedule_date',schedule_day='$schedule_day',start_time='$start_time',end_time='$end_time',average_consultion_time='$average_consultion_time',schedule_status='$schedule_status' WHERE s_id=$id");
    if ($sql) {
        header("location: ../doctor_schedule.php?update=success");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}


if (isset($_GET["ap_id"])) {
    $id = $_GET["ap_id"];
}
if (isset($_POST["update_appointment"])) {
    $appointment_number = $_POST["appointment_number"];
    $reason_for_appointment = $_POST["reason_for_appointment"];
    $appointment_time = $_POST["appointment_time"];
    $status = $_POST["status"];
    $sql = mysqli_query($con, "UPDATE appointment SET appointment_number = '$appointment_number', reason_for_appointment = '$reason_for_appointment',appointment_time = '$appointment_time', `status` = '$status' WHERE id = $id");
    if ($sql) {
        header("location: ../appointment.php?update=success");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}

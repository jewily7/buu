<?php
require_once "../includes/conn.php";

if (isset($_POST["doctor_submit"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $date = $_POST["date"];
    $degree = $_POST["degree"];
    $expert_in = $_POST["expert_in"];
    $image = $_FILES["image"]["name"];
    $d_status = $_POST["d_status"];
    move_uploaded_file($_FILES["image"]["tmp_name"], "../uploads/" . $image);
    $sql = mysqli_query($con, "INSERT INTO doctor (name, email, password, `image`, phone, address, date_of_birth, degree, expert_in, d_status)
     VALUES ('$name','$email','$password','$image','$phone','$address','$date','$degree','$expert_in','$d_status')");
    if ($sql) {
        header("location: ../doctor.php?add=success");
    } else {
        echo "خطا";
    }
}
if (isset($_POST["patient_submit"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $birth_date = $_POST["birth_date"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $sql = mysqli_query($con, "INSERT INTO patient(fullname,email,password,birth_date,phone,address) VALUES('$fullname','$email','$password','$birth_date','$phone','$address')");
    if ($sql) {
        header("location: ../patient.php");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}


if (isset($_POST["schedule_submit"])) {
    $doctor_id = $_POST["doctor_id"];
    $schedule_date = $_POST["schedule_date"];
    $schedule_day = $_POST["schedule_day"];
    $start_time = $_POST["start_time"];
    $end_time = $_POST["end_time"];
    $average_consultion_time = $_POST["average_consultion_time"];
    $schedule_status = $_POST["schedule_status"];
    $sql = mysqli_query($con, "INSERT INTO doctor_schedule(doctor_id, schedule_date, schedule_day, start_time, end_time, average_consultion_time, schedule_status)
    VALUES('$doctor_id','$schedule_date','$schedule_day','$start_time','$end_time','$average_consultion_time','$schedule_status')
    ");
    if ($sql) {
        header("location: ../doctor_schedule.php");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}


if (isset($_POST["appointment_submit"])) {
    $schedule_id = $_POST["schedule_id"];
    $doctor_id = $_POST["doctor_id"];
    $patient_id = $_POST["patient_id"];
    $appointment_number = $_POST["appointment_number"];
    $reason_for_appointment = $_POST["reason_for_appointment"];
    $appointment_time = $_POST["appointment_time"];
    $status = $_POST["status"];
    $sql = mysqli_query($con, "INSERT INTO appointment (doctor_id,patient_id,schedule_id,appointment_number,reason_for_appointment,appointment_time,`status`)
    VALUES('$doctor_id','$patient_id','$schedule_id','$appointment_number','$reason_for_appointment','$appointment_time','$status')
    ");
    if ($sql) {
        header("location: ../doctor_schedule.php");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}

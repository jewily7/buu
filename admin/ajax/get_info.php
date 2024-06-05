<?php
require_once "../includes/conn.php";
if(isset($_GET["d_id"])){
    $sql = mysqli_query($con,"SELECT * FROM doctor WHERE id =".$_GET["d_id"]);
    $row = mysqli_fetch_assoc($sql);
    $obj = array(
        "email" => $row["email"],
        "password" => $row["password"],
        "name" => $row["name"],
        "phone" => $row["phone"],
        "address" => $row["address"],
        "date" => $row["date_of_birth"],
        "degree" => $row["degree"],
        "expert_in" => $row["expert_in"],
        "d_status" => $row["d_status"],
        "image" => $row["image"],
    );
    echo json_encode($obj);
}
if(isset($_GET["p_id"])){
    $sql = mysqli_query($con,"SELECT * FROM patient WHERE id =".$_GET["p_id"]);
    $row = mysqli_fetch_assoc($sql);
    $obj = array(
        "fullname" => $row["fullname"],
        "email" => $row["email"],
        "password" => $row["password"],
        "birth_date" => $row["birth_date"],
        "phone" => $row["phone"],
        "address" => $row["address"],
    );
    echo json_encode($obj);
}
if(isset($_GET["s_id"])){
    $sql = mysqli_query($con,"SELECT * FROM doctor_schedule WHERE s_id =".$_GET["s_id"]);
    $row = mysqli_fetch_assoc($sql);
    $obj = array(
        "schedule_date" => $row["schedule_date"],
        "schedule_day" => $row["schedule_day"],
        "consultion_time" => $row["average_consultion_time"],
        "start_time" => $row["start_time"],
        "end_time" => $row["end_time"],
        "schedule_status" => $row["schedule_status"],
    );
    echo json_encode($obj);
}

if(isset($_GET["ap_id"])){
    $sql = mysqli_query($con,"SELECT * FROM appointment WHERE id =".$_GET["ap_id"]);
    $row = mysqli_fetch_assoc($sql);
    $obj = array(
        "appointment_number" => $row["appointment_number"],
        "appointment_time" => $row["appointment_time"],
        "reason_for_appointment" => $row["reason_for_appointment"],
        "status" => $row["status"],
    );
    echo json_encode($obj);
}

<?php
require_once "../includes/conn.php";
if(isset($_POST["patient_id"])){
    $app_id = $_POST["app_id"];
    $patient_id = $_POST["patient_id"];
    $status = $_POST["status"];
    $sql = mysqli_query($con,"UPDATE appointment SET `status` = '$status' WHERE id = $app_id AND patient_id = $patient_id");
}

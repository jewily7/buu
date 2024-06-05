<?php
session_start();
$con = mysqli_connect("localhost","root","","doctor_appo") or die(mysqli_connect_error());
require_once "jdf.php";
if (!isset($_SESSION["admin_id"])) {
    header("location: index.php");
}
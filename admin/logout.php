<?php
session_start();
if(isset($_GET["logout"])){
    unset($_SESSION["admin_id"]);
    session_destroy();
    header("location: index.php");
}
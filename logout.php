<?php
session_start();
if(isset($_GET["user_logout"])){
    unset($_SESSION["user_logout"]);
    session_destroy();
    header("location: login.php");
}
?>
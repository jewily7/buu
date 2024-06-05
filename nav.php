<?php
if (isset($_SESSION["patient_id"])) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE id =" . $_SESSION["patient_id"]));
}else{
    header("location: login.php");
}
?>
<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow fixed-top">
    <a class="navbar-brand"><?= $user["fullname"] ?></a>
    <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div id="my-nav" class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="profile.php">پروفایل<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="index.php">گرفتن نوبت<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="appointment.php">نوبت ها<span class="sr-only"></span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="logout.php?user_logout=true"> خروج<span class="sr-only"></span></a>
            </li>
        </ul>
    </div>
</nav>
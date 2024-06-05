<?php
$sel_profile = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id = ".$_SESSION["admin_id"]));
?>
<nav class="nav shadow">
    <div class="d-flex align-items-center">
        <span class="ico nav-btn ml-4">menu</span>
        <h6 class="mt-2"><?= jdate('l j p o') ?></h6>
    </div>
    <a href="profile.php"><img src="uploads/<?= $sel_profile["photo"] ?>" class="profile border-primary" alt=""></a>
</nav>
<div class="side-menu">
    <div>
    <img src="../assets/img/logo.png" alt="">
    </div>
    <ul>
        <li><a href="dashboard.php"><span class="ico">dashboard</span> داشبورد</a></li>
        <li><a href="doctor.php"><span class="ico">person</span> داکتران</a></li>
        <li><a href="patient.php"><span class="ico">local_hotel</span> مریضان</a></li>
        <li><a href="doctor_schedule.php"><span class="ico">query_builder</span> تقسیم اوقات داکتران</a></li>
        <li><a href="appointment.php"><span class="ico">rate_review</span> نوبت ها</a></li>
        <li><a href="profile.php"><span class="ico">account_circle</span> پروفایل</a></li>
        <li><a href="logout.php?logout=true"><span class="ico">logout</span> خروج</a></li>
    </ul>
</div>
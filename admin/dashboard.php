<?php
require_once "includes/conn.php";
$patient_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM patient"));
$yester_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM appointment WHERE DAY(save_date) = DAY(NOW()) - 1"));
$day_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM appointment WHERE DAY(save_date) = DAY(NOW())"));
$week_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM appointment WHERE WEEK(save_date) = WEEK(NOW())"));
$month_count = mysqli_fetch_assoc(mysqli_query($con, "SELECT COUNT(*) AS total FROM appointment WHERE MONTH(save_date) = MONTH(NOW())"));

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>سیستم ثبت نوبت داکتر</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-5">
        <h2 class="pb-2 text-right">داشبورد</h2>
        <div class="row row-cols-5">
            <div class="box bg-white border-left-primary shadow rounded">
                <div class="d-flex">
                    <div>
                        <h4 class="text-primary">نوبت های امروز</h4>
                        <h3 class="text-secondary font-weight-bold"><?= $day_count["total"] == 0 ? "0" : $day_count["total"] ?></h3>
                    </div>
                    <span class="ico">description</span>
                </div>
            </div>
            <div class="box bg-white border-left-secondary shadow rounded">
                <div class="d-flex">
                    <div>
                        <h4 class="text-secondary">نوبت های دیروز</h4>
                        <h3 class="text-secondary font-weight-bold"><?= $yester_count["total"] == 0 ? "0" : $yester_count["total"] ?></h3>
                    </div>
                    <span class="ico">description</span>
                </div>
            </div>
            <div class="box bg-white border-left-warning shadow rounded">
                <div class="d-flex">
                    <div>
                        <h4 class="text-warning">نوبت های یک هفته</h4>
                        <h3 class="text-secondary font-weight-bold"><?= $week_count["total"] == 0 ? "0" : $week_count["total"] ?></h3>
                    </div>
                    <span class="ico">description</span>
                </div>
            </div>
            <div class="box bg-white border-left-success shadow rounded">
                <div class="d-flex">
                    <div>
                        <h4 class="text-success">نوبت های یک ماه</h4>
                        <h3 class="text-secondary font-weight-bold"><?= $month_count["total"] == 0 ? "0" : $month_count["total"] ?></h3>
                    </div>
                    <span class="ico">description</span>
                </div>
            </div>
            <div class="box bg-white border-left-danger shadow rounded">
                <div class="d-flex">
                    <div>
                        <h4 class="text-danger">مریضان ثبت شده</h4>
                        <h3 class="text-secondary font-weight-bold"><?= $patient_count["total"] == 0 ? "0" : $patient_count["total"] ?></h3>
                    </div>
                    <span class="ico">local_hotel</span>
                </div>
            </div>
        </div>
    </div>

    <?php require_once "includes/footer.php" ?>
</body>

</html>
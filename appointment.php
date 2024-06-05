<?php
require_once "includes/conn.php";
if (isset($_SESSION["patient_id"])) {
    $user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM patient WHERE id =" . $_SESSION["patient_id"]));
} else {
    header("location: login.php");
}
$sql = mysqli_query(
    $con,
    "SELECT
appointment.id AS app_id,
appointment.doctor_id,
appointment.patient_id,
appointment.appointment_number,
appointment.reason_for_appointment,
appointment.appointment_time,
appointment.status,
doctor.name as doctor_name
FROM
appointment
INNER JOIN doctor ON appointment.doctor_id = doctor.id
 WHERE appointment.patient_id =" . $_SESSION["patient_id"]
);
$row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>نوبت ها</title>
</head>

<body class="bg-light">
    <?php require_once "nav.php" ?>
    <div class="main-container">
        <div class="header shadow rounded bg-white">
            <h3>سیستم آنلاین ثبت نوبت داکتر</h3>
            <img src="assets/img/logo.png">
        </div>

        <div class="card shadow">
            <div class="card-header">
                <h3 class="py-3">لیست نوبت ها</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table w-100 table-bordered table-hover table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>شماره نوبت</th>
                            <th>نام داکتر</th>
                            <th>توضیحات</th>
                            <th>زمان</th>
                            <th>وضعیت</th>
                            <th colspan="3" class="text-center" style="width: 8%;">عملکرد</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $n = 1;
                        if (mysqli_num_rows($sql) > 0) {
                            do {
                        ?>
                                <tr>
                                    <td class="text-center font-weight-bold"><?= $n++ ?></td>
                                    <td><?= $row["appointment_number"] ?></td>
                                    <td><?= $row["doctor_name"] ?></td>
                                    <td><?= $row["reason_for_appointment"] ?></td>
                                    <td><?= $row["appointment_time"] ?></td>
                                    <td><?= $row["status"] ?></td>
                                    <td class="text-center pb-2 px-2"><span title="تکمیل شده" class="ico bg-success rounded text-white p-2" onclick="changeStatus('<?= $row['app_id'] ?>','<?= $row['patient_id'] ?>','تکمیل شده')">check</span></td>
                                    <td class="text-center pb-2 px-2"><span title="درحال اجرا" class="ico bg-info rounded text-white p-2" onclick="changeStatus('<?= $row['app_id'] ?>','<?= $row['patient_id'] ?>','درحال اجرا')">bar_chart</span></td>
                                    <td class="text-center pb-2 px-2"><span title="لغو شده" class="ico bg-danger rounded text-white p-2" onclick="changeStatus('<?= $row['app_id'] ?>','<?= $row['patient_id'] ?>','لغو شده')">cancel</span></td>
                                </tr>
                            <?php
                            } while ($row = mysqli_fetch_assoc($sql));
                        } else {
                            ?>
                            <tr>
                                <td colspan="8" class="text-center">هنوز ثبت نشده</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <?php require_once "includes/footer.php" ?>

    <script>
        function changeStatus(app_id, patient_id, status) {
            $.ajax({
                type: "post",
                url: "ajax/change_app_status.php",
                data: {
                    'app_id': app_id,
                    'patient_id': patient_id,
                    'status': status
                },
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
</body>

</html>
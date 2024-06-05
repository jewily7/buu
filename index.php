<?php
require_once "includes/conn.php";
$sql = mysqli_query($con, "SELECT * FROM doctor_schedule INNER JOIN doctor ON doctor.id= doctor_schedule.doctor_id");
$row = mysqli_fetch_assoc($sql);

// add appointment using patient
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
        header("location: appointment.php");
    } else {
        print_r(mysqli_error($con));
        exit;
    }
}
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
                <h3 class="py-3">لیست تقسیم اوقات داکتر ها</h3>
            </div>
            <div class="card-body table-responsive">
                <table class="table w-100 table-bordered table-hover table-striped">
                    <thead class="bg-dark text-white">
                        <tr class="w-100">
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>نام داکتر</th>
                            <th>تاریخ</th>
                            <th>روز</th>
                            <th>شروع</th>
                            <th>ختم</th>
                            <th>مدت ملاقات</th>
                            <th>وضعیت</th>
                            <th style="width: 5%;">عملکرد</th>
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
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["schedule_date"] ?></td>
                                    <td><?= $row["schedule_day"] ?></td>
                                    <td><?= $row["start_time"] ?></td>
                                    <td><?= $row["end_time"] ?></td>
                                    <td><?= $row["average_consultion_time"] ?></td>
                                    <td><?= $row["schedule_status"] ?></td>
                                    <td class="text-center"><span title="ثبت نوبت" class="ico bg-success rounded text-white p-2" style="cursor: pointer;" onclick="saveAppointment('<?= $row['id'] ?>','<?= $_SESSION['patient_id'] ?>','<?= $row['s_id'] ?>')">add</span></td>
                                </tr>
                            <?php
                            } while ($row = mysqli_fetch_assoc($sql));
                        } else {
                            ?>
                            <tr>
                                <td colspan="9" class="text-center">هنوز ثبت نشده</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


    <!-- add appointment modal -->
    <div id="app-modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" action="" id="appointment_form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">ثبت نوبت</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="doctor_id" id="doctor_id">
                        <input type="hidden" name="patient_id" id="patient_id">
                        <input type="hidden" name="schedule_id" id="schedule_id">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="appointment_number">شماره نوبت:</label>
                                    <input type="text" name="appointment_number" id="appointment_number" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="appointment_time">زمان نوبت:</label>
                                    <input type="time" name="appointment_time" id="appointment_time" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="status">وضعیت:</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="درحال اجرا">درحال اجرا</option>
                                        <option value="تکمیل شده">تکمیل شده</option>
                                        <option value="لغو شده">لغو شده</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="reason_for_appointment">توضیحات:</label>
                                    <textarea name="reason_for_appointment" id="reason_for_appointment" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="appointment_submit" class="btn btn-success">ثبت</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
        </div>
        </form>
    </div>
    </div>
    <!-- //////////////// -->



    <?php require_once "includes/footer.php" ?>

    <script>
        function saveAppointment(d_id, p_id, s_id) {
            $("form #doctor_id").val(d_id);
            $("form #patient_id").val(p_id);
            $("form #schedule_id").val(s_id);
            $("#app-modal").modal('show')
        }
    </script>
</body>

</html>
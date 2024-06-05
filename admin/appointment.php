<?php
require_once "includes/conn.php";
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
    doctor.name as doctor_name,
    patient.fullname as patient_name,
    doctor_schedule.schedule_date
FROM
    appointment
INNER JOIN doctor ON appointment.doctor_id = doctor.id
INNER JOIN patient ON appointment.patient_id = patient.id
INNER JOIN doctor_schedule ON appointment.schedule_id = doctor_schedule.s_id
    ORDER BY appointment.id ASC
"
);
$row = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>نوبت ها</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-4">
        <h2 class="pb-2 text-right">نوبت ها</h2>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between pl-1">
                    <h4 class="pt-2">نوبت های ثبت شده</h4>
                    <!-- <span class="ico py-1 px-2 rounded bg-success text-light pointer add">add</span> -->
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table w-100 table-bordered table-hover table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>شماره نوبت</th>
                            <th>نام داکتر</th>
                            <th>نام مریض</th>
                            <th>تاریخ</th>
                            <th>توضیحات</th>
                            <th>زمان</th>
                            <th>وضعیت</th>
                            <th colspan="2" class="text-center" style="width: 8%;">عملکرد</th>
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
                                    <td><?= $row["patient_name"] ?></td>
                                    <td><?= $row["schedule_date"] ?></td>
                                    <td><?= $row["reason_for_appointment"] ?></td>
                                    <td><?= $row["appointment_time"] ?></td>
                                    <td><?= $row["status"] ?></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-success rounded text-white p-2" onclick="getAppoData('<?= $row['app_id'] ?>')">edit</span></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-danger rounded text-white p-2" onclick="return sayWar('<?= $row['app_id'] ?>')">delete</span></td>
                                </tr>
                            <?php
                            } while ($row = mysqli_fetch_assoc($sql));
                        } else {
                            ?>
                            <tr>
                                <td colspan="10" class="text-center">هنوز ثبت نشده</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- modal -->
    <div id="my-modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" id="appointment_form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">ویرایش نوبت</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
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
                        <div class="modal-footer">
                            <button type="submit" name="update_appointment" class="btn btn-success">ذخیره تغییرات</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php require_once "includes/footer.php" ?>
    <script>

        // get patient info
        function getAppoData(id) {
            $("#appointment_form").attr("action", "ajax/update.php?ap_id=" + id);
            $.ajax({
                type: "get",
                url: "ajax/get_info.php?ap_id=" + id,
                success: function(response) {
                    var res = JSON.parse(response);
                    $("#appointment_number").val(res["appointment_number"]);
                    $("#appointment_time").val(res["appointment_time"]);
                    $("#reason_for_appointment").val(res["reason_for_appointment"]);
                    $("#status").val(res["status"]);
                }
            });
            $('#my-modal').modal('show');
        }

        function sayWar(id) {
            Swal.fire({
                title: 'حذف کردن',
                text: 'آیا میخواهید این نوبت را حذف کنید؟',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'نخیر',
                cancelButtonColor: '#197',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "delete.php?app_id=" + id
                }
            });
        }
    </script>
</body>

</html>
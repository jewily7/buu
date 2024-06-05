<?php
require_once "includes/conn.php";
$sql = mysqli_query($con, 
"SELECT * FROM doctor_schedule INNER JOIN doctor ON doctor.id= doctor_schedule.doctor_id
");
$row = mysqli_fetch_assoc($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>تقسیم اوقات داکتران</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-4">
        <h2 class="pb-2 text-right">تقسیم اوقات</h2>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between pl-1">
                    <h4 class="pt-2">تقسیم اوقات داکتران</h4>
                    <span class="ico py-1 px-2 rounded bg-success text-light pointer add">add</span>
                </div>
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
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["schedule_date"] ?></td>
                                    <td><?= $row["schedule_day"] ?></td>
                                    <td><?= $row["start_time"] ?></td>
                                    <td><?= $row["end_time"] ?></td>
                                    <td><?= $row["average_consultion_time"] ?></td>
                                    <td><?= $row["schedule_status"] ?></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-primary rounded text-white p-2" title="ثبت نوبت" onclick="addApp('<?= $row['s_id'] ?>','<?= $row['doctor_id'] ?>')">check</span></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-success rounded text-white p-2" onclick="getScheduleData('<?= $row['s_id'] ?>')">edit</span></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-danger rounded text-white p-2" onclick="return sayWar('<?= $row['s_id'] ?>')">delete</span></td>
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

    <!-- modal 1 -->
    <div id="my-modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" action="ajax/add.php" id="schedule_form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">تقسیم اوقات جدید</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">داکتر:</label>
                            <select name="doctor_id" class="form-control">
                                <?php
                                $sel_doc = mysqli_query($con, "SELECT * FROM doctor");
                                if (mysqli_num_rows($sel_doc) > 0) :
                                    $doc_row = mysqli_fetch_assoc($sel_doc);
                                    do {
                                ?>
                                        <option value="<?= $doc_row["id"] ?>"><?= $doc_row["name"] ?></option>
                                <?php } while ($doc_row = mysqli_fetch_assoc($sel_doc));

                                endif ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inp-date">تاریخ:</label>
                                    <input type="text" name="schedule_date" id="inp-date" class="form-control" autocomplete="off">
                                </div>
                                <div class="col-md-6">
                                    <label for="schedule_day">روز:</label>
                                    <select name="schedule_day" id="schedule_day" class="form-control">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="start_time">زمان شروع:</label>
                                    <input type="time" name="start_time" id="start_time" class="form-control" autocomplete="off" />
                                </div>
                                <div class="col-md-6">
                                    <label for="end_time">زمان ختم:</label>
                                    <input type="time" name="end_time" id="end_time" class="form-control" />
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="average_consultion_time">زمان سپری شده:</label>
                                    <input type="text" name="average_consultion_time" id="average_consultion_time" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="schedule_status">وضعیت:</label>
                                    <select name="schedule_status" id="schedule_status" class="form-control">
                                        <option value="فعال">فعال</option>
                                        <option value="غیر فعال">غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="schedule_submit" class="btn btn-success">ثبت</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- add appointment modal -->
    <div id="app-modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" action="ajax/add.php" id="appointment_form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">ثبت نوبت</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">مریض:</label>
                            <select name="patient_id" class="form-control">
                                <?php
                                $sel_doc = mysqli_query($con, "SELECT * FROM patient");
                                if (mysqli_num_rows($sel_doc) > 0) :
                                    $doc_row = mysqli_fetch_assoc($sel_doc);
                                    do {
                                ?>
                                        <option value="<?= $doc_row["id"] ?>"><?= $doc_row["fullname"] ?></option>
                                <?php } while ($doc_row = mysqli_fetch_assoc($sel_doc));

                                endif ?>
                            </select>
                        </div>
                        <input type="hidden" name="doctor_id" id="doctor_id">
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
        $(".add").click(function(e) {
            $("#schedule_form").attr("action", "ajax/add.php");
            $(".modal-title").html("تقسیم اوقات جدید");
            document.querySelectorAll("input").forEach(inp => {
                $(inp).attr("value", "");
            });
            $("#schedule_form .btn-success").html("ثبت");
            $('#my-modal').modal('show');
        });


        // get patient info
        function getScheduleData(id) {
            $("#schedule_form").attr("action", "ajax/update.php?s_id=" + id);
            $(".modal-title").html("ویرایش تقسیم اوقات")
            $("#schedule_form .btn-success").html("بروزرسانی");
            $.ajax({
                type: "get",
                url: "ajax/get_info.php?s_id=" + id,
                success: function(response) {
                    var res = JSON.parse(response);
                    $("#inp-date").val(res["schedule_date"]);
                    $("#schedule_day").val(res["schedule_day"]);
                    $("#average_consultion_time").val(res["consultion_time"]);
                    $("#start_time").val(res["start_time"]);
                    $("#end_time").val(res["end_time"]);
                    $("#schedule_status").val(res["schedule_status"]);
                }
            });
            $('#my-modal').modal('show');
        }


        function addApp(s_id,d_id) {
            $("#appointment_form #doctor_id").val(d_id);
            $("#appointment_form #schedule_id").val(s_id);
            $("#app-modal").modal('show');

        }



        // warning message for deleting
        function sayWar(id) {
            Swal.fire({
                title: 'حذف کردن',
                text: 'آیا میخواهید این معلومات را حذف کنید؟',
                icon: 'info',
                showCancelButton: true,
                confirmButtonText: 'بله',
                cancelButtonText: 'نخیر',
                cancelButtonColor: '#197',
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = "delete.php?s_id=" + id
                }
            });
        }
    </script>
</body>

</html>
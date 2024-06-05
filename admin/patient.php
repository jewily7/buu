<?php
require_once "includes/conn.php";
$sql = mysqli_query($con, "SELECT * FROM patient ORDER BY id ASC");
$row = mysqli_fetch_assoc($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>مریضان</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-4">
        <h2 class="pb-2 text-right">مریضان</h2>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between pl-1">
                    <h4 class="pt-2">لیست مریضان ثبت شده</h4>
                    <span class="ico py-1 px-2 rounded bg-success text-light pointer add">add</span>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table w-100 table-bordered table-hover table-striped">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>نام کامل</th>
                            <th>ایمیل</th>
                            <th>پسورد</th>
                            <th>تاریخ تولد</th>
                            <th>شماره تماس</th>
                            <th>آدرس</th>
                            <th>تاریخ ثبت</th>
                            <th colspan="2" class="text-center">عملکرد</th>
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
                                    <td><?= $row["fullname"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["password"] ?></td>
                                    <td><?= $row["birth_date"] ?></td>
                                    <td><?= $row["phone"] ?></td>
                                    <td><?= $row["address"] ?></td>
                                    <td dir="ltr"><?= $row["created_date"] ?></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-success rounded text-white p-2" onclick="getPatientData('<?= $row['id'] ?>')">edit</span></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-danger rounded text-white p-2" onclick="return sayWar('<?= $row['id'] ?>')">delete</span></td>
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
            <form method="post" action="ajax/add.php" id="patient_form">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">اضافه کردن مریض</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="fullname">نام کامل:</label>
                            <input type="text" name="fullname" id="fullname" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="email">آدرس ایمیل:</label>
                                    <input type="text" name="email" id="email" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="password">پسورد:</label>
                                    <input type="password" name="password" id="password" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="inp-date">تاریخ تولد:</label>
                                    <input type="text" name="birth_date" id="inp-date" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">شماره تماس:</label>
                                    <input type="phone" name="phone" id="phone" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">آدرس:</label>
                            <input type="text" name="address" id="address" class="form-control" />
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="patient_submit" class="btn btn-success">ثبت</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <?php require_once "includes/footer.php" ?>
    <script>
        $(".add").click(function(e) {
            $("#patient_form").attr("action", "ajax/add.php");
            $(".modal-title").html("اضافه کردن مریض");
            $("#fullname,#email,#password,#inp-date,#phone,#address").val("")
            $("#patient_form .btn-success").html("ثبت");
            $('#my-modal').modal('show');
        });


        // get patient info
        function getPatientData(id) {
            $("#patient_form").attr("action", "ajax/update.php?p_id=" + id);
            $(".modal-title").html("ویرایش معلومات مریض")
            $("#patient_form .btn-success").html("بروزرسانی");
            $.ajax({
                type: "get",
                url: "ajax/get_info.php?p_id=" + id,
                success: function(response) {
                    var res = JSON.parse(response);
                    $("#fullname").val(res["fullname"]);
                    $("#email").val(res["email"]);
                    $("#password").val(res["password"]);
                    $("#inp-date").val(res["birth_date"]);
                    $("#phone").val(res["phone"]);
                    $("#address").val(res["address"]);
                }
            });
            $('#my-modal').modal('show');
        }

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
                    location.href = "delete.php?p_id=" + id
                }
            });
        }
    </script>
</body>

</html>
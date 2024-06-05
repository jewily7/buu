<?php
require_once "includes/conn.php";
$sql = mysqli_query($con, "SELECT * FROM doctor ORDER BY id DESC");
$row = mysqli_fetch_assoc($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "includes/header.php" ?>
    <title>داکتران</title>
</head>

<body>
    <?php require_once "menu.php" ?>
    <div class="main-container pr-4">
        <h2 class="pb-2 text-right">داکتران</h2>
        <div class="card shadow">
            <div class="card-header">
                <div class="d-flex align-items-center justify-content-between pl-1">
                    <h4 class="pt-2">لیست داکتران ثبت شده</h4>
                    <span class="ico py-1 px-2 rounded bg-success text-light pointer add">add</span>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table w-100 table-bordered table-hover">
                    <thead class="bg-dark text-white">
                        <tr class="w-100">
                            <th style="width: 5%;" class="text-center">No</th>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th style="width: 10%;">شماره تماس</th>
                            <th>آدرس</th>
                            <th>تاریخ تولد</th>
                            <th>درجه</th>
                            <th>تخصص</th>
                            <th style="width: 8%;" class="text-center">وضعیت</th>
                            <th style="width: 5%;">عکس</th>
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
                                    <td><?= $row["name"] ?></td>
                                    <td><?= $row["email"] ?></td>
                                    <td><?= $row["phone"] ?></td>
                                    <td><?= $row["address"] ?></td>
                                    <td><?= $row["date_of_birth"] ?></td>
                                    <td><?= $row["degree"] ?></td>
                                    <td><?= $row["expert_in"] ?></td>
                                    <td class="text-center <?= $row["d_status"] == "فعال" ? "text-primary" : "text-danger"; ?> "><?= $row["d_status"] ?></td>
                                    <td class="p-1"><img style="height: 50px;object-fit: cover" class="w-100" src="uploads/<?= $row["image"] == null ? "logo.jpg" : $row["image"] ?>"></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-success rounded text-white p-2" onclick="getDoctorData('<?= $row['id'] ?>')">edit</span></td>
                                    <td class="text-center pb-2 px-2"><span class="ico bg-danger rounded text-white p-2" onclick="return sayWar('<?= $row['id'] ?>')">delete</span></td>
                                </tr>
                            <?php
                            } while ($row = mysqli_fetch_assoc($sql));
                        } else {
                            ?>
                            <tr>
                                <td colspan="12" class="text-center">هنوز ثبت نشده</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div id="my-modal" class="modal fade">
        <div class="modal-dialog">
            <form method="post" action="ajax/add.php" id="doctor_form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header d-flex justify-content-between align-items-cenetr">
                        <h4 class="modal-title" id="modal_title">اضافه کردن داکتر</h4>
                        <button type="button" class="btn btn-danger pb-0" data-dismiss="modal"><span class="ico">close</span></button>
                    </div>
                    <div class="modal-body">
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
                                    <label for="name">نام:</label>
                                    <input type="text" name="name" id="name" class="form-control" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="phone">شماره تماس:</label>
                                    <input type="text" name="phone" id="phone" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="address">آدرس:</label>
                                    <input type="text" name="address" id="address" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="inp-date">تاریخ تولد:</label>
                                    <input type="text" name="date" id="inp-date" class="form-control" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="degree">درجه:</label>
                                    <input type="text" name="degree" id="degree" class="form-control" />
                                </div>
                                <div class="col-md-6">
                                    <label for="expert_in">تحصص:</label>
                                    <input type="text" name="expert_in" id="expert_in" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="image">لطفا عکس انتخاب نکنید!</label>
                                    <input type="file" accept="image/*" onchange="showImg(event)" name="image" id="image" class="form-control" />
                                    <img src="" class="img-prev shadow-sm">
                                </div>
                                <div class="col-md-6">
                                    <label for="d_status">وضعیت:</label>
                                    <select name="d_status" id="d_status" class="form-control" required>
                                        <option selected disabled>انتخاب</option>
                                        <option value="فعال">فعال</option>
                                        <option value="غیر فعال">غیر فعال</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="doctor_submit" class="btn btn-success">ثبت</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php require_once "includes/footer.php" ?>

    <script>
        $(".add").click(function(e) {
            $("#doctor_form").attr("action", "ajax/add.php");
            $(".modal-title").html("اضافه کردن داکتر");
            $("#email,#password,#name,#phone,#image,#address,#inp-date,#degree,#expert_in").val("");
            $(".img-prev").hide();
            $("#doctor_form .btn-success").html("ثبت");
            $('#my-modal').modal('show');
        });

        function getDoctorData(id) {
            $("#doctor_form").attr("action", "ajax/update.php?d_id=" + id);
            $(".modal-title").html("ویرایش معلومات داکتر")
            $("#doctor_form .btn-success").html("بروزرسانی");
            $.ajax({
                type: "get",
                url: "ajax/get_info.php?d_id=" + id,
                success: function(response) {
                    var res = JSON.parse(response);
                    $("#email").val(res["email"]);
                    $("#password").val(res["password"]);
                    $("#name").val(res["name"]);
                    $("#phone").val(res["phone"]);
                    $("#address").val(res["address"]);
                    $("#inp-date").val(res["date"]);
                    $("#degree").val(res["degree"]);
                    $("#expert_in").val(res["expert_in"]);
                    $("#d_status").val(res["d_status"]);
                    $(".img-prev").show().attr("src", "uploads/" + res["image"]);
                }
            });
            $('#my-modal').modal('show');
        }

        function showImg(e) {
            if (e.target.files.length > 0) {
                var src = URL.createObjectURL(e.target.files[0]);
                $(".img-prev").show().attr("src", src)
            }
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
                    location.href = "delete.php?d_id=" + id
                }
            });
        }
    </script>
</body>

</html>
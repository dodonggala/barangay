<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); ?>
    <style>
        .input-size {
            width: 418px;
        }

        .table-responsive {
            min-height: 0 !important;
            overflow-x: unset;
        }

        .dropdown-menu {
            transform: translateX(-60%) !important;
        }
    </style>

    <body class="skin-black">
        <?php

        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <?php include('../sidebar-left.php'); ?>

            <aside class="right-side">
                <section class="content-header">
                    <h1>
                        Resident
                    </h1>

                </section>

                <?php
                if (!isset($_GET['resident'])) {
                ?>
                    <!-- Main content -->
                    <section class="content">
                        <div class="row">
                            <!-- left column -->
                            <div class="box">
                                <div class="box-header">
                                    <div style="padding:10px;">

                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addCourseModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Residents</button>
                                        <?php
                                        if (!isset($_SESSION['staff'])) {
                                        ?>
                                           
                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <form method="post" enctype="multipart/form-data">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <?php if (!isset($_SESSION['staff'])) { ?>
                                                        <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                    <?php } ?>
                                                    <th>Sitio</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Former Address</th>
                                                    <th style="width: 40px !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (!isset($_SESSION['staff'])) {
                                                    $squery = mysqli_query($con, "SELECT zone, id, CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident order by zone");
                                                    while ($row = mysqli_fetch_array($squery)) { ?>
                                                        <tr>
                                                            <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="'.$row['id'].'" /></td>
                                                            <td><?php echo $row['zone'] ?></td>
                                                            <td style="width:70px;">
                                                                <image src="image/<?php echo basename($row['image']) ?>" style="width:60px;height:60px;" />
                                                            </td>
                                                            <td><?php echo $row['cname'] ?></td>
                                                            <td><?php echo $row['age'] ?></td>
                                                            <td><?php echo $row['gender'] ?></td>
                                                            <td><?php echo $row['formerAddress'] ?></td>
                                                            <td>
                                                                <div style="display: flex; flex-direction: row; line-height: 70px; justify-content: space-between">
                                                                    <div>
                                                                        <button class="btn btn-primary btn-sm" data-target="#editModal<?php echo $row['id'] ?>" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                    </div>
                                                                    <div>
                                                                        <button class="btn btn-primary btn-sm delete-res" data-delete-res="<?php echo $row['id'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete</button>
                                                                    </div>
                                                                    <div>
                                                                        <div class="dropdown">

                                                                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select<span class="caret"></span>
                                                                            </button>

                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/clearance2.php?resident=<?php echo $row['id'] ?>&&by=<?php echo $_SESSION['role'] ?>">Baranggay Clearance</a>
                                                                                </li>

                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/indigency2.php?resident=<?php echo $row['id'] ?>">Indigency</a>
                                                                                </li>

                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/certification.php?resident=<?php echo $row['id'] ?>">Certification</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    <?php include "edit_modal.php";
                                                    }
                                                } else {
                                                    $squery = mysqli_query($con, "SELECT zone, id, CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident order by zone");
                                                    while ($row = mysqli_fetch_array($squery)) { ?>
                                                        <tr>
                                                            <td><?php echo $row['zone'] ?></td>
                                                            <td style="width:70px;">
                                                                <image src="image/<?php echo basename($row['image']) ?>" style="width:60px;height:60px;" />
                                                            </td>
                                                            <td><?php echo $row['cname'] ?></td>
                                                            <td><?php echo $row['age'] ?></td>
                                                            <td><?php echo $row['gender'] ?></td>
                                                            <td><?php echo $row['formerAddress'] ?></td>
                                                            <td>
                                                                <div style="display: flex; flex-direction: row; line-height: 70px; justify-content: space-between">
                                                                    <div>
                                                                        <button class="btn btn-primary btn-sm" data-target="#editModal<?php echo $row['id'] ?>" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button>
                                                                    </div>
                                                                    <div>
                                                                        <div class="dropdown">

                                                                            <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Select<span class="caret"></span>
                                                                            </button>

                                                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/clearance2.php?resident=<?php echo $row['id'] ?>">Baranggay Clearance</a>
                                                                                </li>

                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/indigency2.php?resident=<?php echo $row['id'] ?>">Indigency</a>
                                                                                </li>

                                                                                <li>
                                                                                    <a target="_blank" href="../clearance/certification.php?resident=<?php echo $row['id'] ?>">Certification</a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                <?php include "edit_modal.php";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <script>
                                            $(document).ready(function() {
                                                $('.delete-res').on('click', function() {
                                                    var resID = $(this).data('delete-res');

                                                    console.log(resID)

                                                    $.ajax({
                                                        url: 'delete.php',
                                                        type: 'POST',
                                                        data: {
                                                            'deleteResident': true,
                                                            'resID': resID
                                                        },
                                                        success: function(response) {
                                                            alert("Successfully deleted resident!");
                                                            location.reload();
                                                        }
                                                    })
                                                })
                                            })
                                        </script>

                                        <?php include "../deleteModal.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->

                            <?php include "../edit_notif.php"; ?>

                            <?php include "../added_notif.php"; ?>

                            <?php include "../delete_notif.php"; ?>

                            <?php include "../duplicate_error.php"; ?>

                            <?php include "add_modal.php"; ?>

                            <?php include "function.php"; ?>


                        </div> <!-- /.row -->
                    </section><!-- /.content -->


                <?php
                } else {
                ?>
                    <section class="content">
                        <div class="row">
                            <!-- left column -->
                            <div class="box">

                                <div class="box-body table-responsive">
                                    <form method="post" enctype="multipart/form-data">
                                        <table id="table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Age</th>
                                                    <th>Gender</th>
                                                    <th>Former Address</th>
                                                    <th style="width: 40px !important;">Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $squery = mysqli_query($con, "SELECT id,CONCAT(lname, ', ', fname, ' ', mname) as cname, age, gender, formerAddress, image FROM tblresident where householdnum = '" . $_GET['resident'] . "'");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                <tr>
                                                    <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['id'] . '" /></td>
                                                    <td style="width:70px;"><image src="image/' . basename($row['image']) . '" style="width:60px;height:60px;"/></td>
                                                    <td>' . $row['cname'] . '</td>
                                                    <td>' . $row['age'] . '</td>
                                                    <td>' . $row['gender'] . '</td>
                                                    <td>' . $row['formerAddress'] . '</td>
                                                    <td>
                                                    <button class="btn btn-primary btn-sm" data-target="#editModal' . $row['id'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                </tr>
                                                ';

                                                    include "edit_modal.php";
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                        <?php include "../deleteModal.php"; ?>
                                        <?php include "../duplicate_error.php"; ?>

                                    </form>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div> <!-- /.row -->
                    </section><!-- /.content -->
                <?php
                }
                ?>
            </aside>
        </div>


    <?php }

include "../footer.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 6]
                }],
                "aaSorting": []
            });
        });
    </script>
    </body>

</html>
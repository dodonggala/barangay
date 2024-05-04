<!DOCTYPE html>
<html>

<?php
session_start();
if (!isset($_SESSION['role'])) {
    header("Location: ../../login.php");
} else {
    ob_start();
    include('../head_css.php'); ?>

    <body class="skin-black">
        <!-- header logo: style can be found in header.less -->
        <?php

        include "../connection.php";
        ?>
        <?php include('../header.php'); ?>

        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php include('../sidebar-left.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        Household
                    </h1>

                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <!-- left column -->
                        <div class="box">
                            <div class="box-header">
                                <div style="padding:10px;">

                                    <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addModal"><i class="fa fa-user-plus" aria-hidden="true"></i> Add Household</button>

                                    <?php
                                    if (!isset($_SESSION['staff'])) {
                                    ?>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div><!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <form method="post">
                                    <table id="table" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <?php
                                                if (!isset($_SESSION['staff'])) {
                                                ?>
                                                    <th style="width: 20px !important;"><input type="checkbox" name="chk_delete[]" class="cbxMain" onchange="checkMain(this)" /></th>
                                                <?php
                                                }
                                                ?>
                                                <th>Household #</th>
                                                <th>Sitio</th>
                                                <th>Total Members</th>
                                                <th>Head of Family</th>
                                                <th style="width: 40px !important;">Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!isset($_SESSION['staff'])) {

                                                $squery = mysqli_query($con, "select *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname from tblhousehold h left join tblresident r on r.id = h.headoffamily");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="chk_delete[]" class="chk_delete" value="' . $row['hid'] . '" /></td>
                                                        <td><a href="../resident/resident.php?resident=' . $row['householdno'] . '">' . $row['householdno'] . '</a></td>
                                                        <td>' . $row['hzone'] . '</td>
                                                        <td>' . $row['totalhouseholdmembers'] . '</td>
                                                        <td>' . $row['headoffamily'] . '</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['hid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                    </tr>
                                                    ';

                                                    include "edit_modal.php";
                                                }
                                            } else {
                                                $squery = mysqli_query($con, "select *,h.id as hid,h.zone as hzone,CONCAT(r.lname, ', ', r.fname, ' ', r.mname) as hname from tblhousehold h left join tblresident r on r.id = h.headoffamily");
                                                while ($row = mysqli_fetch_array($squery)) {
                                                    echo '
                                                    <tr>
                                                        <td>' . $row['householdno'] . '</td>
                                                        <td>' . $row['hzone'] . '</td>
                                                        <td>' . $row['totalhouseholdmembers'] . '</td>
                                                        <td>' . $row['headoffamily'] . '</td>
                                                        <td><button class="btn btn-primary btn-sm" data-target="#editModal' . $row['hid'] . '" data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></td>
                                                    </tr>
                                                    ';
                                                    include "edit_modal.php";
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <?php include "../deleteModal.php"; ?>

                                </form>
                            </div>
                        </div>

                        <?php include "../edit_notif.php"; ?>

                        <?php include "../added_notif.php"; ?>

                        <?php include "../delete_notif.php"; ?>

                        <?php include "../duplicate_error.php"; ?>

                        <?php include "add_modal.php"; ?>

                        <?php include "function.php"; ?>

                    </div>
                </section>
            </aside>
        </div>
    <?php }
include "../footer.php"; ?>
    <script type="text/javascript">
        $(function() {
            $("#table").dataTable({
                "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 5]
                }],
                "aaSorting": []
            });
            $(".select2").select2();
        });
    </script>
    </body>

</html>
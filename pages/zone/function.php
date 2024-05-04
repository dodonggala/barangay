<?php
if (isset($_POST['btn_add_new'])) {
    $txt_zone = $_POST['txt_zone'];
    $txt_uname = $_POST['txt_uname'];
    $txt_pass = $_POST['txt_pass'];

    if (isset($_SESSION['role'])) {
        $action = 'Added Zone number ' . $txt_zone;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    $query = mysqli_query($con, "INSERT INTO tblzone (zone,username,password) values ('$txt_zone', '$txt_uname', '$txt_pass')");
    
    if ($query == true) {
        $_SESSION['added'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}


if (isset($_POST['btn_save'])) {
    $txt_id = $_POST['hidden_id'];
    $txt_edit_zone = $_POST['txt_edit_zone'];
    $txt_edit_uname = $_POST['txt_edit_uname'];
    $txt_edit_pass = $_POST['txt_edit_pass'];

    if (isset($_SESSION['role'])) {
        $action = 'Update Zone number ' . $txt_edit_busname;
        $iquery = mysqli_query($con, "INSERT INTO tbllogs (user,logdate,action) values ('" . $_SESSION['role'] . "', NOW(), '" . $action . "')");
    }

    $update_query = mysqli_query($con, "UPDATE tblzone set zone = '" . $txt_edit_zone . "', username = '" . $txt_edit_uname . "', password = '" . $txt_edit_pass . "' where id = '" . $txt_id . "' ") or die('Error: ' . mysqli_error($con));

    if ($update_query == true) {
        $_SESSION['edited'] = 1;
        header("location: " . $_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['btn_delete'])) {
    if (isset($_POST['chk_delete'])) {
        foreach ($_POST['chk_delete'] as $value) {
            $delete_query = mysqli_query($con, "DELETE from tblzone where id = '$value' ") or die('Error: ' . mysqli_error($con));

            if ($delete_query == true) {
                $_SESSION['delete'] = 1;
                header("location: " . $_SERVER['REQUEST_URI']);
            }
        }
    }
}

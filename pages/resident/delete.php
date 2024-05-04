<?php

$con = mysqli_connect('localhost','root','','db_barangay') or die("error");

if(isset($_POST['deleteResident'])){
    $id = mysqli_real_escape_string($con, $_POST['resID']);

    $sql = mysqli_query($con, "DELETE FROM tblresident WHERE id=$id");

    if($sql){
        echo "Resident data deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

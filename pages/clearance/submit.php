<?php


if (isset($_POST['store-data'])) {
    $id = $_POST['id'];
    $by = $_POST['by'];
    $no = rand(10000, 99999);

    $insertres_query = mysqli_query($con, "INSERT INTO tblclearance (clearanceNo, residentid, dateRecorded, recordedBy) VALUES ('$no', '$id', NOW(), '$by')") or die('Error: ' . mysqli_error($con));

}
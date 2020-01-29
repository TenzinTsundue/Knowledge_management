<?php
session_start();
include 'connect.php';

$id= 0;
$update = false;
$name = '';
$guid = '';
$year = '';

if(isset($_POST['save'])) {
    $name = $_POST['name'];
    $guid = $_POST['guideline'];
    $year = $_POST['year'];

    $sql = "INSERT INTO donor(donor_name, guideline, year) VALUES ('$name', '$guid', '$year')";
    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");
}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql ="DELETE FROM donor WHERE id=$id";
    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;

    $sql = "SELECT * FROM donor WHERE id=$id";
    $result = $conn->query($sql) or die($conn->error);

    if (count($result)==1) {
        $row = $result-> fetch_array();
        $name = $row['donor_name'];
        $guid = $row['guideline'];
        $year = $row['year'];
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $guid =$_POST['guideline'];
    $year =$_POST['year'];

    $sql = "UPDATE donor SET donor_name='$name', guideline='$guid', year = '$year' WHERE id=$id ";
    $conn->query($sql) or die($conn->error);

    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";

    header("location: index.php");
}
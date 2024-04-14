<?php
    session_start();
    $_SESSION['registration-id'] = $_POST["registration-id"];
    $_SESSION['registration-name'] = $_POST['registration-name'];
    $_SESSION['registration-password'] = $_POST["registration-password"];
    $_SESSION['registration-role'] = $_POST["RoleRadio"];
    if($_POST['RoleRadio'] == "Student") {
        header("Location: register-student.php");
        exit;
    }
    if($_POST['RoleRadio'] == "Faculty") {
        header("Location: register-faculty.php");
        exit;
    }
?>
<?php
    session_start();
    include "connect_to_db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    $id = $_SESSION['registration-id'];
    $pwd = $_SESSION['registration-password'];
    $role = $_SESSION['registration-role'];
    $name = $_SESSION['registration-name'];
    if ($role == "Student") {
        $gpa = $_POST['gpa'];
        $enrollmentYear = $_POST['enrollmentYear'];
        $graduationYear = $_POST['graduationYear'];
        $major = $_POST['major'];
        $department = $_POST['department'];

        $user_insertion = "INSERT INTO users (userid, password, role) VALUES ('$id', '$pwd', '$role')";
        $student_insertion = "INSERT INTO student (student_id, name, year_of_enrollment, major, GPA, year_of_graduation, department) 
        VALUES ('$id', '$name', '$enrollmentYear', '$major', '$gpa', '$graduationYear', '$department')";

        if ($connect->query($user_insertion) === TRUE && $connect->query($student_insertion) === TRUE) {
            header("Location: confirm_user_registration.php");
            exit;
        } else {
            echo "Error: " . $connect->error;
        }
    }
    if ($role == "Faculty") {
        $doj = $_POST['dateOfJoin'];
        $qualification = $_POST['qualification'];
        $department = $_POST['department'];
        $title = $_POST['title'];

        $user_insertion = $connect->prepare("INSERT INTO users (userid, password, role) VALUES (?, ?, ?)");
        $user_insertion->bind_param("sss", $id, $pwd, $role);

        $faculty_insertion = $connect->prepare("INSERT INTO faculty (faculty_id, name, DOJ, qualification, department, title) VALUES (?, ?, ?, ?, ?, ?)");
        $faculty_insertion->bind_param("ssssss", $id, $name, $doj, $qualification, $department, $title);

        if ($user_insertion->execute() === TRUE && $faculty_insertion->execute() === TRUE) {
            header("Location: confirm_user_registration.php");
            exit;
        } else {
            echo "Error: " . $connect->error;
        }
    }
    ?>
?>
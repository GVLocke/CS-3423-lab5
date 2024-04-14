<?php 
session_start();
include "connect_to_db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['UserID'];
    $pwd = $_POST['Password'];

    // Validate the credentials
    $stmt = "SELECT sid, password, role FROM users WHERE userid = '$id'";
    $result = $connect->query($stmt);
    
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $database_pwd = $row["password"];
            $role = $row["role"];
            $sid = $row['sid'];
            // Check if the password matches
            if ($database_pwd == $pwd) {
                $_SESSION['id'] = $id;
                $_SESSION['role'] = $role;
                $_SESSION['sid'] = $sid;
                $_SESSION['pwd'] = $pwd;
                if ($_SESSION['role'] == "Student") {
                    $stmt = "SELECT * FROM student WHERE student_id = '{$_SESSION['id']}'";
                    $result = $connect->query($stmt);
                    $row = $result->fetch_assoc();
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['enrollment_year'] = $row["year_of_enrollment"];
                    $_SESSION['major'] = $row["major"];
                    $_SESSION['gpa'] = $row["GPA"];
                    $_SESSION['graduation-year'] = $row["year_of_graduation"];
                    header("Location: student_index.php");
                    exit;
                }
                if ($_SESSION['role'] == "Faculty") {
                    $stmt = "SELECT * FROM faculty WHERE faculty_id = '{$_SESSION['id']}'";
                    $result = $connect->query($stmt);
                    $row = $result->fetch_assoc();
                    $_SESSION['name'] = $row["name"];
                    $_SESSION['title'] = $row["title"];
                    $_SESSION['doj'] = $row["DOJ"];
                    $_SESSION['qualification'] = $row["qualification"];
                    $_SESSION['department'] = $row["department"];
                    header("Location: faculty_index.php");
                    exit;
                }
                if ($_SESSION['role'] == "Admin") {
                    header("Location: admin_index.php");
                    $stmt = "SELECT * FROM admin WHERE admin_id = '{$_SESSION['id']}'";
                    $result = $connect->query($stmt);
                    $row = $result->fetch_assoc();
                    $_SESSION['name'] = $row["name"];
                    exit;
                }
            }
        }
    }
    // Handle invalid credentials
    $_SESSION['login-failed'] = 1;
    header("Location: index.php");
}
?>
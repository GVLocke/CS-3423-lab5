<?php
    session_start();
    include "connect_to_db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    if (isset($_POST['selected-course-department'])) {
        $_SESSION['selected-course-department'] = $_POST['selected-course-department']; 
    }
    if (isset($_POST['selected-student-department'])) {
        $_SESSION['selected-student-department'] = $_POST['selected-student-department']; 
    }
    if (isset($_POST['selected-department'])) {
        $_SESSION['selected-department'] = $_POST['selected-department']; 
    }

    include "navbar-topbar.php";
    include "javascript-libraries.php";
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('input[type=radio][name=RoleRadio]').change(function() {
        if (this.value == 'student') {
            $('#studentFields').show();
        } else {
            $('#studentFields').hide();
        }
    });
});
</script>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0">Courses</h6>
            <div class="d-inline-flex">
                <form action="admin_index.php"  method="POST">
                    <select class="form-select form-select-sm mb-3 me-3" name="selected-course-department" aria-label=".form-select-sm example">
                        <option selected>Department</option>
                        <?php
                            $sql_departments = "SELECT * FROM department_code_mapper";
                            $result_departments = $connect->query($sql_departments);
                            while ($row_department = $result_departments->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_department['code_key']?>"><?php echo $row_department['department']?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <?php if (isset($_SESSION['selected-course-department'])): ?>
        <div class="table-responsive">
            <?php 
                $selected_department = $_SESSION['selected-course-department'];
                $like_string = $selected_department . "-%";
                $sql_classes = "SELECT * FROM courses WHERE course_code LIKE '$like_string' ORDER BY course_code ASC";
                $result_courses = $connect->query($sql_classes);
                if ($result_courses && $result_courses ->num_rows == 0) {
                    ?><p>No courses found!</p><?php
                } else {

            ?>
            <form action="confirm_registration.php" method="POST">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Course Code</th>
                            <th scope="col">Course Name</th>
                            <th scope="col">Offered:</th>
                            <th scope="col">Credits</th>
                            <th scope="col">Requisites</th>
                            <th scope="col">Type</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $selected_department = $_SESSION['selected-course-department'];
                            $like_string = $selected_department . "-%";
                            $sql_classes = "SELECT * FROM courses WHERE course_code LIKE '$like_string' ORDER BY course_code ASC";
                            $result_classes = $connect->query($sql_classes);

                            while ($row_class = $result_classes->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row_class['course_code']?></td>
                                    <td><?php echo $row_class['course_name']?></td>
                                    <td><?php echo $row_class['offered_in']?></td>
                                    <td><?php echo $row_class['credits']?></td>
                                    <td><?php echo $row_class['pre_req']?></td>
                                    <td><?php echo $row_class['type']?></td>
                                </tr>
                            <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <?php else: ?>
        <p>Select a department to search courses!<p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0">Faculty</h6>
            <div class="d-inline-flex">
                <form action="admin_index.php"  method="POST">
                    <select class="form-select form-select-sm mb-3 me-3" name="selected-department" aria-label=".form-select-sm example">
                        <option selected>Department</option>
                        <?php
                            $sql_departments = "SELECT department FROM department_code_mapper";
                            $result_departments = $connect->query($sql_departments);
                            while ($row_department = $result_departments->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_department['department']?>"><?php echo $row_department['department']?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <?php if (isset($_SESSION['selected-department'])): ?>
        <div class="table-responsive">
            <?php
                $selected_department = $_SESSION['selected-department'];
                $sql_faculty= "SELECT * FROM faculty WHERE department = '$selected_department'";
                $result_faculty = $connect->query($sql_faculty);
                if ($result_faculty && $result_faculty ->num_rows == 0) {
                    ?><p>No faculty found!</p><?php
                } else {

            ?>
            <form action="confirm_registration.php" method="POST">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Faculty ID</th>
                            <th scope="col">DOJ</th>
                            <th scope="col">Qualification</th>
                            <th scope="col">Title</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            while ($row_class = $result_faculty->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $row_class['name']?></td>
                                    <td><?php echo $row_class['faculty_id']?></td>
                                    <td><?php echo $row_class['DOJ']?></td>
                                    <td><?php echo $row_class['qualification']?></td>
                                    <td><?php echo $row_class['title']?></td>
                                </tr>
                            <?php
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <?php else: ?>
        <p>Select a department to search faculty!<p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0">Students</h6>
            <div class="d-inline-flex">
                <form action="admin_index.php"  method="POST">
                    <select class="form-select form-select-sm mb-3 me-3" name="selected-student-department" aria-label=".form-select-sm example">
                        <option selected>Department</option>
                        <?php
                            $sql_departments = "SELECT department FROM department_code_mapper";
                            $result_departments = $connect->query($sql_departments);
                            while ($row_department = $result_departments->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $row_department['department']?>"><?php echo $row_department['department']?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        <?php if (isset($_SESSION['selected-student-department'])): ?>
        <div class="table-responsive">
            <?php
                $selected_department = $_SESSION['selected-student-department'];
                $sql_student= "SELECT * FROM student WHERE department = '$selected_department'";
                $result_student= $connect->query($sql_student);
                if ($result_student && $result_student->num_rows == 0) {
                    ?><p>No students found!</p><?php
                } else {
            ?>
            <form action="confirm_registration.php" method="POST">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Student ID</th>
                            <th scope="col">Year of Enrollment</th>
                            <th scope="col">Year of Graduation</th>
                            <th scope="col">Major</th>
                            <th scope="col">GPA</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                while ($row_class = $result_student ->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row_class['name']?></td>
                                        <td><?php echo $row_class['student_id']?></td>
                                        <td><?php echo $row_class['year_of_enrollment']?></td>
                                        <td><?php echo $row_class['year_of_graduation']?></td>
                                        <td><?php echo $row_class['major']?></td>
                                        <td><?php echo $row_class['GPA']?></td>
                                    </tr>
                                    <?php
                                } 
                            }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <?php else: ?>
        <p>Select a department to search students!<p>
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h6 class="mb-0">Departments</h6>
        </div>
        <div class="table-responsive">
            <?php
                $sql_department_info= "SELECT * FROM department";
                $result_department_info= $connect->query($sql_department_info);
            ?>
            <form action="confirm_registration.php" method="POST">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col">Name</th>
                            <th scope="col">Department ID</th>
                            <th scope="col">Chair</th>
                            <th scope="col">Dean</th>
                            <th scope="col">Budget</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                                while ($row_department_info = $result_department_info->fetch_assoc()) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row_department_info['name']?></td>
                                        <td><?php echo $row_department_info['department_id']?></td>
                                        <td><?php echo $row_department_info['chair']?></td>
                                        <td><?php echo $row_department_info['dean']?></td>
                                        <td>$<?php echo $row_department_info['budget']?></td>
                                    </tr>
                                    <?php
                                } 
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Register New User</h6>
                    <form action="register-check-role.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="userID" name="registration-name">                     
                        </div>
                        <div class="mb-3">
                            <label for="userID" class="form-label">UserID</label>
                            <input type="text" class="form-control" id="userID" name="registration-id">                       
                        </div>
                        <div class="mb-3">
                            <label for="InputPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="InputPassword" name="registration-password">
                        </div>
                        <fieldset class="row mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Role</legend>
                            <div class="col-sm-10">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="RoleRadio"
                                        id="gridRadiosStudent" value="Student" checked>
                                    <label class="form-check-label" for="gridRadiosStudent">
                                        Student 
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="RoleRadio"
                                        id="gridRadiosFaculty" value="Faculty">
                                    <label class="form-check-label" for="gridRadiosFaculty">
                                        Faculty 
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </h6>
            </div>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>
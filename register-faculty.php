<?php
    session_start();
    include "connect_to_db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    include "navbar-topbar.php";
    include "javascript-libraries.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center p-4">
            <h4>Confirm a few more details for us...</h4>
            <form action="register-query.php" method="POST">
                <div class="mb-3">
                    <label for="dateOfJoin" class="form-label">Date of Joining</label>
                    <input type="date" class="form-control" id="dateOfJoin" name="dateOfJoin"> 
                <div class="mb-3">
                    <label for="qualification" class="form-label">Qualification</label>
                    <input type="text" class="form-control" id="qualification" name="qualification">
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <select class="form-select form-select-sm mb-3 me-3" name="department" aria-label=".form-select-sm example">
                            <option selected>Department</option>
                            <?php
                                $sql_departments = "SELECT department FROM department_code_mapper";
                                $result_departments = $connect->query($sql_departments);
                                while ($row_department = $result_departments->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $row_department['department']?>"><?php echo $row_department['department']?></option>
                            <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <button type="submit" class="btn btn-primary">Complete Registration</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>
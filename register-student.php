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
                    <label for="enrollmentYear" class="form-label">Year of Enrollment</label>
                    <input type="text" class="form-control" id="enrollmentYear" name="enrollmentYear">
                </div>
                <div class="mb-3">
                    <label for="graduationYear" class="form-label">Year of Graduation</label>
                    <input type="text" class="form-control" id="graduationYear" name="graduationYear">
                </div>
                <div class="mb-3">
                    <label for="major" class="form-label">Major</label>
                    <input type="text" class="form-control" id="major" name="major">
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department">
                </div>
                <div class="mb-3">
                    <label for="gpa" class="form-label">GPA</label>
                    <input type="text" class="form-control" id="gpa" name="gpa">
                </div>
                <button type="submit" class="btn btn-primary">Complete Registration</button>
            </form>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>
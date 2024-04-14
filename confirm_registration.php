<?php
    session_start();
    if(!isset($_POST['course_checkboxes'])) {
        header("Location: student_index.php");
        exit;
    }
    include "navbar-topbar.php";
    include "javascript-libraries.php";
    
?>


<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="col-md-6 text-center p-4">
            <i class="bi bi-check-circle-fill display-1 text-primary"></i>
            <ul class="list-unstyled mb-0">
            <h1>Registration Confirmed!</h1>
            <?php
                $selected_checkboxes = $_POST['course_checkboxes'];
                foreach ($selected_checkboxes as $selected) {
                    ?>
                    <div class="p-2 mb-0 bg-transparent text-primary"> <?php echo $selected; ?> </div>
                <?php }
            ?>
            </ul>
            <a class="btn btn-primary rounded-pill py-3 px-5" href="student_index.php">Go Back To Home</a>
        </div>
    </div>
</div>
<?php include "footer.php" ?>
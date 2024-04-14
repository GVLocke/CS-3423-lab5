<?php
    session_start();
    if(!isset($_SESSION['registration-name'])) {
        header("Location: admin_index.php");
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
            <p><?php echo $_SESSION['registration-name']?> has been successfully registered.</p>
            <a class="btn btn-primary rounded-pill py-3 px-5" href="admin_index.php">Go Back To Home</a>
        </div>
    </div>
</div>
<?php include "footer.php" ?>
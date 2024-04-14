<?php
    session_start();
    include "connect_to_db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    include "navbar-topbar.php";
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="h-100 bg-secondary rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0"><?php echo $_SESSION['major'];?> Faculty</h6>
                </div>
                <?php
                $sql_faculty = "SELECT name, title FROM faculty WHERE department = '".$_SESSION['major']."'";
                $result_faculty = $connect->query($sql_faculty);
                
                while ($row_faculty = $result_faculty->fetch_assoc()) {
                ?>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="img/user.png" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0"><?php echo $row_faculty['name'] ?></h6>
                        </div>
                        <span><?php echo $row_faculty['title']?></span>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Profile</h6>
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item text-center">
                            <img class="img-fluid rounded-circle mx-auto mb-4" src="img/user.png" style="width: 100px; height: 100px;">
                            <h5 class="mb-1"><?php echo $_SESSION['name'];?></h5>
                            <dl class="row mb-0">
                                <dt class="col-sm-4">UserID</dt>
                                <dd class="col-sm-8"><?php echo $_SESSION['id']?></dd>

                                <dt class="col-sm-4">Graduation Year</dt>
                                <dd class="col-sm-8"><?php echo $_SESSION['graduation-year']?></dd>

                                <dt class="col-sm-4">Major</dt>
                                <dd class="col-sm-8"><?php echo $_SESSION['major']?></dd>

                                <dt class="col-sm-4">GPA</dt>
                                <dd class="col-sm-8"><?php echo $_SESSION['gpa']?></dd>
                        </div>
                </div>
            </div>
        </div>
     </div> 
</div>

<?php
    include "all-courses-view.php";
    include "footer.php";
    include "javascript-libraries.php";
?>
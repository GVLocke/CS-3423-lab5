<?php
    session_start();
    include "connect_to_db.php";

    if (!isset($_SESSION['id'])) {
        header("Location: index.php");
        exit;
    }

    include "navbar-topbar.php";
?>
<!-- Courses Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">My Courses</h6>
            <a href="">Show All</a>
        </div>
        <div class="table-responsive">
            <table class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th scope="col"><input class="form-check-input" type="checkbox"></th>
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
                        $sql_classes = "SELECT * FROM courses WHERE faculty_id = '".$_SESSION['id']."' ORDER BY course_code ASC";
                        $result_classes = $connect->query($sql_classes);

                        while ($row_class = $result_classes->fetch_assoc()) {
                        ?>
                            <tr>
                                <td><input class="form-check-input" type="checkbox"></td>
                                <td><?php echo $row_class['course_code']?></td>
                                <td><?php echo $row_class['course_name']?></td>
                                <td><?php echo $row_class['offered_in']?></td>
                                <td><?php echo $row_class['credits']?></td>
                                <td><?php echo $row_class['pre_req']?></td>
                                <td><?php echo $row_class['type']?></td>
                            </tr>
                        <?php
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Courses End -->


<!-- Widgets Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
    <div class="col-sm-12 col-xl-6">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Profile</h6>
                <div class="owl-carousel testimonial-carousel">
                    <div class="testimonial-item text-center">
                        <img class="img-fluid rounded-circle mx-auto mb-4" src="img/user.png" style="width: 100px; height: 100px;">
                        <h5 class="mb-1"><?php echo $_SESSION['name'];?></h5>
                        <p><?php echo $_SESSION['title'];?></p>
                        <dl class="row mb-0">
                            <dt class="col-sm-4">UserID</dt>
                            <dd class="col-sm-8"><?php echo $_SESSION['id']?></dd>

                            <dt class="col-sm-4">Date of Joining</dt>
                            <dd class="col-sm-8"><?php echo $_SESSION['doj']?></dd>

                            <dt class="col-sm-4">Department</dt>
                            <dd class="col-sm-8"><?php echo $_SESSION['department']?></dd>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>
<!-- Widgets End -->

<?php 
    include "footer.php"; 
    include "javascript-libraries.php"
?>
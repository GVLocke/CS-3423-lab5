<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary text-center rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h6 class="mb-0">Register for Courses</h6>
        </div>
        <div class="table-responsive">
            <form action="confirm_registration.php" method="POST">
                <table class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th scope="col"></th>
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
                            $sql_classes = "SELECT * FROM courses ORDER BY course_code ASC";
                            $result_classes = $connect->query($sql_classes);

                            while ($row_class = $result_classes->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><input class="form-check-input" type="checkbox" name="course_checkboxes[]" value="<?php echo $row_class['course_code']; ?>"></td>                                   
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
                <br>
                <button type="submit" class="btn btn-primary" style="float: right;">Register</button>
            </form>
        </div>
    </div>
</div>
<?php
session_start();
include '../../connect.php';
if (isset($_SESSION['username'], $_SESSION['password'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>For Training</title>
    </head>

    <body>
        <?php
        if (isset($_SESSION['successMessage'])) { ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: "<?php echo $_SESSION['successMessage']; ?>",
                })
            </script>
            <?php unset($_SESSION['successMessage']);
        } ?>

        <?php
        if (isset($_SESSION['errorMessage'])) { ?>
            <script>
                Swal.fire({
                    icon: 'error',
                    title: "<?php echo $_SESSION['errorMessage']; ?>",
                })
            </script>
            <?php unset($_SESSION['errorMessage']);
        }
        ?>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php include '../components/sidebar.php'; ?>

                <!-- Main page -->
                <div class="layout-page">
                    <?php include '../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper mt-2">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4">
                                            FOR TRAINING
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table" style="width: 100%; font-size: 13px !important;" id="example">
                                        <thead>
                                            <tr>
                                                <th>Employee Name</th>
                                                <th>Orientation Status</th>
                                                <th>Orientation Type</th>
                                                <th>Date Oriented</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM employees";
                                            $result = $link->query($query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['firstnameko'] . " " . $row['mnko'] . " " . $row['lastnameko'] . " " . $row['extnname']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['orientation_status'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['orientation_type'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['orientation_date'] ?>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal-<?php echo $row['id'];?>">
                                                            Update Status
                                                        </button>
                                                    </td>


                                                    <!-- Modal for Update Status -->
                                                    <div class="modal fade" id="updateStatusModal-<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?php 
                                                                    date_default_timezone_set('Asia/Manila');
                                                                    $date_now = date('m/d/Y');
                                                                    
                                                                    $select = "SELECT * FROM employees WHERE id = '" . $row['id'] . "'";
                                                                    $select_result = $link->query($select);
                                                                    $select_row = $select_result->fetch_assoc();
                                                                ?>
                                                                <form action="action.php" method="POST" class="form-group row">
                                                                    <input type="hidden" name="employee_id" class="form-control" value="<?php echo $row['id'];?>">
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Orientation Date</label>
                                                                        <input type="text" name="orientation_date" id="orientation_date" class="form-control" value="<?php echo $date_now; ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Employee Name</label>
                                                                        <input type="text" name="employee_name" id="employee_name" class="form-control" value="<?php echo $select_row['firstnameko'] . " " . $select_row['mnko'] . " " . $select_row['lastnameko'] . " " . $select_row['extnname']; ?>" readonly>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Training Type</label>
                                                                        <select name="training_type" id="training_type" class="form-select" required>
                                                                            <option value="" selected disabled>Select</option>
                                                                            <option value="Newly Hired Training / Code of Conduct">Newly Hired Training / Code of Conduct</option>
                                                                            <option value="Code of Conduct Refresher / Old Employees">Code of Conduct Refresher / Old Employees</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Business Division</label>
                                                                        <select name="business_division" id="business_division" class="form-select" required>
                                                                            <option value="" selected disabled>Select</option>
                                                                            <?php
                                                                                $division = "SELECT * FROM divisions WHERE is_deleted = '0'";
                                                                                $division_result = $link->query($division);
                                                                                while($division_row = $division_result->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $division_row['description'];?>"><?php echo $division_row['description'];?></option>
                                                                            <?php }?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Project Title</label>
                                                                        <input list="project_titles" name="project_title" id="project_title" class="form-control">
                                                                        <datalist id="project_titles">
                                                                            <?php
                                                                                $project = "SELECT * FROM projects WHERE is_deleted = '0'";
                                                                                $project_result = $link->query($project);
                                                                                while($project_row = $project_result->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $project_row['project_title'];?>"><?php echo $project_row['project_title'];?></option>
                                                                            <?php }?>
                                                                        </datalist>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <label for="" class="form-label">Job Title</label>
                                                                        <input list="job_titles" name="job_title" id="job_title" class="form-control">
                                                                        <datalist id="job_titles">
                                                                            <?php
                                                                                $job_title = "SELECT * FROM job_title WHERE is_deleted = '0'";
                                                                                $job_title_result = $link->query($job_title);
                                                                                while($job_title_row = $job_title_result->fetch_assoc()){
                                                                            ?>
                                                                            <option value="<?php echo $job_title_row['description'];?>"><?php echo $job_title_row['description'];?></option>
                                                                            <?php }?>
                                                                        </datalist>
                                                                    </div>
                                                                
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" name="submit_orientation_btn" class="btn btn-primary">Submit</button>
                                                            </div>
                                                            </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include '../components/footer.php'; ?>
    </body>

    </html>
    <?php
} else {
    header("Location: ../../index.php");
    session_destroy();
    exit(0);
}
?>
<?php
include '../../connect.php';
session_start();

date_default_timezone_set('Asia/Hong_Kong');
$datenow = date("m/d/Y");

if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>MRF List - Deployed Employees</title>

        <style>
            * {
                font-family: 'Inter', sans-serif;
            }

            .form-check-label,
            .form-control {
                font-size: 13px;
            }

            .indent {
                text-decoration: underline;
                color: #3876BF;
                font-weight: bold;
            }

            .icon:hover {
                color: red;
            }

            .form-check-input {
                pointer-events: none;
            }

            .contain {
                display: grid;
                grid-template-columns: 0fr 0fr;
                grid-template-rows: 0fr 0fr;
                gap: 5px;
                margin: 0 auto;
            }

            .columns .btn {
                box-shadow: rgba(60, 64, 67, 0.3) 0px 1px 2px 0px, rgba(60, 64, 67, 0.15) 0px 1px 3px 1px;
            }
        </style>
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

                <div class="layout-page">
                    <?php include '../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper mt-3">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4">
                                            DEPLOYED EMPLOYEES
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date Requested</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Category</th>
                                                <th class="text-center">Division</th>
                                                <th class="text-center">Project Title</th>
                                                <th class="text-center">Date Start</th>
                                                <th class="text-center">Date End</th>
                                                <th class="text-center">Request Status</th>
                                                <th class="text-center">LOA Status</th>
                                                <th class="text-center">LOA Files</th>
                                                <th class="text-center">Requested By</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $requested_by_id = $_SESSION['user_id'];
                                            $query = "SELECT employee.*, project.*, request.*, deployment.*,
                                                DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested,
                                                DATE_FORMAT(request.start_date, '%M %d, %Y') AS start_date, 
                                                DATE_FORMAT(request.end_date, '%M %d, %Y') AS end_date,
                                                deployment.id AS deployment_id
                                                FROM employees employee, projects project, loa_requests request, deployment deployment
                                                WHERE employee.id = request.employee_id
                                                AND project.id = request.project_id
                                                AND employee.id = deployment.employee_id
                                                AND request.request_status = 'DEPLOYED'";
                                            $result = $link->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                $employee_id = $row['employee_id'];
                                                $deployment_id = $row['deployment_id'];
                                                
                                                $select_folder = "SELECT * FROM folder WHERE employee_id = '$employee_id' AND deployment_id = '$deployment_id'";
                                                $select_folder_result = $link->query($select_folder);
                                                $select_folder_row = $select_folder_result->fetch_assoc();
                                                
                                                $fileNames = explode(',', $row['signed_loa_file']);
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $row['date_requested'] ?></td>
                                                    <td class="text-center"><?php echo $row['lastnameko'] . ", " . $row['firstnameko'] . " " . $row['mnko'] . " " . $row['extnname'] ?></td>
                                                    <td class="text-center"><?php echo $row['category'] ?></td>
                                                    <td class="text-center"><?php echo $row['division'] ?></td>
                                                    <td class="text-center"><?php echo $row['project_title'] ?></td>
                                                    <td class="text-center"><?php echo $row['start_date'] ?></td>
                                                    <td class="text-center"><?php echo $row['end_date'] ?></td>
                                                    <td class="text-center">
                                                        <span class="badge rounded bg-success"><?php echo $row['request_status'] ?></span>
                                                    </td>
                                                    <td class="text-center"><?php echo $row['signed_loa_status'] ?></td>
                                                    <td class="text-center">
                                                        <?php
                                                            foreach ($fileNames as $fileName) {
                                                                echo '<a href="https://jobs.hrdpcnpromopro.com/' . $select_folder_row['folder_path'] . '/' . $fileName . '" download>' . $fileName . '</a><br>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td class="text-center"><?php echo $row['requested_by'] ?></td>
                                                    <td>
                                                        <?php
                                                        if ($row['signed_loa_status'] === 'UNRETURN') {
                                                        ?>
                                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadSignedLOAFileModal-<?php echo $row['deployment_id'] ?>">Upload</button>
                                                        <?php } else {
                                                            echo "";
                                                        }
                                                        ?>
                                                    </td>

                                                    <!-- Modal for Uploading Signed LOA -->
                                                    <div class="modal fade" id="uploadSignedLOAFileModal-<?php echo $row['deployment_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">
                                                                        <form action="mrf_action.php" method="post" class="form-group row" enctype="multipart/form-data">
                                                                            <input type="hidden" name="deployment_id" value="<?php echo $row['deployment_id']; ?>">
                                                                            <div class="col-md-12">
                                                                                <label for="files" class="form-label">Attach File</label>
                                                                                <input type="file" name="files[]" id="files" class="form-control" multiple required>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="uploadFile_btn" class="btn btn-primary">Upload</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </tr>
                                            <?php }
                                            ?>
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
    header('Location: ../../index.php');
    session_destroy();
    exit();
}
?>
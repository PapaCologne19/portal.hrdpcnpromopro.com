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
            <title>MRF List</title>

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
                                        <div class="title text-center">
                                            <h4 class="fs-4">
                                                LISTS OF MRF
                                            </h4>
                                        </div>
                                        <hr>
                                        <table class="table table-sm" id="example">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">Date Created</th>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Tracking Number</th>
                                                    <th class="text-center">Project Title</th>
                                                    <th class="text-center">Prepared By</th>
                                                    <th class="text-center">Needed</th>
                                                    <th class="text-center">Provided</th>
                                                    <th class="text-center">Deployed</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM mrf";
                                                $result = $link->query($query);
                                                while ($row = $result->fetch_assoc()) {
                                                    
                                                    $inputDate = $row['dt_now'];
                                                    $timestamp = strtotime($inputDate);
                                                    $formattedDate = date("F d, Y", $timestamp);
                                                    $id = $row['id'];
                                                    $project_title = $row['project_title'];
                                                    $needed = $row['np_male'] + $row['np_female'];
                                                    


                                                    $selected = "SELECT mrf.*, project.*, resumes.* 
                                                        FROM mrf mrf, projects project, applicant_resume resumes 
                                                        WHERE mrf.tracking = project.mrf_tracking 
                                                        AND resumes.project_id = project.id 
                                                        AND project.project_title = '$project_title' 
                                                        AND project.mrf_id = '$id'
                                                        AND resumes.status = 'QUALIFIED'";
                                                    $selected_result = $link->query($selected);

                                                    $provided = $selected_result->num_rows;
                                                    
                                                    // For Deployed
                                                    $select_deployed = "SELECT deployment.*, mrf.*, project.* 
                                                    FROM deployment deployment, mrf mrf, projects project
                                                    WHERE project.mrf_id = mrf.id
                                                    AND project.project_title = deployment.shortlist_title
                                                    AND deployment.shortlist_title = '$project_title'
                                                    AND deployment.clearance = 'ACTIVE'";
                                                    $select_deployed_result = $link->query($select_deployed);
                                                    $deployed = $select_deployed_result->num_rows;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $formattedDate ?></td>
                                                        <td class="text-center"><?php echo $row['id'] ?></td>
                                                        <td class="text-center"><?php echo $row['tracking'] ?></td>
                                                        <td class="text-center"><?php echo $row['project_title'] ?></td>
                                                        <td class="text-center"><?php echo $row['prepared_by'] ?></td>
                                                        <td class="text-center"><?php echo $needed ?></td>
                                                        <td class="text-center"><?php echo $provided ?></td>
                                                        <td class="text-center"><?php echo $deployed ?></td>
                                                        <td class="text-center">
                                                            <div class="contain">
                                                                <div class="columns">
                                                                    <input type="hidden" name="ids" class="ids" id="ids" value="<?php echo $row['id']; ?>">
                                                                    <button type="button" class="btn btn-primary btn-sm btnview btntooltips" title="View MRF" data-bs-toggle="modal" data-bs-target="#viewmrf"><i class="bi bi-eye icon"></i></button>
                                                                </div>
                                                                <div class="columns">
                                                                    <button type="button" class="btn btn-dark btn-sm btnprint" id="btnprint" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Print MRF" onclick="location.href = 'mrf_print_mrf.php?id=<?php echo $row['id'] ?>'"><i class="bi bi-printer icon"></i></button>
                                                                </div>

                                                                <?php
                                                                if ($row['is_approve'] === '1') {
                                                                ?>

                                                                <?php } else { ?>
                                                                    <div class="columns">
                                                                        <a href="edit_mrf.php?id=<?php echo $row['id'] ?>" method="post" style="width: 0% !important;">
                                                                            <input type="hidden" name="edit_id" class="edit_id" id="edit_id" value="<?php echo $row['id']; ?>">
                                                                            <button type="button" class="btn btn-success btn-sm btnedit" name="btnedit" id="btnedit" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit MRF"><i class="bi bi-gear icon"></i></button>
                                                                        </a>
                                                                    </div>
                                                                    <div class="columns">
                                                                        <input type="hidden" name="delete_id" class="delete_id" id="delete_id" value="<?php echo $row['id']; ?>">
                                                                        <button type="button" class="btn btn-danger btn-sm btndelete" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete MRF"><i class="bi bi-trash3 icon"></i></button>
                                                                    </div>
                                                                <?php } ?>

                                                                <div class="columns">
                                                                    <?php
                                                                    $select = "SELECT * FROM projects WHERE mrf_tracking = '" . $row['tracking'] . "'";
                                                                    $result_select = $link->query($select);
                                                                    while ($select_row = $result_select->fetch_assoc()) {

                                                                        if ($result_select->num_rows > 0) {
                                                                    ?>
                                                                            <input type="hidden" name="project_id" class="project_id" id="project_id" value="<?php echo $select_row['id']; ?>">
                                                                            <button type="button" class="btn btn-info btn-sm btnsearch btntooltips" id="btnsearch" title="Search" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                                <i class="bi bi-search"></i>
                                                                            </button>
                                                                            <span class="notification badge" style="position: relative;  ">
                                                                                <?php
                                                                                $ids = $select_row['id'];
                                                                                $get = "SELECT applicant.*, project.*, resume.*, DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                                                                                            FROM applicant applicant, projects project, applicant_resume resume
                                                                                            WHERE applicant.id = resume.applicant_id 
                                                                                            AND project.id = resume.project_id 
                                                                                            AND project.id = '$ids'
                                                                                            AND resume.status = 'QUALIFIED' 
                                                                                            AND resume.project_status = 'PENDING'";
                                                                                $get_result = $link->query($get);
                                                                                $get_row = $get_result->fetch_assoc();
                                                                                    if ($get_notification = $get_result->num_rows) {
                                                                                        echo '<span class="badge rounded-pill bg-danger" >' . $get_notification . '</span>';
                                                                                    } else {
                                                                                        echo "";
                                                                                    }
                                                                                ?>
                                                                            </span>
                                                                        <?php } else { ?>
                                                                            <button type="button" class="btn btn-secondary btn-sm btnsearch btntooltips" id="btnsearch" title="Search" data-bs-toggle="modal" data-bs-target="#exampleModal" style="display: none !important;"><i class="bi bi-search"></i></button>


                                                                    <?php }
                                                                    } ?>
                                                                </div>
                                                                <div class="columns">
                                                                    <?php
                                                                    $selects = "SELECT * FROM projects WHERE mrf_tracking = '" . $row['tracking'] . "'";
                                                                    $result_selects = $link->query($selects);
                                                                    while ($selects_row = $result_selects->fetch_assoc()) {

                                                                        if ($result_selects->num_rows > 0) {
                                                                    ?>
                                                                            <button type="button" class="btn btn-secondary btn-sm" onclick="location.href = 'mrf_request_loa.php?id=<?php echo $selects_row['id']; ?>'" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Request LOA">
                                                                                <i class="bi bi-file-arrow-up"></i>
                                                                            </button>
                                                                            <span class="notification badge" style="position: relative; ">
                                                                                <?php
                                                                                $id2 = $selects_row['id'];
                                                                                $get2 = "SELECT employees.*, project.*, shortlist.*, shortlist.id AS shortlist_id  
                                                                                FROM employees employees, projects project, shortlist_master shortlist
                                                                                WHERE employees.id = shortlist.employee_id 
                                                                                AND project.project_title = shortlist.shortlistnameto 
                                                                                AND project.id = '$id2'
                                                                                AND shortlist.project_status = 'FOR REQUEST'";
                                                                                $get_result2 = $link->query($get2);
                                                                                $get_row2 = $get_result2->fetch_assoc();
                                                                                    if ($get_notification2 = $get_result2->num_rows) {
                                                                                        echo '<span class="badge rounded-pill bg-danger" >' . $get_notification2 . '</span>';
                                                                                    } else {
                                                                                        echo "";
                                                                                    }
                                                                                
                                                                                ?>
                                                                            </span>
                                                                    <?php }
                                                                    } ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php }

                                                ?>
                                            </tbody>
                                        </table>


                                        <!-- Modal for View MRF -->
                                        <div class="modal fade" id="viewmrf" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal for Search -->
                                        <div class="modal fade" id="projectModal" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel"></h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>





                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Viewing of MRF
                $(document).ready(function() {
                    $('tbody').on('click', '.btnview', function() {
                        var Id = $(this).prev('.ids').val();
                        $('#viewmrf').modal('show');

                        // load the corresponding question(s) for the clicked row
                        $.ajax({
                            url: 'mrf_view_mrf.php',
                            type: 'post',
                            data: {
                                id: Id
                            },
                            success: function(response) {
                                $('#viewmrf .modal-body').html(response);
                            },
                            error: function() {
                                alert('Error.');
                            }
                        });
                    });
                });


                // Deleting MRF
                $('#example').on('click', '.btndelete', function(e) {
                    e.preventDefault();

                    var deleteID = $(this).closest("tr").find('.delete_id').val();

                    Swal.fire({
                        title: "Are you sure you want to delete this MRF?",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonText: "Yes!",
                        cancelButtonText: "No",
                    }).then((willDelete) => {
                        if (willDelete.isConfirmed) {
                            $.ajax({
                                type: "POST",
                                url: "mrf_action.php",
                                data: {
                                    "delete_button_click": 1,
                                    "deleteIDs": deleteID,
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Success!",
                                        icon: "success"
                                    }).then((result) => {
                                        location.reload();
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.log("AJAX Error: " + error);
                                }
                            });
                        }
                    });
                });

                new DataTable('#example');
            </script>

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
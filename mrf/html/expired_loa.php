<?php
include 'connect.php';
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
                                            EXPIRED LOA EMPLOYEES
                                        </h4>
                                    </div>
                                    <hr>
                                    <form action="action.php" method="post" class="form-group row" id="form_request_renewal_loa">

                                        <div class="container mt-3 mb-5">
                                            <button type="button" class="btn btn-primary" id="add_renewal_request_loa" data-bs-toggle="modal" data-bs-target="#add_renewal_request_loa_modal">Add Request LOA</button>
                                        </div>

                                        <div class="container mb-4">
                                            <input type="checkbox" class="form-check-control" name="select-all_for_renewal" id="select-all_for_renewal">
                                            <label for="" class="form-check-label">Select All</label>
                                        </div>

                                        <table class="table table-sm" id="example">
                                            <thead>
                                                <tr>
                                                    <th>

                                                    </th>
                                                    <th class="text-center">Date Requested</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Category</th>
                                                    <th class="text-center">Division</th>
                                                    <th class="text-center">Project Title</th>
                                                    <th class="text-center">Date Start</th>
                                                    <th class="text-center">Date End</th>
                                                    <th class="text-center">Type</th>
                                                    <th class="text-center">Requested By</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                date_default_timezone_set('Asia/Manila');
                                                $today = date('Y-m-d');
                                                $query = "SELECT employee.*, deployment.*, request.*,
                                                DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested,
                                                DATE_FORMAT(loa_start_date, '%M %d, %Y') AS loa_start_date,
                                                DATE_FORMAT(loa_end_date, '%M %d, %Y') AS loa_end_date,
                                                employee.id AS employee_id,
                                                deployment.id AS deployment_id
                                                FROM employees employee, deployment deployment, loa_requests request
                                                WHERE employee.id = request.employee_id
                                                AND employee.id = deployment.employee_id
                                                AND request.request_status = 'DEPLOYED'
                                                AND loa_end_date <= '$today'
                                                AND loa_start_date != ''
                                                AND loa_end_date != ''
                                                AND request.requested_by_id = '" . $_SESSION['user_id'] . "'";
                                                $result = $link->query($query);
                                                while ($row = $result->fetch_assoc()) {
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <input type="checkbox" class="form-check-control" name="deployed_employees[]" value="<?php echo $row['employee_id'] . " | " . $row['deployment_id']; ?>">
                                                        </td>
                                                        <td class="text-center"><?php echo $row['date_requested'] ?></td>
                                                        <td class="text-center"><?php echo $row['lastnameko'] . ", " . $row['firstnameko'] . " " . $row['mnko'] . " " . $row['extnname'] ?></td>
                                                        <td class="text-center"><?php echo $row['category'] ?></td>
                                                        <td class="text-center"><?php echo $row['division'] ?></td>
                                                        <td class="text-center"><?php echo $row['shortlist_title'] ?></td>
                                                        <td class="text-center"><?php echo $row['loa_start_date'] ?></td>
                                                        <td class="text-center"><?php echo $row['loa_end_date'] ?></td>
                                                        <td class="text-center request_status">
                                                            <?php echo $row['signed_loa_status'] ?>
                                                        </td>
                                                        <td class="text-center"><?php echo $row['requested_by'] ?></td>
                                                        <td>
                                                            <?php if($row['signed_loa_status'] === 'SUBMITTED'){?>
                                                                <input type="hidden" class="deployment_id" value="<?php echo $row['deployment_id']; ?>">
                                                                <input type="hidden" class="employee_id" value="<?php echo $row['employee_id']; ?>">
                                                                <button type="button" class="btn btn-primary btn-sm btn_request_renewal" data-bs-toggle="tooltip" data-bs-title="Add LOA Renewal Requests">
                                                                    <i class="bi bi-folder-plus"></i>
                                                                </button>
                                                            <?php } else{ echo ""; }?>
                                                        </td>
                                                    </tr>
                                                <?php }
                                                ?>
                                            </tbody>
                                        </table>

                                        <!-- Modal for adding request LOA (Date Start, Date End and Rate only) -->
                                        <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add_renewal_request_loa_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <?php
                                                    $query_select = "SELECT *
                                                            FROM deployment ";
                                                    $query_select_result = $link->query($query_select);
                                                    $query_select_row = $query_select_result->fetch_assoc();
                                                    ?>
                                                    <div class="modal-body">
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">LOA Date Start</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="date" name="start_date" class="form-control" id="start_date" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">LOA Date End</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="date" name="end_date" class="form-control" id="end_date" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Rate</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="number" name="rate" class="form-control" id="rate" value="<?php echo $query_select_row['basic_salary'] ?>" required>
                                                            </div>
                                                        </div>
                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Ecola</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="ecola" id="ecola" class="form-control" value="0">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Communication Allowance</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="communication_allowance" id="communication_allowance" class="form-control" value="<?php echo $query_select_row['communication_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Transportation</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="transportation_allowance" id="transportation_allowance" class="form-control" value="<?php echo $query_select_row['transportation_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Internet Allowance</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="internet_allowance" id="internet_allowance" class="form-control" value="<?php echo $query_select_row['internet_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Meal Allowance</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="meal_allowance" id="meal_allowance" class="form-control" value="<?php echo $query_select_row['meal_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Outbase Meal</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="outbase_meal" id="outbase_meal" class="form-control" value="<?php echo $query_select_row['outbase_meal'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Special Allowance</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="special_allowance" id="special_allowance" class="form-control" value="<?php echo $query_select_row['special_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                        <div class="row mt-3">
                                                            <div class="col-md-3">
                                                                <label for="" class="form-label">Position Allowance</label>
                                                            </div>
                                                            <div class="col-md-9">
                                                                <input type="text" name="position_allowance" id="position_allowance" class="form-control" value="<?php echo $query_select_row['position_allowance'] ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <?php ?>
                                                    <div class="modal-footer mt-5">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" name="add_renewal_request_loa_btn" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                    </form>



                                    <!-- Modal for LOA Renewal Request - Individually-->
                                    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="add_renewal_request_individual_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">

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
            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('input[name="deployed_employees[]"]');
                const selectAll = document.getElementById('select-all_for_renewal');

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        selectAll.checked = [...checkboxes].every(checkbox => checkbox.checked);
                    });
                });

                const form = document.getElementById('form_request_renewal_loa');

                if (form) {
                    form.addEventListener('submit', function(event) {
                        const atLeastOneChecked = [...checkboxes].some(checkbox => checkbox.checked);

                        if (!atLeastOneChecked) {
                            alert('Please select at least one recipient');
                            event.preventDefault();
                        }
                    });
                }

                // Iterate through the table rows and disable checkboxes for 'UNRETURN' status
                const tableRows = document.querySelectorAll('#example tbody tr');
                tableRows.forEach(row => {
                    const statusCell = row.querySelector('.request_status');
                    const checkbox = row.querySelector('input[name="deployed_employees[]"]');

                    if (statusCell && statusCell.innerText.trim() === 'UNRETURN') {
                        checkbox.disabled = true;
                    }
                });

                // Add event listener to 'Select All'
                if (selectAll) {
                    selectAll.addEventListener('change', function() {
                        checkboxes.forEach(checkbox => {
                            // Only toggle the checkbox if it's not disabled
                            if (!checkbox.disabled) {
                                checkbox.checked = selectAll.checked;
                            }
                        });
                    });
                }
            });


            // For LOA Renewal Request - Individually
            $(document).ready(function() {
                $('tbody').on('click', '.btn_request_renewal', function() {
                    var employee_id = $(this).prev('.employee_id').val();
                    var deployment_id = $(this).closest('tr').find('.deployment_id').val();
                    $('#add_renewal_request_individual_modal').modal('show');

                    // load the corresponding question(s) for the clicked row
                    $.ajax({
                        url: 'request_renewal_loa.php',
                        type: 'post',
                        data: {
                            employee_id: employee_id,
                            deployment_id: deployment_id
                        },
                        success: function(response) {
                            $('#add_renewal_request_individual_modal .modal-body').html(response);
                        },
                        error: function() {
                            alert('Error.');
                        }
                    });
                });
            });
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
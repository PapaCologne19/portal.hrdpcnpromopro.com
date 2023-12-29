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
        <title>LOA Renewal Requests</title>

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

            .form_noa,
            .form_noa_lateral_transfer {
                display: none;
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
                                            LOA RENEWAL REQUESTS
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Date Requested</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">Date Start</th>
                                                <th class="text-center">Date End</th>
                                                <th class="text-center">Request Status</th>
                                                <th class="text-center">Request Type</th>
                                                <th class="text-center">Requested By</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT request.*, employee.*, request.id AS request_id,
                                        DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested,
                                        DATE_FORMAT(start_date, '%M %d, %Y') AS start_date,
                                        DATE_FORMAT(end_date, '%M %d, %Y') AS end_date
                                        FROM loa_renewal_request request, employees employee
                                        WHERE request.employee_id = employee.id
                                        AND request.request_status = 'FOR RENEWAL'";
                                            $result = $link->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td class="text-center">
                                                        <?php echo $row['date_requested'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['lastnameko'] . ", " . $row['firstnameko'] . " " . $row['mnko'] . " " . $row['extnname'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['start_date'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['end_date'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <span class="badge rounded bg-warning">
                                                            <?php echo $row['request_status'] ?>
                                                        </span>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['request_type'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php echo $row['requested_by'] ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#accept_renewal_request_modal-<?php echo $row['request_id']; ?>" title="Accept Renewal Request">
                                                            <i class="bi bi-cursor"></i>
                                                        </button>
                                                    </td>


                                                    <!-- Modal for Accepting LOA Renewal Requests-->
                                                    <div class="modal fade" id="accept_renewal_request_modal-<?php echo $row['request_id']; ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">LOA RENEWAL REQUESTS</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="container">

                                                                        <div class="row mt-3">
                                                                            <div class="col-md-3">
                                                                                <label class="form-label">Type</label>
                                                                            </div>
                                                                            <div class="col-md-9">
                                                                                <select class="form-select" name="request_type" id="request_type-<?php echo $row['id'] ?>" onchange="show_form('<?php echo $row['id'] ?>')" required>
                                                                                    <option value="FOR LOA" selected>FOR LOA</option>
                                                                                    <option value="FOR NOA - FOR REGULAR">FOR NOA - FOR REGULAR</option>
                                                                                    <option value="FOR NOA - LATERAL TRANSFER">FOR NOA - LATERAL TRANSFER</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>



                                                                        <div class="form_loa" id="form_loa-<?php echo $row['id'] ?>">
                                                                            <?php
                                                                            $id = $row['request_id'];
                                                                            $select = "SELECT * FROM loa_renewal_request WHERE id = '$id'";
                                                                            $select_result = $link->query($select);
                                                                            while ($select_row = $select_result->fetch_assoc()) {
                                                                                $select_deployment = "SELECT *,
                                                                        DATE_FORMAT(loa_start_date, '%M %d, %Y') AS loa_start_date,
                                                                        DATE_FORMAT(loa_end_date, '%M %d, %Y') AS loa_end_date
                                                                        FROM deployment
                                                                        WHERE id = '" . $select_row['deployment_id'] . "'";
                                                                                $select_deployment_result = $link->query($select_deployment);
                                                                                $select_deployment_row = $select_deployment_result->fetch_assoc();
                                                                                $date = date_create($select_deployment_row['project_start_date']);
                                                                                $date_format = date_format($date, 'F j, Y');
                                                                            ?>
                                                                                <form action="action.php" method="post" class="form-group" id="for_loa_form">
                                                                                    <input type="hidden" name="request_id" value="<?php echo $id; ?>">
                                                                                    <input type="hidden" name="deployment_id" value="<?php echo $select_row['deployment_id']; ?>">
                                                                                    <input type="hidden" name="employee_id" value="<?php echo $select_row['employee_id']; ?>">

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PROJECT DATE START</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="<?php echo $date_format; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PREVIOUS DURATION</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="From: <?php echo $select_deployment_row['loa_start_date']; ?> To: <?php echo $select_deployment_row['loa_end_date']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">Start Date</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?php echo $select_row['start_date']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="end_date" class="form-label">End Date</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?php echo $select_row['end_date']; ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="end_date" class="form-label">Employment Status</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" name="employment_status" id="employment_status" class="form-control" value="<?php echo $select_row['employment_status']; ?>">
                                                                                        </div>
                                                                                    </div>

                                                                                <?php } ?>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="accept_request_loa_renewal_btn" class="btn btn-primary">Accept</button>
                                                                                </div>
                                                                                </form>
                                                                        </div>




                                                                        <div class="form_noa" id="form_noa-<?php echo $row['id'] ?>">
                                                                            <?php
                                                                            $id = $row['request_id'];
                                                                            $select = "SELECT * FROM loa_renewal_request WHERE id = '$id'";
                                                                            $select_result = $link->query($select);
                                                                            while ($select_row = $select_result->fetch_assoc()) {
                                                                                $select_deployment = "SELECT *,
                                                                        DATE_FORMAT(loa_start_date, '%M %d, %Y') AS loa_start_date,
                                                                        DATE_FORMAT(loa_end_date, '%M %d, %Y') AS loa_end_date
                                                                        FROM deployment
                                                                        WHERE id = '" . $select_row['deployment_id'] . "'";
                                                                                $select_deployment_result = $link->query($select_deployment);
                                                                                $select_deployment_row = $select_deployment_result->fetch_assoc();
                                                                                $date = date_create($select_deployment_row['project_start_date']);
                                                                                $date_format = date_format($date, 'F j, Y');
                                                                            ?>
                                                                                <form action="action.php" method="post" class="form-group" id="for_noa_form">
                                                                                    <input type="hidden" name="request_id" value="<?php echo $id; ?>">
                                                                                    <input type="hidden" name="deployment_id" value="<?php echo $select_row['deployment_id']; ?>">
                                                                                    <input type="hidden" name="employee_id" value="<?php echo $select_row['employee_id']; ?>">


                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="noa_remarks" class="form-label">Remarks</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <select class="form-select" name="noa_remarks" id="noa_remarks" required>
                                                                                                <option value="Changed Employment Status">Changed Employment Status</option>
                                                                                                <option value="Lateral Transfer">Lateral Transfer</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PROJECT DATE START</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="<?php echo $date_format; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PREVIOUS DURATION</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="From: <?php echo $select_deployment_row['loa_start_date']; ?> To: <?php echo $select_deployment_row['loa_end_date']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="end_date" class="form-label">NOA Template</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <select name="noa_template" id="noa_template" class="form-select" required>
                                                                                                <option value="">Select</option>
                                                                                                <?php
                                                                                                $select_loa = "SELECT loa_main.*, loa_files.*
                                                    FROM loa_maintenance_word loa_main, loa_files loa_files
                                                    WHERE loa_files.loa_main_id = loa_main.id AND status = '1'";
                                                                                                $seleted_loa_result = $link->query($select_loa);
                                                                                                while ($selected_loa_row = $seleted_loa_result->fetch_assoc()) {
                                                                                                ?>
                                                                                                    <option value="<?php echo $selected_loa_row['id'] ?>"><?php echo $selected_loa_row['loa_name'] ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="effectivity_date" class="form-label">Effectivity Date</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="date" name="effectivity_date" id="effectivity_date" class="form-control">
                                                                                        </div>
                                                                                    </div>


                                                                                <?php } ?>
                                                                                <div class="modal-footer">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="accept_request_noa_renewal_btn" class="btn btn-primary">Accept</button>
                                                                                </div>
                                                                                </form>
                                                                        </div>

                                                                        <!--FOR NOA- LATERAL TRANSFER-->
                                                                        <div class="form_noa_lateral_transfer" id="form_noa_lateral_transfer-<?php echo $row['id'] ?>">
                                                                            <?php
                                                                            $id = $row['request_id'];
                                                                            $select = "SELECT * FROM loa_renewal_request WHERE id = '$id'";
                                                                            $select_result = $link->query($select);
                                                                            while ($select_row = $select_result->fetch_assoc()) {
                                                                                $select_deployment = "SELECT *,
                                                                        DATE_FORMAT(loa_start_date, '%M %d, %Y') AS loa_start_date,
                                                                        DATE_FORMAT(loa_end_date, '%M %d, %Y') AS loa_end_date
                                                                        FROM deployment
                                                                        WHERE id = '" . $select_row['deployment_id'] . "'";
                                                                                $select_deployment_result = $link->query($select_deployment);
                                                                                $select_deployment_row = $select_deployment_result->fetch_assoc();
                                                                                $date = date_create($select_deployment_row['project_start_date']);
                                                                                $date_format = date_format($date, 'F j, Y');
                                                                            ?>
                                                                                <form action="action.php" method="post" class="form-group" id="for_noa_form">
                                                                                    <input type="hidden" name="request_id" value="<?php echo $id; ?>">
                                                                                    <input type="hidden" name="deployment_id" value="<?php echo $select_row['deployment_id']; ?>">
                                                                                    <input type="hidden" name="employee_id" value="<?php echo $select_row['employee_id']; ?>">
                                                                                    <input type="hidden" name="start_date" value="<?php echo $select_row['start_date']; ?>">
                                                                                    <input type="hidden" name="end_date" value="<?php echo $select_row['end_date']; ?>">


                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="noa_remarks" class="form-label">Remarks</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <select class="form-select" name="noa_remarks" id="noa_remarks" required>
                                                                                                <option value="Changed Employment Status">Changed Employment Status</option>
                                                                                                <option value="Lateral Transfer">Lateral Transfer</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PROJECT DATE START</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="<?php echo $date_format; ?>" readonly>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="start_date" class="form-label">PREVIOUS DURATION</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="text" class="form-control" value="From: <?php echo $select_deployment_row['loa_start_date']; ?> To: <?php echo $select_deployment_row['loa_end_date']; ?>" readonly>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="end_date" class="form-label">NOA Template</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <select name="noa_template" id="noa_template" class="form-select" required>
                                                                                                <option value="">Select</option>
                                                                                                <?php
                                                                                                $select_loa = "SELECT loa_main.*, loa_files.*
                                                                                                    FROM loa_maintenance_word loa_main, loa_files loa_files
                                                                                                    WHERE loa_files.loa_main_id = loa_main.id AND status = '1'";
                                                                                                $seleted_loa_result = $link->query($select_loa);
                                                                                                while ($selected_loa_row = $seleted_loa_result->fetch_assoc()) {
                                                                                                ?>
                                                                                                    <option value="<?php echo $selected_loa_row['id'] ?>"><?php echo $selected_loa_row['loa_name'] ?></option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="effectivity_date" class="form-label">Effectivity Date</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <input type="date" name="effectivity_date" id="effectivity_date" class="form-control">
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row mt-3">
                                                                                        <div class="col-md-3">
                                                                                            <label for="" class="form-label">Outlet From:</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <?php
                                                                                            $outlet = $select_deployment_row['outlet'];
                                                                                            $html = '';
                                                                                            if (!empty($outlet)) {
                                                                                                $data = json_decode($outlet, true);
                                                                                                if (!empty($data['ops'])) {
                                                                                                    $html = '<ul>';
                                                                                                    foreach ($data['ops'] as $op) {
                                                                                                        if (!empty($op['insert'])) {
                                                                                                            $text = trim($op['insert']);
                                                                                                            $attributes = isset($op['attributes']) ? $op['attributes'] : []; // Check if 'attributes' key exists
                                                                                                            if (!empty($attributes) && isset($attributes['list']) && $attributes['list'] == 'bullet' && !empty($text)) {
                                                                                                                $html .= '<li>' . $text . '</li>';
                                                                                                            } elseif (!empty($text)) {
                                                                                                                $html .= '<li>' . $text . '</li>';
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    $html .= '</ul>';
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                            <?php echo $html; ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    
                                                                                    
                                                                                    <div class="row mt-2">
                                                                                        <div class="col-md-3">
                                                                                            <label for="" class="form-label">Outlet To:</label>
                                                                                        </div>
                                                                                        <div class="col-md-9">
                                                                                            <?php
                                                                                            $outlet = $select_row['outlet'];
                                                                                            $html2 = '';
                                                                                            if (!empty($outlet)) {
                                                                                                $data = json_decode($outlet, true);
                                                                                                if (!empty($data['ops'])) {
                                                                                                    $html2 = '<ul>';
                                                                                                    foreach ($data['ops'] as $op) {
                                                                                                        if (!empty($op['insert'])) {
                                                                                                            $text = trim($op['insert']);
                                                                                                            $attributes = isset($op['attributes']) ? $op['attributes'] : []; // Check if 'attributes' key exists
                                                                                                            if (!empty($attributes) && isset($attributes['list']) && $attributes['list'] == 'bullet' && !empty($text)) {
                                                                                                                $html2 .= '<li>' . $text . '</li>';
                                                                                                            } elseif (!empty($text)) {
                                                                                                                $html2 .= '<li>' . $text . '</li>';
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    $html2 .= '</ul>';
                                                                                                }
                                                                                            }
                                                                                            ?>
                                                                                            <div id="editor-noa-<?php echo $row['id']; ?>"><?php echo $html2; ?></div>
                                                                                            <textarea name="new_outlet" id="outlet-noa-<?php echo $row['id']; ?>" style="position: absolute; left: -9999px;"></textarea>
                                                                                            <script>
                                                                                                var quill_noa_<?php echo $row['id']; ?> = new Quill('#editor-noa-<?php echo $row['id']; ?>', {
                                                                                                    placeholder: 'Type outlet here...',
                                                                                                    theme: 'snow',
                                                                                                });
                                                                                
                                                                                                $('form').submit(function(event) {
                                                                                                    $('#outlet-noa-<?php echo $row['id']; ?>').val(JSON.stringify(quill_noa_<?php echo $row['id']; ?>.getContents()));
                                                                                                    return true;
                                                                                                });
                                                                                            </script>
                                                                                        </div>
                                                                                    </div>

                                                                                        <br>
                                                                                <?php } ?>
                                                                                <div class="modal-footer mt-5">
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                    <button type="submit" name="accept_request_noa_lateral_transfer_renewal_btn" class="btn btn-primary">Accept</button>
                                                                                </div>
                                                                                </form>
                                                                        </div>




                                                                    </div>
                                                                </div>
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
        <script>
            function show_form() {
                var form_noa = document.getElementById("form_noa");
                var form_loa = document.getElementById("form_loa");
                var selected_type = document.getElementById("request_type");

                // Hide all forms initially
                form_loa.style.display = "none";
                form_noa.style.display = "none";

                if (selected_type.value === "FOR LOA") {
                    // Show the LOA form
                    form_loa.style.display = "block";
                } else if (selected_type.value === "FOR NOA - FOR REGULAR") {
                    // Show the NOA form
                    form_noa.style.display = "block";
                }
            }

            function show_form(rowId) {
                var form_loa = document.getElementById("form_loa-" + rowId);
                var form_noa = document.getElementById("form_noa-" + rowId);
                var form_noa_lateral_transfer = document.getElementById("form_noa_lateral_transfer-" + rowId);
                var selected_type = document.getElementById("request_type-" + rowId);

                // Hide all forms initially
                form_loa.style.display = "none";
                form_noa.style.display = "none";
                form_noa_lateral_transfer.style.display = "none";

                if (selected_type.value === "FOR LOA") {
                    // Show the LOA form
                    form_loa.style.display = "block";
                } else if (selected_type.value === "FOR NOA - FOR REGULAR") {
                    // Show the NOA form
                    form_noa.style.display = "block";
                } else if (selected_type.value === "FOR NOA - LATERAL TRANSFER") {
                    // Show the NOA form
                    form_noa_lateral_transfer.style.display = "block";
                }
            }
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
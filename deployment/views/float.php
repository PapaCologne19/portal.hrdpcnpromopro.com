<?php
session_start();
include '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <title>Floating</title>

    <style>
         .form_loa {
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
                                        FLOATING
                                    </h4>
                                </div>
                                <hr>
                                <table class="table table-sm" id="example">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Category</th>
                                            <th>Name</th>
                                            <th>Project</th>
                                            <th>Project Start</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Employment Status</th>
                                            <th>Project Status</th>
                                            <th>LOA Status</th>
                                            <th>Effectivity Date</th>
                                            <th>Reason</th>
                                            <!--<th>Action</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT floating.*, deployment.*, floating.employee_id AS Employee_id, deployment.id AS deployment_id, DATE_FORMAT(floating.date_floated, '%M %d, %Y') AS date_floated
                                        FROM floating_employees floating, deployment deployment
                                        WHERE deployment.id = floating.deployment_id
                                        AND deployment.clearance = 'FLOATING'";
                                        $result = $link->query($query);
                                        while ($row = $result->fetch_assoc()) {

                                            $start_date = $row['loa_start_date'];
                                            $end_date = $row['loa_end_date'];
                                            $dateObj = date_create_from_format('Y-m-d', $start_date);
                                            $dateObj2 = date_create_from_format('Y-m-d', $end_date);
                                            $formattedDate_start = date_format($dateObj, 'F j, Y');
                                            $formattedDate_end = date_format($dateObj2, 'F j, Y');
                                            $id = $row['Employee_id'];

                                            $fetch = "SELECT * FROM employees WHERE id = '$id'";
                                            $retrieved = $link->query($fetch);
                                            while ($fetched = $retrieved->fetch_assoc()) {
                                                $employee_id = $row['Employee_id'];
                                                $deployment_id = $row['deployment_id'];

                                                $select_folder = "SELECT * FROM folder WHERE employee_id = '$employee_id' AND deployment_id = '$deployment_id'";
                                                $select_folder_result = $link->query($select_folder);
                                                $select_folder_row = $select_folder_result->fetch_assoc();

                                                $fileNames = explode(',', $row['signed_loa_file']);

                                                $name = $fetched['firstnameko'] . " " . $fetched['mnko'] . " " . $fetched['lastnameko'] . "-PCN_ID.png";

                                        ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['type'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['category'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $fetched['lastnameko'] . ", " . $fetched['firstnameko'] . " " . $fetched['mnko'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['place_assigned'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['project_start_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $formattedDate_start ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $formattedDate_end ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['employment_status'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['clearance'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['signed_loa_status'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['date_floated'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['reason_for_floating'] ?>
                                                    </td>


                                                    <!--<td>-->
                                                    <!--    <div class="contain">-->
                                                    <!--        <div class="columns">-->
                                                    <!--            <button type="button" class="btn btn-sm btn-primary btntooltips" data-bs-toggle="modal" data-bs-target="#downloadIDModal-<?php echo $row['id'] ?>" title="Request LOA/NOA">-->
                                                    <!--                <i class="bi bi-person-exclamation"></i>-->
                                                    <!--            </button>-->
                                                    <!--        </div>-->
                                                    <!--    </div>-->
                                                    <!--</td>-->



                                                    <!--Modal for Floating Employee -->
                                                    <div class="modal fade" id="downloadIDModal-<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-3">
                                                                            <label for="" class="form-label">Type</label>
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <select class="form-select" name="request_type" id="request_type-<?php echo $row['id'] ?>" onchange="show_form('<?php echo $row['id'] ?>')" required>
                                                                                <option value="FOR LOA">FOR LOA</option>
                                                                                <option value="FOR NOA - LATERAL TRANSFER" selected>FOR NOA - LATERAL TRANSFER</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <!-- FORM LOA -->
                                                                    <div class="form_loa" id="form_loa-<?php echo $row['id'] ?>">
                                                                        <?php
                                                                        $select_data = "SELECT deployment.*, employee.*, DATE_FORMAT(project_start_date, '%M %d, %Y') AS project_start_date
                                                                                FROM deployment deployment, employees employee
                                                                                WHERE deployment.employee_id = employee.id
                                                                                AND deployment.id = '" . $row['id'] . "'";
                                                                        $select_data_result = $link->query($select_data);
                                                                        $select_data_row = $select_data_result->fetch_assoc();
                                                                        ?>
                                                                        <form action="action.php" method="post">
                                                                            <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>">
                                                                            <input type="hidden" name="deployment_id" value="<?php echo $deployment_id ?>">


                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Start Date</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="date" name="start_date" class="form-control" id="start_date" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">End Date</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Channel</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="channel" id="channel" class="form-select" required>
                                                                                        <option value="<?php echo $row['channel'] ?>">
                                                                                            <?php echo $row['channel'] ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $channel = "SELECT * FROM channels WHERE is_deleted = '0'";
                                                                                        $channel_result = $link->query($channel);
                                                                                        while ($channel_row = $channel_result->fetch_assoc()) {

                                                                                        ?>
                                                                                            <option value="<?php echo $channel_row['description'] ?>">
                                                                                                <?php echo $channel_row['description'] ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Employment Status</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="employment_status" id="employment_status" class="form-select" required>
                                                                                        <option value="<?php echo $row['employment_status']; ?>">
                                                                                            <?php echo $row['employment_status']; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $employment_status = "SELECT * FROM employment_status";
                                                                                        $employment_status_result = $link->query($employment_status);
                                                                                        while ($employment_status_row = $employment_status_result->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo ucwords(strtolower($employment_status_row['name'])) ?>">
                                                                                                <?php echo ucwords(strtolower($employment_status_row['name'])) ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>

                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Position</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="job_title" id="job_title" class="form-select" required>
                                                                                        <option value="<?php echo $row['job_title']; ?>">
                                                                                            <?php echo $row['job_title']; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $job_title_query = "SELECT * FROM job_title WHERE is_deleted = '0'";
                                                                                        $job_title_result = $link->query($job_title_query);
                                                                                        while ($job_title_row = $job_title_result->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo $job_title_row['description'] ?>">
                                                                                                <?php echo $job_title_row['description'] ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>

                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Basic Salary</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="<?php echo $row['basic_salary'] ?>" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Ecola</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="ecola" id="ecola" class="form-control" value="<?php echo $row['ecola']; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Communication Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="communication_allowance" id="communication_allowance" class="form-control" value="<?php echo $row['communication_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Transportation</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="transportation_allowance" id="transportation_allowance" class="form-control" value="<?php echo $row['transportation_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Internet Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="internet_allowance" id="internet_allowance" class="form-control" value="<?php echo $row['internet_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Meal Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="meal_allowance" id="meal_allowance" class="form-control" value="<?php echo $row['meal_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Outbase Meal</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="outbase_meal" id="outbase_meal" class="form-control" value="<?php echo $row['outbase_meal'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Special Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="special_allowance" id="special_allowance" class="form-control" value="<?php echo $row['special_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Position Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="position_allowance" id="position_allowance" class="form-control" value="<?php echo $row['position_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">No. of Days work</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="no_of_days" id="no_of_days" class="form-control" value="<?php echo $row['no_of_days'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Outlet</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <?php
                                                                                    $outlet = $row['outlet'];
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
                                                                                    <div id="editor-loa-<?php echo $row['id']; ?>"></div>
                                                                                    <textarea name="outlet" id="outlet-loa-<?php echo $row['id']; ?>" style="position: absolute; left: -9999px;"></textarea>
                                                                                    <script>
                                                                                        var quill_loa_<?php echo $row['id']; ?> = new Quill('#editor-loa-<?php echo $row['id']; ?>', {
                                                                                            placeholder: 'Type outlet here...',
                                                                                            theme: 'snow',
                                                                                        });
                                                                        
                                                                                        $('form').submit(function(event) {
                                                                                            $('#outlet-loa-<?php echo $row['id']; ?>').val(JSON.stringify(quill_loa_<?php echo $row['id']; ?>.getContents()));
                                                                                            return true;
                                                                                        });
                                                                                    </script>
                                                                                </div>
                                                                            </div>



                                                                            <div class="modal-footer mt-5">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary" name="LOA_floatButton" id="floatButton">Submit</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>




                                                                    <!--FORM NOA-->
                                                                    <div class="form_noa" id="form_noa-<?php echo $row['id'] ?>">
                                                                        <?php
                                                                        $select_data = "SELECT deployment.*, employee.*, DATE_FORMAT(project_start_date, '%M %d, %Y') AS project_start_date
                                                                                                            FROM deployment deployment, employees employee
                                                                                                            WHERE deployment.employee_id = employee.id
                                                                                                            AND deployment.id = '" . $row['id'] . "'";
                                                                        $select_data_result = $link->query($select_data);
                                                                        $select_data_row = $select_data_result->fetch_assoc();
                                                                        ?>
                                                                        <form action="action.php" method="post">
                                                                            <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>">
                                                                            <input type="hidden" name="deployment_id" value="<?php echo $deployment_id ?>">


                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Start Date</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="date" name="start_date" class="form-control" id="start_date" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">End Date</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="date" name="end_date" class="form-control" id="end_date" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Channel</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="channel" id="channel" class="form-select" required>
                                                                                        <option value="<?php echo $row['channel'] ?>">
                                                                                            <?php echo $row['channel'] ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $channel = "SELECT * FROM channels WHERE is_deleted = '0'";
                                                                                        $channel_result = $link->query($channel);
                                                                                        while ($channel_row = $channel_result->fetch_assoc()) {

                                                                                        ?>
                                                                                            <option value="<?php echo $channel_row['description'] ?>">
                                                                                                <?php echo $channel_row['description'] ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Employment Status</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="employment_status" id="employment_status" class="form-select" required>
                                                                                        <option value="<?php echo $row['employment_status']; ?>">
                                                                                            <?php echo $row['employment_status']; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $employment_status = "SELECT * FROM employment_status";
                                                                                        $employment_status_result = $link->query($employment_status);
                                                                                        while ($employment_status_row = $employment_status_result->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo ucwords(strtolower($employment_status_row['name'])) ?>">
                                                                                                <?php echo ucwords(strtolower($employment_status_row['name'])) ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>

                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Position</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <select name="job_title" id="job_title" class="form-select" required>
                                                                                        <option value="<?php echo $row['job_title']; ?>">
                                                                                            <?php echo $row['job_title']; ?>
                                                                                        </option>
                                                                                        <?php
                                                                                        $job_title_query = "SELECT * FROM job_title WHERE is_deleted = '0'";
                                                                                        $job_title_result = $link->query($job_title_query);
                                                                                        while ($job_title_row = $job_title_result->fetch_assoc()) {
                                                                                        ?>
                                                                                            <option value="<?php echo $job_title_row['description'] ?>">
                                                                                                <?php echo $job_title_row['description'] ?>
                                                                                            </option>
                                                                                        <?php } ?>
                                                                                    </select>

                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Basic Salary</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="<?php echo $row['basic_salary'] ?>" required>
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Ecola</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="ecola" id="ecola" class="form-control" value="<?php echo $row['ecola']; ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Communication Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="communication_allowance" id="communication_allowance" class="form-control" value="<?php echo $row['communication_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Transportation</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="transportation_allowance" id="transportation_allowance" class="form-control" value="<?php echo $row['transportation_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Internet Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="internet_allowance" id="internet_allowance" class="form-control" value="<?php echo $row['internet_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Meal Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="meal_allowance" id="meal_allowance" class="form-control" value="<?php echo $row['meal_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Outbase Meal</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="outbase_meal" id="outbase_meal" class="form-control" value="<?php echo $row['outbase_meal'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Special Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="special_allowance" id="special_allowance" class="form-control" value="<?php echo $row['special_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Position Allowance</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="position_allowance" id="position_allowance" class="form-control" value="<?php echo $row['position_allowance'] ?>">
                                                                                </div>
                                                                            </div>

                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">No. of Days work</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <input type="text" name="no_of_days" id="no_of_days" class="form-control" value="<?php echo $row['no_of_days'] ?>">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Outlet From:</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <?php
                                                                                    $outlet = $row['outlet'];
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


                                                                            <div class="row mt-3">
                                                                                <div class="col-md-3">
                                                                                    <label for="" class="form-label">Outlet To:</label>
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div id="editor-noa-<?php echo $row['id']; ?>"></div>
                                                                                    <textarea name="outlet" id="outlet-noa-<?php echo $row['id']; ?>" style="position: absolute; left: -9999px;"></textarea>
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

                                                                            <div class="modal-footer mt-5">
                                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary" name="NOA_floatButton" id="floatButton">Submit</button>
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
                                        } ?>
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
         function show_form(rowId) {
            var form_noa = document.getElementById("form_noa-" + rowId);
            var form_loa = document.getElementById("form_loa-" + rowId);
            var selected_type = document.getElementById("request_type-" + rowId);
    
            // Hide all forms initially
            form_loa.style.display = "none";
            form_noa.style.display = "none";
    
            if (selected_type.value === "FOR LOA") {
                // Show the LOA form
                form_loa.style.display = "block";
            } else if (selected_type.value === "FOR NOA - LATERAL TRANSFER") {
                // Show the NOA form
                form_noa.style.display = "block";
            }
        }
    </script>
    <?php include '../components/footer.php'; ?>
</body>

</html>
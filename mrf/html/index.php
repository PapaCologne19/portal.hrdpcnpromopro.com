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
        <title>MRF Dashboard</title>
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
                            <div class="row w-100">
                                <div class="col-lg-12 col-md-4 order-1">
                                    <div class="row">

                                        <!-- For Final Interview -->
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/people.svg" alt="chart success" width="100%" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">For Final Interview</span>
                                                    <?php
                                                    $id = $_SESSION['user_id'];
                                                    $get = "SELECT applicant.*, project.*, resume.*, mrf.*,
                                                              DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                                                              FROM applicant applicant, projects project, applicant_resume resume, mrf mrf
                                                              WHERE applicant.id = resume.applicant_id 
                                                              AND project.id = resume.project_id 
                                                              AND mrf.id = project.mrf_id
                                                              AND mrf.uid = '$id'
                                                              AND resume.status = 'QUALIFIED' 
                                                              AND resume.project_status = 'PENDING'";


                                                    $get_result = $link->query($get);
                                                    $for_final_interview = $get_result->num_rows;
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $for_final_interview; ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- For LOA Requests -->
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/request-quote.svg" alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">For LOA Request</span>
                                                    <?php
                                                    $id2 = $_SESSION['user_id'];
                                                    $get2 = "SELECT employees.*, project.*, shortlist.*, shortlist.id AS shortlist_id, mrf.*  
                                                                                FROM employees employees, projects project, shortlist_master shortlist, mrf mrf
                                                                                WHERE employees.id = shortlist.employee_id 
                                                                                AND project.project_title = shortlist.shortlistnameto 
                                                                                AND mrf.id = project.mrf_id
                                                                                AND mrf.uid = '$id2'                                                                                                                
                                                                                AND shortlist.project_status = 'FOR REQUEST'";
                                                    $get_result2 = $link->query($get2);
                                                    $for_request = $get_result2->num_rows;
                                                    ?>
                                                    <h3 class="card-title text-nowrap mb-1"><?php echo $for_request; ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- For Deployed -->
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/send-check.svg" alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Deployed</span>
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
                                                    AND request.request_status = 'DEPLOYED'
                                                    AND request.requested_by_id = '$requested_by_id'";
                                                    $result = $link->query($query);
                                                    $deployed = $result->num_rows;
                                                    ?>
                                                    <h3 class="card-title text-nowrap mb-2"><?php echo $deployed; ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- For Expired -->
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/person-x.svg" alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Expired</span>
                                                    <?php
                                                    date_default_timezone_set('Asia/Manila');
                                                    $today = date('Y-m-d');
                                                    $sql = "SELECT employee.*, deployment.*, request.*,
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
                                                    $res = $link->query($sql);
                                                    $expired = $res->num_rows;
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $expired ?></h3>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- For Unreturn -->
                                        <div class="col-lg-4 col-md-12 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../assets/img/icons/unicons/arrow-counterclockwise.svg" width="100%" alt="Credit Card" class="rounded" />
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Unreturn</span>
                                                    <?php
                                                    $requested_by_id2 = $_SESSION['user_id'];
                                                    $query2 = "SELECT employee.*, project.*, request.*, deployment.*,
                                                    DATE_FORMAT(date_requested, '%M %d, %Y') AS date_requested,
                                                    DATE_FORMAT(request.start_date, '%M %d, %Y') AS start_date, 
                                                    DATE_FORMAT(request.end_date, '%M %d, %Y') AS end_date
                                                    FROM employees employee, projects project, loa_requests request, deployment deployment
                                                    WHERE employee.id = request.employee_id
                                                    AND project.id = request.project_id
                                                    AND employee.id = deployment.employee_id 
                                                    AND request.request_status = 'DEPLOYED'
                                                    AND deployment.signed_loa_status = 'UNRETURN'
                                                    AND request.requested_by_id = '$requested_by_id2'";
                                                    $result2 = $link->query($query2);
                                                    $deployed2 = $result2->num_rows;
                                                    ?>
                                                    <h3 class="card-title text-nowrap mb-2"><?php echo $deployed2; ?></h3>
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
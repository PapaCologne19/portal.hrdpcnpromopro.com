<?php
session_start();
include '../../connect.php';

date_default_timezone_set('Asia/Hong_Kong');
$datenow = date("m/d/Y");

if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>Job Vacancies</title>

        <style>
            .form-control {
                text-transform: uppercase;
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
                                            JOB VACANCIES
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>Project Title</th>
                                                <th>Position</th>
                                                <th>Slot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $query = "SELECT * FROM mrf WHERE is_deleted = '0'";
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
                                                    $slots = $needed - $deployed;
                                                ?>
                                            <tr>
                                                <td><?php echo $row['project_title'];?></td>
                                                <td>
                                                    <?php 
                                                        if($row['position'] === 'OTHER'){
                                                          echo $row['position_detail'];  
                                                        }
                                                        else{
                                                           echo $row['position']; 
                                                        }
                                                        
                                                    ?>
                                                </td>
                                                <td><?php echo $slots;?></td>
                                            </tr>
                                            <?php }?>
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
    $_SESSION['errorMessage'] = "Hacker ka ba?!";
    header('Location: ../../index.php');
    session_destroy();
    exit();
}
?>
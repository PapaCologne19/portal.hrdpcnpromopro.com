<?php
session_start();
include '../../connect.php';
if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>List of Applicants</title>
<link rel="stylesheet" href="../../../pcn_OLA/resumeStorage/">
        <style>
            .contain {
                display: grid;
                grid-template-columns: 0fr 0fr;
                grid-template-rows: 0fr 0fr;
                gap: 5px;
                margin: 0 auto;
            }

            .columns {
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
        <div class="body5010p" id="my_camera" style="z-index: 1;"></div>

        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php include '../components/sidebar.php'; ?>

                <!-- Main page -->
                <div class="layout-page">
                    <?php include '../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper mt-1">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4">
                                            List of Applicants
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>Project Title</th>
                                                <th>Needed</th>
                                                <th>Provided</th>
                                                <th>Deployed</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $select = "SELECT * FROM projects WHERE is_deleted = '0'";
                                                $results = $link->query($select);
                                                while($rows = $results->fetch_assoc()){
                                                    $id = $rows['mrf_id'];
                                                    $project_title = $rows['project_title'];
                                                    
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
                                                <td><?php echo $rows['project_title']?></td>
                                                <td><?php echo $rows['ewb_count']?></td>
                                                <td><?php echo $provided; ?></td>
                                                <td><?php echo $deployed; ?></td>
                                                <td>
                                                    <a href="shortlisted_applicants.php?id=<?php echo $rows['id']?>" class="btn btn-primary btn-sm btntooltips" title="View">
                                                        <i class="bi bi-search">
                                                        </i>
                                                        <span class="notification badge">
                                                            <?php 
                                                                $get_resume = "SELECT resumes.*, project.* 
                                                                FROM applicant_resume resumes, projects project
                                                                WHERE project.id = resumes.project_id 
                                                                AND resumes.status = 'FOR SCREENING' AND resumes.is_deleted = '0' AND project.project_title = '" . $rows['project_title'] . "'";
                                                                $get_resume_result = $link->query($get_resume);
                                                                while($get_resume_row = $get_resume_result->fetch_assoc()){
                                                                if($get_resume_notification = $get_resume_result->num_rows){
                                                                    echo '<span class="badge rounded-pill bg-danger" >'.$get_resume_notification.'</span>';
                                                                }
                                                                else{
                                                                    echo "";
                                                                }
                                                                }
                                                            ?>
                                                    </span>
                                                    </a>
                                                    
                                                    
                                                </td>
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
    header("Location: ../../index.php");
    session_destroy();
    exit(0);
}
?>
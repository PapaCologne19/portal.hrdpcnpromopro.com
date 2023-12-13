<?php
session_start();
include '../../connect.php';
if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>Manpower Request Forms</title>
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
                                            SUMMARY REPORT
                                        </h4>
                                    </div>
                                    <hr>
                                    
                                    <table id="example" class="table table-sm" >
                                        <thead>
                                            <tr>
                                                <th> MRF ID </th>
                                                <th> FILLED BY </th>
                                                <th> LOCATION </th>
                                                <th> PROJECT TITLE </th>
                                                <th> POSITION </th>
                                                <th> NEEDED </thh>
                                                <th> PROVIDED </th>
                                                <th> FOR SCREENING </th>
                                                <th> ACTION </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $query = "SELECT * FROM mrf WHERE is_deleted = '0' ORDER BY id DESC";
                                            $result = mysqli_query($link, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $uid1 = $row['uid'];
                                                $fullname = $row['prepared_by'];

                                                $project_title = $row['project_title'];
                                                $needed = $row['np_male'] + $row['np_female'];

                                                $selected = "SELECT mrf.*, project.*, resumes.* 
                                                FROM mrf mrf, projects project, applicant_resume resumes 
                                                WHERE mrf.tracking = project.mrf_tracking 
                                                AND resumes.project_id = project.id 
                                                AND project.project_title = '$project_title'
                                                AND resumes.status = 'QUALIFIED'";

                                                $selected_result = $link->query($selected);

                                                $selected_screening = "SELECT mrf.*, project.*, resumes.*, mrf.id AS mrf_id 
                                                FROM mrf mrf, projects project, applicant_resume resumes 
                                                WHERE mrf.tracking = project.mrf_tracking 
                                                AND resumes.project_id = project.id 
                                                AND project.project_title = '$project_title'
                                                AND resumes.status = 'FOR SCREENING'";

                                                $selected_screening_result = $link->query($selected_screening);
                                                $for_screening = $selected_screening_result->num_rows;
                                                $selected_screening_row = $selected_screening_result->fetch_assoc();

                                                $provided = $selected_result->num_rows;
                                                $selected_row = $selected_result->fetch_assoc();

                                                if ($row['hr_personnel'] == "YES") { ?>
                                                    <tr>
                                                        <td> <?php echo $row['id'] ?> </td>
                                                        <td> <?php echo $row['prepared_by'] ?> </td>
                                                        <td> <?php echo $row['location'] ?> </td>
                                                        <td> <?php echo $row['project_title'] ?> </td>
                                                        <?php
                                                        if ($row['position'] === "OTHER") { ?>
                                                            <td> <?php echo $row['position_detail'] ?> </td>
                                                        <?php  } else { ?>
                                                            <td> <?php echo $row['position'] ?> </td>
                                                        <?php } ?>
                                                        <td style=" text-align: center;"> <?php echo $needed ?> </td>
                                                        <td style=" text-align: center;"> <?php echo $provided ?> </td>
                                                        <td style=" text-align: center;"> <?php echo $for_screening ?> </td>

                                                        <td>
                                                            <form action="" method="POST">
                                                                <div class="contain">
                                                                    <div class="column">
                                                                        <input type="hidden" name="ids" class="ids" id="ids" value="<?php echo $row['id']; ?>">
                                                                        <button type="button" class="btn btn-sm btn-primary btnview btntooltips" title="View MRF" data-bs-toggle="modal" data-bs-target="#viewmrf"><i class="bi bi-eye icon"></i></button>
                                                            
                                                                    </div>
                                                                    <div class="column">
                                                                        <?php 
                                                                            if($selected_row['status'] === 'QUALIFIED'){
                                                                        ?>
                                                                            <a href="shortlisted_applicants.php?id=<?php echo $selected_row['project_id']?>" class="btn btn-sm btn-secondary btntooltips" title="View"><i class="bi bi-search"></i></a>
                                                                        <?php } elseif($selected_screening_row['status'] === 'FOR SCREENING'){?>
                                                                            <a href="shortlisted_applicants.php?id=<?php echo $selected_screening_row['project_id']?>" class="btn btn-sm btn-secondary btntooltips" title="View"><i class="bi bi-search"></i></a>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                                
                                                            </form>
                                                        </td>
                                                    </tr>
                                                <?php } else { ?>
                                                    <tr>
                                                        <td> <?php echo $row['id'] ?> </td>
                                                        <td> <?php echo $fullname ?> </td>
                                                        <td> <?php echo $row['location'] ?> </td>
                                                        <td> <?php echo $row['project_title'] ?> </td>
                                                        <?php if ($row['position'] === "OTHER") { ?>
                                                            <td> <?php echo $row['position_detail'] ?> </td>
                                                        <?php } else { ?>
                                                            <td> <?php echo $row['position'] ?> </td>
                                                        <?php } ?>
                                                        <td style=" text-align: center;"> <?php echo $needed ?> </td>
                                                        <td style=" text-align: center;"> <?php echo $provided ?> </td>
                                                        <td style=" text-align: center;"> <?php echo $for_screening ?> </td>


                                                        <td>
                                                            <form action="" method="POST">
                                                            <input type="hidden" name="ids" class="ids" id="ids" value="<?php echo $row['id']; ?>">
                                                                <button type="button" class="btn btn-sm btn-primary btnview" title="View MRF" data-bs-toggle="modal" data-bs-target="#viewmrf"><i class="bi bi-eye icon"></i></button>
                                                                <a href="shortlisted_applicants.php?id=<?php echo $row['id']?>" class="btn btn-secondary btn-sm btntooltips" title="View"><i class="bi bi-search"></i></a>

                                                                <input type="hidden" name="mrf_ids" class="mrf_ids" value="<?php echo $row['id'] ?>">
                                                                <button type="button" name="r_mrfs" class="btn btn-sm btn-success r_mrfs" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Accept MRF"><i class="bi bi-send-check"></i></button>
                                                                
                                                            </form>
                                                        </td>
                                                    </tr>
                                            <?php
                                                }
                                            }
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
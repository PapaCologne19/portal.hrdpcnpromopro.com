<?php
session_start();
include '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <title>Files</title>
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
                <div class="content-wrapper mt-2">
                    <div class="container">
                        <div class="card">

                            <div class="card-body">
                                <div class="container table-responsive">
                                    <table class="table" id="example">
                                        <thead>
                                            <tr>
                                                <th>Folder</th>
                                                <th>Date Uploaded</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            $id = $link->real_escape_string($_GET['id']);
                                            $folder_id = $link->real_escape_string($_GET['folder_id']);
                                            $query = "SELECT * FROM employees WHERE id = '$id'";
                                            $result = $link->query($query);
                                            while ($rower = $result->fetch_assoc()) {
                                                $applicant_id = $rower['app_id'];
                                                if ($_GET['folder_name'] === "Requirements") {

                                                    $select_resume_file = "SELECT *, 
                                                DATE_FORMAT(requirements_files_uploaded, '%M %d, %Y') AS requirements_files_uploaded 
                                                FROM 201files 
                                                WHERE folder_id = '$folder_id' 
                                                AND applicant_id = '$applicant_id'
                                                AND (file_description = 'RESUME'
                                                OR file_description = 'MANDATORIES'
                                                OR file_description = 'REQUIREMENTS')";
                                                    $select_resume_file_result = $link->query($select_resume_file);
                                                    while ($select_resume_file_row = $select_resume_file_result->fetch_assoc()) {
                                                        $select_folder = "SELECT * FROM folder WHERE id = '$folder_id' AND applicant_id = '$applicant_id'";
                                                        $select_folder_result = $link->query($select_folder);
                                                        while ($select_folder_row = $select_folder_result->fetch_assoc()) {
                                                            $folder_path = "https://jobs.hrdpcnpromopro.com/" . $select_folder_row['folder_path'] . "/" . $select_resume_file_row['requirements_files'];
                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <img src="../assets/img/icons/unicons/file.png" width="3%" alt="">
                                                                    <a href="<?php echo $folder_path; ?>" download="<?php echo $select_resume_file_row['requirements_files']; ?>" target="_blank"><?php echo $select_resume_file_row['requirements_files']; ?></a>
                                                                </td>
                                                                <td><?php echo $select_resume_file_row['requirements_files_uploaded']; ?></td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    }
                                                } else {
                                                    $select_resume_file = "SELECT *, 
                                                DATE_FORMAT(requirements_files_uploaded, '%M %d, %Y') AS requirements_files_uploaded 
                                                FROM 201files 
                                                WHERE folder_id = '$folder_id' 
                                                AND applicant_id = '$applicant_id'
                                                AND (file_description = 'SIGNED LOA'
                                                OR file_description = 'LOA'
                                                OR file_description = 'LOA - PDF')";
                                                    $select_resume_file_result = $link->query($select_resume_file);
                                                    while ($select_resume_file_row = $select_resume_file_result->fetch_assoc()) {
                                                        $select_folder = "SELECT * FROM folder WHERE id = '$folder_id' AND applicant_id = '$applicant_id'";
                                                        $select_folder_result = $link->query($select_folder);
                                                        while ($select_folder_row = $select_folder_result->fetch_assoc()) {
                                                            $folder_path = "https://jobs.hrdpcnpromopro.com/" . $select_folder_row['folder_path'] . "/" . $select_resume_file_row['requirements_files'];
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <img src="../assets/img/icons/unicons/file.png" width="5%" alt="">
                                                                    <a href="<?php echo $folder_path; ?>" download="<?php echo $select_resume_file_row['requirements_files']; ?>" target="_blank"><?php echo $select_resume_file_row['requirements_files']; ?></a>
                                                                </td>
                                                                <td><?php echo $select_resume_file_row['requirements_files_uploaded']; ?></td>
                                                            </tr>
                                            <?php }
                                                    }
                                                }
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
    </div>
    </div>

    </script>
    <?php include '../components/footer.php'; ?>
</body>

</html>
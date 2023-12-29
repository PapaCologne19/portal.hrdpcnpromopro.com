<?php
session_start();
include '../../connect.php';

if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>

        <title>LOA</title>
    </head>

    <body>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php include '../components/sidebar.php'; ?>

                <!-- Main page -->
                <div class="layout-page">
                    <?php include '../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4">
                                            LIST OF LOA
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Date Created</th>
                                                <th>LOA Title</th>
                                                <th>Division</th>
                                                <th>Filename</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT loa_main.*, 
                                                loa_files.*, 
                                                DATE_FORMAT(date_modified, '%M %d %Y') AS date_modified,
                                                loa_main.id AS loa_main_id
                                                FROM loa_maintenance_word loa_main, loa_files loa_files
                                                WHERE loa_files.loa_main_id = loa_main.id";
                                            $result = $link->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                            ?>
                                                <tr>
                                                    <td><?php echo $row['id'] ?></td>
                                                    <td><?php echo $row['date_modified'] ?></td>
                                                    <td><?php echo $row['loa_name'] ?></td>
                                                    <td><?php echo $row['division'] ?></td>
                                                    <td><?php echo $row['file_name'] ?></td>
                                                    <td><?php
                                                        if ($row['status'] === '0') {
                                                            echo '<p class="badge round-pill bg-secondary">Not Active</p>';
                                                        } else {
                                                            echo '<p class="badge round-pill bg-success text-white">Active</p>';
                                                        }
                                                        ?></td>
                                                    <td>
                                                        <div class="contains">
                                                            <div class="columns">
                                                                <?php
                                                                if ($row['status'] === '0') { ?>
                                                                    <input type="hidden" name="template_id" class="template_id" value="<?php echo $row["id"] ?>">
                                                                    <button type="button" class="btn btn-secondary  btn-sm  make_default" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Set as default (Active)"><i class="bi bi-pin"></i></button>
                                                                <?php } else { ?>
                                                                    <input type="hidden" name="template_inactive_id" class="template_inactive_id" value="<?php echo $row["id"] ?>">
                                                                    <button type="button" class="btn btn-secondary  btn-sm  make_inactive" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Set as Inactive"><i class="bi bi-pencil"></i></i></button>
                                                                <?php  } ?>
                                                            </div>
                                                            <div class="columns">
                                                                <button type="button" class="btn btn-dark btn-sm btntooltips" data-bs-toggle="modal" data-bs-target="#changeLOATemplate-<?php echo $row['id'] ?>" title="Change LOA Template">
                                                                    <i class="bi bi-filetype-docx"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <!-- Modal for Changing LOA Template file -->
                                                    <div class="modal fade" id="changeLOATemplate-<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">CHANGE LOA TEMPLATE</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php 
                                                                        $select = "SELECT loa_main.*, 
                                                                                    loa_files.*, 
                                                                                    DATE_FORMAT(date_modified, '%M %d %Y') AS date_modified,
                                                                                    loa_main.id AS loa_main_id
                                                                                    FROM loa_maintenance_word loa_main, loa_files loa_files
                                                                                    WHERE loa_files.loa_main_id = loa_main.id
                                                                                    AND loa_files.id = '" . $row['id'] . "'";
                                                                        $select_result = $link->query($select);
                                                                        $select_row = $select_result->fetch_assoc();
                                                                        $select_id = $select_row['loa_main_id'];
                                                                    ?>
                                                                    <form action="action.php" method="POST" class="form-group" enctype="multipart/form-data">
                                                                        <input type="hidden" name="loatemplate_id" value="<?php echo $row['id'] ?>">
                                                                        <input type="hidden" name="select_id" value="<?php echo $select_id ?>">
                                                                        <div class="col-md-12">
                                                                            <label for="loatemplate_file" class="form-label">LOA Template File</label>
                                                                            <input type="file" name="loatemplate_file" id="loatemplate_file" class="form-control" required>    
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label for="loa_name" class="form-label">LOA Name</label>
                                                                            <input type="text" name="loa_name" id="loa_name" class="form-control" value="<?php echo $select_row['loa_name'];?>">
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label for="division" class="form-label">Division</label>
                                                                            <select class="form-select" name="division" id="division">
                                                                                <option value="<?php echo $select_row['division'];?>" selected disabled><?php echo $select_row['division'];?></option>
                                                                                <?php 
                                                                                $division = "SELECT * FROM divisions WHERE is_deleted = '0'";
                                                                                $division_result = $link->query($division);
                                                                                while($division_row = $division_result->fetch_assoc()){
                                                                                ?>
                                                                                <option value="<?php echo $division_row['description'];?>"><?php echo $division_row['description'];?></option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                         
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" name="change_file_btn" class="btn btn-primary">Save changes</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>



                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- End of Main page -->
            </div>
        </div>

        <?php include '../components/footer.php'; ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../index.php");
    exit(0);
}
?>
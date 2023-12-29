<?php
session_start();
include '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <title>LOA Database</title>

    <style>
        .name {
            position: sticky;
            margin-top: -22.8rem !important;
            padding-top: 10px;
            margin-left: 2.1rem;
            background-color: transparent;
            width: 410px;
            text-align: center;
            box-shadow: none !important;
        }

        .position {
            position: sticky;
            margin-top: 1.5rem !important;
            padding-top: 10px;
            margin-left: 2.1rem;
            background-color: transparent;
            width: 410px;
            text-align: center;
            box-shadow: none !important;
        }

        .id_no {
            position: sticky;
            margin-top: 7.5rem !important;
            padding-top: 11px;
            margin-left: 1.9rem;
            background-color: transparent;
            width: 190px;
            text-align: center;
            box-shadow: none !important;
        }

        .date_end {
            position: sticky;
            margin-top: -3rem !important;
            padding-top: 10px;
            margin-left: 16rem;
            background-color: transparent;
            width: 190px;
            text-align: center;
            box-shadow: none !important;
        }

        .contact_person {
            position: sticky;
            margin-top: -34rem !important;
            padding-top: 5px;
            margin-left: 38rem;
            background-color: transparent;
            width: 280px;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .contact_address {
            position: sticky;
            margin-top: 1rem !important;
            padding-top: 10px;
            margin-left: 32rem;
            background-color: transparent;
            width: 370px;
            height: 80px;
            text-align: center;
            box-shadow: none !important;
        }

        .contact_number {
            position: sticky;
            margin-top: 0rem !important;
            padding-top: 18px;
            margin-left: 38rem;
            background-color: transparent;
            width: 270px;
            height: 55px;
            text-align: center;
            box-shadow: none !important;
        }

        .sss {
            position: sticky;
            margin-top: 0rem !important;
            padding-top: 15px;
            margin-left: 36rem;
            background-color: transparent;
            width: 20%;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .philhealth {
            position: sticky;
            margin-top: .1rem !important;
            padding-top: 15px;
            margin-left: 39rem;
            background-color: transparent;
            width: 20.6%;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .tin {
            position: sticky;
            margin-top: .3rem !important;
            padding-top: 15px;
            margin-left: 36rem;
            background-color: transparent;
            width: 20.6%;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .hdmf {
            position: sticky;
            margin-top: 0rem !important;
            padding-top: 15px;
            margin-left: 36rem;
            background-color: transparent;
            width: 20.6%;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .birthday {
            position: sticky;
            margin-top: 0rem !important;
            padding-top: 15px;
            margin-left: 37rem;
            background-color: transparent;
            width: 20.6%;
            height: 55px;
            text-align: center;
            box-shadow: none !important;
        }

        .name h2,
        .position h2,
        .id_no h2,
        .date_end h2 {
            font-size: 24px;
            font-family: 'Arial', sans-serif !important;
            color: black !important;
        }

        .contact_person h2,
        .contact_address h2,
        .contact_number h2,
        .sss h2,
        .tin h2,
        .philhealth h2,
        .hdmf h2,
        .birthday h2 {
            font-size: 20px;
            color: black !important;
        }

        #photo #photoko {
            z-index: 1;
            position: sticky;
            margin-top: -28.5rem;
            margin-left: 8rem;
            width: 203px;
            height: 210px !important;
            background: transparent;
        }

        #photoregular #photoko {
            z-index: 1;
            position: sticky;
            margin-top: -29.1rem;
            margin-left: 8.4rem;
            width: 205px;
            height: 210px !important;
            background: transparent;
        }

        .id_no_regular {
            position: sticky;
            margin-top: 7.5rem !important;
            padding-top: 18px;
            margin-left: 9rem;
            background-color: transparent;
            width: 190px;
            text-align: center;
            box-shadow: none !important;
        }

        .id_no_regular h2 {
            font-size: 24px;
            font-family: 'Arial', sans-serif !important;
            color: black !important;
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
                                        LOA DATABASE
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
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM deployment WHERE clearance = 'ACTIVE'";
                                        $result = $link->query($query);
                                        while ($row = $result->fetch_assoc()) {
                                            $start_date = $row['loa_start_date'];
                                            $end_date = $row['loa_end_date'];
                                            $dateObj = date_create_from_format('Y-m-d', $start_date);
                                            $dateObj2 = date_create_from_format('Y-m-d', $end_date);
                                            $formattedDate_start = date_format($dateObj, 'F j, Y');
                                            $formattedDate_end = date_format($dateObj2, 'F j, Y');
                                            $id = $row['employee_id'];
                                            $fetch = "SELECT * FROM employees WHERE id = '$id'";
                                            $retrieved = $link->query($fetch);
                                            while ($fetched = $retrieved->fetch_assoc()) {
                                                $employee_id = $row['employee_id'];
                                                $deployment_id = $row['id'];
                                                
                                                $select_folder = "SELECT * FROM folder WHERE employee_id = '$employee_id' AND deployment_id = '$deployment_id'";
                                                $select_folder_result = $link->query($select_folder);
                                                $select_folder_row = $select_folder_result->fetch_assoc();
                                                
                                                $fileNames = explode(',', $row['signed_loa_file']);

                                                $name = $fetched['firstnameko'] . " " . $fetched['mnko'] . " " . $fetched['lastnameko'] . "-PCN_ID.png";
                                                

                                        ?>
                                                <tr>
                                                    <td><?php echo $row['type'] ?></td>
                                                    <td><?php echo $row['category'] ?></td>
                                                    <td><?php echo $fetched['lastnameko'] . ", " . $fetched['firstnameko'] . " " . $fetched['mnko'] ?></td>
                                                    <td><?php echo $row['place_assigned'] ?></td>
                                                    <td><?php echo $row['project_start_date'] ?></td>
                                                    <td><?php echo $formattedDate_start ?></td>
                                                    <td><?php echo $formattedDate_end ?></td>
                                                    <td><?php echo $row['employment_status'] ?></td>
                                                    <td><?php echo $row['clearance'] ?></td>
                                                    <td><?php echo $row['signed_loa_status'] ?></td>
                                                    
                                                    <td>
                                                        <div class="contain">
                                                            <div class="columns">
                                                                <button type="button" class="btn btn-sm btn-primary btntooltips" data-bs-toggle="modal" data-bs-target="#downloadIDModal-<?php echo $row['id'] ?>" title="Float">
                                                                    <i class="bi bi-person-exclamation"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </td>



                                                    <!--Modal for Floating Employee -->
                                                    <div class="modal fade" id="downloadIDModal-<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php 
                                                                        $select_data = "SELECT deployment.*, employee.*, DATE_FORMAT(project_start_date, '%M %d, %Y') AS project_start_date 
                                                                        FROM deployment deployment, employees employee
                                                                        WHERE deployment.employee_id = employee.id
                                                                        AND deployment.id = '" . $row['id'] . "'";
                                                                        $select_data_result = $link->query($select_data);
                                                                        $select_data_row = $select_data_result->fetch_assoc();
                                                                    ?>
                                                                    <form action="action.php" method="post" class="form-group row" id="myForm">
                                                                        <input type="hidden" name="deployment_id" id="deployment_id" value="<?php echo $row['id'] ?>">
                                                                        <input type="hidden" name="employee_id" id="employee_id" value="<?php echo $select_data_row['employee_id'] ?>">
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Name</label>
                                                                            <input type="text" class="form-control" name="name" value="<?php echo $select_data_row['firstnameko'] . " " . $select_data_row['mnko'] . " " . $select_data_row['lastnameko'] . " " . $select_data_row['extnname'];?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Project Title</label>
                                                                            <input type="text" class="form-control" name="project_title" value="<?php echo $select_data_row['shortlist_title'];?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Project Date Start</label>
                                                                            <input type="text" class="form-control" name="project_date_start" value="<?php echo $select_data_row['project_start_date'];?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Employment Status</label>
                                                                            <input type="text" class="form-control" name="employment_status" value="<?php echo $select_data_row['employment_status'];?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Effectivity Date</label>
                                                                            <input type="date" class="form-control" name="effectivity_date" id="effectivity_date" required>
                                                                        </div>
                                                                        <div class="col-md-12 mt-3">
                                                                            <label class="form-label">Reason for Floating</label>
                                                                            <textarea class="form-control" name="reason_for_floating" cols="10" rows="5" required></textarea>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="floatButton" id="floatButton">Submit</button>
                                                                </div>
                                                                </form>
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
   
    <?php include '../components/footer.php'; ?>
</body>

</html>
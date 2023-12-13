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
                                        DEPLOYMENT LOA DATABASE
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
                                            <th>LOA Submitted Files</th>
                                            <th>LOA Approved By</th>
                                            <th>ID Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM deployment";
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
                                                    <td class="text-center">
                                                        <?php
                                                            foreach ($fileNames as $fileName) {
                                                                echo '<a href="https://jobs.hrdpcnpromopro.com/' . $select_folder_row['folder_path'] . '/' . $fileName . '" download target="_blank">' . $fileName . '</a><br>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['signed_loa_approved_by'] ?></td>
                                                    <td><?php echo $row['id_remarks'] ?></td>
                                                    <td>
                                                        <div class="contain">
                                                            <div class="columns">
                                                                <a href="download_loa.php?id=<?php echo $fetched['id'] ?>&deployment_id=<?php echo $row['id'] ?>" class="btn btn-dark btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download LOA"><i class="bi bi-cloud-download"></i></a>
                                                            </div>
                                                            <div class="columns">
                                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" title="Upload Files" data-bs-target="#uploadLOAPDFModal-<?php echo $row['id'] ?>">
                                                                    <i class="bi bi-cloud-arrow-up"></i>
                                                                </button>
                                                            </div>
                                                            <?php 
                                                                if($row['signed_loa_status'] === 'SUBMITTED'){
                                                            ?>
                                                            <div class="columns">
                                                                <input type="hidden" class="approve_signed_loa_id" value="<?php echo $row['id'];?>">
                                                                <button type="button" class="btn btn-sm btn-success approve_signed_loa_btn" data-bs-toggle="tooltip" data-bs-title="Approve Submitted Signed LOA">
                                                                    <i class="bi bi-check2-square"></i>
                                                                </button>
                                                            </div>
                                                            <?php } else {
                                                                echo "";
                                                            }
                                                            ?>
                                                            <div class="columns">
                                                                
                                                                <?php if(empty($row['id_remarks'])) { ?>
                                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#downloadIDModal-<?php echo $row['id'] ?>">
                                                                        <i class="bi bi-file-earmark-arrow-down"></i>
                                                                    </button>
                                                                    <?php } elseif(!empty($row['id_remarks'])){ ?>
                                                                    <a href="print_idcard.php?id=<?php echo $row['id'] ?>" name="name" download="<?php echo $row['type'] . "-" . $name ?>" class="btn btn-info btn-sm" data-id="<?php echo $row['emp_id'] ?>" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Download ID"><i class="bi bi-file-earmark-arrow-down"></i></a>
                                                                <?php }?>
                                                            </div>
                                                            
                                                        </div>
                                                    </td>



                                                    <!--Modal for Update ID Status-->
                                                    <div class="modal fade" id="downloadIDModal-<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="action.php" method="post" class="form-group row" id="myForm">
                                                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                                                                        <div class="col-md-12">
                                                                            <label for="" class="form-label">ID Status</label>
                                                                            <select name="id_status" id="id_status" class="form-select" required>
                                                                                <option value="">Select</option>
                                                                                <option value="RELEASE WITH SIGNED LOA">RELEASE WITH SIGNED LOA</option>
                                                                                <option value="RELEASE WITHOUT SIGNED LOA">RELEASE WITHOUT SIGNED LOA</option>
                                                                            </select>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="submitButton" id="submitButton">Submit</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <!--Modal for Uploading LOA Files - PDF-->
                                                    <div class="modal fade" id="uploadLOAPDFModal-<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Files</h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="action.php" method="post" class="form-group row" id="myForm" enctype="multipart/form-data">
                                                                        <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ?>">
                                                                        <div class="col-md-12">
                                                                            <label for="" class="form-label">Attach File/s (PDF Only)</label>
                                                                            <input type="file" name="files[]" id="files" class="form-control" multiple required>
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="upload_btn" id="upload_btn">Upload</button>
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


                                <!-- Generating IDs -->
                                <div class="image justify-content-center align-items-center mx-auto" id="image">
                                    <?php
                                    if (isset($_POST['name'])) {
                                        $search_id = $link->real_escape_string($_POST['id']);
                                        $html = '';

                                        // Query for Regular Employees
                                        $query = "SELECT * FROM deployment WHERE emp_id LIKE '%" . $search_id . "'";
                                        $result = $link->query($query);

                                        if ($result->num_rows > 0) {
                                            $html .= "";
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['employee_id'];

                                                $fetch_employee = "SELECT * FROM employees WHERE id = '$id'";
                                                $fetch_result = $link->query($fetch_employee);
                                                while ($fetch_row = $fetch_result->fetch_assoc()) {

                                                    if (empty($fetch_row['mnko']) || $fetch_row['mnko'] === "NA" || $fetch_row['mnko'] === "N/A") {
                                                        $name = $fetch_row['firstnameko'] . " " . $fetch_row['lastnameko'];
                                                    } else {
                                                        $name = $fetch_row['firstnameko'] . " " . $fetch_row['mnko'] . " " . $fetch_row['lastnameko'];
                                                    }
                                                    $position = $row['job_title'];
                                                    $id_no = $row['emp_id'];
                                                    $end_date = $row['loa_end_date'];
                                                    $formattedDate = str_replace('-', '/', $end_date);
                                                    $contact_person = $fetch_row['e_person'];
                                                    $address = $fetch_row['e_address'];
                                                    $contact_number = $fetch_row['e_number'];
                                                    $sss = $row['sss'];
                                                    $philhealth = $row['philhealth'];
                                                    $pagibig = $row['pagibig'];
                                                    $tin = $row['tin'];
                                                    $birthday = $fetch_row['birthday'];
                                                    $timestamp_birthday = strtotime($birthday);
                                                    $formattedDate_birthday = date("F d, Y", $timestamp_birthday);

                                                    if ($row['employment_status'] === "REGULAR") {

                                    ?>
                                                        <img src="../assets/img/elements/IDRegular2.png" alt="ID" class="img-responsive">
                                                        <div class="card name">
                                                            <h2><?php echo $name ?></h2>
                                                        </div>
                                                        <div class="card position">
                                                            <h2><?php echo $position ?></h2>
                                                        </div>
                                                        <div class="card id_no_regular">
                                                            <h2><?php echo $id_no ?></h2>
                                                        </div>

                                                        <div class="card contact_person">
                                                            <h2><?php echo $contact_person ?></h2>
                                                        </div>
                                                        <div class="card contact_address">
                                                            <h2><?php echo $address ?></h2>
                                                        </div>
                                                        <div class="card contact_number">
                                                            <h2><?php echo $contact_number ?></h2>
                                                        </div>
                                                        <div class="card sss">
                                                            <h2><?php echo $sss ?></h2>
                                                        </div>
                                                        <div class="card tin">
                                                            <h2><?php echo $tin ?></h2>
                                                        </div>
                                                        <div class="card philhealth">
                                                            <h2><?php echo $philhealth ?></h2>
                                                        </div>
                                                        <div class="card hdmf">
                                                            <h2><?php echo $pagibig ?></h2>
                                                        </div>
                                                        <div class="card birthday">
                                                            <h2><?php echo $formattedDate_birthday ?></h2>
                                                        </div>

                                                        <div class="card" id="photoregular">
                                                            <img src="../../<?php echo $fetch_row['photopath'] ?>" id="photoko" alt="">
                                                        </div>
                                                        <div class="caption">
                                                            <input type="hidden" id="caption-input" value="<?php echo $name ?>-PCN ID">
                                                        </div>
                                                        <br><br><br><br><br><br>
                                                    <?php

                                                    } else { ?>

                                                        <img src="../assets/img/elements/PCNBG2.png" alt="ID" class="img-responsive">
                                                        <div class="card name">
                                                            <h2><?php echo $name ?></h2>
                                                        </div>
                                                        <div class="card position">
                                                            <h2><?php echo $position ?></h2>
                                                        </div>
                                                        <div class="card id_no">
                                                            <h2><?php echo $id_no ?></h2>
                                                        </div>
                                                        <div class="card date_end">
                                                            <h2><?php echo $formattedDate ?></h2>
                                                        </div>

                                                        <div class="card contact_person">
                                                            <h2><?php echo $contact_person ?></h2>
                                                        </div>
                                                        <div class="card contact_address">
                                                            <h2><?php echo $address ?></h2>
                                                        </div>
                                                        <div class="card contact_number">
                                                            <h2><?php echo $contact_number ?></h2>
                                                        </div>
                                                        <div class="card sss">
                                                            <h2><?php echo $sss ?></h2>
                                                        </div>
                                                        <div class="card tin">
                                                            <h2><?php echo $tin ?></h2>
                                                        </div>
                                                        <div class="card philhealth">
                                                            <h2><?php echo $philhealth ?></h2>
                                                        </div>
                                                        <div class="card hdmf">
                                                            <h2><?php echo $pagibig ?></h2>
                                                        </div>
                                                        <div class="card birthday">
                                                            <h2><?php echo $formattedDate_birthday ?></h2>
                                                        </div>

                                                        <div class="card" id="photo">
                                                            <img src="../../<?php echo $fetch_row['photopath'] ?>" id="photoko" alt="">
                                                        </div>
                                                        <div class="caption">
                                                            <input type="hidden" id="caption-input" value="<?php echo $name ?>_PCN ID">
                                                        </div>
                                                        <br><br><br><br><br><br>

                                    <?php }
                                                }
                                            }
                                        } else {
                                            echo "No record found";
                                            exit(0);
                                        }
                                    }

                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Download Generated ID
        $(document).ready(function() {
            $("#download").on('click', function() {
                var element = document.getElementById("image");
                var caption = $('#caption-input').val();

                html2canvas(element).then(function(canvas) {
                    var imageData = canvas.toDataURL("image/png");
                    var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");

                    var downloadLink = document.createElement('a');
                    downloadLink.href = newData;
                    downloadLink.download = caption + '.png';
                    downloadLink.click();
                });
            });
        });
        
        
        //   For approving Submitted Signed LOA 
      $('#example').on('click', '.approve_signed_loa_btn', function(e) {
         e.preventDefault();

         var approve_signed_loa_id = $(this).closest("tr").find('.approve_signed_loa_id').val();

         Swal.fire({
            title: "Select:",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Send",
            cancelButtonText: "Cancel",
            showCloseButton: true,

            // Customize the content of the modal
            html: `
            <select id="reverificationReason" class="swal2-select">
                <option value="RETURNED">RETURNED</option>
                <option value="RESUBMIT">RESUBMIT</option>
                <!-- Add more options as needed -->
            </select>
        `,

            preConfirm: () => {
               // Retrieve the selected reason from the select dropdown
               var reason = document.getElementById("reverificationReason").value;

               if (!reason) {
                  Swal.showValidationMessage("Reason is required");
               }

               // Log the reason to the console for debugging
               console.log("Reason for reverification: " + reason);

               // Send the reason along with the AJAX request
               return {
                  reason: reason
               };
            }
         }).then((result) => {
            if (result.isConfirmed) {
               var reason = result.value.reason; // Get the reason selected by the user
               if (reason) {
                  // Send the reason along with the AJAX request
                  $.ajax({
                     type: "POST",
                     url: "action.php",
                     data: {
                        "approve_signed_loa_btn_click": 1,
                        "approve_signed_loa_id": approve_signed_loa_id,
                        "reason": reason,
                     },
                     success: function(response) {
                        Swal.fire({
                           title: "Success",
                           icon: "success",
                        }).then((result) => {
                           location.reload();
                        });
                     },
                     error: function(xhr, status, error) {
                        console.log("AJAX Error: " + error);
                     }
                  });
               }
            }
         });
      });
    </script>
    <?php include '../components/footer.php'; ?>
</body>

</html>
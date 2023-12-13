<?php
include 'connect.php';
session_start();
?>
<style>
    .sweet-alert-above-modal {
        z-index: 1051;
    }
</style>
<div class="container table-responsive">
    <table class="table table-sm" id="example">
        <thead>
            <tr>
                <th>Applicant Name</th>
                <th>gender</th>
                <th>Age</th>
                <th>Contact Number</th>
                <th>Date Applied</th>
                <th>Resume</th>
                <th>Recruitment Status</th>
                <th>Project Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $id = $_POST['id'];
            $query = "SELECT applicant.*, project.*, resume.*, resume.folder_id AS folder_id, resume.applicant_id AS applicant_id,
                DATE_FORMAT(resume.date_applied, '%M %d, %Y') as date_applied
                FROM applicant applicant, projects project, applicant_resume resume
                WHERE applicant.id = resume.applicant_id 
                AND project.id = resume.project_id 
                AND project.id = '$id'
                AND resume.status != 'NOT QUALIFIED'";

            $result = $link->query($query);
            while ($row = $result->fetch_assoc()) {
                $applicant_id = $row['applicant_id'];
                $folder_id = $row['folder_id'];
                $select_folder = "SELECT * FROM folder 
                                  WHERE id = '$folder_id'
                                  AND applicant_id = '$applicant_id' 
                                  AND folder_name = 'Requirements'";
                $select_folder_result = $link->query($select_folder);
                while ($select_folder_row = $select_folder_result->fetch_assoc()) {
            ?>
                    <tr>
                        <td><?php echo $row['lastname'] . ", " . $row['firstname'] . " " . $row['middlename'] ?></td>
                        <td><?php echo $row['gender'] ?></td>
                        <td><?php echo $row['age'] ?></td>
                        <td><?php echo $row['mobile_number'] ?></td>
                        <td><?php echo $row['date_applied'] ?></td>
                        <td>
                            <?php
                            $resumeFilePath = "https://jobs.hrdpcnpromopro.com/" . $select_folder_row['folder_path'] . "/" . $row['resume_file'];
                            $fileExtension = pathinfo($resumeFilePath, PATHINFO_EXTENSION);

                            if (strtolower($fileExtension) === 'pdf') { ?>
                                <a href="<?php echo $resumeFilePath ?>" target="_blank"><?php echo $row['resume_file'] ?></a>
                            <?php } elseif (strtolower($fileExtension) === 'docx') { ?>
                                <a href="https://view.officeapps.live.com/op/embed.aspx?src=<?php echo $resumeFilePath ?>" target="_blank"><?php echo $row['resume_file'] ?></a>
                            <?php }
                            ?>
                        </td>
                        <td><?php echo $row['status'] ?></td>
                        <td><?php echo $row['project_status'] ?></td>

                        <td>
                            <div class="contain">
                                <?php
                                if ($row['status'] === 'QUALIFIED' && $row['project_status'] === 'PENDING') {
                                ?>
                                    <div class="columns">
                                        <input type="hidden" class="approve_applicants_ID" value="<?php echo $row['id'] ?>">
                                        <button type="button" class="btn btn-primary btn-sm btnApprove btntooltips" id="btnApprove" title="Search">Deploy</button>
                                    </div>
                                    <div class="columns">
                                        <input type="hidden" class="editID" value="<?php echo $row['id'] ?>">
                                        <button type="button" class="btn btn-danger btn-sm btnReject btntooltips" id="btnReject" title="Search">Reject</button>
                                    </div>

                                <?php
                                } else {
                                    echo "";
                                } ?>
                            </div>
                        </td>
                    </tr>
            <?php }
            } ?>
        </tbody>
    </table>
</div>

<script>
    // For approving applicants
    $(document).ready(function() {
        $('.btnApprove').click(function(e) {
            e.preventDefault();

            var approve_applicants_ID = $(this).closest("tr").find('.approve_applicants_ID').val();

            $('#projectModal').modal('hide'); // Replace 'yourModalID' with the actual ID of your modal

            // Wait for the modal to close, then show SweetAlert
            setTimeout(function() {
                Swal.fire({
                    title: "Are you sure you want to approve?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "No",
                }).then((willDelete) => {
                    if (willDelete.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "action.php",
                            data: {
                                "approve_applicants_button_click": 1,
                                "approve_applicants_id": approve_applicants_ID,
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Success!",
                                    icon: "success"
                                }).then((result) => {
                                    location.reload();
                                });
                            }
                        });
                    }
                });
            }, 100);
        });
    });

    // For Rejecting Applicants
    $(document).ready(function() {
        $('.btnReject').click(function(e) {
            e.preventDefault();

            var editID = $(this).closest("tr").find('.editID').val();

            // Close the modal
            $('#projectModal').modal('hide'); // Replace 'yourModalID' with the actual ID of your modal

            // Wait for the modal to close, then show SweetAlert
            setTimeout(function() {
                Swal.fire({
                    title: "Are you sure you want to reject?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Yes",
                    cancelButtonText: "Cancel",
                    showCloseButton: true,
                    html: '<input type="text" id="blacklistReason" placeholder="Enter reason for rejecting" class="swal2-input">',
                    inputAttributes: {
                        allowEnterKey: false
                    },
                    customClass: {
                        container: 'sweet-alert-above-modal'
                    },
                    preConfirm: () => {
                        var reason = document.getElementById("blacklistReason").value;
                        if (!reason) {
                            Swal.showValidationMessage("Reason is required");
                        }
                        return {
                            reason: reason
                        };
                    },
                    willClose: function() {
                        location.reload(); // Refresh the page
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        var reason = result.value.reason;
                        if (reason) {
                            $.ajax({
                                type: "POST",
                                url: "action.php",
                                data: {
                                    "reject_button": 1,
                                    "editID": editID,
                                    "reason": reason,
                                },
                                success: function(response) {
                                    Swal.fire({
                                        title: "Success!",
                                        icon: "success",
                                    });
                                },
                                error: function(xhr, status, error) {
                                    console.log("AJAX Error: " + error);
                                }
                            });
                        }
                    }
                });
            }, 100); // Adjust the timeout duration if needed
        });
    });
    // new DataTable('#example');
</script>
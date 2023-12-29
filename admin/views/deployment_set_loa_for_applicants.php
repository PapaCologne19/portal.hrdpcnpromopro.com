<?php
session_start();
include '../../connect.php';

$deploy_id = $_POST['id'];
$query = "SELECT shortlist.*, employee.* 
FROM shortlist_master shortlist, employees employee
WHERE shortlist.employee_id = employee.id 
AND shortlistnameto = '" . $_SESSION['shortlist_title'] . "' AND employee.id = '$deploy_id'";
$result = $link->query($query);

if (!$result) {
    die("SQL Error: " . mysqli_error($link));
}

$row = $result->fetch_assoc();
?>

<div class="container-fluid">
    <!-- Start of Form -->
    <form action="action.php" method="POST">
        <?php
        $id =  $row['id'];
        $data = $_SESSION['shortlist_title'];

        $query_show = "SELECT employee.*, project.*, shortlist.*, request.*, request.id AS request_id, employee.app_id AS employee_app_id
        FROM employees employee, projects project, shortlist_master shortlist, loa_requests request
        WHERE employee.id = request.employee_id
        AND project.id = request.project_id
        AND shortlist.id = request.shortlist_id
        AND shortlistnameto = '$data' 
        AND employee.id = '$id'";

        $query_result = $link->query($query_show);
        $query_row = $query_result->fetch_assoc();
        $appno = $query_row['appno'];

        $request_loa = "";

        ?>

        <input type="hidden" name="id" value="<?php echo $query_row["employee_id"] ?>" />
        <input type="hidden" name="request_id" value="<?php echo $query_row["request_id"] ?>" />
        <input type="hidden" name="project_id" value="<?php echo $query_row["project_id"] ?>" />
        <input type="hidden" name="appno" value="<?php echo $query_row["appno"] ?>" />
        <input type="hidden" name="employee_app_id" value="<?php echo $query_row["employee_app_id"] ?>" />
        <input type="hidden" name="shortlist_title" value="<?php echo $data ?>" />
        <input type="hidden" name="date_shortlisted" value="<?php echo $query_row["dateto"] ?>" />
        <input type="hidden" name="status" id="status" class="form-control" value="DEPLOYED">

        <div class="row mt-3 form-group">
            <div class="col-md-3">
                <label for="" class="form-label">Type</label>
            </div>
            <div class="col-md-9">
                <select name="type" id="type" class="form-select">
                    <option value=""> Select</option>
                    <option value="NEW">NEW</option>
                    <option value="RENEWAL">RENEWAL</option>
                    <option value="REHIRED">REHIRED (new)</option>
                </select>
            </div>
        </div>

        <div class="row mt-3 form-group">
            <div class="col-md-3">
                <label for="" class="form-label">LOA Start Date</label>
            </div>
            <div class="col-md-9">

                <input type="date" name="start_loa" id="myDate" value="<?php echo $query_row['start_date'] ?>" placeholder="Select start date" class="form-control" required>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-3">
                <label for="" class="form-label">LOA End Date</label>
            </div>
            <div class="col-md-9">
                <input type="date" name="end_loa" id="myDate" value="<?php echo $query_row['end_date'] ?>" placeholder="Select end date" class="form-control" required>
            </div>
        </div>
        <?php
        $shortlist_title = $query_row['shortlistnameto'];
        $queries = "SELECT * FROM shortlist_details WHERE shortlistname = '$shortlist_title'";
        $result_queries = $link->query($queries);
        while ($fetch_row = $result_queries->fetch_assoc()) {
            $project_title = $fetch_row['project'];
            $mrf_tracking = $fetch_row['mrf_tracking'];
        ?>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Division</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="division" id="division" class="form-control" value="<?php echo $query_row['division'] ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Category</label>
                </div>
                <div class="col-md-9">
                    <select name="category" id="category" class="form-select" required>
                        <option value="<?php echo $query_row['category'] ?>"><?php echo $query_row['category'] ?></option>
                        <?php
                        $querys = "SELECT * FROM categories";
                        $results = $link->query($querys);
                        while ($rowsss = $results->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $rowsss['description'] ?>"><?php echo $rowsss['description'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Locator</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="locator" id="locator" class="form-control" value="<?php echo $query_row['locator'] ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                </div>
                <div class="col-md-9">
                    <input type="hidden" name="client_name" id="client_name" class="form-control" value="<?php echo $query_row['client_name'] ?>" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Place Assigned</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="place_assigned" id="place_assigned" value="<?php echo $query_row['place_assigned'] ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Address Assigned</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="address_assigned" id="address_assigned" value="<?php echo $query_row['client_address'] ?>" class="form-control" readonly>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Channel</label>
                </div>
                <div class="col-md-9">
                    <select name="channel" id="channel" class="form-select" required>
                        <option value="<?php echo $query_row['channel'] ?>"><?php echo $query_row['channel'] ?></option>
                        <?php
                        $channel_query = "SELECT * FROM channels";
                        $channel_result = $link->query($channel_query);
                        while ($channel_rows = $channel_result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $channel_rows['description'] ?>"><?php echo $channel_rows['description'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Department</label>
                </div>
                <div class="col-md-9">
                    <select name="department" id="department" class="form-select" required>
                        <option value="<?php echo $query_row['department'] ?>"><?php echo $query_row['department'] ?></option>
                        <?php
                        $mrf_query = "SELECT * FROM department";
                        $mrf_result = $link->query($mrf_query);
                        while ($mrf_row = $mrf_result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $mrf_row['description'] ?>"><?php echo $mrf_row['description'] ?></option>
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
                        <option value="<?php echo ucwords(strtolower($query_row['employment_status'])); ?>"><?php echo $query_row['employment_status'] ?></option>
                        <?php
                        $emp_query = "SELECT * FROM employment_status";
                        $emp_result = $link->query($emp_query);
                        while ($emp_row = $emp_result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo ucwords(strtolower($emp_row['name'])) ?>"><?php echo ucwords(strtolower($emp_row['name'])) ?></option>
                        <?php } ?>
                    </select>

                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Job Title</label>
                </div>
                <div class="col-md-9">
                    <select name="job_title" id="job_title" class="form-select" required>
                        <option value="<?php echo $query_row['job_title'] ?>"><?php echo $query_row['job_title'] ?></option>
                        <?php
                        $job_title_query = "SELECT * FROM job_title";
                        $job_title_result = $link->query($job_title_query);
                        while ($job_title_row = $job_title_result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $job_title_row['description'] ?>"><?php echo $job_title_row['description'] ?></option>
                        <?php } ?>
                    </select>

                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">LOA Template</label>
                </div>
                <div class="col-md-9">
                    <select name="loa_template" id="loa_template" class="form-select" required>
                        <option value="">Select</option>
                        <?php
                        $select_loa = "SELECT loa_main.*, loa_files.*
                            FROM loa_maintenance_word loa_main, loa_files loa_files
                            WHERE loa_files.loa_main_id = loa_main.id AND status = '1'";
                        $seleted_loa_result = $link->query($select_loa);
                        while ($selected_loa_row = $seleted_loa_result->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $selected_loa_row['id'] ?>"><?php echo $selected_loa_row['loa_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Basic Salary</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="<?php echo $query_row['basic_salary'] ?>" required>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Ecola</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="ecola" id="ecola" class="form-control" value="<?php echo $query_row['ecola'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Communication Allowance</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="communication_allowance" id="communication_allowance" class="form-control" value="<?php echo $query_row['communication_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Transportation</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="transportation_allowance" id="transportation_allowance" class="form-control" value="<?php echo $query_row['transportation_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Internet Allowance</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="internet_allowance" id="internet_allowance" class="form-control" value="<?php echo $query_row['internet_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Meal Allowance</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="meal_allowance" id="meal_allowance" class="form-control" value="<?php echo $query_row['meal_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Outbase Meal</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="outbase_meal" id="outbase_meal" class="form-control" value="<?php echo $query_row['outbase_meal'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Special Allowance</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="special_allowance" id="special_allowance" class="form-control" value="<?php echo $query_row['special_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Position Allowance</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="position_allowance" id="position_allowance" class="form-control" value="<?php echo $query_row['position_allowance'] ?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Deployment Remarks</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="deployment_remarks" id="deplyment_remarks" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">No. of Days work</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="no_of_days" id="no_of_days" class="form-control" value="<?php echo $query_row['no_days_of_work'] ?>">
                </div>
            </div>
            <div class="row mt-3 mb-5">
                <div class="col-md-3">
                    <label for="" class="form-label">Outlet</label>
                </div>
                <div class="col-md-9">
                    <?php
                    $outlet = $query_row['outlet'];
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
                    <div id="editor"><?php echo $html ?></div>
                    <textarea name="outlet" id="outlet" style="position: absolute; left: -9999px;"></textarea>
                </div>
            </div>







            <div class="row mt-5">
                <div class="col-md-3 mt-5">
                    <label for="" class="form-label">Prepared By</label>
                </div>
                <div class="col-md-9 mt-5">
                    <input type="text" name="deployment_personnel" id="deployment_personnel" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="deployment_personnel_designation" id="deployment_personnel_designation" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Noted By</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="field_supervisor" id="field_supervisor" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="field_supervisor_designation" id="field_supervisor_designation" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Field Supervisor</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="supervisor" id="supervisor" class="form-control" value="N/A">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Project Supervisor</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="project_supervisor" id="project_supervisor" class="form-control">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="project_supervisor_designation" id="project_supervisor_designation" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Department Head</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="head" id="head" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">Designation</label>
                </div>
                <div class="col-md-9">
                    <input type="text" name="head_designation" id="head_designation" class="form-control">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-md-3">
                    <label for="" class="form-label">ID#</label>
                </div>
                <div class="col-md-9">
                    <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
                    <input type="text" name="loa_id" id="dataInput" class="form-control">
                    <!--<div id="status"></div>-->
                    <small id="emp_idCheck" class="form-text text-muted"></small>
                    <script>
                        // // Ensure DOM is ready
                        // $(document).ready(function() {
                        //     // Get the input element and status div
                        //     var dataInput = $('#dataInput');
                        //     var statusDiv = $('#status');
                    
                        //     // Add input event listener
                        //     dataInput.on('input', function() {
                        //         // Get the input value
                        //         var inputData = $(this).val().trim();
                    
                        //         // Debug statement
                        //         console.log('Input value:', inputData);
                    
                        //         // Check if the input is not empty
                        //         if (inputData !== '') {
                        //             // Send AJAX request to the server using jQuery
                        //             $.ajax({
                        //                 type: 'POST',
                        //                 url: 'check_data.php',
                        //                 data: { data: inputData },
                        //                 success: function(response) {
                        //                     // Debug statement
                        //                     console.log('Response from server:', response);
                    
                        //                     // Update the status div with the response
                        //                     statusDiv.html(response);
                        //                 }
                        //             });
                        //         } else {
                        //             // Clear the status if input is empty
                        //             statusDiv.html('');
                        //         }
                        //     });
                        // });
                        
                        $(document).ready(function(){
                            var minChars = 3; // Minimum characters to trigger the check
                    
                            $('#dataInput').on('input', function(){
                                var emp_id = $(this).val();
                    
                                // Check only if the entered characters are more than the minimum
                                if (emp_id.length >= minChars) {
                                    $.ajax({
                                        type: 'POST',
                                        url: 'check_data.php',
                                        data: {emp_id: emp_id},
                                        success: function(response){
                                            $('#emp_idCheck').html(response);
                                        }
                                    });
                                } else {
                                    // If the entered characters are less than the minimum, clear the check message
                                    $('#emp_idCheck').html('');
                                }
                            });
                        });
                    </script>
                </div>
                
            </div>

        <?php }
        ?>

        <button type="button" class="btn btn-secondary mt-5" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary mt-5" name="create_loa">Save changes</button>
    </form>
    <!-- End of Form -->
</div>
<!-- Include jQuery -->




<script>

                
                   
    // For QUILL
    var quill = new Quill('#editor', {
        placeholder: 'Type outlet here...',
        theme: 'snow',
    });

    $('form').submit(function(event) {
        $('#outlet').val(JSON.stringify(quill.getContents()));
        return true;
    });
</script>
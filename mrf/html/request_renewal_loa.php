<?php
include 'connect.php';

$employee_id = $_POST['employee_id'];
$deployment_id = $_POST['deployment_id'];
$query = "SELECT *, 
DATE_FORMAT(loa_start_date, '%M %d, %Y') AS loa_start_date,
DATE_FORMAT(loa_end_date, '%M %d, %Y') AS loa_end_date
FROM deployment WHERE id = '$deployment_id'";
$date = date_create($row['project_start_date']);
$date_format = date_format($date, "F d, Y");
$result = $link->query($query);

if (!$result) {
    die("SQL Error: " . mysqli_error($link));
}
$row = $result->fetch_assoc();

?>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Project Date Start</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="start_date" class="form-control" id="start_date" value="<?php echo $date_format;?>" readonly>
        </div>
    </div>
    
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Previous Duration</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="start_date" class="form-control" id="start_date" value="From: <?php echo $row['loa_start_date'];?> To: <?php echo $row['loa_end_date'];?>" readonly>
        </div>
    </div>




<form action="action.php" method="post">
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Category</label>
        </div>
        <div class="col-md-9">
            <select name="category" id="category" class="form-select" required>
                <option value="<?php echo $row['category']; ?>"><?php echo $row['category']; ?></option>
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
    <input type="hidden" name="employee_id" value="<?php echo $employee_id ?>">
    <input type="hidden" name="deployment_id" value="<?php echo $deployment_id ?>">
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">LOA Date Start</label>
        </div>
        <div class="col-md-9">
            <input type="date" name="start_date" class="form-control" id="start_date" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">LOA Date End</label>
        </div>
        <div class="col-md-9">
            <input type="date" name="end_date" class="form-control" id="end_date" required>
        </div>
    </div>


    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Channel</label>
        </div>
        <div class="col-md-9">
            <select name="channel" id="channel" class="form-select" required>
                <option value="<?php echo $row['channel'] ?>"><?php echo $row['channel'] ?></option>
                <?php
                $channel = "SELECT * FROM channels WHERE is_deleted = '0'";
                $channel_result = $link->query($channel);
                while ($channel_row = $channel_result->fetch_assoc()) {

                ?>
                    <option value="<?php echo $channel_row['description'] ?>"><?php echo $channel_row['description'] ?></option>
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
                <option value="<?php echo $row['employment_status']; ?>"><?php echo $row['employment_status']; ?></option>
                <?php
                $employment_status = "SELECT * FROM employment_status";
                $employment_status_result = $link->query($employment_status);
                while ($employment_status_row = $employment_status_result->fetch_assoc()) {
                ?>
                    <option value="<?php echo ucwords(strtolower($employment_status_row['name'])) ?>"><?php echo ucwords(strtolower($employment_status_row['name'])) ?></option>
                <?php } ?>
            </select>

        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Position</label>
        </div>
        <div class="col-md-9">
            <select name="job_title" id="job_title" class="form-select" required>
                <option value="<?php echo $row['job_title']; ?>"><?php echo $row['job_title']; ?></option>
                <?php
                $job_title_query = "SELECT * FROM job_title WHERE is_deleted = '0'";
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
            <label for="" class="form-label">Basic Salary</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="<?php echo $row['basic_salary'] ?>" required>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Ecola</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="ecola" id="ecola" class="form-control" value="<?php echo $row['ecola']; ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Communication Allowance</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="communication_allowance" id="communication_allowance" class="form-control" value="<?php echo $row['communication_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Transportation</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="transportation_allowance" id="transportation_allowance" class="form-control" value="<?php echo $row['transportation_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Internet Allowance</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="internet_allowance" id="internet_allowance" class="form-control" value="<?php echo $row['internet_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Meal Allowance</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="meal_allowance" id="meal_allowance" class="form-control" value="<?php echo $row['meal_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Outbase Meal</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="outbase_meal" id="outbase_meal" class="form-control" value="<?php echo $row['outbase_meal'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Special Allowance</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="special_allowance" id="special_allowance" class="form-control" value="<?php echo $row['special_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Position Allowance</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="position_allowance" id="position_allowance" class="form-control" value="<?php echo $row['position_allowance'] ?>">
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">No. of Days work</label>
        </div>
        <div class="col-md-9">
            <input type="text" name="no_of_days" id="no_of_days" class="form-control" value="<?php echo $row['no_of_days'] ?>">
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-3">
            <label for="" class="form-label">Outlet</label>
        </div>
        <div class="col-md-9">
            <?php
            $outlet = $row['outlet'];
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
    <div class="modal-footer mt-5">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="add_renewal_request_individual_btn" class="btn btn-primary">Submit</button>
    </div>
</form>

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
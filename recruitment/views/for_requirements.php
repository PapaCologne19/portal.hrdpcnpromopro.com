<?php
session_start();
include '../../connect.php';
if(isset($_SESSION['username'], $_SESSION['password'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <title>For Requirements</title>
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
                            <div class="container table-responsive">
                                <hr>
                                <div class="title justify-content-center align-items-center mx-auto text-center">
                                    <h4 class="fs-4">
                                        FOR REQUIREMENTS
                                    </h4>
                                </div>
                                <hr>
                                <table class="table" style="width: 100%; font-size: 13px !important;" id="example">
                                    <thead>
                                        <tr>
                                            <th>Applicant ID</th>
                                            <th>Name</th>
                                            <th>SSS</th>
                                            <th>Pag-IBIG</th>
                                            <th>Philhealth</th>
                                            <th>TIN</th>
                                            <th>Birthday</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM employees WHERE ewb_status = 'DECLINED'";
                                        $result = $link->query($query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php echo $row['lastnameko'] . ", " . $row['firstnameko'] . " " . $row['mnko'] ?></td>
                                                <td><?php echo $row['sssnum'] ?></td>
                                                <td><?php echo $row['pagibignum'] ?></td>
                                                <td><?php echo $row['phnum'] ?></td>
                                                <td><?php echo $row['tinnum'] ?></td>
                                                <td><?php echo $row['birthday'] ?></td>
                                                <td><?php echo $row['ewb_reason'] ?></td>
                                                <td>
                                                    <div class="contain">
                                                        <div class="column">
                                                            <input type="hidden" name="for_reverification_id" class="for_reverification_id" id="for_reverification_id" value="<?php echo $row['id'] ?>" class="form-control">
                                                            <button type="button" name="for_reverification_btn" class="btn btn-primary btn-sm for_reverification_btn" id="for_reverification_btn" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="For verification"><i class="bi bi-send-check"></i></button>
                                                        </div>
                                                        <div class="column">
                                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#editMandatoriesModal-<?php echo $row['id'];?>">Edit</button>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                
                                                <!--Modal for editing Mandatories and Birthday of Employee-->
                                                <div class="modal fade" id="editMandatoriesModal-<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit</h1>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="container">
	<?php 
		$select_employee = "SELECT * FROM employees WHERE id = '" . $row['id'] . "'";
		$select_employee_result = $link->query($select_employee);
		while($select_employee_row = $select_employee_result->fetch_assoc()){
	?>
	<form action="action.php" method="post" class="form-group row">
		<input type="hidden" name="id_edit" value="<?php echo $row['id']; ?>">
		<div class="col-md-12">
			<label for="sss" class="form-label">SSS</label>
			<input type="text" maxlength="10" minlength="10" name="sss" id="sss" class="form-control" value="<?php echo $select_employee_row['sssnum'];?>">
		</div>
		<div class="col-md-12">
			<label for="pagibig" class="form-label">Pag-IBIG</label>
			<input type="text" maxlength="12" minlength="12" name="pagibig" id="pagibig" class="form-control"value="<?php echo $select_employee_row['pagibignum'];?>">
		</div>
		<div class="col-md-12">
			<label for="philhealth" class="form-label">PhilHealth</label>
			<input type="text" maxlength="12" minlength="12" name="philhealth" id="philhealth" class="form-control" value="<?php echo $select_employee_row['phnum'];?>">
		</div>
		<div class="col-md-12">
			<label for="tin" class="form-label">TIN</label>
			<input type="text" maxlength="12" minlength="12" name="tin" id="tin" class="form-control" value="<?php echo $select_employee_row['tinnum'];?>">
		</div>
		<div class="col-md-12">
			<label for="birthday" class="form-label">Birthday</label>
			<input type="text" name="birthday" id="birthdate" onchange="calculateAge()" class="form-control" value="<?php echo $select_employee_row['birthday'];?>">
		</div>
		<div class="col-md-12">
			<input type="hidden" name="age" id="age" class="form-control" value="<?php echo $select_employee_row['age'];?>">
		</div>

		<div class="col-md-12 mt-5">
			<button type="submit" class="btn btn-primary" name="updateMandatoriesBtn">Update</button>
		</div>
	</form>
	<?php } ?>
</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				
			</div>
		</div>
	</div>
</div>

                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
  <script>
	// FOR SSS
	document.addEventListener('DOMContentLoaded', function() {
		var sss = document.getElementById('sss');

		// Add an input event listener to the firstname input field
		sss.addEventListener('input', function() {
			// Get the current value of the input
			var inputValue = sss.value;

			// Remove any non-numeric characters using a regular expression
			var numericValue = inputValue.replace(/\D/g, '');

			// Update the input field with the numeric value
			sss.value = numericValue;
		});
	});

	// FOR PAGIBIG
	document.addEventListener('DOMContentLoaded', function() {
		var pagibig = document.getElementById('pagibig');

		// Add an input event listener to the firstname input field
		pagibig.addEventListener('input', function() {
			// Get the current value of the input
			var inputValue = pagibig.value;

			// Remove any non-numeric characters using a regular expression
			var numericValue = inputValue.replace(/\D/g, '');

			// Update the input field with the numeric value
			pagibig.value = numericValue;
		});
	});

	// FOR PHILHEALTH
	document.addEventListener('DOMContentLoaded', function() {
		var philhealth = document.getElementById('philhealth');

		// Add an input event listener to the firstname input field
		philhealth.addEventListener('input', function() {
			// Get the current value of the input
			var inputValue = philhealth.value;

			// Remove any non-numeric characters using a regular expression
			var numericValue = inputValue.replace(/\D/g, '');

			// Update the input field with the numeric value
			philhealth.value = numericValue;
		});
	});

	// FOR TIN
	document.addEventListener('DOMContentLoaded', function() {
		var tin = document.getElementById('tin');

		// Add an input event listener to the firstname input field
		tin.addEventListener('input', function() {
			// Get the current value of the input
			var inputValue = tin.value;

			// Remove any non-numeric characters using a regular expression
			var numericValue = inputValue.replace(/\D/g, '');

			// Update the input field with the numeric value
			tin.value = numericValue;
		});
	});
	
	$('#birthdate')
                    .datetimepicker({
                        format: 'm/d/Y',
                        useCurrent: false,
                        placeholder: 'Select a date',
                        timepicker: false,
                        mask: true
                    });
</script>


    <?php include '../components/footer.php'; ?>
</body>

</html>
<?php 
}
else{
    header("Location: ../../index.php");
    session_destroy();
    exit(0);
}
?>
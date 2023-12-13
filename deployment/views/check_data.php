<?php

require '../../connect.php';

$emp_id = $_POST['emp_id'];
$query = "SELECT * FROM deployment WHERE emp_id = '$emp_id'";
$result = mysqli_query($link, $query);

// Check if there are any rows returned
if ($result->num_rows > 0) {
    // Data already exists
    echo '<span style="color: red;">ID is already exists!</span>';
} else {
    // Data is available
    echo '<span style="color: green;">ID is available!</span>';
}

// Close the database connection
mysqli_close($link);
?>

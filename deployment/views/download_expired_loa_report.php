
<?php
include "../../connect.php";
session_start();

date_default_timezone_set('Asia/Hong_Kong');
$date = date('D : F d, Y');

$dtnow = date("m/d/Y");
$output = '';

$from = mysqli_real_escape_string($link, $_GET['expired_date']);
$project_title = mysqli_real_escape_string($link, $_GET['project_title']);

$query = "SELECT deployment.*, employee.*,
DATE_FORMAT(deployment.date_created, '%M %d, %Y') AS date_created 
FROM deployment deployment, employees employee
WHERE employee.id = deployment.employee_id 
AND deployment.is_deleted = '0'
AND ('ACTIVE' = '' OR clearance = 'ACTIVE') 
AND ('$project_title' = '' OR shortlist_title = '$project_title') 
AND ('$from' <> '' AND loa_end_date <= '$from')";

$result = mysqli_query($link, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '
   <table class="table" bordered="1">  
                    
    <tr>  Employee Database</tr>
    <tr>as of : ' . $dtnow . ' </tr>   
    <tr>Expired : ' . $from . ' </tr> 
    <tr>
                <th> Date Created </th>
                <th> Type </th>
                <th> Category </th>
                <th> Employee Name </th>
                <th> Project Title</th>
                <th> Start Date </th>
                <th> End Date </th>
                <th> Employment Status </th>
                <th> Rate </th>
                <th> Communication Allowance </th>
                <th> Transportation Allowance </th>
                <th> Internet Allowance </th>
                <th> Meal Allowance </th>
                <th> Outbase Allowance </th>
                <th> Special Allowance </th>
                <th> Position Allowance </th>
                <th> Deployment Remarks </th>
                <th> Status </th>
                <th>Signed LOA Status</th>
                <th> LOA Status </th>
            </tr>';
    while ($row = mysqli_fetch_assoc($result)) {

        $output .= '
   
    <tr> 
        <td> ' . $row['date_created'] . '   </td> 
        <td> ' . $row['type'] . '   </td>        
        <td> ' . $row['category'] . '   </td>        
        <td> ' . $row['lastnameko'] . ", " . $row['firstnameko'] . " " . $row['mnko'] . " " . $row['extnname']. '   </td> 
        <td> ' . $row['shortlist_title'] . '   </td>        
        <td> ' . $row['loa_start_date'] . '   </td>        
        <td> ' . $row['loa_end_date'] . '   </td>        
        <td> ' . $row['employment_status'] . '   </td>        
        <td> ' . $row['basic_salary'] . '   </td>        
        <td> ' . $row['communication_allowance'] . '   </td>        
        <td> ' . $row['transportation_allowance'] . '   </td>        
        <td> ' . $row['internet_allowance'] . '   </td>        
        <td> ' . $row['meal_allowance'] . '   </td>       
        <td> ' . $row['outbase_meal'] . '   </td>       
        <td> ' . $row['special_allowance'] . '   </td>   
        <td> ' . $row['position_allowance'] . '   </td>   
        <td> ' . $row['deployment_remarks'] . '   </td>  
        <td> ' . $row['clearance'] . '   </td>   
        <td> ' . $row['signed_loa_status'] . '   </td> 
        <td> EXPIRED   </td>
    </tr>';
    }
    $output .= '</table>';
    header('Content-Type: application/xls');

    $fname = "HRdatabase_" . $dtnow . ".xls";
    header("Content-Disposition: attachment; filename=$fname");
    echo $output;
}
?>

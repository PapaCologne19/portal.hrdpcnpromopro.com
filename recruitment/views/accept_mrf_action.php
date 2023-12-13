<?php
error_reporting(E_ALL);
    ini_set('display_errors', 1);
session_start();
include '../../connect.php';
    
date_default_timezone_set('Asia/Manila');
$date_now = date('Y-m-d H:i:s');
header('Content-Type: text/html; charset=utf-8');

$user_id = $_SESSION['user_id'];
$user_division = $_SESSION['division'];
$personnel = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$user_type = $_SESSION['user_type'];

if (isset($_POST['acceptMRF_button_click'])) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $mrf_val1 = $_POST['acceptMRF_ID'];

    $query = "UPDATE mrf SET hr_personnel = 'YES', is_approve = '1' WHERE id = '$mrf_val1'";
    $result = mysqli_query($link, $query);

    if ($result) {
        $query_select = "SELECT * FROM mrf WHERE id = '$mrf_val1'";
        $query_result = $link->query($query_select);
        if($query_result){
            while ($query_row = $query_result->fetch_assoc()) {
                
                $tracking_no = $query_row['tracking'];
                $project_title = $query_row['project_title'];
                $client = $query_row['client'];
                $total = $query_row['np_male'] + $query_row['np_female'];
                $work_duration_start = $query_row['work_duration_start'];
                $work_duration_end = $query_row['work_duration_end'];
                $status = "1";
    
                $insert_db = "INSERT INTO projects (mrf_id, mrf_tracking, project_title, client_company_id, ewb_count, start_date, end_date, status) 
                VALUES ('$mrf_val1', '$tracking_no', '$project_title', '$client', '$total', '$work_duration_start', '$work_duration_end', '$status')";
                $result_insert = $link->query($insert_db);
                if ($result_insert) {
    
                    $transaction = "ACCEPT MRF - " . $mrf_val1;
                    $transaction_log  = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
                    $transaction_log_result = $link->prepare($transaction_log);
                    $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
                    $transaction_log_result->execute();
    
                    $_SESSION['successMessage'] = "Success!";
                } else {
                    error_log("Database Error: " . $link->error);
                    $_SESSION['errorMessage'] = "Error" . $link->error;
                }
            }
        } else {
            error_log("Database Error: " . $link->error);
            $_SESSION['errorMessage'] = "Error" . $link->error;
        }
    } else {
        error_log("Database Error: " . $link->error);
        $_SESSION['errorMessage'] = "Error" . $link->error;
    }

    header("Location: accept_mrf.php");
    exit(0);
}
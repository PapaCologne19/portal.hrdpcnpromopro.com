<?php
session_start();
include '../../connect.php';
date_default_timezone_set('Asia/Manila');
$date = date('Y-m-d H:i:s');
$date_now = date('Y-m-d H:i:s');

$user_id = $_SESSION['user_id'];
$user_division = $_SESSION['division'];
$personnel = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
$user_type = $_SESSION['user_type'];


function insert_value($data)
{
  // Replace with your Google Apps Script web app URL
  $script_url = 'https://script.google.com/macros/s/AKfycbzk0YJ2zrDLa1wmKrfNFHlxGHExpXXUMMb2HyN4-Bx0ihwCCLzj7CDvqpGC-fyzwwmx/exec?fbclid=IwAR3OT4py-AxMoyEdpYyyIiaZIoS5uf024P34Jx0nU2aUidjohl4aBOV25OU';

  // Append the data to the URL as query parameters
  $url = $script_url . '&' . http_build_query($data) . "&action=insert";

  // Create cURL session
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Execute cURL session
  $response = curl_exec($ch);
  $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

  // Check for errors
  if ($httpCode == 200) {
    $json_response = json_decode($response, true);
    if ($json_response && isset($json_response['status']) && isset($json_response['message'])) {
      if ($json_response['status'] === 'success') {
        $_SESSION['successMessage'] = $json_response['message'];
      } else {
        $_SESSION['errorMessage'] = 'Failed to insert data. Error: ' . $json_response['message'];
      }
    } else {
      $_SESSION['errorMessage'] = 'Invalid JSON response from the server.';
    }
  } else {
    $_SESSION['errorMessage'] = "Error: {$httpCode}, {$response}";
  }

  // Close cURL session
  curl_close($ch);
}

// For creating LOA of Applicants
if (isset($_POST['create_loa'])) {


  $id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['id'])));
  $request_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['request_id'])));
  $project_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['project_id'])));
  $employee_app_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['employee_app_id'])));
  $shortlist_title = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['shortlist_title'])));
  $appno = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['appno'])));
  $date_shortlisted = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['date_shortlisted'])));
  $status = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['status'])));
  $type = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['type'])));
  $project_start_date = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['start_loa'])));
  $start_loa = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['start_loa'])));
  $start_loa_date = new DateTime($start_loa);
  $start_loa_formatted = $start_loa_date->format('F j, Y');
  $end_loa = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['end_loa'])));
  $end_loa_date = new DateTime($end_loa);
  $end_loa_formatted = $end_loa_date->format('F j, Y');
  $division = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['division'])));
  $category = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['category'])));
  $locator = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['locator'])));
  $client_name = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['client_name'])));
  $place_assigned = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['place_assigned'])));
  $address_assigned = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['address_assigned'])));
  $channel = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['channel'])));
  $department = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['department'])));
  $employment_status = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['employment_status'])));
  $job_title = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['job_title'])));
  $loa_template = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['loa_template'])));
  $basic_salary = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['basic_salary'])));
  $ecola = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['ecola'])));
  $communication_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['communication_allowance'])));
  $transportation_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['transportation_allowance'])));
  $internet_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['internet_allowance'])));
  $meal_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['meal_allowance'])));
  $outbase_meal = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['outbase_meal'])));
  $special_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['special_allowance'])));
  $position_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['position_allowance'])));
  $deployment_remarks = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_remarks'])));
  $no_of_days = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['no_of_days'])));
  $outlet = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['outlet'])));
  $supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['supervisor'])));
  $field_supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['field_supervisor'])));
  $field_supervisor_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['field_supervisor_designation'])));
  $deployment_personnel = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_personnel'])));
  $deployment_personnel_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_personnel_designation'])));
  $project_supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['project_supervisor'])));
  $project_supervisor_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['project_supervisor_designation'])));
  $head = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['head'])));
  $head_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['head_designation'])));
  $loa_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['loa_id'])));

  $check_id = "SELECT * FROM deployment WHERE emp_id = '$loa_id'";
  $check_id_result = $link->query($check_id);
  $check_id_row = $check_id_result->fetch_assoc();

  if ($loa_id !== $check_id_row['emp_id']) {
    $get_data = "SELECT * FROM employees WHERE id = '$id'";
    $get_result = $link->query($get_data);
    $get_row = $get_result->fetch_assoc();
    if (!empty($get_row['mnko']) || $get_row['mnko'] != "NA" || $get_row['mnko'] != "N/A") {
      $fullname = chop($get_row['firstnameko'] . ", " . $get_row['mnko'] . " " . $get_row['lastnameko'] . " " . $get_row['extnname']);
    } else {
      $fullname = chop($get_row['firstnameko'] . ", " . $get_row['lastnameko']);
    }
    $sss = $get_row['sssnum'];
    $pagibig = $get_row['pagibignum'];
    $philhealth = $get_row['phnum'];
    $tin = $get_row['tinnum'];
    $address = $get_row['paddress'];
    $contact_number = $get_row['cpnum'];

    $select = "SELECT * FROM employees WHERE id = '$id'";
    $select_result = $link->query($select);
    $select_row = $select_result->fetch_assoc();
    $applicant_id = $select_row['app_id'];

    $applicant_name = chop($select_row['firstnameko'] . " " . $select_row['mnko'] . " " . $select_row['lastnameko'] . " " . $select_row['extnname']);
    $folder_name = $applicant_name;
    $applicant_name_subfolder = $applicant_name . "- From " . $start_loa_formatted . " To " . $end_loa_formatted;
    $folder_name_subfolder = $applicant_name_subfolder;
    $destination_subfolder = "../../../jobs.hrdpcnpromopro.com/201 Files/" . $folder_name . "/" . $folder_name_subfolder;
    $folder_path = "201 Files/" . $applicant_name . "/" . $applicant_name_subfolder;

    mkdir("{$destination_subfolder}", 0777);


    $query = "INSERT INTO `deployment`(`shortlist_title`, `appno`, `date_shortlisted`, `employee_id`, `app_id`,
            `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
            `contact_number`, `loa_status`, `type`, `project_start_date`, `loa_start_date`, 
            `loa_end_date`, `division`, `category`, `locator`, `client_name`,
            `place_assigned`, `address_assigned`, `channel`, `department`, 
            `employment_status`, `job_title`, `loa_template`, 
            `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
            `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
            `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
            `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
            `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
            `head`, `head_designation`, `loa_folder_path`, `emp_id`) 
            VALUES ('$shortlist_title', '$appno', '$date_shortlisted', '$id', '$employee_app_id',
            '$sss', '$philhealth', '$pagibig', '$tin','$address', 
            '$contact_number','$status', '$type', '$project_start_date', '$start_loa', 
            '$end_loa', '$division', '$category', '$locator', '$client_name',
            '$place_assigned', '$address_assigned', '$channel', '$department', 
            '$employment_status', '$job_title', '$loa_template', 
            '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
            '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
            '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
            '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
            '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
            '$head', '$head_designation', '$destination_subfolder', '$loa_id')";

    $result = $link->query($query);

    if ($result) {

      $deployment_id = $link->insert_id;

      $insert_folder = "INSERT INTO folder (applicant_id, employee_id, deployment_id, folder_name, folder_path) 
            VALUES('$applicant_id', '$id', '$deployment_id', '$folder_name_subfolder', '$folder_path')";
      $insert_folder_result = $link->query($insert_folder);
      if ($insert_folder_result) {



        $query_history = "INSERT INTO `deployment_history`(`deployment_id`, `shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, 
            `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
            `contact_number`, `loa_status`, `type`, `loa_start_date`, 
            `loa_end_date`, `division`, `category`, `locator`, `client_name`,
            `place_assigned`, `address_assigned`, `channel`, `department`, 
            `employment_status`, `job_title`, `loa_template`, 
            `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
            `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
            `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
            `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
            `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
            `head`, `head_designation`, `emp_id`) 
            VALUES ('$deployment_id' ,'$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$id', 
            '$sss', '$philhealth', '$pagibig', '$tin','$address', 
            '$contact_number','$status', '$type', '$start_loa', 
            '$end_loa', '$division', '$category', '$locator', '$client_name',
            '$place_assigned', '$address_assigned', '$channel', '$department', 
            '$employment_status', '$job_title', '$loa_template', 
            '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
            '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
            '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
            '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
            '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
            '$head', '$head_designation', '$loa_id')";

        $result_history = $link->query($query_history);

        if ($result_history) {
          $update_shortlist_query = "UPDATE shortlist_master SET deployment_status = 'DEPLOYED' WHERE employee_id = '$id' AND shortlistnameto = '$shortlist_title'";
          $update_shortlist_result = $link->query($update_shortlist_query);
          if ($update_shortlist_result) {
            $update = "UPDATE shortlist_master SET is_deleted = '1' WHERE employee_id = '$id' AND shortlistnameto != '$shortlist_title'";
            $update_result = $link->query($update);
            if ($update_result) {
              $update_request_status = "UPDATE loa_requests SET request_status = 'DEPLOYED' WHERE id = '$request_id'";
              $update_request_status_result = $link->query($update_request_status);

              if ($update_request_status_result) {
                $transaction = chop(strtoupper("DEPLOYED EMPLOYEE AND CREATE LOA FOR - " . $fullname));
                $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
                $transaction_log_result = $link->prepare($transaction_log);
                $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
                $transaction_log_result->execute();

                $queryall = "SELECT * FROM deployment WHERE id = '$deployment_id'";
                $resultall = $link->query($queryall);
                while ($rowall = $resultall->fetch_assoc()) {
                  $employee_id = $rowall['employee_id'];
                  $select_employee = "SELECT * FROM employees WHERE id = '$employee_id'";
                  $select_result = $link->query($select_employee);
                  $select_row = $select_result->fetch_assoc();

                  $employee_name = $select_row['firstnameko'] . " " . $select_row['mnko'] . " " . $select_row['lastnameko'] . " " . $select_row['extnname'];
                  $outlet = $rowall['outlet'];
                  $concatenatedText = '';

                  if (!empty($outlet)) {
                    $data = json_decode($outlet, true);
                    if (!empty($data['ops'])) {
                      foreach ($data['ops'] as $op) {
                        if (isset($op['insert'])) {
                          $text = trim($op['insert']);
                          if (!empty($text)) {
                            $concatenatedText .= $text . ', ';
                          }
                        }
                      }

                      // Remove the trailing comma and space
                      $concatenatedText = rtrim($concatenatedText, ', ');
                    }
                  }
                  $data = [
                    'id1' => $rowall['id'],
                    'shortlist_title1' => $rowall['shortlist_title'],
                    'appno1' => $rowall['appno'],
                    'date_shortlisted1' => $rowall['date_shortlisted'],
                    'app_id1' => $rowall['app_id'],
                    'employee_id1' => $rowall['employee_id'],
                    'employee_name1' => $employee_name,
                    'sss1' => $rowall['sss'],
                    'philhealth1' => $rowall['philhealth'],
                    'pagibig1' => $rowall['pagibig'],
                    'tin1' => $rowall['tin'],
                    'address1' => $rowall['address'],
                    'contact_number1' => $rowall['contact_number'],
                    'loa_status1' => $rowall['loa_status'],
                    'type1' => $rowall['type'],
                    'project_start_date1' => $rowall['project_start_date'],
                    'loa_start_date1' => $rowall['loa_start_date'],
                    'loa_end_date1' => $rowall['loa_end_date'],
                    'division1' => $rowall['division'],
                    'category1' => $rowall['category'],
                    'locator1' => $rowall['locator'],
                    'client_name1' => $rowall['client_name'],
                    'place_assigned1' => $rowall['place_assigned'],
                    'address_assigned1' => $rowall['address_assigned'],
                    'channel1' => $rowall['channel'],
                    'department1' => $rowall['department'],
                    'employment_status1' => $rowall['employment_status'],
                    'job_title1' => $rowall['job_title'],
                    'loa_template1' => $rowall['loa_template'],
                    'remarks_2011' => $rowall['201_remarks'],
                    'basic_salary1' => $rowall['basic_salary'],
                    'ecola1' => $rowall['ecola'],
                    'communication_allowance1' => $rowall['communication_allowance'],
                    'transportation_allowance1' => $rowall['transportation_allowance'],
                    'internet_allowance1' => $rowall['internet_allowance'],
                    'meal_allowance1' => $rowall['meal_allowance'],
                    'outbase_meal1' => $rowall['outbase_meal'],
                    'special_allowance1' => $rowall['special_allowance'],
                    'position_allowance1' => $rowall['position_allowance'],
                    'deployment_remarks1' => $rowall['deployment_remarks'],
                    'no_of_days1' => $rowall['no_of_days'],
                    'outlet1' => $concatenatedText,
                    'supervisor1' => $rowall['supervisor'],
                    'field_supervisor1' => $rowall['field_supervisor'],
                    'field_designation1' => $rowall['field_designation'],
                    'deployment_personnel1' => $rowall['deployment_personnel'],
                    'deployment_designation1' => $rowall['deployment_designation'],
                    'project_supervisor1' => $rowall['project_supervisor'],
                    'projectSupervisor_deployment1' => $rowall['projectSupervisor_deployment'],
                    'head1' => $rowall['head'],
                    'head_designation1' => $rowall['head_designation'],
                    'emp_id1' => $rowall['emp_id'],
                    'clearance1' => $rowall['clearance'],
                    'loa_folder_path1' => $rowall['loa_folder_path'],
                    'signed_loa_file1' => $rowall['signed_loa_file'],
                    'signed_loa_status1' => $rowall['signed_loa_status'],
                    'signed_loa_approved_by1' => $rowall['signed_loa_approved_by'],
                    'id_remarks1' => $rowall['id_remarks'],
                    'date_created1' => $rowall['date_created'],
                    'date_return1' => $rowall['date_return'],
                    'is_deleted1' => $rowall['is_deleted']
                  ];

                  insert_value($data);
                  $_SESSION['successMessage'] = "Success";
                }
              } else {
                $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
              }
            } else {
              $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
            }
          } else {
            $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
          }
        } else {
          $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
        }
      } else {
        $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
      }
    } else {
      $_SESSION['errorMessage'] = "SQL Error: " . $link->error;
    }
  } else {
    $_SESSION['errorMessage'] = "ID number is already exist";
  }


  header("Location: deploy_applicants.php?shortlist_title=$shortlist_title");
  exit(0);
}


// For Updating LOA
if (isset($_POST['update_loa'])) {
  $id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['id'])));
  $emp_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['emp_id'])));
  $shortlist_title = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['shortlist_title'])));
  $appno = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['appno'])));
  $date_shortlisted = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['date_shortlisted'])));
  $status = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['status'])));
  $type = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['type'])));
  $start_loa = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['start_loa'])));
  $start_loa_date = new DateTime($start_loa);
  $start_loa_formatted = $start_loa_date->format('F j, Y');
  $end_loa = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['end_loa'])));
  $end_loa_date = new DateTime($end_loa);
  $end_loa_formatted = $end_loa_date->format('F j, Y');
  $division = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['division'])));
  $category = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['category'])));
  $locator = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['locator'])));
  $client_name = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['client_name'])));
  $place_assigned = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['place_assigned'])));
  $address_assigned = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['address_assigned'])));
  $channel = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['channel'])));
  $department = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['department'])));
  $employment_status = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['employment_status'])));
  $job_title = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['job_title'])));
  $loa_template = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['loa_template'])));
  $basic_salary = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['basic_salary'])));
  $ecola = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['ecola'])));
  $communication_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['communication_allowance'])));
  $transportation_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['transportation_allowance'])));
  $internet_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['internet_allowance'])));
  $meal_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['meal_allowance'])));
  $outbase_meal = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['outbase_meal'])));
  $special_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['special_allowance'])));
  $position_allowance = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['position_allowance'])));
  $deployment_remarks = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_remarks'])));
  $no_of_days = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['no_of_days'])));
  $outlet = mysqli_real_escape_string($link, $_POST['outlet']);
  $supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['supervisor'])));
  $field_supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['field_supervisor'])));
  $field_supervisor_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['field_supervisor_designation'])));
  $deployment_personnel = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_personnel'])));
  $deployment_personnel_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['deployment_personnel_designation'])));
  $project_supervisor = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['project_supervisor'])));
  $project_supervisor_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['project_supervisor_designation'])));
  $head = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['head'])));
  $head_designation = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['head_designation'])));
  $loa_id = mysqli_real_escape_string($link, preg_replace('/\s+/', ' ', ($_POST['loa_id'])));

  $get_data = "SELECT * FROM employees WHERE id = '$emp_id'";
  $get_result = $link->query($get_data);
  $get_row = $get_result->fetch_assoc();
  if (!empty($get_row['mnko']) || $get_row['mnko'] != "NA" || $get_row['mnko'] != "N/A") {
    $fullname = $get_row['lastnameko'] . ", " . $get_row['firstnameko'] . " " . $get_row['mnko'];
  } else {
    $fullname = $get_row['lastnameko'] . ", " . $get_row['firstnameko'];
  }
  $sss = $get_row['sssnum'];
  $pagibig = $get_row['pagibignum'];
  $philhealth = $get_row['phnum'];
  $tin = $get_row['tinnum'];
  $address = $get_row['paddress'];
  $contact_number = $get_row['cpnum'];

  $select = "SELECT * FROM employees WHERE id = '$emp_id'";
  $select_result = $link->query($select);
  $select_row = $select_result->fetch_assoc();
  $applicant_id = $select_row['app_id'];

  $applicant_name = chop($select_row['firstnameko'] . " " . $select_row['mnko'] . " " . $select_row['lastnameko'] . " " . $select_row['extnname']);
  $folder_name = $applicant_name;
  $applicant_name_subfolder = $applicant_name . "- From " . $start_loa_formatted . " To " . $end_loa_formatted;
  $folder_name_subfolder = $applicant_name_subfolder;
  $destination_subfolder = "../../../jobs.hrdpcnpromopro.com/201 Files/" . $folder_name . "/" . $folder_name_subfolder;
  $folder_path = "201 Files/" . $applicant_name . "/" . $applicant_name_subfolder;

  mkdir("{$destination_subfolder}", 0777);

  $query = "UPDATE `deployment` 
          SET `shortlist_title` = '$shortlist_title',
              `appno` = '$appno',
              `date_shortlisted` = '$date_shortlisted',
              `sss` = '$sss',
              `philhealth` = '$philhealth',
              `pagibig` = '$pagibig',
              `tin` = '$tin',
              `address` = '$address',
              `contact_number` = '$contact_number',
              `loa_status` = '$status',
              `type` = '$type',
              `loa_start_date` = '$start_loa',
              `loa_end_date` = '$end_loa',
              `division` = '$division',
              `category` = '$category',
              `locator` = '$locator',
              `client_name` = '$client_name',
              `place_assigned` = '$place_assigned',
              `address_assigned` = '$address_assigned',
              `channel` = '$channel',
              `department` = '$department',
              `employment_status` = '$employment_status',
              `job_title` = '$job_title',
              `loa_template` = '$loa_template',
              `basic_salary` = '$basic_salary',
              `ecola` = '$ecola',
              `communication_allowance` = '$communication_allowance',
              `transportation_allowance` = '$transportation_allowance',
              `internet_allowance` = '$internet_allowance',
              `meal_allowance` = '$meal_allowance',
              `outbase_meal` = '$outbase_meal',
              `special_allowance` = '$special_allowance',
              `position_allowance` = '$position_allowance',
              `deployment_remarks` = '$deployment_remarks',
              `no_of_days` = '$no_of_days',
              `outlet` = '$outlet',
              `supervisor` = '$supervisor',
              `field_supervisor` = '$field_supervisor',
              `field_designation` = '$field_supervisor_designation',
              `deployment_personnel` = '$deployment_personnel',
              `deployment_designation` = '$deployment_personnel_designation',
              `project_supervisor` = '$project_supervisor',
              `projectSupervisor_deployment` = '$project_supervisor_designation',
              `head` = '$head',
              `head_designation` = '$head_designation',
              `signed_loa_status` = 'UNRETURN',
              `signed_loa_file` = ''
          WHERE `id` = '$id'";
  $result = $link->query($query);

  if ($result) {


    $insert_folder = "INSERT INTO folder (applicant_id, employee_id, deployment_id, folder_name, folder_path) 
        VALUES('$applicant_id', '$emp_id', '$id', '$folder_name_subfolder', '$folder_path')";
    $insert_folder_result = $link->query($insert_folder);


    $query_history = "INSERT INTO `deployment_history`(`shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, `deployment_id`,
            `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
            `contact_number`, `loa_status`, `type`, `loa_start_date`, 
            `loa_end_date`, `division`, `category`, `locator`, `client_name`,
            `place_assigned`, `address_assigned`, `channel`, `department`, 
            `employment_status`, `job_title`, `loa_template`, 
            `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
            `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
            `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
            `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
            `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
            `head`, `head_designation`, `emp_id`, `date_updated`) 
            VALUES ('$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$emp_id', '$id',
            '$sss', '$philhealth', '$pagibig', '$tin','$address', 
            '$contact_number','$status', '$type', '$start_loa', 
            '$end_loa', '$division', '$category', '$locator', '$client_name',
            '$place_assigned', '$address_assigned', '$channel', '$department', 
            '$employment_status', '$job_title', '$loa_template', 
            '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
            '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
            '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
            '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
            '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
            '$head', '$head_designation', '$loa_id', '$date')";

    $result_history = $link->query($query_history);

    if ($result_history) {

      $transaction = chop(strtoupper("UPDATE LOA OF - " . $fullname));
      $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                VALUES (?, ?, ?, ?, ?)";
      $transaction_log_result = $link->prepare($transaction_log);
      $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
      $transaction_log_result->execute();

      $_SESSION['successMessage'] = "Success";
    } else {
      $_SESSION['errorMessage'] = "Error in inserting LOA to history";
    }
  } else {
    $_SESSION['errorMessage'] = "Updating LOA error";
  }
  header("Location: deploy_applicants.php?shortlist_title=$shortlist_title");
  exit(0);
}

// FOR INSERTING SEPARATION
if (isset($_POST['insert_typeBtn'])) {
  $deployment_id = $_POST['deployment_id'];
  $employee_id = $_POST['employee_id'];
  $category = $_POST['category'];
  $position = $_POST['position'];
  $project_title = $_POST['project_title'];
  $employee_status = $_POST['employee_status'];
  $start_date = $_POST['start_date'];
  $outlet = $_POST['outlet'];
  $reason_of_separation = $_POST['reason_of_separation'];
  $date_created = $_POST['date_created'];
  $name = $_POST['name'];
  $type_of_separations = $_POST['type_of_separations'];
  $effectivity_date = $_POST['effectivity_date'];
  $process_by = $_POST['process_by'];

  if (!empty($_FILES['files']['name'][0])) {
    $fileCount = count($_FILES['files']['name']);
    $fileNames = [];
    $files = $_FILES['files'];

    // Selecting Employees table so we can fetch the Applicant ID
    $select = "SELECT * FROM employees WHERE id = '$employee_id'";
    $select_result = $link->query($select);
    if ($select_result) {

      $select_row = $select_result->fetch_assoc();
      $applicant_id = $select_row['app_id'];

      $select_deployment = "SELECT * FROM deployment WHERE id = '$deployment_id' AND employee_id = '$employee_id'";
      $select_deployment_result = $link->query($select_deployment);
      $selected_deployment_row = $select_deployment_result->fetch_assoc();
      $start_loa = $selected_deployment_row['loa_start_date'];
      $end_loa = $selected_deployment_row['loa_end_date'];
      $start_loa_date = new DateTime($start_loa);
      $start_loa_formatted = $start_loa_date->format('F j, Y');
      $end_loa_date = new DateTime($end_loa);
      $end_loa_formatted = $end_loa_date->format('F j, Y');

      $applicant_name = chop($select_row['firstnameko'] . " " . $select_row['mnko'] . " " . $select_row['lastnameko'] . " " . $select_row['extnname']);
      $folder_name = $applicant_name;
      $applicant_name_subfolder = $applicant_name . "- From " . $start_loa_formatted . " To " . $end_loa_formatted;
      $folder_name_subfolder = $applicant_name_subfolder;
      $destination_subfolder = "../../../jobs.hrdpcnpromopro.com/201 Files/" . $folder_name . "/" . $folder_name_subfolder . "/";
      $folder_path = "201 Files/" . $applicant_name . "/" . $applicant_name_subfolder;

      // Selecting Folder table so we can fetch the datas in that table
      $select_folder = "SELECT * FROM folder WHERE applicant_id = '$applicant_id' AND employee_id = '$employee_id' AND folder_name = '$folder_name_subfolder'";
      $stmt2 = $link->query($select_folder);
      if ($stmt2) {
        while ($rows = $stmt2->fetch_assoc()) {

          for ($i = 0; $i < count($_FILES['files']['name']); $i++) {
            $filename = $_FILES['files']['name'][$i];
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'gif'];

            // Check if file type is valid
            if (in_array($ext, $allowed)) {
              $newFilename = $filename;
              move_uploaded_file($_FILES['files']['tmp_name'][$i], $destination_subfolder . $filename);

              $fileNames[] = $newFilename;
            } else {
              $_SESSION['errorMessage'] = "Error";
            }
          }

          $fileNamesStr = implode(',', $fileNames);
          $get_loa_requestedBy = "SELECT deployment.*, loa_requested.*, employee.*
                        FROM deployment deployment, loa_requests loa_requested, employees employee
                        WHERE employee.id = loa_requested.employee_id
                        AND employee.id = deployment.employee_id 
                        AND deployment.employee_id = loa_requested.employee_id
                        AND deployment.shortlist_title = loa_requested.place_assigned 
                        AND loa_requested.employee_id = '$employee_id'";
          $get_loa_requested_by_result = $link->query($get_loa_requestedBy);
          $get_loa_requested_by_row = $get_loa_requested_by_result->fetch_assoc();

          $loa_requested_by = $get_loa_requested_by_row['requested_by'];
          $shortlist_title = $get_loa_requested_by_row['place_assigned'];


          $update_clearance = "UPDATE deployment SET clearance = ? WHERE id = ?";
          $update_clearance_result = $link->prepare($update_clearance);
          $update_clearance_result->bind_param('si', $type_of_separations, $deployment_id);
          if ($update_clearance_result->execute()) {

            $path = "../../../jobs.hrdpcnpromopro.com/" . $rows['folder_path'] . "/";
            $folder_id = $rows['id'];

            $targetFile = $path . basename($files['name'][$key]);
            $filename = basename($files['name'][$key]);

            $inserts = "INSERT INTO 201files(applicant_id, employee_id, folder_id, requirements_files) 
                                VALUES (?, ?, ?, ?)";
            $insert_result = $link->prepare($inserts);
            $insert_result->bind_param("ssss", $applicant_id, $employee_id, $folder_id, $filename);


            if ($insert_result->execute()) {
              $insert_type = "INSERT INTO separation (deployment_id, employee_id, employee_name, category, position, project_title, employment_status, date_start, outlet, type_of_separation, reason, files, effectivity_date, process_by, loa_request_by) 
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
              $stmt = $link->prepare($insert_type);
              $stmt->bind_param("iisssssssssssss", $deployment_id, $employee_id, $name, $category, $position, $project_title, $employee_status, $start_date, $outlet, $type_of_separations, $reason_of_separation, $fileNamesStr, $effectivity_date, $process_by, $loa_requested_by);

              if ($stmt->execute()) {
                $update_clearance = "UPDATE deployment_history SET clearance = ?, date_separation = ?, prepared_by_separation = ? WHERE deployment_id = ? AND employee_id = ?";
                $update_clearance_result = $link->prepare($update_clearance);
                $update_clearance_result->bind_param("sssii", $type_of_separations, $datenow, $process_by, $deployment_id, $employee_id);
                $update_clearance_result->execute();


                $transaction = chop(strtoupper("SET TYPE OF SEPARATION - " . $employee_id . " (" . $type_of_separations . ")"));
                $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                VALUES (?, ?, ?, ?, ?)";
                $transaction_log_result = $link->prepare($transaction_log);
                $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
                $transaction_log_result->execute();


                move_uploaded_file($tmp_name, $targetFile);
                $_SESSION['successMessage'] = "Success";
              } else {
                $_SESSION['errorMessage'] = "Error" . $link->error;
              }
            } else {
              $_SESSION['errorMessage'] = "Error" . $link->error;
            }
          } else {
            $_SESSION['errorMessage'] = "Error" . $link->error;
          }
        }
      } else {
        $_SESSION['errorMessage'] = "Error" . $link->error;
      }
    } else {
      $_SESSION['errorMessage'] = "Error" . $link->error;
    }
  } else {
    $_SESSION['errorMessage'] = "Error";
  }

  header("Location: deploy_applicants.php?shortlist_title=$shortlist_title");
}


// For Backout Employee
if (isset($_POST['backout_employee_deployment_button_click'])) {
  $deployment_id = $_POST['backout_id'];
  $project_title = $_POST['project_title'];
  $backout = "BACKOUT";
  $is_deleted = "1";

  $query = "UPDATE deployment SET clearance = ?, is_deleted = ? WHERE id = ?";
  $stmt = $link->prepare($query);
  $stmt->bind_param("ssi", $backout, $is_deleted, $deployment_id);
  if ($stmt->execute()) {
    $sql = "UPDATE deployment_history SET clearance = ? WHERE deployment_id = ?";
    $sql_result = $link->prepare($sql);
    $sql_result->bind_param("si", $backout, $deployment_id);
    if ($sql_result->execute()) {

      $transaction = chop(strtoupper("SET TYPE OF SEPARATION - " . "(" . $backout . ")"));
      $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                VALUES (?, ?, ?, ?, ?)";
      $transaction_log_result = $link->prepare($transaction_log);
      $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
      $transaction_log_result->execute();

      $_SESSION['successMessage'] = "Success";
    } else {
      $_SESSION['errorMessage'] = "Error";
    }
  } else {
    $_SESSION['errorMessage'] = "Error";
  }
  header("Location: deploy_applicants.php?shortlist_title=$project_title");
  exit(0);
}

// For Adding Folders: update_applicants.php > 201 Files section
if (isset($_POST['create_folder_btn'])) {
  $employee_id = $_POST['employee_id'];
  $folder_name_subfolder = $_POST['folder_name'];

  // Selecting Employees table so we can fetch the Applicant ID
  $select = "SELECT * FROM employees WHERE id = '$employee_id'";
  $select_result = $link->query($select);

  $select_row = $select_result->fetch_assoc();
  $applicant_id = $select_row['app_id'];
  $firstname = $select_row['firstnameko'];
  $middlename = $select_row['mnko'];
  $lastname = $select_row['lastnameko'];
  $extension_name = $select_row['extnname'];

  $applicant_name = chop($firstname . " " . $middlename . " " . $lastname . " " . $extension_name);
  $folder_name = $applicant_name;
  $destination = "../../../jobs.hrdpcnpromopro.com/201 Files/" . $folder_name;

  $applicant_names = $firstname . " " . $lastname;
  $destination_subfolder = "../../../jobs.hrdpcnpromopro.com/201 Files/" . $folder_name . "/" . $folder_name_subfolder;
  $folder_path = "201 Files/" . $folder_name . "/" . $folder_name_subfolder;

  if (mkdir("{$destination_subfolder}", 0777)) {
    $query = "INSERT INTO folder (applicant_id, employee_id, folder_name, folder_path) VALUES(?, ?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("iiss", $applicant_id, $employee_id, $folder_name_subfolder, $folder_path);
    if ($stmt->execute()) {

      $transaction = "ADDED FOLDER FOR EMPLOYEE " . $employee_id . " FOLDER NAME: " . $folder_name_subfolder;
      $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
      $transaction_log_result = $link->prepare($transaction_log);
      $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
      $transaction_log_result->execute();


      $_SESSION['successMessage'] = "Success";
    } else {
      $_SESSION['errorMessage'] = "Error" . $link->error;
    }
  } else {
    $_SESSION['errorMessage'] = "Folder is already exist";
  }

  header("Location: employee_information.php?id=$employee_id&name=$applicant_names");
}

// For Adding Files to the folder
if (isset($_POST['upload_file_btn'])) {
  $employee_id = $_POST['employee_id'];
  $folder_id = $_POST['folder_id'];
  $folder_name = $_POST['folder_name'];
  $files = $_FILES['files'];


  // Selecting Employees table so we can fetch the Applicant ID
  $select = "SELECT * FROM employees WHERE id = '$employee_id'";
  $select_result = $link->query($select);
  $select_row = $select_result->fetch_assoc();
  $applicant_id = $select_row['app_id'];

  // Selecting Folder table so we can fetch the datas in that table
  $select_folder = "SELECT * FROM folder WHERE id = '$folder_id' AND applicant_id = '$applicant_id'";
  $stmt = $link->query($select_folder);

  if ($stmt === false) {
    die("Error in query preparation: " . $link->error);
  }

  while ($rows = $stmt->fetch_assoc()) {
    $path = "../../../jobs.hrdpcnpromopro.com/" . $rows['folder_path'] . "/";
    // Let's now insert the data in 201 files table
    foreach ($files['tmp_name'] as $key => $tmp_name) {
      $targetFile = $path . basename($files['name'][$key]);
      $filename = basename($files['name'][$key]);

      if ($folder_name === 'Requirements') {
        $file_title = "REQUIREMENTS";
      } else {
        $file_title = "LOA";
      }
      $inserts = "INSERT INTO 201files(applicant_id, employee_id, folder_id, requirements_files, requirements_files_uploaded, file_description) 
            VALUES (?, ?, ?, ?, ?, ?)";
      $insert_result = $link->prepare($inserts);
      $insert_result->bind_param("ssssss", $applicant_id, $employee_id, $folder_id, $filename, $date_now, $file_title);
      if ($insert_result->execute()) {

        $transaction = "ADDED FILES FOR EMPLOYEE " . $employee_id . " FILE NAME: " . $filename;
        $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
        $transaction_log_result = $link->prepare($transaction_log);
        $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
        $transaction_log_result->execute();


        move_uploaded_file($tmp_name, $targetFile);
        $_SESSION['successMessage'] = "Success";
      } else {
        $_SESSION['errorMessage'] = "Error" . $link->error;
      }
    }
  }
  header("Location: files.php?id=$employee_id&folder_id=$folder_id&folder_name=$folder_name");
  exit(0);
}

// For updating Emergency Info
if (isset($_POST['update_e_btn'])) {
  $employee_id = $_POST['id'];
  $employee_name = $_POST['name'];
  $e_person = strtoupper($_POST['e_person']);
  $e_address = strtoupper($_POST['e_address']);
  $e_contact = strtoupper($_POST['e_contact']);

  $chopped_e_person = chop(trim($e_person));
  $chopped_e_address = chop(trim($e_address));
  $chopped_e_contact = chop(trim($e_contact));

  $query = "UPDATE employees SET e_person = ?, e_address = ?, e_number = ? WHERE id = ?";
  $result = $link->prepare($query);
  $result->bind_param("sssi", $chopped_e_person, $chopped_e_address, $chopped_e_contact, $employee_id);
  if ($result->execute()) {
    $transaction = "UPDATE EMERGENCY INFORMATION OF " . $employee_id;
    $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
    $transaction_log_result = $link->prepare($transaction_log);
    $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
    $transaction_log_result->execute();

    $_SESSION['successMessage'] = "Success";
  } else {
    $_SESSION['errorMessage'] = "Error";
  }
  header("Location: employee_information.php?id=$employee_id&name=$employee_name");
  exit(0);
}

// Update ID Status
if (isset($_POST['submitButton'])) {
  $id = $_POST['id'];
  $id_status = $_POST['id_status'];

  $query = "UPDATE deployment SET id_remarks = ? WHERE id = ?";
  $result = $link->prepare($query);
  $result->bind_param("si", $id_status, $id);
  if ($result->execute()) {
    $transaction = "UPDATE ID STATUS OF " . $id;
    $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
    $transaction_log_result = $link->prepare($transaction_log);
    $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
    $transaction_log_result->execute();

    $_SESSION['successMessage'] = "Success";
  } else {
    $_SESSION['errorMessage'] = "Error";
  }

  header("Location: loa_database.php");
  exit(0);
}

// Upload LOA - PDF 
if (isset($_POST['upload_btn'])) {
  $deployment_id = $_POST['id'];
  $datenow = date('Y-m-d H:i:s');
  $files = $_FILES['files'];

  // Add the allowed extensions array
  $allowed_extensions = ['pdf'];

  $select_deployment = "SELECT * FROM deployment WHERE id = '$deployment_id'";
  $select_deployment_result = $link->query($select_deployment);
  $select_deployment_row = $select_deployment_result->fetch_assoc();

  $applicant_id = $select_deployment_row['app_id'];
  $employee_id = $select_deployment_row['employee_id'];

  $select_folder = "SELECT * FROM folder WHERE applicant_id = '$applicant_id' AND employee_id = '$employee_id' AND deployment_id = '$deployment_id'";
  $select_folder_result = $link->query($select_folder);
  $select_folder_row = $select_folder_result->fetch_assoc();

  $folder_id = $select_folder_row['id'];
  $folder_path = $select_folder_row['folder_path'];
  $destination_path = "../../../jobs.hrdpcnpromopro.com/" . $folder_path . "/";
  $file_title = "LOA - PDF";

  foreach ($files['tmp_name'] as $key => $tmp_name) {
    // Get file extension
    $file_info = pathinfo($files['name'][$key]);
    $file_extension = strtolower($file_info['extension']);

    // Check if the file extension is allowed
    if (in_array($file_extension, $allowed_extensions)) {
      $targetFile = $destination_path . basename($files['name'][$key]);
      $filename = basename($files['name'][$key]);
      $insert_201 = "INSERT INTO 201files (applicant_id, employee_id, folder_id, requirements_files, requirements_files_uploaded, file_description) 
                            VALUES (?, ?, ?, ?, ?, ?)";
      $insert_201_result = $link->prepare($insert_201);
      $insert_201_result->bind_param("iiisss", $applicant_id, $employee_id, $folder_id, $filename, $datenow, $file_title);
      if ($insert_201_result->execute()) {
        $transaction = "UPLOAD LOA FILE - PDF";
        $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
        $transaction_log_result = $link->prepare($transaction_log);
        $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
        $transaction_log_result->execute();

        move_uploaded_file($tmp_name, $targetFile);
        $_SESSION['successMessage'] = "Success";
      } else {
        $_SESSION['errorMessage'] = "Error" . $link->error;
      }
    } else {
      // Invalid file type
      $_SESSION['errorMessage'] = "Invalid file type. Only PDF files are allowed.";
    }
  }
  header("Location: loa_database.php");
  exit(0);
}

// For Accepting LOA Renewal Requests
if (isset($_POST['accept_request_loa_renewal_btn'])) {
  $accept_renewal_request_id = $_POST['request_id'];
  $deployment_id = $_POST['deployment_id'];
  $employee_id = $_POST['employee_id'];

  // Get the request data from loa_renewal_request table
  $select_request = "SELECT * 
    FROM loa_renewal_request 
    WHERE id = '$accept_renewal_request_id' 
    AND deployment_id = '$deployment_id' 
    AND employee_id = '$employee_id'";
  $select_result = $link->query($select_request);
  $select_row = $select_result->fetch_assoc();
  $request_type = $select_row['request_type'];

  $start_date = $_POST['start_date'];
  $end_date = $_POST['end_date'];
  $category = $select_row['category'];
  $channel = $select_row['channel'];
  $employment_status = $_POST['employment_status'];
  $job_title = $select_row['job_title'];
  $basic_salary = $select_row['basic_salary'];
  $ecola = $select_row['ecola'];
  $communication_allowance = $select_row['communication_allowance'];
  $transportation_allowance = $select_row['transportation_allowance'];
  $internet_allowance = $select_row['internet_allowance'];
  $meal_allowance = $select_row['meal_allowance'];
  $outbase_allowance = $select_row['outbase_allowance'];
  $special_allowance = $select_row['special_allowance'];
  $position_allowance = $select_row['position_allowance'];
  $no_days_of_work = $select_row['no_days_of_work'];
  $outlet = $select_row['outlet'];
  $status = "RENEWED"; // Type
  $request_status = "RENEWAL"; // Type
  $date_created = date('Y-m-d H:i:s');

  // If they requested individually
  if ($request_type === 'SINGLE') {
    $update_deployment = "UPDATE deployment 
        SET loa_start_date = ?,
        loa_end_date = ?,
        category = ?,
        channel = ?,
        employment_status = ?,
        job_title = ?,
        basic_salary = ?,
        ecola = ?,
        communication_allowance = ?,
        transportation_allowance = ?,
        internet_allowance = ?,
        meal_allowance = ?,
        outbase_meal = ?,
        special_allowance = ?,
        position_allowance = ?,
        no_of_days = ?,
        outlet = ?,
        type = ?,
        date_created = ?
        WHERE id = ? 
        AND employee_id = ?";

    $stmt = $link->prepare($update_deployment);
    $stmt->bind_param("sssssssssssssssssssii", $start_date, $end_date, $category, $channel, $employment_status, $job_title,
      $basic_salary, $ecola, $communication_allowance, $transportation_allowance, $internet_allowance, $meal_allowance,
      $outbase_allowance, $special_allowance, $position_allowance, $no_days_of_work, $outlet, $request_status, $date_created, $deployment_id, $employee_id);
    if ($stmt->execute()) {
        $sql = "SELECT * FROM deployment WHERE id = '$deployment_id'";
        $results = $link->query($sql);
        $rows = $results->fetch_assoc();
    
        $shortlist_title = $rows['shortlist_title'];
        $appno = $rows['appno'];
        $fullname = $rows['shortlist_title'];
        $date_shortlisted = $rows['date_shortlisted'];
        $emp_id = $rows['employee_id'];
        $id = $deployment_id;
        $sss = $rows['sss'];
        $philhealth = $rows['philhealth'];
        $pagibig = $rows['pagibig'];
        $tin = $rows['tin'];
        $address = $rows['address'];
        $contact_number = $rows['contact_number'];
        $status = $rows['status'];
        $type = $rows['type'];
        $start_loa = $rows['loa_start_date'];
        $end_loa = $rows['loa_end_date'];
        $division = $rows['division'];
        $category = $rows['category'];
        $locator = $rows['locator'];
        $client_name = $rows['client_name'];
        $place_assigned = $rows['place_assigned'];
        $address_assigned = $rows['address_assigned'];
        $channel = $rows['channel'];
        $department = $rows['department'];
        $employment_status = $rows['employment_status'];
        $job_title = $rows['job_title'];
        $loa_template = $rows['loa_template'];
        $basic_salary = $rows['basic_salary'];
        $ecola = $rows['ecola'];
        $communication_allowance = $rows['communication_allowance'];
        $transportation_allowance = $rows['transportation_allowance'];
        $internet_allowance = $rows['internet_allowance'];
        $meal_allowance = $rows['meal_allowance'];
        $outbase_meal = $rows['outbase_meal'];
        $special_allowance = $rows['special_allowance'];
        $position_allowance = $rows['position_allowance'];
        $deployment_remarks = $rows['deployment_remarks'];
        $no_of_days = $rows['no_of_days'];
        $outlet = $rows['outlet'];
        $supervisor = $rows['supervisor'];
        $field_supervisor = $rows['field_supervisor'];
        $field_supervisor_designation = $rows['field_designation'];
        $deployment_personnel = $rows['deployment_personnel'];
        $deployment_personnel_designation = $rows['deployment_designation'];
        $project_supervisor = $rows['project_supervisor'];
        $project_supervisor_designation = $rows['projectSupervisor_deployment'];
        $head = $rows['head'];
        $head_designation = $rows['head_designation'];
        $loa_id = $rows['emp_id'];




        $query_history = "INSERT INTO `deployment_history`(`shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, `deployment_id`,
                `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
                `contact_number`, `loa_status`, `type`, `loa_start_date`, 
                `loa_end_date`, `division`, `category`, `locator`, `client_name`,
                `place_assigned`, `address_assigned`, `channel`, `department`, 
                `employment_status`, `job_title`, `loa_template`, 
                `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
                `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
                `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
                `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
                `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
                `head`, `head_designation`, `emp_id`, `date_updated`) 
                VALUES ('$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$emp_id', '$id',
                '$sss', '$philhealth', '$pagibig', '$tin','$address', 
                '$contact_number','$status', '$type', '$start_loa', 
                '$end_loa', '$division', '$category', '$locator', '$client_name',
                '$place_assigned', '$address_assigned', '$channel', '$department', 
                '$employment_status', '$job_title', '$loa_template', 
                '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
                '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
    
                '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
                '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
                '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
                '$head', '$head_designation', '$loa_id', '$date')";
        $query_result = $link->query($query_history);
        if($query_result){
            $delete = "DELETE FROM loa_renewal_request WHERE id = ?";
              $deleteresult = $link->prepare($delete);
              $deleteresult->bind_param("i", $accept_renewal_request_id);
              if ($deleteresult->execute()) {
                $transaction = "ACCEPT LOA RENEWAL REQUEST - INDIVIDUAL";
                $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                                VALUES (?, ?, ?, ?, ?)";
                $transaction_log_result = $link->prepare($transaction_log);
                $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
                $transaction_log_result->execute();
                $_SESSION['successMessage'] = "Success";
              } else {
                $_SESSION['errorMessage'] = "Error" . $link->error;
              }
        }
        else{
            $_SESSION['errorMessage'] = "Error" . $link->error;
        }
      
    } else {
      $_SESSION['errorMessage'] = "Error" . $link->error;
    }
  } elseif ($request_type === 'MULTIPLE') {
    $update_deployment = "UPDATE deployment 
        SET loa_start_date = ?,
        loa_end_date = ?,
        basic_salary = ?, 
        ecola = ?,
        communication_allowance = ?,
        transportation_allowance = ?,
        internet_allowance = ?,
        meal_allowance = ?,
        outbase_meal = ?,
        special_allowance = ?,
        position_allowance = ?,
        type = ?
        WHERE id = ?
        AND employee_id = ?";
    $stmt = $link->prepare($update_deployment);
    $stmt->bind_param("ssssssssssssii", $start_date, $end_date, $basic_salary, $ecola, $communication_allowance, $transportation_allowance, $internet_allowance, $meal_allowance, $outbase_allowance, $special_allowance, $position_allowance, $request_type);
    if ($stmt->execute()) {
        $sql = "SELECT * FROM deployment WHERE id = '$deployment_id'";
        $results = $link->query($sql);
        $rows = $results->fetch_assoc();
    
        $shortlist_title = $rows['shortlist_title'];
        $appno = $rows['appno'];
        $fullname = $rows['shortlist_title'];
        $date_shortlisted = $rows['date_shortlisted'];
        $emp_id = $rows['employee_id'];
        $id = $deployment_id;
        $sss = $rows['sss'];
        $philhealth = $rows['philhealth'];
        $pagibig = $rows['pagibig'];
        $tin = $rows['tin'];
        $address = $rows['address'];
        $contact_number = $rows['contact_number'];
        $status = $rows['status'];
        $type = $rows['type'];
        $start_loa = $rows['loa_start_date'];
        $end_loa = $rows['loa_end_date'];
        $division = $rows['division'];
        $category = $rows['category'];
        $locator = $rows['locator'];
        $client_name = $rows['client_name'];
        $place_assigned = $rows['place_assigned'];
        $address_assigned = $rows['address_assigned'];
        $channel = $rows['channel'];
        $department = $rows['department'];
        $employment_status = $rows['employment_status'];
        $job_title = $rows['job_title'];
        $loa_template = $rows['loa_template'];
        $basic_salary = $rows['basic_salary'];
        $ecola = $rows['ecola'];
        $communication_allowance = $rows['communication_allowance'];
        $transportation_allowance = $rows['transportation_allowance'];
        $internet_allowance = $rows['internet_allowance'];
        $meal_allowance = $rows['meal_allowance'];
        $outbase_meal = $rows['outbase_meal'];
        $special_allowance = $rows['special_allowance'];
        $position_allowance = $rows['position_allowance'];
        $deployment_remarks = $rows['deployment_remarks'];
        $no_of_days = $rows['no_of_days'];
        $outlet = $rows['outlet'];
        $supervisor = $rows['supervisor'];
        $field_supervisor = $rows['field_supervisor'];
        $field_supervisor_designation = $rows['field_designation'];
        $deployment_personnel = $rows['deployment_personnel'];
        $deployment_personnel_designation = $rows['deployment_designation'];
        $project_supervisor = $rows['project_supervisor'];
        $project_supervisor_designation = $rows['projectSupervisor_deployment'];
        $head = $rows['head'];
        $head_designation = $rows['head_designation'];
        $loa_id = $rows['emp_id'];




        $query_history = "INSERT INTO `deployment_history`(`shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, `deployment_id`,
                `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
                `contact_number`, `loa_status`, `type`, `loa_start_date`, 
                `loa_end_date`, `division`, `category`, `locator`, `client_name`,
                `place_assigned`, `address_assigned`, `channel`, `department`, 
                `employment_status`, `job_title`, `loa_template`, 
                `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
                `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
                `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
                `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
                `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
                `head`, `head_designation`, `emp_id`, `date_updated`) 
                VALUES ('$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$emp_id', '$id',
                '$sss', '$philhealth', '$pagibig', '$tin','$address', 
                '$contact_number','$status', '$type', '$start_loa', 
                '$end_loa', '$division', '$category', '$locator', '$client_name',
                '$place_assigned', '$address_assigned', '$channel', '$department', 
                '$employment_status', '$job_title', '$loa_template', 
                '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
                '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
    
                '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
                '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
                '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
                '$head', '$head_designation', '$loa_id', '$date')";
        $query_result = $link->query($query_history);
        if($query_result){
              $delete = "DELETE FROM loa_renewal_request WHERE id = ?";
              $deleteresult = $link->prepare($delete);
              $deleteresult->bind_param("i", $accept_renewal_request_id);
              if ($deleteresult->execute()) {
                $transaction = "ACCEPT LOA RENEWAL REQUEST - MULTIPLE";
                $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                                VALUES (?, ?, ?, ?, ?)";
                $transaction_log_result = $link->prepare($transaction_log);
                $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
                $transaction_log_result->execute();
                $_SESSION['successMessage'] = "Success";
              } else {
                $_SESSION['errorMessage'] = "Error" . $link->error;
              } 
        }
        else{
            $_SESSION['errorMessage'] = "Error" . $link->error;
        }
      
    } else {
      $_SESSION['errorMessage'] = "Error" . $link->error;
    }
  }
  header("Location: loa_renewal_requests.php");
  exit(0);
}

// For Approving NOA Renewal Requests
if (isset($_POST['accept_request_noa_renewal_btn'])) {
  $accept_renewal_request_id = $_POST['request_id'];
  $deployment_id = $_POST['deployment_id'];
  $employee_id = $_POST['employee_id'];
  $noa_template = $_POST['noa_template'];
  $effectivity_date = $_POST['effectivity_date'];
  $noa_remarks = $_POST['noa_remarks'];
  $loa_start_date = "";
  $loa_end_date = "";
  $noa_type = "REGULAR";

  $query = "UPDATE deployment 
    SET loa_template = ?,
    effectivity_date = ?,
    noa_remarks = ?,
    loa_start_date = ?,
    loa_end_date = ?,
    noa_type = ?
    WHERE id = ?";
  $result = $link->prepare($query);
  $result->bind_param("ssssssi", $noa_template, $effectivity_date, $noa_remarks, $loa_start_date, $loa_end_date, $noa_type, $deployment_id);
  if ($result->execute()) {
    $sql = "SELECT * FROM deployment WHERE id = '$deployment_id'";
    $results = $link->query($sql);
    $rows = $results->fetch_assoc();

    $shortlist_title = $rows['shortlist_title'];
    $appno = $rows['appno'];
    $fullname = $rows['shortlist_title'];
    $date_shortlisted = $rows['date_shortlisted'];
    $emp_id = $rows['employee_id'];
    $id = $deployment_id;
    $sss = $rows['sss'];
    $philhealth = $rows['philhealth'];
    $pagibig = $rows['pagibig'];
    $tin = $rows['tin'];
    $address = $rows['address'];
    $contact_number = $rows['contact_number'];
    $status = $rows['status'];
    $type = $rows['type'];
    $start_loa = $rows['loa_start_date'];
    $end_loa = $rows['loa_end_date'];
    $division = $rows['division'];
    $category = $rows['category'];
    $locator = $rows['locator'];
    $client_name = $rows['client_name'];
    $place_assigned = $rows['place_assigned'];
    $address_assigned = $rows['address_assigned'];
    $channel = $rows['channel'];
    $department = $rows['department'];
    $employment_status = $rows['employment_status'];
    $job_title = $rows['job_title'];
    $loa_template = $rows['loa_template'];
    $basic_salary = $rows['basic_salary'];
    $ecola = $rows['ecola'];
    $communication_allowance = $rows['communication_allowance'];
    $transportation_allowance = $rows['transportation_allowance'];
    $internet_allowance = $rows['internet_allowance'];
    $meal_allowance = $rows['meal_allowance'];
    $outbase_meal = $rows['outbase_meal'];
    $special_allowance = $rows['special_allowance'];
    $position_allowance = $rows['position_allowance'];
    $deployment_remarks = $rows['deployment_remarks'];
    $no_of_days = $rows['no_of_days'];
    $outlet = $rows['outlet'];
    $supervisor = $rows['supervisor'];
    $field_supervisor = $rows['field_supervisor'];
    $field_supervisor_designation = $rows['field_designation'];
    $deployment_personnel = $rows['deployment_personnel'];
    $deployment_personnel_designation = $rows['deployment_designation'];
    $project_supervisor = $rows['project_supervisor'];
    $project_supervisor_designation = $rows['projectSupervisor_deployment'];
    $head = $rows['head'];
    $head_designation = $rows['head_designation'];
    $loa_id = $rows['emp_id'];




    $query_history = "INSERT INTO `deployment_history`(`shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, `deployment_id`,
            `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
            `contact_number`, `loa_status`, `type`, `loa_start_date`, 
            `loa_end_date`, `division`, `category`, `locator`, `client_name`,
            `place_assigned`, `address_assigned`, `channel`, `department`, 
            `employment_status`, `job_title`, `loa_template`, 
            `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
            `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
            `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, 
            `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
            `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
            `head`, `head_designation`, `emp_id`, `date_updated`, `effectivity_date`, `noa_remarks`) 
            VALUES ('$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$emp_id', '$id',
            '$sss', '$philhealth', '$pagibig', '$tin','$address', 
            '$contact_number','$status', '$type', '$start_loa', 
            '$end_loa', '$division', '$category', '$locator', '$client_name',
            '$place_assigned', '$address_assigned', '$channel', '$department', 
            '$employment_status', '$job_title', '$loa_template', 
            '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
            '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 

            '$position_allowance', '$deployment_remarks', '$no_of_days', '$outlet', 
            '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
            '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
            '$head', '$head_designation', '$loa_id', '$date', '$effectivity_date' , '$noa_remarks')";
    $query_result = $link->query($query_history);
    if ($query_result) {
      $delete = "DELETE FROM loa_renewal_request WHERE id = ?";
      $delete_result = $link->prepare($delete);
      $delete_result->bind_param("i", $accept_renewal_request_id);
      if ($delete_result->execute()) {
        $_SESSION['successMessage'] = "Success";
      } else {
        $_SESSION['errorMessage'] = "Error";
      }
    } else {
      $_SESSION['errorMessage'] = "Error";
    }
  } else {
    $_SESSION['errorMessage'] = "Error";
  }
  header("Location: loa_renewal_requests.php");
  exit(0);
}

// For Approving NOA - LATERAL TRANSFER Renewal Requests
if (isset($_POST['accept_request_noa_lateral_transfer_renewal_btn'])) {
    $accept_renewal_request_id = $_POST['request_id'];
    $deployment_id = $_POST['deployment_id'];
    $employee_id = $_POST['employee_id'];
    $noa_template = $_POST['noa_template'];
    $effectivity_date = $_POST['effectivity_date'];
    $noa_remarks = $_POST['noa_remarks'];
    $loa_start_date = $_POST['start_date'];
    $loa_end_date = $_POST['end_date'];
    $new_outlet = $_POST['new_outlet'];
    $noa_type = "LATERAL TRANSFER";
    $clearance = "ACTIVE";

    $sql = "SELECT * FROM deployment WHERE id = '$deployment_id'";
    $results = $link->query($sql);
    $rows = $results->fetch_assoc();

    $shortlist_title = $rows['shortlist_title'];
    $appno = $rows['appno'];
    $fullname = $rows['shortlist_title'];
    $date_shortlisted = $rows['date_shortlisted'];
    $emp_id = $rows['employee_id'];
    $id = $deployment_id;
    $sss = $rows['sss'];
    $philhealth = $rows['philhealth'];
    $pagibig = $rows['pagibig'];
    $tin = $rows['tin'];
    $address = $rows['address'];
    $contact_number = $rows['contact_number'];
    $status = $rows['status'];
    $type = $rows['type'];
    $start_loa = $rows['loa_start_date'];
    $end_loa = $rows['loa_end_date'];
    $division = $rows['division'];
    $category = $rows['category'];
    $locator = $rows['locator'];
    $client_name = $rows['client_name'];
    $place_assigned = $rows['place_assigned'];
    $address_assigned = $rows['address_assigned'];
    $channel = $rows['channel'];
    $department = $rows['department'];
    $employment_status = $rows['employment_status'];
    $job_title = $rows['job_title'];
    $loa_template = $rows['loa_template'];
    $basic_salary = $rows['basic_salary'];
    $ecola = $rows['ecola'];
    $communication_allowance = $rows['communication_allowance'];
    $transportation_allowance = $rows['transportation_allowance'];
    $internet_allowance = $rows['internet_allowance'];
    $meal_allowance = $rows['meal_allowance'];
    $outbase_meal = $rows['outbase_meal'];
    $special_allowance = $rows['special_allowance'];
    $position_allowance = $rows['position_allowance'];
    $deployment_remarks = $rows['deployment_remarks'];
    $no_of_days = $rows['no_of_days'];
    $outlet = $rows['outlet'];
    $supervisor = $rows['supervisor'];
    $field_supervisor = $rows['field_supervisor'];
    $field_supervisor_designation = $rows['field_designation'];
    $deployment_personnel = $rows['deployment_personnel'];
    $deployment_personnel_designation = $rows['deployment_designation'];
    $project_supervisor = $rows['project_supervisor'];
    $project_supervisor_designation = $rows['projectSupervisor_deployment'];
    $head = $rows['head'];
    $head_designation = $rows['head_designation'];
    $loa_id = $rows['emp_id'];


    $query = "UPDATE deployment 
      SET loa_template = ?,
      outlet = ?,
      previous_outlet = ?,
      effectivity_date = ?,
      noa_remarks = ?,
      loa_start_date = ?,
      loa_end_date = ?,
      noa_type = ?,
      clearance = ?
      WHERE id = ?";
    $result = $link->prepare($query);
    $result->bind_param("sssssssssi", $noa_template, $new_outlet, $outlet, $effectivity_date, $noa_remarks, $loa_start_date, $loa_end_date, $noa_type, $clearance, $deployment_id);
    if ($result->execute()) {

        $query_history = "INSERT INTO `deployment_history`(`shortlist_title`, `appno`, `employee_name`, `date_shortlisted`, `employee_id`, `deployment_id`,
              `sss`, `philhealth`, `pagibig`, `tin`, `address`, 
              `contact_number`, `loa_status`, `type`, `loa_start_date`, 
              `loa_end_date`, `division`, `category`, `locator`, `client_name`,
              `place_assigned`, `address_assigned`, `channel`, `department`, 
              `employment_status`, `job_title`, `loa_template`, 
              `basic_salary`, `ecola`, `communication_allowance`, `transportation_allowance`, 
              `internet_allowance`, `meal_allowance`, `outbase_meal`, `special_allowance`, 
              `position_allowance`, `deployment_remarks`, `no_of_days`, `outlet`, `previous_outlet`,
              `supervisor`, `field_supervisor`, `field_designation`, `deployment_personnel`, 
              `deployment_designation`, `project_supervisor`, `projectSupervisor_deployment`, 
              `head`, `head_designation`, `emp_id`, `date_updated`, `effectivity_date`, `noa_remarks`) 
              VALUES ('$shortlist_title', '$appno', '$fullname', '$date_shortlisted', '$emp_id', '$id',
              '$sss', '$philhealth', '$pagibig', '$tin','$address', 
              '$contact_number','$status', '$type', '$start_loa', 
              '$end_loa', '$division', '$category', '$locator', '$client_name',
              '$place_assigned', '$address_assigned', '$channel', '$department', 
              '$employment_status', '$job_title', '$loa_template', 
              '$basic_salary', '$ecola', '$communication_allowance', '$transportation_allowance', 
              '$internet_allowance', '$meal_allowance', '$outbase_meal', '$special_allowance', 
  
              '$position_allowance', '$deployment_remarks', '$no_of_days', '$new_outlet', '$outlet',
              '$supervisor', '$field_supervisor', '$field_supervisor_designation', '$deployment_personnel', 
              '$deployment_personnel_designation', '$project_supervisor', '$project_supervisor_designation', 
              '$head', '$head_designation', '$loa_id', '$date', '$effectivity_date' , '$noa_remarks')";
        $query_result = $link->query($query_history);
        if ($query_result) {
            $delete = "DELETE FROM loa_renewal_request WHERE id = ?";
            $delete_result = $link->prepare($delete);
            $delete_result->bind_param("i", $accept_renewal_request_id);
            if ($delete_result->execute()) {
                $_SESSION['successMessage'] = "Success";
            } else {
                $_SESSION['errorMessage'] = "Error" . $link->error;
            }
        } else {
            $_SESSION['errorMessage'] = "Error". $link->error;
        }
    } else {
        $_SESSION['errorMessage'] = "Error". $link->error;
    }
    header("Location: loa_renewal_requests.php");
    exit(0);
}

// For approving submitted LOA files
if (isset($_POST['approve_signed_loa_btn_click'])) {
  $deployment_id = $_POST['approve_signed_loa_id'];
  $status = $_POST['reason'];
  $approved_by = $_SESSION['firstname'] . " " . $_SESSION['lastname'];

  $query = "UPDATE deployment SET signed_loa_status = ?, signed_loa_approved_by = ? WHERE id = ?";
  $stmt = $link->prepare($query);
  $stmt->bind_param("ssi", $status, $approved_by, $deployment_id);
  if ($stmt->execute()) {
    $transaction = "APPROVED SUBMITTED LOA FILES";
    $transaction_log = "INSERT INTO transaction_log (user_id, transaction, personnel, user_type, division) 
                                        VALUES (?, ?, ?, ?, ?)";
    $transaction_log_result = $link->prepare($transaction_log);
    $transaction_log_result->bind_param("issss", $user_id, $transaction, $personnel, $user_type, $user_division);
    $transaction_log_result->execute();
    $_SESSION['successMessage'] = "Success";
  } else {
    $_SESSION['errorMessage'] = "Error";
  }
  header("Location: loa_database.php");
  exit(0);
}

// For Quit Claim
if(isset($_POST['quit_claim_btn'])){
    $separation_id = $_POST['separation_id'];
    $date_now = $_POST['date_now'];
    $amount = $_POST['amount'];
    $amountInWords = $_POST['amountInWords'];
    
    $query = "UPDATE separation SET date_created = ?, amount = ?, amount_text = ? WHERE id = ?";
    $result = $link->prepare($query);
    $result->bind_param("sssi", $date_now, $amount, $amountInWords, $separation_id);
    if($result->execute()){
        $_SESSION['successMessage'] = "Success";
    }
    else{
        $_SESSION['errorMessage'] = "Error";
    }
    header("Location: separation.php");
    exit(0);
}


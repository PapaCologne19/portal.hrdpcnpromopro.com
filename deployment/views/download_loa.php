


<?php
session_start();
require '../../connect.php';
require 'PHPWord.php';
ini_set('default_charset', 'utf-8');

$id = $_GET['id'];
$deployment_id = $_GET['deployment_id'];


$query = "SELECT * FROM deployment WHERE employee_id = '$id'";
$result = $link->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $division = $row['division'];
        $client_name = $row['client_name'];
        $type = $row['type'];
        $select_employee = "SELECT * FROM employees WHERE id = '$id'";
        $selected_result = $link->query($select_employee);

        $template_id = $row['loa_template'];
        $template_query = "SELECT * FROM loa_files WHERE id = '$template_id'";
        $template_result = $link->query($template_query);
        $template_row = $template_result->fetch_assoc();
        $file_name = $template_row['file_name'];
        $template = "../../admin/loa_template_directory/" . $file_name;





        while ($selected_row = $selected_result->fetch_assoc()) {
            $start_loa = $row['loa_start_date'];
            $start_loa_date = new DateTime($start_loa);
            $start_loa_formatted = $start_loa_date->format('F j, Y');
            $end_loa = $row['loa_end_date'];
            $end_loa_date = new DateTime($end_loa);
            $end_loa_formatted = $end_loa_date->format('F j, Y');

            $applicant_id = $selected_row['app_id'];
            $project_title = $row['shortlist_title'];



            $select_folder_path = "SELECT * FROM folder
            WHERE applicant_id = '$applicant_id' AND employee_id = '$id' AND deployment_id = '$deployment_id'";
            $select_folder_path_result = $link->query($select_folder_path);
            $select_folder_path_row = $select_folder_path_result->fetch_assoc();

            $folder_path = $select_folder_path_row['folder_path'];



            $applicant_name = chop($selected_row['firstnameko'] . " " . $selected_row['mnko'] . " " . $selected_row['lastnameko'] . " " . $selected_row['extnname']);
            $folder_name = $applicant_name;
            $applicant_name_subfolder = $applicant_name . "- From " . $start_loa_formatted . " To " . $end_loa_formatted;
            $folder_name_subfolder = $applicant_name_subfolder;
            $destination_subfolder = "../../../jobs.hrdpcnpromopro.com/" . $folder_path . "/";


            $applicant_name = $selected_row['lastnameko'] . ", " . $selected_row['firstnameko'] . " " . $selected_row['mnko'];
            if ($selected_row['mnko'] === "" || $selected_row['mnko'] === "N/A" || $selected_row['mnko'] === "NA") {
                $applicant_name = $selected_row['firstnameko'] . " " . $selected_row['lastnameko'];
            } else {
                $applicant_name = $selected_row['firstnameko'] . " " . $selected_row['mnko'] . " " . $selected_row['lastnameko'] . " " . $selected_row['extnname'];
            }
            $applicant_address = $row['address'];
            $client_name = $row['client_name'];
            $place_assigned = $row['place_assigned'];
            $address_assigned = $row['address_assigned'];
            $job_title = $row['job_title'];
            $employment_status = ucwords(strtolower($row['employment_status']));
            $start_date = $row['loa_start_date'];
            $end_date = $row['loa_end_date'];
            $dateObj = date_create_from_format('Y-m-d', $start_date);
            $dateObj2 = date_create_from_format('Y-m-d', $end_date);
            $formattedDate_start = date_format($dateObj, 'F j, Y');
            $formattedDate_end = date_format($dateObj2, 'F j, Y');
            $basic_pay = $row['basic_salary'];

            $outlet = $row['outlet'];
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
            
            $previous_outlet = $row['previous_outlet'];
            $concatenatedText2 = '';

            if (!empty($previous_outlet)) {
                $data = json_decode($previous_outlet, true);
                if (!empty($data['ops'])) {
                    foreach ($data['ops'] as $op) {
                        if (isset($op['insert'])) {
                            $text = trim($op['insert']);
                            if (!empty($text)) {
                                $concatenatedText2 .= $text . ', ';
                            }
                        }
                    }

                    // Remove the trailing comma and space
                    $concatenatedText2 = rtrim($concatenatedText2, ', ');
                }
            }
            $no_work_days = $row['no_of_days'];
            $date_issued = $row['date_created'];
            $date = date_create($date_issued);
            $issued_day = $date->format("d");
            $issued_month = $date->format("F");
            $issued_year = $date->format("Y");
            $pb_deployment_personnel = $row['deployment_personnel'];
            $pb_designation = $row['deployment_designation'];
            $pb_supervisor = $row['field_supervisor'];
            $pb_supervisor_designation = $row['field_designation'];
            $eb_project_supervisor = $row['project_supervisor'];
            $eb_psdesignation = $row['projectSupervisor_deployment'];
            $ab_head = $row['head'];
            $ab_head_designation = $row['head_designation'];
            $ab_project_supervisor = $row['project_supervisor'];
            $ab_pssupervisor_designation = $row['projectSupervisor_deployment'];
            $sss_no = $row['sss'];
            $philhealth = $row['philhealth'];
            $pagibig_no = $row['pagibig'];
            $tin_no = $row['tin'];
            $applicant_id = $row['employee_id'];
            $applicant_contact = $row['contact_number'];
            $communication_allowance = $row['communication_allowance'];
            $transpo_meal_allowance = $row['transportation_allowance'];
            $ecola = $row['ecola'];
            $internet_allowance = $row['internet_allowance'];
            $meal_allowance = $row['meal_allowance'];
            $outbase_meal = $row['outbase_meal'];
            $special_allowance = $row['special_allowance'];
            $position_allowance = $row['position_allowance'];
            $total_allowance = $communication_allowance + $transpo_meal_allowance + $internet_allowance + $ecola + $internet_allowance + $meal_allowance + $outbase_meal + $special_allowance + $position_allowance;
            $shortlist_id = $row['emp_id'];
            $loa_tracker = $row['locator'];
            $effectivity_date = $row['effectivity_date'];
            $noa_remarks = $row['noa_remarks'];
            
            
            $title = $issued_year . "-" . $division . "-" . $loa_tracker . "-" . $shortlist_id;
            $file_name_docx = $title . "-" . $applicant_name . "-" . $client_name . "-" . $type . "-LOA";
            // PHP Word Initialization
            $PHPWord = new PhpWord();
            $document = $PHPWord->loadTemplate($template);

            // Fill the document with data
            $document->setValue('Value1', iconv('UTF-8', 'UTF-8', $applicant_name));
            $document->setValue('Value2', iconv('UTF-8', 'UTF-8', $applicant_address));
            $document->setValue('Value3', iconv('UTF-8', 'UTF-8', $client_name));
            $document->setValue('Value4', iconv('UTF-8', 'UTF-8', $place_assigned));
            $document->setValue('Value5', iconv('UTF-8', 'UTF-8', $address_assigned));
            $document->setValue('Value6', iconv('UTF-8', 'UTF-8', $job_title));
            $document->setValue('Value7', iconv('UTF-8', 'UTF-8', $employment_status));
            $document->setValue('Value8', $formattedDate_start);
            $document->setValue('Deo9', $formattedDate_end);
            $document->setValue('Value10', $basic_pay);


            $document->setValue('Value11a', $concatenatedText);
            $document->setValue('Value12', $no_work_days);
            $document->setValue('Value13', $issued_day);
            $document->setValue('Value14', $issued_month);
            $document->setValue('Value15', $issued_year); 
            $document->setValue('Value16', iconv('UTF-8', 'UTF-8', $pb_deployment_personnel));
            $document->setValue('Value17', iconv('UTF-8', 'UTF-8', $pb_designation));


            $document->setValue('Value18', iconv('UTF-8', 'UTF-8', $pb_supervisor));
            $document->setValue('Value19', iconv('UTF-8', 'UTF-8', $pb_supervisor_designation));
            $document->setValue('Value20', iconv('UTF-8', 'UTF-8', $eb_project_supervisor));
            $document->setValue('Value21', iconv('UTF-8', 'UTF-8', $eb_psdesignation));
            $document->setValue('Value22', iconv('UTF-8', 'UTF-8', $ab_head));
            $document->setValue('Value23', iconv('UTF-8', 'UTF-8', $ab_head_designation));
            $document->setValue('Value24', iconv('UTF-8', 'UTF-8', $ab_project_supervisor));
            $document->setValue('Value25', iconv('UTF-8', 'UTF-8', $ab_pssupervisor_designation));

            $document->setValue('Value26', $sss_no);
            $document->setValue('Value27', $philhealth);
            $document->setValue('Value28', $pagibig_no);
            $document->setValue('Value29', $tin_no);
            $document->setValue('Value30', $applicant_id);

            
            $document->setValue('Value10a', $communication_allowance);
            $document->setValue('Value10b', $transpo_meal_allowance);
            $document->setValue('Value10c', $ecola);
            $document->setValue('Value10d', $internet_allowance);
            $document->setValue('Value10e', $meal_allowance);
            $document->setValue('Value10f', $outbase_meal);
            $document->setValue('Value10g', $special_allowance);
            $document->setValue('Value10h', $position_allowance);
            $document->setValue('TotalValue', $total_allowance);
            $document->setValue('Value31', $shortlist_id);
            
            if(!empty($row['effectivity_date']) && !empty($row['noa_remarks'])){
                $e_date = date_create($effectivity_date);
                $date_effectivity = date_format($e_date, 'F d, Y');
                if($row['noa_remarks'] === "Lateral Transfer"){
                    $later_noa_remarks = "Lateral Transfer from " . $concatenatedText2 . " to " . $concatenatedText; 
                    $document->setValue('Value32', $later_noa_remarks);
                } else{
                    $document->setValue('Value32', $noa_remarks);  
                }
                
                $document->setValue('Value33', $date_effectivity);
            } else{
                $document->setValue('Value32', $applicant_contact);
                $document->setValue('Value33', $loa_tracker);
            }

            // Save the document
            $document->save($destination_subfolder . ".docx");
        }
    }


    // Once all processing is done, initiate the download
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=" . $file_name_docx . ".docx");
    readfile($destination_subfolder . ".docx");
}
?>

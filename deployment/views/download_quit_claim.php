


<?php
session_start();
require '../../connect.php';
require 'PHPWord.php';
ini_set('default_charset', 'utf-8');

$id = $_GET['id'];

$query = "SELECT * FROM separation WHERE id = '$id'";
$result = $link->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
            $employee_id = $row['employee_id'];
            $employee_name = $row['employee_name'];
            $date = $row['date_created'];
            $date_create = DateTime::createFromFormat('m-d-Y', $date);
            $date_format = $date_create->format('F j, Y');
            
            $amount = $row['amount'];
            $amount_text = $row['amount_text'];
            $effectivity_date = $row['effectivity_date'];
            $effectivity_create = DateTime::createFromFormat('Y-m-d', $effectivity_date);
            $effectivity_date_format = $effectivity_create->format('F j, Y');
            $project_title = $row['project_title'];

            $select_employee = "SELECT * FROM employees WHERE id = '$employee_id'";
            $select_employee_result = $link->query($select_employee);
            $select_employee_row = $select_employee_result->fetch_assoc();

            $address = $select_employee_row['paddress'];
            $contact_number = $select_employee_row['cpnum'];

            $template = "../../admin/loa_template_directory/quitclaim_template.docx";

            // PHP Word Initialization
            $PHPWord = new PhpWord();
            $document = $PHPWord->loadTemplate($template);

            // Fill the document with data
            $document->setValue('Value2', $date_format);
            $document->setValue('Value12', $project_title);
            $document->setValue('Value20', $amount_text);
            $document->setValue('Value22', $amount);
            $document->setValue('Value26', $employee_name);
            $document->setValue('Value27', $address);
            $document->setValue('Value28', $contact_number);
            $document->setValue('Value29', $effectivity_date_format);

            // Save the document
            $document->save("Quit_claim.docx");
        }


    // Once all processing is done, initiate the download
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=Quit_claim.docx");
    readfile("Quit_claim.docx");
}
?>

<?php
require_once '../../connect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

// Load Composer's autoloader
require '../vendor/autoload.php';

// For sending email rejection message 
function sendMailEveryThreeDays($email, $fullname){
    $mail = new PHPMailer();
    try {
        // Server settings
        $mail->isSMTP();  // Send using SMTP
        $mail->Host       = 'mail.hrdpcnpromopro.com';  // Set the SMTP server to send through
        $mail->SMTPAuth   = true;  // Enable SMTP authentication
        $mail->Username   = 'jobs@hrdpcnpromopro.com';  // SMTP username
        $mail->Password   = 'P@ssw0rd2024';  // SMTP password
        $mail->SMTPSecure = 'ssl';  
        $mail->Port       = 465;  // TCP port to connect to (use 587 if you set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`)


        // Recipients
        $mail->setFrom('jobs@hrdpcnpromopro.com', 'PCN Promopro Inc.');
        $mail->addAddress($email, $fullname);  // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = 'Completion of Incomplete Requirements';
        $mail->Body    = '<center>
                            <div class="container" style="margin: 1rem;">
                                <div class="div-message">
                                    <h3 style="font-family: Arial, Helvetica, sans-serif; text-align: justify;">Dear '. $fullname .',</h3>
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify; text-indent: 4rem;">I trust this correspondence reaches you in good health and high spirits. </p>
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify;">We extend our gratitude for your expeditious efforts in addressing the essential prerequisites for our records.</p> 
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify;">Kindly find below the outstanding items we require for your file:</p>
                                    <br>
                        
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify;"><strong>MANDATORY REQUIREMENTS</strong></p>
                                    <ul>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Social Security System (SSS)</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Pag-IBIG</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">PhilHealth</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Taxpayer Identification Number (TIN)</li>
                                    </ul>
                        
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify;"><strong>OTHER REQUIREMENTS</strong></p>
                                    <ul>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">National Bureau of Investigation (NBI) Clearance</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Police Clearance</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Birth Certificate</li>
                                        <li style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Any other applicable requirements</li>
                                    </ul>
                                    <br>
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: left;">Your cooperation in fulfilling these requirements at your earliest convenience is highly appreciated.</p>
                                    <br>
                                </div>
                                <div class="footer-message">
                                    <p style="font-family: Arial, Helvetica, sans-serif; text-align: justify; ">Best regards,<br><br>
                                        PCN Promopro Inc.</p>
                                </div>
                            </div>
                        </center>';

        // Send the email
        if (!$mail->send()) {
            echo "Message could not be sent.";
        }
    } catch (Exception $e) {
        echo "Message could not be sent.";
        echo "Email Address: " . $email;
    }
}

$query = "SELECT DISTINCT applicant_id FROM 201files WHERE file_description = 'WAIVER'";
$result = $link->query($query);

if($result){
    while($row = $result->fetch_assoc()){
        $applicant_id = $row['applicant_id'];

        $select_applicant = "SELECT * FROM applicant WHERE id = '$applicant_id'";
        $select_applicant_result = $link->query($select_applicant);
        while($select_applicant_row = $select_applicant_result->fetch_assoc()){

            // Get the email, fullname and other details of the employee.
            $fullname = $select_applicant_row['firstname'] . " " . $select_applicant_row['middlename'] . " " . $select_applicant_row['lastname'] . " " . $select_applicant_row['extension_name'];
            $email = $select_applicant_row['email_address'];

            if(!empty($fullname) && !empty($email)){
                sendMailEveryThreeDays($email, $fullname);
            }
        }
    }
}

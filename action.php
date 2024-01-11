<?php
session_start();
header_remove('x-powered-by');

include("connect.php");

date_default_timezone_set('Asia/Manila');
$date = date('D : F d, Y');
$dtnow = date("m/d/Y H:i:s");
    
if (isset($_POST['submit_button'])) {
    if (!isset($_POST['token']) || $_SESSION['token'] !== $_POST['token']) {
        $_SESSION['errorMessage'] = "CSRF token validation failed";
        header("Location: index.php");
        exit(0);
    }
    
    $Username = $link->real_escape_string($_POST['username']);
    $Password = $link->real_escape_string($_POST['password']);
    $approved = "1";
    $is_deleted = "0";

    if (!empty($Username) && !empty($Password)) {
        $query = "SELECT * FROM data WHERE uname = '$Username' AND approve = '$approved' AND is_deleted = '$is_deleted'";
        $result = $link->query($query);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $hashed_password = $row['pname'];
                $usertype = $row['typenya'];
                if (password_verify($Password, $hashed_password)) {
                    switch ($usertype) {
                        case "EWB":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'EWB login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: ewb/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;

                        case "DEPLOYMENT":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'DEPLOYMENT login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: deployment/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;
                        
                        case "RECRUITMENT":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'RECRUITMENT login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: recruitment/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;

                        case "MRF":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'MRF login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: mrf/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;

                        case "POOLERS":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'POOLERS login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: poolers/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;

                        case "ADMIN":
                            $_SESSION["dmark"] = $row["uname"];
                            $_SESSION["firstname"] = $row["firstname"];
                            $_SESSION["lastname"] = $row['lastname'];
                            $_SESSION["username"] = $row["uname"];
                            $_SESSION["password"] = $row["pname"];
                            $_SESSION["data"] = $row["id"];
                            $_SESSION["user_id"] = $row["id"];
                            $_SESSION["division"] = $row["fms"];
                            $_SESSION["user_type"] = $row["typenya"];
                            $name = $_SESSION['firstname'] . " " . $_SESSION['lastname'];
                            $user_id = $_SESSION['user_id'];
                            $activity = 'ADMIN login Accepted';

                            $log = "INSERT INTO log (user_id, name, Username, Datelog, time, activitynya) VALUES (?, ?, ?, ?, ?, ?)";
                            $stmt = $link->prepare($log);
                            $stmt->bind_param("isssss", $user_id, $name, $Username, $dtnow, $dtnow, $activity);

                            if ($stmt->execute()) {
                                $_SESSION['successMessage'] = "Successfully Login";
                                header("location: admin/index.php");
                            } else {
                                $_SESSION["errorMessage"] = "Error Login";
                                header("Location: index.php");
                            }
                        break;

                        default:
                            $_SESSION['errorMessage'] = "Invalid Login";
                            header("Location: index.php");
                        break;
                    }
                } else {
                    $_SESSION['errorMessage'] = "Wrong username or password";
                    header("Location: index.php");
                    exit(0);
                }
            }
        } else {
            $_SESSION['errorMessage'] = "No User Found";
            header("Location: index.php");
            exit(0);
        }
    } else {
        $_SESSION['errorMessage'] = "Username and Password is empty";
        header("Location: index.php");
        exit(0);
    }
}

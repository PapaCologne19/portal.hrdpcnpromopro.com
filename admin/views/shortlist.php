<?php
    session_start();
    include '../../connect.php';
if(isset($_SESSION['username'], $_SESSION['password'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <title>Shortlisting</title>
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include '../components/sidebar.php'; ?>

            <!-- Main page -->
            <div class="layout-page">
                <?php include '../components/navbar.php'; ?>

                <!-- Content -->
                <div class="content-wrapper">
                    <div class="container">
                        <div class="card table-responsive">
                            <hr>
                            <div class="title justify-content-center align-items-center mx-auto">
                                <h4 class="fs-4">
                                    Project Title
                                </h4>
                            </div>
                            <hr>
                            <table class="table" id="example">
                                <thead>
                                    <tr>
                                        <th>IDs</th>
                                        <th>Project Name</th>
                                        <th>Shortlist Name</th>
                                        <th>Quantity</th>
                                        <th>Date Start</th>
                                        <th>Date End</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT project.*, shortlist.* 
                                        FROM projects project, shortlist_details shortlist 
                                        WHERE shortlist.project_id = project.id 
                                        AND status = '1' AND is_deleted = '0'";
                                        $result = $link->query($query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        $project_name = $row['project_title'];
                                        $start_date = $row['start_date'];
                                        $end_date = $row['end_date'];
                                        $timestamp_start_date = strtotime($start_date);
                                        $timestamp_end_date = strtotime($end_date);
                                        $formattedDate_start_date = date("F d, Y", $timestamp_start_date);
                                        $formattedDate_end_date = date("F d, Y", $timestamp_end_date);
                                    ?>
                                    <tr>
                                        <td><?php echo $row['id'] ?></td>
                                        <td><?php echo $row['project_title'] ?></td>
                                        <td><?php echo $row['shortlistname']; ?></td>
                                        <td><?php echo $row['ewb_count'] ?></td>
                                        <td> 
                                            <?php
                                                if ($row['start_date'] !== NULL) {
                                                echo $formattedDate_start_date;
                                                } else {
                                                echo "";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                                if ($row['end_date'] !== NULL) {
                                                    echo $formattedDate_end_date;
                                                } else {
                                                    echo "";
                                                }
                                            ?>
                                        </td>
                                        <td>
                                        <form action="" method="GET">
                                            <input type="hidden" name="shortlist_id" value="<?php echo $row['shortlistname'] ?>">
                                            <a href="deploy_applicants.php?shortlist_title=<?php echo $row['shortlistname'] ?>" name="view-shortlists" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="View Details">
                                                <i class="bi bi-search"></i>
                                                <span class="notification badge">
                                                <?php 
                                                    $project_title = $row['shortlistname'];
                                                        $get = "SELECT shortlist.*, employee.*, shortlist.project_status AS for_loa_status, employee.id AS employee_ids
                                                                FROM shortlist_master shortlist, employees employee
                                                                WHERE shortlist.employee_id = employee.id
                                                                AND shortlist.deployment_status = 'FOR DEPLOYMENT'
                                                                AND shortlist.project_status = 'FOR LOA'
                                                                AND shortlist.shortlistnameto = '$project_title'";
                                                                $get_result = $link->query($get);
                                                                   while($get_row = $get_result->fetch_assoc()){
                                                                        if($get_notification = $get_result->num_rows){
                                                                                        echo '<span class="badge rounded-pill bg-danger" >'.$get_notification.'</span>';
                                                                                    }
                                                                                    else{
                                                                                        echo "";
                                                                                    }
                                                                                }
                                                                            ?>
                                                                        </span>
                                                </a>
                                            
                                        </form>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php include '../components/footer.php'; ?>
</body>

</html>
<?php 
}else{
    header("Location: ../../logout.php");
    session_destroy();
    exit(0);
}
?>
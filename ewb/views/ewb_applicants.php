<?php
session_start();
include '../../connect.php';
if(isset($_SESSION['username'], $_SESSION['password'])){
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <title>Employees</title>
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
    } ?>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <?php include '../components/sidebar.php'; ?>

            <!-- Main page -->
            <div class="layout-page">
                <?php include '../components/navbar.php'; ?>

                <!-- Content -->
                <div class="content-wrapper mt-3">
                    <div class="container">
                        <div class="card">
                            <div class="container table-responsive">
                                <hr>
                                <div class="title justify-content-center align-items-center mx-auto text-center">
                                    <h4 class="fs-4">
                                        Employees
                                    </h4>
                                </div>
                                <hr>
                                <table id="example" class="table">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Applicant No </th>
                                            <th>Applicant Name </th>
                                            <th>Email </th>
                                            <th>Contact No.</th>
                                            <th>Birthday </th>
                                            <th>Address </th>
                                            <th>Status </th>
                                            <th>Action </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $query = "SELECT * FROM employees WHERE actionpoint <> 'BLACKLISTED' AND actionpoint <> 'REJECTED' AND actionpoint <> 'SHORTLISTED' AND actionpoint <> 'CANCELED'";
                                        $resultx = mysqli_query($link, $query);
                                        while ($rowx = mysqli_fetch_assoc($resultx)) { ?>
                                            <tr>
                                                <td> <?php echo $rowx['id'] ?> </td>
                                                <td> <?php echo $rowx['appno'] ?> </td>
                                                <td> <?php echo $rowx['lastnameko'] . ", " . $rowx['firstnameko'] . " " . $rowx['mnko'] ?> </td>
                                                <td><?php echo $rowx['emailadd'] ?> </td>
                                                <td><?php echo $rowx['cpnum'] ?> </td>
                                                <td><?php echo $rowx['birthday'] ?> </td>
                                                <td><?php echo $rowx['peraddress'] ?> </td>
                                                <?php if ($rowx['actionpoint'] === "ACTIVE") { ?>
                                                    <td><?php echo $rowx['actionpoint']; ?></td>
                                                <?php } else { ?>
                                                    <td><?php echo $rowx['actionpoint']; ?></td>
                                                <?php } ?>
                                                <td>
                                                    <div class="columns">
                                                        <a href="employee_information.php?id=<?php echo $rowx['id'];?>&name=<?php echo $rowx['firstnameko'] . " " . $rowx['lastnameko'];?>" class="btn btn-primary btn-sm">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        
                                                    </div>
                                                </td>
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

    <?php include '../components/footer.php'; ?>
</body>

</html>
<?php 
}
else{
    header("Location: ../../index.php");
    session_destroy();
    exit();
}
?>
<?php
session_start();
include '../../connect.php';

if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>Transaction Logs</title>
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
        }
        ?>
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <?php include '../components/sidebar.php'; ?>

                <!-- Main page -->
                <div class="layout-page">
                    <?php include '../components/navbar.php'; ?>

                    <!-- Content -->
                    <div class="content-wrapper">
                        <div class="container">
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4 justify-content-center align-">
                                            Transaction Logs
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Transaction ID</th>
                                                <th class="text-center">User ID</th>
                                                <th class="text-center">Name</th>
                                                <th class="text-center">User Type</th>
                                                <th class="text-center">Division</th>
                                                <th class="text-center">Date Login</th>
                                                <th class="text-center">Transaction</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM transaction_log";
                                            $result = $link->query($query);
                                            while ($row = $result->fetch_assoc()) {
                                                $date = date_create($row['transaction_date']);
                                                $date_format = date_format($date, 'F j, Y - h:i A');
                                            ?>
                                                <tr>
                                                    <td class="text-center"><?php echo $row['id'] ?></td>
                                                    <td class="text-center"><?php echo $row['user_id'] ?></td>
                                                    <td class="text-center"><?php echo $row['personnel'] ?></td>
                                                    <td class="text-center"><?php echo $row['user_type'] ?></td>
                                                    <td class="text-center"><?php echo $row['division'] ?></td>
                                                    <td class="text-center"><?php echo $date_format ?></td>
                                                    <td class="text-center"><?php echo $row['transaction'] ?></td>
                                                   
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
} else {
    header("Location: ../../index.php");
    exit(0);
}
?>
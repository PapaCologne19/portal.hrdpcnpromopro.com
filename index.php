<?php
session_start();
header_remove('x-powered-by');

include("connect.php");

date_default_timezone_set('Asia/Manila');
$date = date('D : F d, Y');

// Check if the CSRF token is not already set
$_SESSION['token'] = bin2hex(random_bytes(32));

?>
<html>


<head>

    <title>Welcome</title>
    <meta charset="utf-8">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <!--Favicon-->
    <link rel="shortcut icon" href="assets/img/pcn.png" type="image/x-icon">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="deo1.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter&family=Julius+Sans+One&family=Poppins&family=Quicksand&family=Roboto&family=Thasadith&display=swap"
        rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style type="text/css">
        * {
            font-family: 'Inter', sans-serif;
        }

        .username::placeholder,
        .password::placeholder {
            color: white !important;
        }
    </style>

</head>

<body style="background-image: url(assets/img/bg3a.jpg); background-size:100% 100%; background-repeat: no-repeat;">

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
    <?php
    if (isset($_SESSION['warningMessage'])) { ?>
        <script>
            Swal.fire({
                icon: 'warning',
                title: "<?php echo $_SESSION['warningMessage']; ?>",
            })
        </script>
        <?php unset($_SESSION['warningMessage']);
    } ?>

    <div class="login">
        <h2>
            <font color="white">LOG IN</font>
        </h2>
        <form action="action.php" method="POST">
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <div class="form-group mt-3">
                <label class="form-label">
                    <font color="white">Username</font>
                </label>
                <input type="text" name="username" class="form-control username" placeholder="Please enter username"
                    style="height:45px;width:250px;background: #445793 !important; color: white !important; " autofocus
                    required>
            </div>

            <div class="form-group mt-4 mb-4">
                <label class="form-label">
                    <font color="white">Password</font>
                </label>
                <input type="password" name="password" class="form-control password" placeholder="Please enter password"
                    style="height:45px;width:250px;background: #445793 !important; color: white !important;" required>
            </div>
            <input type="submit" name="submit_button" value=" " class="loginButton">;
        </form>
    </div>

    </div>
</body>

</html>
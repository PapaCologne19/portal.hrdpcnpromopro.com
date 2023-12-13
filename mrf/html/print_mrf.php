<?php
include 'connect.php';
session_start();

date_default_timezone_set('Asia/Hong_Kong');
$timestamp = time(); // You can replace this with your desired timestamp
$formatted_date = date("F j, Y", $timestamp);
if (isset($_SESSION['username'], $_SESSION['password'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap 5 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

        <!-- Bootstrap Icon -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Gabarito&family=Inter&family=Julius+Sans+One&family=Poppins&family=Quicksand:wght@400;500&family=Roboto&family=Thasadith&display=swap" rel="stylesheet">

        <title></title>

        <style>
            * {
                font-family: 'Inter', sans-serif !important;
            }

            .containers {
                margin: 0rem 2rem !important;
            }

            .form-control {
                border-top: none !important;
                border-left: none !important;
                border-right: none !important;
                border-bottom: 1px solid black !important;
                border-radius: 0 !important;
            }

            .form-check-input {
                border: 1px solid black !important;
            }

            table {
                border: 1px solid black !important;
                font-size: 12px !important;
            }

            .table td,
            .table th {
                padding: 0 .3rem !important;
            }

            table tr td {
                padding-top: .1rem !important;
                padding-bottom: 0rem !important;

            }

            table thead tr th {
                background: whitesmoke !important;
            }

            .form-check-label,
            .form-control {
                font-size: 13px !important;
            }

            i {
                text-decoration: underline !important;
                color: #3876BF !important;
                font-weight: bold !important;
            }
        </style>
    </head>

    <body>
        <div class="containers">
            <div class="row">
                <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM mrf WHERE id = '$id'";
                $result = $link->query($query);
                $row = $result->fetch_assoc();

                $work_duration_start = $row['work_duration_start'];
                $work_duration_end = $row['work_duration_end'];
                $date_needed = $row['date_needed'];
                $date_requested = $row['dt_now'];
                $timestamp_work_duration_start = strtotime($work_duration_start);
                $timestamp_work_duration_end = strtotime($work_duration_end);
                $timestamp_date_needed = strtotime($date_needed);
                $timestamp_date_requested = strtotime($date_requested);
                $formattedDate_work_duration_start = date("F d, Y", $timestamp_work_duration_start);
                $formattedDate_work_duration_end = date("F d, Y", $timestamp_work_duration_end);
                $formattedDate_date_needed = date("F d, Y", $timestamp_date_needed);
                $formattedDate_date_requested = date("F d, Y", $timestamp_date_requested);

                ?>
                <div class="header">
                    <img src="../assets/img/elements/pcn_logo.jpg" alt="" class="img-responsive justify-content-start logo" width="15%">
                    <center>
                        <br>
                        <p class="justify-content-center" style="margin-top: -4rem; font-size: 10px;"><i style="color: black !important;">PCN-HR-006 Rev No.1 - October 12, 2020</i></p>
                        <h4 class="fs-5" style="margin-top: -1rem;"><strong>MANPOWER REQUISITION FORM (MRF)</strong></h4>
                    </center>
                    <div class="tracking">
                        <p style="float: right;">Tracking No. <?php echo $row['tracking'] ?></p>
                    </div>
                    <div class="sub-header mt-4">
                        <p style="font-size: 12px;"><strong><i style="color: black !important; text-decoration: none !important;">Instructions: 1. Accomplish / Complete the form on a per position basis. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 2. Forward to Recruitment (hard copy or scanned copy) together with the Job description</i></strong></p>
                    </div>



                    <div class="sub-header-checkbox">
                        <table class="table" style="border: 1px solid white !important;">
                            <tbody>
                                <tr>
                                    <td width="80">
                                        <div class="form-check col-md-1">
                                            <?php
                                            if ($row['location'] === 'NCR') {
                                            ?>
                                                <input type="checkbox" name="" id="" class="form-check-input" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" name="" id="" class="form-check-input">
                                            <?php } ?>
                                            <label for="" class="form-check-label">NCR</label>
                                        </div>
                                        <div class="form-check col-md-1">
                                            <?php
                                            if ($row['mrf_category'] === 'NEW') {
                                            ?>
                                                <input type="checkbox" name="" id="" class="form-check-input" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" name="" id="" class="form-check-input">
                                            <?php } ?>
                                            <label for="" class="form-check-label">NEW</label>
                                        </div>
                                    </td>
                                    <td width="20">
                                        <div class="form-check col-md-12">
                                            <?php
                                            if ($row['location'] === 'PROVINCIAL') {
                                            ?>
                                                <input type="checkbox" name="" id="" class="form-check-input" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" name="" id="" class="form-check-input">
                                            <?php } ?>
                                            <label for="" class="form-check-label">PROVINCIAL</label>
                                        </div>

                                        <div class="form-check col-md-12">
                                            <?php
                                            if ($row['mrf_category'] === 'REPLACEMENT') {
                                            ?>
                                                <input type="checkbox" name="" id="" class="form-check-input" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" name="" id="" class="form-check-input">
                                            <?php } ?>
                                            <label for="" class="form-check-label">REPLACEMENT<i style="text-decoration: underline;"><?php echo $row['mrf_category_name'] ?></i></label>
                                        </div>
                                    </td>

                                    <td width="20">
                                        <div class="form-check col-md-1" style="visibility: hidden;">

                                            <label for="" class="form-check-label ">RELIEVER_______________</label>
                                        </div>
                                        <div class="form-check col-md-1">
                                            <?php
                                            if ($row['mrf_category'] === 'RELIEVER') {
                                            ?>
                                                <input type="checkbox" name="" id="" class="form-check-input" checked>
                                            <?php } else { ?>
                                                <input type="checkbox" name="" id="" class="form-check-input">
                                            <?php } ?>
                                            <label for="" class="form-check-label ">RELIEVER_______________</label>
                                        </div>

                                    </td>


                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="body">
                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center" style="background: whitesmoke;">PROJECT DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="40">Division/Dept</td>
                                <td width="100"><i style="color: skyblue;"><?php echo $row['division'] ?></i></td>
                                <td width="60">Client</td>
                                <td width="100" colspan="4"><i style="color: skyblue;"><?php echo $row['client'] ?></i></td>
                            </tr>
                            <tr>
                                <td>Project Title</td>
                                <td colspan="4"><i style="color: skyblue;"><?php echo $row['project_title'] ?></i></td>
                                <td width="70">C.E. No.</td>
                                <td><i style="color: skyblue;"><?php echo $row['ce_number'] ?></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center" style="background: whitesmoke;">POSITION (Please choose one and attach detailed Job Description)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border-right: 1px solid white !important;">
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Push Girl')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Push Girl</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Demo Girl')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Demo Girl</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Promo Girl')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Promo Girl</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Sampler')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Sampler</label>
                                    </div>
                                </td>
                                <td style="border-right: 1px solid white !important;">
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Merchandiser')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <input type="checkbox" name="" id="" class="form-check-input">
                                        <label for="" class="form-check-label">Merchandiser</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Helper')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Helper</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Mystery Buyer')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Mystery Buyer</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Validator')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Validator</label>
                                    </div>
                                </td>
                                <td style="border-right: 1px solid white !important;">
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Promoter')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Promoter</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Encoder')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Encoder</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Coordinator')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Coordinator</label>
                                    </div>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Bundler')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Bundler</label>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-check col-md-12">
                                        <?php
                                        if ($row['position'] === strtoupper('Others')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Others (Please Specify)</label>
                                    </div>
                                    <div class="col-md-12">
                                        <?php
                                        if (
                                            $row['position'] === strtoupper('Push Girl') || $row['position'] === strtoupper('Demo Girl') || $row['position'] === strtoupper('Promo Girl')
                                            || $row['position'] === strtoupper('Sampler') || $row['position'] === strtoupper('Merchandiser') || $row['position'] === strtoupper('Helper') || $row['position'] === strtoupper('Mystery Buyer')
                                            || $row['position'] === strtoupper('Validator') || $row['position'] === strtoupper('Promoter') || $row['position'] === strtoupper('Encoder') || $row['position'] === strtoupper('Coordinator')
                                            || $row['position'] === strtoupper('Coordinator') || $row['position'] === strtoupper('Bundler')
                                        ) {
                                        ?>
                                            <input type="text" name="" id="" class="form-control" value="<?php echo $row['position_detail'] ?>">
                                        <?php } else { ?>
                                            <input type="text" name="" id="" class="form-control" value="<?php echo $row['position'] . " (" . $row['position_detail'] . ")" ?>">
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center" style="background: whitesmoke;">JOB REQUIREMENTS / QUALIFICATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="padding: 10rem !important;">
                                <th style="border-right: 1px solid white !important; border-bottom: 1px solid white !important;"></th>
                                <th style="border-right: 1px solid white !important; border-bottom: 1px solid white !important">Male</th>
                                <th style="border-right: 1px solid white !important; border-bottom: 1px solid white !important">Female</th>
                                <th style="border-bottom: 1px solid white !important; padding-left: 7rem;">Personality (Please Check)</th>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important; border-bottom: 1px solid white !important;">No. of People</td>
                                <td width="50" style="border-right: 1px solid white !important; text-align: center; "><i style="text-decoration: none !important; "><?php echo $row['np_male'] ?></i></td>
                                <td width="50" style="border-right: 1px solid white !important;text-align: center;"><i style="text-decoration: none !important; "><?php echo $row['np_female'] ?></i></td>
                                <td rowspan="7" colspan="4" style="border-left: 1px solid white !important;">
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['pleasing_personality'] === strtoupper('Pleasing Personality')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Pleasing Personality</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['moral'] === strtoupper('Good Moral')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">With Good Moral Character</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['work_experience'] === strtoupper('With Work Experience')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">With Work Experience</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['comm_skills'] === strtoupper('Good communication skills')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Good Communication Skills</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['physically'] === strtoupper('Physically fit / good built')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Physically fit / Good Built</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if ($row['articulate'] === strtoupper('Articulate')) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Articulate</label>
                                    </div>
                                    <div class="col-md-12 form-check" style=" padding-left: 8rem;">
                                        <?php
                                        if (!empty($row['others'])) {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Others: &nbsp; &nbsp; &nbsp; &nbsp; <i><?php echo $row['others'] ?></i></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important; border-bottom: 1px solid white !important">Height Requirement</td>
                                <td width="50" style="border-right: 1px solid white !important;  text-align: center; "><i style="text-decoration: none !important;"><?php echo $row['height_r'] ?></i></td>
                                <td width="50" style="border-right: 1px solid white !important;  text-align: center; "><i style="text-decoration: none !important;"><?php echo $row['height_female'] ?></i></td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-right: 1px solid white !important; border-bottom: 1px solid white !important;">Educational Background (please check)</td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important; border-bottom: 1px solid white !important">High School Graduate</td>
                                <?php
                                if ($row['edu'] === 'High School Graduate') {
                                ?>
                                    <td style="border-right: 1px solid white !important; text-align: center;">

                                        <i style="text-decoration: none !important;">1</i>
                                    </td>
                                    <td style="border-right: 1px solid white !important; text-align: center;">

                                        <i style="text-decoration: none !important;">1</i>
                                    </td>
                                <?php } ?>

                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important; border-bottom: 1px solid white !important; border-top: 1px solid white !important">College Level</td>
                                <td style="border-right: 1px solid white !important; text-align:center;">
                                    <?php
                                    if ($row['edu'] === 'College Level') {
                                    ?>
                                        <i style="text-decoration: none !important;">1</i>
                                </td>
                                <td style="border-right: 1px solid white !important; text-align:center;">
                                    <i style="text-decoration: none !important;">1</i>
                                <?php } else {
                                    } ?>

                                </td>
                            </tr>
                            <tr>
                                <td style="border-right: 1px solid white !important; border-bottom: 1px solid white !important;">College Graduate</td>
                                <td style="border-right: 1px solid white !important;  text-align: center;">
                                    <?php
                                    if ($row['edu'] === 'College Graduate') {
                                    ?>
                                        <i style="text-decoration: none !important;">1</i>
                                </td>
                                <td style="border-right: 1px solid white !important;  text-align: center;">
                                    <i style="text-decoration: none !important;">1</i>
                                <?php } ?>
                                </td>
                            </tr>
                            <tr>
                                <?php
                                if ($row['edu'] === 'Vocational') { ?>
                                    <td style="border-right: 1px solid white !important;">Others:
                                        <i><?php echo $row['edu'] ?></i>
                                    <?php } else { ?>
                                    </td>
                                    <td style="border-right: 1px solid white !important;">Others: _________</td>
                                <?php } ?>
                                <td style="border-right: 1px solid white !important;"></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="6" style="font-weight: 900;">JOB / WORK DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <th style="border-bottom: 1px solid white;">Salary Package</th>
                                <th style="border-bottom: 1px solid white;">Employment Status</th>
                                <th style="border-bottom: 1px solid white;">Work Schedule & Others</th>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;">Basic Salary: &nbsp;&nbsp;&nbsp;<i style="float: right; margin-right: 1rem;"><?php echo $row['basic_salary'] ?></i></td>
                                <td rowspan="6">
                                    <div class="form-check">
                                        <?php
                                        if ($row['employment_stat'] === 'PROJECT BASED') {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Project Based</label>
                                    </div>
                                    <div class="form-check">
                                        <?php
                                        if ($row['employment_stat'] === 'PROBATIONARY') {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Probationary (179 Days)</label>
                                    </div>
                                    <div class="form-check">
                                        <?php
                                        if ($row['employment_stat'] === 'OTHER') {
                                        ?>
                                            <input type="checkbox" name="" id="" class="form-check-input" checked>
                                        <?php } else { ?>
                                            <input type="checkbox" name="" id="" class="form-check-input">
                                        <?php } ?>
                                        <label for="" class="form-check-label">Other: </label>
                                    </div>
                                </td>
                                <td style="border-bottom: 1px solid white;">Salary Schedule: <i style="float: right; margin-right: 1.5rem;"><?php echo $row['salary_sched'] ?></i></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;">Transpo Allowance: <i style="float: right; margin-right: 1.5rem; margin-right: 1.5rem;"><?php echo $row['transpo'] ?></i></td>
                                <td style="border-bottom: 1px solid white;">Work Duration: <i style="float: right; margin-right: 1.5rem;"><?php echo $formattedDate_work_duration_start ?> to <?php echo $formattedDate_work_duration_end ?></i></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;">Meal Allowance: <i style="float: right; margin-right: 1.5rem; "><?php echo $row['meal'] ?></i></td>
                                <td style="border-bottom: 1px solid white;">Work Days: <i style="float: right; margin-right: 1.5rem;"><?php echo $row['work_days'] ?></i></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;">Communication Allowance: <i style="float: right; margin-right: 1.5rem;"><?php echo $row['comm'] ?></i></td>
                                <td style="border-bottom: 1px solid white;">Time Schedule: <i style="float: right; margin-right: 1.5rem;"><?php echo $row['time_sched'] ?></i></td>
                            </tr>
                            <tr>
                                <td style="border-bottom: 1px solid white;">Others: <i style="float: right; margin-right: 1.5rem; margin-right: 1.5rem;"><?php echo $row['other_allow'] ?></i></td>
                                <td style="border-bottom: 1px solid white;">Day-off: <i style="float: right; margin-right: 1.5rem;"><?php echo $row['day_off'] ?></i></td>
                            </tr>
                            <tr>
                                <td></td>
                                <?php
                        $outlet = $row['outlet'];
                        $html = '';
                        if (!empty($outlet)) {
                            $data = json_decode($outlet, true);
                            if (!empty($data['ops'])) {
                                $html = '<ul>';
                                foreach ($data['ops'] as $op) {
                                    if (!empty($op['insert'])) {
                                        $text = trim($op['insert']);
                                        $attributes = isset($op['attributes']) ? $op['attributes'] : []; // Check if 'attributes' key exists
                                        if (!empty($attributes) && isset($attributes['list']) && $attributes['list'] == 'bullet' && !empty($text)) {
                                            $html .= '<li>' . $text . '</li>';
                                        } elseif (!empty($text)) {
                                            $html .= '<li>' . $text . '</li>';
                                        }
                                    }
                                }
                                $html .= '</ul>';
                            }
                        }

                        ?>
                                <td>Outlet: <i><?php echo $html; ?></i></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th colspan="6" class="text-center">SPECIAL REQUIREMENTS (IF ANY) / INSTRUCTIONS / REMARKS / RECOMMENDATIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td rowspan="6">
                                    <p>
                                        <i style="text-decoration: none !important;"><?php echo $row['special_requirements_others'] ?></i>
                                    </p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered" width="100">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="4">REQUISITIONER</th>
                                <th class="text-center">APPROVER</th>
                                <th class="text-center">RECEIVER</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="3">Date Requested: <i style="display: block; text-decoration: none !important;"><?php echo $formattedDate_date_requested ?></i></td>
                                <td rowspan="3" class="text-center" style=" font-weight: bold;">Prepared / Requested By: <br><br><br> <?php echo $row['prepared_by'] ?></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3">Date Needed: <i style="float: right;text-decoration: none !important;"><?php echo $formattedDate_date_needed ?></i></td>
                                <td style="border-top: 1px solid white;"></td>
                                <td style="border-top: 1px solid white;"></td>
                            </tr>
                            <tr>
                                <td colspan="3">Directly Reporting to: <i style="display: block;text-decoration: none !important;"><?php echo $row['drt'] ?></i></td>
                                <td style="border-top: 1px solid white;"></td>
                                <td style="border-top: 1px solid white;"></td>
                            </tr>
                            <tr>
                                <td colspan="3">Position: <i style="display: block;text-decoration: none !important;"><?php echo $row['rp'] ?></i></td>
                                <td style="border-top: 1px solid white;" class="text-center"><i style="color: black !important;">Sig. over Printed Name/Date</i></td>
                                <td class="text-center" style="border-top: 1px solid white;"><i style="color: black !important;">Dept. Head / MGL / FSB</i></td>
                                <td class="text-center" style="border-top: 1px solid white;"><i style="color: black !important;">HR Sig. over printed Name/Date</i></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            // Function to print and close the window after printing
            function printAndClose() {
                window.print();
            }

            // Add an event listener for the onafterprint event
            window.addEventListener("afterprint", function() {
                window.close();
            });

            // Trigger the print function
            printAndClose();

            // Function to handle the cancel action
            window.addEventListener("afterprint", function() {
                // Handle the cancellation of the print dialog here
                // For example, you can navigate back to the previous page:
                window.history.go(-1);
            });
        </script>
    </body>

    </html>
<?php
} else {
    $_SESSION['errorMessage'] = "Hacker ka ba?!";
    header('Location: ../../index.php');
    session_destroy();
    exit();
}
?>
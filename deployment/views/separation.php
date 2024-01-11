<?php
session_start();
include '../../connect.php';
if (isset($_SESSION['username'], $_SESSION['password'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <?php include '../components/header.php'; ?>
        <title>Separation</title>

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
                            <div class="card">
                                <div class="container table-responsive">
                                    <hr>
                                    <div class="title justify-content-center align-items-center mx-auto text-center">
                                        <h4 class="fs-4">
                                            Separation
                                        </h4>
                                    </div>
                                    <hr>
                                    <table class="table table-sm" id="example">
                                        <thead>
                                            <tr>
                                                <th>Date Start</th>
                                                <th>Employee Name</th>
                                                <th>Project Title</th>
                                                <th>Category</th>
                                                <th>Position</th>
                                                <th>Employment Status</th>
                                                <th>Outlet</th>
                                                <th>Type</th>
                                                <th>Reason</th>
                                                <th>Effectivity Date</th>
                                                <th>Process By</th>
                                                <th>File</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM separation";
                                            $result = $link->query($query);
                                            while ($row = mysqli_fetch_assoc($result)) {

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
                                                <tr>
                                                    <td>
                                                        <?php echo $row['date_start'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['employee_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['project_title']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['category']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['position']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['employment_status'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $html; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['type_of_separation'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['reason'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['effectivity_date'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['process_by'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                            $employee_id = $row['employee_id'];
                                                            $deployment_id = $row['deployment_id'];
                                                            $select_folder = "SELECT * FROM folder WHERE employee_id = '$employee_id' AND deployment_id = '$deployment_id'";
                                                            $select_folder_result = $link->query($select_folder);
    
                                                            $get_selected_row = $select_folder_result->fetch_assoc();
                                                            $fileNames = explode(',', $row['files']);
                                                            ?>
                                                            <?php
                                                            foreach ($fileNames as $fileName) {
                                                                echo '<a href="https://jobs.hrdpcnpromopro.com/' . $get_selected_row['folder_path'] . '/' . $fileName . '" download>' . $fileName . '</a><br>';
                                                            }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <div class="contain">
                                                            <div class="column">
                                                                <button type="button" class="btn btn-primary btn-sm btntooltips" data-bs-toggle="modal" data-bs-target="#modal_quitclaim-<?php echo $row['id'];?>" title="Download">
                                                                    <i class="bi bi-folder2"></i>
                                                                </button>
                                                            </div>
                                                            <div class="column">
                                                                <?php 
                                                                    if(!empty($row['date_created']) && !empty($row['amount'])){ 
                                                                ?>
                                                                    <button type="button" class="btn btn-dark btn-sm btntooltips" onclick="location.href = 'download_quit_claim.php?id=<?php echo $row['id'];?>'" title="Download">
                                                                        <i class="bi bi-download"></i>
                                                                    </button>
                                                                    
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <div class="modal fade" id="modal_quitclaim-<?php echo $row['id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <?php 
                                                                        $row['id'];
                                                                        date_default_timezone_set('Asia/Manila');
                                                                        $datenow = date('m-d-Y');
                                                                        $sql = "SELECT * FROM separation WHERE id = '" . $row['id'] . "'";
                                                                        $results = $link->query($sql);
                                                                        $rows = $results->fetch_assoc();
                                                                    ?>
                                                                    <form action="action.php" method="post">
                                                                        <input type="hidden" name="separation_id" value="<?php echo $rows['id'];?>">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Date</label>
                                                                            <input type="text" class="form-control" name="date_now" value="<?php echo $datenow;?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Project</label>
                                                                            <input type="text" class="form-control" value="<?php echo $rows['project_title'];?>" readonly>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="form-label">Amount</label>
                                                                            <input type="text" class="form-control" name="amount" id="numericAmount-<?php echo $row['id'];?>" oninput="updateAmountInWords(<?php echo $row['id'];?>)" required>
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12 mt-3">
                                                                            <input type="hidden" class="form-control" name="amountInWords" id="amountInWords-<?php echo $row['id'];?>" readonly>
                                                                            <p id="amountInWordsParagraph-<?php echo $row['id'];?>"></p>
                                                                        </div>
                                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary" name="quit_claim_btn">Submit</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
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
<script>
    function updateAmountInWords(id) {
        var numericAmount = document.getElementById('numericAmount-' + id).value;
        var amountInWords = convertToWords(numericAmount);
        document.getElementById('amountInWords-' + id).value = amountInWords;
        document.getElementById('amountInWordsParagraph-' + id).textContent = amountInWords;
    }
    function convertToWords(number) {
    var units = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
    var teens = ["Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    var tens = ["Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
    var thousands = ["", "Thousand", "Million", "Billion"];

    number = parseFloat(number);

    if (isNaN(number)) {
        return "Invalid input";
    }

    var dollars = Math.floor(number);
    var cents = Math.round((number - dollars) * 100);

    var dollarsInWords = convertToWordsWithoutCents(dollars);
    var centsInWords = (cents !== 0) ? "and " + convertCentsToWords(cents) : "";

    if (dollars === 0) {
        return centsInWords.trim();
    } else {
        var words = [];
        var segments = dollars.toString().split(/(?=(?:...)*$)/);

        for (var i = 0; i < segments.length; i++) {
            var segmentInWords = convertToWordsWithoutCents(parseInt(segments[i], 10));
            if (segmentInWords !== "") {
                words.push(segmentInWords + " " + thousands[segments.length - 1 - i]);
            }
        }

        return words.join(" ") + " Pesos " + centsInWords.trim();
    }
}


function convertToWordsWithoutCents(number) {
    var units = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
    var teens = ["Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    var tens = ["Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

    var words = "";

    if (number >= 100) {
        words += units[Math.floor(number / 100)] + " Hundred ";
        number %= 100;
    }

    if (number >= 11 && number <= 19) {
        words += teens[number - 11] + " ";
    } else if (number === 10 || number >= 20) {
        words += tens[Math.floor(number / 10) - 1] + " "; // Corrected index
        number %= 10;
    }

    if (number >= 1 && number <= 9) {
        words += units[number] + " ";
    }

    return words;
}

function convertCentsToWords(cents) {
    var units = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine"];
    var teens = ["Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", "Nineteen"];
    var tens = ["Ten", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

    var words = "";

    if (cents > 0) {
        if (cents >= 11 && cents <= 19) {
            words += teens[cents - 11] + " ";
        } else if (cents >= 10) {
            words += tens[Math.floor(cents / 10) - 1] + " ";
            var remainder = cents % 10;
            if (remainder > 0) {
                words += units[remainder] + " Cents";
            } else {
                words += "Cents";
            }
        } else {
            words += units[cents] + " Cents";
        }
    }

    return words.trim();
}






</script>

        <?php include '../components/footer.php'; ?>
    </body>

    </html>
<?php
} else {
    header("Location: ../../logout.php");
    session_destroy();
    exit(0);
}
?>
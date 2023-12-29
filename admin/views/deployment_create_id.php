<?php
session_start();
include '../../connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../components/header.php'; ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/konva@8.3.5/konva.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>


    <title>Document</title>

    <style>
    .content-wrapper1
    {   width: 85% !important;
        display: flex;
        align-items: stretch;
        flex: 1 1 auto;
        flex-direction: column;
        justify-content: none !important;
    }
    .container1
    {
        --bs-gutter-x: 0 !important;
    --bs-gutter-y: 0;
    width: 928px ;
    height: 614px;
    padding-right: calc(var(--bs-gutter-x) * .5);
    padding-left: calc(var(--bs-gutter-x) * .5);
    margin-right: auto;
    margin-left: auto;
    }
       
        .name {
            position: sticky;
            margin-top: -22.8rem !important;
            padding-top: 10px;
            margin-left: 2.1rem;
            background-color: transparent;
            width: 410px;
            text-align: center;
            box-shadow: none !important;
        }

        .position {
            position: sticky;
            margin-top: 1.5rem !important;
            padding-top: 10px;
            margin-left: 2.1rem;
            background-color: transparent;
            width: 410px;
            text-align: center;
            box-shadow: none !important;
        }

        .id_no {
            position: sticky;
            margin-top: -20px !important;
            padding-top: 15px;
            margin-left: 1.9rem;
            background-color: transparent;
            width: 190px;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }
        

        .date_end {
            position: sticky;
            margin-top: -3rem !important;
            padding-top: 13px;
            margin-left: 16rem;
            background-color: transparent;
            width: 190px;
            text-align: center;
            box-shadow: none !important;
        }

        .contact_person {
            width: 263px;
            height: 50px;
            margin: 0px 160px;
            padding: 10px 7px 0px 0px;
            text-align: center;
            position: sticky;
            margin-top: -38rem !important;
            /* padding-top: 5px;
            margin-left: 10px; */
            background-color: transparent;
            /* width: 280px;
            height: 50px;
            text-align: center; */
            box-shadow: none !important;
        }

        .contact_address {
            
            position: sticky;
            margin-top: 1rem !important;
            margin: 0px 30px;
            padding: 0px 0px 0px 0px;
            background-color: transparent;
            width: 370px;
            height: 90px;
            text-align: center;
            box-shadow: none !important;
        }

        .contact_number {
            position: sticky;
            margin-top: 0rem !important;
            margin: 0px 120px;
            padding: 15px 30px 0px 0px;
            background-color: transparent;
            width: 320px;
            height: 55px;
            text-align: center;
            box-shadow: none !important;
        }

        .sss {
            position: sticky;
            
            margin: 0px 120px;
            padding: 7px 10px 0px 0px;
            background-color: transparent;
            width: 320px;
            height: 50px;
            text-align: left;
            box-shadow: none !important;
        }

        .philhealth {
            position: sticky;
            margin: 0px 155px;
            padding: 14px 10px 0px 0px;
            background-color: transparent;
            width: 320px;
            height: 50px;
            text-align: left;
            box-shadow: none !important;
        }

        .tin {
            position: sticky;
            margin: 0px 120px;
            padding: 12px 10px 0px 0px;
            background-color: transparent;
            width: 320px;
            height: 50px;
            text-align: left;
            box-shadow: none !important;
        }

        .hdmf {
            position: sticky;
            margin: 0px 120px;
            padding: 18px 10px 0px 0px;
            background-color: transparent;
            width: 320px;
            height: 50px;
            text-align: left;
            box-shadow: none !important;
        }

        .birthday {
            position: sticky;
            margin: 0px 120px;
            padding: 25px 10px 0px 0px;
            background-color: transparent;
            width: 300px;
            height: 55px;
            text-align: left;
            box-shadow: none !important;
        }

        .name h2,
        .position h2,
        .id_no h2,
        .contact_number h2,
        .sss h2,
        .tin h2,
        .philhealth h2,
        .hdmf h2,
        .date_end h2 {
            font-size: 24px;
            text-transform: uppercase;
            font-weight: bold;
            font-family: 'Arial', sans-serif !important;
            color: black !important;
        }

        .contact_person h2,
        .contact_address h2,
        .birthday h2 {
            text-transform: uppercase;
            font-weight: bold;
            font-style: italic;
            font-size: 20px;
            margin-top: -4px;
            color: black !important;
        }

        #photo #photoko {
            z-index: 1;
            position: sticky;
            margin-top: -37.3rem;
            margin-left: 8rem;
            width: 203px;
            height: 207px !important;
            background: transparent;
        }

        #photoregular #photoko {
            z-index: 1;
            position: sticky;
            margin-top: -18.1rem;
            margin-left: 8.5rem;
            width: 202px;
            height: 208px !important;
            background: transparent;
        }

        .id_no_regular {
            position: sticky;
            margin-top: -20px !important;
            padding-top: 15px;
            margin-left: 1.9rem;
            background-color: transparent;
            
            width: 410px;
            height: 50px;
            text-align: center;
            box-shadow: none !important;
        }

        .id_no_regular h2 {
            font-weight: bold;
            font-size: 24px;
            font-family: 'Arial', sans-serif !important;
            color: black !important;
        }

        .konvajs-content
        {
            style="position: relative; 
            user-select: none; 
            width: 0px !important; 
            height: 140px !important;
        }

        /* .canvas {

        width: 0px !important; 
        height: 0px !important; 
        padding: 0px !important; 
        margin: 0px !important; 
        border: 0px !important;  
        background: transparent !important;  
        position: absolute !important;  
        top: 0px !important;  
        left: 0px !important;  
       
        display: block !important; 
       
    } */
    </style>
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
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="form-group row">
                                <div class="row mt-3 mb-3 mx-3">
                                    <div class="col-md-6">
                                        <input type="search" name="search_id" placeholder="Search..." id="search" class="form-control" required>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="submit" name="search" class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </form>
                            <div class="justify-content-end align-items-end mb-5 mt-3" style="margin-left: 1rem;">
                                <button class="btn btn-dark" id="download">Print ID Card</button>
                            </div>
                            <div class="image justify-content-center align-items-center mx-auto" id="image">
                                <?php
                                if (isset($_POST['search'])) {
                                    $search_id = $link->real_escape_string($_POST['search_id']);
                                    $html = '';

                                    // Query for Regular Employees
                                    $query = "SELECT * FROM deployment WHERE emp_id LIKE '%" . $search_id . "' AND id_remarks <> ''";
                                    $result = $link->query($query);

                                    if ($result->num_rows > 0) {
                                        $html .= "";
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['employee_id'];

                                            $fetch_employee = "SELECT * FROM employees WHERE id = '$id'";
                                            $fetch_result = $link->query($fetch_employee);
                                            while ($fetch_row = $fetch_result->fetch_assoc()) {
                                                if (empty($fetch_row['mnko']) || $fetch_row['mnko'] === "NA" || $fetch_row['mnko'] === "N/A") {
                                                    $name = chop($fetch_row['firstnameko'] . " " . $fetch_row['lastnameko']. " " .$fetch_row['extnname']);
                                                }
                                                else if (empty($fetch_row['extnname']) || $fetch_row['extnname'] === "NA" || $fetch_row['extnname'] === "N/A") 
                                                {
                                                    $name = chop($fetch_row['firstnameko'] . " " . $fetch_row['mnko'] . " " . $fetch_row['lastnameko']) ;
                                                } 
                                                else if (empty($fetch_row['mnko']) || $fetch_row['mnko'] === "NA" || $fetch_row['mnko'] === "N/A" AND empty($fetch_row['extnname']) || $fetch_row['extnname'] === "NA" || $fetch_row['extnname'] === "N/A") 
                                                {
                                                    $name = chop($fetch_row['firstnameko'] . " " . $fetch_row['lastnameko']) ;
                                                }
                                                else 
                                                {
                                                    $name = chop($fetch_row['firstnameko'] . " " . $fetch_row['mnko'] . " " . $fetch_row['lastnameko'] . " " .$fetch_row['extnname']) ;
                                                }

                                                $sign=$fetch_row['signature'];
                                                $position = $row['job_title'];
                                                $id_no = $row['emp_id'];
                                                $type = $row['type'];
                                                $end_date = $row['loa_end_date'];
                                                // $end_date1 = str_replace('-', '/', $end_date);
                                                $timestamp_end_date = strtotime($end_date);
                                                $formattedDate_end = date("m/d/Y", $timestamp_end_date);
                                                $contact_person = $fetch_row['e_person'];
                                                $address = $fetch_row['e_address'];
                                                $contact_number = $fetch_row['e_number'];
                                                $sss = $row['sss'];
                                                $philhealth = $row['philhealth'];
                                                $pagibig = $row['pagibig'];
                                                $tin = $row['tin'];
                                                $birthday = $fetch_row['birthday'];
                                                $timestamp_birthday = strtotime($birthday);
                                                $formattedDate_birthday = date("F d, Y", $timestamp_birthday);

                                                if ($row['employment_status'] === "REGULAR" || $row['employment_status'] === "Regular" || $row['employment_status'] === "regular") {

                                ?>          <div class="container1">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                    <img src="../assets/img/elements/IDRegular2.png" alt="ID" class="img-responsive">
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                    <div class="card name">
                                                        <h2><?php echo $name ?></h2>
                                                    </div>
                                                    <div class="card" id="photoregular">
                                                        <img src="<?php echo $fetch_row['photopath'] ?>" id="photoko" alt="">
                                                    </div>
                                                    <div class="card position">
                                                        <h2><?php echo $position ?></h2>
                                                    </div>
                                                    <div id='logo'></div>
                                                    <div class="card id_no_regular">
                                                        <h2><?php echo $id_no ?></h2>
                                                    </div>
                                                 </div>
                                                <div class="col-sm-6">   
                                                    <div class="card contact_person">
                                                        <h2><?php echo $contact_person ?></h2>
                                                    </div>
                                                    <div class="card contact_address">
                                                        <h2>&emsp;&emsp;&emsp;<?php echo $address ?></h2>
                                                    </div>
                                                    <div class="card contact_number">
                                                        <h2><?php echo $contact_number ?></h2>
                                                    </div>
                                                    <div class="card sss">
                                                        <h2><?php echo $sss ?></h2>
                                                    </div>
                                                    <div class="card tin">
                                                        <h2><?php echo $tin ?></h2>
                                                    </div>
                                                    <div class="card philhealth">
                                                        <h2><?php echo $philhealth ?></h2>
                                                    </div>
                                                    <div class="card hdmf">
                                                        <h2><?php echo $pagibig ?></h2>
                                                    </div>
                                                    <div class="card birthday">
                                                        <h2><?php echo $formattedDate_birthday ?></h2>
                                                    </div>

                                                </div>
                                             </div>
                                        </div>
                                                    <div class="caption">
                                                    <input type="hidden" id="caption-input" value="<?php echo $id_no . '-' . $name . '-' .$type ?>-PCN ID">
                                                    </div>
                                                    <br><br><br><br><br><br>
                                                <?php

                                                } else { ?>
                                                    
                                                    <div class="container1">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <img src="../assets/img/elements/PCNBG2.png" alt="ID" class="img-responsive">
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <!-- Left Column -->
                                                            <div class="card" id="photo">
                                                                <img src="<?php echo $fetch_row['photopath'] ?>" id="photoko" alt="">
                                                            </div>
                                                            <div class="card name">
                                                                <h2><?php echo $name ?></h2>
                                                            </div>
                                                            <div class="card position">
                                                                <h2><?php echo $position ?></h2>
                                                            </div>
                                                            <div id='logo'></div>
                                                            <div class="card id_no">
                                                                <h2><?php echo $id_no ?></h2>
                                                            </div>
                                                            <div class="card date_end">
                                                                <h2><?php echo $formattedDate_end ?></h2>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <!-- Right Column -->
                                                            <div class="card contact_person">
                                                                <h2><?php echo $contact_person ?></h2>
                                                            </div>
                                                            <div class="card contact_address">
                                                                <h2>&emsp;&emsp;&emsp;<?php echo $address ?></h2>
                                                            </div>
                                                            <div class="card contact_number">
                                                                <h2><?php echo $contact_number ?></h2>
                                                            </div>
                                                            <div class="card sss">
                                                                <h2><?php echo $sss ?></h2>
                                                            </div>
                                                            <div class="card tin">
                                                                <h2><?php echo $tin ?></h2>
                                                            </div>
                                                            <div class="card philhealth">
                                                                <h2><?php echo $philhealth ?></h2>
                                                            </div>
                                                            <div class="card hdmf">
                                                                <h2><?php echo $pagibig ?></h2>
                                                            </div>
                                                            <div class="card birthday">
                                                                <h2><?php echo $formattedDate_birthday ?></h2>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
       
                                                <div class="caption">
                                                    <input type="hidden" id="caption-input" value="<?php echo $id_no . '-' . $name . '-' .$type ?>-PCN ID">
                                                    </div>
                                                    <br><br><br><br><br><br>
                                <?php }
                                            }
                                        }
                                    } else {
                                        echo "No record found";
                                        exit(0);
                                    }
                                }
                                ?>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#download").on('click', function() {
                var element = document.getElementById("image");
                var caption = $('#caption-input').val();

                html2canvas(element).then(function(canvas) {
                    var imageData = canvas.toDataURL("image/png");
                    var newData = imageData.replace(/^data:image\/png/, "data:application/octet-stream");

                    var downloadLink = document.createElement('a');
                    downloadLink.href = newData;
                    downloadLink.download = caption + '.png';
                    downloadLink.click();
                });
            });
        });
    </script>
    <script>
      var width = window.innerWidth;
      var height = window.innerHeight;

      var stage = new Konva.Stage({
        container: 'logo',
        width: width,
        height: height,
      });

      var layer = new Konva.Layer();
      stage.add(layer);

      var rect1 = new Konva.Image({
        x: 140, //position of image
        y: 24,   //position of image
        width: 200, //size of image
        height: 80, //size of image
        
        name: 'rect',
        draggable: true,
      });
      layer.add(rect1);

      var imageObj1 = new Image();
      imageObj1.onload = function () {
        rect1.image(imageObj1);
        };
      imageObj1.src ='<?php echo $sign ?>';

      var tr = new Konva.Transformer();
      layer.add(tr);

      // by default select all shapes
     // tr.nodes([rect1]);

      // add a new feature, lets add ability to draw selection rectangle
      var selectionRectangle = new Konva.Rect({
        fill: 'rgba(0,0,255,0.5)',
        visible: false,
      });
      layer.add(selectionRectangle);

      var x1, y1, x2, y2;
      stage.on('mousedown touchstart', (e) => {
        // do nothing if we mousedown on any shape
        if (e.target !== stage) {
          return;
        }
        e.evt.preventDefault();
        x1 = stage.getPointerPosition().x;
        y1 = stage.getPointerPosition().y;
        x2 = stage.getPointerPosition().x;
        y2 = stage.getPointerPosition().y;

        selectionRectangle.visible(true);
        selectionRectangle.width(0);
        selectionRectangle.height(0);
      });

      stage.on('mousemove touchmove', (e) => {
        // do nothing if we didn't start selection
        if (!selectionRectangle.visible()) {
          return;
        }
        e.evt.preventDefault();
        x2 = stage.getPointerPosition().x;
        y2 = stage.getPointerPosition().y;

        selectionRectangle.setAttrs({
          x: Math.min(x1, x2),
          y: Math.min(y1, y2),
          width: Math.abs(x2 - x1),
          height: Math.abs(y2 - y1),
        });
      });

      stage.on('mouseup touchend', (e) => {
        // do nothing if we didn't start selection
        if (!selectionRectangle.visible()) {
          return;
        }
        e.evt.preventDefault();
        // update visibility in timeout, so we can check it in click event
        setTimeout(() => {
          selectionRectangle.visible(false);
        });

        var shapes = stage.find('.rect');
        var box = selectionRectangle.getClientRect();
        var selected = shapes.filter((shape) =>
          Konva.Util.haveIntersection(box, shape.getClientRect())
        );
        tr.nodes(selected);
      });

      // clicks should select/deselect shapes
      stage.on('click tap', function (e) {
        // if we are selecting with rect, do nothing
        if (selectionRectangle.visible()) {
          return;
        }

        // if click on empty area - remove all selections
        if (e.target === stage) {
          tr.nodes([]);
          return;
        }

        // do nothing if clicked NOT on our rectangles
        if (!e.target.hasName('rect')) {
          return;
        }

        // do we pressed shift or ctrl?
        const metaPressed = e.evt.shiftKey || e.evt.ctrlKey || e.evt.metaKey;
        const isSelected = tr.nodes().indexOf(e.target) >= 0;

        if (!metaPressed && !isSelected) {
          // if no key pressed and the node is not selected
          // select just one
          tr.nodes([e.target]);
        } else if (metaPressed && isSelected) {
          // if we pressed keys and node was selected
          // we need to remove it from selection:
          const nodes = tr.nodes().slice(); // use slice to have new copy of array
          // remove node from array
          nodes.splice(nodes.indexOf(e.target), 1);
          tr.nodes(nodes);
        } else if (metaPressed && !isSelected) {
          // add the node into selection
          const nodes = tr.nodes().concat([e.target]);
          tr.nodes(nodes);
        }
      });
    </script>



    <?php
    include '../components/footer.php';
    ?>

</body>

</html>
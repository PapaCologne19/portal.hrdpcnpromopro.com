<?php

include ("connect.php");


    $resultrg4 =mysqli_query($link, "SELECT * FROM department where division ='".$_POST['city_code']."' ");
          while($rowrg4=mysqli_fetch_array($resultrg4))
         {

         $array[] = array("city_name" => $rowrg4['1']);
         //echo '<option  value="'.$rowrg[2].'">'.$rowrg[2].' </option> ';
         
         }
         
         echo json_encode($array);

?>
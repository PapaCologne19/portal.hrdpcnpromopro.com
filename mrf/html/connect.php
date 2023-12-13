<?php
ini_set('default_charset', 'utf-8');
    $db_user = "pcnadmin";
    $db_password = "@Pcn123456789#";
    $db_host = "localhost";
    $db_database = "pcnpromopro_pcnhrs";

    $link = mysqli_connect($db_host, $db_user, $db_password, $db_database) or die("Connection Failure" . $link->error);

    // Check connection
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }

    mysqli_set_charset($link, "utf8");


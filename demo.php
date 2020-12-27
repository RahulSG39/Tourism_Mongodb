<?php
    require 'vendor/autoload.php';
    
    $client = new MongoDB\Client;

    $companydb = $client->test123;

    $col = $companydb->col;

    foreach($col->find() as $collections){
            echo $collections["emp_name"]."<br>";
    }
?>
<!-- Connection to Database -->

<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client;    
    $tour = $client->tour;
?>
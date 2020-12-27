<?php
//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne;
    use MongoDB\Operation\FindOne;
    session_start();
    require_once './INCLUDES/dbconnect.php';

//-------- Initializing Session and Get variables ------//

    // $email = $_SESSION["email"];
    $booking = $tour->packages;

    $g = [
        ['$match' => ['packageName' => 'Manali Trip']],
        ['$group' => ['_id' => ['UserEmail' => '$packageName'], 'count' => ['$sum' => 1]]]
    ];

    
    $results = $booking->aggregate($g);
    foreach ($results as $row) {
        print_r($row->_id->UserEmail); 
        echo "Count = ";
        print_r($row->count);
        echo "<br>";
    }

?>
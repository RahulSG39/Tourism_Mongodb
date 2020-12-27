<?php
//------------ Setting up all the imports ---------------//

    session_start();
    require_once './INCLUDES/dbconnect.php';

//-------- Initializing Session and Get variables ------//

    $id_name = $_GET['id_name'];
    $email = $_SESSION["email"];

//-----------------------------------------------------//

    $booking = $tour->Booking;

//------------ Deleting single records ---------------//

    $query = $booking->deleteOne(['package' => $id_name, 'UserEmail' => $email]);

    header('Location: show_pack.php');

//---------------------------------------------------//

?>
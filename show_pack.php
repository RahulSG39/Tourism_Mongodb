<?php
//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne;
    use MongoDB\Operation\FindOne;
    session_start();
    require_once './INCLUDES/dbconnect.php';

//-------- Initializing Session and Get variables ------//

    $email = $_SESSION["email"];
    $booking = $tour->Booking;

//-----------------------------------------------------//
    
    $set = 0; //Ignore, used as flag to check for insertion of deletion
    
    if (empty($booking->find())) {
        $set = 1;
    }
   
    $tours = array(); // Array to keep track of cart items
    
    foreach($booking->find() as $pack){        
        if($pack->UserEmail === $email){ 
            array_push($tours, $pack->package);
        }
    }
    $tours = array_unique($tours);

//----------- Controller for logout -------------------//

    if (isset($_POST["logout"])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }

//----------------------------------------------------//

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'INCLUDES/header.php';?>
   <h1 class="first-head">Cart</h1>
    <?php if ($set == 1) {
    echo "<p style='color: white; background-color: gray ;padding: 40px; width: 60%; margin: auto; text-align: center; font-size: 1.5rem;'>Cart Empty</p>";
}
?>
    <link rel="stylesheet" href="CSS/show_pack.css" />
    <?php
foreach ($tours as $tour) {?>
        <div class="package">
            <div class="card">
            <form action="" method="POST">
                <?php echo $tour; ?>
                <a href="delete.php?id_name=<?php echo $tour; ?>"><i class="fa fa-times"></i></a>
            </form>
            </div>
        </div>
    <?php }?>


    <form action="" method="POST">
        <input type="submit" name="logout" id="" value="Logout" />
    </form>
</body>
</html>
<?php
//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne;
    require_once './INCLUDES/dbconnect.php';
    session_start();

//-------- Initializing Session and Get variables ------//

    $email = $_SESSION["email"];
    $pid = intval($_GET['pkgid']);

//------------------------------------------------------//

    $allPackages = $tour->packages;
    $packages = $allPackages->find(); //converting $allPackages object into array

//------- Extracting data from collection using id -------//

    foreach($packages as $package){
        if($package->packageId == $pid){
            $package_name = $package->packageName;
            $package_price = $package->packagePrice;
            $package_details = $package->packageDetails;
            $package_image = $package->packageImage;
            $package_date = $package->packageDate;
            $end_date = $package->endDate;
        }
    }
    
// --------------------------------------------------------- //    

    $set = 0; // Ignore, used as a flag variable to check for insertion

// ------------ Checking for booking submission --------------//    

    if (isset($_POST['sub'])) {
        $booking = $tour->Booking;
        $query = $booking->insertOne([ 'UserEmail' => $email, 'package' => $package_name]);
        $set = 1;
    }

// -------------------- Directing to cart ----------------------//

    if (isset($_POST['sub2'])) {
        header('Location: show_pack.php');
    }

// ------------------------------------------------------------//
?>

<!DOCTYPE html>
<html lang="en">
    <?php include './includes/header.php';?>
    <link rel="stylesheet" href="CSS/package.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <?php if ($set == 1) {?>
        <p style="background-color: lightgreen; padding: 10px;"><i class="fa fa-check"></i>Added Successfully</p>
    <?php }?>
    <div class="container1">
        <form method="POST">
            <h1><?php echo $package_name; ?></h1>
            <div class="card-img">
                <img src=<?php echo $package_image; ?> width='475' height='400' />
            </div>
            <h4>About The Place</h4>
            <p><?php echo $package_details; ?></p>
            <h2><span class="price-font">Price:</span><i class="fas fa-rupee-sign"></i><span class="price"><?php echo number_format($package_price)."<br><br><br>";
                                                                                                            echo "Duration:  ".$package_date->toDateTime()->format('d F Y')." - ".$end_date->toDateTime()->format('d F Y');
                                                                                                            ?></span></h2>
            <div class="btns">
                <input type="submit" name="sub" id="" value="Book Now" />
                <input type="submit" name="sub2" id="" value="Go To Cart" />
            </div>
        </form>
    </div>

</body>
</html>
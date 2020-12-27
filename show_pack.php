<?php
//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne;
    use MongoDB\Operation\FindOne;
    session_start();
    require_once './INCLUDES/dbconnect.php';
    require('config.php');

//-------- Initializing Session and Get variables ------//

    $email = $_SESSION["email"];
    $name =  $_SESSION["name"];
    $booking = $tour->Booking;
    $allPackages = $tour->packages;
    $packages = $allPackages->find();
    $packages = iterator_to_array($packages);
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


//-------------- Stripe Payment Gateway -----------------//

    if(isset($_POST['stripeToken'])){
        \Stripe\Stripe::setVerifySslCerts(false);
    
        $token=$_POST['stripeToken'];
        $overall = $_SESSION['total'] * 100;
        $data=\Stripe\Charge::create(array(
            "amount"=>$overall,
            "currency"=>"inr",
            "description"=>"Simple Tour Project By Rahul",
            "source"=>$token,
        ));
    }

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
<?php include 'INCLUDES/header.php'; ?>
   <h1 class="first-head">Cart</h1>
    <?php if ($set == 1) {
        echo "<p style='color: white; background-color: gray ;padding: 40px; width: 60%; margin: auto; text-align: center; font-size: 1.5rem;'>Cart Empty</p>";
    }
?>
    <link rel="stylesheet" href="CSS/show_pack.css" />
    <?php
    $total = 0;
    foreach ($tours as $tour) {
        foreach($packages as $package){
            if($package->packageName == $tour){ 
                $total += $package->packagePrice;
    ?>
                <div class="package">
                    <div class="card">
                    <form class="show_form" method="POST">
                        <span class="tour_name"><a href="package.php?pkgid=<?php echo $package->packageId;?>"><?php echo $tour;?></a></span>
                        <span class="price"><i class="fas fa-rupee-sign"></i><?php echo number_format($package->packagePrice); ?></span>
                        <a class="delete" href="delete.php?id_name=<?php echo $tour; ?>"><i class="fa fa-times"></i></a>
                    </form>
                    </div>
                </div>
    <?php 
    } } }
    $_SESSION["total"] = $total; 
    ?>

    <span class="total"><h1 class="spanh1">Total: <i class="fas fa-rupee-sign"></i><?php echo number_format($total);?></h1></span>

    <div class="buttons">
        <form  method="POST" class="payment">
            <script
            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="<?php echo $publishableKey; ?>"
            data-amount="<?php echo $total*100;?>"
            data-name=<?php echo $name; ?>
            data-description="Tourism Management System"
            data-image="https://www.logostack.com/wp-content/uploads/designers/eclipse42/small-panda-01-600x420.jpg"
            data-currency="inr"
            data-email=<?php echo $email; ?>
            >
            </script>    
        </form>

        <form action="" method="POST" class="logoutform">
            <input type="submit" name="logout" value="Logout" class="logout">
        </form>
    </div>
    
</body>
</html>
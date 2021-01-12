<?php

//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne; 
    session_start();
    require_once './INCLUDES/dbconnect.php';

//------------ Connecting to packages Collection-----------//

    $allPackages = $tour->packages;
    $packages = $allPackages->find(); // Used to convert object into an array

//----------------- Search Feature ---------------------//

    if(isset($_POST['search'])){

        $search_text = $_POST['search_text'];

        $search_packages = [
            ['$match' => ['packageName' => $search_text]],
        ];    

        $results = $allPackages->aggregate($search_packages);
        
        if(!empty($search_text)){
            $packages = $results;
        }
    }

// --------------------------------------------------------//    
?>


<!DOCTYPE html>
<html lang="en">
<?php include('./includes/header.php'); ?>
    <link rel="stylesheet" href="CSS/packages.css" />

    <form method="POST">
        <div class="search-container">
            <input type="text" name="search_text" placeholder="Search Packages...">
            <input type="submit" name="search" value="Search">
            <input type="reset" value="Clear">
        </div>
    </form>

    <?php foreach($packages as $package){ ?>
        <div class="package">
            <div class="card">
                <div class="card-img">
                    <img src=<?php 
                    echo $package->packageImage; 
                    ?> width='475' height='400' />
                </div>
                <div class="right-div">
                    <h1><?php echo $package->packageName; ?></h1>
                    <a href="package.php?pkgid=<?php echo $package->packageId; ?>">Click for more info!</a>
                </div>
            </div>         
        </div>
    <?php } ?>
    <?php
        if(empty($package->packageName)){
            ?>
            <h1 style="color: white; margin-left: 40%;margin-top: 50px;">Nothing to show</h1> 
        <?php
        }
    ?>
</body>
</html> 

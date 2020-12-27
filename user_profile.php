<?php
    require_once './INCLUDES/dbconnect.php';
    session_start();
    $name = $_SESSION["name"];
?>

<!DOCTYPE html>
<html lang="en">
    <?php include './includes/header.php';?>
    <form action="" method="POST">
        <div class="container">
            <h1><?php echo $name; ?></h1>
            
        </div>

    </form>

</body>
</html>
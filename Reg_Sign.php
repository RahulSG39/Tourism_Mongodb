<?php
//------------ Setting up all the imports ---------------//

    use MongoDB\Operation\InsertOne;
    require_once './INCLUDES/dbconnect.php';
    session_start();

//------------------------Global Variables-------------------------//

    $email = $name = $uname = $password = '';
    $errors = array('email' => '', 'name' => '', 'password' => '', 'confirm_password' => '');
    $set = 0;

//------------- Connecting to the users Collection ---------------//

    $users = $tour->users;

//------------------------Registration-----------------------------//

if (isset($_POST['reg'])) {

    $password = $_POST['password'];
    $email = $_POST['email'];

//---------------- Checking and matching EmailID -----------------//    

    $doc1 = $users->findOne(['EmailID' => $email]);

    if (!empty($doc1)) {
        $errors['email'] = "Email id already exists.";
    } else {
        if (empty($_POST['email'])) {
            $errors['email'] = 'An email is required';
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email must be a valid email address';
            }
        }
    }

//---------------- Checking and matching Name -----------------//    

    if (empty($_POST['name'])) {
        $errors['name'] = 'A name is required';
    } else {
        $name = $_POST['name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
            $errors['name'] = 'Name must be letters and spaces only';
        }
    }

//---------------- Checking and matching Password -----------------//    

    if (empty($_POST['password'] || $_POST['password'])) {
        $errors['password'] = 'A password is required';
    } else {
        $password = $_POST['password'];
        if (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{6,12}$/', $password)) {
            $errors['password'] = 'the password does not meet the requirements!';
        }
    }

    if (empty($_POST['confirm_password'])) {
        $errors['confirm_password'] = 'A password is required';
    } else {
        $confirm_password = $_POST['confirm_password'];
        if ($confirm_password != $password) {
            $errors['confirm_password'] = 'Passwords do not match';
        }
    }

//-------- Checking for errors from the errors array ---------//

    if (array_filter($errors)) {
        echo 'errors in form'; // If in case of errors, throw
    } else {

        // ----------- Mail Functionality ------------ //

        $to_email = $email;
        $subject = "Simple Email Test via PHP";
        $body = "Hi, Welcome $name ! This is a simple project to showcase the functionalities of MongoDB and PHP. :) Enjoy!";
        $headers = "From: rahulgirish39@gmail.com";

        if (mail($to_email, $subject, $body, $headers)) {
        ?>
            <script>
                alert("A mail has been sent to <?php echo $to_email; ?>...");
            </script>

        <?php

        } else {
            echo "Email sending failed...";
        }

        //------------- Insertion if no errors ----------------//

        $document = $users->InsertOne(
            ["FullName" => $name, "EmailID" => $email, "Password" => $password]
        );

        //------------ Showing confirmatin of order ---------------//

        if ($document) {
            echo "<p style='background-color: lightgreen; padding: 10px;'>Success! Please login</p>";
        } else {
            echo "Error";
        }
    }

}

//---------------------------SignUp-------------------------------//

if (isset($_POST['sign_in'])) {

    $login_email = $_POST['login_email'];
    $login_password = $_POST['login_password'];

    $doc2 = $users->findOne(['EmailID' => $login_email,'Password' => $login_password]);

    if (!empty($doc2)) {
        $_SESSION["email"] = $_POST["login_email"];
        header('Location: packages.php');
    } else {
        $set = 1; //Ignore, used as a flag varibale to know insertion
    }

// -------------------------------------------------------------------------//

}

?>

<!DOCTYPE html>
<html>
    <?php include './INCLUDES/header.php';?>
    <?php if ($set == 1) {
    echo "<p style='background-color: #CD5C5C; padding: 10px;'>Invalid Credentials, Try again!</p>";
}?>
    <link rel="stylesheet" href="./CSS/Reg_Sign.css" />
        <div class="form-wrap">
            <div class="btns">
                <div class="btns-style">
                    <button class="reg-page-btn" onclick="signup()">Sign Up</button>
                    <button class="signin-page-btn" onclick="login()">Log in</button>
                </div>
            </div>
      <form method="POST">
        <div id="reg" class="reg">
          <h1>Register</h1>
          <input type="text" placeholder="Name" name="name"/><?php echo $errors['name'] ?>
          <input type="email" placeholder="Email" name="email" /><?php echo $errors['email'] ?>
          <input type="password" placeholder="Password" name="password" /><?php echo $errors['password'] ?>
          <input type="password" placeholder="Confirm Password" name="confirm_password"/><?php echo $errors['confirm_password'] ?>
          <input type="submit" class="reg-btn" value="Sign Up" name="reg"/>
        </div>
        <div id="login" class="login">
          <h1>Login</h1>
          <input type="email" placeholder="Email" name="login_email" />
          <input type="password" placeholder="Password" name="login_password"/>
          <input type="submit" class="signin-btn" name="sign_in" value="Sign in"/>
        </div>
      </form>

    </div>

    <script>
        var x = document.getElementById("reg");
        var y = document.getElementById("login");

        function signup(event){
            this.event.preventDefault();
            y.style.display = "none";
            x.style.display = "block";
        }
        function login(event){
            this.event.preventDefault();
            x.style.display = "none";
            y.style.borderLeft = "none";
            y.style.display = "block";
        }
    </script>
  </body>
</html>

<?php
require('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics | Log In</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php

    $email = $pswd = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $pswd = $_POST['password'];

        $sel="SELECT * from users where email='$email' AND password='$pswd'";
        $result=mysqli_query($connection,$sel);
        $rows=mysqli_num_rows($result);

        if($rows==1){
            session_start();
            $_SESSION["email"]=$email;
            $_SESSION["loggedin"]=true;
            header("location:home.php");
        }else{
            header("location:login.php?Incorrect Credentials!");
        }
    }
    ?>
    <div class="container">
        <div class="inner">
            Sign Up to receive amazing comics! :)
        </div>
        <div class="form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms" name="forms">
                <div class="qs">
                    <?php echo str_replace('%20', ' ', $_SERVER["QUERY_STRING"]); ?>
                </div>
                <label for="email">Enter Your Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter email address" required>
                <label for="password">Enter Your Password</label>
                <input type="password" name="password" id="password" placeholder="Enter Password">
                <input type="hidden" name="subsc" value="1">
                <input type="submit" value="Sign Up" class="btn">
            </form>
        </div>
    </div>
</body>

</html>
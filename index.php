<?php
require('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics | Sign Up</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php

    $emailErr = $email = $subscribed = $pswd = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = $_POST['email'];
        $pswd = $_POST['password'];
        $subscribed = $_POST['subsc'];

        if (empty($_POST["email"])) {
            $emailErr = "Email is required";
        } else {
            // check if e-mail address is well-formed
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            } else {
                $emailErr = "";
            }
        }
        if ($emailErr === "") {
            $sel = 'SELECT email from users where email="' . $email . '"';
            $result = mysqli_query($connection, $sel);
            $rows = mysqli_num_rows($result);

            if ($rows == 1) {
                header("location:index.php?User Already Exists!");
            } else {
                $chars = "0123456789";
                $charslen = strlen($chars);
                $pin = "";
                for ($i = 0; $i < 6; $i++) {
                    $code .= $chars[rand(0, $charslen - 1)];
                }
                $pin = $code;
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $headers .= 'From: <webmaster@example.com>' . "\r\n";
                
                if (mail($email, "Email verification for comics", "Email Verification code: ".$pin, $headers)) {
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["password"] = $pswd;
                    $_SESSION["subscd"] = $subscribed;
                    $_SESSION["otp"] = $pin;
                    header("location:verify.php");
                } else {
                    header("location:index.php?Something went wrong!");
                }
            }
        }
    }
    ?>
    <div class="container">
        <div class="inner">
            Sign Up to receive amazing comics! :)
        </div>
        <div class="form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms" name="forms">
                <div class="error"><?php echo $emailErr ?></div>
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
            <div class="inner">
                Already a user? <a href="login.php">Sign In</a>
            </div>
        </div>
    </div>
</body>

</html>
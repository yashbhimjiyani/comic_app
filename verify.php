<?php

require('config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics Sign Up | Verification</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <?php
    session_start();
    $otp = "";
    if (isset($_SESSION["otp"])) {
        $otp = $_SESSION["otp"];
    }
    $email=$_SESSION["email"];
    $pswd=$_SESSION["password"];
    $subscribed=$_SESSION["subscd"];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $code = $_POST["code"];
        if ($code === $otp) {
            $sql = "INSERT INTO `users` (`email`, `password`,`subscribed`) VALUES ('$email', '$pswd','$subscribed')";

            if (mysqli_query($connection, $sql)) {
                $_SESSION["loggedin"] = true;
                header("location:home.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connection);
            }
        } else {
            header("location:verify.php?Incorrect Code...try again!");
        }
    }
    ?>

    <div class="container">
        <div class="inner">
            An email verification code has been emailed. Check it out!
        </div>
        <div class="form">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="forms" name="forms">
                <div class="qs">
                    <?php echo str_replace('%20', ' ', $_SERVER["QUERY_STRING"]); ?>
                </div>
                <label for="code">Enter Verification Code:</label>
                <input type="text" name="code" id="code" placeholder="Enter code" required>
                <input type="submit" value="Enter">
            </form>
        </div>
    </div>
</body>

</html>
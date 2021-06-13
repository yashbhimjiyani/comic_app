<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics | Welcome!</title>
</head>

<body>
    <?php
    session_start();
    if (isset($_SESSION['loggedin'])) {
        $email = $_SESSION['email'];
    ?>
        <h2>Hello <?php echo strstr($email, '@', true) ?></h2>
        <h4>Hurrah...You're subscribed!</h4>
        <h5>You'll be receiving comics every 5 minutes!</h5>

    <?php
        
    } else {
        echo "You must be logged in to continue!";
    }
    ?>
</body>

</html>
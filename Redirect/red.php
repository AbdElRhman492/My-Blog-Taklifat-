<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <?php
        function redHome($second) {
            echo "<div class='container'>";
                    echo "<p class='alert alert-info'>You Will Be Redirecting to Home Page After $second Seconds</p>";
            echo "</div>";
            header("refresh:$second;url=test.php");
            exit();
        };
        redHome(3);
        echo " 
            <div class='container'>
                <p class='alert alert-info'>Welcome in red page</p>
            </div>
        ";
    ?>
</body>
</html>
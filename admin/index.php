<?php
session_start();
$noNavbar = '';
$pageTitle = 'Login';
if (isset($_SESSION['uname'])) {
    header('Location: dashboard.php');  // redirect to dashboard page
}
include "init.php";

// Check if user coming from http post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['uname'];
    $password = $_POST['pass'];
    $HASHpass = sha1($password);

    // check if the user exist in database

    $stmt = $conf->prepare("SELECT 
                                user_ID, uname, password
                            FROM
                                users
                            WHERE
                                uname = ? 
                            AND 
                                password = ?
                            AND
                                group_id = 1 
                                LIMIT 1");
    $stmt->execute([$username, $HASHpass]);
    $row = $stmt->fetch();
    $count = $stmt->rowCount();

    // if count > 0 this mean the database contain record about this admin

    if ($count > 0) {
        $_SESSION['uname'] = $username;              // register session name
        $_SESSION['ID']    = $row['user_ID'];        // register session id
        header('Location: dashboard.php');         // redirect to dashboard page
        exit();
    }else {
        echo '
            <div class="container">
                <p class="alert alert-danger">You Can\'t Access This Area</p>
            </div>
        ';
    };
}
?>

<div class="admin">
                <p class="title">Admin Login</p>
                <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="admin-login">
                        <div class="input-box-ad">
                            <span class="details">Username</span>
                            <input type="text" required name="uname" id="uname"" placeholder="Enter Your Username" autocomplete="off">
                        </div>
                        <div class="input-box-ad">
                            <span class="details">Password</span>
                            <input type="password" class="password" required name="pass" id="pass" placeholder="Enter Your Password" autocomplete="new-password">
                            <i class="fa-solid fa-eye show-pass"></i>
                        </div>
                    </div>
                    <div class="admin-btn">
                        <input type="submit" value="Login">
                    </div>
                </form>
            </div>

<?php include $tpl . 'footer.php'; ?>
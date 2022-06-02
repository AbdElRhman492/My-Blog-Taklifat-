<?php
session_start();
if (isset($_SESSION['uname'])) {
    $pageTitle = 'Dashboard';
    include 'init.php'; 
    // Start Dashboard Page // ?>
    <p class="title">Dashboard</p>
    <div class="container home-stat">
        <div class="row">
            <div class="col-md-3">
                <div class="details det_members">
                    <p class="name">Total Members</p>
                    <span><a href="members.php?do=manage"><?php echo count_check_getLatest("user_ID", "users", '', '', ''); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="details det_assign">
                    <p class="name">Total Assignments</p>
                    <span><a href="#"><?php echo count_check_getLatest("user_ID", "users", '', '', ''); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="details det_challenge">
                    <p class="name">Total Challenges</p>
                    <span><a href="#"><?php echo count_check_getLatest("user_ID", "users", '', '', ''); ?></a></span>
                </div>
            </div>
            <div class="col-md-3">
                <div class="details det_pending">
                    <p class="name">Pending Members</p>
                    <span><a href="members.php?do=manage&page=pending"><?php echo count_check_getLatest("reg_status", "users", "0", '', ''); ?></a></span>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 latest">
        <div class="row">
            <div class="col-sm-6">
                <div class="card member_card">
                    <?php 
                        $limit = 5;
                        // Show All Members
                        $stmt = $conf->prepare("SELECT uname, user_ID FROM users WHERE reg_status != 0 ORDER BY user_ID DESC LIMIT $limit ");
                        $stmt -> execute();
                        $latest = $stmt->fetchAll();
                    ?>
                    <div class="card-header">
                        <i class="fa fa-users"></i>Latest <?php echo $limit; ?> Registered Users
                    </div>
                    <div class="card-body">
                        <table class="table text-center main-table members_table">
                                    <tr>
                                        <td>#ID</td>
                                        <td>Username</td>
                                        <td>Control</td>
                                    </tr>
                                    <?php
                                        foreach($latest as $user) {
                                            echo"<tr>";
                                                echo"<td>" . $user['user_ID'] . "</td>";
                                                echo"<td>" . $user['uname'] . "</td>";
                                                echo"<td>
                                                        <p class='click btn btn-danger control_btn del-btn'><i class='fa-solid fa-user-slash'></i>Delete</p>";
                                                echo "</td>";
                                            echo"</tr>";
                                        }
                                    ?>
                                    <tr>
                                        <td colspan="3">
                                            <a class=" btn show_all_btn" href="members.php?do=manage&page=pending">Show All <i class="fa-solid fa-angle-right"></i></a>
                                        </td>
                                    </tr>
                                    <div class="popup_box">
                                        <div class="container">
                                            <p class="alert alert-danger">Are you sure you want to delete this user?</p>
                                        </div>
                                        <div class="btnS">
                                            <?php 
                                                echo "
                                                    <a class='cancel_BTN btn btn-secondary control_btn'><i class='fa-solid fa-xmark'></i>cancel</a>
                                                    <a href='members.php?do=delete&userID=" . $row['user_ID'] . "' class='btn btn-success control_btn'>Delete</a>
                                                ";
                                            ?>
                                        </div>
                                    </div>
                                </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-tag"></i>Latest Assignments
                    </div>
                    <div class="card-body">
                        test
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php // End Dashboard Page //
    include $tpl . 'footer.php';
}else {
    header('Location: index.php');  // redirect to login page
    exit();
}

?>


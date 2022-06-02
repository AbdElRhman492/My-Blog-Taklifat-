<?php

    /* 
    ==========================================================================
    =======================    Categories Page    ============================
    ============= You Can Add | Edit | Delete | Categories From Here ============
    ==========================================================================
    */

    ob_start();
    session_start();
    $pageTitle = 'Categories';
    if (isset($_SESSION['uname'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : $do = 'manage';

        // START Manage Page
        if ($do == 'manage') {  //Manage Page 
            // Show Pending Members Only
            $query = '';
            if (isset($_GET['page']) && $_GET['page'] == 'pending') {
                $query = 'WHERE reg_status = 0';
            }

            // Show All Members
            $stmt = $conf->prepare("SELECT * FROM users $query");
            $stmt -> execute();
            $rows = $stmt->fetchAll();
        ?>

            <p class="title">manage members</p>
            <div class="container">
                <div class="table-responsive">
                    <table class="table text-center main-table table-bordered">
                        <tr>
                            <td>#ID</td>
                            <td>First Name</td>
                            <td>Last Name</td>
                            <td>Email</td>
                            <td>Username</td>
                            <td>Registered Date</td>
                            <td>Control</td>
                        </tr>
                        <?php
                            foreach($rows as $row) {
                                echo"<tr>";
                                    echo"<td>" . $row['user_ID'] . "</td>";
                                    echo"<td>" . $row['fname'] . "</td>";
                                    echo"<td>" . $row['lname'] . "</td>";
                                    echo"<td>" . $row['email'] . "</td>";
                                    echo"<td>" . $row['uname'] . "</td>";
                                    echo"<td>" . $row['date'] . "</td>";
                                    echo"<td>
                                            <a href='members.php?do=edit&userID=" . $row['user_ID'] . "' class='btn control_btn edit-btn'><i class='fa-solid fa-pen-to-square'></i>Edit</a>
                                            <p class='click btn btn-danger control_btn del-btn'><i class='fa-solid fa-user-slash'></i>Delete</p>";
                                            if ($row['reg_status'] == 0) {
                                                echo "<a href='members.php?do=activate&userID=" . $row['user_ID'] . "' class='btn control_btn activate-btn'><i class='fa-solid fa-check'></i>Activate</a>";
                                            }
                                    echo "</td>";
                                echo"</tr>";
                            }
                        ?>
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
                <a class="btn btn-primary" href="?do=add"><i class="fa fa-plus"></i> Add Member</a>
            </div>

        <?php }
        elseif($do == 'delete') {  // Delete Member Page
                $pageTitle = 'Delete Member';
                echo '<p class="title">delete member</p>';

                // Check If Get REquest userID Is Numeric & Get The Integer Value Of It
                $uID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;

                // Select All Data Depend On This ID
                $check = count_check_getLatest('user_ID', 'users', $uID, '', '');

                // If There's Such ID Show The Form
                if ( $check > 0) {
                    $stmt = $conf->prepare("DELETE FROM users WHERE user_ID = :U_ID");
                    $stmt->bindParam(":U_ID", $uID);
                    $stmt->execute();
                    MSG($stmt->rowCount() . "Recorded Deleted", "success");
                    redirect(3, 'back');
                }else {
                    MSG("This ID is Not Exist", "danger");
                    redirect(3);
                }
        }elseif ($do == 'activate') {
            echo '<p class="title">activate member</p>';

                // Check If Get REquest userID Is Numeric & Get The Integer Value Of It
                $uID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;

                // Select All Data Depend On This ID
                $check = count_check_getLatest('user_ID', 'users', $uID, '', '');

                // If There's Such ID Show The Form
                if ( $check > 0) {
                    $stmt = $conf->prepare("UPDATE users SET reg_status = 1 WHERE user_ID = ?");
                    $stmt->execute([$uID]);
                    MSG("The user has been successfully activated", "success");
                    redirect(3, 'back');
                }else {
                    MSG("This ID is Not Exist", "danger");
                    redirect(3);
                }
        }elseif ($do == 'add') { // Add Members Page  
        $pageTitle = 'Add Member';?>
                <div class="form-cont">
                    <p class="title">add new category</p>
                    <form action="?do=insert" method="POST">
                        <div class="user-details">
                            <div class="input-box">
                                <span class="details">Category Name</span>
                                <input type="text" required name="name" id="name" placeholder="Name Of The Category" autocomplete="off">
                            </div>
                            <div class="input-box">
                                <span class="details">Description</span>
                                <input type="text" name="description" id="description" placeholder="Description Of The Category">
                            </div>
                            <div class="input-box">
                                <span class="details">Ordering</span>
                                <input type="number" name="ordering" id="ordering" placeholder="Number To Arrange The Categories" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Visible</label>
                                <div class="col-sm-10 col-md-6">
                                    <div>
                                        <input type="radio" name="visibility" id="vis_yes" value="0" checked>
                                        <label for="vis_yes">Yes</label>
                                    </div>
                                    <div>
                                        <input type="radio" name="visibility" id="vis_no" value="1">
                                        <label for="vis_no">No</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="button">
                            <input type="submit" value="Add Category">
                        </div>
                    </form>
                </div>

        <?php }
        elseif ($do == 'insert') {  // INSERT Category In Database
                echo "<div class='container'>";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        echo "<p class='title'>Insert Category</p>";

                        // GET Variables From The Form 
                        $fname  = $_POST['fname'];
                        $lname  = $_POST['lname'];
                        $email  = $_POST['email'];
                        $uname  = $_POST['uname'];
                        $pass   = $_POST['pass'];

                        $hashPass = sha1($_POST['pass']);
                        
                        // VALIDATE The Form
                        $formErrors = [];
                        if (strlen($user) < 4) {
                            $formErrors [] = 'Username Can\'t be less than <strong>4 Characters</strong>';
                        }
                        if (strlen($user) > 20) {
                            $formErrors [] = 'Username Can\'t be more than <strong>20 Characters</strong>';
                        }
                        if (empty($uname)) {
                            $formErrors [] = 'Username Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($pass)) {
                            $formErrors [] = 'Password Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($email)) {
                            $formErrors [] = 'Email Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($fname)) {
                            $formErrors [] = 'First Name Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($lname)) {
                            $formErrors [] = 'Last Name Can\'t be <strong>Empty</strong>';
                        }
                        foreach($formErrors as $MSG) {
                            MSG("$MSG", "danger");
                            redirect(3, 'back');
                        }
                    
                        // Check If There Is No Errors In Form
                        if (empty($formErrors)) {
                            // Check If User Exist In Database
                            $check = count_check_getLatest("uname", "users", $uname, '', '');
                            if ($check == 1) {
                                MSG("Sorry, You Can't Choose This Username", "warning");
                                redirect(3, 'back');
                            }else {
                                // INSERT User Info In DATABASE
                                $stmt = $conf->prepare("INSERT INTO 
                                                            users(
                                                                fname,
                                                                lname, 
                                                                uname,
                                                                email,
                                                                reg_status,
                                                                password)
                                                        VALUES(:fname, :lname, :uname, :email, 1, :pass) ");
                                $stmt->execute([
                                    'fname' => $fname,
                                    'lname' => $lname,
                                    'uname' => $uname,
                                    'email' => $email,
                                    'pass' => $hashPass
                                ]); 

                                $recNUM = $stmt->rowCount();
                                // Echo Success Message
                                MSG("$recNUM Recorded Inserted", "success");
                                redirect(3, 'back');
                            }
                        }
                }else { 
                    MSG("You Can't Reach This Page Directly", "danger");
                    redirect(3);
                }
                echo "</div>";

        }elseif ($do == 'edit') {  // Edit page
                    $pageTitle = 'Edit Member';

                    // CHECK if The user id is numeric to access edit form
                    $uID = isset($_GET['userID']) && is_numeric($_GET['userID']) ? intval($_GET['userID']) : 0;
                    $stmt = $conf->prepare("SELECT * FROM users WHERE user_ID = ? LIMIT 1");
                    $stmt->execute([$uID]);
                    $row = $stmt->fetch();
                    $count = $stmt->rowCount();

                    if ( $count > 0) { ?>
                        <div class="form-cont">
                            <p class="title">edit user</p>
                            <form action="?do=update" method="POST">
                                <input type="hidden" name="uID" value="<?php echo $uID ?>">
                                <div class="user-details">
                                    <div class="input-box">
                                        <span class="details">First Name</span>
                                        <input type="text" required name="fname" id="fname" value="<?php echo $row['fname'] ?>" placeholder="Enter First Name" autocomplete="off">
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Last Name</span>
                                        <input type="text" name="lname" id="lname" value="<?php echo $row['lname'] ?>" placeholder="Enter Last Name" autocomplete="off">
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Email</span>
                                        <input type="email" required name="email" id="email" value="<?php echo $row['email'] ?>" placeholder="Enter your Email" autocomplete="off">
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Username</span>
                                        <input type="text" required name="uname" id="uname" value="<?php echo $row['uname'] ?>" placeholder="Enter your Username" autocomplete="off">
                                    </div>
                                    <div class="input-box">
                                        <span class="details">Password</span>
                                        <input type="hidden" name="old-pass" id="old_pass" value="<?php echo $row['password'] ?>">
                                        <input type="password" name="new-pass" id="new_pass" placeholder="Leave It Empty if you won't change it" autocomplete="new-password">
                                    </div>
                                </div>
                                <!-- Get The Value For Gender -->
                                <!-- <div class="gender-details">
                                    <input type="radio" name="gender" id="dot-1">
                                    <input type="radio" name="gender" id="dot-2">
                                    <span class="gender-title">Gender</span>
                                    <div class="category">
                                        <label for="dot-1">
                                            <span class="dot one"></span>
                                            <span class="gender">Male</span>
                                        </label>
                                        <label for="dot-2">
                                            <span class="dot two"></span>
                                            <span class="gender">Female</span>
                                        </label>
                                    </div>
                                </div> -->
                                <div class="button">
                                    <input type="submit" value="Save">
                                </div>
                            </form>
                        </div>
                    <?php
                    }else {
                        MSG("There is No Such ID", "danger");
                        redirect(3);
                    }
        }elseif ($do =='update') { // UPDATE Page
                    $pageTitle = 'Update Member';
                    echo "<p class='title'>Update Member</p>";
                    echo "<div class='container'>";
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        // GET Variables From The Form 
                        $id = $_POST['uID'];
                        $uname = $_POST['uname'];
                        $email = $_POST['email'];
                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        
                        // PASSWD Trick
                        $pass = empty($_POST['new-pass']) ?  $pass = $_POST['old-pass'] :  $pass = sha1($_POST['new-pass']);

                        // VALIDATE The Form
                        $formErrors = [];
                        if (strlen($user) < 4) {
                            $formErrors [] = 'Username Can\'t be less than <strong>4 Characters</strong>';
                        }
                        if (strlen($user) > 20) {
                            $formErrors [] = 'Username Can\'t be more than <strong>20 Characters</strong>';
                        }
                        if (empty($uname)) {
                            $formErrors [] = 'Username Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($email)) {
                            $formErrors [] = 'Email Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($fname)) {
                            $formErrors [] = 'First Name Can\'t be <strong>Empty</strong>';
                        }
                        if (empty($lname)) {
                            $formErrors [] = 'Last Name Can\'t be <strong>Empty</strong>';
                        }
                        foreach($formErrors as $MSG) {
                            MSG("$MSG", "danger");
                            redirect(3, 'back');
                        }

                        // Check If There Is No Errors In Form
                        if (empty($formErrors)) {
                        // UPDATE The DATABASE With This Info
                        $stmt = $conf->prepare("UPDATE
                                                    users
                                                SET
                                                    fname = ?,
                                                    lname = ?, 
                                                    uname = ?,
                                                    email = ?,
                                                    password = ? 
                                                WHERE
                                                    user_ID = ? ");
                        $stmt->execute([$fname, $lname, $uname, $email, $pass, $id]); 

                        $recNUM = $stmt->rowCount();
                        // Echo Success Message
                        MSG("$recNUM Recorded Updated", "success");
                        redirect(3, 'back');
                        }
                    }else {
                        echo "<p class='alert alert-danger'>You Can't Reach This Page Directly</p>";
                        redirect(3);
                    }
                    echo "</div>";
                }
    }else {
        header('Location: index.php');  // redirect to login page
        exit();
    }
    include $tpl . 'footer.php';
    ob_end_flush();

?>
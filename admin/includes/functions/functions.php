<?php 

/* 
** Title Function  v1.0
** Echo The Page Title In Case The Page Has The
** Variable $pageTitle And Echo Default For Other Pages
*/
function getTitle() {
    global $pageTitle;
    if (isset($pageTitle)) {
        echo $pageTitle;
    }else {
        echo 'Default';
    }
}


/*
** MESSAGE Function To Validate The Form  v1.0
** It Depend on Parameter  $msg $type
** $msg = Echo The Message
** $type = The Type For Alert Bootstrap
*/
function MSG($msg, $type) {
    echo "<div class='container'>";
        echo "<p class='alert alert-$type'>$msg</p>";
    echo "</div>";
}


/*
** Home Redirecting Function  v1.0
** This Function Accept Parameters
** $errorMsg = Echo The Error Message
** seconds = Seconds Before Redirecting |
** Redirect Function v2.0
** $url = The Link You Want To Redirect To
*/
function redirect($second, $url = null) {
    if ($url === null) {
        $url = 'index.php';
        $link = 'Homepage';
    }else {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !='') {
            $url = $_SERVER['HTTP_REFERER'];
            $link = 'Previous Page';
        }else {
            $url = 'index.php';
            $link = 'Homepage';
        }
    }
    echo "<div class='container'>";
        echo "<p class='alert alert-info'>You Will Be Redirecting to $link After $second Seconds</p>";
    echo "</div>";
    header("refresh:$second;url=$url");
    exit();
    };


/*
** Check & Count & Get Latest Function [ Accepted Parameters ] v3.0
** Function To Check & Count & Get Latest Items From Database [ users, assignments, comments ]
** $select = The Field To Select OR Item To Select or Count [Example: user, assignment, category]
** $table = The Table To Choose From 
** $value The Value Of Select [Example: Osama, Toys, Phones, php, 0] You can leave it Empty If You Want To Count Items
** $order = The field To Order By [Example: user_ID, uname, fname] 
** $limit = Number Of Records To Get [Example: users, assignments, categories]
*/
function count_check_getLatest($select, $table, $value, $order, $limit = 5) {
    global $conf;
    if ($value == null && $order == null && $limit == null) {
        $stmt = $conf->prepare("SELECT COUNT($select) FROM $table");
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count;
    }elseif ($order == null && $limit == null) {
        $stat = $conf->prepare("SELECT $select FROM $table WHERE $select = ? ");
        $stat->execute([$value]);
        $count = $stat->rowCount();
        return $count;
    }elseif ($value == null) {
        $stmt = $conf->prepare("SELECT $select FROM $table ORDER BY  $order DESC LIMIT $limit");
        $stmt->execute();
        $rows = $stmt->fetchAll();
        return $rows;
    }
}
?>
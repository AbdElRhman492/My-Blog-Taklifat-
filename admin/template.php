<?php 
        ob_start();
    $pageTitle = '';
    if (isset($_SESSION['uname'])) {
        include 'init.php';
        $do = isset($_GET['do']) ? $_GET['do'] : 'main';

        if ($do = 'main') {

        }elseif ($do = 'manage') {

        }elseif ($do = 'add') {

        }elseif ($do = 'insert') {

        }elseif ($do = 'edit') {

        }elseif ($do = 'update') {

        }elseif ($do = 'delete') {

        }elseif ($do = 'activate') {

        }
        include $tpl . 'footer.php';
    }else {
        header('Location: index.php');
        exit();
    }
    ob_end_flush()
?>
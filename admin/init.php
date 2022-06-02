<?php


// Connect To The DATABASE File
include 'conf.php';


// Routes
$tpl  = 'includes/template/';            // Template Directory
$css  = 'layout/css/';                  // CSS Directory
$js   = 'layout/js/';                  // JS Directory
$lang = 'includes/lang/';             // LANGUAGE Directory
$fuck = 'includes/functions/';       // FUNCTIONS Directory
$sass = 'layout/sass/';


// FUNCTION TO INCLUDE NAVBAR FILE ON ALL PAGES EXPECT THE ONE WITH $noNavbar Variable
if (!isset($noNavbar)) { include $tpl . 'navbar.php'; };


// INCLUDE The Important FILE
include $fuck . 'functions.php';
include $lang . 'english.php';
include $tpl . 'header.php';
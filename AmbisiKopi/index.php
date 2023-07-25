<?php
session_start();
if (isset($_GET['x']) && $_GET['x'] == 'home') {
    $page = "home.php";
    include "main.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'order') {
    if ($_SESSION['level_ambisikopi'] == 1 || $_SESSION['level_ambisikopi'] == 3) {
        $page = "order.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'kitchen') {
    if ($_SESSION['level_ambisikopi'] == 1 || $_SESSION['level_ambisikopi'] == 4) {
        $page = "kitchen.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'user') {
    if ($_SESSION['level_ambisikopi'] == 1) {
        $page = "user.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'report') {
    if ($_SESSION['level_ambisikopi'] == 1) {
        $page = "report.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'menu') {
    if ($_SESSION['level_ambisikopi'] == 1 || $_SESSION['level_ambisikopi'] == 3) {
        $page = "menu.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'login') {
    include "login.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'logout') {
    include "process/process-logout.php";
} elseif (isset($_GET['x']) && $_GET['x'] == 'orderitem') {
    if ($_SESSION['level_ambisikopi'] == 1 || $_SESSION['level_ambisikopi'] == 3) {
        $page = "order_item.php";
        include "main.php";
    } else {
        $page = "home.php";
        include "main.php";
    }
} elseif (isset($_GET['x']) && $_GET['x'] == 'viewitem') {
    if ($_SESSION['level_ambisikopi'] == 1) {
      $page = "view_item.php";
      include "main.php";
    } else {
      $page = "home.php";
      include "main.php";
    }
} else {
    $page = "home.php";
    include "main.php";
}
?>
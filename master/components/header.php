<?php 
session_start();
require_once('../../pustaka/User.php');

if (!isset($_SESSION['user']) || trim($_SESSION['user']) == '') {
    header('Location:../../auth/login.php');
    exit();
}

$user = new User();
$userId = $_SESSION['user'];

// Fetch user data
$sql = "SELECT * FROM users WHERE id = '$userId'";
$userDetails = $user->details($sql);

if ($userDetails && isset($userDetails['permission'])) {
    $userPermission = $userDetails['permission'];
} else {
    $userPermission = 1;
}

if ($userPermission == 3) {
    $sql = "SELECT student_name AS name, email FROM students WHERE user_id = '$userId'";
    $row = $user->details($sql);
    $name = isset($row['name'])? htmlspecialchars($row['name']) : 'User';
    $email = isset($row['email'])? htmlspecialchars($row['email']) : 'User';
} elseif ($userPermission == 2) {
    $sql = "SELECT instructor_name AS name, email FROM instructors WHERE user_id = '$userId'";
    $row = $user->details($sql);
    $name = isset($row['name'])? htmlspecialchars($row['name']) : 'User';
    $email = isset($row['email'])? htmlspecialchars($row['email']) : 'User';
} else {
    $name = 'Admin';
    $email = '';
}

?>

<!doctype html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>::. Administrator .::</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../../assets/vendors/jvectormap/jquery-jvectormap.css">
  <!-- End plugin css for this page -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../../assets/css/demo/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
<script src="../../assets/js/preloader.js"></script>
  <div class="body-wrapper">
    <!-- partial:partials/_sidebar.html -->
    <?php
      require_once('../components/sidebar.php')
    ?>
    <!-- partial -->
    <div class="main-wrapper mdc-drawer-app-content">
      <!-- partial:partials/_navbar.html -->
      <?php 
        require_once('../components/navbar.php')
      ?>
      <!-- partial -->
      <div class="page-wrapper mdc-toolbar-fixed-adjust">
        <main class="content-wrapper">
          <div class="mdc-layout-grid">
            <div class="mdc-layout-grid__inner">
              <!-- content -->
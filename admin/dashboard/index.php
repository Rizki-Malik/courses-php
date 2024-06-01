<?php
session_start();
//kembalikan ke halaman login jika belum login
if (!isset($_SESSION['user']) ||(trim ($_SESSION['user']) == '')){
    header('location:login.php');
}

require_once('../../pustaka/User.php');

$user = new User();

//fetch user data
$sql = "SELECT * FROM login WHERE id = '".$_SESSION['user']."'";
$row = $user->details($sql);
//echo $row['username'];  

require_once('../components/header.php');

require_once('dashboard-main.php');

require_once('../components/footer.php');
?>
       
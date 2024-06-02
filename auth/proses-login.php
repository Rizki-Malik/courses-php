<?php
    //start session
    session_start();
    
    require_once('../pustaka/User.php');
    
    $user = new User();
    
    if(isset($_POST['login'])){
        $username = $user->escape_string($_POST['username']);
        $password = $user->escape_string($_POST['password']);
    
        $auth = $user->check_login($username, $password);
    
        if(!$auth){
            $_SESSION['message'] = 'Username dan password tidak sesuai!';
            header("location:login.php");

        }
        else{
            $_SESSION['user'] = $auth;
            header("location:../admin/dashboard/index.php");
        }
    }
    else{
        $_SESSION['message'] = 'Silahkan Login Terlebih Dahulu';
        header('location:login.php');
    }

    //header("location:dashboard.php");

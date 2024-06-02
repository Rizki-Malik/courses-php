<?php
    //start session
    session_start();
  
    //redirect if logged in
    if(isset($_SESSION['user'])){
        header("location:index.php");
    }
    require_once('../../pustaka/Koneksi.php');
    //$koneksi = new Koneksi();

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../assets/css/bootstrap.min.css">

    <title>::. Login Administrator .::</title>
    <style>
        .col-centered{
            float:none;
            margin-top:50px;
        }
    </style>
  </head>
  <body>
    <div class="container col-centered">
        <div class="row justify-content-center align-items-center ">
            <div class="col-4">
                <?php 
                    // $password = "admin";
                    // echo password_hash($password, PASSWORD_BCRYPT);
                    if(isset($_SESSION['message'])){
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $_SESSION['message']; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php
                        unset($_SESSION['message']);
                    }
                ?>

                <form action="proses-login.php" method="post">
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Masukan Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Masukan Password">
                    </div>
                    <button type="submit" name="login" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="../../assets/js/jquery-3.4.1.slim.min.js"></script>
    <script src="../../assets/js/popper.min.js"></script>
    <script src="../../assets/js/bootstrap.min.js"></script>
  </body>
</html>
<?php require_once("components/header.php") ?>
    <main>
        <?php
            $page = 'pages/home.php';
            if(isset($_GET['q'])){
                $page = 'pages/'.$_GET['q'].'.php';
            }
            require($page);
        ?>
    </main>
<?php require_once("components/footer.php") ?>
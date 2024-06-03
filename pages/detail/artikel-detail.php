<?php
require_once('../../pustaka/Crud.php');

$crud = new Crud();

$table = 'articles';
$id_artikel = isset($_GET['id']) ? $_GET['id'] : null;
$where = [];
if ($id_artikel) {
    $where = ['id' => $id_artikel];
    $row = $crud->read($table, $where);
    if ($row) {
        $artikel = $row[0];
        // Fetch the username associated with user_id
        $user_id = $artikel['user_id'];
        $user = $crud->read('users', ['id' => $user_id]);
        $username = $user ? $user[0]['username'] : 'Unknown';
    } else {
        echo "<script>alert('Artikel tidak ditemukan');</script>";
        echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
        exit;
    }
} else {
    echo "<script>alert('ID artikel tidak diberikan');</script>";
    echo '<meta http-equiv="refresh" content="0; url=artikel.php">';
    exit;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>::. Artikel .::</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Shippori+Antique+B1&family=Taviraj:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>
        <link rel="stylesheet" href="../../style.css">
    </head>
    <body>
    <header>
        <div class="icon">
            <a href="#" class="full-name">
                <div class="first-name">
                    Course
                </div>
                <div class="last-name">
                    Programming
                </div>
            </a>
        </div>
        <nav>
            <ul>
                <a href="../../index.php"><li>Home</li></a>
                <a href="../../index.php?q=about"><li>About</li></a>
                <a href="../../index.php?q=artikel"><li>Article</li></a>
                <a href="#"><li>Courses</li></a>
                <a href="#"><li>Dashboard</li></a>
            </ul>
        </nav>
        <div class="contact">
            <a class="link-contact" href="#">
                <div class="status">
                    <img src="../../assets/img/mailbox.png" alt="icon" width="20px">
                    Available for new projects.
                </div>
                <button class="contact-button">Contact me</button>
            </a>
        </div>
    </header>
    <div class="article-detail">
        <div class="article-head">
            <h2><?= ucwords($artikel['title']); ?></h2>
            <p class="date-author"><?= $artikel['published_date'] ?> | <?= $username; ?></p>
        </div>
        <div class="jumbo-tb">
            <img src="../../admin/artikel/<?= $artikel['thumbnail'] ?>" alt="thumbnail">
        </div>
        <p><?= $artikel['content']; ?></p>
    </div>
    <footer class="footer">
        <div class="footer-nav">
          <h3>Navigation</h3>
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#contact">Contact</a>
        </div>
        <div class="footer-about">
          <h3>About Me</h3>
          <p>Discover our passion for innovation and our commitment to excellence. Join with me on my journey to shape the future.</p>
        </div>
        <div class="footer-contact">
          <h3>Contact Me</h3>
          <p>Have questions? I'll always ready to help. Reach out to me and let's start a conversation.</p>
          <button>Contact</button>
        </div>
    </footer>
    </body>
</html>

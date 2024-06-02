<!DOCTYPE html>
<html>
    <head>
        <title>::. Home .::</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Shippori+Antique+B1&family=Taviraj:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400..700&display=swap');
            @import url('https://fonts.googleapis.com/css2?family=Domine:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
        </style>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
    <header>
        <div class="icon">
            <a href="#" class="full-name">
                <div class="first-name">
                    Rizki 
                </div>
                <div class="last-name">
                    Malik
                </div>
            </a>
        </div>
        <nav>
            <ul>
                <a href="index.php"><li>Home</li></a>
                <a href="index.php?q=about"><li>About</li></a>
                <a href="index.php?q=artikel"><li>Article</li></a>
                <a href="#"><li>Pricing</li></a>
                <a href="#"><li>Process</li></a>
            </ul>
        </nav>
        <div class="contact">
            <a class="link-contact" href="#">
                <div class="status">
                    <img src="assets/img/mailbox.png" alt="icon" width="20px">
                    Available for new projects.
                </div>
                <button class="contact-button">Contact me</button>
            </a>
        </div>
    </header>
    <main>
        <?php
            $page = 'pages/home.php';
            if(isset($_GET['q'])){
                $page = 'pages/'.$_GET['q'].'.php';
            }
            require($page);
        ?>
    </main>
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
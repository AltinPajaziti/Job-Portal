<?php
session_start();

include ('config.php');
include ('Crud.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>
<style>
    a {
        text-decoration: none !important;
    }

    li {
        list-style-type: none;
    }

    .btn:hover {
        color: white;
    }
</style>

<body>
    <header class="header">
        <section class="flex">
            <div id="menu-btn" class="fas fa-bars-staggered"></div>
            <a href="home.php" class="logo">
                <i class="fas fa-briefcase"></i> JobHunt
            </a>
            <nav class="navbar">
                <?php if (!(isset($_SESSION['emri_kompanise']))) { ?>
                    <a href="index.php">Punkerkuesi</a>

                <?php } ?>
                <?php if (!(isset($_SESSION['emri']))) { ?>
                    <a href="home.php">Pundhenesi</a>
                <?php } ?>

                <a href="PunedhensiProfile.php">Profile</a>
                <a href="shpalljet.php">Shpalljet</a>
                <?php
                if (isset($_SESSION['emri_kompanise']) || isset($_SESSION['emri'])) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="PunedhensiProfile.php" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Logout
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="logout.php">Logout</a>
                            <a class="dropdown-item" href="changepass.php">Change Password</a>
                        </div>
                    </li>
                    <?php
                }
                ?>




            </nav>
            <a href="#" class="btn" style="margin-top: 0; visibility: hidden"></a>
        </section>
    </header>

    <div class="home-container">
        <section class="home">
            <form action="shtoShpallje.php" method="post">

                <h3>Post Your Next Job</h3>
                <p>Ready to find the perfect candidate? Post your job now to connect with qualified professionals. Just
                    fill out the details and hit submit to start your search for top talent.</p>
                <input type="submit" value="Post Your Job" name="submit" class="btn">




            </form>
        </section>
    </div>




    <section class="jobs-container">




    </section>

    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick links</h3>
                <a href="home.html"><i class="fas fa-angle-right"></i>home</a>
                <a href="about.html"><i class="fas fa-angle-right"></i>about</a>
                <a href="jobs.html"><i class="fas fa-angle-right"></i>jobs</a>
                <a href="contact.html"><i class="fas fa-angle-right"></i>contact</a>
                <a href="contact.html"><i class="fas fa-angle-right"></i>filter search</a>
            </div>
            <div class="box">
                <h3>extra links</h3>
                <a href="login.html"><i class="fas fa-angle-right"></i>account</a>
                <a href="register.html"><i class="fas fa-angle-right"></i>register</a>
                <a href="login.html"><i class="fas fa-angle-right"></i>login</a>
                <a href="#"><i class="fas fa-angle-right"></i>post jobs</a>
                <a href="#"><i class="fas fa-angle-right"></i>dashboard</a>
            </div>
            <div class="box">
                <h3>follow us</h3>
                <a href="#"><i class="fab fa-facebook"></i>facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>twitter</a>
                <a href="#"><i class="fab fa-instagram"></i>instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i>linkedin</a>
                <a href="#"><i class="fab fa-youtube"></i>youtube</a>
            </div>
        </section>
        <div class="credit">&copy; copyright @2024</div>
    </footer>
    <script src="./js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
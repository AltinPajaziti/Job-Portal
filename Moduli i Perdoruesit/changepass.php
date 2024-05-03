<?php
    session_start();
    if (!(isset($_SESSION['emri_kompanise']) != '')) {
        header('Location: index2.php');
      }
    include('Crud.php');
    include('config.php');
    
    if (isset($_POST['buttoni'])) {
        if ($_POST['password1'] == $_POST['password']) {
            $newPassword = $_POST['password']; 
            $userId = $_SESSION['id_kompania']; 
    
            $sql = "UPDATE kompania SET Passwordi = '$newPassword' WHERE id_Kompania  = $userId";
    
            $result = mysqli_query($lidhe, $sql);
    
            if ($result) {
                echo "The password has been changed successfully";
            } else {
                echo "Error updating password: " . mysqli_error($lidhe); // Display error message if update fails
            }
        } else {
            echo "Please enter the same new password twice";
        }
    }




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
li{
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
            <?php if(!(isset($_SESSION['emri_kompanise']))){ ?>
                <a href="index.php">Punkerkuesi</a>
                
                <?php } ?>
                <?php if(!(isset($_SESSION['emri']))){ ?>
                <a href="home.php">Pundhenesi</a>
                <?php }?>
                
                <a href="PunedhensiProfile.php">Profile</a>
                <a href="shpalljet.php">Shpalljet</a>
                <?php
                if(isset($_SESSION['emri_kompanise']) || isset($_SESSION['emri'])) {
                ?>
                    <li class="nav-item dropdown"> 
        <a class="nav-link dropdown-toggle" href="PunedhensiProfile.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

    <section class="account-form-container">
        <section class="account-form">
            <form action="changepass.php" method="post">
                <h3>welcome back</h3>
                <input type="password" name="password" maxlength="50" placeholder="enter your password" class="input">
                <input type="password" name="password1" maxlength="20" placeholder="confir your password" class="input">
                <input type="submit" value="Change" name="buttoni" class="btn btn-primary" class="btn">

            </form>
        </section>

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
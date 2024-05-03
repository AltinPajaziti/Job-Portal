<?php
session_start();
include('config.php');

if ((isset($_SESSION['emri']) != '')) {
    header('Location: index.php');
}

$error = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['Mbiemri']) || empty($_POST['Emri']) || empty($_POST['Edukimi']) || empty($_POST['Password'])) {
        $error = "Fill all fields please";
    } else {
        
            $foto =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
            $maxsize = 10000000; 
            $email = $_POST['email'];
            $emri = $_POST['Emri'];
            $mbiemri = $_POST['Mbiemri'];
            $Edukimi = $_POST['Edukimi'];
            $password =$_POST['Password'];



                $sql = "INSERT INTO Perdoruesi (email, Mbiemri, Emri, Edukimi, passwordi, Foto) VALUES ('$email', '$mbiemri', '$emri', '$Edukimi', '$password', '$foto')";
                $rezultati = mysqli_query($lidhe , $sql);
                echo "The data is inseted succesfully";

                // if ($stmt = mysqli_prepare($lidhe, $sql)) {
                //     $email = mysqli_real_escape_string($lidhe, $_POST['email']);
                //     $emri = mysqli_real_escape_string($lidhe, $_POST['Emri']);
                //     $mbiemri = mysqli_real_escape_string($lidhe, $_POST['Mbiemri']);
                //     $Edukimi = mysqli_real_escape_string($lidhe, $_POST['Edukimi']);
                //     $password = mysqli_real_escape_string($lidhe, $_POST['Password']);

                //     mysqli_stmt_bind_param($stmt, "ssssss", $email, $mbiemri, $emri, $Edukimi, $password, $foto);

                //     if (mysqli_stmt_execute($stmt)) {
                //         echo "Te dhenat u insertuan me sukses";
                //     } else {
                //         $error = "Problem ne insertim te te dhenave: " . mysqli_error($lidhe);
                //     }

                //     mysqli_stmt_close($stmt);
                // } else {
                    // $error = "SQL statement preparation error: " . mysqli_error($lidhe);
                
             
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
            <a href="index.php" class="logo">
                <i class="fas fa-briefcase"></i> JobHunt
            </a>
            <nav class="navbar">
            <li class="nav-item dropdown"> 
            <?php if((isset($_SESSION['emri']))){ ?>
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Profile
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="Profile.php">Profili</a>
            <a class="dropdown-item" href="Job_experience.php">Eksperiencat</a>
            <a class="dropdown-item" href="Applied_jobs.php">Aplikimet</a>
            <a class="dropdown-item" href="Change_password.php">Change Password</a>
        </div>
    </li>
             <?php }?>
             <a href="index.php">Home</a>

                <?php if(!(isset($_SESSION['emri_kompanise']))){ ?>
                <a href="index1.php">Punkerkuesi</a>
                <?php } ?>
                <?php if(!(isset($_SESSION['emri']))){ ?>
                <a href="index2.php">Pundhenesi</a>
                <?php }?>
                
                <a href="jobs.php">jobs</a>
              
                <?php
                if(isset($_SESSION['emri_kompanise']) || isset($_SESSION['emri'])) {
                ?>
                    <a href="logout.php">Logout</a>
                <?php
                }
                ?>
                
            </nav>
            <a href="#" class="btn" style="margin-top: 0; visibility: hidden"></a>
        </section>
    </header>



    <section class="account-form-container" >
        <section class="account-form">
            <form enctype="multipart/form-data" action="Register.php"  method="post" name="form1">
                <h3>Create new account</h3>
                <input type="text" name="Emri" maxlength="50" placeholder="enter your name" class="input">
                <input type="text" name="Mbiemri" maxlength="50" placeholder="enter your Surname" class="input">
                <input type="text" name="email" maxlength="50" placeholder="enter your email" class="input">
                <input type="text" name="Edukimi" maxlength="50" placeholder="Education" class="input">
                <div style="display: flex;flex-direction:flex-start;">
                <input name="userfile" type="file">  </div> 
                
                <input type="password" name="Password" maxlength="20" placeholder="enter your password" class="input">
                

                <p>alredy have account? <a href="login.php">login now</a></p>
                <input type="submit" value="login now" name="submit" class="btn">
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
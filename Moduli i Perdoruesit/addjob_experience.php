<?php

session_start();
if (!(isset($_SESSION['emri']) && $_SESSION['emri'] != '')) {
    header('Location: index.php');
    exit;
}
include('config.php');

if (isset($_POST['submit_btn'])) {
    $kompania = $_POST['kompania'];
    $pozita = $_POST['pozita'];
    $lokacioni = $_POST['lokacioni'];
    $data_fillimit = date('Y-m-d', strtotime($_POST['data_fillimit'])); 
    $data_perfundimit = date('Y-m-d', strtotime($_POST['data_perfundimit']));
    $pershkrimi = $_POST['pershkrimi'];

    $sql = "INSERT INTO eksperiencat_e_punes (Emri_i_kompanise, Titulli_pozites, Lokacioni, data_fillimit, data_perfundimit, Pershkrimi, id_Perdoruesi) 
            VALUES ('$kompania', '$pozita', '$lokacioni', '$data_fillimit', '$data_perfundimit', '$pershkrimi', '{$_SESSION['id']}')";

    if (mysqli_query($lidhe, $sql)) {
        header('Location: Job_experience.php');
        exit;
    } else {
        echo "Error: " . mysqli_error($lidhe);
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
                <?php if(!(isset($_SESSION['emri_kompanise']))){ ?>
                <a href="index1.php">Punkerkuesi</a>
                <?php } ?>
                <?php if(!(isset($_SESSION['emri']))){ ?>
                <a href="index1.php">Pundhenesi</a>
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




    <section class="contact">
       


            
        </div>
        <form action="addjob_experience.php" method="post">
            <h3>Add your Experience</h3>
            <div class="flex">
                <div class="box">
                    <p>Kompania</p>
                    <input type="text" class="input" name="kompania" placeholder="Emri i Kompanise" >
                    
                </div>
                
                <div class="box">
                    <p>Pozita </p>
                    <input type="text" class="input" name="pozita" placeholder="Pozita e Punes">
                </div>
                
                <div class="box">
                    <p>Lokacioni</p>
                    <input type="text" class="input" name="lokacioni" placeholder="Lokacioni">
                </div>
                <div class="box">
                    <input type="text" style="visibility: hidden;">
                </div>

                <div class="box">
                    <p>Data e Fillimit </p>
                    <input type="date" class="input" name="data_fillimit" placeholder="Data e Fillimit">
                </div>
                
                <div class="box">
                    <p>Data e Perfundimit </p>
                    <input type="date" class="input" name="data_perfundimit" placeholder="Data e Perfundimit">
                </div>
                
            </div>
            <p>Pershkrimi </p>
            <textarea name="pershkrimi" class="input" required maxlength="1000" cols="30" placeholder="Pershkruaj Eksperiencen" rows="10"></textarea>
            
            <input type="submit" value="Save" name="submit_btn" class="btn" style="float:left">
            <div class="clear" style="clear:both"></div>
        </form>
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
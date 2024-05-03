<?php
session_start();
include('config.php');
include('Crud.php');

if(isset($_POST['submit'])) {
    $shpallja = $_POST['shpallja'];
    
    $data_e_shpalljes = date('Y-m-d', strtotime($_POST['data']));
    $pershkrimi = $_POST['Pershkrimi'];
    $Paga = $_POST['paga'];
    $kualifikimet = $_POST['kualifikimet'];
    $orari = $_POST['orari'];
    $skills = $_POST['skills'];
    
    $crud->Create('shpalljet', [
        'id_kompania' => $_SESSION['id_kompania'],
        'Shpallja' => $shpallja,
        'id_kategoria' => $_SESSION['id_Kategoria'],
        'data_e_shpalljes' => $data_e_shpalljes,
        'Paga' => $Paga,
        'Pershkrimi' => $pershkrimi,
        'kualifikimet' => $kualifikimet,
        'orari' => $orari,
        'skills' => $skills
    ]);
    
    header("Location: shtoShpallje.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
    .clear{
        clear: both;
    }
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>

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




    <section class="contact">
       


            
        </div>
        <form action="shtoShpallje.php" method="post">
            <h3>Post jobs</h3>
            <div class="flex">
                <div class="box">
                    <p>Shpallja</p>
                    <input type="text" class="input" name="shpallja" placeholder="Pozita e shpalljes" >
                    
                </div>
                <div class="box">
                    <p>Lokacioni</p>
                    <input type="text" class="input" name="lokacioni" placeholder="Lokacioni">
                </div>
                
                <div class="box">
                    <p>Data e Fillimit </p>
                    <input type="date" class="input" name="data" placeholder="Data e Fillimit">
                </div>
                
                <div class="box">
                    <p>Paga</p>
                    <input type="text" class="input" name="paga" placeholder="Paga">
                </div>
             

                <div class="box">
                    <p>Kualifikimet</p>
                    <input type="text" class="input" name="kualifikimet" placeholder=" kualifikimet ">
                </div>
                
                <div class="box">
                    <p>Orari </p>
                    <input type="text" class="input" name="orari" placeholder="Orari">
                </div>
                <div class="box">
                    <p>Skills </p>
                    <input type="text" class="input" name="skills" placeholder="Skills ">
                </div>
                <div class="box">
                    <input type="text" style="visibility: hidden;">
                </div>
                
            </div>
            <p>Pershkrimi </p>
            <textarea name="Pershkrimi" class="input" required maxlength="1000" cols="30" placeholder="Pershkruaj Shpalljen" rows="10"></textarea>
            <input type="submit" value="Save" name="submit" class="btn" style="float:left">
            <div class="clear"></div>
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
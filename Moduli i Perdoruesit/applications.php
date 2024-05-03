<?php
session_start();
if(!(isset($_SESSION['emri_kompanise'])!= '')){
    header('location: index2.php');
}
include('config.php');


if(isset($_POST['id_kompania']) && isset($_POST['apply_btn'])) {
  $id_kompania = $_POST['id_kompania'];
  $delete_query = "DELETE FROM aplikimet WHERE Id_Aplikimi = $id_kompania";
  if(mysqli_query($lidhe, $delete_query)) {
      echo "Application deleted successfully.";
      
  } else {
      echo "Error deleting application: " . mysqli_error($lidhe);
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
    .skills{
        width: 100%;
        display: flex;
        justify-content: space-between;
        margin: 8px;
        
        
    }
    .skills ul li{
        font-size: 10px;
        margin-left: 20px;
        padding: 4px;
        list-style-type: disc;
        
    }
    .clear{
        clear: both;
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
            <a href="#" class="btn" style="margin-top: 0;">Post jobs</a>
        </section>
    </header>


    <section class="reviews">
        <div class="box-container">
            <?php
            $id_shpallja = $_POST['id_shpallja'];

            $sql = "SELECT aplikimet.id_kompania, perdoruesi.Id_Perdoruesi, aplikimet.Id_Aplikimi, perdoruesi.Emri, perdoruesi.Mbiemri, perdoruesi.Edukimi, perdoruesi.Profili, eksperiencat_e_punes.Emri_i_kompanise, eksperiencat_e_punes.Titulli_pozites 
            FROM aplikimet 
            LEFT OUTER JOIN perdoruesi ON aplikimet.Id_Perdoruesi = perdoruesi.Id_Perdoruesi 
            LEFT OUTER JOIN eksperiencat_e_punes ON perdoruesi.Id_Perdoruesi = eksperiencat_e_punes.id_Perdoruesi 
            WHERE aplikimet.id_kompania = " . $_SESSION['id_kompania'] . " AND aplikimet.id_shpallja = '" . $id_shpallja . "'";

            $rezultati = mysqli_query($lidhe, $sql);

            while ($row = mysqli_fetch_array($rezultati)) {
            ?>
                <div class="box">
                     <!-- <div class="stars">
                         Stars content 
                    </div> -->
                    <b><h2 style="float:left"></h2></b>
                    <ul>
                            <h2>Profili</h2>
                            <li><p style="float:left"><?= $row['Profili'] ?></p></li>
                        </ul>
                    <div class="skills" style="padding:12px  ">
                        <ul>
                            <h2>eksperienca</h2>
                            <li><?= $row['Titulli_pozites'] . " at " . $row['Emri_i_kompanise'] ?></li>
                        </ul>
                        <ul>
                            <h2>Edukimi</h2>
                            <li><?= $row['Edukimi'] ?></li>
                        </ul>
                    </div>
              
                <div class="user">
                    <img src="./images/360_F_305467506_QczGkOYLChAeFpjsLrzFltFXwxunx0xE.jpg" alt="" >
                    <div>
                        <h3><?= $row['Emri']." ". $row['Mbiemri'] ?></h3>
                    </div>
                    <form method='POST' action='applications.php'>
                        <input type='hidden' name='id_kompania' value="<?= $row['Id_Aplikimi'] ?>">
                        <input type='hidden' name='kompania' value="<?= $row['Emri'] ?>">
                        <input type='hidden' name='id_shpallja' value="<?= $id_shpallja ?>">
                        <button type='submit' name='apply_btn' class="btn">Delete</button>
                    </form>
                    <!-- <a href="" >Delete</a> -->
                   
                </div>
            </div>
            <?php
            }
            ?>
        </div>
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
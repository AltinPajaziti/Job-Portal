<?php
session_start();
if(!(isset($_SESSION['emri_kompanise'])!= '')){
    header('location: index2.php');
}
include('config.php');



if(isset($_POST['delete_submit'])){
  $id = $_POST['id_shpallja'];
  $sql = "DELETE FROM shpalljet WHERE id_shpallja=?";

  
  $stmt = mysqli_prepare($lidhe, $sql);
  mysqli_stmt_bind_param($stmt, "i", $id);
  $result = mysqli_stmt_execute($stmt);
  
  if($result) {
      echo "Record deleted successfully";
  } else {
      echo "Error deleting record: " . mysqli_error($lidhe);
  }
  mysqli_stmt_close($stmt); }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view all jobs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">

    <style>
        li{
            list-style-type: none;
        }
        a {
            text-decoration: none;
        }

        .btn:hover {
            color: white;
        }

        .jobs-container .box-container {
            display: flex !important;
            flex-direction: column !important;
        }

        .jobs-container .box-container .box {
            box-sizing: border-box;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .tags {
            margin-right: 10px;
            width: 380px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .flex-btn {
            display: flex; 
            flex-direction: row;
            width: 12%;
            gap: 10px; 
            align-items: center; 
        }

        .flex-btn .btn {
           
            margin-top: 0px;
            padding: 12px;
            font-size: 12px;
        }

        @media (max-width: 991px) {
            html {
                font-size: 55%;
            }
        }

        @media (max-width: 768px) {
            #menu-btn {
                display: inline-block;
            }

            .header .flex .navbar {
                position: absolute;
                top: 99%;
                left: 0;
                right: 0;
                border-top: var(--border);
                background-color: var(--white);
                padding: 1rem .5rem;
                clip-path: polygon(0 0, 100% 0, 100% 0, 0 0);
                transition: .2s linear;
            }

            .header .flex .navbar.active {
                clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
            }

            .header .flex .navbar a {
                display: block;
                padding: 1.5rem 2rem;
            }
        }

        @media (max-width: 450px) {
            html {
                font-size: 50%;
            }

            .section-title {
                font-size: 3rem;
                padding: 4rem 2rem;
            }
        }

        @media (min-width: 375px) and (max-width: 475px) {
            .tags {
                width: 250px;
                display: flex;
                justify-content: center;
            }
           .flex-btn{
            width: 120px;
           }
        }
    </style>
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




    <section class="jobs-container">
        
        <h1 class="heading">
            Shpalljet
        </h1>
        <a href="shtoShpallje.php" class="btn">shto Shpallje</a>
        <br>
        <br>
   <?php
   $sql = "SELECT shpalljet.Shpallja, shpalljet.orari , shpalljet.Paga , shpalljet.data_e_shpalljes ,shpalljet.id_shpallja , shpalljet.data_e_shpalljes, kategorite.Emri_kategorise, shpalljet.id_kompania 
   FROM shpalljet 
   LEFT OUTER JOIN kategorite ON shpalljet.id_kategoria = kategorite.id_Kategoria 
   WHERE shpalljet.id_kompania = '" . $_SESSION['id_kompania'] . "' AND kategorite.id_kategoria = shpalljet.id_kategoria";
   $result = mysqli_query($lidhe , $sql);
   if ($result) {
   
       
   }
       while($row = mysqli_fetch_assoc($result)) {

        ?>
            <div class="box-container">
                <div class="box">
                    <div class="company" >
                        <img src="./images/360_F_305467506_QczGkOYLChAeFpjsLrzFltFXwxunx0xE.jpg" alt="" style="width: 250px;">
                        <div><h3 class="job-title"><?= $row["Shpallja"] ?></h3>
                            
                            <p><?= $row["data_e_shpalljes"] ?></p>
                        </div>
                    </div>
                    
                    <div class="tags">
                        <p><i class="fa-solid fa-euro-sign"></i><span><?= $row["Paga"] ?></span></p>
                        <p><i class="fas fa-briefcase"></i><span><?= $row["orari"] ?></span></p>
                        <p><i class="fas fa-clock"></i><span>day-shift</span></p>
    
                    </div>
                    <div class="flex-btn">
                        <form action='applications.php' method='POST'>
                            <input type='hidden' name='id_shpallja' value="<?= $row['id_shpallja'] ?> ">
                            <button type='submit' class ='btn'>View </button>
                        </form>
                        <form action='shpalljet.php' method='POST'>
                            <input type='hidden' name='id_shpallja' value=<?= $row["id_shpallja"]?>>
                            <button type='submit' name='delete_submit' class='btn'>Delete</button>
                        </form>
                        <!-- <a href="view_job.html" class="btn">view </a>
                        <a href="view_job.html" class="btn">Delete</a> -->

                        
                    </div>
                    
                
                    
                    



                </div>

                <?php }
            ?>
                
            </div>
            
           
     
        
        <div style="text-align: center; margin-top: 2rem;">
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
                <a href="Shto"><i class="fas fa-angle-right"></i>post jobs</a>
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

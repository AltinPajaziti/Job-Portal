<?php
session_start();
    
include('config.php');
include('Crud.php');
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

    <div class="home-container">
        <section class="home">
            <form action="jobs.php" method="post">
                <h3> find your next job </h3>
                <p>New Job Alert! 🚀 Join us  and be part of something great! Apply now and let your career soar!</p>
                <input type="submit" value="search job" name="submit" class="btn">
            </form>
        </section>
    </div>
    <section class="category">
        <h1 class="heading">job category</h1>
        <div class="box-container">
        <?php
$sql = "SELECT Emri_kategorise FROM kategorite WHERE Emri_kategorise='IT'";
$result = mysqli_query($lidhe, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emri_kategorise = $row["Emri_kategorise"];
?>
            <a href="" class="box">
                <i class="fas fa-code"></i>
                <div>
                    <h3><?php echo $emri_kategorise; ?></h3>
                    <span>1200</span>
                </div>
            </a>
<?php
        }
    }
}
?>

<?php
$sql = "SELECT Emri_kategorise FROM kategorite WHERE Emri_kategorise='Edukim'";
$result = mysqli_query($lidhe, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emri_kategorise = $row["Emri_kategorise"];
?>
            <a href="" class="box">
                <i class="fas fa-school"></i>
                <div>
                    <h3><?php echo $emri_kategorise; ?></h3>
                    <span>1200</span>
                </div>
            </a>
<?php
        }
    }
}
?>

<?php
$sql = "SELECT Emri_kategorise FROM kategorite WHERE Emri_kategorise='Ekonomi'";
$result = mysqli_query($lidhe, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emri_kategorise = $row["Emri_kategorise"];
?>
            <a href="" class="box">
                <i class="fas fa-chart-pie"></i>
                <div>
                    <h3><?php echo $emri_kategorise; ?></h3>
                    <span>1200</span>
                </div>
            </a>
<?php
        }
    }
}
?>

<?php
$sql = "SELECT Emri_kategorise FROM kategorite WHERE Emri_kategorise='sport'";
$result = mysqli_query($lidhe, $sql);

if ($result) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $emri_kategorise = $row["Emri_kategorise"];
?>
            <a href="" class="box">
                <i class="fas fa-table-tennis"></i>
                <div>
                    <h3><?php echo $emri_kategorise; ?></h3>
                    <span>1200</span>
                </div>
            </a>
<?php
        }
    }
}
?>

        </div>
    </section>

    
    

    <section class="jobs-container">
        <h1 class="heading">
            latest jobs
        </h1>
        
            <div class="box-container">
            <?php
        $sql = "SELECT shpalljet.Shpallja, shpalljet.id_shpallja, shpalljet.orari, shpalljet.data_e_shpalljes, shpalljet.Paga, kompania.Emri, kompania.Foto,kompania.id_lokacioni 
                FROM shpalljet 
                LEFT OUTER JOIN kompania ON shpalljet.id_kompania = kompania.id_Kompania 
                LIMIT 6";

        $rezultati = mysqli_query($lidhe, $sql);

        while ($row = mysqli_fetch_array($rezultati)) {
            $lokacioni = "Location not found";

            $lokacioni_sql = "SELECT lokacioni FROM Lokacioni WHERE id_lokacioni='" . $row['id_lokacioni'] . "'";
            $rez_lokacioni = mysqli_query($lidhe, $lokacioni_sql);

            if ($rez_lokacioni) {
                $lokacioni_row = mysqli_fetch_assoc($rez_lokacioni);
                $lokacioni = $lokacioni_row['lokacioni'];
            }

            ?>
                <div class="box">
                    <div class="company">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Foto']); ?>"   />
                        <div>
                            <h3><?= $row['Emri'] ?></h3>
                            <p><?= $row['data_e_shpalljes'] ?></p>
                        </div>
                    </div>
                    <h3 class="job-title"><?= $row['Shpallja'] ?></h3>
                    <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $lokacioni ?></span></p>
                    <div class="tags">
                        <p><i class="fa-solid fa-euro-sign"></i><span><?= $row['Paga'] ?></span></p>
                        <p><i class="fas fa-briefcase"></i><span><?= $row['orari'] ?></span></p>
                    </div>
                    <div class="flex-btn">
                    <form method='POST' action='view.php'>
                            <input type='hidden' name='lokacioni' value=<?= $lokacioni ?>>
                            <input type='hidden' name='id_shpallja' value=<?= $row['id_shpallja'] ?>>

                            <input type='hidden' name='kompania' value=<?= $row['Emri'] ?>>


                            <button type='submit' name='apply' class='btn'>view</button>

                        </form>
                        <button type="submit" class="far fa-heart" name="save"></button>
                    </div>
                </div>
                <?php } ?>
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

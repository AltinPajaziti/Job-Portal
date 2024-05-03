<?php

session_start();
if ((isset($_SESSION['emri_kompanise']) != '')) {
    header('Location: home.php');
}
include ('config.php');
include ('Crud.php');


if (isset($_POST['submit_btn'])) {
    $search = $_POST['search'];
    $kategoria = $_POST['kategoria'];
    $Lokacioni = $_POST['lokacioni'];



    $sql = "SELECT shpalljet.Shpallja, shpalljet.id_shpallja  , shpalljet.orari, shpalljet.id_shpallja , shpalljet.pershkrimi, shpalljet.data_e_shpalljes , shpalljet.Paga , kompania.Emri , kompania.id_lokacioni,kompania.Foto ,kompania.id_Kompania  , kategorite.Emri_kategorise FROM shpalljet LEFT OUTER JOIN kompania ON shpalljet.id_kompania = kompania.id_Kompania LEFT OUTER JOIN kategorite on shpalljet.id_kategoria = kategorite.id_Kategoria
      WHERE 1=1";

    if (!empty($search)) {
        $sql .= " AND shpalljet.Shpallja LIKE '%$search%'";
    }
    if (!empty($kategoria)) {
        $sql .= " AND kategorite.Emri_kategorise = '$kategoria'";
    }
    if (!empty($Lokacioni)) {
        $sql .= " AND kompania.id_lokacioni = '$Lokacioni'";
    }

    $rezultati = mysqli_query($lidhe, $sql);
} else {
    $sql = "SELECT shpalljet.Shpallja , shpalljet.id_shpallja ,shpalljet.pershkrimi , shpalljet.orari,shpalljet.data_e_shpalljes , shpalljet.Paga , kompania.Emri , kompania.id_lokacioni , kompania.id_Kompania , kompania.Foto ,kategorite.Emri_kategorise FROM shpalljet LEFT OUTER JOIN kompania ON shpalljet.id_kompania = kompania.id_Kompania LEFT OUTER JOIN kategorite on shpalljet.id_kategoria = kategorite.id_Kategoria";

    $rezultati = mysqli_query($lidhe, $sql);
}




?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>view all jobs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
</head>
<style>
    a {
        text-decoration: none;
    }

    .btn:hover {
        color: white;
    }
    li{
        list-style-type: none;
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
    <section class="job-filter">
        <h1 class="heading">Filter jobs</h1>

        <form action="jobs.php" method="POST">
            <div class="flex">
                
                <div class="box">
                    <input type="text" name="search" id="" class="input" placeholder="Search your job">
                    
                    <select class="form-select form-select-lg mb-3 input" name="kategoria">
                    
                        <option selected></option>
                        <?php
                        $sql = "SELECT * FROM kategorite";
                        $result = mysqli_query($lidhe, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['Emri_kategorise'] . "'>" . $row['Emri_kategorise'] . "</option>";
                        }
                        ?>
                    </select>





                    <select id="cars" class="form-select form-select-lg mb-3 input" name="lokacioni">
                        <option selected ></option>
                        <?php
                        $sql = "SELECT * FROM Lokacioni";
                        $result = mysqli_query($lidhe, $sql);
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<option value='" . $row['id_lokacioni'] . "'>" . $row['lokacioni'] . "</option>";
                        }
                        ?>
                    </select>

                    <button class="btn" style="margin-top: 0;" name="submit_btn">Search</button>
                </div>
            </div>
        </form>
    </section>

    <section class="jobs-container">
        <h1 class="heading">All jobs</h1>
        <div class="box-container">
            <?php while ($row = mysqli_fetch_array($rezultati)) { ?>
                <div class="box">
                    <div class="company">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Foto']); ?>"   />
                        <div>
                            <h3><?= $row['Emri'] ?></h3>
                            <p><?= $row['data_e_shpalljes'] ?></p>
                        </div>
                    </div>
                    <h3 class="job-title"><?= $row['Shpallja'] ?></h3>
                    <?php
                    $lokacioni_sql = "SELECT lokacioni FROM Lokacioni WHERE id_lokacioni='" . $row['id_lokacioni'] . "'";
                    $rez_lokacioni = mysqli_query($lidhe, $lokacioni_sql);

                    if ($rez_lokacioni) {
                        $lokacioni_row = mysqli_fetch_assoc($rez_lokacioni);
                        $lokacioni = $lokacioni_row['lokacioni'];
                    }
                    ?>
                    <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $lokacioni ?></span></p>
                    <div class="tags">
                        <p><i class="fa-solid fa-euro-sign"></i><span><?= $row['Paga'] ?></span></p>
                        <p><i class="fas fa-briefcase"></i><span><?= $row['orari'] ?></span></p>
                    </div>
                    <div class="flex-btn">
                        <form method='POST' action='view.php'>
                            <input type='hidden' name='id_kompania' value=<?= $row['id_Kompania'] ?>>
                            <input type='hidden' name='lokacioni' value=<?= $lokacioni ?>>
                            <input type='hidden' name='id_shpallja' value=<?= $row['id_shpallja'] ?>>

                            <input type='hidden' name='kompania' value=<?= $row['Emri'] ?>>


                            <button type='submit' name='apply' class='btn'>view</button>

                        </form>
                        <button type="submit" class="far fa-heart" name="save"></button>

                        <!-- <a href="#" class="btn">View details</a> -->
                    </div>
                </div>
            <?php } ?>
        </div>
        <div style="text-align: center; margin-top: 2rem;">
            <a href="job.html" class="btn">View all</a>
        </div>
    </section>

    <footer class="footer">
        <section class="grid">
            <div class="box">
                <h3>Quick links</h3>
                <a href="home.html"><i class="fas fa-angle-right"></i>Home</a>
                <a href="about.html"><i class="fas fa-angle-right"></i>About</a>
                <a href="jobs.html"><i class="fas fa-angle-right"></i>Jobs</a>
                <a href="contact.html"><i class="fas fa-angle-right"></i>Contact</a>
                <a href="contact.html"><i class="fas fa-angle-right"></i>Filter search</a>
            </div>
            <div class="box">
                <h3>Extra links</h3>
                <a href="login.html"><i class="fas fa-angle-right"></i>Account</a>
                <a href="register.html"><i class="fas fa-angle-right"></i>Register</a>
                <a href="login.html"><i class="fas fa-angle-right"></i>Login</a>
                <a href="#"><i class="fas fa-angle-right"></i>Post jobs</a>
                <a href="#"><i class="fas fa-angle-right"></i>Dashboard</a>
            </div>
            <div class="box">
                <h3>Follow us</h3>
                <a href="#"><i class="fab fa-facebook"></i>Facebook</a>
                <a href="#"><i class="fab fa-twitter"></i>Twitter</a>
                <a href="#"><i class="fab fa-instagram"></i>Instagram</a>
                <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a>
                <a href="#"><i class="fab fa-youtube"></i>Youtube</a>
            </div>
        </section>
        <div class="credit">&copy; Copyright @2024</div>
    </footer>
    <script src="./js/script.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
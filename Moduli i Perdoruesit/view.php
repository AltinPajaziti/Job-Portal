<?php
include('config.php');
include('Crud.php');

session_start();

if (isset($_POST['apply_btn'])) {
    if (isset($_SESSION['id'])) {
        $kompania = $_POST['kompania'];
        $id_perdoresi = $_SESSION['id'];
        $id_kompania = $_POST['id_kompania'];
        $id_shpallja = $_POST['id_shpallja'];

        $check_query = "SELECT * FROM aplikimet WHERE id_Perdoruesi = $id_perdoresi AND id_shpallja = $id_shpallja";

        $check_result = mysqli_query($lidhe, $check_query);
        if (!$check_result) {
            die('Error: ' . mysqli_error($lidhe));
        }

        if (mysqli_num_rows($check_result) > 0) {
            echo "You have already applied for a job offered by this company.";
        } else {
            $kompania = $_POST['kompania'];
            $crud->Create('aplikimet', [
                'Emri_kompanise' => $kompania,
                'id_Perdoruesi' => $id_perdoresi,
                'id_kompania' => $id_kompania,
                'id_shpallja' => $id_shpallja
            ]);

            echo "The data is inserted successfully.";
        }
    } else {
        header('location:index1.php');
        exit;
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

    <?php
    $lokacioni = $_POST['lokacioni'];
        $id_shpallja = $_POST['id_shpallja'];
        $sql = "SELECT * FROM shpalljet WHERE id_shpallja='" . $id_shpallja . "'";
        $result_details = mysqli_query($lidhe, $sql);
        while ($row = mysqli_fetch_assoc($result_details)) :
    ?>

            <section class="job-details">
                <h1 class="heading">job details</h1>
                <div class="details">
                    <div class="job-info">

                        <h3><?= $row['Shpallja'] ?></h3>

                        <?php
                        $sql_kompania = "SELECT Emri FROM kompania";
                        $result_kompania = mysqli_query($lidhe, $sql_kompania);

                        $kompania_sql = "SELECT Emri FROM kompania WHERE id_kompania='" . $row['id_kompania'] . "'";
                        $rez_kompania = mysqli_query($lidhe, $kompania_sql);

                        if ($rez_kompania) {
                            $kompania_row = mysqli_fetch_assoc($rez_kompania);
                            $kompaniaa = $kompania_row['Emri'];
                        }
                        ?>

                        <a href=""><?= $kompaniaa ?></a>
                        <?php
                        // $lokacioni_sql = "SELECT lokacioni FROM Lokacioni WHERE id_lokacioni='" . $row['id_lokacioni'] . "'";
                        // $rez_lokacioni = mysqli_query($lidhe, $lokacioni_sql);
                    
                        // if ($rez_lokacioni) {
                        //     $lokacioni_row = mysqli_fetch_assoc($rez_lokacioni);
                        //     $lokacioni = $lokacioni_row['lokacioni'];
                        // }

                        ?>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo $lokacioni; ?></p>
                    </div>
                    <div class="basic-details">
                        <h3>salary</h3>
                        <p><?= $row['Paga'] ?>€</p>
                        <h3>job type</h3>
                        <p><?= $row['orari'] ?></p>

                    </div>
                    <ul>
                        <h3>Skills</h3>
                        <?php
                        $skills_array = explode(" ", $row['skills']);

                        foreach ($skills_array as $skill) {
                            echo "<li>" . $skill . "</li>";
                        }
                        ?>
                    </ul>
                    <ul>

                        <h3>qualifications</h3>
                        <?php
                        $skills_array = explode(" ", $row['kualifikimet']);

                        foreach ($skills_array as $skill) {
                            echo "<li>" . $skill . "</li>";
                        }
                        ?>
                    </ul>

                    <div class="description">
                        <h3>job description</h3>
                        <p><?= $row['pershkrimi'] ?></p>
                        <ul>
                            <!-- <li>hiring 2 candidates for the role</li> -->
                            <li>posted <?= $row['data_e_shpalljes'] ?></li>
                        </ul>
                    </div>
                    <form action="view.php" method="post" class="flex-btn">
                        <input type='hidden' name='id_kompania' value='<?= $row['id_kompania'] ?>'>
                        <input type='hidden' name='id_shpallja' value='<?= $row['id_shpallja'] ?>'>
                        <input type="hidden" name="kompania" value="<?= $kompaniaa ?>">
                        <input type="hidden" name="lokacioni" value="<?= $lokacioni ?>">
                        <button type='submit' name='apply_btn' class="btn">Apply</button>

                        <button type="submit" class="save"><i class="far fa-heart"></i><span>Save job</span></button>
                    </form>
                </div>
            </section>

    <?php endwhile;
     ?>

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

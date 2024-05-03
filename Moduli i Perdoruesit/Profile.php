<?php
session_start();
if (!(isset($_SESSION['emri']) != '')) {
    header('Location: index.php');
}
include ('Crud.php');
include ('config.php');

?>


<?php


if (isset($_POST['submit'])) {
    
    $sql = "UPDATE perdoruesi SET Profili='" . $_POST['Profili'] . "' WHERE Id_Perdoruesi='" . $_SESSION['id'] . "'";
    $result = mysqli_query($lidhe, $sql);
    if ($result) {
        echo "<script>
                    setTimeout(() => {
                        alert('The data is inserted');
                    }, 300);
                </script>";
        header("location: Profile.php");
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about</title>
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
    .box1 {
        display: flex;

        gap: 40px;
    }

    .box3 {
        display: flex;

        gap: 10px;
    }

    #edukimi {
        font-size: 18px;
    }

    form textarea {
        width: 400px;
        height: 200px;
        border-radius: 8px;
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

    <?php
    $sql = "SELECT * From perdoruesi WHERE Id_Perdoruesi='" . $_SESSION['id'] . "'";
    $result = mysqli_query($lidhe, $sql);

    if ($result) {
        while ($row = mysqli_fetch_array($result)) {

            ?>

            <section class="about">
                <div class="box">
                    <div class="box1">
                        <!-- <img src="./images/360_F_305467506_QczGkOYLChAeFpjsLrzFltFXwxunx0xE.jpg" alt=""
                            style="width: 100px;"> -->
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Foto']); ?>" style="width: 100px;"  />

                        <div>
                            <div class="box3">
                                <h3> <?php echo $row['Emri'] ?> </h3>
                                <h3> <?php echo $row['Mbiemri'] ?></h3>
                            </div>

                            <h3 id="edukimi"> <?php echo $row['Edukimi'] ?></h3>
                        </div>
                    </div>







                    <form action="profile.php" method="post">
    <h3 id="edukimi">Profile</h3>
    <div class="flex">
        <?php
        $sql = "SELECT Profili FROM perdoruesi WHERE Id_Perdoruesi='" . $_SESSION['id'] . "'";
        $result = mysqli_query($lidhe, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_array($result)) {
                ?>
                <textarea name="Profili" class="input" style="display: block; background-color: #eee;" maxlength="1000" cols="30" placeholder="Write your Profile" rows="10"><?= $row['Profili']; ?></textarea>
            <?php
            }
        } else {
            ?>
            <textarea name="Profili" class="input" style="display: block; background-color: #eee;" maxlength="1000" cols="30" placeholder="Write your Profile" rows="10"></textarea>
        <?php
        }
        ?>
        <button type="submit" name="submit" class="btn">Save</button>
    </div>
</form>

                </div>
                <?php

        }
    }

    ?>

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
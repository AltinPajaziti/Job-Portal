<?php
include('config.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emri = mysqli_real_escape_string($lidhe, $_POST['Emri']);
    $emaili = mysqli_real_escape_string($lidhe, $_POST['Emaili']);
    $numri_kompanise = mysqli_real_escape_string($lidhe, $_POST['Numri_kompanise']);
    $faqja_kompanise = mysqli_real_escape_string($lidhe, $_POST['Faqja_kompanise']);
    $id_kategoria = mysqli_real_escape_string($lidhe, $_POST['id_Kategoria']);
    $id_lokacioni = mysqli_real_escape_string($lidhe, $_POST['id_lokacioni']);
    $rreth_kompanise = mysqli_real_escape_string($lidhe, $_POST['pershkrimi']);

    $sql_update = "UPDATE kompania SET 
        Emri = '$emri', 
        Emaili = '$emaili', 
        Numri_kompanise = '$numri_kompanise', 
        webfaqja = '$faqja_kompanise', 
        id_Kategoria = '$id_kategoria', 
        id_lokacioni = '$id_lokacioni', 
        Profili = '$rreth_kompanise'
        WHERE id_Kompania = '".$_SESSION['id_kompania']."'";

  
    mysqli_query($lidhe, $sql_update);
    
    header("location: PunedhensiProfile.php");
}

$sql_select = "SELECT 
            Emri, 
            Emaili, 
            Numri_kompanise, 
            webfaqja, 
            Numri_kompanise ,
            id_Kategoria, 
            Passwordi, 
            Profili ,
            Foto
        FROM kompania 
        WHERE id_Kompania = '".$_SESSION['id_kompania']."'";
$result = mysqli_query($lidhe, $sql_select);

if ($result) {
    while ($row = mysqli_fetch_array($result)) {
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
                <a href="index1.php">Punkerkuesi</a>
                
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
        <form action="PunedhensiProfile.php" method="post">
            <h3>Profile</h3>
            <div class="box" style="float:left">

            <img src="data:image/jpeg;base64,<?php echo base64_encode($row['Foto']); ?>" style="width: 100px;"  />

                </div>
                <div class="clear"style="clear:both"></div>

            <div class="flex">
                <div class="box">

                    <p>Kompania</p>
                    <input type="text" class="input" value="<?php echo $row['Emri']; ?>" name="Emri" placeholder="Emri i Kompanise" >
                </div>
                <div class="box">
                    <p>Pozita </p>
                    <input type="email" class="input" value="<?= $row['Emaili']; ?>" name="Emaili" placeholder="example@hotmail.com">
                </div>
                <div class="box">
                    <p>Lokacioni</p>
                    
                    <select id="lokacioni" name="id_lokacioni" class="input">
                        <option value="" style="display:block"></option>
                        <?php  
                        $sql_kategoria = "SELECT * FROM lokacioni";
                        $result_kategoria = mysqli_query($lidhe, $sql_kategoria);
                        while ($row_kategoria = mysqli_fetch_array($result_kategoria)) {
                            echo "<option value='".$row_kategoria['id_lokacioni']."'>".$row_kategoria['lokacioni']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="box">
                    <p>Web faqja</p>
                    <input type="text" class="input" name="Faqja_kompanise" value="<?= $row['webfaqja']; ?>">
                </div>
                <div class="box">
                    <label for="kategoria">Kategoria</label>
                    <select id="kategoria" name="id_Kategoria" class="input">
                        <option value="" style="display:block"></option>
                        <?php  
                        $sql_kategoria = "SELECT * FROM kategorite";
                        $result_kategoria = mysqli_query($lidhe, $sql_kategoria);
                        while ($row_kategoria = mysqli_fetch_array($result_kategoria)) {
                            echo "<option value='".$row_kategoria['id_Kategoria']."'>".$row_kategoria['Emri_kategorise']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="box">
                <label for="#">Numri i kompanise</label>
                    <input type="text" value="<?= $row['Numri_kompanise'] ?>"  class="input" name="Numri_kompanise" placeholder="Numri unik i Kompanise">
                </div>
            </div>
            <p>Pershkrimi </p>
            <textarea name="pershkrimi" class="input" required maxlength="1000" cols="30" placeholder="Rreth kompanise" rows="10"><?= $row['Profili'] ?></textarea>
            <input   name="submit" type="submit" class="btn">
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

<?php 
    } // end of while loop
} // end of if statement
?>

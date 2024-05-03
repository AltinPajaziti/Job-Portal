<?php
include('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $emri = mysqli_real_escape_string($lidhe, $_POST['Emri']);
    $emaili = mysqli_real_escape_string($lidhe, $_POST['Emaili']);
    $numri_kompanise = mysqli_real_escape_string($lidhe, $_POST['Numri_kompanise']);
    $faqja_kompanise = mysqli_real_escape_string($lidhe, $_POST['Faqja_kompanise']);
    $id_kategoria = mysqli_real_escape_string($lidhe, $_POST['id_Kategoria']);
    $lokacioni = mysqli_real_escape_string($lidhe, $_POST['lokacioni']);
    $rreth_kompanise = mysqli_real_escape_string($lidhe, $_POST['Rreth_kompanise']);
    $passwordi = mysqli_real_escape_string($lidhe, $_POST['Passwordi']);
    $foto =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));

    $sql = "INSERT INTO kompania (Emri, Emaili, Numri_kompanise, webfaqja, id_Kategoria, id_lokacioni, Passwordi, Profili , Foto) VALUES ('$emri', '$emaili', '$numri_kompanise', '$faqja_kompanise', '$id_kategoria', '$lokacioni', '$passwordi', '$rreth_kompanise','$foto')";

    if (mysqli_query($lidhe, $sql)) {
        echo "Records added successfully.";
    } else {
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($lidhe);
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

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



    <section class="account-form-container">
        <section class="account-form">
            <form enctype="multipart/form-data" action="RegisterP.php"  method="post" name="form1">
                <h3>Create new account</h3>
                <input type="text" name="Emri" maxlength="50" placeholder="enter your name" class="input">
                <input type="email" name="Emaili" maxlength="50" placeholder="enter your email" class="input">
                <input type="text" name="Numri_kompanise" maxlength="50" placeholder="Numri i kompanise" class="input">
                <input type="text" name="Faqja_kompanise" maxlength="50" placeholder="Faqja kompanise" class="input">
                <label for="" style="display:block; text-align:left">kategorite</label> 

                <div style="display: flex;flex-direction:flex-start; ">
                    <select id="kategoria" name="id_Kategoria" class="input">
                        <option value=""></option>
                        <?php  
                        $sql = "SELECT * FROM kategorite";
                        $result = mysqli_query($lidhe, $sql);
                        while($row = mysqli_fetch_array($result)) {
                            echo "<option value='".$row['id_Kategoria']."'>".$row['Emri_kategorise']."</option>";
                        }
                        ?>
                    </select></div>
                
                    <label for="#" style="display:block;text-align:left">Lokaacioni</label>
                <div style="display: flex;flex-direction:flex-start; ">
                    
                    
                    <select id="cars"  name="lokacioni" class="input">
                <option  value=""></option>
                <?php  
                    $sql = "SELECT * FROM Lokacioni";
                    $result = mysqli_query($lidhe, $sql);
                    while($row = mysqli_fetch_array($result)) {
                        echo "<option value='".$row['id_lokacioni']."'>".$row['lokacioni']."</option>";
                    }
                ?>
            </select></div>
            <br>
                <div style="display: flex;flex-direction:flex-start;">
                <input name="userfile" type="file"> </div> <br>

                    <textarea  style="background-color: #eee; float: left; border-radius: 10px; width: 260px;" name="Rreth_kompanise" id="exampleInputPassword1" cols="30" rows="10" placeholder="Pershkrimi"></textarea>

                <input type="password" name="Passwordi" maxlength="20" placeholder="enter your password" class="input">
                

                <p>alredy have account? <a href="index2.php">Login</a></p>
                <input type="submit" value="Register" name="submit" class="btn">
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
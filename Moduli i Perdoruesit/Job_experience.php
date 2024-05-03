<?php
session_start();
if (!(isset($_SESSION['emri']) && $_SESSION['emri'] != '')) {
    header('Location: index.php');
    exit;
}
include ('config.php');


if (isset($_POST['delete_btn'])) {
    $id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM eksperiencat_e_punes WHERE id_Eksperienca = $id";
    if (mysqli_query($lidhe, $delete_sql)) {
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    } else {
        echo "Error deleting record: " . mysqli_error($lidhe);
    }
}

$sql = "SELECT * FROM eksperiencat_e_punes WHERE id_Perdoruesi = '{$_SESSION['id']}'";

$result = mysqli_query($lidhe, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<style>
    #clear {
        clear: both;
        color: black;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./css/style.css">
</head>

<style>
    #titulli {
        width: 500px;
        display: flex;
        align-items: center;
        justify-content: center;

    }

    a {
        text-decoration: none !important;
    }

    
    li {
        list-style-type: none;
    }

    .btn:hover {
        color: white;
    }

    #temp {
        display: flex;
        justify-content: space-evenly;
        margin-top: 8px;
        margin-bottom: 8px;
    }
    .box .pershkrimi {
        display: flex;
	flex-direction: column;
	flex-wrap: nowrap;
	justify-content: flex-start;
	align-items: flex-start;
        
    }
    #pozita{
        display: block;
        margin-right: 40px;
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
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Profile
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="Profile.php">Profili</a>
                        <a class="dropdown-item" href="Job_experience.php">Eksperiencat</a>
                        <a class="dropdown-item" href="Applied_jobs.php">Aplikimet</a>
                        <a class="dropdown-item" href="Change_password.php">Change Password</a>
                    </div>
                </li>
                <?php if (!(isset($_SESSION['emri_kompanise']))) { ?>
                    <a href="index1.php">Punkerkuesi</a>
                <?php } ?>
                <?php if (!(isset($_SESSION['emri']))) { ?>
                    <a href="index1.php">Pundhenesi</a>
                <?php } ?>

                <a href="jobs.php">jobs</a>

                <?php
                if (isset($_SESSION['emri_kompanise']) || isset($_SESSION['emri'])) {
                    ?>
                    <a href="logout.php">Logout</a>
                    <?php
                }
                ?>

            </nav>
            <a href="#" class="btn" style="margin-top: 0; visibility: hidden"></a>

        </section>
    </header>

    <?php if (mysqli_num_rows($result) > 0) { ?>

        <a href='addjob_experience.php' class='btn' style='width:150px;font-size:12px '>Add more</a>

    <?php } ?>

    <section class="reviews">
        <div class="box-container">
            <?php if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                    <div class="box">
                        <span>Kompania</span>
                        <h2><?php echo $row['Emri_i_kompanise']; ?></h2>
                        <div id="temp">
                            <div class="fillimi">
                                <label for="#">Data e fillimit:</label>
                                <h3><?php echo $row['data_fillimit']; ?></h3>
                            </div>
                            <div class="perfundimi">
                                <label for="#">Data e Perfundimit</label>
                                <h4><?php echo $row['data_perfundimit']; ?></h4>
                            </div>

                        </div>
                        
                        <div class="pershkrimi">
                        <span>Pershkrimi</span>
                            

                            <strong>
                                <h2><?php echo $row['Pershkrimi']; ?></h2>
                            </strong>
                        </div>


                        <div class="user">
                            <div id="pozita">
                                <span>Pozita</span><br>
                                <h2><b><?php echo $row['Titulli_pozites']; ?></b></h2>
                                
                            </div>
                            <br>
                            <div class="forma" style="display:block">
                            <form method="POST" action="<?= $_SERVER['PHP_SELF'] ?>">
                                    <input type="hidden" name='delete_id' value="<?php echo $row['id_Eksperienca']; ?>">
                                    <button type="submit" name='delete_btn' class="btn">Delete</button>
                                </form>
                            </div>
                            
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "             <div id='titulli'>
                <h1 id='titulli'>There are no Eksperiences added add one</h1>
                <a href='addjob_experience.php' class='btn' style='width:200px'>Add</a>
</div>

                   
                ";

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
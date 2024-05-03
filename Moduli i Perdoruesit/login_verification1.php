<?php
	session_start();
	include("config.php");
	


	if(isset($_POST["submit"]))
	{
		if(empty($_POST["email"]) || empty($_POST["password"]))
		{
			$error = "Duhet të plotësohen të dy fushat";
		}
		else
		{
			$emri = mysqli_real_escape_string($lidhe, $_POST['email']);
			$fjalekalimi = mysqli_real_escape_string($lidhe, $_POST['password']);

			$sql = "SELECT * FROM kompania WHERE Emaili=? AND Passwordi=?";
			$stmt = mysqli_prepare($lidhe, $sql);

			if ($stmt)
			{
				mysqli_stmt_bind_param($stmt, "ss", $emri, $fjalekalimi);
				mysqli_stmt_execute($stmt);

				$result = mysqli_stmt_get_result($stmt);

				if(mysqli_num_rows($result) == 1)
				{
					$rreshti = mysqli_fetch_array($result, MYSQLI_ASSOC);
					$_SESSION['id_Kategoria'] = $rreshti['id_Kategoria'];
					$_SESSION['emri_kompanise'] = $rreshti['Emri'];
					$_SESSION['id_kompania'] = $rreshti['id_Kompania'];
					$sql = "SELECT id_Kompania FROM kompania WHERE Emaili='" . $rreshti['Emaili'] . "'";
					$result = mysqli_query($lidhe, $sql);
	
	
					
	
	
	
	
					header("location: home.php");
					exit();
				}
				else
				{
					$error = "Gabim emri ose fjalëkalimi";
				}

				mysqli_stmt_close($stmt);
			}
			else
			{
				$error = "Pati një problem me përgatitjen e deklaratës.";
			}
		}
	}
?>

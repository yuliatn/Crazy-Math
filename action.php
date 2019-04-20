<?php
	session_start();
	$x=rand(0, 10);
	$y=rand(0, 10);
	if (isset($_POST['submit1'])){
		$uploaddir = 'photos/';
		$uploadtime = date('YmdHis');
		$uploadfile = $_POST['username']."-". $uploadtime.".".pathinfo($_FILES['uploadfile']['name'],PATHINFO_EXTENSION);
		
		if (move_uploaded_file($_FILES['userfile']['tmp_name'],$uploaddir.$uploadfile)){
			echo "File berhasil diupload";
		} else {
			echo"File gagal diupload";
		}
		$_SESSION['filenameupload'] = $uploadfile;
		setcookie('username', $_POST['username'], time()+3600*24*7);
		header("Location: action.php");
	}
	
	if (isset($_POST['submit'])){
		if ($_POST['x_old'] + $_POST['y_old'] == $_POST['hasil']){
			$_SESSION['score'] += 5;
			$status = true;
		} else {
			$_SESSION['score'] -= 1;
			$_SESSION['lives'] -= 1;
			$status = false;
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Crazy Math</title>
</head>
<body>
	<h1>Crazy Math</h1>
	<?php
		echo "<p>Username: ".$_COOKIE['username']."</p>";
		echo "<p>Lives: ".$_SESSION['lives']."</p>";
		echo "<p>Score: ".$_SESSION['score']."</p>";
	?>
	
	<?php
		if (isset($status)){
			if ($status == true){
				echo "<h3>Jawaban Tepat</h3>";
			} else {
				echo "<h3>Jawaban Salah</h3>";
			}
		}
	?>
	<?php
		if ($_SESSION['lives'] == 0){
			echo "<h2>Game Over</h2>";
			echo "<a href='index.php'> Ulangi lagi</a>";
			setcookie('score', $_SESSION['score'], time()+3600*24*7);
			setcookie('lasttime', date('d/m/Y/ H:i'), time()+3600*24*7);
			
			include 'dbconfig.php';
			$db = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
			$query = "INSERT INTO scores (username, score, lasttime, foto)VALUES ('".$_COOKIE['username']."',".$_SESSION['score'].",'".date('Y-m-d H:i:s')."','".$_SESSION['filenameupload']."')";
			
			$hasil = mysql_query($db, $query);
		} else {
	?>
		<form method="post" action="action.php">
			<?php
				echo "$x + $y = " ;
			?>
			
			<input type="hidden" name="x_old" value="<?php echo $x; ?>">
			<input type="hidden" name="y_old" value="<?php echo $y; ?>">
			<input type="text" name="hasil">
			<input type="submit" name="submit">
		</form>
		<?php
		}
		?>
</body>
</html>
			
			
	
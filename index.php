
<?php
	session_start();
	
	
	setcookie('username','',time()-3600);
	if (isset($_COOKIE['username'])){
		$status = true;
	} else {
		$status = false;
	}
	setcookie('score','',time()-3600);
	setcookie('lasttime','',time()-3600);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Game CrazyMath</title>
</head>
<body>
	<h1>Crazy Math</h1>
	<form enctype="multipart/form-data" method="post" action="action.php">
	<?php
	if ($status == false){
	?>
		Masukkan Nama Anda : <input type="text" name="username"><br>
		Masukkan Foto Anda : <input type="file" name="userfile"/><br>
		<input type="submit" name="submit1" value="Start">
	<?php
	} else {
		echo "<p>Welcome Back".$_COOKIE['username']."</p>";
        echo "<p>terakhir kali Anda main game ini pada ".$_COOKIE['lasttime']." dengan score ".$_COOKIE['score']."</p>";
    
		echo "<a href='index.php' name='status' value='false'>Not you? </a>";
	?>
		<input type="submit" name="submit2" value="Start">
	<?php
	}
	?>
	</form>
	<?php
		$_SESSION['lives']= 5;
		$_SESSION['score']= 0;
	?>
</body>
</html>
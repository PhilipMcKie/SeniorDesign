<?php
session_start();
require_once "connection.php";


if(isset($_POST["submit"])){
	
	try{
	$pd = dbaseconn();
	$stmt = $pd->prepare("select sno from student where username=:username AND pass=:pass");
	$stmt->execute([':username' => $_POST['username'], ':pass' => $_POST['password']]);
	$arr = $stmt->fetch(PDO::FETCH_ASSOC);
	
	if(!$arr){
		$pd = false;
		
	}
	

	}catch(Exception $e){
		echo "Something bad happened!";
		echo $e->getMessage();
		exit();
	
	}
	if($pd != false){
		$_SESSION["username"] = $_POST["username"];
		$_SESSION["password"] = $_POST["password"];
		$_SESSION["sno"] = rtrim($arr["sno"]);
		$_SESSION["loggedin"] = 'true';
		header("Location: overview.php");
		exit();
	}
	else{
		echo "login failed!<br>";
	}


}

?>


<!DOCTYPE html>

<html>
	<head>
	
		<style>
		section.hd{
			border-style: solid;
			border-width: 2px;
			text-align: left;
			background-color: blue;
			color: white;
			padding:5px;
			height:100px;
		}


		input[type=text]{
			width: 50%;
			height: 5px;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			background-color: gold;
			border-collapse: collapse;
			border-color:blue;
			color: black;
		
		}
		
		input[type=password]{
			width: 50%;
			height: 5px;
			padding: 12px 20px;
			margin: 8px 0;
			box-sizing: border-box;
			background-color: gold;
			border-collapse: collapse;
			border-color:blue;
			color: black;
		
		}

		body{
			background-color: #acc2b2;
		}

		label{
		float: left; width: 10em; margin-right:1em;
		}
		
		div.absolute {
		position: absolute;
		bottom: 10px;
		width: 100%;
		color:white;
		border-style: solid;
		border-width: 1px;
		text-align: center;
		background-color: gold;
		}
		
		div.center {
		position: absolute;
		center: 10px;
		}
		
		textboxid
		{
		height:200px;
		font-size:14pt;
		}
		
		</style>

		<section class="hd">

			<img src="teis.png" align="right" width="170" height="67.5">
			<h1> TEIS Login </h1>
		</section>
	</head>


	<body>
		
		

		<form method="post" action="./index.php">


			
			
			
			<div style="border-width: 2px; border-style: solid; border-color:#acc2b2;" align="center">
			
			
			
			<!--<label for="username">Username </label>-->
			
			<br>
			<br>
			<br>
			<input type="text" name="username" align="center" style="width:200px; margin-right:25%" placeholder="Username...">
			<img src="usernamepassword.png" align="left" width="100" height="100" style="margin-left:20%">
			<br>
			<br>
			<!--<label for="password">Password </label>-->
			
			
			<input type="password" name="password" align="center" style="width:200px; margin-right:25%" placeholder="Password...">
			
			

			</div>
			<br>
			<br>
			<br>

			
			<input type="submit" name ="submit"  value="Login" style="width:10%; height:45px; ;color:blue; background-color:gold; border: 2px solid black; font-size: 25px; margin-left:45%;" align="center">

		</form>
		
		<?php
			if(isset($_POST)) {

			}	
			else {
				echo "Login Failed!";
					
			}
		

			

		?>		


		<div class="absolute" align="bottom">

			<h1> <br> </h1>
		</div>

	</body>






</html>



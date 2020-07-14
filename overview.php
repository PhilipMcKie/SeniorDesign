<!# DOCTYPE HTML>

<?php
	session_start();
	require_once "connection.php";
	$pd = dbaseconn();



	if(strcmp($_SESSION["loggedin"], "true") != 0){
		header("Location: index.php");
		exit();

	}

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST["logout_x"])){
			session_destroy();
			header("Location: index.php");
			exit();		

		}
		if(isset($_POST["grades"])){
			header("Location: grades.php");
			exit();

		}

		
		//var_dump($_POST);

		$count = sizeof($_SESSION["classes"]);
		$init = 1;

		while($init < ($count + 1)){
				
			if(isset($_POST["class_".$init])){
				$_SESSION["sclass"] = $_SESSION["classes"][($init-1)] ;
				header("Location: class.php");
				exit();
			}
		$init++;	
		
		}

	}
	
?>

<html>
	<head>
	
		<style>
		body{
			background-color: #acc2b2;
		}

		*{
		font-family:"Georgia";
		
		}
		

		h1.color{
		color:navy;

		}

		section.hd{
			border-style: solid;
			border-width: 2px;
			border-color: black;
			text-align: left;
			background-color: blue;
			color: white;
			padding: 5px;
			height: 100px;
		}


		


		input[type="submit"].menu{
			width: 50%;
			height: 60px;
			margin: 8px 0;
			box-sizing: border-box;
			color: blue;
			background-color: gold;
			border: 2px solid black;
			border-collapse: collapse;
			border-color: black;
			font-size: 25px; 
			
			align: center;
			margin-left: 14%;
			margin-right:14%;
			
			
		
		}
		
		input[type="submit"].classes{

		width:75%;
		height:45px; 
		color:blue; 
		background-color:gold; 
		border: 2px solid black; 
		font-size: 25px; 
		float:right; 
		margin-right:19.75%;
		}
		
		div.absolute{
			width:100%;
			background-color: gold;
			height: 50px;
			border: 2px solid black;


		} 

		</style>

		
	</head>


	<body>
	
			<section class="hd">
				<img src="teis.png" align="right" width="170" height="67.5"></img>
				<form method="post" action="./overview.php">
				
					<input type="image" name="logout" alt="logout" src="logout.png" align="left" width="70" height="70">
			
				</form>
			</section>
			


			<div style="width:100%; height: 400px;">

				<div style="width 100% height 20%; display:block">
					<?php   	
						
						$stmt = $pd->query("select fname, lname from student where sno = ".$_SESSION["sno"]);
						$stmt->execute();
						$str = "";
						while($row=$stmt->fetch(PDO::FETCH_NUM)){
							$str = $row[0]." ".$row[1];
							echo  "<h1 class=color align=\"center\"><b><u>Welcome, ".$str."!</u></b></h1>";
						}
					?>	

				</div>
			
				<div style="width: 50%; height: 80%; float:left; display: inline-block;">
					<h1 style="margin-left:14%; float:left;" class="color" align="center"><b><u>MAIN MENU</u></b></h1>
						<form method="post" action="./overview.php">
							<input type="submit" name="grades"  value="Overall Grades" class="menu">
							<input type="submit" name="messages"  value="Messages" class ="menu"  align="left">
						</form>
				</div>


				<div style="width: 50%; height: 80%; float:right; display: inline-block;">
			
		   	 		<h1 class=color align="center"><b><u>CLASSES</u></b></h1> 
						<form method="post" action="./overview.php">
							<?php
								$pd = dbaseconn();
								$stmt = $pd->query("select enrollment.csubject, enrollment.course_number, enrollment.class_number, faculty.fname, faculty.lname, course.title from enrollment, class, faculty, course where enrollment.sno = '".$_SESSION["sno"]."' AND class.FID = faculty.FID AND class.class_number = enrollment.class_number AND enrollment.csubject = course.csubject AND enrollment.course_number = course.course_number AND enrollment.csubject = class.csubject AND enrollment.course_number = class.course_number;");	
								$stmt->execute();
								$classarr = array();
						
								$count = 0;
								while($row=$stmt->fetch(PDO::FETCH_NUM)){
									$arr = array($row[0], $row[1], $row[2], $row[3], $row[4], $row[5]);
									$classarr[$count++] = $arr;
									$str = "".$row[0]." ".$row[1]."- ".$row[2].": ".$row[5]." \t".$row[3][0].". ".$row[4];


									echo "<input type=\"submit\" name=\"class ".$count."\"  value=\"".$str."\" class =\"classes\"  align=\"left\">";
							
								}
								$_SESSION["classes"] = $classarr;


							?>
						</form>
				</div>
			</div>

			
		
		

		<br>	
		<div class="absolute">
			</div>
		
		
	</body>






</html>


			<!--		<input type="submit" name ="grades"  value="Overall Grades" style="width:50%; height:60px; ;color:blue; background-color:gold; border: 2px solid black; font-size: 25px; float:left; margin-left:14%;" align="left">

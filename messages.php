<!# DOCTYPE HTML>

<?php
	session_start();
	require_once "connection.php";
	$pd = dbaseconn();



	//if(strcmp($_SESSION["loggedin"], "true") != 0){
	//	header("Location: index.php");
	//	exit();

	//}	

	

	if($_SERVER['REQUEST_METHOD'] === 'POST'){
		if(isset($_POST["logout_x"])){
			session_destroy();
			header("Location: index.php");
			exit();
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

		h2.color{
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


		tr.b{
			background-color: dodgerblue;
			text-align:center;
			font-weight: bold;
			color: black;
		}

		tr.g{
			background-color: gold;
			text-align:center;
			font-weight: bold;
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

		div.scroll {
			margin: 4px, 4px;
			padding: 4px;
			background-color: steelblue;
			width: 500px;
			height: 110px;
			overflow-x: hidden;
			overflow-x: auto;


		}

		div.t{
			align:left;
			float:left;
			display: block;

		}

		div.s{
			align:right;
			float: right;
			display: block;

		}

		table.main{

			border-collapse: collapse;
			border: 2px solid black;
			border-color: black;
			width: 70%;
			margin-left: 15%;
			margin-right 15%

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
			


			<div style="width:100%; height: 400px; display:block;">

				<div style="width 100%; height 20%;">
					<?php   	
						
						$stmt = $pd->query("select fname, lname from student where sno = ".$_SESSION["sno"]);
						$stmt->execute();
						$str = "";
						while($row=$stmt->fetch(PDO::FETCH_NUM)){
							$str = $row[0]." ".$row[1];
							echo  "<h1 class=color align=\"center\"><b><u>Welcome, ".$str."!</u></b></h1>";
						}
							
						echo "<h1 class=color align=\"center\"><b><u>Welcome to Messages</u></b></h1>";
				?>	

				</div>

				<div style="width:100%, height:80px;">
					<form action="./messages.php" method=post>
						<label for="request"><b>Request Messages for:</b></label>
						<select name="class">
						<?php
							$pd = dbaseconn();
                                                        $stmt = $pd->query("select enrollment.csubject, enrollment.course_number, enrollment.class_number, faculty.fname, faculty.lname, course.title from enrollment, class, faculty, course where enrollment.sno = '".$_SESSION["sno"]."' AND class.FID = faculty.FID AND class.class_number = enrollment.class_number AND enrollment.csubject = course.csubject AND enrollment.course_number = course.course_number AND enrollment.csubject = class.csubject AND enrollment.course_number = class.course_number;");
							
							$stmt->execute();
							$classarr = array();
							$count = 0;
							while($row=$stmt->fetch(PDO::FETCH_NUM)){
								$arr = array($row[0], $row[1], $row[2], $row[5]);
								$classarr[$count++] = $arr;
								$str = "".$row[0]." ".$row[1]."- ".$row[2].": ".$row[5];
								echo "<option value=\"class_".$count."\">".$str."</option>";
							}

							$_SESSION["messagecl"] = $classarr;
							echo "</select>";
						?>
						<input type="submit" name="sub" value="Submit">

					</form>
				</div>

				<div style="width: 100%;" class=scroll>
						<?php
	
							if($_SERVER['REQUEST_METHOD'] === 'POST'){
								$count = sizeof($_SESSION["classes"]);
								$init = 1;
								
								while($init < ($count + 1) ){
									if($_POST["class"] === "class_".($init)){
										$_SESSION["mclass"] = $_SESSION["messagecl"][($init-1)];
										
										break;
									}
								$init++;

								}

								$pd = dbaseconn();
								$arr = $_SESSION["mclass"];

								try{
									
									
									$stmt2 = $pd->query("select FID from class where csubject = '".$arr[0]."' AND course_number = '".$arr[1]."' AND class_number = '".$arr[2]."'");
									$stmt2->execute();
									$row2 = $stmt2->fetch(PDO::FETCH_NUM);
									$FID = $row2[0];
									
								}catch(Exception $e){
									echo $e->getMessage();
								}
								
								

								$stmt = $pd->query("select message_body, fromteacher from umessages where FID = '".$FID."' AND sno ='".$_SESSION["sno"]."' order by(tstamp) ASC");
								
								while($row=$stmt->fetch(PDO::FETCH_NUM)){

									if($row[1] == 1){
										echo "<div class=t>";
									}
									else{
										echo "<div class=s>";
									}
													
									echo $row[0];
									echo "</div><br>";
								
								}
							}

						?>
				</div>
			</div>
			
			
		
		

		<br>	
		<div class="absolute">
		</div>
		
		
	</body>






</html>


			<!--		<input type="submit" name ="grades"  value="Overall Grades" style="width:50%; height:60px; ;color:blue; background-color:gold; border: 2px solid black; font-size: 25px; float:left; margin-left:14%;" align="left">

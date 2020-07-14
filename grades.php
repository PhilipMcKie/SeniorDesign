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

	}

	function getletter($earned, $total){

		if($total == 0){
			echo 'N/A';
		}
		else{
			$percent = $earned/$total * 100;

			if($percent >= 90){
				echo 'A';
			}
			else if($percent >= 80){
				echo 'B';
			}
			else if($percent >= 70){
				echo 'C';
			}
			else if($percent >=60){
				echo 'D';
			}
			else{
				echo 'F';
			}

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
						
						echo "<h1 class=color align=\"center\"><b><u>Overall Grades</u></b></h1>";
				?>	

				</div>

				<div style="width:100%, height:80%;">

					<h2 class=color align="center">Grade Breakdown per Class</h2>
					<table class="main">
						<tr>
							<th>Class</th>
							<th>Earned Points</th>
							<th>Total Possible Points</th>
							<th> Letter Grade</th>
						</tr>
							<?php
							
							$stmt = $pd->query("select enrollment.csubject, enrollment.course_number, enrollment.class_number, faculty.fname, faculty.lname, course.title from enrollment, class, faculty, course where enrollment.sno = '".$_SESSION["sno"]."' AND class.FID = faculty.FID AND class.class_number = enrollment.class_number AND enrollment.csubject = course.csubject AND enrollment.course_number = course.course_number AND enrollment.csubject = class.csubject AND enrollment.course_number = class.course_number;");			
							$stmt->execute();
							$count = 0;
							
							while($row=$stmt->fetch(PDO::FETCH_NUM)){

								if($count % 2 == 0){
									echo "<tr class=b>";
								}
								else{
									echo "<tr class=g>";
								}
								$count++;

								echo "<td>".$row[0]." ".$row[1]." - ".$row[2].": ".$row[5];
								
								$stmt2 = $pd->query("select aname, earned_points, total_points from assigned, assignment where assigned.sno = ".$_SESSION["sno"]." AND assigned.csubject = '".$row[0]."' AND assigned.course_number = '".$row[1]."' AND assigned.class_number = '".$row[2]."' AND assigned.class_number = assignment.class_number AND assigned.course_number = assignment.course_number AND assigned.csubject = assignment.csubject AND assignment.id = assigned.id;");
								$stmt2->execute();
								$total_points = 0;
								$earned_points = 0;

								while($row2=$stmt2->fetch(PDO::FETCH_NUM)){
									$total_points += $row2[2];
									$earned_points += $row2[1];

								}
									
								echo"<td>".$earned_points."</td>";
								echo"<td>".$total_points."</td>";
									
									
								echo "<td>"; getletter($earned_points, $total_points); echo" </td>";
								echo "</tr>";
								
							}
						?>
					</table>

				</div>
			
			</div>
			
			
		
		

		<br>	
		<div class="absolute">
		</div>
		
		
	</body>






</html>


			<!--		<input type="submit" name ="grades"  value="Overall Grades" style="width:50%; height:60px; ;color:blue; background-color:gold; border: 2px solid black; font-size: 25px; float:left; margin-left:14%;" align="left">

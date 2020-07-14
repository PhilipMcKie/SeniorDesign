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

		label{
		float: left; width: 10em; margin-right:1em;
		}
		
		
		fieldset{
		float: left;
		width: 50%;
		margin: 0;
		padding: 0;
		box-sizing: border-box;
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

		
	</head>


	<body>

			<section class="hd">
			<img src="teis.png" align="right" width="170" height="67.5"></img>
			<form method="post" action="./index.php">
			<a href="index.php">
			<img src="logout.png" align="left" width="70" height="70" style="padding:20px"></img>
			</a>
			<a href="overview.php">
			<img src="home.png" align="left" width="70" height="70" style="padding:10px"></img>
			</a>
			</form>
			</section>
			<br>
			

			
			<h1 align="center"><b><u>CLASS 1</u></b></h1>
			<?php
				
				$title="Intro to Database";
				$query="select title from course where title=:title";
				#$stmt=$pd->query("select enrollment.csubject, enrollment.course_number, enrollment.class_number, faculty.fname, faculty.lname, course.title form enrollment, class, faculty, course where sno = 2, AND class.FID = faculty.FID AND class.class_number = enrollment.class_number AND enrollment.csubject = course.csubject AND enrollment.course_number = course.course_number;");
				#$stmt->execute();
				#while($row=$stmt->fetch(PDO::FETCH_NUM))
					#{
						#$str = "";
						#$str = $row[0]." ".$row[1]."-".$row[2]." "." ".$row[5]." Faculty: ".$row[3]." ".$row[4];
						
						#echo <<<EOF
						#<input type = "submit" name = "submit" value = "$str" style = "width:30%; height:30px; ;color:blue; background-color:gold; border:2px solid black; font-size:16px; float:right; margin-right:19.75%" align="right">
#EOF;
					#}
				
			?>
	
			<br>
			<br>

			
			<div align="center" style="margin-left:33%">
			<form method="post" action="./assignments.php">
			<input type="submit" name ="submit" align="center" value="Assignments" style="width:250px; height:100px; ;color:blue; background-color:gold; margin-right:50%;">
			</form>
			
			<br>
			<br>
			
			<form method="post" action="./attendance.php">
			<input type="submit" name ="submit" align="center" value="Attendance" style="width:250px; height:100px; ;color:blue; background-color:gold; margin-right:50%;">
			</form>
			</div>
			
			
		<div class="absolute" align="bottom">

			<h1> <br> </h1>
		</div>
		
		
	</body>






</html>



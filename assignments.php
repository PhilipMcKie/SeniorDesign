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
		
		.grid div:nth-child(even)
		{
		text-align:center;
		background-color:white;
		border-color:black;
		border-style:solid;
		height:30px;
		}

		.grid div:nth-child(odd)
		{
		text-align:center;
		background-color:white;
		border-color:black;
		border-style:solid;
		height:30px;
		}		
		
		.grid 
		{
		margin-left:5%;
		display: grid;
		grid-template-columns:600px 200px 200px;
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
			
			<h1 style="margin-left:50%"><b><u>Class 1</u></b></h1>
			
			<h3 style="margin-left:10%; display:inline;"><b><u>Overall Grade:</u></b></h3>
			
			<br>
			<br>
			
			<fieldset style="margin-left:10%; height:100px; width:100px;">
				
				
			</fieldset>
			
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			
			<table style="float:left;">
			<h1 style="margin-left:10%; display:inline;"><b><u>Assignments:</u></b></h1>
			<h1 style="margin-left:25%; display:inline;"><b><u>Grades:</u></b></h1>
			<h1 style="margin-left:5%; display:inline;"><b><u>Due Date:</u></b></h1>
			</table>
			
			<div class="grid">
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			<div></div>
			</div>
			
			
		<div class="absolute" align="bottom">

			<h1> <br> </h1>
		</div>
		
		
	</body>






</html>



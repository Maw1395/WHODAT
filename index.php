<?php
$newrecord='';
If(isset($_POST['submitted'])){
	include 'mysql.php';
	#sets dbcon
	session_start();
	
	$number=$_POST['searchbar'];
	$_SESSION['number']=$number;
	
	$result=mysqli_query($dbcon, "Select phonenumberid FROM phonenumber WHERE phonenumberid=$number");
	
	//$sqlinsert="INSERT INTO phonenumber VALUES ($number)";
	if(mysqli_num_rows($result)>0)//
	{
		header("Location: dataform.php");
	}
	else		//if not
	{
		header("Location:template.php");
	}
	$newrecord="1 record added to the database";
	}// end of the main if statement
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="WHODAT.css">
	<title> WhoDat! </title>
	<meta charset=UTF-8>
</head>
<body>
<a href="http://forevertwentysomethings.com/wp-content/uploads/2015/01/homer-simpson.gif"><div id="WHODAT">WHODAT</div></a>
	<form class="searchbox" name="searchbox" onsubmit="return phvalidate(document.searchbox.searchbar)" method="post" action="index.php">
		<!-- <img id="logo" src="https://lh5.ggpht.com/Cv4rXpcvRUY2vnBqQ8Kgs7mZFX_EZrXlQ3c67HHNaW-UDoRs1DiTb4gPVzmgYfAbPaw=w300"></a>-->
		<ul>
			<li><input type="tel" class="textinput" name="searchbar" id="searchbar" placeholder="Enter Number"/></li>
			<li><input type="submit" class="searchbutton" value="search"/></li>
			<li><div id="textToAppend"></div></li>
			<input type="hidden" name="submitted" value="true"/>
		</ul>
	</form><!-- end of searchbox form-->

	<div class="footer">
		<ul>
			<li><a href="https://nesncom.files.wordpress.com/2014/07/serena3.gif?w=400&h=225">TOS</a></li>
			<li><a href="http://1.bp.blogspot.com/_s3Q8mgO0yGw/TP48pOBbGOI/AAAAAAAAAEI/1szgVT6MfAQ/s1600/Schema_Saeulenordnungen.jpg">Support</a></li>
			<li><a href="https://www.nsa.gov/">Privacy</a></li>
		</ul>
	</div><!--end footer-->
	<script src="phvalidate.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script><!--jquery library-->
	<?php
	echo $newrecord;
	?>
</body>
</html>
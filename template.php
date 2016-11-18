<?php
session_start();
$number=$_SESSION['number'];
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="WHODAT.css">
	<title> <?php 
		$size=strlen($number);
		if($size>10)
		{
			echo $number[0], '-';
			for($i=1; $i<4; $i++)
				echo $number[$i];
			echo'-';
			for($i=4;$i<7;$i++)
				echo $number[$i];
			echo '-';
			for($i=7; $i<11; $i++)
				echo $number[$i];
		}
		else
		{
			echo '(';
			for($i=0; $i<3; $i++)
				echo $number[$i];
			echo') ';
			for($i=3;$i<6;$i++)
				echo $number[$i];
			echo '-';
			for($i=6; $i<10; $i++)
				echo $number[$i];
		}
	?> </title>
	<meta charset=UTF-8>
</head>
<body>
	<h1 style="text-align:center;">
	No comments are aviable for 
	<?php 
		$size=strlen($number);
		if($size>10)
		{
			echo $number[0], '-';
			for($i=1; $i<4; $i++)
				echo $number[$i];
			echo'-';
			for($i=4;$i<7;$i++)
				echo $number[$i];
			echo '-';
			for($i=7; $i<11; $i++)
				echo $number[$i];
		}
		else
		{
			echo '(';
			for($i=0; $i<3; $i++)
				echo $number[$i];
			echo') ';
			for($i=3;$i<6;$i++)
				echo $number[$i];
			echo '-';
			for($i=6; $i<10; $i++)
				echo $number[$i];
		}
	?>
	<?php
		If(isset($_POST['submitted']))
		{
			include 'mysql.php';
			$sql="INSERT INTO phonenumber(phonenumberid) VALUES ('$number')";
			if ($dbcon->query($sql) === TRUE) 
			{
				$comment=$_POST['formtext'];
				$sql1="INSERT INTO comments_on_number (the_comment, comments_date, phonenumberid) VALUES('$comment', CURRENT_TIMESTAMP, '$number')";
				if($dbcon->query($sql1)===TRUE)
				{
					setcookie($number."comment");
					Header("Location:dataform.php");
				}
				/*else 
				{
				echo "Error: " . $sql1 . "<br>" . $dbcon->error;
				}
			} 
			else
			{
				echo "Error: " . $sql . "<br>" . $dbcon->error;
			}*/

			}
		}
	?>
	. You can be the first 
	</h1>
	<form class="inputform" onsubmit="return formvalidate()" method="post" action="template.php">
	<fieldset>
		<legend>Add a comment no more than 200 characters</legend>
		<ul>
			<li><textarea rows="6" cols="50" name="formtext" id='formtext' maxlength='200'></textarea></li>
			<li><input type="submit" value="submit"/></li>
			<li><div id="textToAppend1"></div></li>
			<input type="hidden" name="submitted" value="true"/>
		</ul>
	</fieldset>
	</form><!-- end of input form -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="formvalidate.js"></script>
	<form class="searchbox" name="searchbox" onsubmit="return phvalidate(document.searchbox.searchbar)" method="post" action="index.php">
		<!-- <img id="logo" src="https://lh5.ggpht.com/Cv4rXpcvRUY2vnBqQ8Kgs7mZFX_EZrXlQ3c67HHNaW-UDoRs1DiTb4gPVzmgYfAbPaw=w300"></a>-->
		<ul>
			<li><input type="tel" class="textinput" name="searchbar" id="searchbar" placeholder="Another?"/></li>
			<li><input type="submit" class="searchbutton" value="search"/></li>
			<li><div id="textToAppend"></div></li>
			<input type="hidden" name="submitted" value="true"/>
		</ul>
	</form><!-- end of searchbox form-->
<script src="phvalidate.js"></script>
	<!--form is valid-->
</body>
</html>
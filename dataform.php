<?php
session_start();
$number=$_SESSION['number'];
?>

<!DOCTYPE HTML>
<html>
<head>

	<link rel="stylesheet" href="WHODAT.css">
				<title><?php
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
</h1>	
<?php
	include 'mysql.php';
	$comment= "SELECT * FROM comments_on_number WHERE phonenumberid='$number' ORDER BY comments_date DESC";
	$returned=$dbcon->query($comment);
	foreach($returned as $data)
	{
		$id=$data['id'];
		$ida= $id."a";
		echo"<fieldset> <legend>" .$data['comments_date']. "</legend>". $data['the_comment'] ."
		<form method='post'>
		<button name=". $id. " class='lower-right-button'>like</button>
		<button name=". $ida.  " class='lower-right-button' style='right:100px;'>dislike</button>
		</form>
		<span class='lower-right-button' id='lower-like-button' style='right:60px;'>".$data['like_button']."</span>
		</fieldset><br><br>";
		if (isset($_POST[$id]))		//id is like
		{
			if(!isset($_COOKIE[$id]))
			{
				$queried_comment=$data['the_comment'];
				$stmt2="UPDATE comments_on_number SET like_button=like_button+1 WHERE id=$id"; 
				echo "<script language='javascript'>
					var like=document.getElementById('lower-like-button');
					like=like+1;
					var div=document.getElementById('lower-like-button');
					div.innerHtml=like;
				</script>";
				$dbcon->query($stmt2);
				if(isset($_COOKIE[$ida]))
					setcookie($ida, "", time()-3600);
				else	
					setcookie($id);
				unset($_POST[$id]);
				/*if($dbcon->query($stmtl)===TRUE)
					{
						Header("Location:dataform.php");
					}
				else 
					{
					echo "Error: " . $stmtl . "<br>" . $dbcon->error;
					}*/
			}
			//else
			//	echo "like already set can not vote again. ";
		header("location:dataform.php");
		}
		else if(isset($_POST[$ida]))
		{
			if(!isset($_COOKIE[$ida]))
			{
				$queried_comment=$data['the_comment'];
				$stmtl="UPDATE comments_on_number SET like_button=like_button-1 WHERE id=$id";
				echo "<script language='javascript'>
					var like=document.getElementById('lower-like-button');
					like=like-1;
					var div=document.getElementById('lower-like-button');
					div.innerHtml=like;
				</script>";
				$dbcon->query($stmtl);
				if(isset($_COOKIE[$id]))
					setcookie($id, "", time()-3600);
				else
					setcookie($ida);
				unset($_POST[$ida]);
				
			}
			//else
				//echo "dislike already set can not vote again";
			header("location:dataform.php");
		}
		if($data['like_button']<-4)
		{
			$stm3="Delete FROM comments_on_number WHERE id=$id";
			$dbcon->query($stm3);
		}
	}
?>
<form class="inputform" onsubmit="return formvalidate()" method="post" action="dataform.php">
	<fieldset>
		<legend>Have More Information? Add a comment! (200 char max)</legend>
		<ul>
			<li><textarea rows="6" cols="50" name="formtext" id='formtext' maxlength='200'></textarea></li>
			<li><input type="submit" value="submit"/></li>
			<input type="hidden" name="submitted" value="true"/>
			<li><div id="textToAppend1"></div></li>
		</ul>
	</fieldset>
	</form><!-- end of input form -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="formvalidate.js"></script>
<?php
		If(isset($_POST['submitted']))
		{
			if(!isset($_COOKIE[$number."comment"]))
			{
			$comment=$_POST['formtext'];
			$sql1="INSERT INTO comments_on_number (the_comment, comments_date, phonenumberid) VALUES('$comment', CURRENT_TIMESTAMP, '$number')";
			if($dbcon->query($sql1)===TRUE)
			{
				setcookie($number."comment");
				Header("Location:dataform.php");
			}
			//else 
			{
			//echo "Error: " . $sql1 . "<br>" . $dbcon->error;
			}
			}
			else
				echo"You've already entered a comment on this number";
			
		}
?>
<form class="searchbox" name="searchbox" onsubmit="return phvalidate(document.searchbox.searchbar)" method="post" action="index.php">
		<!-- <img id="logo" src="https://lh5.ggpht.com/Cv4rXpcvRUY2vnBqQ8Kgs7mZFX_EZrXlQ3c67HHNaW-UDoRs1DiTb4gPVzmgYfAbPaw=w300"></a>-->
		<ul>
			<li><input type="tel" class="textinput" name="searchbar" id="searchbar" placeholder="Another?"/></li>
			<li><input type="submit" class="searchbutton" value="search"/></li>
			<li><div id="textToAppend"></div></li>
			<input type="hidden" name="submitted" value="true">
		</ul>
	</form><!-- end of searchbox form-->
<script src="phvalidate.js"></script>
</body>
</html>
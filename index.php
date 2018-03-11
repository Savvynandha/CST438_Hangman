<!--
*
*Name: Tejus Nandha 
*
*Class: CST 438 
*
*Abstract: This Project was made for CST 438, it is a simple hangman game which is hosted on 
*		   Amazon AWS, specificaly on a Linux distro running Apache. Its made using PHP 
*          and some Javascript along with the obvious HTML. 
*
-->
<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hangman Game By:Tejus</title>
</head>

<style>
.code {
	text-align: center;
   padding:5px;
    border: 2.5px solid green;
    

}

</style>

<body>

 <br>
  <br>
  
<body bgcolor="#E6E6FA">

	<h1 align="center" class="Firsth1" style="color:green">Welcome!</h1>

		<h3 align="center"> This is a hangman game, you are given seven tries to guess the correct word.</h3> 
		
		<h3 align="center">If the letter is not in the word you will lose a try, choose wisely!</h3>

 <br>

<div align="middle" class="code">
<img src="hang.png" alt="hanged" align="center">
<br>
<br>
<br>
	 <?php 
		include 'config.php'; 
		include 'functions.php';
		if (isset($_POST['next'])) unset($_SESSION['input']);
		if (!isset($_SESSION['input']))
		{
			$_SESSION['$TURNS'] = 20; //Initialize the number of tries.
			$_SESSION['trys'] = 0;
			$input = insertArr($WORDS);
			$_SESSION['input'] = $input;
			$_SESSION['conceal'] = concealChar($input);
			echo 'Number of tries left: '.($TURNS - $_SESSION['trys']).'<br>'; //Show how many tries the user has left. 

			
		}else
		{
			if (isset ($_POST['inputLetter']))
			{
				$inputLetter = $_POST['inputLetter'];
				$_SESSION['conceal'] = incpectChange(strtolower($inputLetter), $_SESSION['conceal'], $_SESSION['input']);
				gameEnd($TURNS,$_SESSION['trys'],$_SESSION['input'],$_SESSION['conceal']);
			}
			$_SESSION['trys'] = $_SESSION['trys'] + 1;
			echo 'Number of tries left: '.($TURNS - $_SESSION['trys'])."<br>";
		}
		$conceal = $_SESSION['conceal'];
		foreach ($conceal as $char) echo $char."  ";
	?>
	
</div>
<br>
<br>
<script type="application/javascript"> //Begining of javascript used for input validation. 
    function checkAns() 
    {
		var x=document.forms["inputForm"]["inputLetter"].value;
		if (x=="" || x==" ")
		  {
			  alert("Sorry!!! Not a valid character!"); //User alert if the user enters the wrong character.
			  return false;
		  }
		if (!isNaN(x))
		{
			alert("Sorry!!! Not a valid character!"); //User alert if the user enters the wrong character.
			return false;
		}
	}
</script>

<form name = "inputForm" action = "" method = "post" align="center">
Enter a letter: <input name = "inputLetter" type = "text" size="1" maxlength="1"  />
<input type = "submit"  value = "Submit" onclick="return checkAns()"/>
<input type = "submit" name = "next" value = "New Word"/>
</form>
</body>
</html>
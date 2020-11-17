<?php

if(isset($_POST['optionTime']))
{
    $value = $_POST['optionTime'];
	
	switch($value)
	{
		case '1' : {header('Location: showbalance.php'); exit();}
		break;
		case '2' : {header('Location: showbalancelastmonth.php'); exit();}
		break;
		case '3' : {header('Location: showbalancecurrentyear.php'); exit();}
		break;
		case '4' : {header('Location: showbalancecustom.php'); exit();}
		break;
	}

}
?>
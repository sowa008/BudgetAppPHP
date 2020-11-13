<?php
	
	//	if (isset($_POST['income_amount']))
	//	{
			session_start();
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
		
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			
			$user_id = $_SESSION['id'];
			
			//$all_validated=true;
		
			$income_category = 4;

			$income_amount = $_POST['xxx'];
			
			$income_date = $_POST['date'];
			
			$income_comment = $_POST['comment'];
			
				//if ($all_validated==true)
				//{
					$sql_insert = "INSERT INTO incomes VALUES (NULL, '$user_id', '$income_category', '$income_amount', '$income_date', '$income_comment')";
					$result = $connection->query($sql_insert);
					
					$connection->close();
			
					header('Location: addincome.php');
					exit();
				//}
			

	//	}
	
?>
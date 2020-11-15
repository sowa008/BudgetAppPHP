<?php
	
		if (isset($_POST['xxx']))
		{
			session_start();
						
			require_once "connect.php";
			mysqli_report(MYSQLI_REPORT_STRICT);
		
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$all_validated = true;
			
				$user_id = $_SESSION['id'];
				
				if (isset($_POST['income_option']))
				{
					$income_category = $_POST['income_option'];
					echo $income_category;
				}
				
				$income_amount = $_POST['xxx'];	
					if($income_amount>999999.99)
					{
						$all_validated = false;
						$_SESSION['e_incomeamount']="Amount should be smaller than 1 mln ;) "; 
					}
				
				$now=date("Y-m-d");				
				$income_date = $_POST['date'];
					if (($income_date>="0000-00-00") && ($income_date<"2000-12-31"))
					{
						$all_validated = false;
						$_SESSION['e_date']="Enter a valid date"; 
					}
					else
						if ($income_date>$now)
						{	
							$all_validated = false;
							$_SESSION['e_date']="This is future date"; 
						}
				
				$income_comment = $_POST['comment'];
				
					if ($all_validated==true)
					{
						$sql_insert = "INSERT INTO incomes VALUES (NULL, '$user_id', '$income_category', '$income_amount', '$income_date', '$income_comment')";
						$result = $connection->query($sql_insert);		
					}
					
					$connection->close();
					header('Location: addincome.php');
					exit();
			
			}
		}
	
?>
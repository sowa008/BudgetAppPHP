<?php

		if (isset($_POST['expense']))
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
				
				if (isset($_POST['expense_option']))
				{
					$expense_category = $_POST['expense_option'];
				}
								
				if (isset($_POST['payment_option']))
				{
					$payment_method = $_POST['payment_option'];
				}
				
				$expense_amount = $_POST['expense'];	
					/*if($expense_amount>999999.99)
					{
						$all_validated = false;
						$_SESSION['e_expenseamount']="Amount should be smaller than 1 mln ;) "; 
					}*/
					
				//$expense_date="0000-00-00";
						
				if (!empty($_POST['date']))
				{	
					$now=date("Y-m-d");			
					$expense_date = $_POST['date'];
						if (($expense_date>="0000-00-00") && ($expense_date<"2000-12-31"))
						{
							$all_validated = false;
							$_SESSION['e_date']="Enter a valid date"; 
						}
						else
							if ($expense_date>$now)
							{	
								$all_validated = false;
								$_SESSION['e_date']="This is future date"; 
							}
				}
				else
				{
					$all_validated = false;
					$_SESSION['e_date']="Enter a valid date"; 
				}

				$expense_comment = $_POST['comment'];
				
					if ($all_validated==true)
					{
						$sql_insert = "INSERT INTO expenses VALUES (NULL, '$user_id', '$expense_category', '$payment_method', '$expense_amount', '$expense_date', '$expense_comment')";
						$result = $connection->query($sql_insert);		
					}
					
					$connection->close();
					header('Location: addexpense.php');
					exit();
			
			}
		}
	
?>
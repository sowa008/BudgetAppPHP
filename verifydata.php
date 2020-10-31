<?php
	
	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: login.php');
		exit();
	}
		
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	//późnije tu PDO - zamiast mysqli
	
	try 
	{
		$connection = new mysqli($host, $db_user, $db_password, $db_name);

		if ($connection->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$email = htmlentities($email, ENT_QUOTES, "UTF-8");
			
			if ($result = $connection->query(
			sprintf("SELECT * FROM users WHERE email='%s'",
			mysqli_real_escape_string($connection, $email))))
			{
				$count_users = $result->num_rows;
				if ($count_users>0)
				{
					$row = $result->fetch_assoc();
					
					if ((password_verify($password, $row['password'])) == true)
					{
						$_SESSION['islogged']=true;
						$_SESSION['id']=$row['id'];
						$_SESSION['user']=$row['username'];
						
						unset($_SESSION['error']);
						$result->free_result();
						header('Location: mainmenu.php');
					}	else {
									$_SESSION['error'] = '<span style="color:red; margin-right:auto; margin-left:auto;"> Invalid e-mail address or password! </span>';
									header('Location: login.php');
								}	
				} 	else {
								$_SESSION['error'] = '<span style="color:red; margin-right:auto; margin-left:auto;"> Invalid e-mail address or password! </span>';
								header('Location: login.php');
							}
			}	else	{
							throw new Exception($connection->error);
						}
			
			$connection->close();
		}
	}

	catch(Exception $e)
	{
		echo '<span style="color:red;">Server error. Please, try to register later!</span>';
		echo '<br />Informacja developerska: '.$e;
	}
	
?>
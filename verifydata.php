<?php
	
	session_start();
	
	if ((!isset($_POST['email'])) || (!isset($_POST['password'])))
	{
		header('Location: login.php');
		exit();
	}
	
	require_once "connect.php";
	
	//późnije tu PDO - zamiast mysqli
	
	$connection = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connection->connect_errno!=0)
	{
		echo "Error: ".$connection->connect_errno;
	}
		else 
		{
			$email = $_POST['email'];
			$password = $_POST['password'];
			
			$email = htmlentities($email, ENT_QUOTES, "UTF-8");
			$password = htmlentities($password, ENT_QUOTES, "UTF-8");
			
			if ($result = @$connection->query(
			sprintf("SELECT * FROM users WHERE email='%s' AND password='%s' ",
			mysqli_real_escape_string($connection, $email),
			mysqli_real_escape_string($connection, $password))))
			{
				$count_users = $result->num_rows;	
				if ($count_users>0)
				{
					$_SESSION['islogged']=true;
					
					$row = $result->fetch_assoc();
					
					$_SESSION['id']=$row['id'];
					$_SESSION['user']=$row['username'];
					
					unset($_SESSION['error']);
					
					$result->free_result();
					
					header('Location: mainmenu.php');
					
				} else {
					$_SESSION['error'] = '<span style="color:red; margin-right:auto; margin-left:auto;"> Nieprawidłowy adres e-mail lub hasło! </span>';
					header('Location: login.php');
				}
			}
			
			$connection->close();
		}

?>
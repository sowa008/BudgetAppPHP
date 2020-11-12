<?php

	session_start();
	
	if (isset($_POST['register_email']))
	{
		$all_validated=true;
		
		$username = $_POST['username'];
		
		if((strlen($username)<3) || (strlen($username)>20))
		{
			$all_validated=false;
			$_SESSION['e_username']="Name must be between 3 and 20 characters long";
		}
		
		if(ctype_alnum($username)==false)
		{
			$all_validated=false;
			$_SESSION['e_username']="Name must only consist of letters and numbers";
		}
		
		$register_email= $_POST['register_email'];
		$register_email_sanitized=filter_var($register_email, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($register_email_sanitized,FILTER_SANITIZE_EMAIL)==false) || ($register_email!=$register_email_sanitized))
		{
			$all_validated=false;
			$_SESSION['e_email']="Please, enter a valid e-mail address!";
		}
		
		$register_password1 = $_POST['register_password1'];
		$register_password2 = $_POST['register_password2'];
		
		if ((strlen($register_password1)<8) || (strlen($register_password1)>20))
		{
			$all_validated=false;
			$_SESSION['e_password']="Password must be 8 to 20 characters long!";
		}
		
		if ($register_password1!=$register_password2)
		{
			$all_validated=false;
			$_SESSION['e_password']="The passwords provided do not match!";
		}

		$password_hash = password_hash($register_password1, PASSWORD_DEFAULT);
		
//teraz tu pracuję		
		
		$_SESSION['form_username']=$username;
		$_SESSION['form_email']=$register_email;
		$_SESSION['form_password1']=$register_password1;
		$_SESSION['form_password2']=$register_password2;
		
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		try
		{
			$connection = new mysqli($host, $db_user, $db_password, $db_name);
			if ($connection->connect_errno!=0)
			{
				throw new Exception(mysqli_connect_errno());
			}
			else
			{
				$result=$connection->query("SELECT id FROM users WHERE email='$register_email'");
					
					if (!$result) throw new Exception($connection->error);
					
					$how_many_emails = $result->num_rows;
					
					if ($how_many_emails>0)
					{
						$all_validated=false;
						$_SESSION['e_email']="There is already an account assigned to this email address";
					}
					
					$result=$connection->query("SELECT id FROM users WHERE username='$username'");
					
					if (!$result) throw new Exception($connection->error);
					
					$how_many_usernames = $result->num_rows;
					
					if ($how_many_usernames>0)
					{
						$all_validated=false;
						$_SESSION['e_username']="There is already an account assigned to this user";
					}
					
					if ($all_validated==true)
					{
						if ($connection->query("INSERT INTO users VALUES (NULL, '$username', '$password_hash', '$register_email_sanitized')"))
						{
							$_SESSION['register_successful']=true;
							header('Location: welcome.php');
						}
						else{
							throw new Exception($connection->error);
						}
					}
				
				$connection->close();
			}
		}
		catch(Exception $e)
		{
			echo '<div class="error"> Server error. Please, try to register later!</div>';

			echo '<br />Informacja developerska: '.$e;
		}
		
	}

?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>	    	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Register</title>
		<meta name="description" content="BudgetApp: Register" />
		<meta name="keywords" content="budgetapp, home, budget, plan, planner, manage, register, form" />
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	    <link rel="stylesheet" href="style.css" type="text/css" />
	    <link rel="stylesheet" href="css/fontello.css">
	    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>

 <body>
	<main>
		<section id="budgetapp">
			<div class="container p-5">
				
				<header>
				<h1>
					<i class="icon-credit-card"> BudgetApp&trade;</i> 
				</h1>
				</header>
				   
				<div class="row">
					
					<div class="col-sm-12 col-md-8 col-lg-6 offset-md-2 offset-lg-3 p-4">
						
						<form id="form" method="post">
							
							<input type="text" value="<?php
								if (isset($_SESSION['form_username']))
								{
									echo $_SESSION['form_username'];
									unset($_SESSION['form_username']);
								}
								?>" name="username" required style="max-width: 100%;" placeholder="type your name" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your name' ">
								
								<?php
									if (isset($_SESSION['e_username']))
									{
										echo '<div class="error">'.$_SESSION['e_username'].'</div>';
										unset($_SESSION['e_username']);
									}
								?>
			
							<input type="email" style="max-width: 100%;" value="<?php
								if (isset($_SESSION['form_email']))
								{
									echo $_SESSION['form_email'];
									unset($_SESSION['form_email']);
								}
								?>" name="register_email" required placeholder="type your e-mail" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your e-mail' ">
							
								<?php
									if (isset($_SESSION['e_email']))
									{
										echo '<div class="error">'.$_SESSION['e_email'].'</div>';
										unset($_SESSION['e_email']);
									}
								?>
			
							<input type="password" style="max-width: 100%;" value="<?php
								if (isset($_SESSION['form_password1']))
								{
									echo $_SESSION['form_password1'];
									unset($_SESSION['form_password1']);
								}
								?>" name="register_password1" required placeholder="type your password" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your password' ">
							
								<?php
									if (isset($_SESSION['e_password']))
									{
										echo '<div class="error">'.$_SESSION['e_password'].'</div>';
										unset($_SESSION['e_password']);
									}
								?>
					   
							<input type="password" style="max-width: 100%;" value="<?php
								if (isset($_SESSION['form_password2']))
								{
									echo $_SESSION['form_password2'];
									unset($_SESSION['form_password2']);
								}
								?>" name="register_password2" required placeholder="repeat your password" onfocus="this.placeholder=' ' " onblur="this.placeholder='repeat your password' ">
							
							<div class="w-100"></div>
							
							<input type="submit" style="max-width: 100%;" value="Register">
						</form>
					
					</div>						
				
				</div>		
			
			</div>				
		</section>
	</main>
	
	<footer style="position: fixed;"><i class="icon-credit-card"></i>BudgetApp&trade; was created in 2020	
	</footer>
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js">	</script>

</body>
	
</html>
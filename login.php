<?php

	session_start();
	
	if ((isset($_SESSION['islogged'])) && ($_SESSION['islogged']==true))
	{
		header('Location: mainmenu.php');
		exit();
	}

?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>	    	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Log in</title>
		<meta name="description" content="BudgetApp: Log in" />
		<meta name="keywords" content="budgetapp, home, budget, plan, planner, manage, login form" />
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
						
						<form id="form" action="verifydata.php" method="post">
						
							<?php
								if (isset($_SESSION['error']))	
								{
									echo $_SESSION['error'];
									unset($_SESSION['error']);
								}
							?>
							
							<input style="max-width: 100%;" type="email" name="email" placeholder="e-mail" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your e-mail' ">
						
							<input style="max-width: 100%" type="password" name="password" placeholder="password" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your password' ">
									
							<input style="max-width: 100%;" type="submit" value="Log in" >
							
							<div id="create">Don't have your account yet? 
							<br> Register here: 
							</div>
							<a href="register.php"><div id="register" > Register </div></a>
							
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
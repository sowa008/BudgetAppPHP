<?php

session_start();

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
							
							<input type="text" name="username" required placeholder="type your name" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your name' ">
			
							<input type="email" name="register_email" required placeholder="type your e-mail" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your e-mail' ">
			
							<input type="password" name="register_password" required placeholder="type your password" onfocus="this.placeholder=' ' " onblur="this.placeholder='type your password' ">
					   
							<input type="password" name="register_password2" required placeholder="repeat your password" onfocus="this.placeholder=' ' " onblur="this.placeholder='repeat your password' ">
							
							<div class="w-100"></div>
							
							<input type="submit" value="Register">
						</form>
					
					</div>						
				
				</div>		
			
			</div>				
		</section>
	</main>
	
	<footer><i class="icon-credit-card"></i>BudgetApp&trade; was created in 2020	
	</footer>
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js">	</script>

</body>
	
</html>
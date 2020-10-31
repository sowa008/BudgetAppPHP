<?php
	
	session_start();
	
	if (!isset($_SESSION['islogged']))
	{
		header('Location: login.php');
		exit();
	}
	
?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>	    	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Add income</title>
		<meta name="description" content="BudgetApp: Add income" />
		<meta name="keywords" content="budgetapp, home, budget, plan, planner, manage, add, income, form" />
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<link rel="stylesheet" href="css/bootstrap.min.css" />
	    <link rel="stylesheet" href="style.css" type="text/css" />
	    <link rel="stylesheet" href="css/fontello.css">
	    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&display=swap" rel="stylesheet">
</head>

 <body>
	<main>
		<section id="budgetapp">
			<div class="container-fluid p-5">
				
				<header>
				<h1>
					<i class="icon-credit-card"> BudgetApp&trade;</i> 
				</h1>
				</header>
				   
				<div class="row">
					
					<div class="col-sm-12 col-md-6 col-lg-4 p-4">
					<nav>
											
						<div id="user">
								<?php 
								echo "Welcome ".$_SESSION['user']."!";
								?>	
						</div>
						
						<a href="mainmenu.php"><div><h2 class="icon-credit-card">Menu</h2></div></a>
												
						<a href="#" class="link"><div class="button" style="background-color: #9c27b0; cursor: default; box-shadow: none;"><span style="color: #e1bee7;" class="icon-money"> Add income </span></div></a>
						
						<a href="addexpense.php" class="link"><div class="button"><span style="color: red;" class="icon-money"> Add expense </span></div></a>
						
						<a href="showbalance.php" class="link"><div class="button"><i class="icon-chart-pie"></i> Show balance</div></a>
						
						<a href="#" class="link"><div class="button"><i class="icon-cog"></i>Settings</div></a>	
						
						<a href="logout.php" class="link"><div class="button"><span style="color: brown; font-weight:700;" class="icon-logout"> Log out </span></div></a>
					
					</nav>
					</div>		
					
					<div class="col-sm-12 col-md-6 col-lg-4 p-4">
							
							<form>
								<div class="box">
									Add income <br>
									<input style="max-width: 230px;" type="number" step="0.01" min='0' required placeholder="amount" onfocus="this.placeholder=' ' " onblur="this.placeholder='amount' ">
								</div>
							</form>
							
							<form>
								<div class="box">
									Date <br>
								<input style="max-width: 230px;" type="date">
								</div>
							</form>
					
							<form>
								<div class="box">
									<label for="cathegory">Source of income</label>
									<select style="max-width: 230px;" id="cathegory">				
										<option value="1">salary</option>
										<option value="2">bank interest</option>
										<option value="3">Allegro sale</option>			
										<option value="4">other incomes</option>			
									</select>
								</div>
							</form>
							
					</div>

					<div class="col-sm-12 col-md-6 col-lg-4 offset-md-6 offset-lg-0 p-4">
							
							<form>
								<div class="box">
									<div><label for="comment">Comment (optional)</label></div>
									<textarea id="comment" rows="8" cols="15"></textarea>
								</div>
							</form>	
							
							<form>
									<div  id="add"> 		
										<input type="submit" value="Add income">
									</div>
							</form>
							
					</div>
				
				</div>		
			
			</div>				
		</section>
	</main>
	
	<div class="w-100"></div>
	
	<footer style="position:relative;"><i class="icon-credit-card"></i>BudgetApp&trade; was created in 2020	
	</footer>
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js">	</script>

</body>
	
</html>
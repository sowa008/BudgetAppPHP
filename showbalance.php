<?php
	
	session_start();
	
	if (!isset($_SESSION['islogged']))
	{
		header('Location: login.php');
		exit();
	}
	else
	{
		$user_id = $_SESSION['id'];
		require_once 'database.php';
			
		$incomesQuery = $db->query("SELECT * FROM incomes WHERE user_id='$user_id'");
		$incomes = $incomesQuery->fetchAll();
		
		$expensesQuery = $db->query("SELECT * FROM expenses WHERE user_id='$user_id'");
		$expenses = $expensesQuery->fetchAll();
		
		//print_r($incomes);
		
	}
	
?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>	    	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Show balance</title>
		<meta name="description" content="BudgetApp: Show balance" />
		<meta name="keywords" content="budgetapp, home, budget, plan, planner, manage, show, balance, form" />
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
						
						<a href="addincome.php" class="link"><div class="button"><span style="color: green;" class="icon-money"> Add income </span></div></a>
						
						<a href="addexpense.php" class="link"><div class="button"><span style="color: red;" class="icon-money"> Add expense </span></div></a>
						
						<a href="#" class="link"><div class="button" style="background-color: #9c27b0; cursor: default; box-shadow: none;"><span style="color: #e1bee7;" class="icon-money"> Show balance </span></div></a>
						
						<a href="#" class="link"><div class="button"><i class="icon-cog"></i>Settings</div></a>	
						
						<a href="logout.php" class="link"><div class="button"><span style="color: brown; font-weight:700;" class="icon-logout"> Log out </span></div></a>
					
					</nav>
					</div>		
					
					<div class="col-sm-12 col-md-6 col-lg-4 p-4">
														
							<div class="table">							
									<table>
										<thead>
											<tr><th colspan="4">Together incomes: <?= $incomesQuery->rowCount() ?></th></tr>
											<tr><th>Date</th><th>Amount</th><th>Category</th><th>Comment</th></tr>
										</thead>
										<tbody>
											<?php
												foreach ($incomes as $income){
														echo "<tr><td>{$income['date_of_income']}</td><td>{$income['amount']}</td><td>{$income['income_category_assigned_to_user_id']}</td><td>{$income['income_comment']}</td></tr>";
												}
											?>	
										</tbody>
									</table>
							</div>
							
							<div class="table">							
									<table>
										<thead>
											<tr><th colspan="5">Together expenses: <?= $expensesQuery->rowCount() ?></th></tr>
											<tr><th>Date</th><th>Amount</th><th>Category</th><th>Payment</th><th>Comment</th></tr>
										</thead>
										<tbody>
											<?php
												foreach ($expenses as $expense){
														echo "<tr><td>{$expense['date_of_expense']}</td><td>{$expense['amount']}</td><td>{$expense['payment_method_assigned_to_user_id']}</td><td>{$expense['expense_category_assigned_to_user_id']}</td><td>{$expense['expense_comment']}</td></tr>";
												}
											?>	
										</tbody>
									</table>
							</div>
							
					</div>

					<div class="col-sm-12 col-md-6 col-lg-4 offset-md-6 offset-lg-0 p-4">
					
							<form>
								<div id="balancebox">
									<label for="showbalance">Show balance of  </label>
									<select id="showbalance">				
										<option value="1">current month</option>
										<option value="2">last month</option>
										<option value="3">current year</option>			
										<option value="4">custom</option>			
									</select>
								</div>
							</form>
							
							<div id="piechart">
								<img class="img-fluid" src="img/pie.png" alt="Pie chart"/>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</main>
	
	<div class="w-100"></div>
	
	<footer style="position: fixed;"><i class="icon-credit-card"></i>BudgetApp&trade; was created in 2020	
	</footer>
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js">	</script>

</body>
	
</html>
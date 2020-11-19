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
		
		$current_month = date('m');
		
		$startdate = $_SESSION['datefrom'];
		$enddate = $_SESSION['dateto'];
					
		$incomesQuery = $db->query("SELECT * FROM incomes, incomes_category_default WHERE incomes.user_id='$user_id' AND date_of_income BETWEEN '$startdate' AND '$enddate' AND incomes.income_category_assigned_to_user_id=incomes_category_default.id ORDER BY incomes.date_of_income");
		$incomes = $incomesQuery->fetchAll();
		
		$incomesQuerySum = $db->query("SELECT amount, SUM(amount) AS SumOfIncomes FROM incomes WHERE user_id='$user_id' AND date_of_income BETWEEN '$startdate' AND '$enddate'");
		$incomesQuerySum->execute();
		$IncomesSum = $incomesQuerySum->fetch();
		$incomesSum=$IncomesSum['SumOfIncomes'];
		
		$expensesQuery = $db->query("SELECT *, payment_methods_default.name AS payment, expenses_category_default.name AS category FROM expenses, expenses_category_default, payment_methods_default WHERE user_id='$user_id' AND date_of_expense BETWEEN '$startdate' AND '$enddate' AND expenses.expense_category_assigned_to_user_id=expenses_category_default.id AND payment_methods_default.id=expenses.payment_method_assigned_to_user_id ORDER BY expenses.date_of_expense");
		$expenses = $expensesQuery->fetchAll();

		$expensesQuerySum = $db->query("SELECT amount, SUM(amount) AS SumOfExpenses FROM expenses WHERE user_id='$user_id' AND date_of_expense BETWEEN '$startdate' AND '$enddate'");
		$expensesQuerySum->execute();
		$ExpensesSum = $expensesQuerySum->fetch();
		$expensesSum=$ExpensesSum['SumOfExpenses'];
		
		$balance=$incomesSum-$expensesSum;
		$balance = number_format($balance,2,'.','');
		
		if ($balance>0)
		{
			$_SESSION['balance_comment']="Congratulations! You manage your budget very well!";
		}
		else if ($balance<0)
		{
			$_SESSION['balance_comment']="Be careful! You spend more than you earn!";
		}
		
		$date_validated = true;
		$now=date("Y-m-d");	

		if ((!empty($_POST['datefrom'])) && (!empty($_POST['dateto'])))
		{
			$datefrom = $_POST['datefrom'];
			$dateto = $_POST['dateto'];
			
			if ($datefrom>$now)
				{	
					$date_validated = false;
					$_SESSION['e_datefrom']="Enter the valid period"; 
				}
										
			if ($dateto<$datefrom)
				{
					$date_validated = false;
					$_SESSION['e_dateto']="This date should be later than starting date"; 
				}
			
			if ($date_validated)
			{
				$_SESSION['datefrom'] = $datefrom;
				$_SESSION['dateto'] = $dateto;
				header('Location: showcustombalancefixed.php');
			}
			
		}
		
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
					
						<div id="showbalancediv">	
							<a style="font-weight: bold;">BALANCE SHEET </a>
							<br/>
							<a style="color: #6a1b9a;">between <?= $startdate?> and <?= $enddate?></a>
						</div>
					
						<div class="table" style="font-size: 14px;">	
						<table style="margin-left:auto; margin-right:auto; text-align: right;">
							<tr><th><a style="color: green;">Total INCOMES: </a></th><th><?=$incomesSum ?></th></tr>
							<tr><th><a style="color: red;">Total EXPENSES: </a></th><th><?=$expensesSum ?></th></tr>
							<tr><th><a>BALANCE : </a></th><th><?=$balance ?></th></tr>
						</table>
										<?php
										if (isset($_SESSION['balance_comment']))
										{
											echo $_SESSION['balance_comment'];
											unset($_SESSION['balance_comment']);
										}
									?>
						</div>
														
							<div class="table">							
									<table style="margin-left:auto; margin-right:auto;">
										<thead>
											<tr><th colspan="4" style="color: green;">Together incomes: <?= $incomesQuery->rowCount() ?></th></tr>
											<tr><th>Date</th><th>Amount</th><th>Category</th><th>Comment</th></tr>
										</thead>
										<tbody>
											<?php
												foreach ($incomes as $income){
														echo "<tr><td>{$income['date_of_income']}</td><td>{$income['amount']}</td><td>{$income['name']}</td><td>{$income['income_comment']}</td></tr>";
												}
											?>	
										</tbody>
									</table>
							</div>
							
							<div class="table">							
									<table style="margin-left:auto; margin-right:auto;">
										<thead>
											<tr><th colspan="5" style="color: red;">Together expenses: <?= $expensesQuery->rowCount() ?></th></tr>
											<tr><th>Date</th><th>Amount</th><th>Category</th><th>Payment</th><th>Comment</th></tr>
										</thead>
										<tbody>
											<?php
												foreach ($expenses as $expense){
														echo "
														<tr>
														<td>{$expense['date_of_expense']}</td>
														<td>{$expense['amount']}</td>
														<td>{$expense['category']}</td>
														<td>{$expense['payment']}</td>
														<td>{$expense['expense_comment']}</td>
														</tr>
														";
												}
											?>	
										</tbody>
									</table>
							</div>
							
					</div>

					<div class="col-sm-12 col-md-6 col-lg-4 offset-md-6 offset-lg-0 p-4">
					
							<form id="balanceform" method="post" action="choosingbalance.php">
								<div id="balancebox" style="text-align: center;">
									<label for="showbalance" style="margin-right: 10px;">Show balance of   </label>
									<select name="optionTime" id="showbalance" onchange="this.form.submit()">				
										<option value="1">Current Month</option>
										<option value="2">Last Month</option>
										<option value="3">Current Year</option>			
										<option value="4" selected>Custom</option>		
									</select>
								</form>
									<br/>
									<br/>
								<form id="dateform" method="post">
										<div class="box">
											FROM <br/>
											<input style="max-width: 100%;" type="date" name="datefrom" value="<?= $startdate?>">
												<?php
													if (isset($_SESSION['e_datefrom']))
													{
														echo '<div class="error">'.$_SESSION['e_datefrom'].'</div>';
														unset($_SESSION['e_datefrom']);
													}
												?>
										</div>
										<div class="box">
											TO <br/>
											<input style="max-width: 100%;" type="date" name="dateto" value="<?= $enddate?>">
												<?php
													if (isset($_SESSION['e_dateto']))
													{
														echo '<div class="error">'.$_SESSION['e_dateto'].'</div>';
														unset($_SESSION['e_dateto']);
													}
												?>
										</div>
										<div  id="submit"> 		
												<input type="submit" value="Show balance">
										</div>
								</form>
								</div>
							
							<div id="piechart" style="margin-top: 17px;">
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
	
	<script type="text/javascript" src="select.js"></script>
		
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

</body>
	
</html>
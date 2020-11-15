<?php
	
	session_start();
	
	if (!isset($_SESSION['islogged']))
	{
		header('Location: login.php');
		exit();
	}
	else
	{
		require_once "connect.php";
		mysqli_report(MYSQLI_REPORT_STRICT);
		
		$connection = new mysqli($host, $db_user, $db_password, $db_name);
		
		$expense_sql = "SELECT name FROM expenses_category_default";
		$result = $connection->query($expense_sql);
		$number_of_raws = $result->num_rows;
		
		$expense_option = Array($number_of_raws);
		
		for( $i = 1; $i <= $number_of_raws; $i++ )
		{
			$expense_sql = "SELECT name FROM expenses_category_default WHERE id='$i'";
			$result = $connection->query($expense_sql);
			$row = $result->fetch_assoc();
			$expense_option[$i]=$row['name'];
		}
		
		$connection->close();
		
				
				$connection2 = new mysqli($host, $db_user, $db_password, $db_name);
				
				$payment_sql = "SELECT name FROM payment_methods_default";
				$result2 = $connection2->query($payment_sql);
				$number_of_raws2 = $result2->num_rows;
				
				$payment_option = Array($number_of_raws2);
				
				for( $i = 1; $i <= $number_of_raws2; $i++ )
				{
					$payment_sql = "SELECT name FROM payment_methods_default WHERE id='$i'";
					$result2 = $connection2->query($payment_sql);
					$row2 = $result2->fetch_assoc();
					$payment_option[$i]=$row2['name'];
				}
				
				$connection2->close();
		
	}
	
?>

<!DOCTYPE HTML>
<html lang="en">
    
<head>	    	
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <title>Add expense</title>
		<meta name="description" content="BudgetApp: Add expense" />
		<meta name="keywords" content="budgetapp, home, budget, plan, planner, manage, add, expense, form" />
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
						
						<a href="#" class="link"><div class="button" style="background-color: #9c27b0; cursor: default; box-shadow: none;"><span style="color: #e1bee7;" class="icon-money"> Add expense </span></div></a>
						
						<a href="showbalance.php" class="link"><div class="button"><i class="icon-chart-pie"></i> Show balance</div></a>
						
						<a href="#" class="link"><div class="button"><i class="icon-cog"></i>Settings</div></a>	
						
						<a href="logout.php" class="link"><div class="button"><span style="color: brown; font-weight:700;" class="icon-logout"> Log out </span></div></a>
					
					</nav>
					</div>		
					
					<div class="col-sm-12 col-md-6 col-lg-4 p-4">
					
						<form id="formbox" method="post" action="addingexpense.php">
							
								<div class="box">
									Add expense <br/>
									<input name="expense" style="max-width: 230px;" type="number" step="0.01" min='0' required placeholder="amount" onfocus="this.placeholder=' ' " onblur="this.placeholder='amount' ">
											<?php
												if (isset($_SESSION['e_expenseamount']))
												{
													echo '<div class="error">'.$_SESSION['e_expenseamount'].'</div>';
													unset($_SESSION['e_expenseamount']);
												}
											?>
								</div>
							
								<div class="box">
									Date <br/>
									<input name="date" style="max-width: 230px;" type="date">
										<?php
											if (isset($_SESSION['e_date']))
												{
													echo '<div class="error">'.$_SESSION['e_date'].'</div>';
													unset($_SESSION['e_date']);
												}
										?>
								</div>
					
								<div class="box">
									<label for="paymentmethod">Payment method</label><br/>
									<select style="max-width: 230px;" id="paymentmethod" name="payment_option">				

										<?php 
											for( $i = 1; $i <= $number_of_raws2; $i++ )
											{
												echo
												'<option value='.$i.'>'.$payment_option[$i].'</option>';
											}
										?>
										
									</select>
								</div>

								<div class="box">
									<label for="category">Choose category</label><br/>
									<select style="max-width: 230px;" id="category" name="expense_option">	
									
										<?php 
											for( $i = 1; $i <= $number_of_raws; $i++ )
											{
												echo
												'<option value='.$i.'>'.$expense_option[$i].'</option>';
											}
										?>
											
									</select>
								</div>
							
					</div>

					<div class="col-sm-12 col-md-6 col-lg-4 offset-md-6 offset-lg-0 p-4">
							
								<div class="box">
										<div><label for="comment">Comment (optional)</label></div>
										<textarea form="formbox" id="comment" name="comment" rows="8" cols="15"></textarea>
									</div>

									<div  id="add"> 		
										<input type="submit" value="Add expense">
									</div>
							</form>
							
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
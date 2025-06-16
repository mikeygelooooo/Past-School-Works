<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Future Value Calculator</title>
</head>
<body>
	<div id="content">
		<?php 
		$investment = 0;
		$interest_rate = 0.0;
		$years = 0;
		?>
		<h1>Future Value Calculator</h1>
		<?php if (!empty($error_message)) { ?>
			<p class="error"><?php echo $error_message;  ?> </p>
		<?php } ?>
		
		<form action="display_results.php" method="POST">
			<div id="data">
				<label>investment amount:</label>
				<input type="text" name="investment" 
					   value="<?php echo $investment; ?>"/> <br/ >
				<label>Yearly Interest Rate:</label>
				<input type="text" name="interest_rate" 
				       value="<?php echo $interest_rate; ?>"/> <br/ >

				<label>Number of years:</label>
				<input type="text" name="years" 
				       value="<?php echo $years; ?>"/> <br/ >

			</div>
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" value="Calculate"/> <br/ >
			</div>
		</form>	

	</div>

</body>
</html>
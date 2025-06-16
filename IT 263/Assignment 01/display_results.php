<?php 

//get the data from the form

$investment=$_POST['investment'];
$interest_rate=$_POST['interest_rate'];
$years=$_POST['years'];


// #### validate investment entry ####
if (empty($investment)) {
	// code...
	$error_message='investment is required failed.';
}

elseif (!is_numeric($investment)) {
	// code...
	$error_message='investment must be a valid number.';
}
elseif ($investment <= 0) {
	// code...
	$error_message='investment must be a greater than zero.';
}

// #### validate interest rate entry ####

elseif (empty($interest_rate)) {
	// code...
	$error_message ='investment is required failed.';
}
elseif (!is_numeric($interest_rate)) {
	// code...
	$error_message='investment must be a valid number.';
}
elseif ($interest_rate <= 0 OR $interest_rate > 15) {
	// code...
	$error_message='investment must be a greater than zero and less than or equal to 15.';
}

// #### validate years entry ####

elseif (empty($years)) {
	// code...
	$error_message='iinvestment is required failed.';
}
elseif (!is_numeric($years)) {
	// code...
	$error_message='investment must be a valid number.';
}
elseif ($years <= 0 OR $years > 50) {
	// code...
	$error_message='investment must be a greater than zero and less than or equal to 50.';
}

// set error message to empty string if no invalid entries
else {
	$error_message = '';
}
// if an error message exists, got to the index page
if ($error_message !='') {
	include('index.php');
	exit();
}
// calculate the future value
$future_value = $investment;
for ($i=1; $i < $years; $i++) { 
	$future_value = ($future_value + ($future_value * $interest_rate * .01));

}

//apply currency and percent formatting
$investment_f = '$' .number_format($investment ,2);
$yearly_rate_f = $interest_rate.'$';
$future_value_f ='$'.number_format($future_value ,2);
?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Future Value Calculator</title>
 </head>
 <body>
 
 <h1>Future Value Calculator</h1>
 <label>investment amount:</label>
 <span> <?php echo $investment_f; ?> </span><br />
 <label>Yearly Interest Rate:</label>
 <span><?php echo $yearly_rate_f; ?></span><br />
 <label>Number of Years:</label>
 <span> <?php echo $years; ?></span><br />
 <label>Future Value:</label>
 <span> <?php echo $future_value_f; ?></span><br />

 <p> this calculations was done on <?php echo date('m/d/y') ?>;</p>
 </body>
 </html>
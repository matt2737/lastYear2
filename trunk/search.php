<?php
session_start();
ob_start();
$SID = $_SESSION['id'];
if(isset($_SESSION['id']))
{
    $SID = $_SESSION['id'];
}
else{
	header('Location: /login.php');
}
	
//Instantiate variables.
include_once('Gatherer.php');
$gatherer = new Gatherer();
/*User details variables */
$userDetails = $gatherer->getUserDetails($SID);
$lastName = $userDetails['lastName'];
?>

<!DOCTYPE html>
<html lang="en">
	
	<head>
		<title>NuVista: Your Health Summary</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" TYPE="text/css"/>
		<link rel="stylesheet" href="css/site.css" TYPE="text/css"/>
	</head>

	<body>
		
		<div class="container-fluid">
			
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="#">NuVista</a>
					<ul class="nav">
			                        <li><a href="summary.php">Health Summary</a></li>
			                        <li><a href="demographics.php">Demographics</a></li>
			                        <li><a href="progressNotes.php">Progress Notes</a></li>
						<li class="active"><a href="search.php">Search</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<h1>Search For Patient</h1>
			</div>
			<br />
                        
                        <div class ="hero-unit">
					<h1>Welcome Dr <?= $lastName ?>!</h1>
					<strong>Please search for a patient to access the summary page information.</strong>
					<p>Search using unique ID (for now)</p>
					
					<fieldset>
<!-- Replace with JS and Ajax PLZ! -->
						<form action="summary.php" method="POST">
							<input type="text" placeholder="Unique ID" name="uid"><br/>
							<button type="submit" class="btn">Submit</button>
						</form>
					</fieldset>
				</div>
                        
                </div>
                
        </body>
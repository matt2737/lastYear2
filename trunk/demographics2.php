<?php
	//Get unique ID and redirect if not logged in
	session_start();
	ob_start();
	$SID = $_SESSION['id'];
	//$_SESSION['id']=88;
	if(isset($_SESSION['id']))
	{
		$SID = $_SESSION['id'];
	}
	
	else
	{
		header('Location: /login.php');
	}
	
	//Instantiate variables.
	include_once('Gatherer.php');
	$gatherer = new Gatherer();	
	
?>
<!DOCTYPE html>
<html lang="en">
	
	
	<head>
		<title>NuVista: Your Demographics</title>
		<link rel="stylesheet" href="css/bootstrap.min.css" TYPE="text/css"/>
		<link rel="stylesheet" href="css/site.css" TYPE="text/css"/>
	</head>

	<body>
		<div class="container-fluid">
			
			<div class="navbar">
				<div class="navbar-inner">
					<a class="brand" href="#">NuVista</a>
					<ul class="nav">
			                        <li class="active"><a href="#">Health Summary</a></li>
			                        <li><a href="#">Demographics</a></li>
			                        <li><a href="progressNotes.php">Progress Notes</a></li>
						<li><a href="logout.php">Logout</a></li>
					    </ul>
				</div>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span3 offset1">
				Name <input type="text" name="name"/>
			</div>
			<div class="span3 offset2">
				<abbr title="Social Security">SS# </abbr><input type="text" name="ss"/>
			</div>
		</div>
		<div class="row-fluid">
			<div class="span3 offset1">
			<abbr title="Date of Birth">DOB: </abbr><input type="date" name="dob"/>
			</div>
		</div> 
		<div class="container-fluid">
			<div class="container-fluid">
				<div class="span4 ">
					<form class="form-horizontal">
						<div class = "row">
							<div class= "span4 ">
								<h4> Address </h4>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="street1">Street</label>
								<div class="controls">
									<input type="text" name="street1" id="street1" placeholder="Street1">
								</div>
							<label class="control-label" for="street2">Street</label>
							<div class="controls">
								<input type="text" name="street2" id="street2" placeholder="Street2">
							</div>
							<label class="control-label" for="City">City</label>
							<div class="controls">
								<input type="text" name="city" id="City" placeholder="City">
							</div>
						
							<label class="control-label" for="State">State</label>
							<div class="controls">
								<input type="text" name="state" id="State" placeholder="State">
							</div>
						
							<label class="control-label" for="Zip">ZipCode</label>
							<div class="controls">
								<input type="text" name="zipCode" id="Zip" placeholder="ZipCode">
							</div>
						</div>
					</form>
				</div>
				<div class="span4 offset1">
					<form class="form-horizontal">
						<div class="control-group">
							<div class="row-fluid"><strong>Place of Birth</strong></div>
							<label class="control-label" for="birthCity">City</label>
								<div class="controls">
									<input type="text" name="birthCity" id="birthCity" placeholder="City">
								</div>
							<label class="control-label" for="birthState">State</label>
							<div class="controls">
								<input type="text" name="birthState" id="birthState" placeholder="State">
							</div>	
							<label class="control-label" for="birthCountry">Country</label>
							<div class="controls">
								<input type="text" name="birthCountry" id="birthCountry" placeholder="Country">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="container-fluid">
				<div class="span5">
					<form class="form-horizontal">
						<div class = "row">
							<div class= "span6">
								<h4> Phone </h4>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="phoneHome">Home</label>
							<div class="controls">
								<input type="text" name="phoneHome" id="phoneHome"  placeholder="Home">
							</div>
							<label class="control-label" for="phoneWork">Work</label>
							<div class="controls">
								<input type="text" name="phoneWork" id="phoneWork" placeholder="Work">
							</div>
							<label class="control-label" for="phoneCell">Cell</label>
							<div class="controls">
								<input type="text" name="phoneCell" id="phoneCell" placeholder="Cell">
							</div>
							<label class="control-label" for="phonePager">Pager</label>
							<div class="controls">
								<input type="text" name="phonePager" id="phonePager" placeholder="Pager">
							</div>
						</div>
						<div class="row-fluid">
							<strong>Employer Information</strong>
						</div>
						<div class="control-group">
							<label class="control-label" for="employerName">Employer Name</label>
							<div class="controls">
								<input type="text" name="employerName" id="employerName">
							</div>
							<label class="control-label" for="employerPhone">Employer Phone</label>
							<div class="controls">
								<input type="text" name="employerPhone" id="employerPhone">
							</div>
							<label class="control-label" for="employerStreet1">Employer Street 1:</label>
							<div class="controls">
								<input type="text" name="employerStreet1" id="employerStreet1">
							</div>
							<label class="control-label" for="employerStreet2">Employer Street 2:</label>
							<div class="controls">
								<input type="text" name="employerStreet2" id="employerStreet2">
							</div>
							<label class="control-label" for="employerCity">Employer City:</label>
							<div class="controls">
								<input type="text" name="employerCity" id="employerCity">
							</div>
							<label class="control-label" for="employerState">Employer State</label>
							<div class="controls">
								<input type="text" name="employerState" id="employerState">
							</div>
							<label class="control-label" for="employerZipCode">Employer Zipcode</label>
							<div class="controls">
								<input type="text" name="employerZipCode" id="employerZipCode">
							</div>
						</div>
					</form>
				</div>
				<div class="span5 offset1">
					<strong> Marital Status </strong>
					<div class="row-fluid">
						<div class="offset1">
							<label class="radio">
								<input type="radio" name="maritalStatus" id="single">
								Single
							</label>
							<label class="radio">
								<input type="radio" name="maritalStatus" id="married">
								Married
							</label>
							<label class="radio">
								<input type="radio" name="maritalStatus" id="divorced">
								Divorced
							</label>
							<label class="radio">
								<input type="radio" name="maritalStatus" id="separated">
								Separated
							</label>
							<label class="radio">
								<input type="radio" name="maritalStatus" id="widowed">
								Widowed
							</label>
						</div>	
							<label class="control-label" for="spouseName"><strong>Spouse Name</strong></label>
							<div class="controls">
								<input type="text" name="spouseName" id="spouseName" placeholder="Spouse">
							</div>
						
					</div>
					<strong> Other Data </strong>
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="email">Email</label>
							<div class="controls">
								<input type="text" name="email" id="email">
							</div>
							<label class="control-label" for="occupation">Patient Occupation</label>
							<div class="controls">
								<input type="text" name="occupation" id="occupation">
							</div>
							<label class="control-label" for="religion">Religion</label>
							<div class="controls">
								<input type="text" name="religion" id="religion">
							</div>
							<label class="control-label" for="occupation">Race</label>
							<div class="controls">
								<select name="race">
								<option> Select</option>
								<option value="caucasian">Caucasian</option>
								<option value="asian">Asian</option>
								<option value="black">Black</option>
								<option value="hispanic">Hispanic</option>
								</select>
							</div>
							<label class="control-label" for="motherMaidenName">Mother's maiden name</label>
							<div class="controls">
								<input type="text" name="motherMaidenName" id="motherMaidenName">
							</div>
							<label class="control-label" for="gender">Gender</label>
							<div class="row-fluid">							
								<div class="controls">
									<label class="radio inline">
										<input type="radio" name="gender" id="gender" value="male"> Male
									</label>
									<label class="radio inline">
										<input type="radio" name="gender" id="gender" value="female"> Female
									</label>
								</div>
							</div>	
							<div class="row-fluid">								
								<label class="control-label" for="retired">Retired</label>
								<div class="controls">
									<label class="radio inline">
										<input type="radio" name="retired" id="retired" value="yes"> Yes
									</label>
									<label class="radio inline">
										<input type="radio" name="retired" id="retired" value="no"> No
									</label>
								</div>
							</div>
							<div class="row-fluid">	
								<label class="control-label" for="disabled">Disabled</label>							
								<div class="controls">
									<label class="radio inline">
										<input type="radio" name="disabled" id="disabled" value="yes"> Yes
									</label>
									<label class="radio inline">
										<input type="radio" name="disabled" id="disabled" value="no"> No
									</label>
								</div>
							</div>
						</div>
					</form>	
				</div>
			</div>
			<div class="container-fluid">
				<div class="span5">					
					<form class="form-horizontal">
						<div class="row-fluid">
						<strong>Information of insured individual</strong>
					</div>
					<div class="control-group">
						<label class="control-label" for="insuredName">Name</label>
						<div class="controls">
							<input type="text" name="insuredName" id="insuredName">
						</div>
						<label class="control-label" for="insuredPhone">Phone</label>
						<div class="controls">
							<input type="text" name="insuredPhone" id="insuredPhone">
						</div>
						<label class="control-label" for="insuredStreet1">Street 1:</label>
						<div class="controls">
							<input type="text" name="insuredStreet1" id="insuredStreet1">
						</div>
						<label class="control-label" for="insuredStreet2">Street 2:</label>
						<div class="controls">
							<input type="text" name="insuredStreet2" id="insuredStreet2">
						</div>
						<label class="control-label" for="insuredCity">City:</label>
						<div class="controls">
							<input type="text" name="insuredCity" id="insuredCity">
						</div>
						<label class="control-label" for="insuredState">State</label>
						<div class="controls">
							<input type="text" name="insuredState" id="insuredState">
						</div>
						<label class="control-label" for="insuredZipCode">Zipcode</label>
						<div class="controls">
							<input type="text" name="insuredZipCode" id="insuredZipCode">
						</div>
						<label class="control-label" for="insuredRelation">Relation to Patient</label>
						<div class="controls">
							<input type="text" name="insuredRelation" id="insuredRelation">
						</div>
						<label class="control-label" for="insuredSS">SS#</label>
						<div class="controls">
							<input type="text" name="insuredSS" id="insuredSS">
						</div>
						<label class="control-label" for="insuredDOB">DOB</label>
						<div class="controls">
							<input type="date" name="insuredRelation" id="insuredRelation">
						</div>
						<label class="control-label" for="insuredID">Policy Number/ID</label>
						<div class="controls">
							<input type="text" name="insuredID" id="insuredID">
						</div>
					</div>
					</form>
				</div>
				<div class="span4">
					<form class="form-horizontal">
						<div class="row-fluid">
							<strong>Emergency Contact Information</strong>
						</div>
						<div class="control-group">
							<label class="control-label" for="emergencyName">Name</label>
							<div class="controls">
								<input type="text" name="emergencyName" id="emergencyName">
							</div>
							<label class="control-label" for="emergencyPhone">Phone</label>
							<div class="controls">
								<input type="text" name="emergencyPhone" id="emergencyPhone">
							</div>
							<label class="control-label" for="emergencyStreet1">Street 1:</label>
							<div class="controls">
								<input type="text" name="emergencyStreet1" id="emergencyStreet1">
							</div>
							<label class="control-label" for="emergencyStreet2">Street 2:</label>
							<div class="controls">
								<input type="text" name="emergencyStreet2" id="emergencyStreet2">
							</div>
							<label class="control-label" for="emergencyCity">City:</label>
							<div class="controls">
								<input type="text" name="emergencyCity" id="emergencyCity">
							</div>
							<label class="control-label" for="emergencyState">State</label>
							<div class="controls">
								<input type="text" name="emergencyState" id="emergencyState">
							</div>
							<label class="control-label" for="emergencyZipCode">Zipcode</label>
							<div class="controls">
								<input type="text" name="emergencyZipCode" id="emergencyZipCode">
							</div>
							<label class="control-label" for="emergencyRelation">Relation to Patient</label>
							<div class="controls">
								<input type="text" name="emergencyRelation" id="emergencyRelation">
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="span4">
				<form class="form-horizontal">
					
				</form>
			</div>
			<div class="span4">
				<div class="form-horizontal">
					<label class="control-label" for="deathDate">Date of death</label>
					<div class="controls">
						<input type="date" name="dateOfDeath" id="deathDate">
					</div>
					<label class="control-label" for="deathPlace">Place of death</label>
					<div class="controls">
						<input type="text" name="placeOfDeath" id="deathPlace">
					</div>
					<label class="control-label" for="deathPerson">Person responible for entering death information</label>
					<div class="controls">
						<input type="text" name="deathName" id="deathPerson">
					</div>
				</div>
				<div class="row-fluid">
					<button class="btn btn-large btn-primary" type="button">Submit Changes</button>
				</div>
			</div>
		</div>
	</body>
</html>
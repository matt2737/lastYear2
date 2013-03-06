<?php
	include_once('Gatherer.php');
	//Get unique ID and redirect if not logged in
	session_start();
	ob_start();
	$SID = $_SESSION['id'];
	$gatherer = new Gatherer();
	$userDetails = $gatherer->getUserDetails($SID);
	if($userDetails['role'] == 2 && empty($_SESSION['userId'])){
		header('Location: search.php');	
	}
	//$_SESSION['id']=88;
	if(isset($_SESSION['id']))
	{
		$SID = $_SESSION['id'];
	}
	
	else
	{
		header('Location: login.php');
	}
	
	//Instantiate variables.
	
	
	if($userDetails['role'] == 1){
		$userInfo = $gatherer->getUserDetails($SID);
		$patientInfo = $gatherer->getPatientDetails($SID);
		$demographicsInfo = $gatherer->getDemographics($SID);
	}
	else{
		$userInfo = $gatherer->getUserDetails($_SESSION['userId']);
		$patientInfo = $gatherer->getPatientDetails($_SESSION['userId']);
		$demographicsInfo = $gatherer->getDemographics($_SESSION['userId']);
	}
	
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
                            <li><a href="summary.php">Health Summary</a></li>
                            <li class="active"><a href="#">Demographics</a></li>
                            <li><a href="progressNotes.php">Progress Notes</a></li>
			    <?php if ($userDetails['role']==2) : ?>
			    <li><a href="search.php">Search</a></li>
			    <?php endif ?>
			    <li><a href="logout.php">Logout</a></li>
			</ul>
		    </div>
		</div>
		<h1>Demographic Information</h1><button class="btn btn-primary" id="edit">Edit Information</button><br>
                <form class="form-horizontal" action="saveDemographics.php" method="POST">
                    <div class="row-fluid">
			<div class="span4 offset1">
                            <div class="control-group">
                                <h3> Basic Information</h3>
                                <label class="control-label for="fname">First Name:</label>
                                <div class="controls">
                                    <input type="text" name="fname" value="<?= $userInfo[firstName] ?>" disabled/>
                                </div>
                                <label class="control-label for="lname">Last Name:</label>
                                <div class="controls">
                                    <input type="text" name="lname" value="<?= $userInfo[lastName] ?>" disabled/>
                                </div>
                                <label class="control-label" for="dob">DOB:</label>
                                <div class="controls">
                                    <input type="text" name="dob" id="dob" value="<?= $userInfo[dob] ?>" disabled/>
                                </div>
                                <label class="control-label" for="ss">Social Security Number</label>
                                <div class="controls">
                                    <input type="text" name="ss" value="<?= $userInfo[ss] ?>" disabled/>
                                </div>
                                <h3> Address </h3>
                                <label class="control-label" for="street1">Street</label>
                                <div class="controls">
                                    <input type="text" name="address" id="street1" placeholder="Street" value="<?= $userInfo[address] ?>" disabled>
                                </div>
                                <label class="control-label" for="City">City</label>
                                <div class="controls">
                                    <input type="text" name="city" id="City" placeholder="City" value="<?= $userInfo[city] ?>" disabled>
                                </div>
                                <label class="control-label" for="State">State</label>
                                <div class="controls">
                                    <input type="text" name="state" id="State" placeholder="State" value="<?= $userInfo[state] ?>" disabled>
                                </div>
                                <label class="control-label" for="Zip">ZipCode</label>
                                <div class="controls">
                                    <input type="text" name="zipCode" id="Zip" placeholder="ZipCode" value="<?= $userInfo[zip] ?>" disabled>
                                </div>
                                <h3>Phone</h3>
                                <label class="control-label" for="phoneHome">Home</label>
				<div class="controls">
				    <input type="text" name="phoneHome" id="phoneHome"  placeholder="Home" value="<?= $demographicsInfo[phoneHome] ?>" disabled>
				</div>
				<label class="control-label" for="phoneWork">Work</label>
				<div class="controls">
				    <input type="text" name="phoneWork" id="phoneWork" placeholder="Work" value="<?= $demographicsInfo[phoneWork] ?>" disabled>
				</div>
				<label class="control-label" for="phoneCell">Cell</label>
				<div class="controls">
				    <input type="text" name="phoneCell" id="phoneCell" placeholder="Cell" value="<?= $demographicsInfo[phoneCell] ?>" disabled>
				</div>
				<label class="control-label" for="phonePager">Pager</label>
				<div class="controls">
				    <input type="text" name="phonePager" id="phonePager" placeholder="Pager" value="<?= $demographicsInfo[phonePager] ?>" disabled>
				</div>
                                <h3>Employer Information</h3>
                                <label class="control-label" for="employerName">Employer Name</label>
                                <div class="controls">
                                    <input type="text" name="employerName" id="employerName" value="<?= $demographicsInfo[employerName] ?>" disabled>
                                </div>
                                <label class="control-label" for="employerPhone">Employer Phone</label>
                                <div class="controls">
                                    <input type="text" name="employerPhone" id="employerPhone" value="<?= $demographicsInfo[employerPhone] ?>" disabled>
                                </div>
                                <label class="control-label" for="employeraddress">Employer Street</label>
                                <div class="controls">
                                    <input type="text" name="employerAddress" id="employerStreet1" value="<?= $demographicsInfo[employerAddress] ?>" disabled>
                                </div>
    
                                <label class="control-label" for="employerCity">Employer City:</label>
                                <div class="controls">
                                    <input type="text" name="employerCity" id="employerCity" value="<?= $demographicsInfo[employerCity] ?>" disabled>
                                </div>
                                <label class="control-label" for="employerState">Employer State</label>
                                <div class="controls">
                                    <input type="text" name="employerState" id="employerState" value="<?= $demographicsInfo[employerState] ?>" disabled>
                                </div>
                                <label class="control-label" for="employerZipCode">Employer Zipcode</label>
                                <div class="controls">
                                    <input type="text" name="employerZipCode" id="employerZipCode" value="<?= $demographicsInfo[employerZip] ?>" disabled>
                                </div>
                            </div>
                            <h3>Information for Insurance</h3>
                            <label class="control-label" for="insuredName">Name</label>
                            <div class="controls">
                                <input type="text" name="insuredName" id="insuredName" value="<?= $userInfo[firstName] ?> <?= $userInfo[lastName] ?>" disabled>
                            </div>
                            <label class="control-label" for="insuredPhone">Phone</label>
                            <div class="controls">
                                <input type="text" name="insuredPhone" id="insuredPhone" value="<?= $demographicsInfo[phoneHome] ?>" disabled>
                            </div>
                            <label class="control-label" for="inscompany">Insurance Company</label>
                            <div class="controls">
                                <input type="text" name="insCompany" id="incompany" value="<?= $patientInfo[insCompany] ?>" disabled>
                            </div>
                            <label class="control-label" for="insAddress">Company Address</label>
                            <div class="controls">
                                <input type="text" name="insAddress" id="inaddress" value="<?= $patientInfo[insCompanyAddress] ?>" disabled>
                            </div>
                            <label class="control-label" for="groupNumber">Group Number</label>
                            <div class="controls">
                                <input type="text" name="groupNumber" value="<?= $patientInfo[groupNumber] ?>" disabled>
                            </div>
                            <label class="control-label" for="policyNumber">Policy Number</label>
                            <div class="controls">
                                <input type="text" name="policyNumber" value="<?= $patientInfo[policyNumber] ?>" disabled>
                            </div>
                            <label class="control-label" for="contact">Contact</label>
                            <div class="controls">
                                <input type="text" name="contact" value="<?= $patientInfo[contact] ?>" disabled>
                            </div>
                            <label class="control-label" for="contactNumber">Contact Number</label>
                            <div class="controls">
                                <input type="text" name="contactNumber" value="<?= $patientInfo[contactNumber] ?>" disabled>
                            </div>
                                
			</div>
			<div class="span4 offset1">
                            <div class="control-group">
                                <h3>Place of Birth</h3>
                                <label class="control-label" for="birthCity">City</label>
                                <div class="controls">
                                    <input type="text" name="birthCity" id="birthCity" placeholder="City" value="<?= $demographicsInfo[birthCity] ?>" disabled>
                                </div>
                                <label class="control-label" for="birthState">State</label>
                                <div class="controls">
                                    <input type="text" name="birthState" id="birthState" placeholder="State" value="<?= $demographicsInfo[birthState] ?>" disabled>
                                </div>
                                <label class="control-label" for="birthCountry">Country</label>
                                <div class="controls">
                                    <input type="text" name="birthCountry" id="birthCountry" placeholder="Country" value="<?= $demographicsInfo[birthCountry] ?>" disabled>
                                </div>
                                <h3>Marital Status</h3>
                                
                                <?php if($demographicsInfo[maritalStatus] == 1): ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" checked disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" disabled>
                                            Widowed
                                    </label>
                                </div>
                                
                                <?php elseif($demographicsInfo[maritalStatus] == 2): ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" checked disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" disabled>
                                            Widowed
                                    </label>
                                </div>
                                
                                <?php elseif($demographicsInfo[maritalStatus] == 3): ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" checked disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" disabled>
                                            Widowed
                                    </label>
                                </div>
                                
                                <?php elseif($demographicsInfo[maritalStatus] == 4): ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" checked disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" disabled>
                                            Widowed
                                    </label>
                                </div>
                                
                                <?php elseif($demographicsInfo[maritalStatus] == 5): ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" checked disabled>
                                            Widowed
                                    </label>
                                </div>
                                <?php else: ?>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="1" disabled>
                                            Single
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="2" disabled>
                                         Married
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="3" disabled>
                                            Divorced
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="4" disabled>
                                            Separated
                                    </label>
                                </div>
                                <div class="controls">
                                    <label class="radio">
                                        <input type="radio" name="maritalStatus" value="5" disabled>
                                            Widowed
                                    </label>
                                </div>
                                <?php endif; ?>
                                
                                
                                <label class="control-label" for="spouseName">Spouse Name</label>
                                <div class="controls">
                                    <input type="text" name="spouseName" id="spouseName" placeholder="Spouse" value="<?= $demographicsInfo[spouseName] ?>" disabled>
                                </div>
                                <h3>Emergency Contact Information</h3>
                                <label class="control-label" for="emergencyName">Name</label>
                                <div class="controls">
                                    <input type="text" name="emergencyName" id="emergencyName" value="<?= $demographicsInfo[emergencyName] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyPhone">Phone</label>
                                <div class="controls">
                                    <input type="text" name="emergencyPhone" id="emergencyPhone" value="<?= $demographicsInfo[emergencyPhone] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyAddress">Street</label>
                                <div class="controls">
                                    <input type="text" name="emergencyAddress" value="<?= $demographicsInfo[emergencyAddress] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyCity">City:</label>
                                <div class="controls">
                                    <input type="text" name="emergencyCity" id="emergencyCity" value="<?= $demographicsInfo[emergencyCity] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyState">State</label>
                                <div class="controls">
                                    <input type="text" name="emergencyState" id="emergencyState" value="<?= $demographicsInfo[emergencyState] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyZipCode">Zipcode</label>
                                <div class="controls">
                                    <input type="text" name="emergencyZipCode" id="emergencyZipCode" value="<?= $demographicsInfo[emergencyZip] ?>" disabled>
                                </div>
                                <label class="control-label" for="emergencyRelation">Relation to Patient</label>
                                <div class="controls">
                                    <input type="text" name="emergencyRelation" id="emergencyRelation" value="<?= $demographicsInfo[emergencyRelation] ?>" disabled>
                                </div>
                                <h3>Other Information</h3>
                                <label class="control-label" for="email">Email</label>
                                <div class="controls">
                                    <input type="text" name="email" id="email" value="<?= $userInfo[email] ?>" disabled>
                                </div>
                                <label class="control-label" for="occupation">Patient Occupation</label>
                                <div class="controls">
                                    <input type="text" name="occupation" id="occupation" value="<?= $demographicsInfo[occupation] ?>" disabled>
                                </div>
                                <label class="control-label" for="religion">Religion</label>
                                <div class="controls">
                                    <input type="text" name="religion" id="religion" value="<?= $demographicsInfo[religion] ?>" disabled>
                                </div>
                                <label class="control-label" for="race">Race</label>
                                <div class="controls">
                                    <input type="text" name="race" id="race" value="<?= $demographicsInfo[race] ?>" disabled>
                                </div>
                                <label class="control-label" for="motherMaidenName">Mother's maiden name</label>
                                <div class="controls">
                                    <input type="text" name="motherMaidenName" id="motherMaidenName" value="<?= $demographicsInfo[motherMaidenName] ?>" disabled>
                                </div>
                                <label class="control-label" for="gender">Gender</label>
                                <div class="controls">
                                    
                                    <?php if($userInfo[gender] == 'male'): ?>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="male" checked  disabled> Male
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="female"  disabled> Female
                                    </label>
                                    <?php elseif($userInfo[gender] == 'female'): ?>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="male"  disabled> Male
                                    </label>
                                    <label class="radio inline">
                                        <input type="radio" name="gender" id="gender" value="female" checked  disabled> Female
                                    </label>
                                    <?php endif; ?>
                                    
                                    
                                </div>
                                <h3>Deceased Information</h3>
                            <label class="control-label" for="deathDate">Date of death</label>
                            <div class="controls">
                                <input type="date" name="dateOfDeath" id="deathDate" value="<?= $demographicsInfo[dateOfDeath] ?>" disabled>
                            </div>
                            <label class="control-label" for="deathPlace">Place of death</label>
                            <div class="controls">
                                <input type="text" name="placeOfDeath" id="deathPlace" value="<?= $demographicsInfo[placeOfDeath] ?>" disabled>
                            </div>
                            <label class="control-label" for="deathPerson">Person responible for entering death information</label>
                            <div class="controls">
                                <input type="text" name="deathName" id="deathPerson" value="<?= $demographicsInfo[deathName] ?>" disabled>
                            </div>
                            <br><br><br><input class="btn btn-primary" type="submit" value="submit" disabled> 
                        </div>
                    </div>
                </form>
            </div>
	<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
	<script type="text/javascript" src="js/demographics.js"></script>
    </body>
</html>
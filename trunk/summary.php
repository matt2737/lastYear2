<?php
	//Get unique ID and redirect if not logged in
	session_start();
	ob_start();
	$SID = $_SESSION['id'];
	if(isset($_SESSION['id']))
	{
		$SID = $_SESSION['id'];
	}
	
	else
	{
		header('Location: login.php');
	}
		
	//Instantiate variables.
	include_once('Gatherer.php');
	$gatherer = new Gatherer();
	
	/*User details variables */
	$userDetails = $gatherer->getUserDetails($SID);
	$firstName = $userDetails['firstName'];
	$lastName = $userDetails['lastName'];
	$dob = $userDetails['dob'];
	$ss = $userDetails['ss'];
	$streetAddress = $userDetails['address'];
	$city = $userDetails['city'];
	$zip = $userDetails['zip'];
	$state = $userDetails['state'];
	$username = $userDetails['username'];
	$role = $userDetails['role'];
	$picture = $userDetails['picture'];
	
	/* Patient details variables */
	$isPatient;
	$activeDiagnosis;
	$familyhis;
	$inactive;
	$insCompany;
	$insCompanyAddress;
	$groupNumber;	
	$policyNumber;
	$contact;
	$contactNumber;
	$allergies;
	
	$detailsThreshold = 0;
	
	/*Demographics variables */
	$phoneHome;
	$phoneWork;
	$phoneCell;
	$emergencyName;
	$emergencyRelation;
	$emergencyPhone;
	
	$demographicsThreshold = 0;
	
	function fillUserDetails($ID)
	{
		global $gatherer, $firstName, $lastName, $dob,
			$ss, $streetAddress, $city, $zip, $state, $username,
			$role, $picture;
		
		$userDetails = $gatherer->getUserDetails($ID);
		$firstName = $userDetails['firstName'];
		$lastName = $userDetails['lastName'];
		$dob = $userDetails['dob'];
		$ss = $userDetails['ss'];
		$streetAddress = $userDetails['address'];
		$city = $userDetails['city'];
		$zip = $userDetails['zip'];
		$state = $userDetails['state'];
		$username = $userDetails['username'];
		$picture = $userDetails['picture'];
	}
	
	function fillPatientDetails($SID)
	{
		global $gatherer, $activeDiagnosis, $familyhis,
			$inactive, $inactive, $insCompany, 
			$insCompanyAddress, $groupNumber,
			$policyNumber, $contact, $contactNumber,
			$allergies, $detailsThreshold;
		
		$patientDetails = $gatherer->getPatientDetails($SID);
		$activeDiagnosis = $patientDetails['activeDiagnose'];
		$familyhis = $patientDetails['familyHistory'];
		$inactive = $patientDetails['inactiveDiagnose'];
		$allergies = $patientDetails['allergies'];
		$insCompany = $patientDetails['insCompany'];
		$insCompanyAddress = $patientDetails['insCompanyAddress'];
		$groupNumber = $patientDetails['groupNumber'];	
		$policyNumber = $patientDetails['policyNumber'];
		$contact = $patientDetails['contact'];
		$contactNumber = $patientDetails['contactNumber'];
		
		foreach ($patientDetails as $value)
		{
			if (empty($value))
			{
				$detailsThreshold += 1;
			}			
		}
	}
	
	function fillPatientDemographics($SID)
	{
		global $gatherer, $phoneHome, $phoneCell, $phoneWork,
			$emergencyName, $emergencyRelation, $emergencyPhone,
			$demographicsThreshold;
			
		$demographics = $gatherer->getDemographics($SID);
		$phoneHome = $demographics['phoneHome'];
		$phoneWork = $demographics['phoneWork'];
		$phoneCell = $demographics['phoneCell'];
		$emergencyName = $demographics['emergencyName'];
		$emergencyRelation = $demographics['emergencyRelation'];
		$emergencyPhone = $demographics['emergencyPhone'];
		
		foreach ($demographics as $value)
		{
			if (empty($value))
			{
				$demographicsThreshold += 1;
			}
		}
	}
	
	fillUserDetails($SID);

	/* The following if block checks to see if the user is a patient.
	 * depdending on their answer, judges how the entirety of the
	 * summary page is laid out for the user.
	 */
	if ($role == 1)
	{
		global $isPatient;
		$isPatient = true;
		fillPatientDetails($SID);
		fillPatientDemographics($SID);
	}
	
	/* This if block gets a little tricky. First we check to see
	 * if the user is role 2, which is what we're saying is a Dr.
	 * If they are a Dr., certain options are available to them
	 * that aren't available to regular patients. Most importantly
	 * however we need to determine how to display the patient
	 * information they will inevitably look up.
	 *
	 * This block first checks to see if someone posts a user
	 * ID into this page. If they do, we update patient information
	 * and display it to the page.
	 *
	 * The second checks to see if the Dr. already has an active
	 * patient.
	 *
	 * Finally, if neither of these conditions satisfy we
	 * redirect the Dr. to the patient search page. */
	elseif ($role == 2)
	{
		
		if (!empty($_POST['uid'])) 
		{
			$uid = $_POST['uid'];
			$_SESSION['userId'] = $uid;
			$isPatient = True;
			fillUserDetails($uid);
			fillPatientDetails($uid);
			fillPatientDemographics($uid);
		}
		
		elseif (!empty($_SESSION['userId']))
		{
			$uid = $_SESSION['userId'];
			$isPatient = True;
			fillUserDetails($uid);
			fillPatientDetails($uid);
			fillPatientDemographics($uid);
		}
		
		elseif ($isPatient == false)
		{
			header('Location: search.php');
		}
	}
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
			                        <li class="active"><a href="summary.php">Health Summary</a></li>
			                        <li><a href="demographics.php">Demographics</a></li>
			                        <li><a href="progressNotes.php">Progress Notes</a></li>
						<?php if ($role==2) : ?>
						<li><a href="search.php">Search</a></li>
						<?php endif ?>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
			<div class="row-fluid">
				<h1>Health Summary</h1>
			</div>
			<br />
			
			<?php if(!$isPatient) :
				//If the person logged in is a doctor, we must search for a patient.
			?>
				<div class ="hero-unit">
					<h1>Welcome Dr <?= $lastName ?>!</h1>
					<strong>Please search for a patient to access the summary page information.</strong>
					<p>Search using unique ID (for now)</p>
					
					<fieldset>
						<form action="summary.php" method="POST">
							<input type="text" placeholder="Unique ID" name="uid"><br/>
							<button type="submit" class="btn">Submit</button>
						</form>
					</fieldset>
				</div>
			<?php endif; ?>
				
			<?php if ($isPatient) :
				/*We show this information as long as the person logged in is a patient
				 *or a user searched for a patient
				 */
		 	?>
				<?php if ($detailsThreshold > 3) :
					/* We want to check the amount of empty details, if greater than 3
					 * we want to display an alert so patients and doctors will fill
					 * out the left out information.
					 */
				?>
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span8">
						<div class="alert alert-warning">
							We've noticed that you're missing a fair amount of patient details!
							This information is outstanding to have on your record, so why not hit the
							edit button under "Medical Information" or "Insurance Information" and make some changes?
						</div>
					</div>
				</div>
				<br />
				
				<?php endif ?>
				
				<?php if ($demographicsThreshold > 2) :
					/* We want to check the amount of empty demographics. If greater than
					 * two we want to display an alert to fill out additional
					 * information */
				?>
				<div class="row-fluid">
					<div class="span2"></div>
					<div class="span8">
						<div class="alert alert-info">
							We've noticed that you're missing a fair amount of demographics information!
							Having this information can only be helpful, so we strongly recommend clicking
							demographics at the top of the page, and adding any missing fields. <br />
						</div>
					</div>
				</div>
				<br />
				<?php endif ?>
				
				
				
				
				
			<!-- Begin basic information -->
			<div class="row-fluid">
				<div class="span2"></div>
				<div class ="span4">
					<div class="btn-group">
						
						<button class="btn btn-primary">Basic Information</button>
					</div>
					<table class="table table-bordered table-hover">
						<tr>
							<td style="width:95px;"><Strong>Name</Strong></td>
							<td><?= $firstName ?> <?= $lastName ?></td>
						</tr>
						<tr>
							<td><strong>Home Address:</strong></td>
							<td><?= $streetAddress ?> <br />
							<?= $city ?>, <?= $state ?> <?= $zip ?> <br /></td>
						</tr>
						
						<?php if (!empty($phoneHome)) :	?>
						<tr>
							<td><strong>Home Phone:</strong></td>
							<td><?= $phoneHome ?></td>
						</tr>						
						<?php endif; ?>
						
						<?php if (!empty($phoneCell)) :	?>
						<tr>
							<td><strong>Cell Phone: </strong></td>
							<td><?= $phoneCell ?></td>
						</tr>
						<?php endif; ?>
						
						<?php if (!empty($phoneWork)) :	?>
						<tr>
							<td><strong>Work Phone: </strong></td>
							<td><?= $phoneWork ?></td>
						</tr>
						<?php endif; ?>
						
						<tr>
							<td><strong>DOB: </strong></td>
							<td><?= $dob ?></td>
						</tr>
						<tr>
							<td><strong>SSN: </strong></td>
							<?php
								//Hides the SSN by replacing the first 5 characters with X
								if ($role == 1) {
									$ssArr = str_split($ss);
									$ssArr[0] = "XXX-XX-";
									$ss = array("XXX-XX-", $ssArr[5], $ssArr[6], $ssArr[7],
										    $ssArr[8]);
									$ss = implode($ss);
								}
							?>
							
							<td><?= $ss ?></td>
						</tr>
					</table>
				</div>
				<!-- End Basic Information -->
				
				<div class="span1"></div>
				
				<!-- Photo -->
				<div class="span3">
					<?php
						/* We load a default photo if someone doesn't have one uploaded */
						if ($picture == NULL) {
							$picture = "http://i48.tinypic.com/2d8jaj5.jpg";
						}
					?>
					<button class="btn btn-primary" id="editPicture">Edit Picture</button>
					<img src=<?= $picture ?> class="img-rounded" alt="Photo" id="picture">
					<span id="pictureEdit"> </span>
				</div>
				<!-- End Photo -->
			</div>
			<!-- End first row -->
		
			<br />
			<br />
			<br />
			
			<!--Grouping for "Medical Information" -->
			<div class="row-fluid">				
				<div class="span2"></div>
				<div class ="span8">
					<!-- Grouping for Medical Information Button -->
					<div class="btn-group">
						<!-- Drop Down -->
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="javascript:;" id="editMed">Edit</a></li>
						</ul>
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#medical">
							Medical Information
						</button>
						<span id="medSaveButton">
						
						</span>
					</div>
			
					<!--Grouping for Medical Information Table -->
					<div class="collapse in" id="medical">
						<table class="table table-bordered table-hover">
							<tr>
								<td> 
									<strong>Active Symptoms: </strong>
								</td>
								<td id="activeDiagnose">
									<?php if (!empty($activeDiagnosis)) : ?>
										<?= $activeDiagnosis ?>
									<?php else : ?>
										Family history not listed.
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td> 
									<strong>Inactive Smyptoms:</strong>	
								</td>
								<td id="inactiveDiagnose">
									<?php if (!empty($inactive)) : ?>
										<?= $inactive ?>
									<?php else : ?>
										Inactive symptoms not listed.
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td>
									<strong>Allergies: </strong>
								</td>
								<td id="allergies">
									<?php if (!empty($allergies)) : ?>
										<?= $allergies ?>
									<?php else : ?>
										Allergies not listed.
									<?php endif ?>
								</td>
							</tr>
							<tr>
								<td style="width:140px;"> 
									<strong>Family History: </strong>
								</td>
								<td id="familyHis">
									<?php if (!empty($familyhis)) : ?>
										<?= $familyhis ?>
									<?php else : ?>
										Family history not listed
									<?php endif ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
			<br />
			<br />
			<br />
			<!-- End Medical Information -->			
			<?php endif; ?>
			
			<!-- Emergency Information & Insurance Information -->
			<?php if ($isPatient) :
				//This is viewable to all.
			?>
			<div class="row-fluid">
				<div class="span2"></div>
				
				<!-- EMERGENCY INFO -->
				<div class="span3">
					
					<div class="btn-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" >
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="javascript:;" id="editEmergency">Edit</a></li>
						</ul>
						<button type="button" class="btn btn-primary"  data-toggle="collapse" data-target="#emergency">
							Emergency Contact
						</button>
						<span id="emergencySaveButton">
						
						</span>
					</div>
					<div id="emergency" class="collapse in">
						<table class="table table-bordered table-hover">
							<tr>
								<td><strong>Name: </strong></td>
								<td id="emergencyName">
								<?php if (!empty($emergencyName)) : ?>
									<?= $emergencyName ?>
								<?php elseif(empty($emergencyName)) : ?>
									
										No emergency contact listed.
									
								<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td><strong>Relation: </strong></td>
								<td id="emergencyRelation">
								<?php if (!empty($emergencyName)) : ?>
									<?= $emergencyRelation ?>
								<?php elseif(empty($emergencyName)) : ?>
									No emergency relation listed
								<?php endif; ?>
								</td>
							</tr>
							<tr>
								<td><strong>Phone #: </strong></td>
								<td id="emergencyPhone">
								<?php if (!empty($emergencyPhone)) : ?>
									<?= $emergencyPhone ?>
								<?php elseif(empty($emergencyPhone)) : ?>
									No emergency # listed
								<?php endif; ?>
								</td>
							</tr>
						</table>
					</div>
				</div>
				<!-- End Emergency Info -->
				
				<div class="span1"></div>
				
				<!-- Begin insurance information -->
				<div class="span4">
					<div class="btn-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" >
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="javascript:;" id="editIns">Edit</a></li>
						</ul>
						<button type="button" class="btn btn-primary"  data-toggle="collapse" data-target="#insurance">
							Insurance Information
						</button>
						<span id="insSaveButton">
						
						</span>
					</div>
					<div id="insurance" class="collapse in">
						<table class="table table-bordered table-hover">
							<tr>
								<td><strong>Insurance Company: </strong></td>
							
								<td id="insCompany">
									<?php if (!empty($insCompany)) : ?>
										<?= $insCompany; ?>
									
									<?php else : ?>
										No insurance company listed.
										
									<?php endif; ?>
								</td>
							</tr>
							
							<tr>
								<td><strong>Address: </strong></td>
							
								<td id="insCompanyAd">
									<?php if (!empty($insCompanyAddress)) : ?>
										<?= $insCompanyAddress ?>
									
									<?php elseif(empty($insCompanyAddress)) : ?>
										Insurance company address not listed
									<?php endif; ?>	
								</td>
							</tr>
							
							<tr>
								<td><strong>Group #: </strong></td>
								<td id="groupNumber">
								<?php if (!empty($groupNumber)) : ?>
									<?= $groupNumber ?>
								<?php elseif(empty($groupNumber)) : ?>
									No group number listed
								<?php endif; ?>
								</td>
							</tr>
							
							<tr>
								<td><strong>Policy #: </strong></td>
								<td id="policyNumber">
								<?php if (!empty($policyNumber)) : ?>
									<?= $policyNumber ?>
								
								<?php elseif(empty($policyNumber)) : ?>
									No policy number listed
								<?php endif; ?>
								</td>
							</tr>
							
							<tr>
								<td><strong>Insurance Contact: </strong></td>
								<td id="contact">
								<?php if (!empty($contact)) : ?>
									<?= $contact ?>
								<?php elseif(empty($contact)) : ?>
									No contact listed
								<?php endif; ?>
								</td>
							</tr>
							
							<tr>
								<td><strong>Contact Phone #: </strong></td>
								<td id="contactNumber">
								<?php if (!empty($contactNumber)) : ?>
									<?= $contactNumber ?>
								<?php elseif(empty($contactNumber)) : ?>
									No contact phone number listed
								<?php endif; ?>
								</td>
						</table>
					</div>
				</div>
				<!--End insurance information-->
				
			</div>
			<br />
			<br />
			<br />
			
			<?php endif; ?>
			
			<?php if ($isPatient && ($role == 2)) :
				/* We only care to display progress notes if the person logged in
				 * is a doctor, and they're checking on a patient. */
			?>
					
			<!-- High priority progress notes -->
			<div class="row-fluid">
				<div class="span2"></div>
				
				<div class="span8">
					<div class="btn-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
							<span class="caret"></span>
						</button>
						<ul class="dropdown-menu">
							<li><a href="#">Edit</a></li>
						</ul>
						<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#progressNotes">
							High Priority Progress Notes
						</button>						
					</div>
					
					<div id="progressNotes" class="collapse in">
						<table class="table table-bordered table-hover">
							<?php $noteNumber = $gatherer->getNumberNotesByPatientId($uid);
								if (empty($noteNumber)) :
								//If there are no records on file, we display that there are no records on file!
							?>
								<tr>
									<td>No notes on record for this patient.</td>
								</tr>
							
							<?php else :
								//IF there are, display them!	
							?>
							
							<tr>
								<th style="width: 135px;">
									Author <br>
									Date
								</th>
								<th style="width:100px;">
									Subject
								</th>
								<th>
									Note
								</th>
							</tr>
							

							<?php
								$numPages = $noteNumber / 5;
								if ($noteNumber % 5 > 0)
								{
									$numPages++;
								}
								echo $numPages;
								$patientNotes = $gatherer->getNotesByPatientIdAndPriority($uid, 0, 3);
								$numberNotes = sizeof($patientNotes);
								for ($i = $numberNotes-1; $i >= 0; $i--) :
									$noteArray = $patientNotes[$i];
									$subject = $noteArray['subject'];
									$note = $noteArray['note'];
									$createdDate = $noteArray['createDate'];
									$createdBy = $noteArray['createdBy'];
									$noteUserDetails = $gatherer->getUserDetails($createdBy);
									$noteAuthor = $noteUserDetails['firstName'] . " " . $noteUserDetails['lastName'];
									$date = date_create($createdDate);
									$formattedDate = date_format($date, 'F j, Y g:i A');
							?>	
								<tr>
									<td>
										<?= $noteAuthor ?>
										<br /> <br />
										<?= $formattedDate ?>
										<br />
									</td>
									<td>
										<?= $subject ?>
									</td>
									<td>
										<?= $note ?>
									</td>
								</tr>
								<?php endfor; ?>
						</table>
						<div class="pagination pagination-centered">
							<ul>
								<?php for($thisNoteNum = 1; $thisNoteNum <= $numPages+1; $thisNoteNum++) : ?>
								<li><a href="#"><?= $thisNoteNum ?></a></li>
								<?php endfor; ?>
							</ul>
						</div>
						<?php endif; ?>
					</div>
					<br />
				</div>				
			</div>
			<?php endif; ?>			
		</div>
		<script src="js/jquery-1.8.3.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/summary.js"></script>
	</body>
</html>
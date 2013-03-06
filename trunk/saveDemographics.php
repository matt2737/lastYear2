<?php
include_once('Gatherer.php');
session_start();
ob_start();


$SID = $_SESSION['id'];
$gatherer = new Gatherer();
if(isset($_SESSION['userId'])){
    $SID = $_SESSION['userId'];
}
//Users table information
$firstName = $_POST['fname'];
$lastName = $_POST['lname'];
$dob = $_POST['dob'];
$ss = $_POST['ss'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$zipCode = $_POST['zipCode'];
$email = $_POST['email'];
$gender = $_POST['gender'];

$userResult = $gatherer->updateUserFromDemo($SID, $firstName, $lastName, $dob, $ss, $address, $city, $state, $zip, $email, $gender);
//var_dump($userResult);

//Demographics table information
$phoneHome = $_POST['phoneHome'];
$phoneWork = $_POST['phoneWork'];
$phoneCell = $_POST['phoneCell'];
$phonePager = $_POST['phonePager'];
$employerName = $_POST['employerName'];
$employerPhone = $_POST['employerPhone'];
$employerAddress = $_POST['employerAddress'];
$employerCity = $_POST['employerCity'];
$employerState = $_POST['employerState'];
$employerZipCode = $_POST['employerZipCode'];
$birthCity = $_POST['birthCity'];
$birthState = $_POST['birthState'];
$birthCountry = $_POST['birthCountry'];
$maritalStatus = $_POST['maritalStatus'];
$spouseName = $_POST['spouseName'];
$emergencyName = $_POST['emergencyName'];
$emergencyPhone = $_POST['emergencyPhone'];
$emergencyAddress = $_POST['emergencyAddress'];
$emergencyState = $_POST['emergencyState'];
$emergencyCity = $_POST['emergencyCity'];
$emergencyZip = $_POST['emergencyZipCode'];
$emergencyRelation = $_POST['emergencyRelation'];
$occupation = $_POST['occupation'];
$religion = $_POST['religion'];
$race = $_POST['race'];
$motherMaidenName = $_POST['motherMaidenName'];
$dateOfDeath = $_POST['dateOfDeath'];
$placeOfDeath = $_POST['placeOfDeath'];
$deathName = $_POST['deathName'];
$demoInfo = array(
    "id" => $SID,
    "phoneHome" => $phoneHome,
    "phoneWork" => $phoneWork,
    "phoneCell" => $phoneCell,
    "phonePager" => $phonePager,
    "employerName" => $employerName,
    "employerPhone" => $employerPhone,
    "employerAddress" => $employerAddress,
    "employerState" => $employerState,
    "employerZip" => $employerZipCode,
    "employerCity" => $employerCity,
    "birthCity" => $birthCity,
    "birthState" => $birthState,
    "birthCountry" => $birthCountry,
    "maritalStatus" =>$maritalStatus,
    "spouseName" => $spouseName,
    "emergencyName" => $emergencyName,
    "emergencyPhone" => $emergencyPhone,
    "emergencyAddress" => $emergencyAddress,
    "emergencyState" => $emergencyState,
    "emergencyCity" => $emergencyCity,
    "emergencyZip" => $emergencyZip,
    "emergencyRelation" => $emergencyRelation,
    "occupation" => $occupation,
    "religion" => $religion,
    "race" => $race,
    "motherMaidenName" => $motherMaidenName,
    "dateOfDeath" => $dateOfDeath,
    "placeOfDeath" => $placeOfDeath,
    "deathName" => $deathName
);
$demoResult = $gatherer->updateDemographics($demoInfo);


//Patient table information
$insCompany = $_POST['insCompany'];
$insAddress = $_POST['insAddress'];
$groupNumber = $_POST['groupNumber'];
$policyNumber = $_POST['policyNumber'];
$contact = $_POST['contact'];
$contactNumber = $_POST['contactNumber'];

$patientResult = $gatherer->updatePatientFromDemo($SID, $insCompany, $insAddress, $groupNumber, $policyNumber, $contact, $contactNumber);

header('Location: demographics.php');



?>
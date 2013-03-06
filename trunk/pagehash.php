<?php
/**
 *@author John Powers <powers96@students.rowan.edu>
 *This gets all information for a particular user from the database
 *encodes it as json, and echoes a hash of the result
 */
include_once('Gatherer.php');
$id = $_GET['id'];

$gatherer = new Gatherer();
$userDetails = $gatherer->getUserDetails($id);
$patientDetails = $gatherer->getPatientDetails($id);
$emergencyDetails = $gatherer->getEmergencyInfo($id);

$details = array_merge($userDetails, $patientDetails, $emergencyDetails);
$details_json = json_encode($details);
echo md5($details_json);

?>
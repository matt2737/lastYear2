<?php 
include_once('Gatherer.php');

$gatherer = new Gatherer();

//Adding a user to the database. (name, dob, address, ss, picture)
$result = $gatherer->addUser("Yoda", "Powers", "12/11/09", "1411 Woodlane Dr.", "Westville", "NJ", "08093", "143-23-4567", "elsternj", "sophie", 1, "something@lt.com", NULL);
echo "The unique ID after adding a user to the database: <br> $result <br>"; //Result will be their unique id in the database

//Adding a patient to the database.  You want to do this with the id you get back from adding a user.  If a user
//is a patient then they will have a row in the patients table
$patientResult = $gatherer->addPatient($result, "Mother diagnosed with...", "Cancer", "Asthma", "peanuts");
echo "<br> $patientResult <br>";

//Getting all of the details for a patient from the database
$patientResult = $gatherer->getPatientDetails($result);
echo "<br>Patient RESULTS <br> $patientResult[familyHistory] <br> $patientResult[activeDiagnose] <br>";

//Getting all of a user's details from the database.
$result = $gatherer->getUserDetails(2);
echo "$result[firstName]  <br>  $result[lastName]  <br> $result[dob] <br> $result[address] <br> $result[city] <br> $result[state] <br> $result[zip] <br> <img src=\"$result[picture]\"></img>";

//Updating a user's details (userId, newName).  $result will return true or false.
$result = $gatherer->updateFirstName(2, "Cory");
$result = $gatherer->updateLastName(2, "Finch");
//(userId, new Family History).  A method like this for all fields, structured this same way.
$result = $gatherer->updateFamilyHis(2, "Mother recently diagnosed with...");

//Adding a new progress note.  $result will return unique Id of note
//(userId that created the note, the note, note subject, priority, unique Id of patient note is for)
$result = $gatherer->addNewNote(2, "This is the note", "Note subject", 1, 2);

//Getting progress notes by patientId (patientId, starting record, (optional number of records after starting record, default gets them all)
$result = $gatherer->getNotesByPatientId(0, 0, 2);
for($i = 0; $i < count($result); $i++){
    echo "{$result[$i][subject]} <br> {$result[$i][note]} <br>";
}

//Getting progress notes by the user who created the note (userId, starting record, (optional number of records after starting record, default gets them all)
$result = $gatherer->getNotesByUserId(2, 0, 2);
for($i = 0; $i < count($result); $i++){
    echo "{$result[$i][subject]} <br> {$result[$i][note]} <br>";
}

?>
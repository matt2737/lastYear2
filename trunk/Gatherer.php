<?php
/*
 *@author John Powers <powers96@students.rowan.edu>
 *The Gatherer class handles all C.R.U.D. with the database.
 */
class Gatherer
{
    private $hostName = '205.134.224.208';
    private $database = 'elster5_se';
    private $dbpassword = 'project!';
    private $userName = 'elster5_admin';
    private $patientTable = 'patients';
    private $notesTable = 'notes';
    private $usersTable = 'users';
    private $demographicsTable = 'demographics';
    
    /**
     * Establishes a connection to the database.
     * @return a PDO object to the database.
     */
    function getConnection()
    {
        try{
            $dbConnect = new PDO("mysql:host=$this->hostName;dbname=$this->database", $this->userName, $this->dbpassword);
        }catch(PDOException $e) {  
            $dbConnect = false;
        }
        return $dbConnect;
        
    }
    
    /**
     *Get user from database given their userId
     *@param $userId the unique userId for the user
     *@return An associative array of the user's information from the database.
     */
    function getUserDetails($userId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->usersTable WHERE id = :id");
        $query->bindParam(':id', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
     /**
     *Get demographics from database
     *@param $userId the unique userId for the user
     *@return An associative array of the user's demographic information from the database.
     */
    function getDemographics($userId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->demographicsTable WHERE id = :id");
        $query->bindParam(':id', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function getEmergencyInfo($userId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT emergencyName, emergencyPhone, emergencyRelation, phoneHome, phoneCell, phoneWork FROM $this->demographicsTable WHERE id = :id");
        $query->bindParam(':id', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *Add demographics into database
     *@param $info and associative array of the user's demographic information
     *@return True if it worked, False otherwise.
     */
    function addDemographics($info)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("INSERT INTO $this->demographicsTable (id, phoneHome, phoneWork, phoneCell, phonePager,
                                     birthCity, birthState, birthCountry, occupation, religion, race, motherMaidenName,
                                     employerName, employerPhone, employerAddress, employerCity, employerState, employerZip, retired, disabled,
                                     spouseName, emergencyName, emergencyRelation, emergencyAddress, emergencyState,
                                     emergencyCity, emergencyZip, dateOfDeath, placeOfDeath, deathName, maritalStatus, emergencyPhone)
                                     VALUES (:id, :phoneHome, :phoneWork, :phoneCell, :phonePager, :birthCity, :birthState, :birthCountry,
                                     :occupation, :religion, :race, :motherMaidenName, :employerName, :employerPhone, :employerAddress,
                                     :employerCity, :employerState, :employerZip, :retired, :disabled, :spouseName, :emergencyName, :emergencyRelation, :emergencyAddress,
                                     :emergencyState, :emergencyCity, :emergencyZip, :dateOfDeath, :placeOfDeath, :deathName, :maritalStatus, :emergencyPhone)");
        $query->bindParam(':id', $info['id']);
        $query->bindParam(':phoneHome', $info['phoneHome']);
        $query->bindParam(':phoneWork', $info['phoneWork']);
        $query->bindParam(':phoneCell', $info['phoneCell']);
        $query->bindParam(':phonePager', $info['phonePager']);
        $query->bindParam(':birthCity', $info['birthCity']);
        $query->bindParam(':birthState', $info['birthCity']);
        $query->bindParam(':birthCountry', $info['birthCountry']);
        $query->bindParam(':occupation', $info['occupation']);
        $query->bindParam(':religion', $info['religion']);
        $query->bindParam(':race', $info['race']);
        $query->bindParam(':motherMaidenName', $info['motherMaidenName']);
        $query->bindParam(':employerName', $info['employerName']);
        $query->bindParam(':employerPhone', $info['employerPhone']);
        $query->bindParam(':employerAddress', $info['employerAddress']);
        $query->bindParam(':employerCity', $info['employerCity']);
        $query->bindParam(':employerState', $info['employerState']);
        $query->bindParam(':employerZip', $info['employerZip']);
        $query->bindParam(':retired', $info['retired']);
        $query->bindParam(':disabled', $info['disabled']);
        $query->bindParam(':spouseName', $info['spouseName']);
        $query->bindParam(':emergencyName', $info['emergencyName']);
        $query->bindParam(':emergencyRelation', $info['emergencyRelation']);
        $query->bindParam(':emergencyAddress', $info['emergencyAddress']);
        $query->bindParam(':emergencyState', $info['emergencyState']);
        $query->bindParam(':emergencyCity', $info['emergencyCity']);
        $query->bindParam(':emergencyZip', $info['emergencyZip']);
        $query->bindParam(':dateOfDeath', $info['dateOfDeath']);
        $query->bindParam(':placeOfDeath', $info['placeOfDeath']);
        $query->bindParam(':deathName', $info['deathName']);
        $query->bindParam(':maritalStatus', $info['maritalStatus']);
        $query->bindParam(':emergencyPhone', $info['emergencyPhone']);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    function doesUsernameExist($username)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->usersTable WHERE username = :username");
        $query->bindParam(':username', $username);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return True;
        }
        else{
            return False;
        }
    }
    
    /**
     *Get patient from database given their userId
     *@param $userId the unique userId for the user
     *@return An associative array of the user's information from the database.
     */
    function getPatientDetails($userId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->patientTable WHERE userId = :id");
        $query->bindParam(':id', $userId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
     /**
     *Attempt to login the user
     *@param $username The user's username
     *@param $password The user's password
     *@return The associative array
     */
    function login($username, $password)
    {
        $password = md5($password);
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->usersTable WHERE username = :username AND password = :password");
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *Add user in database then return their unique id
     *@param $firstName The users first name
     *@param $lastName The users last name
     *@param $dob The users date of birth
     *@param $address The user's address
     *@param $city The user's city
     *@param $state The users state
     *@param $zip The users zip code
     *@param $ss The user's social security number
     *@param $picture A URL pointing to the users picture
     *@param $username The users username to login
     *@param $password The users password to login
     *@param $role 1 for patient, 2 for administrator
     *@param $email The email address of the user
     *@return The users unique Id after being put in the database if succesful,
     *otherwise return false
     */
    function addUser($firstName, $lastName, $dob, $address, $city, $state, $zip, $ss, $username, $password, $role, $email, $picture, $gender)
    {
        $password = md5($password);
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("INSERT INTO $this->usersTable (firstName, lastName, dob, address, city, state, zip, ss, picture, username, password, role, email, gender)
                                     VALUES (:firstName, :lastName, :dob, :address, :city, :state, :zip, :ss, :picture, :username, :password, :role, :email, :gender)");
        $query->bindParam(':firstName', $firstName);
        $query->bindParam(':lastName', $lastName);
        $query->bindParam(':dob', $dob);
        $query->bindParam(':address', $address);
        $query->bindParam(':city', $city);
        $query->bindParam(':state', $state);
        $query->bindParam(':zip', $zip);
        $query->bindParam(':ss', $ss);
        $query->bindParam(':picture', $picture);
        $query->bindParam(':username', $username);
        $query->bindParam(':password', $password);
        $query->bindParam(':role', $role);
        $query->bindParam(':email', $email);
        $query->bindParam(':gender', $gender);
        $result = $query->execute();

        if($result){
            return $dbConnect->lastInsertId();
        }else{
            return false;
        }   
    }
    
    /**
     *Add user in database then return their unique id
     *@param $userId The user account for this patient
     *@param $familyHistory The patients family history
     *@param $inactiveDiagnose The patients inactive diagnoses
     *@param $activeDiagnose The patients active diagnoses
     *@param $allergies The patients allergies
     *@param $insCompany Insurance Company
     *@param $insCompanyAddress Insurance Company Address
     *@param $groupNumber Insurance Group Number
     *@param $policyNumber Insurance Policy Number
     *@param $contact Contact for individual
     *@param $contactNumber Phone number for contact
     *@return True or false depending if it worked.
     */
    function addPatient($userId, $familyHistory=NULL, $inactiveDiagnose=NULL, $activeDiagnose=NULL, $allergies=NULL,
                        $insCompany=NULL, $insCompanyAddress=NULL, $groupNumber=NULL, $policyNumber=NULL, $contact=NULL, $contactNumber=NULL)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("INSERT INTO $this->patientTable (userId, activeDiagnose, inactiveDiagnose, allergies, familyHistory,
                                     insCompany, insCompanyAddress, groupNumber, policyNumber, contact, contactNumber) VALUES
                                     (:userId, :activeDiagnose, :inactiveDiagnose, :allergies, :familyHistory, :insCompany, :insCompanyAddress, :groupNumber,
                                     :policyNumber, :contact, :contactNumber)");
        $query->bindParam(':userId', $userId);
        $query->bindParam(':familyHistory', $familyHistory);
        $query->bindParam(':inactiveDiagnose', $inactiveDiagnose);
        $query->bindParam(':activeDiagnose', $activeDiagnose);
        $query->bindParam(':allergies', $allergies);
        $query->bindParam(':insCompany', $insCompany);
        $query->bindParam(':insCompanyAddress', $insCompanyAddress);
        $query->bindParam(':groupNumber', $groupNumber);
        $query->bindParam(':policyNumber', $policyNumber);
        $query->bindParam(':contact', $contact);
        $query->bindParam(':contactNumber', $contactNumber);
        $result = $query->execute();
        
        return $result;
    }
    
    

    
    
    /**
     *Update User in database from the demographics page
     *@param $userId The user id of the person we are updating
     */
    function updateUserFromDemo($userId, $newFirstName, $newLastName, $newDob, $newSS, $newAddress, $newCity, $newState, $newZip, $newEmail, $newGender)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->usersTable SET firstName = :firstName, lastName = :lastName,
                                     dob = :dob, ss = :ss, address = :address, city = :city, state = :state,
                                     zip = :zip, email = :email, gender = :gender WHERE id = :id");
        $query->bindParam(':firstName', $newFirstName);
        $query->bindParam(':lastName', $newLastName);
        $query->bindParam(':dob', $newDob);
        $query->bindParam(':ss', $newSS);
        $query->bindParam(':address', $newAddress);
        $query->bindParam(':city', $newCity);
        $query->bindParam(':state', $newState);
        $query->bindParam(':zip', $newZip);
        $query->bindParam(':email', $newEmail);
        $query->bindParam(':gender', $newGender);
        $query->bindParam(':id', $userId);
        $result = $query->execute();
        return $result;
    }
    
    function updatePicture($userId, $newPicture)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->usersTable SET picture = :picture WHERE id = :id");
        $query->bindParam(':picture', $newPicture);
        $query->bindParam(':id', $userId);
        $result = $query->execute();
        return $result;
    }
    
     /**
     *Update Patient in database from demographics page
     *@param $userId The user id of the person we are updating
     */
    function updatePatientFromDemo($userId, $newInsCompany, $newInsCompanyAddress, $newGroupNumber, $newPolicyNumber, $newContact, $newContactNumber)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->patientTable SET insCompany = :insCompany, insCompanyAddress = :insCompanyAddress,
                                     groupNumber = :groupNumber, policyNumber = :policyNumber, contact = :contact, contactNumber = :contactNumber WHERE userId = :id");
        $query->bindParam(':insCompany', $newInsCompany);
        $query->bindParam(':insCompanyAddress', $newInsCompanyAddress);
        $query->bindParam(':groupNumber', $newGroupNumber);
        $query->bindParam(':policyNumber', $newPolicyNumber);
        $query->bindParam(':contact', $newContact);
        $query->bindParam(':contactNumber', $newContactNumber);
        $query->bindParam(':id', $userId);
        $result = $query->execute();
        return $result;
    }
    
    function updateDemographics($info)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->demographicsTable SET phoneHome = :phoneHome, phoneWork = :phoneWork, phoneCell = :phoneCell,
                                     phonePager = :phonePager, birthCity = :birthCity, birthState = :birthState, birthCountry = :birthCountry,
                                     occupation = :occupation, religion = :religion, race = :race, motherMaidenName = :motherMaidenName,
                                     employerName = :employerName, employerPhone = :employerPhone, employerAddress = :employerAddress,
                                     employerCity = :employerCity, employerState = :employerState, employerZip = :employerZip, retired = :retired,
                                     disabled = :disabled, spouseName = :spouseName, emergencyName = :emergencyName, emergencyRelation = :emergencyRelation,
                                     emergencyAddress = :emergencyAddress, emergencyState = :emergencyState, emergencyCity = :emergencyCity,
                                     emergencyZip = :emergencyZip, dateOfDeath = :dateOfDeath, placeOfDeath = :placeOfDeath, deathName = :deathName,
                                     maritalStatus = :maritalStatus, emergencyPhone = :emergencyPhone WHERE id = :id");
        $query->bindParam(':id', $info['id']);
        $query->bindParam(':phoneHome', $info['phoneHome']);
        $query->bindParam(':phoneWork', $info['phoneWork']);
        $query->bindParam(':phoneCell', $info['phoneCell']);
        $query->bindParam(':phonePager', $info['phonePager']);
        $query->bindParam(':birthCity', $info['birthCity']);
        $query->bindParam(':birthState', $info['birthState']);
        $query->bindParam(':birthCountry', $info['birthCountry']);
        $query->bindParam(':occupation', $info['occupation']);
        $query->bindParam(':religion', $info['religion']);
        $query->bindParam(':race', $info['race']);
        $query->bindParam(':motherMaidenName', $info['motherMaidenName']);
        $query->bindParam(':employerName', $info['employerName']);
        $query->bindParam(':employerPhone', $info['employerPhone']);
        $query->bindParam(':employerAddress', $info['employerAddress']);
        $query->bindParam(':employerCity', $info['employerCity']);
        $query->bindParam(':employerState', $info['employerState']);
        $query->bindParam(':employerZip', $info['employerZip']);
        $query->bindParam(':retired', $info['retired']);
        $query->bindParam(':disabled', $info['disabled']);
        $query->bindParam(':spouseName', $info['spouseName']);
        $query->bindParam(':emergencyName', $info['emergencyName']);
        $query->bindParam(':emergencyRelation', $info['emergencyRelation']);
        $query->bindParam(':emergencyAddress', $info['emergencyAddress']);
        $query->bindParam(':emergencyState', $info['emergencyState']);
        $query->bindParam(':emergencyCity', $info['emergencyCity']);
        $query->bindParam(':emergencyZip', $info['emergencyZip']);
        $query->bindParam(':dateOfDeath', $info['dateOfDeath']);
        $query->bindParam(':placeOfDeath', $info['placeOfDeath']);
        $query->bindParam(':deathName', $info['deathName']);
        $query->bindParam(':maritalStatus', $info['maritalStatus']);
        $query->bindParam(':emergencyPhone', $info['emergencyPhone']);
        $result = $query->execute();
        return $result;
    }
    
    function updateMedicalInfo($info)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->patientTable SET activeDiagnose = :activeDiagnose,
                                     inactiveDiagnose = :inactiveDiagnose, familyHistory = :familyHis, allergies = :allergies WHERE userId = :id");
        $query->bindParam(':id', $info['id']);
        $query->bindParam(':activeDiagnose', $info['activeDiagnose']);
        $query->bindParam(':inactiveDiagnose', $info['inactiveDiagnose']);
        $query->bindParam(':familyHis', $info['familyHis']);
        $query->bindParam(':allergies', $info['allergies']);
        $result = $query->execute();
        return $result;
    }
    
    function updateInsuranceInfo($info)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->patientTable SET insCompany = :insCompany,
                                     insCompanyAddress = :insCompanyAddress, groupNumber = :groupNumber, policyNumber = :policyNumber,
                                     contact = :contact, contactNumber = :contactNumber WHERE userId = :id");
        $query->bindParam(':id', $info['id']);
        $query->bindParam(':insCompany', $info['insCompany']);
        $query->bindParam(':insCompanyAddress', $info['insCompanyAddress']);
        $query->bindParam(':groupNumber', $info['groupNumber']);
        $query->bindParam(':policyNumber', $info['policyNumber']);
        $query->bindParam(':contact', $info['contact']);
        $query->bindParam(':contactNumber', $info['contactNumber']);
        $result = $query->execute();
        return $result;
    }
    
    
    function updateEmergencyInfo($info)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->demographicsTable SET emergencyName = :emergencyName,
                                     emergencyPhone = :emergencyPhone, emergencyRelation = :emergencyRelation WHERE id = :id");
        $query->bindParam(':id', $info['id']);
        $query->bindParam(':emergencyName', $info['emergencyName']);
        $query->bindParam(':emergencyPhone', $info['emergencyPhone']);
        $query->bindParam(':emergencyRelation', $info['emergencyRelation']);
        $result = $query->execute();
        return $result;
    }
    
    
    /**
     *Add new note in database then return the unique id of the note
     *@param $userId The user id of the person creating the note
     *@param $note The actual note written
     *@param $subject The subject of the note
     *@param $priority An integer of the priority of the note
     *@param $patientId The patient who this note is for
     *@return The note's unique Id after being put in the database if succesful,
     *otherwise return false
     */
    function addNewNote($userId, $note, $subject, $priority, $patientId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("INSERT INTO $this->notesTable (createdBy, note, priority, subject, patientId)
                                     VALUES (:createdBy, :note, :priority, :subject, :patientId)");
        $query->bindParam(':createdBy', $userId);
        $query->bindParam(':patientId', $patientId);
        $query->bindParam(':note', $note);
        $query->bindParam(':subject', $subject);
        $query->bindParam(':priority', $priority);
        $result = $query->execute();

        if($result){
            return $dbConnect->lastInsertId();
        }else{
            return false;
        }      
    }
    
    /**
     *Get progress notes created by a given user.
     *@param $patientId The unique user id of the patient.
     *@param $start The row to start from.
     *@param $number Optional paramater. For how many records after $start
     *to get.  By default it will get all records.
     */
    function getNotesByUserId($userId, $start, $number='max')
    {
        $dbConnect = $this->getConnection();
        $count = $dbConnect->prepare("SELECT * FROM $this->notesTable WHERE createdBy = :userId");
        $count->bindParam(':userId', $userId);
        $count->execute();
        $count = $count->rowCount();
        if($number == 'max'){
            $number = $count;
        }
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT note, createDate, priority, subject, id FROM $this->notesTable
                                     WHERE createdBy = :userId LIMIT {$start}, {$number}");
        $query->bindParam(':userId', $userId);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *Get progress notes for a given patient.
     *@param $patientId The unique user id of the patient.
     *@param $start The row to start from.
     *@param $number Optional paramater. For how many records after $start
     *to get.  By default it will get all records.
     */
    function getNotesByPatientId($patientId, $start, $number='max')
    {
        
        $dbConnect = $this->getConnection();
        $count = $dbConnect->prepare("SELECT * FROM $this->notesTable WHERE patientId = :patientId");
        $count->bindParam(':patientId', $patientId);
        $count->execute();
        $count = $count->rowCount();
        if($number == 'max'){
            $number = $count;
        }
        $query = $dbConnect->prepare("SELECT note, createDate, createdBy, priority, subject, id FROM $this->notesTable
                                     WHERE patientId = :patientId LIMIT {$start}, {$number}");
        $query->bindParam(':patientId', $patientId);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }
    
    /* Gets the number of notes listed under a specific patient ID.
     * @param $patientId The unique user ID of the patient.
     * @return the number of notes in the table.
     */
    function getNumberNotesByPatientId($patientId)
    {
        $dbConnect = $this->getConnection();
        $count = $dbConnect->prepare("SELECT * FROM $this->notesTable WHERE patientId = :patientId");
        $count->bindParam(':patientId', $patientId);
        $count->execute();
        $count = $count->rowCount();
        return $count;
    }
    
    function getNotesForPatient($patientId, $start, $number='max')
    {
        
        $dbConnect = $this->getConnection();
        $count = $dbConnect->prepare("SELECT * FROM $this->notesTable WHERE patientId = :patientId AND createdBy = :createdBy");
        $count->bindParam(':patientId', $patientId);
        $count->bindParam(':createdBy', $patientId);
        $count->execute();
        $count = $count->rowCount();
        if($number == 'max'){
            $number = $count;
        }
        $query = $dbConnect->prepare("SELECT note, createDate, createdBy, priority, subject, id FROM $this->notesTable
                                     WHERE patientId = :patientId AND createdBy = :createdBy LIMIT {$start}, {$number}");
        $query->bindParam(':patientId', $patientId);
        $query->bindParam(':createdBy', $patientId);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result; 
    }
    
    /**
     *This method gets progress notes for a given patient, given a priority threshold.
     *@param $patientId The unique user id of the patient.
     *@param $start The row to start from.
     *@param $priority The priority ranking for the note ranging 1-3
     *@param $number Optional paramater. For how many records after $start
     *to get.  By default it will get all records.
     */
    function getNotesByPatientIdAndPriority($patientId, $start, $priority, $number='max')
    {
        $dbConnect = $this->getConnection();
        $count = $dbConnect->prepare("SELECT * FROM $this->notesTable WHERE patientId = :patientId AND priority = :priority");
        $count->bindParam(':patientId', $patientId);
        $count->bindParam(':priority', $priority);
        $count->execute();
        $count = $count->rowCount();
        if($number == 'max') {
            $number = $count;
        }
        $query = $dbConnect->prepare("SELECT note, createDate, createdBy, priority, subject, id FROM $this->notesTable
                                     WHERE patientId = :patientId AND priority = :priority LIMIT {$start}, {$number}");
        $query->bindParam('patientId', $patientId);
        $query->bindParam('priority', $priority);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    
    /**
     *Get a specific progress note.
     *@param $noteId The unique id of the note.
     */
    function getNotesByNoteId($noteId)
    {
        
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("SELECT * FROM $this->notesTable
                                     WHERE id = :noteId");
        $query->bindParam(':noteId', $noteId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }
    
    function deleteNote($noteId)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("DELETE FROM $this->notesTable
                                     WHERE id = :noteId");
        $query->bindParam(':noteId', $noteId);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result; 
    }
    
    /**
     *Update a progress note in database.
     *@param $noteId The id of the note we are updating
     *@param $newNote The new note
     */
    function updateNote($noteId, $newNote)
    {
        $dbConnect = $this->getConnection();
        $query = $dbConnect->prepare("UPDATE $this->notesTable SET note = :note WHERE id = :id");
        $query->bindParam(':note', $newNote);
        $query->bindParam(':id', $noteId);
        $result = $query->execute();
        return $result;
    }
    
}
?>
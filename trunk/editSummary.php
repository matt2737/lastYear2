<?php
include_once('Gatherer.php');
session_start();
ob_start();


$SID = $_SESSION['id'];
$gatherer = new Gatherer();
if(isset($_SESSION['userId'])){
    $SID = $_SESSION['userId'];
}

if( isset($_POST['allergies']) || isset($_POST['inactiveDiagnose']) || isset($_POST['activeDiagnose']) || isset($_POST['familyHis'])){
    $allergies = $_POST['allergies'];
    $inactiveDiagnose = $_POST['inactiveDiagnose'];
    $activeDiagnose = $_POST['activeDiagnose'];
    $familyHis = $_POST['familyHis'];
    
    $medInfo = array(
        "id" => $SID,
        "allergies" => $allergies,
        "inactiveDiagnose" => $inactiveDiagnose,
        "activeDiagnose" => $activeDiagnose,
        "familyHis" => $familyHis
    );
    
    $result = $gatherer->updateMedicalInfo($medInfo);
    echo $result;
}
elseif( isset($_POST['insCompany']) || isset($_POST['insCompanyAddress']) || isset($_POST['groupNumber']) || isset($_POST['policyNumber']) || isset($_POST['contact']) || isset($_POST['contactNumber'])){
    $insCompany = $_POST['insCompany'];
    $insCompanyAddress = $_POST['insCompanyAddress'];
    $groupNumber = $_POST['groupNumber'];
    $policyNumber = $_POST['policyNumber'];
    $contact = $_POST['contact'];
    $contactNumber = $_POST['contactNumber'];
    
    $insInfo = array(
        "id" => $SID,
        "insCompany" => $insCompany,
        "insCompanyAddress" => $insCompanyAddress,
        "groupNumber" => $groupNumber,
        "policyNumber" => $policyNumber,
        "contact" => $contact,
        "contactNumber" => $contactNumber
    );
    
    $result = $gatherer->updateInsuranceInfo($insInfo);
    echo $result;
}
elseif( isset($_POST['emergencyName']) || isset($_POST['emergencyPhone']) || isset($_POST['emergencyRelation'])){
    $emergencyName = $_POST['emergencyName'];
    $emergencyPhone = $_POST['emergencyPhone'];
    $emergencyRelation = $_POST['emergencyRelation'];
    
    $emergencyInfo = array(
        "id" => $SID,
        "emergencyName" => $emergencyName,
        "emergencyPhone" => $emergencyPhone,
        "emergencyRelation" => $emergencyRelation
    );
    
    $result = $gatherer->updateEmergencyInfo($emergencyInfo);
    echo $result;
}

elseif( isset($_POST['emergencyName']) || isset($_POST['emergencyPhone']) || isset($_POST['emergencyRelation'])){
    $emergencyName = $_POST['emergencyName'];
    $emergencyPhone = $_POST['emergencyPhone'];
    $emergencyRelation = $_POST['emergencyRelation'];
    
    $emergencyInfo = array(
        "id" => $SID,
        "emergencyName" => $emergencyName,
        "emergencyPhone" => $emergencyPhone,
        "emergencyRelation" => $emergencyRelation
    );
    
    $result = $gatherer->updateEmergencyInfo($emergencyInfo);
    echo $result;
}

elseif(isset($_POST['picture'])){
    $picture = $_POST['picture'];
    
    $result = $gatherer->updatePicture($SID, $picture);
    echo $result;
}



?>
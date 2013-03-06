
function saveMedInfo()
{
    var activeDiagnose = $("#activeDiagnoseText").val();
    var inactiveDiagnose = $("#inactiveDiagnoseText").val();
    var allergies = $("#allergiesText").val();
    var familyHis = $("#familyHisText").val();
    $("#activeDiagnose").html(activeDiagnose);
    $("#inactiveDiagnose").html(inactiveDiagnose);
    $("#allergies").html(allergies);
    $("#familyHis").html(familyHis);
    $.post('editSummary.php', {activeDiagnose: activeDiagnose, inactiveDiagnose: inactiveDiagnose, allergies: allergies, familyHis: familyHis}, function(data) {
            $("#medSaveButton").html("");
            $("#editMed").bind('click', editMed);
            
        });
    
    
}

function editMed()
{
    var activeDiagnose = $("#activeDiagnose").html();
    activeDiagnose = $.trim(activeDiagnose);
    $("#activeDiagnose").html("<input type=\"text\" id=\"activeDiagnoseText\" value=\"" + activeDiagnose + "\">");
    
    var inactiveDiagnose = $("#inactiveDiagnose").html();
    inactiveDiagnose = $.trim(inactiveDiagnose);
    $("#inactiveDiagnose").html("<input type=\"text\" id=\"inactiveDiagnoseText\" value=\"" + inactiveDiagnose + "\">");
    
    var allergies = $("#allergies").html();
    allergies = $.trim(allergies);
    $("#allergies").html("<input type=\"text\" id=\"allergiesText\" value=\"" + allergies + "\">");
    
    var familyHis = $("#familyHis").html();
    familyHis = $.trim(familyHis);
    $("#familyHis").html("<input type=\"text\" id=\"familyHisText\" value=\"" + familyHis + "\">");
    
    $("#editMed").unbind();
    $("#medSaveButton").html("<button class=\"btn btn-danger\" type=\"button\" id=\"saveMed\">Save</button>");
    $("#saveMed").bind("click", saveMedInfo);
}


function saveInsInfo()
{
    var insCompany = $("#insCompanyText").val();
    var insCompanyAd = $("#insCompanyAdText").val();
    var groupNumber = $("#groupNumberText").val();
    var policyNumber = $("#policyNumberText").val();
    var contact = $("#contactText").val();
    var contactNumber = $("#contactNumberText").val();
    
    $("#insCompany").html(insCompany);
    $("#insCompanyAd").html(insCompanyAd);
    $("#groupNumber").html(groupNumber);
    $("#policyNumber").html(policyNumber);
    $("#contact").html(contact);
    $("#contactNumber").html(contactNumber);
    
    $.post('editSummary.php', {insCompany: insCompany, insCompanyAddress: insCompanyAd, groupNumber: groupNumber, policyNumber: policyNumber, contact: contact, contactNumber: contactNumber}, function(data) {
            $("#insSaveButton").html("");
            $("#editIns").bind('click', editIns);
            
        });
    
    
}

function editIns()
{
    var insCompany = $("#insCompany").html();
    insCompany = $.trim(insCompany);
    $("#insCompany").html("<input type=\"text\" id=\"insCompanyText\" value=\"" + insCompany + "\">");
    
    var insCompanyAd = $("#insCompanyAd").html();
    insCompanyAd = $.trim(insCompanyAd);
    $("#insCompanyAd").html("<input type=\"text\" id=\"insCompanyAdText\" value=\"" + insCompanyAd + "\">");
    
    var groupNumber = $("#groupNumber").html();
    groupNumber = $.trim(groupNumber);
    $("#groupNumber").html("<input type=\"text\" id=\"groupNumberText\" value=\"" + groupNumber + "\">");
    
    var policyNumber = $("#policyNumber").html();
    policyNumber= $.trim(policyNumber);
    $("#policyNumber").html("<input type=\"text\" id=\"policyNumberText\" value=\"" + policyNumber + "\">");
    
    var contact = $("#contact").html();
    contact = $.trim(contact);
    $("#contact").html("<input type=\"text\" id=\"contactText\" value=\"" + contact + "\">");
    
    var contactNumber = $("#contactNumber").html();
    contactNumber= $.trim(contactNumber);
    $("#contactNumber").html("<input type=\"text\" id=\"contactNumberText\" value=\"" + contactNumber + "\">");
    
    $("#editIns").unbind();
    $("#insSaveButton").html("<button class=\"btn btn-danger\" type=\"button\" id=\"saveIns\">Save</button>");
    $("#saveIns").bind("click", saveInsInfo);
}

function saveEmergencyInfo()
{
    var emergencyName = $("#emergencyNameText").val();
    var emergencyPhone = $("#emergencyPhoneText").val();
    var emergencyRelation = $("#emergencyRelationText").val();
    $("#emergencyName").html(emergencyName);
    $("#emergencyPhone").html(emergencyPhone);
    $("#emergencyRelation").html(emergencyRelation);
    $.post('editSummary.php', {emergencyName: emergencyName, emergencyPhone: emergencyPhone, emergencyRelation: emergencyRelation}, function(data) {
            $("#emergencySaveButton").html("");
            $("#editEmergency").bind('click', editEmergency);
            
        });
    
    
}

function editEmergency()
{
    var emergencyName = $("#emergencyName").html();
    emergencyName = $.trim(emergencyName);
    $("#emergencyName").html("<input type=\"text\" id=\"emergencyNameText\" value=\"" + emergencyName + "\">");
    
    var emergencyPhone = $("#emergencyPhone").html();
    emergencyPhone = $.trim(emergencyPhone);
    $("#emergencyPhone").html("<input type=\"text\" id=\"emergencyPhoneText\" value=\"" + emergencyPhone + "\">");
    
    var emergencyRelation = $("#emergencyRelation").html();
    emergencyRelation = $.trim(emergencyRelation);
    $("#emergencyRelation").html("<input type=\"text\" id=\"emergencyRelationText\" value=\"" + emergencyRelation + "\">");
    
    $("#editEmergency").unbind();
    $("#emergencySaveButton").html("<button class=\"btn btn-danger\" type=\"button\" id=\"saveEmergency\">Save</button>");
    $("#saveEmergency").bind("click", saveEmergencyInfo);
}

function savePicture()
{
    var picture = $("#pictureText").val();
    $.post('editSummary.php', {picture: picture}, function(data) {
            $("#pictureEdit").html("");
            $("#picture").attr("src", picture);
            $("#editPicture").bind('click', editPicture);
            
        });
}

function editPicture()
{
    var pictureURL = $("#picture").attr("src");
    $("#pictureEdit").html("<input type=\"text\" id=\"pictureText\" value=\"" + pictureURL + "\"> <button class=\"btn btn-danger\" type=\"button\" id=\"savePicture\">Save</button>");
    $("#editPicture").unbind();
    $("#savePicture").bind("click", savePicture);
     
}

function load()
{
    $("#editMed").bind('click', editMed);
    $("#editIns").bind('click', editIns);
    $("#editEmergency").bind('click', editEmergency);
    $("#editPicture").bind('click', editPicture);
}
window.onload=load;
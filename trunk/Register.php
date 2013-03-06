<?php
session_start();
include_once("Gatherer.php");
include_once("Checker.php");

//Error flag for password and repassword not matching
$passwordsMatch = true;
//SSN Format Error
$ssnFormatted = true;
//gender
$gender = $_POST['gender'];
    
if(isset($_POST['check']))
{
    //Gatherer module to handle user data
    $gatherer = new Gatherer();
    //Checker module to check input
    $checker = new Checker();
    //General error flag
    $isError = false;
    //array to hold errors
    $errors = array();
    //register user a doctor
    $isDoctor = false;
    
    if(isset($_POST['doctor']))
    {
        $isDoctor = true;
    }
    if(!empty($_POST['fname']))
    {
        $firstName = $_POST['fname'];
    }
    else
    {
        $isError = true;
        $errors[] = "First name is empty.";
    }
    if(!empty($_POST['lname']))
    {
        $lastName = $_POST['lname'];
    }
    else
    {
        $isError = true;
        $errors[] = "Last name is empty.";
    }
    if(!empty($_POST['year']))
    {
        if($checker->checkYear($_POST['year']))
        {
            $year = $_POST['year'];
        }
        else
        {
           $isError = true;
           $errors[] = "Year of birth out of range.";
        }
    }
    else
    {
        $isError = true;
        $errors[] = "Year of birth was blank.";
    }
    if(!empty($_POST['month']))
    {
        $month = $_POST['month'];
    }
    else
    {
        $isError = true;
        $errors[] = "Month of birth was blank.";
    }
    if(!empty($_POST['day']))
    {
        $day = $_POST['day'];
    }
    else
    {
        $isError = true;
        $errors[] = "Day of birth was blank.";
    }
    if(!empty($_POST['address1']))
    {
        $address = $_POST['address1'];
    }
    else
    {
        $isError = true;
        $errors[] = "Address is empty.";
    }
    if(!empty($_POST['month']) && !empty($_POST['day']) && !empty($_POST['year']))
    {   
        if($checker->checkYear($year))
        {
            if(checkdate($_POST['month'], $_POST['day'], $_POST['year']))
            {
                $dob = date("m/d/Y", mktime(0,0,0,$_POST['month'],$_POST['day'],$_POST['year']));
            }
            else
            {
                $isError = true;
                $errors[] = "Date of Birth is not a valid date.";
            }
        }
        else
        {
            $isError = true;
            $errors[] = "Valid year not entered.";
        }
    }
    if(!empty($_POST['ssn']))
    {
        $ssn = $_POST['ssn'];
        $ssnFormatted = $checker->checkSSN($ssn);

        if(!$ssnFormatted)
        {
            $isError = true;
            $errors[] = "Social Security Number is incorrectly formatted.";
        }
        else
        {
            $ssn = $ssnFormatted;
        }
    }
    else
    {
        $errors[] = "Social Security Number is empty.";
        $isError = true;
    }
    if(!empty($_POST['city']))
    {
        $city = $_POST['city'];
    }
    else
    {
        $isError = true;
        $errors[] = "City was not selected.";
    }
    if(!empty($_POST['state']))
    {
        $state = $_POST['state'];
    }
    else
    {
        $isError = true;
        $errors[] = "No State was selected.";
    }
    if(!empty($_POST['zip']))
    {
        $zip = $_POST['zip'];
        if(!$checker->checkZIP($_POST['zip']))
        {
            $isError = true;
            $errors[] = "ZIP incorrectly formatted.";
        }
    }
    else
    {
        $isError = true;
        $errors[] = "ZIP was empty.";
    }
    if(!empty($_POST['username']))
    {
        $username = $_POST['username'];
        
        if($gatherer->doesUsernameExist($username))
        {
            $isError = true;
            $errors[] = "Username already exists.";
        }
    }
    else
    {
        $isError = true;
        $errors[] = "Username is empty.";
    }
    if(!empty($_POST['email']))
    {
        $email = $_POST['email'];
        if(!$checker->checkEmail($_POST['email']))
        {
            $isError = true;
            $errors[] = "Email was incorrectly formatted.";
        }
    }
    else
    {
        $isError = true;
        $errors[] = "E-mail is empty.";
    }
    if(!empty($_POST['password']))
    {
        $password = $_POST['password'];
    }
    else
    {
        $isError = true;
        $errors[] = "Password is empty.";
    }
    if(!empty($_POST['repassword']))
    {
        $repassword = $_POST['repassword'];
        
        if($repassword != $password)
        {
            $isError = true;
            $errors[] = "Passwords do not match.";
        }
    }
    else
    {
        $isError = true;
        $errors[] = "Re-typed password is empty.";
    }
    if(!empty($_POST['insurance']))
    {
        $insurance = $_POST['insurance'];
    }
    if(!empty($_POST['company']))
    {
        $company = $_POST['company'];
    }
    if(!empty($_POST['group']))
    {
        $group = $_POST['group'];
    }
    if(!empty($_POST['policy']))
    {
        $policy = $_POST['policy'];
    }
    if(!empty($_POST['contact']))
    {
        $contact = $_POST['contact'];
    }
    if(!empty($_POST['contactnum']))
    {
        if($checker->checkPhoneNum($_POST['contactnum']))
        {
            $contactnum = $checker->checkPhoneNum($_POST['contactnum']);
        }
        else
        {
            $isError = true;
            $errors[] = "Contact number formatted incorrectly.";
        }
    }
    if(!$isError)
    {
            if($isDoctor)
            {
                $result = $gatherer->addUser($firstName, $lastName, $dob, $address, $city, $state, $zip, $ssn, $username, $password, 2, $email, NULL, $gender);
                $demoArray = array(
                    "id" => $result
                );
                $demographicResult = $gatherer->addDemographics($demoArray);
                $_SESSION['id'] = $result;
                header('Location: summary.php');
            }
            else
            {
                $result = $gatherer->addUser($firstName, $lastName, $dob, $address, $city, $state, $zip, $ssn, $username, $password, 1, $email, NULL, $gender);
                $patientResult = $gatherer->addPatient($result,null,null,null,null,$insurance,$company,$group,$policy,$contact,$contactnum);
                $demoArray = array(
                    "id" => $result
                );
                $demographicResult = $gatherer->addDemographics($demoArray);
                $_SESSION['id'] = $result;
                header('Location: summary.php');
            }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <LINK REL=StyleSheet HREF="css/bootstrap.min.css" TYPE="text/css">
        <LINK REL=StyleSheet HREF="css/site.css" TYPE="text/css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="navbar">
                <div class="navbar-inner">
                    <a class="brand" href="#">NuVista</a>
                    <ul class="nav">
                        <li><a href="Login.php">Health Summary</a></li>
                        <li><a href="Login.php">Demographics</a></li>
                        <li><a href="Login.php">Progress Notes</a></li>
                    </ul>
                </div>
            </div>
            <div class="row-fluid">
                <h1>Patient Registration</h1>
                <form action="Register.php" method="post">
                    <div class="span7">
                        <h3>User Information</h3>
                       <br>
                            <fieldset>
                                <?php if(!isset($_POST['fname']) || empty($_POST['fname'])): ?>
                                <input type="text" placeholder="First Name" name = "fname">
                                <?php else: ?>
                                <input type="text" placeholder="First Name" name="fname" value="<?php echo htmlentities($_POST['fname']) ?>" />
                                <?php endif; ?>
                                
                                <?php if(!isset($_POST['lname']) || empty($_POST['lname'])): ?>
                                <input type="text" placeholder="Last Name" name = "lname">
                                <?php else: ?>
                                <input type="text" placeholder="Last Name" name="lname" value="<?php echo htmlentities($_POST['lname']) ?>" />
                                <?php endif; ?>
                                
                                <?php if(!isset($_POST['ssn']) || empty($_POST['ssn']) || !$checker->checkSSN($_POST['ssn'])): ?>
                                <input type="text" placeholder="Social Security Number" name = "ssn"><br>
                                <?php else: ?>
                                <input type="text" placeholder="Social Security Number" name="ssn" value="<?php echo htmlentities($_POST['ssn']) ?>" /><br>
                                <?php endif; ?>
                                
                                <select name="month">
                                <option value="">Month</option>
                                <option value="1"<?php if (!empty($month) && $month == '1') echo ' selected="selected"'; ?>>January</option>
                                <option value="2"<?php if (!empty($month) && $month == '2') echo ' selected="selected"'; ?>>February</option>
                                <option value="3"<?php if (!empty($month) && $month == '3') echo ' selected="selected"'; ?>>March</option>
                                <option value="4"<?php if (!empty($month) && $month == '4') echo ' selected="selected"'; ?>>April</option>
                                <option value="5"<?php if (!empty($month) && $month == '5') echo ' selected="selected"'; ?>>May</option>
                                <option value="6"<?php if (!empty($month) && $month == '6') echo ' selected="selected"'; ?>>June</option>
                                <option value="7"<?php if (!empty($month) && $month == '7') echo ' selected="selected"'; ?>>July</option>
                                <option value="8"<?php if (!empty($month) && $month == '8') echo ' selected="selected"'; ?>>August</option>
                                <option value="9"<?php if (!empty($month) && $month == '9') echo ' selected="selected"'; ?>>September</option>
                                <option value="10"<?php if (!empty($month) && $month == '10') echo ' selected="selected"'; ?>>October</option>
                                <option value="11"<?php if (!empty($month) && $month == '11') echo ' selected="selected"'; ?>>November</option>
                                <option value="12"<?php if (!empty($month) && $month == '12') echo ' selected="selected"'; ?>>December</option>
                                </select>
                                <select name="day" id="day">
                                <option value="">Day</option>
                                <option value="1"<?php if (!empty($day) && $day == '1') echo ' selected="selected"'; ?>>1</option>
                                <option value="2"<?php if (!empty($day) && $day == '2') echo ' selected="selected"'; ?>>2</option>
                                <option value="3"<?php if (!empty($day) && $day == '3') echo ' selected="selected"'; ?>>3</option>
                                <option value="4"<?php if (!empty($day) && $day == '4') echo ' selected="selected"'; ?>>4</option>
                                <option value="5"<?php if (!empty($day) && $day == '5') echo ' selected="selected"'; ?>>5</option>
                                <option value="6"<?php if (!empty($day) && $day == '6') echo ' selected="selected"'; ?>>6</option>
                                <option value="7"<?php if (!empty($day) && $day == '7') echo ' selected="selected"'; ?>>7</option>
                                <option value="8"<?php if (!empty($day) && $day == '8') echo ' selected="selected"'; ?>>8</option>
                                <option value="9"<?php if (!empty($day) && $day == '9') echo ' selected="selected"'; ?>>9</option>
                                <option value="10"<?php if (!empty($day) && $day == '10') echo ' selected="selected"'; ?>>10</option>
                                <option value="11"<?php if (!empty($day) && $day == '11') echo ' selected="selected"'; ?>>11</option>
                                <option value="12"<?php if (!empty($day) && $day == '12') echo ' selected="selected"'; ?>>12</option>
                                <option value="13"<?php if (!empty($day) && $day == '13') echo ' selected="selected"'; ?>>13</option>
                                <option value="14"<?php if (!empty($day) && $day == '14') echo ' selected="selected"'; ?>>14</option>
                                <option value="15"<?php if (!empty($day) && $day == '15') echo ' selected="selected"'; ?>>15</option>
                                <option value="16"<?php if (!empty($day) && $day == '16') echo ' selected="selected"'; ?>>16</option>
                                <option value="17"<?php if (!empty($day) && $day == '17') echo ' selected="selected"'; ?>>17</option>
                                <option value="18"<?php if (!empty($day) && $day == '18') echo ' selected="selected"'; ?>>18</option>
                                <option value="19"<?php if (!empty($day) && $day == '19') echo ' selected="selected"'; ?>>19</option>
                                <option value="20"<?php if (!empty($day) && $day == '20') echo ' selected="selected"'; ?>>20</option>
                                <option value="21"<?php if (!empty($day) && $day == '21') echo ' selected="selected"'; ?>>21</option>
                                <option value="22"<?php if (!empty($day) && $day == '22') echo ' selected="selected"'; ?>>22</option>
                                <option value="23"<?php if (!empty($day) && $day == '23') echo ' selected="selected"'; ?>>23</option>
                                <option value="24"<?php if (!empty($day) && $day == '24') echo ' selected="selected"'; ?>>24</option>
                                <option value="25"<?php if (!empty($day) && $day == '25') echo ' selected="selected"'; ?>>25</option>
                                <option value="26"<?php if (!empty($day) && $day == '26') echo ' selected="selected"'; ?>>26</option>
                                <option value="27"<?php if (!empty($day) && $day == '27') echo ' selected="selected"'; ?>>27</option>
                                <option value="28"<?php if (!empty($day) && $day == '28') echo ' selected="selected"'; ?>>28</option>
                                <option value="29"<?php if (!empty($day) && $day == '29') echo ' selected="selected"'; ?>>29</option>
                                <option value="30"<?php if (!empty($day) && $day == '30') echo ' selected="selected"'; ?>>30</option>
                                <option value="31"<?php if (!empty($day) && $day == '31') echo ' selected="selected"'; ?>>31</option>
                                </select>
                                
                                <?php if(!isset($_POST['year']) || empty($_POST['year'])): ?>
                                <input type="text" placeholder="Year" name = "year"><br>
                                <?php elseif($checker->checkYear($year)): ?>
                                <input type="text" placeholder="Year" name="year" value="<?php echo htmlentities($_POST['year']) ?>" /><br>
                                <?php else : ?>
                                <input type="text" placeholder="Year" name = "year"><br>
                                <?php endif; ?>
                                
                                <?php if(!isset($_POST['address1']) || empty($_POST['address1'])): ?>
                                <input type="text" placeholder="Address" name = "address1">
                                <?php else: ?>
                                <input type="text" placeholder="Address" name="address1" value="<?php echo htmlentities($_POST['address1']) ?>" />
                                <?php endif; ?>
                                
                                <?php if(!isset($_POST['city']) || empty($_POST['city'])): ?>
                                <input type="text" placeholder="City" name = "city">
                                <?php else: ?>
                                <input type="text" placeholder="City" name="city" value="<?php echo htmlentities($_POST['city']) ?>" />
                                <?php endif; ?>
                                
                                <select name="state">
                                <option value="">State</option>
                                <option value="AL"<?php if (!empty($state) && $state == 'AL') echo ' selected="selected"'; ?>>Alabama</option>
                                <option value="AK"<?php if (!empty($state) && $state == 'AK') echo ' selected="selected"'; ?>>Alaska</option>
                                <option value="AZ"<?php if (!empty($state) && $state == 'AZ') echo ' selected="selected"'; ?>>Arizona</option>
                                <option value="AR"<?php if (!empty($state) && $state == 'AR') echo ' selected="selected"'; ?>>Arkansas</option>
                                <option value="CA"<?php if (!empty($state) && $state == 'CA') echo ' selected="selected"'; ?>>California</option>
                                <option value="CO"<?php if (!empty($state) && $state == 'CO') echo ' selected="selected"'; ?>>Colorado</option>
                                <option value="CT"<?php if (!empty($state) && $state == 'CT') echo ' selected="selected"'; ?>>Connecticut</option>
                                <option value="DE"<?php if (!empty($state) && $state == 'DE') echo ' selected="selected"'; ?>>Delaware</option>
                                <option value="DC"<?php if (!empty($state) && $state == 'DC') echo ' selected="selected"'; ?>>District of Columbia</option>
                                <option value="FL"<?php if (!empty($state) && $state == 'FL') echo ' selected="selected"'; ?>>Florida</option>
                                <option value="GA"<?php if (!empty($state) && $state == 'GA') echo ' selected="selected"'; ?>>Georgia</option>
                                <option value="HI"<?php if (!empty($state) && $state == 'HI') echo ' selected="selected"'; ?>>Hawaii</option>
                                <option value="ID"<?php if (!empty($state) && $state == 'ID') echo ' selected="selected"'; ?>>Idaho</option>
                                <option value="IL"<?php if (!empty($state) && $state == 'IL') echo ' selected="selected"'; ?>>Illinois</option>
                                <option value="IN"<?php if (!empty($state) && $state == 'IN') echo ' selected="selected"'; ?>>Indiana</option>
                                <option value="IA"<?php if (!empty($state) && $state == 'IA') echo ' selected="selected"'; ?>>Iowa</option>
                                <option value="KS"<?php if (!empty($state) && $state == 'KS') echo ' selected="selected"'; ?>>Kansas</option>
                                <option value="KY"<?php if (!empty($state) && $state == 'KY') echo ' selected="selected"'; ?>>Kentucky</option>
                                <option value="LA"<?php if (!empty($state) && $state == 'LA') echo ' selected="selected"'; ?>>Louisiana</option>
                                <option value="ME"<?php if (!empty($state) && $state == 'ME') echo ' selected="selected"'; ?>>Maine</option>
                                <option value="MD"<?php if (!empty($state) && $state == 'MD') echo ' selected="selected"'; ?>>Maryland</option>
                                <option value="MA"<?php if (!empty($state) && $state == 'MA') echo ' selected="selected"'; ?>>Massachusetts</option>
                                <option value="MI"<?php if (!empty($state) && $state == 'MI') echo ' selected="selected"'; ?>>Michigan</option>
                                <option value="MN"<?php if (!empty($state) && $state == 'MN') echo ' selected="selected"'; ?>>Minnesota</option>
                                <option value="MS"<?php if (!empty($state) && $state == 'MS') echo ' selected="selected"'; ?>>Mississippi</option>
                                <option value="MO"<?php if (!empty($state) && $state == 'MO') echo ' selected="selected"'; ?>>Missouri</option>
                                <option value="MT"<?php if (!empty($state) && $state == 'MT') echo ' selected="selected"'; ?>>Montana</option>
                                <option value="NE"<?php if (!empty($state) && $state == 'NE') echo ' selected="selected"'; ?>>Nebraska</option>
                                <option value="NV"<?php if (!empty($state) && $state == 'NV') echo ' selected="selected"'; ?>>Nevada</option>
                                <option value="NH"<?php if (!empty($state) && $state == 'NH') echo ' selected="selected"'; ?>>New Hampshire</option>
                                <option value="NJ"<?php if (!empty($state) && $state == 'NJ') echo ' selected="selected"'; ?>>New Jersey</option>
                                <option value="NM"<?php if (!empty($state) && $state == 'NM') echo ' selected="selected"'; ?>>New Mexico</option>
                                <option value="NY"<?php if (!empty($state) && $state == 'NY') echo ' selected="selected"'; ?>>New York</option>
                                <option value="NC"<?php if (!empty($state) && $state == 'NC') echo ' selected="selected"'; ?>>North Carolina</option>
                                <option value="ND"<?php if (!empty($state) && $state == 'ND') echo ' selected="selected"'; ?>>North Dakota</option>
                                <option value="OH"<?php if (!empty($state) && $state == 'OH') echo ' selected="selected"'; ?>>Ohio</option>
                                <option value="OK"<?php if (!empty($state) && $state == 'OK') echo ' selected="selected"'; ?>>Oklahoma</option>
                                <option value="OR"<?php if (!empty($state) && $state == 'OR') echo ' selected="selected"'; ?>>Oregon</option>
                                <option value="PA"<?php if (!empty($state) && $state == 'PA') echo ' selected="selected"'; ?>>Pennsylvania</option>
                                <option value="RI"<?php if (!empty($state) && $state == 'RI') echo ' selected="selected"'; ?>>Rhode Island</option>
                                <option value="SC"<?php if (!empty($state) && $state == 'SC') echo ' selected="selected"'; ?>>South Carolina</option>
                                <option value="SD"<?php if (!empty($state) && $state == 'SD') echo ' selected="selected"'; ?>>South Dakota</option>
                                <option value="TN"<?php if (!empty($state) && $state == 'TN') echo ' selected="selected"'; ?>>Tennessee</option>
                                <option value="TX"<?php if (!empty($state) && $state == 'TX') echo ' selected="selected"'; ?>>Texas</option>
                                <option value="UT"<?php if (!empty($state) && $state == 'UT') echo ' selected="selected"'; ?>>Utah</option>
                                <option value="VT"<?php if (!empty($state) && $state == 'VT') echo ' selected="selected"'; ?>>Vermont</option>
                                <option value="VA"<?php if (!empty($state) && $state == 'VA') echo ' selected="selected"'; ?>>Virginia</option>
                                <option value="WA"<?php if (!empty($state) && $state == 'WA') echo ' selected="selected"'; ?>>Washington</option>
                                <option value="WV"<?php if (!empty($state) && $state == 'WV') echo ' selected="selected"'; ?>>West Virginia</option>
                                <option value="WI"<?php if (!empty($state) && $state == 'WI') echo ' selected="selected"'; ?>>Wisconsin</option>
                                <option value="WY"<?php if (!empty($state) && $state == 'WY') echo ' selected="selected"'; ?>>Wyoming</option>
                                </select><br>
                                
                                <?php if(!isset($_POST['zip']) || empty($_POST['zip'])): ?>
                                <input type="text" placeholder="Zip Code" name = "zip">
                                <?php elseif($checker->checkZIP($_POST['zip'])): ?>
                                <input type="text" placeholder="Zip Code" name="zip" value="<?php echo htmlentities($_POST['zip']) ?>" />
                                <?php else: ?>
                                <input type="text" placeholder="Zip Code" name = "zip">
                                <?php endif; ?>
                                
                                
                                <?php if(!isset($_POST['username']) || empty($_POST['username'])): ?>
                                <input type="text" placeholder="Username" name = "username">
                                <?php elseif($gatherer->doesUsernameExist($_POST['username'])): ?>
                                <input type="text" placeholder="Username" name = "username">
                                <?php else: ?>
                                <input type="text" placeholder="Username" name="username" value="<?php echo htmlentities($_POST['username']) ?>" />
                                <?php endif; ?>
                                
                                <?php if(!isset($_POST['email']) || empty($_POST['email'])): ?>
                                <input type="text" placeholder="E-mail Address" name = "email"><br>
                                <?php elseif($checker->checkEmail($_POST['email'])): ?>
                                <input type="text" placeholder="E-mail Address" name="email" value="<?php echo htmlentities($_POST['email']) ?>" /><br>
                                <?php else: ?>
                                <input type="text" placeholder="E-mail Address" name = "email"><br>
                                <?php endif; ?>
                                
                                <input type="password" placeholder="Password" name="password">
                                
                                <input type="password" placeholder="Re-enter Password" name="repassword">
                                
                                <input type="checkbox" name="doctor"> Register as Doctor.
                                <br>
                                
                                <label class="radio">
                                    <input type="radio" checked="yes" name="gender" id="optionsRadios1" value="male">
                                    Male
                                </label>
                                <label class="radio">
                                    <input type="radio" name="gender" id="optionsRadios2" value="female">
                                    Female
                                </label>
                                <button type="submit" class="btn">Submit</button>
                    </div>
                    <div class="span4">
                        <h3>Insurance Information</h3>
                        <br>
                            <input type="text" placeholder="Insurance Company" name = "insurance"> <input type="text" placeholder="Insurance Company Address" name = "company"><br>
                            <input type="text" placeholder="Group #" name = "group"> <input type="text" placeholder="Policy #" name = "policy"><br>
                            <input type="text" placeholder="Contact" name = "contact"> <input type="text" placeholder="Contact Phone Number" name = "contactnum">
                            <input type="hidden" name="check" value="1">
                            </fieldset>
                            
                            <?php if($isError): ?>
                                <div class="alert alert-error">
                                        <?php foreach($errors as $value): ?>
                                        
                                       <ol><?= $value; ?> <br></ol>
                                        
                                        <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>
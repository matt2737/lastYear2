<?php
/*  @author: Cory Finch
 *  This module is used for checking the user's
 *  form input for correctness.
 */
 class Checker
 {
    /* @param: $year
     * Checks to see if the given year is in the correct range
     * @return: Returns the year, if in the correct ranger
     *          Returns false otherwise.
     */
    function checkYear($year)
    {
        $yearCorrect = false;
        
        if(preg_match('/^19[0-9]{2}$/', $year) || preg_match('/^20[0-9]{2}$/', $year))
           {
            $yearCorrect = $year;
           }
           return $yearCorrect;
    }
    
    /* @param: $ssn
     * Checks to see if the given social security number is
     * formatted correctly.
     * @return: Returns the social security number if it's formatted correctly,
     *          but with all '-' symbols removed
     *          Retuns false otherwise.
     */
    function checkSSN($ssn)
    {
        $ssnCorrect = false;
        
        if(preg_match('/^[0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9]$/', $ssn)
                      || preg_match('/^[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $ssn))
        {
            $ssnCorrect = str_replace("-", "", $ssn);
        }
        return $ssnCorrect;
    }
    
    /* @param: $num
     * Checks to see if the given phone number is
     * formatted correctly.
     * @return: Returns the phone number if it's formatted correctly,
     *          but with all '-', '(', and ')' symbols removed
     *          Returns false otherwise.
     */
    function checkPhoneNum($num)
    {
        $numCorrect = false;
        if($num)
        {
            $numCorrect = str_replace("-", "", $num);
            $numCorrect = str_replace("(", "", $numCorrect);
            $numCorrect = str_replace(")", "", $numCorrect);
            if(!preg_match('/^[0-9]{10}$/', $numCorrect))
            {
                $numCorrect = false;
            }
        }
        return $numCorrect;
    }
    
    /* @param: $zip
     * Checks the given zip code to see if it's in the correct format
     * i.e. Five digit
     * @return: Returns the zip code if it's formatted correctly.
     *          Returns false otherwise.
     */
    function checkZIP($zip)
    {
        $zipCorrect = false;
        
        if(preg_match('/^[0-9]{5}$/', $zip))
        {
            $zipCorrect = true;
        }
        return $zipCorrect;
    }
    
    /* @param: Checks the given email address to see if it's in the correct
     * format. i.e. example12@site.com
     * @return: Returns the email address if it's formatted correctly.
     *          Returns false otherwise.
     */
    function checkEmail($email)
    {
        $emailCorrect = false;
        
        if(preg_match('/^[0-9a-zA-Z]*@[a-zA-Z0-9]*.com$/', $email))
        {
            $emailCorrect = true;
        }
        return $emailCorrect;
    }
 }
?>
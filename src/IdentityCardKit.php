<?php
/**
*  National identity card helper class
*
*  Methods to help work with Mauritius national identity card number
*
*  @author aliirfaan
*/

namespace Aliirfaan\IdentityKit;

class IdentityCardKit
{
    /**
     * Validates NIC number without spaces against format using regex
     *
     * Your input should have no spaces and preferably be uppercased using strtoupper()
     * Note that this only checks for the format and does not guarantee a valid NIC number
     * After checking the format using this function, you can then use the isValidNicNumber() function
     *
     * Starts with letter
     * Followed by 12 digits
     * Last character can be a digit or number
     * Regex is case insensitive
     *
     * @param string $nicNumber NIC number without any spaces
     * @return bool
     */
    public function isValidNicNumberFormat($nicNumber)
    {
        $regex = '/^[a-zA-Z][0-9]{12}([a-zA-Z]|[0-9])$/';
        return preg_match($regex, $nicNumber);
    }

    /**
     * Validates NIC number without spaces against a checksum
     *
     * The first character of the surname, the date of birth, the CSO number and folio number are concatenated to give a sequence of 13 characters
     * We use a weight that decreases from 14 to 1 towards the right
     * The 13 characters are multiplied by their corresponding weights, the first character being multiplied by the maximum weight.
     * The result is added to calculate the difference between 17 and the remainder using modulus 17
     * Based on the difference, we get a checksum
     * This checksum should be the same as the last character/digit in the NIC number
     *
     * @param string $nicNumber NIC number without any spaces
     * @return bool
     */
    public function isValidNicNumber($nicNumber)
    {
        $nicNumber = strtoupper($nicNumber);

        $nicPieces = str_split($nicNumber);
        $lastPiece = array_pop($nicPieces);
        $checkSum = '#';

        $total = 0;
        for ($i=0, $j=14; $i<13; $i++, $j--) {
            if ($i == 0) {
                $total = $total + ((ord($nicPieces[$i]) - 55) * $j);
            } else {
                $total = $total + ($nicPieces[$i] * $j);
            }
        }
        
        $difference = 17 - ($total % 17);
        if ($difference == 17) {
            $checkSum = 0;
        } elseif ($difference > 0 && $difference < 10) {
            $checkSum = $difference;
        } else {
            $checkSum = chr($difference + 55); // convert to alpha character
        }
        
        return (strval($lastPiece) == strval($checkSum));
    }

    /**
     * Get date of birth from a valid NIC number in desired format
     *
     * Make sure we have a validated NIC number
     * 
     * We extract the date of birth part from the NIC number to get a date in dmy format
     * We then convert to desired format
     *
     * @param string $nicNumber Valid NIC number without any spaces
     * @return string date of birth in desired format
     */
    public function getDobFromValidNicNumber($nicNumber, $format = 'd-m-Y')
    {
        $dateFromNic = substr($nicNumber, 1, 6);
    
        $dateTime = \DateTime::createFromFormat('dmy', $dateFromNic);
        return $dateTime->format($format);
    }
}

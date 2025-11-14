<?php


namespace App\Helpers;

/**
 * luhnModN
 *
 * This class generates random checksummed strings to be used for unqiue link generation.  
 * The alphabet omits confusing characters (like l and 1)
 * and vowels to prevent accidental profanity/word generation.
 *
 * https://github.com/MattSurabian/luhn-mod-n/blob/master/luhnModN.php
 *
 * Usage:
 *       $length = 9;
 *       $a_z = 'BCDFGHJKMNPQRSTVWXYZ23456789';
 *       $lh = new LuhnHelper($length, $a_z);
 *       $uid = $lh->getLinkString();
 *       return $lh->validateChecksum($uid)
 *
 */
class LuhnHelper
{
    protected $alphaLength;
    protected $factor = 2;

    /*************************
     * User adjustable settings
     **************************/

    // alphabet used for code generation
    protected $alphabet = 'BCDFGHJKMNPQRSTVWXYZ23456789';
    // length of finished code, including checksum character
    protected $codeLength = 9;
    // number of characters used to calculate the checksum
    protected $checksumCalcChars = 8;

    /**
     * LuhnHelper constructor.
     *
     * @param int $codeLength
     * @param string $alphabet
     */
    public function __construct($codeLength, $alphabet)
    {
        $this->alphabet = $alphabet;
        $this->codeLength = $codeLength;
        $this->checksumCalcChars = $codeLength - 1;

        $this->alphaLength = mb_strlen($this->alphabet);
    }

    /**
     * Generate a string based on the constructor's codeLength and alphabet
     *
     * @return string
     */
    public function getLinkString()
    {
        return $this->generateString();
    }

    /**
     * Validate if the supplied $code passes the algorithm.
     *
     * @param $code
     * @return bool
     */
    public function validateChecksum($code)
    {
        // if the code isn't the right length, it's not valid
        if (!isset($code{
            $this->codeLength - 1})) {
            return false;
        }
        $checkSum = $this->generateCheckSum($this->removeChecksum($code));
        $checkCode = $this->attachChecksum($this->removeChecksum($code), $checkSum);
        if ($checkCode === $code) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    protected function generateString()
    {
        $code = "";
        // leave space for the checksum
        $length = $this->codeLength - 1;
        //checking the string key is faster than checking string length
        while (!isset($code{
            $length - 1})) {
            $code .= $this->alphabet[mt_rand(0, $this->alphaLength - 1)];
        }
        $code = $this->attachChecksum($code, $this->generateCheckSum($code));
        return $code;
    }

    /**
     * @param $code
     * @return mixed
     */
    protected function generateCheckSum($code)
    {
        $sum = 0;
        $codeLen = mb_strlen($code);
        $curFactor = $this->factor;
        for ($i = $codeLen - 1; $i >= ($codeLen - $this->checksumCalcChars); $i--) {
            $num = $i;
            $codePoint = strpos($this->alphabet, $code[$num]);
            $addend = $curFactor * $codePoint;
            //alternate the factor that each point is multiplied by
            $curFactor = ($curFactor == $this->factor) ? 1 : $this->factor;
            $addend = ($addend / $this->alphaLength) + ($addend % $this->alphaLength);
            $sum += $addend;
        }
        $remainder = $sum % $this->alphaLength;
        $checkCodePoint = ($this->alphaLength - $remainder) % $this->alphaLength;
        return $this->alphabet[$checkCodePoint];
    }

    /**
     * @param $code
     * @param $checksum
     * @return string
     */
    protected function attachChecksum($code, $checksum)
    {
        return $code . $checksum;
    }

    /**
     * @param $code
     * @return bool|string
     */
    protected function removeChecksum($code)
    {
        return substr($code, 0, -1);
    }
}

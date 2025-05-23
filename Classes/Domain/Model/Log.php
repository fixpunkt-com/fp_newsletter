<?php
namespace Fixpunkt\FpNewsletter\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Annotation as Extbase;

/***
 *
 * This file is part of the "Newsletter managment" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 Kurt Gusbeth <k.gusbeth@fixpunkt.com>, fixpunkt werbeagentur gmbh
 *
 ***/

/**
 * Log
 */
class Log extends AbstractEntity
{
    /**
     * Time stamp date
     *
     * @var \DateTime
     */
    protected $tstamp = NULL;

    /**
     * @var int
     */
    protected $sysLanguageUid = 0;

    /**
     * Anrede
     *
     * @var int
     */
    protected $gender = 0;

    /**
     * Title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Vorname
     *
     * @var string
     */
    protected $firstname = '';

    /**
     * Nachname
     *
     * @var string
     */
    protected $lastname = '';

    /**
     * E-Mail
     *
     * @var string
     */
    #[Extbase\Validate(['validator' => 'NotEmpty'])]
    #[Extbase\Validate(['validator' => 'EmailAddress'])]
    protected $email = '';

    /**
     * Adresse
     *
     * @var string
     */
    protected $address = '';

    /**
     * PLZ
     *
     * @var string
     */
    protected $zip = '';

    /**
     * Ort
     *
     * @var string
     */
    protected $city = '';

    /**
     * Region
     *
     * @var string
     */
    protected $region = '';

    /**
     * Land
     *
     * @var string
     */
    protected $country = '';

    /**
     * Telefon
     *
     * @var string
     */
    protected $phone = '';

    /**
     * Mobil-Telefon
     *
     * @var string
     */
    protected $mobile = '';

    /**
     * Telefax
     *
     * @var string
     */
    protected $fax = '';

    /**
     * WWW
     *
     * @var string
     */
    protected $www = '';

    /**
     * Position
     *
     * @var string
     */
    protected $position = '';

    /**
     * Firma
     *
     * @var string
     */
    protected $company = '';

    /**
     * Kategorien
     *
     * @var string
     */
    protected $categories = '';

    /**
     * Status
     *
     * @var int
     */
    protected $status = 0;

    /**
     * Hash
     *
     * @var string
     */
    protected $securityhash = '';

    /**
     * reCaptcha token
     *
     * @var string
     */
    protected $retoken = '';

    /**
     * Math. captcha
     *
     * @var string
     */
    protected $mathcaptcha = '';

    /**
     * Math. captcha no. 1
     *
     * @var int
     */
    protected $mathcaptcha1 = 0;

    /**
     * Math. captcha no. 2
     *
     * @var int
     */
    protected $mathcaptcha2 = 0;

    /**
     * Math. captcha operator
     *
     * @var bool
     */
    protected $mathcaptchaop = false;

    /**
     * Extras: Honeypot
     *
     * @var string
     */
    protected $extras = '';

    /**
     * GDPR checkbox
     *
     * @var bool
     */
    #[Extbase\Validate(['validator' => 'Boolean', 'options' => ['is' => true]])]
    protected $gdpr = false;

    /**
     * Newsletter Tabelle
     *
     * @var string
     */
    protected $nlTable = '';

    /**
     * Newsletter-Extension
     *
     * @var string
     */
    protected $nlExtension = '';

    /**
     * Newsletter-Kategorie/Gruppe-Tabelle
     *
     * @var string
     */
    protected $cgTable = '';

    /**
     * Externe Uid
     *
     * @var int
     */
    protected $exUid = 0;


    /**
     * Returns the tstamp
     *
     * @return \DateTime $tstamp
     */
    public function getTstamp()
    {
        return $this->tstamp;
    }

    /**
     * Sets the tstamp
     *
     * @param string $tstamp
     * @return void
     */
    public function setTstamp($tstamp): void
    {
        $this->tstamp = $tstamp;
    }

    /**
     * Set sys language
     *
     * @param int $sysLanguageUid
     */
    public function setSysLanguageUid($sysLanguageUid): void
    {
        $this->_languageUid = $sysLanguageUid;
    }

    /**
     * Get sys language
     *
     * @return int
     */
    public function getSysLanguageUid(): int
    {
        return $this->_languageUid;
    }

    /**
     * Returns the gender
     *
     * @return int $gender
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Sets the gender
     *
     * @param int $gender
     * @return void
     */
    public function setGender($gender): void
    {
        $this->gender = $gender;
    }

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
    	return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title): void
    {
    	$this->title = $title;
    }

    /**
     * Returns the firstname
     *
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Sets the firstname
     *
     * @param string $firstname
     * @return void
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * Returns the lastname
     *
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Sets the lastname
     *
     * @param string $lastname
     * @return void
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * Returns the email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Sets the email
     *
     * @param string $email
     * @return void
     */
    public function setEmail($email): void
    {
        $this->email = trim($email);
    }

    /**
     * Returns the address
     *
     * @return string $address
     */
    public function getAddress()
    {
    	return $this->address;
    }

    /**
     * Sets the address
     *
     * @param string $address
     * @return void
     */
    public function setAddress($address): void
    {
    	$this->address = $address;
    }

    /**
     * Returns the zip
     *
     * @return string $zip
     */
    public function getZip()
    {
    	return $this->zip;
    }

    /**
     * Sets the zip
     *
     * @param string $zip
     * @return void
     */
    public function setZip($zip): void
    {
    	$this->zip = $zip;
    }

    /**
     * Returns the city
     *
     * @return string $city
     */
    public function getCity()
    {
    	return $this->city;
    }

    /**
     * Sets the city
     *
     * @param string $city
     * @return void
     */
    public function setCity($city): void
    {
    	$this->city = $city;
    }

    /**
     * Returns the region
     *
     * @return string $region
     */
    public function getRegion()
    {
    	return $this->region;
    }

    /**
     * Sets the region
     *
     * @param string $region
     * @return void
     */
    public function setRegion($region): void
    {
    	$this->region = $region;
    }

    /**
     * Returns the country
     *
     * @return string $country
     */
    public function getCountry()
    {
    	return $this->country;
    }

    /**
     * Sets the country
     *
     * @param string $country
     * @return void
     */
    public function setCountry($country): void
    {
    	$this->country = $country;
    }

    /**
     * Returns the phone
     *
     * @return string $phone
     */
    public function getPhone()
    {
    	return $this->phone;
    }

    /**
     * Sets the phone
     *
     * @param string $phone
     * @return void
     */
    public function setPhone($phone): void
    {
    	$this->phone = $phone;
    }

    /**
     * Returns the mobile
     *
     * @return string $mobile
     */
    public function getMobile()
    {
    	return $this->mobile;
    }

    /**
     * Sets the mobile
     *
     * @param string $mobile
     * @return void
     */
    public function setMobile($mobile): void
    {
    	$this->mobile = $mobile;
    }

    /**
     * Returns the fax
     *
     * @return string $fax
     */
    public function getFax()
    {
    	return $this->fax;
    }

    /**
     * Sets the fax
     *
     * @param string $fax
     * @return void
     */
    public function setFax($fax): void
    {
    	$this->fax = $fax;
    }

    /**
     * Returns the www
     *
     * @return string $www
     */
    public function getWww()
    {
    	return $this->www;
    }

    /**
     * Sets the www
     *
     * @param string $www
     * @return void
     */
    public function setWww($www): void
    {
    	$this->www = $www;
    }

    /**
     * Returns the position
     *
     * @return string $position
     */
    public function getPosition()
    {
    	return $this->position;
    }

    /**
     * Sets the position
     *
     * @param string $position
     * @return void
     */
    public function setPosition($position): void
    {
    	$this->position = $position;
    }

    /**
     * Returns the company
     *
     * @return string $company
     */
    public function getCompany()
    {
    	return $this->company;
    }

    /**
     * Sets the company
     *
     * @param string $company
     * @return void
     */
    public function setCompany($company): void
    {
    	$this->company = $company;
    }

    /**
     * Returns the categories
     *
     * @return string $categories
     */
    public function getCategories()
    {
    	return $this->categories;
    }

    /**
     * Sets the categories
     *
     * @param string $categories
     * @return void
     */
    public function setCategories($categories): void
    {
    	$this->categories = $categories;
    }

    /**
     * Returns the status
     *
     * @return int $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Sets the status
     *
     * @param int $status
     * @return void
     */
    public function setStatus($status): void
    {
        $this->status = $status;
    }

    /**
     * Returns the securityhash
     *
     * @return string $securityhash
     */
    public function getSecurityhash()
    {
        return $this->securityhash;
    }

    /**
     * Sets the securityhash
     *
     * @param string $securityhash
     * @return void
     */
    public function setSecurityhash($securityhash): void
    {
        $this->securityhash = $securityhash;
    }

    /**
     * Returns the retoken
     *
     * @return string $retoken
     */
    public function getRetoken()
    {
    	return $this->retoken;
    }

    /**
     * Sets the retoken
     *
     * @param string $retoken
     * @return void
     */
    public function setRetoken($retoken): void
    {
    	$this->retoken = $retoken;
    }

    /**
     * Returns the mathcaptcha
     *
     * @return string $mathcaptcha
     */
    public function getMathcaptcha()
    {
    	return $this->mathcaptcha;
    }

    /**
     * Sets the mathcaptcha
     *
     * @param string $mathcaptcha
     * @return void
     */
    public function setMathcaptcha($mathcaptcha): void
    {
    	$this->mathcaptcha = $mathcaptcha;
    }

    /**
     * Returns the mathcaptcha1
     *
     * @return int $mathcaptcha1
     */
    public function getMathcaptcha1()
    {
    	return $this->mathcaptcha1;
    }

    /**
     * Sets the mathcaptcha1
     *
     * @param int $mathcaptcha1
     * @return void
     */
    public function setMathcaptcha1($mathcaptcha1): void
    {
    	$this->mathcaptcha1 = $mathcaptcha1;
    }

    /**
     * Returns the mathcaptcha2
     *
     * @return int $mathcaptcha2
     */
    public function getMathcaptcha2()
    {
    	return $this->mathcaptcha2;
    }

    /**
     * Sets the mathcaptcha2
     *
     * @param int $mathcaptcha2
     * @return void
     */
    public function setMathcaptcha2($mathcaptcha2): void
    {
    	$this->mathcaptcha2 = $mathcaptcha2;
    }

    /**
     * Returns the math. captcha operator
     *
     * @return bool $mathcaptchaop
     */
    public function getMathcaptchaop()
    {
    	return $this->mathcaptchaop;
    }

    /**
     * Sets the math. captcha operator
     *
     * @param bool $mathcaptchaop
     * @return void
     */
    public function setMathcaptchaop($mathcaptchaop): void
    {
    	$this->mathcaptchaop = $mathcaptchaop;
    }

    /**
     * Returns the boolean state of math. captcha operator
     *
     * @return bool
     */
    public function isMathcaptchaop()
    {
    	return $this->mathcaptchaop;
    }

    /**
     * Returns the extras
     *
     * @return string $extras
     */
    public function getExtras()
    {
    	return $this->extras;
    }

    /**
     * Sets the extras
     *
     * @param string $extras
     * @return void
     */
    public function setExtras($extras): void
    {
    	$this->extras = $extras;
    }

    /**
     * Returns the gdpr
     *
     * @return bool $gdpr
     */
    public function getGdpr()
    {
        return $this->gdpr;
    }

    /**
     * Sets the gdpr
     *
     * @param bool $gdpr
     * @return void
     */
    public function setGdpr($gdpr): void
    {
        $this->gdpr = $gdpr;
    }

    /**
     * Returns the boolean state of gdpr
     *
     * @return bool
     */
    public function isGdpr()
    {
        return $this->gdpr;
    }

    /**
     * Returns the nl-table
     */
    public function getNlTable()
    {
        return $this->nlTable;
    }

    /**
     * Sets the nl-table
     *
     * @param string $table
     */
    public function setNlTable($table): void
    {
        $this->nlTable = $table;
    }

    /**
     * Returns the nl-extension
     */
    public function getNlExtension(): string
    {
        return $this->nlExtension;
    }

    /**
     * Sets the nl-extension
     *
     * @param string $nlExtension
     */
    public function setNlExtension($nlExtension): void
    {
        $this->nlExtension = $nlExtension;
    }

    /**
     * Returns the cg-table
     */
    public function getCgTable(): string
    {
        return $this->cgTable;
    }

    /**
     * Sets the cg-table
     *
     * @param string $table
     */
    public function setCgTable($table): void
    {
        $this->cgTable = $table;
    }

    /**
     * Returns the external uid
     */
    public function getExUid(): int
    {
        return $this->exUid;
    }

    /**
     * Sets the external uid
     *
     * @param int $exUid
     */
    public function setExUid(int $exUid): void
    {
        $this->exUid = $exUid;
    }

}

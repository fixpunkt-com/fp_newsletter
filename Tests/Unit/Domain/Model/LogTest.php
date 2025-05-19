<?php
namespace Fixpunkt\FpNewsletter\Tests\Unit\Domain\Model;

use TYPO3\CMS\Core\Tests\UnitTestCase;
use Fixpunkt\FpNewsletter\Domain\Model\Log;
/**
 * Test case.
 *
 * @author Kurt Gusbeth <k.gusbeth@fixpunkt.com>
 */
class LogTest extends UnitTestCase
{
    /**
     * @var Log
     */
    protected $subject = null;

    protected function setUp()
    {
        $this->subject = new Log();
    }

    protected function tearDown()
    {
    }

    /**
     * @test
     */
    public function getGenderReturnsInitialValueForInt()
    {
    }

    /**
     * @test
     */
    public function setGenderForIntSetsGender()
    {
    }

    /**
     * @test
     */
    public function getTitleReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getTitle()
        );

    }

    /**
     * @test
     */
    public function setTitleForStringSetsTitle(): void
    {
        $this->subject->setTitle('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'title',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getFirstnameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getFirstname()
        );

    }

    /**
     * @test
     */
    public function setFirstnameForStringSetsFirstname(): void
    {
        $this->subject->setFirstname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'firstname',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getLastnameReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getLastname()
        );

    }

    /**
     * @test
     */
    public function setLastnameForStringSetsLastname(): void
    {
        $this->subject->setLastname('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'lastname',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getEmailReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getEmail()
        );

    }

    /**
     * @test
     */
    public function setEmailForStringSetsEmail(): void
    {
        $this->subject->setEmail('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'email',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getStatusReturnsInitialValueForInt()
    {
    }

    /**
     * @test
     */
    public function setStatusForIntSetsStatus()
    {
    }

    /**
     * @test
     */
    public function getSecurityhashReturnsInitialValueForString(): void
    {
        self::assertSame(
            '',
            $this->subject->getSecurityhash()
        );

    }

    /**
     * @test
     */
    public function setSecurityhashForStringSetsSecurityhash(): void
    {
        $this->subject->setSecurityhash('Conceived at T3CON10');

        self::assertAttributeEquals(
            'Conceived at T3CON10',
            'securityhash',
            $this->subject
        );

    }

    /**
     * @test
     */
    public function getGdprReturnsInitialValueForBool(): void
    {
        self::assertSame(
            false,
            $this->subject->getGdpr()
        );

    }

    /**
     * @test
     */
    public function setGdprForBoolSetsGdpr(): void
    {
        $this->subject->setGdpr(true);

        self::assertAttributeEquals(
            true,
            'gdpr',
            $this->subject
        );

    }
}

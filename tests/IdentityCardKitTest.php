<?php
/**
*  Test for National identity card helper class
*
*  @author aliirfaan
*/

namespace Aliirfaan\IdentityKit\Test;

use PHPUnit\Framework\TestCase;
use Aliirfaan\IdentityKit\IdentityCardKit;

class IdentityCardKitTest extends TestCase
{
    public function providerTestIsValidNicNumberFormat()
    {
        return array(
            array('N0411864630039', true),
            array('N041186463003c', true),
            array('n041186463003C', true),
            array('1041186463003C', false),
            array('N0411P6463003C', false),
            array('0411P6463', false),
            array('N04118646300394345', false),
        );
    }

    public function providerTestIsValidNicNumber()
    {
        return array(
            array('N0411864630039', false),
            array('N031186463003B', true),
        );
    }

    /**
     * @dataProvider providerTestIsValidNicNumberFormat
     */
    public function testIsValidNicNumberFormat($nicNumber, $expectedResult)
    {
        $identityCardKit = new IdentityCardKit();

        $result = $identityCardKit->isValidNicNumberFormat($nicNumber);
        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @dataProvider providerTestIsValidNicNumber
     */
    public function testIsValidNicNumber($nicNumber, $expectedResult)
    {
        $identityCardKit = new IdentityCardKit();

        $result = $identityCardKit->isValidNicNumber($nicNumber);
        $this->assertEquals($expectedResult, $result);
    }
}

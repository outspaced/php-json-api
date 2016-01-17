<?php
/**
 * Author: Nil Portugués Calderó <contact@nilportugues.com>
 * Date: 11/$error0/15
 * Time: 9:01 PM.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace NilPortugues\Tests\Api\JsonApi\Domain\Errors;

use NilPortugues\Api\JsonApi\Domain\Model\Errors\Error;
use NilPortugues\Api\JsonApi\Domain\Model\Errors\ErrorBag;

class ErrorBagTest extends \PHPUnit_Framework_TestCase
{
    public function testHttpCode()
    {
        $errorBag = new ErrorBag();
        $errorBag->setHttpCode(400);
        $this->assertEquals(400, $errorBag->httpCode());
    }

    public function testItHasKey()
    {
        $errorBag = new ErrorBag();
        $error = new Error('Error', 'Error Detail');
        $errorBag[] = $error;

        $this->assertTrue(empty($errorBag['a']));
        $this->assertFalse(empty($errorBag[0]));
        unset($errorBag[0]);
        $this->assertTrue(empty($errorBag[0]));
    }

    public function testItCanCount()
    {
        $error = new Error('Error', 'Error Detail');
        $errorBag = new ErrorBag([$error]);
        $this->assertEquals(1, count($errorBag));
    }

    public function testToArray()
    {
        $errorBag = new ErrorBag();
        $error = new Error('Error', 'Error Detail');
        $errorBag[] = $error;
        $this->assertEquals([$error], $errorBag->toArray());
    }

    public function testArrayIterator()
    {
        $error = new Error('Error', 'Error Detail');
        $errorBag = new ErrorBag([$error]);
        foreach ($errorBag as $value) {
            $this->assertEquals($error, $value);
        }
    }
}

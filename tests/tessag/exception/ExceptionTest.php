<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tests\tessag\exception;

use org\tessag\exception\ClassNotFoundException;
use org\tessag\exception\NotFoundException;
use org\tessag\exception\TessagException;
use org\tessag\exception\UnSupportException;
use SebastianBergmann\GlobalState\RuntimeException;

class ExceptionTest extends \PHPUnit_Framework_TestCase
{

    public function testException()
    {
        try {
            throw new ClassNotFoundException();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof ClassNotFoundException && $ex instanceof RuntimeException);
        }
        try {
            throw new NotFoundException();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof NotFoundException && $ex instanceof RuntimeException);
        }

        try {
            throw new UnSupportException();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof UnSupportException && $ex instanceof RuntimeException);
        }

        try {
            throw new TessagException();
        } catch (\Exception $ex) {
            $this->assertTrue($ex instanceof TessagException && $ex instanceof RuntimeException);
        }
    }

}

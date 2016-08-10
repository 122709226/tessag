<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tests\tessag\http\fpm;

use org\tessag\http\fpm\Cookie;

class CookieTest extends \PHPUnit_Framework_TestCase
{

    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new Cookie('foo', 'bar');
    }

    public function testCookie()
    {
        $this->assertEquals($this->instance->getName(), 'foo');

        $this->assertEquals($this->instance->getValue(), 'bar');
//        $this->assertEquals($this->instance->getName(), 'foo');
    }
}

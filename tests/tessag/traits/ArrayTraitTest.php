<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tests\tessag\traits;

use org\tessag\http\message\JSONMessage;

class ArrayTraitTest extends \PHPUnit_Framework_TestCase
{
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new JSONMessage(array(
            'foo' => 'bar'
        ));
    }

    public function testArray()
    {
        $this->instance[] = 'bar2';
        $this->assertTrue(count($this->instance->toArray()) == 2 && isset($this->instance[1]));

        $this->instance['foo'] = 'bar3';
        $this->assertTrue(count($this->instance->toArray()) == 2);
        $this->assertEquals($this->instance['foo'], 'bar3');

        try {
            $this->instance[3] = "bar4";
            $this->instance[] = "bar4";
            $this->assertTrue(false);
        } catch (\ErrorException $ex) {
            $this->assertTrue(true);
            unset($this->instance[3]);
        }
    }

}
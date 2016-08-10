<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace tests\tessag\routing\router;

use org\tessag\routing\router\RESTful;

class RESTfulTest extends \PHPUnit_Framework_TestCase
{
    private $instance;

    protected function setUp()
    {
        parent::setUp();
        $this->instance = new RESTful();
    }

}

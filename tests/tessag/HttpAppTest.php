<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace tests\tessag;

use org\tessag\HttpApp;
use org\tessag\routing\router\RESTful;

class HttpAppTest extends \PHPUnit_Framework_TestCase
{
    private $_http_app;

    protected function setUp()
    {
        $router = new RESTful();
        $this->_http_app = HttpApp::getInstance($router);
        $this->_http_app->setViewRoot(ROOT_DIR . '/tessag/testviews');
    }




}

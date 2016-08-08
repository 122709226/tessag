<?php
namespace controller;

use org\tessag\http\message\ViewMessage;

/**
 * Created by @panyao on 2016/7/18.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
class IndexController
{

    public function get()
    {
        $view = ViewMessage::bindViewName("test");
        $view->bindData("test", "xxx");
        return $view;
    }

}
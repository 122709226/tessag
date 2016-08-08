<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace controller\member;

use org\tessag\http\message\JSONMessage;

class LoginController {

    public function get(){

        return new JSONMessage(array("test" => 1));
    }

}
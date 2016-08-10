<?php
namespace controller;

use org\tessag\http\IRequest;
use org\tessag\http\message\JSONMessage;

/**
 * Created by @panyao on 2016/7/18.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
class JsonController
{

    public function get(IRequest $request)
    {

        $json = new JSONMessage(array(
            'test' => 1
        ));
        $json['test1'] = 2;
        $json['test'] = 2;
        $json[] = 3;
        $json['test'] = "pass";
        $json['test4'] = $request->getQueryParams();
        return $json;
    }

}
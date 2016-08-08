<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/11/3
 * Time: 10:24
 */
namespace org\tessag\context\routing\router;

use org\tessag\context\routing\IRouter;
use org\tessag\context\routing\RouterTrait;
use org\tessag\http\IRequest;

class JSONRPC implements IRouter
{
    use RouterTrait;

    public function getControllerClass(IRequest $request)
    {

    }

    public function getControllerMethod(IRequest $request)
    {
        // TODO: Implement getControllerMethod() method.
    }


}
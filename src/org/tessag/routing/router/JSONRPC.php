<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\routing\router;

use org\tessag\http\IRequest;
use org\tessag\routing\IRouter;
use org\tessag\routing\RouterTrait;

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
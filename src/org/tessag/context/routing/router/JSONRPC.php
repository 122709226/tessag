<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
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
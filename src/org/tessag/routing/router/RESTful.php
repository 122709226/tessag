<?php
/**
 * Created by @panyao on 2016/7/15.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\routing\router;

use org\tessag\exception\ExceptionCode;
use org\tessag\exception\UnSupportException;
use org\tessag\http\IRequest;
use org\tessag\routing\IRouter;
use org\tessag\routing\RouterTrait;

final class RESTful implements IRouter
{
    use RouterTrait;

    public function getControllerClass(IRequest $request)
    {
        $path = $request->getURI()->getPath();
        if ($path === '/') {
            $path = $this->_index_uri;
        }
        $path = pathinfo($this->_path . $path);
        return str_replace("/", "\\", $path['dirname'] . '\\' . ucfirst($path['filename'])) . $this->_postfix;
    }

    public function getControllerMethod(IRequest $request)
    {
        $method = strtolower($request->getMethod());
        if($override_method = $request->getQueryParameter("_method")){
            if (!in_array($override_method, array('put', 'delete'))) {
                throw new UnSupportException(sprintf("http method:%s 暂不支持", $override_method),
                    ExceptionCode::UN_SUPPORT_METHOD);
            }
            return $override_method;
        }
        if ($method === 'post') {
            if ($override_method = $request->getHeader('x-http-method-override')) {
                if (!in_array($override_method, array('put', 'delete'))) {
                    throw new UnSupportException(sprintf("http method:%s 暂不支持", $override_method),
                        ExceptionCode::UN_SUPPORT_METHOD);
                }
                return $override_method;
            }
            return 'post';
        }
        return 'get';
    }


}
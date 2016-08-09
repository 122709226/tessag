<?php
namespace org\tessag\context\routing;

#use org\tessag\webflow\routing\IRouter;

trait RouterTrait
{
    protected $_path = '\\controller';
    protected $_postfix = 'Controller';

    protected $_index_uri = '/index';

    public function bindNamespacePath($path)
    {
        $this->_path = strpos($path, '\\', 0) !== 0 ? '\\' . $path : $path;
    }

    public function bindControllerPostfix($postfix)
    {
        return $this->_postfix = $postfix;
    }

    public function bindIndexURI($uri)
    {
        $this->_index_uri = strpos($uri, '/', 0) !== 0 ? '/' . $uri : $uri;
    }
}
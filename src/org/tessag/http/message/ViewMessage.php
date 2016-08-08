<?php

/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\message;

use org\tessag\exception\NotFoundException;
use org\tessag\http\IResponseMessage;
use org\tessag\http\streams\ResourceStream;
use org\tessag\http\streams\StringStream;

class ViewMessage implements IResponseMessage
{
    private $_view_root_path;
    private $_path;
    private $_data = array();
    private static $_instance;
    private $_stream;

    private function __construct()
    {

    }

    public function getContentType()
    {
        return 'text/html';
    }

    public function toResponseBody()
    {
        if ($this->_stream != null) {
            return $this->_stream;
        }
        // 解析视图
        extract($this->_data);
        $level = ob_get_level();
        ob_start();
        try {
            require $this->_path;
        } catch (\Exception $ex) {
            while (ob_get_level() > $level) {
                ob_end_clean();
            }
            throw $ex;
        }
        $buffer = ob_get_contents();
        @ob_end_clean();
        return new StringStream($buffer, true, true, false);
    }


    public static function bindStaticHtml($view_name)
    {
        $instance = self::_getInstance();
        $path = $instance->_view_root_path . DIRECTORY_SEPARATOR . $view_name . ".html";
        if (!file_exists($path)) {
            throw new NotFoundException(sprintf("path:%s file not found.", $path));
        }
        $instance->_path = $path;
        $instance->_stream = new ResourceStream(fopen($path, 'r'), true, true, false);
        return $instance;
    }

    public static function bindViewName($view_name)
    {
        $instance = self::_getInstance();
        $path = $instance->_view_root_path . DIRECTORY_SEPARATOR . $view_name . ".php";
        if (!file_exists($path)) {
            throw new NotFoundException(sprintf("path:%s file not found.", $path));
        }
        $instance->_path = $path;
        return $instance;
    }

    public static function bindViewRoot($path)
    {
        self::_getInstance()->_view_root_path = $path;
    }

    public function bindData($key, $val)
    {
        $this->_data[$key] = $val;
        return $this;
    }

    private static function _getInstance()
    {
        if (self::$_instance === null) {
            self::$_instance = new ViewMessage();
        }
        return self::$_instance;
    }
}
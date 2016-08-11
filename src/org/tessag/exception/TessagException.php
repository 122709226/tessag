<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\exception;

use Exception;

class TessagException extends \RuntimeException implements IMessageThrowable
{
    private $_error_no = 0;
    private $_msg = 'success';

    public function __construct($message = "", $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getErrorNo()
    {
        return $this->_error_no;
    }

    public function getErrorMsg()
    {
        return $this->_msg;
    }

}
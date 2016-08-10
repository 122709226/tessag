<?php
/**
 * Created by @panyao on 2016/8/4.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\exception;

use Exception;

final class ClassNotFoundException extends \RuntimeException
{
    public function __construct($message = "", \Exception $previous = null)
    {
        parent::__construct($message, ExceptionCode::CLASS_NOT_FOUND, $previous);
    }

}
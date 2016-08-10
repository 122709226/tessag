<?php
/**
 * Created by @panyao on 2016/8/4.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\exception;

final class NotFoundException extends \RuntimeException
{
    public function __construct($message = "", \Exception $previous = null)
    {
        parent::__construct($message, ExceptionCode::NOT_FOUND, $previous);
    }
}
<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\message;

use org\tessag\http\IResponseMessage;
use org\tessag\http\streams\StringStream;
use org\tessag\traits\ArrayTrait;

class JSONMessage implements \ArrayAccess, \JsonSerializable, IResponseMessage
{
    use ArrayTrait;

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    public function jsonSerialize()
    {
        return json_encode($this->_data, JSON_UNESCAPED_UNICODE);
    }

    public function toResponseBody()
    {
        return new StringStream($this->jsonSerialize(), true, true, false);
    }

    public function getContentType()
    {
        return 'application/json';
    }

}
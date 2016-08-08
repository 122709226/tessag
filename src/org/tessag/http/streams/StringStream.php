<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\http\streams;


use Psr\Http\Message\StreamInterface;

class StringStream implements StreamInterface
{
    private $stream = '';
    private $seekable;
    private $readable;
    private $writable;

    public function __construct($stream, $seekable = false, $readable = false, $writable = false)
    {
        $this->stream = $stream;
        $this->seekable = $seekable;
        $this->readable = $readable;
        $this->writable = $writable;
    }

    public function __toString()
    {
        return $this->stream;
    }

    public function close()
    {
        $this->stream = null;
    }

    public function detach()
    {
        // TODO: Implement detach() method.
    }

    public function getSize()
    {
        // TODO: Implement getSize() method.
    }

    public function tell()
    {
        // TODO: Implement tell() method.
    }

    public function eof()
    {
        // TODO: Implement eof() method.
    }

    public function isSeekable()
    {
        // TODO: Implement isSeekable() method.
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }

    public function write($string)
    {
        // TODO: Implement write() method.
    }

    public function isReadable()
    {
        return $this->readable;
    }

    public function read($length)
    {
        // TODO: Implement read() method.
    }

    public function getContents()
    {
        return $this->stream;
    }

    public function getMetadata($key = null)
    {
        // TODO: Implement getMetadata() method.
    }

}
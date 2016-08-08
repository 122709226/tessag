<?php
namespace org\tessag\http\streams;

#use \Psr\Http\Message\StreamInterface;

trait StreamTrait
{
    protected $stream;
    protected $seekable;
    protected $readable;
    protected $writable;

    public function __construct($stream, $seekable = false, $readable = false, $writable = false)
    {
        $this->stream = $stream;
        $this->seekable = $seekable;
        $this->readable = $readable;
        $this->writable = $writable;
    }

    public function __destruct()
    {
        $this->close();
    }

    public function close()
    {
        fclose($this->stream);
    }

    public function getSize()
    {
        return 0;
    }

    public function tell()
    {
        return 0;
    }

    public function eof()
    {
        return true;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        return '';
    }

    public function write($string)
    {

    }
}

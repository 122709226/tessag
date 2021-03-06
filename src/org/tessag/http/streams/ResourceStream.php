<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\http\streams;

use org\tessag\exception\UnSupportException;
use Psr\Http\Message\StreamInterface;

final class ResourceStream implements StreamInterface
{
    private $stream;
    private $seekable;
    private $readable;
    private $writable;

    public function __construct($stream, $seekable = false, $readable = false, $writable = false)
    {
        if (!is_resource($stream)) {
            throw new UnSupportException("Input \$stream must be a resource!");
        }
        $this->stream = $stream;
        $this->seekable = $seekable;
        $this->readable = $readable;
        $this->writable = $writable;
    }

    public function __destruct()
    {
        $this->close();
    }

    public function __toString()
    {
        return $this->getContents();
    }


    public function close()
    {
        fclose($this->stream);
    }

    public function detach()
    {
        if ($this->stream === null) {
            return null;
        }
        $this->seekable = $this->readable = $this->writable = false;
        return $this->stream = null;
    }

    public function getSize()
    {
        return $this->stream === null ? 0 : fstat($this->stream)['size'];
    }

    public function tell()
    {
        $position = ftell($this->stream);
        if ($position === false) {
			throw new \RuntimeException("The stream failed to get position.");
        }
        return $position;
    }

    public function eof()
    {
        return $this->stream === null ? true : feof($this->stream);
    }

    public function isSeekable()
    {
        return $this->seekable;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        if (fseek($this->stream, $offset, $whence) === -1) {
			throw new \RuntimeException("The stream failed to set seek.");
        }
    }

    public function rewind()
    {
        $this->seek(0);
    }

    public function isWritable()
    {
        return $this->writable;
    }

    public function write($string)
    {
        if (!$this->isWritable()) {
            throw new \RuntimeException("The stream is not enable to write.");
        }
        $char_size = fwrite($this->stream, $string);
        if ($char_size === false) {
            throw new \RuntimeException("Write failure.");
        }
        return $char_size;
    }

    public function isReadable()
    {
        return $this->readable;
    }

    public function read($length)
    {
        if (!$this->isReadable()) {
            throw new \RuntimeException("The stream is not enable to read.");
        }
        $content = fread($this->stream, $length);
        if ($content === false) {
            throw new \RuntimeException("Read failure.");
        }
    }

    public function getContents()
    {
        if (!$this->isReadable()) {
            throw new \RuntimeException('The stream is not enable to read.');
        }
        $this->rewind();
        $content = stream_get_contents($this->stream);
        if ($content === false) {
            throw new \RuntimeException("The stream failed to get contents.");
        }
        return $content;
    }

    public function getMetadata($key = null)
    {
        $meta = stream_get_meta_data($this->stream);
        if ($key === null) {
            return $meta;
        }
        return isset($meta[$key]) ? $meta[$key] : "";
    }
}
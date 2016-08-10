<?php
/**
 * Created by @panyao on 2016/8/9.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\traits;


trait SingletonTrait
{
    private static $instance;

    static public function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self(func_get_args());
        }
        return self::$instance;
    }

    final private function __clone()
    {
    }

}
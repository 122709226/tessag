<?php
/**
 * Created by @panyao on 2016/8/5.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

namespace org\tessag\http;

interface IResponseMessage
{
    public function toResponseBody();

    public function getContentType();

//    public function sendRedirect($url);
}
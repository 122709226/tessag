<?php
/**
 * Created by @panyao on 2016/8/10.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */
namespace org\tessag\exception;

interface IMessageThrowable
{
    public function getErrorNo();

    public function getErrorMsg();
}
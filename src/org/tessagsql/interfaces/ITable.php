<?php
/**
 * Created by @panyao on 2016/8/8.
 * @author panyao
 * @coding.net https://coding.net/u/pandaxia
 */

interface ITable {

    public function getName();

    public function getFields();

    public function getField($name);

}
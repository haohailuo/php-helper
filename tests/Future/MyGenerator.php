<?php
/**
 * Copyright (c) 2020 kakuilan@163.com All rights reserved
 * User: kakuilan
 * Date: 2020/1/28
 * Time: 17:14
 * Desc:
 */

namespace Kph\Tests\Future;

use Generator;
use Kph\Helpers\StringHelper;

class MyGenerator {

    /**
     * 随机名称的生成器
     * @return Generator
     */
    public static function randName() {
        $name = StringHelper::randSimple(6);
        yield $name;
    }


    /**
     * 随机地址的生成器
     * @return Generator
     */
    public static function randAddr() {
        $addr = StringHelper::randString(16);
        yield $addr;
    }


    /**
     * 随机数字的生成器
     * @return Generator
     */
    public static function randNum() {
        $num = mt_rand(1, 9999);
        yield $num;
    }


    /**
     * 数字的生成器
     * @return Generator
     */
    public static function num() {
        for ($i = 1; $i <= 99; $i++) {
            //注意变量$i的值在不同的yield之间是保持传递的。
            yield $i;
        }
    }


    /**
     * @param int $a
     * @param int $b
     * @param mixed $callback
     */
    public static function asyncSum(int $a, int $b, $callback = null) {
        $total = $a + $b;
        if (!empty($callback) && is_callable($callback)) {
            $total = $callback($total);
        }

        return $total;
    }


    /**
     * @param int $a
     * @param int $b
     * @param callable $callback
     * @return mixed
     */
    public static function asyncSumNone(int $a, int $b, callable $callback) {
        return $callback();
    }


    /**
     * @param int $a
     * @param int $b
     * @param callable $callback
     * @return mixed
     */
    public static function asyncSumDoubly(int $a, int $b, callable $callback) {
        $total = $a + $b;
        return $callback($a, $b, $total);
    }


    /**
     * @param $a
     * @param $b
     * @param $c
     * @param $d
     */
    public static function asyncSumError($a, $b, $c, $d): void {
        return;
    }


    /**
     * @return Generator
     */
    public static function genZero2Ten() {
        for ($i = 1; $i <= 10; $i++) {
            yield $i;
        }
    }


    public function call1() {
        return mt_rand(1, 9);
    }


    public function call2($a, $b) {
        return intval($a) + intval($b);
    }


}
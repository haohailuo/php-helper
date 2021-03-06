<?php
/**
 * Copyright (c) 2020 LKK/lanq.net All rights reserved
 * User: kakuilan@163.com
 * Date: 2020/2/21
 * Time: 13:17
 * Desc:
 */

namespace Kph\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Error;
use Exception;
use Kph\Helpers\EncryptHelper;
use Kph\Helpers\StringHelper;


class EncryptHelperTest extends TestCase {


    public function testAuthcode() {
        $origin = 'hello world!';
        $key = '123456';

        $enres = EncryptHelper::authcode($origin, $key, true, 3600);
        $deres = EncryptHelper::authcode($enres[0], $key, false);
        $this->assertEquals($origin, $deres[0]);
        $this->assertEquals($enres[1], $deres[1]);

        $res1 = EncryptHelper::authcode('', '', true);
        $res2 = EncryptHelper::authcode('', '', false);
        $this->assertEquals('', $res1[0]);
        $this->assertEquals('', $res2[0]);

        $res3 = EncryptHelper::authcode('hello', $key, false);
        $this->assertEquals('', $res3[0]);

        $res4 = EncryptHelper::authcode('681ff2aaPIUK-k3oHs4StYD', $key, false);
        $this->assertEquals('', $res4[0]);
    }


    public function testEasyEncryptDecrypt() {
        $origin = 'hello world!你好，世界！';
        $key = '123456';

        $enres = EncryptHelper::easyEncrypt($origin, $key);
        $deres = EncryptHelper::easyDecrypt($enres, $key);
        $this->assertEquals($origin, $deres);

        $res1 = EncryptHelper::easyEncrypt('', $key);
        $this->assertEquals('', $res1);

        $res2 = EncryptHelper::easyDecrypt('', $key);
        $this->assertEquals('', $res2);

        $res3 = EncryptHelper::easyDecrypt('0adc39zZaczdODqqimpcaCGfYBRwciJPLxFO3NTce8VfS5', $key);
        $this->assertEquals('', $res3);

        $res4 = EncryptHelper::easyDecrypt('e10adc39   ', $key);
        $this->assertEquals('', $res4);

        $str = implode('', range(0, 99));
        $res5 = EncryptHelper::easyEncrypt($str, $key);
        $res6 = EncryptHelper::easyDecrypt($res5, $key);
        $this->assertEquals($str, $res6);
    }


    public function testMurmurhash3Int() {
        $origin = 'hello';
        $res1 = EncryptHelper::murmurhash3Int($origin);
        $res2 = EncryptHelper::murmurhash3Int($origin, 3, false);
        $this->assertEquals(11, strlen($res1));
        $this->assertEquals(10, strlen($res2));

        $origin .= '2';
        $res3 = EncryptHelper::murmurhash3Int($origin);
        $origin .= '3';
        $res4 = EncryptHelper::murmurhash3Int($origin);
    }


}
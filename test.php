<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 09.09.2015
 * Time: 23:53
 */


class Test{

    var $a = 100;

}

echo "test01<br/>";

$a = 1;
var_dump($a);
echo "<br/>";

$t = new Test();
$t2 = new $t;

var_dump($t);
echo "<br/>";
var_dump($t2);
echo "<br/>";

var_dump($t !== $t2);
echo "<br/>";
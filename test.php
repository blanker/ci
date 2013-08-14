<?php
/**
 * Created by JetBrains PhpStorm.
 * User: blank
 * Date: 13-7-21
 * Time: 上午12:54
 * To change this template use File | Settings | File Templates.
 */
//echo phpinfo();
header('Content-Type:text/html; charset=utf-8');

require_once 'System.php';
var_dump(class_exists('System', false));
$a = "b";
$$a = "232";
echo $b;
echo "<br/>";
echo $a;
echo "<br/>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br/>";

$a_bool = true;
$a_string = "string";
$a_int = 234;
$a_float = 234.5;

echo var_dump($a_bool);
echo var_dump($a_string);
echo var_dump($a_int);
echo var_dump($a_float);
echo gettype($a_bool);
echo "<br/>";
echo settype($a_int, "boolean");
echo "<br/>";
echo var_dump($a_int);
echo gettype($a_int);

phpinfo();

echo "<br/>";
echo fuck();
function fuck(){
    echo __FUNCTION__; echo "<br/>";
    return 1+3;
}
echo "<br/>";
echo __FILE__; echo "<br/>";
echo __DIR__; echo "<br/>";
echo __LINE__; echo "<br/>";
echo __FUNCTION__; echo "<br/>";
echo __CLASS__; echo "<br/>";
echo __TRAIT__; echo "<br/>";
echo __METHOD__; echo "<br/>";
echo __NAMESPACE__; echo "<br/>";

$array = array("wang","ke","xuan", 7=>'zhi','yun');
$array[10] ="xx";
$array[5] = "fuck";
foreach($array as $key => $val){
    echo "$key => $val <br/>";
}

foreach ( scandir("D:\\media\\php\\php100") as $f){
    echo iconv('gbk' , 'utf-8' , $f ) . '<br/>';
}
echo "<br/>";
unset($f);

// mysqli;
//$mysqli = mysqli_connect("localhost", "root", "password", "anda");
$mysqli = mysqli_connect();
if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
#echo $mysqli->get_charset();
#echo "<br/>";
printf ("Current character set is %s\n",  $mysqli->character_set_name());
echo "<br/>";

$mysqli->set_charset("utf8");
$res = mysqli_query($mysqli, "SELECT * FROM anda.TruckInfo");
while ($row = mysqli_fetch_assoc($res)){
    var_dump($row);
}

$mysqli->close();

phpinfo();
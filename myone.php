<html>
<head>
<!--IMPORTED GOOGLE FONTS FOR NICE OUTPUT-->
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">

<style>
body{font-family: 'Roboto', Verdana,sans-serif;}
	a{text-decoration:none;}
	a:hover{text-decoration:underline;}
</style>
</head>

<body>
<?php

include("red_conn.php");	//include the connection file from external source.

//always include the redis commands in brackets and quotes whereever there are strings.
//strings are not required for integers (meaning any numeric value).

// LIST ALL DBs

echo "<b>List of DBs: </b><pre>";							//only used to pretty the output.
	print_r($redis->info("keyspace"));		//List all DBs
echo "</pre>";


// SELECT DB

$redis->select(0);	//select db 0 (zero);

$theonkar = $redis->keys("*");
echo "<hr><b>All the keys in the selected DB: </b><pre>";
	print_r($theonkar) ;
echo "</pre>";



//Working with STRINGS
	/*Setting the keys and values for a string*/

	$redis->set("some_key", "some_value");	//Setting a key 'some_key' with value 'some_value'
	$stringShow = $redis->get("some_key");

	echo "<hr /><b>The output of String Key [some_key] is: </b>".$stringShow;





//Working with LISTS

	/*Setting the values for a key 'theOnkar' with the LPUSH and RPUSH commands.*/
$redis->lpush("theOnkar", "One");
$redis->lpush("theOnkar", "Two");
$redis->lpush("theOnkar", "Three");
$redis->rpush("theOnkar", "LastInListByRPUSH");
$redis->lpush("theOnkar", "Four");
$redis->lpush("theOnkar", "FirstInListByLPUSH");

	/*Retrieving the values: */
$listShow = $redis->lrange("theOnkar", 0, 5);		//Specify the range of the LRANGE - NOTICE THE comma after the name of the list and between the range.

echo "<hr><b>The output of List [theOnkar] is:</b> ";
echo "<pre>";
print_r($listShow);
echo "</pre>";

$redis->del("some_list");		//To delete a list named 'some_list':





//Working with SETS
	/*Setting the values*/
$redis->sadd("theOnkarSet","MySetValOne");
$redis->sadd("theOnkarSet","MySetValTwo");
$redis->sadd("theOnkarSet","MySetValThree");
$redis->sadd("theOnkarSet","MySetValFour");
$redis->sadd("theOnkarSet","MySetValFive");
$redis->sadd("theOnkarSet","MySetValSix");
$redis->sadd("theOnkarSet","MySetValSeven");

$setShow = $redis->smembers("theOnkarSet");

echo "<hr><b>The output of the Set [theOnkarSet] is: </b>";
echo "<pre>";
	print_r($setShow);
echo "</pre>";





//Working with HASHES
	/*	Setting the hash values for a hash key 'theOnkarHash'	*/

$redis->hmset("theOnkarHash", array("username"=>"somename", "password"=>"mypass", "city"=>"Paris", "color"=>"red"));

echo "<hr>";

	/*	Retrieving the values of the hash key */
foreach ($redis->hgetall('theOnkarHash') as $index => $item) {
    echo "[$index] $item\n";
}
	
	/*Another way of retrieving the values: */
$hashShow = $redis->hmget("theOnkarHash", ["password", "color", "city", "username", "nonExistentField"]);

echo "<br /><br /><b>The output of the Hash key 'theOnkarHash' is: </b><pre>";
	print_r($hashShow);
echo "</pre><hr>";


//Working with SORTED SETS
	/*	Creating a sorted set for 'theOnkarSorted'	*/
$redis->zadd("Players", 1946,"Player01");
$redis->zadd("Players", 1950,"Player2");
$redis->zadd("Players", 1935,"Player3");
$redis->zadd("Players", 1955,"Player4");
$redis->zadd("Players", 1962,"Player5");
$redis->zadd("Players", 1943,"Player6");
$redis->zadd("Players", 1937,"Player7");
$redis->zadd("Players", 1949,"Player8");
$redis->zadd("Players", 1957,"Player9");
$redis->zadd("Players", 1962,"Player10");

	/*Retrieving the Sorted Set*/
$sortedShow = $redis->zrange("Players", 0,-1);
echo "<b>The output of Sorted Set [Players] is:</b><pre>";
	print_r($sortedShow);
echo "</pre>";

echo "<hr> <a href='http://php-redis.blogspot.com'>Valar Morghulis</a><hr>";

?>
<body>
</html>
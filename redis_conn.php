<?php
	$redis = new Redis();		   //Connecting to Redis server on localhost
	$redis->connect('127.0.0.1', 6379);
	echo "Connection to server sucessfully";
	echo "<hr>Server is running: ".$redis->ping();	   //Check if the server is running
	echo "<hr>";
?>
